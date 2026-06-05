<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use Carbon\Carbon;
use App\Models\Stop;

class TripController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'from_stop_id' => 'required|exists:stops,id',
            'to_stop_id'   => 'required|exists:stops,id|different:from_stop_id',
            // 'date'         => 'required|date|after_or_equal:today', – for real application
            'date'         => 'required|date',
        ]);

        $date = Carbon::parse($request->date);
        $scheduleTypes = $date->isWeekend() ? ['weekends', 'daily'] : ['weekdays', 'daily'];

        $trips = Trip::where('date', $date->toDateString())
            ->where('status', 'scheduled')
            ->with('tripPlan.route.stops')
            ->whereHas('tripPlan', fn($q) =>
                $q->whereIn('schedule_type', $scheduleTypes)
            )
            ->whereHas('tripPlan.route.stops', fn($q) =>
                $q->where('stops.id', $request->from_stop_id)
            )
            ->whereHas('tripPlan.route.stops', fn($q) =>
                $q->where('stops.id', $request->to_stop_id)
            )
            ->get()
            ->filter(function ($trip) use ($request) {
                $stops = $trip->tripPlan->route->stops;

                $fromSeq = $stops->firstWhere('id', $request->from_stop_id)->pivot->sequence_number;
                $toSeq   = $stops->firstWhere('id', $request->to_stop_id)->pivot->sequence_number;

                return $fromSeq < $toSeq;
            })
            ->values();

        $stops = Stop::orderBy('name')->get();

        return view('trips.index', compact('trips', 'stops'));
    }

    public function show(Trip $trip)
    {
        $stops = $trip->tripPlan->route->stops->sortBy('pivot.sequence_number');
        return view('trips.show', compact('trip', 'stops'));
    }
}