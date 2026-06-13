<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $routes = $user->favoriteRoutes()->with(['stops', 'carrier'])->get();

        return view('favorites.index', compact('routes'));
    }

    public function store(Route $route)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->favoriteRoutes()->syncWithoutDetaching([$route->id]);

        return back()->with('success', 'Maršruts pievienots iecienītākajiem.');
    }

    public function destroy(Route $route)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->favoriteRoutes()->detach($route->id);

        return back()->with('success', 'Maršruts noņemts no iecienītākajiem.');
    }
}