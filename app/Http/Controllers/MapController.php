<?php

namespace App\Http\Controllers;

use App\Models\BusLocation;
use App\Models\Trip;

class MapController extends Controller
{
    public function busLocations()
    {
        $activeTrips = Trip::with('tripPlan.route')
            ->where('status', 'in_progress')
            ->get()
            ->keyBy('bus_id');

        $activeBusIds = $activeTrips->keys();

        $locations = BusLocation::with('bus')
            ->whereIn('bus_id', $activeBusIds)
            ->get()
            ->map(fn($loc) => [
                'bus_id' => $loc->bus_id,
                'plate' => $loc->bus->plate_number,
                'latitude' => $loc->latitude,
                'longitude' => $loc->longitude,
                'route' => $activeTrips->get($loc->bus_id)->tripPlan->route->name,
                'timestamp' => $loc->updated_at->toDateTimeString()
            ]);

        return response()->json($locations);
    }
}