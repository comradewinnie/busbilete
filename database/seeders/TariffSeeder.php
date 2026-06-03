<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RouteStop;
use App\Models\Tariff;

class TariffSeeder extends Seeder
{
    public function run(): void
    {
        // Step 1
        $routeStops = RouteStop::orderBy('route_id')
            ->orderBy('sequence_number')
            ->get()
            ->groupBy('route_id');

        foreach ($routeStops as $routeId => $stops) {
            $stops = $stops->values();

            for ($i = 0; $i < $stops->count(); $i++) {
                for ($j = $i + 1; $j < $stops->count(); $j++) {
                    $from         = $stops[$i];
                    $to           = $stops[$j];
                    $sequenceDiff = $to->sequence_number - $from->sequence_number;
                    $price        = round(0.85 + ($sequenceDiff * 0.35), 2);

                    Tariff::create([
                        'route_id'     => $routeId,
                        'from_stop_id' => $from->stop_id,
                        'to_stop_id'   => $to->stop_id,
                        'price'        => $price,
                        'status'       => 'active',
                    ]);
                }
            }
        }

        // Step 2
        Tariff::where('route_id', 2)->update(['status' => 'inactive']);

        // Step 3
        $route2 = [
            [7, 6, 1.35],
            [7, 5, 1.70],
            [7, 4, 2.05],
            [7, 3, 2.40],
            [7, 2, 2.75],
            [6, 5, 1.35],
            [6, 4, 1.70],
            [6, 3, 2.05],
            [6, 2, 2.40],
            [5, 4, 1.35],
            [5, 3, 1.70],
            [5, 2, 2.05],
            [4, 3, 1.35],
            [4, 2, 1.70],
            [3, 2, 1.35],
        ];

        foreach ($route2 as [$fromStop, $toStop, $price]) {
            Tariff::create([
                'route_id'     => 2,
                'from_stop_id' => $fromStop,
                'to_stop_id'   => $toStop,
                'price'        => $price,
                'status'       => 'active',
            ]);
        }
    }
}