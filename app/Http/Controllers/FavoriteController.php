<?php

namespace App\Http\Controllers;

use App\Models\FavoriteRoute;
use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $favorites = $user->favoriteRoutes()
            ->with(['route.carrier', 'fromStop', 'toStop'])
            ->get();

        return view('favorites.index', compact('favorites'));
    }

    public function store(Request $request, Route $route)
    {
        $request->validate([
            'from_stop_id' => 'required|exists:stops,id',
            'to_stop_id'   => 'required|exists:stops,id|different:from_stop_id',
        ]);

        $routeStopIds = $route->stops->pluck('id');

        if (!$routeStopIds->contains($request->from_stop_id) || !$routeStopIds->contains($request->to_stop_id)) {
            abort(422);
        }

        $exists = FavoriteRoute::where('user_id', Auth::id())
            ->where('route_id', $route->id)
            ->where('from_stop_id', $request->from_stop_id)
            ->where('to_stop_id', $request->to_stop_id)
            ->exists();

        if (!$exists) {
            FavoriteRoute::create([
                'user_id'      => Auth::id(),
                'route_id'     => $route->id,
                'from_stop_id' => $request->from_stop_id,
                'to_stop_id'   => $request->to_stop_id,
            ]);
        }

        return back()->with('success', __('favorites.added'));
    }

    public function destroy(FavoriteRoute $favoriteRoute)
    {
        if ($favoriteRoute->user_id !== Auth::id()) {
            abort(403);
        }

        $favoriteRoute->delete();

        return back()->with('success', __('favorites.removed'));
    }
}