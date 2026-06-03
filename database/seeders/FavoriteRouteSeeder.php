<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FavoriteRoute;

class FavoriteRouteSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [1, 10], [1, 25],
            [2, 3],  [2, 15],
            [3, 7],  [3, 21],
            [4, 5],  [4, 30],
            [5, 2],  [5, 12],
            [6, 8],  [6, 18],
            [7, 4],  [7, 22],
            [8, 1],  [8, 11],
            [9, 6],  [9, 27],
            [10, 9], [10, 19],
            [11, 13], [11, 23],
            [12, 14], [12, 24],
            [13, 16], [13, 26],
            [14, 17], [14, 28],
            [15, 20],
            [16, 29],
        ];

        foreach ($data as [$userId, $routeId]) {
            FavoriteRoute::create([
                'user_id'  => $userId,
                'route_id' => $routeId,
            ]);
        }
    }
}