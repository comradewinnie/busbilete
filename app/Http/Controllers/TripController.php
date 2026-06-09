<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use Carbon\Carbon;
use App\Models\Stop;
use App\Models\Tariff;
use App\Services\SeatAvailabilityService;

class TripController extends Controller
{
    public function __construct(
        private SeatAvailabilityService $seatService
    ) {}
    
    public function index(Request $request)
    {
        $request->validate([
            'from_stop_id' => 'required|exists:stops,id',
            'to_stop_id' => 'required|exists:stops,id|different:from_stop_id',
            // 'date' => 'required|date|after_or_equal:today', – for real application
            'date' => 'required|date',
        ]);

        $date = Carbon::parse($request->date);
        $scheduleTypes = $date->isWeekend() ? ['weekends', 'daily'] : ['weekdays', 'daily'];

        $trips = Trip::where('date', $date->toDateString())
            ->where('status', 'scheduled')
            ->with(['tripPlan.stops', 'tripPlan.route.carrier', 'tripPlan.route.tariffs', 'tripPlan.route.stops'])
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
            ->map(function ($trip) use ($request) {
                $trip->available_seats = $this->seatService->getAvailableSeats(
                    $trip,
                    $request->from_stop_id,
                    $request->to_stop_id,
                    session('cart', [])
                );
                return $trip;
            })
            ->values();

        $stops = Stop::orderBy('name')->get();

        return view('trips.index', compact('trips', 'stops'));
    }

    public function show(Trip $trip, Request $request)
    {
        $request->validate([
            'from_stop_id' => 'required|exists:stops,id',
            'to_stop_id' => 'required|exists:stops,id',
        ]);

        $trip->load(['tripPlan.route.carrier', 'tripPlan.stops', 'bus']);

        $tariff = Tariff::where('route_id', $trip->tripPlan->route_id)
            ->where('from_stop_id', $request->from_stop_id)
            ->where('to_stop_id', $request->to_stop_id)
            ->where('status', 'active')
            ->first();

        $availableSeats = $this->seatService->getAvailableSeats(
            $trip,
            $request->from_stop_id,
            $request->to_stop_id,
            session('cart', [])
        );

        $stops = $trip->tripPlan->route->stops->sortBy('pivot.sequence_number');

        $fromStop = Stop::find(request('from_stop_id'));
        $toStop = Stop::find(request('to_stop_id'));
        $date = request('date');

        return view('trips.show', compact('trip', 'stops', 'tariff', 'availableSeats', 'fromStop', 'toStop', 'date'));
    }
}