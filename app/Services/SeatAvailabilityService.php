<?php

namespace App\Services;

use App\Models\RouteStop;
use App\Models\Tariff;
use App\Models\Ticket;
use App\Models\Trip;

class SeatAvailabilityService
{
    public function getAvailableSeats(
        Trip $trip,
        int $fromStopId,
        int $toStopId,
        array $cartItems = []
    ): int {
        $routeId = $trip->tripPlan->route_id;

        $routeStops = RouteStop::where('route_id', $routeId)
            ->get()
            ->keyBy('stop_id');

        $fromSeq = $routeStops[$fromStopId]->sequence_number;
        $toSeq   = $routeStops[$toStopId]->sequence_number;

        $overlappingTariffIds = Tariff::where('route_id', $routeId)
            ->get()
            ->filter(function ($tariff) use ($routeStops, $fromSeq, $toSeq) {
                $fSeq = $routeStops[$tariff->from_stop_id]->sequence_number ?? null;
                $tSeq = $routeStops[$tariff->to_stop_id]->sequence_number ?? null;

                return $fSeq && $tSeq && $fSeq < $toSeq && $tSeq > $fromSeq;
            })
            ->pluck('id')
            ->toArray();

        $soldCount = Ticket::where('trip_id', $trip->id)
            ->whereIn('tariff_id', $overlappingTariffIds)
            ->count();
            
        $inCartCount = collect($cartItems)
            ->filter(fn($item) =>
                $item['trip_id'] == $trip->id &&
                in_array($item['tariff_id'], $overlappingTariffIds)
            )
            ->count();

        return $trip->bus->number_of_seats - $soldCount - $inCartCount;
    }
}