<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FavoriteRoute;

class FavoriteRouteSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [1, 17, 20], [1, 28, 50],
            [2, 2, 7],  [2, 24, 23],
            [3, 8, 13],  [3, 38, 29],
            [4, 10, 11],  [4, 28, 56],
            [5, 7, 2],  [5, 19, 17],
            [6, 15, 12],  [6, 30, 38],
            [7, 7, 1],  [7, 33, 29],
            [8, 5, 7],  [8, 19, 27],
            [9, 11, 10],  [9, 44, 47],
            [10, 56, 17], [10, 31, 37],
            [11, 21, 25], [11, 39, 7],
            [12, 26, 21], [12, 7, 41],
            [13, 28, 21], [13, 52, 58],
            [14, 36, 31], [14, 58, 54],
            [15, 33, 7],
            [16, 53, 28],
        ];

        foreach ($data as [$userId, $fromStopId, $toStopId]) {
            FavoriteRoute::create([
                'user_id'  => $userId,
                'from_stop_id' => $fromStopId,
                'to_stop_id' => $toStopId,
            ]);
        }
    }
}