<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RouteStop;

class RouteStopSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // Route 1: Jelgava-Rīga
            [1, 2, 1], [1, 3, 2], [1, 4, 3], [1, 5, 4], [1, 6, 5], [1, 7, 6],
            // Route 2: Rīga-Jelgava
            [2, 7, 1], [2, 6, 2], [2, 5, 3], [2, 4, 4], [2, 3, 5], [2, 2, 6],
            // Route 3: Dobele-Jelgava-Rīga
            [3, 1, 1], [3, 2, 2], [3, 3, 3], [3, 7, 4],
            // Route 4: Rīga-Jelgava-Dobele
            [4, 7, 1], [4, 3, 2], [4, 2, 3], [4, 1, 4],
            // Route 5: Ogre-Rīga
            [5, 8, 1], [5, 9, 2], [5, 10, 3], [5, 11, 4], [5, 7, 5],
            // Route 6: Rīga-Ogre
            [6, 7, 1], [6, 11, 2], [6, 10, 3], [6, 9, 4], [6, 8, 5],
            // Route 7: Ogre-Ķeguma HES-Birzgale-Lāčplēša stacija
            [7, 8, 1], [7, 12, 2], [7, 13, 3], [7, 14, 4], [7, 15, 5], [7, 16, 6],
            // Route 8: Lāčplēša stacija-Birzgale-Ķeguma HES-Ogre
            [8, 16, 1], [8, 15, 2], [8, 14, 3], [8, 13, 4], [8, 12, 5], [8, 8, 6],
            // Route 9: Rīga-Sigulda
            [9, 7, 1], [9, 28, 2], [9, 27, 3], [9, 56, 4], [9, 23, 5], [9, 22, 6], [9, 20, 7], [9, 17, 8],
            // Route 10: Sigulda-Rīga
            [10, 17, 1], [10, 20, 2], [10, 22, 3], [10, 23, 4], [10, 56, 5], [10, 27, 6], [10, 28, 7], [10, 7, 8],
            // Route 11: Sigulda-Krimulda-Ragana-Rīga
            [11, 17, 1], [11, 18, 2], [11, 19, 3], [11, 22, 4], [11, 23, 5], [11, 56, 6], [11, 27, 7], [11, 28, 8], [11, 7, 9],
            // Route 12: Rīga-Ragana-Krimulda-Sigulda
            [12, 7, 1], [12, 28, 2], [12, 27, 3], [12, 56, 4], [12, 23, 5], [12, 22, 6], [12, 19, 7], [12, 18, 8], [12, 17, 9],
            // Route 13: Sigulda-Allaži-Tumšupe-Ropaži-Zaķumuiža-Rīga
            [13, 17, 1], [13, 21, 2], [13, 24, 3], [13, 25, 4], [13, 26, 5], [13, 7, 6],
            // Route 14: Rīga-Zaķumuiža-Ropaži-Tumšupe-Allaži-Sigulda
            [14, 7, 1], [14, 26, 2], [14, 25, 3], [14, 24, 4], [14, 21, 5], [14, 17, 6],
            // Route 15: Sigulda-Allaži-Tumšupe-Garkalne-Rīga
            [15, 17, 1], [15, 21, 2], [15, 24, 3], [15, 23, 4], [15, 56, 5], [15, 27, 6], [15, 28, 7], [15, 7, 8],
            // Route 16: Rīga-Garkalne-Tumšupe-Allaži-Sigulda
            [16, 7, 1], [16, 28, 2], [16, 27, 3], [16, 56, 4], [16, 23, 5], [16, 24, 6], [16, 21, 7], [16, 17, 8],
            // Route 17: Rīga-Sloka
            [17, 7, 1], [17, 38, 2], [17, 36, 3], [17, 32, 4], [17, 31, 5], [17, 30, 6],
            // Route 18: Sloka-Rīga
            [18, 30, 1], [18, 32, 2], [18, 36, 3], [18, 38, 4], [18, 7, 5],
            // Route 19: Jaunķemeri-Spuņciems-Lielupe-Rīga
            [19, 29, 1], [19, 31, 2], [19, 34, 3], [19, 37, 4], [19, 38, 5], [19, 7, 6],
            // Route 20: Jaunķemeri-Valteri-Spice-Rīga
            [20, 29, 1], [20, 31, 2], [20, 33, 3], [20, 35, 4], [20, 36, 5], [20, 38, 6], [20, 7, 7],
            // Route 21: Rīga-Lielupe-Spuņciems-Jaunķemeri
            [21, 7, 1], [21, 38, 2], [21, 37, 3], [21, 34, 4], [21, 29, 5],
            // Route 22: Rīga-Spice-Valteri-Jaunķemeri
            [22, 7, 1], [22, 38, 2], [22, 36, 3], [22, 35, 4], [22, 33, 5], [22, 29, 6],
            // Route 23: Vecumnieki-Baldone-Rīga
            [23, 39, 1], [23, 40, 2], [23, 41, 3], [23, 42, 4], [23, 43, 5], [23, 7, 6],
            // Route 24: Rīga-Baldone-Vecumnieki
            [24, 7, 1], [24, 43, 2], [24, 42, 3], [24, 41, 4], [24, 40, 5], [24, 39, 6],
            // Route 25: Rīga-Ādaži-Carnikava (Tirgus)
            [25, 58, 1], [25, 28, 2], [25, 27, 3], [25, 56, 4], [25, 55, 5], [25, 53, 6], [25, 50, 7], [25, 52, 8],
            // Route 26: Carnikava (Tirgus)-Ādaži-Rīga
            [26, 52, 1], [26, 50, 2], [26, 53, 3], [26, 55, 4], [26, 56, 5], [26, 27, 6], [26, 28, 7], [26, 58, 8],
            // Route 27: Zvejniekciems (Robežu iela)-Carnikava-Rīga
            [27, 44, 1], [27, 45, 2], [27, 46, 3], [27, 47, 4], [27, 48, 5], [27, 50, 6], [27, 51, 7], [27, 54, 8], [27, 57, 9], [27, 58, 10],
            // Route 28: Rīga-Carnikava-Zvejniekciems (Robežu iela)
            [28, 58, 1], [28, 57, 2], [28, 54, 3], [28, 51, 4], [28, 50, 5], [28, 48, 6], [28, 47, 7], [28, 46, 8], [28, 45, 9], [28, 44, 10],
            // Route 29: Kadaga-Ādaži-Rīga
            [29, 49, 1], [29, 53, 2], [29, 55, 3], [29, 56, 4], [29, 27, 5], [29, 28, 6], [29, 58, 7],
            // Route 30: Rīga-Ādaži-Kadaga
            [30, 58, 1], [30, 28, 2], [30, 27, 3], [30, 56, 4], [30, 55, 5], [30, 53, 6], [30, 49, 7],
        ];

        foreach ($data as [$routeId, $stopId, $sequence]) {
            RouteStop::create([
                'route_id'        => $routeId,
                'stop_id'         => $stopId,
                'sequence_number' => $sequence,
            ]);
        }
    }
}