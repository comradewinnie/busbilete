<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FavoriteRoute;

class FavoriteRouteSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [1, 10, 17, 20], [1, 25, 28, 50],
            [2, 3, 2, 7],  [2, 15, 24, 23],
            [3, 7, 8, 13],  [3, 21, 38, 29],
            [4, 5, 10, 11],  [4, 30, 28, 56],
            [5, 2, 7, 2],  [5, 12, 19, 17],
            [6, 8, 15, 12],  [6, 18, 30, 38],
            [7, 4, 7, 1],  [7, 22, 33, 29],
            [8, 1, 5, 7],  [8, 11, 19, 27],
            [9, 6, 11, 10],  [9, 27, 44, 47],
            [10, 9, 56, 17], [10, 19, 31, 37],
            [11, 13, 21, 25], [11, 23, 39, 7],
            [12, 14, 26, 21], [12, 24, 7, 41],
            [13, 16, 28, 21], [13, 26, 52, 58],
            [14, 17, 36, 31], [14, 28, 58, 54],
            [15, 20, 33, 7],
            [16, 29, 53, 28],
        ];

        foreach ($data as [$userId, $routeId, $fromStopId, $toStopId]) {
            FavoriteRoute::create([
                'user_id'  => $userId,
                'route_id' => $routeId,
                'from_stop_id' => $fromStopId,
                'to_stop_id' => $toStopId,
            ]);
        }
    }
}