<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TripPlan;

class TripPlanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // Route 1: Jelgava-Rīga
            [1,  'daily',    '12:00:00'],
            // Route 2: Rīga-Jelgava
            [2,  'weekdays', '17:15:00'],
            [2,  'weekdays', '18:45:00'],
            [2,  'daily',    '10:00:00'],
            // Route 3: Dobele-Jelgava-Rīga
            [3,  'weekends', '09:00:00'],
            // Route 4: Rīga-Jelgava-Dobele
            [4,  'daily',    '19:10:00'],
            // Route 5: Ogre-Rīga
            [5,  'weekdays', '07:20:00'],
            [5,  'daily',    '10:15:00'],
            [5,  'weekdays', '16:00:00'],
            // Route 6: Rīga-Ogre
            [6,  'daily',    '18:40:00'],
            // Route 7: Ogre-Ķeguma HES-Birzgale-Lāčplēša stacija
            [7,  'daily',    '07:45:00'],
            [7,  'weekdays', '15:15:00'],
            // Route 8: Lāčplēša stacija-Birzgale-Ķeguma HES-Ogre
            [8,  'daily',    '09:00:00'],
            // Route 9: Rīga-Sigulda
            [9,  'daily',    '08:40:00'],
            [9,  'weekdays', '10:00:00'],
            [9,  'weekends', '11:30:00'],
            // Route 10: Sigulda-Rīga
            [10, 'daily',    '16:30:00'],
            // Route 11: Sigulda-Krimulda-Ragana-Rīga
            [11, 'weekdays', '06:40:00'],
            [11, 'weekends', '08:15:00'],
            // Route 12: Rīga-Ragana-Krimulda-Sigulda
            [12, 'weekdays', '17:20:00'],
            // Route 13: Sigulda-Allaži-Tumšupe-Ropaži-Zaķumuiža-Rīga
            [13, 'weekdays', '07:10:00'],
            // Route 14: Rīga-Zaķumuiža-Ropaži-Tumšupe-Allaži-Sigulda
            [14, 'weekdays', '16:10:00'],
            [14, 'daily',    '19:10:00'],
            // Route 15: Sigulda-Allaži-Tumšupe-Garkalne-Rīga
            [15, 'daily',    '14:40:00'],
            // Route 16: Rīga-Garkalne-Tumšupe-Allaži-Sigulda
            [16, 'weekdays', '17:50:00'],
            // Route 17: Rīga-Sloka
            [17, 'weekdays', '12:00:00'],
            // Route 18: Sloka-Rīga
            [18, 'daily',    '16:45:00'],
            // Route 19: Jaunķemeri-Spuņciems-Lielupe-Rīga
            [19, 'daily',    '08:45:00'],
            [19, 'weekends', '14:00:00'],
            // Route 20: Jaunķemeri-Valteri-Spice-Rīga
            [20, 'daily',    '07:15:00'],
            [20, 'weekdays', '15:50:00'],
            // Route 21: Rīga-Lielupe-Spuņciems-Jaunķemeri
            [21, 'daily',    '10:30:00'],
            // Route 22: Rīga-Spice-Valteri-Jaunķemeri
            [22, 'daily',    '12:40:00'],
            [22, 'weekdays', '18:10:00'],
            // Route 23: Vecumnieki-Baldone-Rīga
            [23, 'daily',    '16:50:00'],
            // Route 24: Rīga-Baldone-Vecumnieki
            [24, 'weekdays', '08:00:00'],
            [24, 'daily',    '15:10:00'],
            [24, 'daily',    '18:30:00'],
            // Route 25: Rīga-Ādaži-Carnikava (Tirgus)
            [25, 'daily',    '17:30:00'],
            // Route 26: Carnikava (Tirgus)-Ādaži-Rīga
            [26, 'weekdays', '06:20:00'],
            // Route 27: Zvejniekciems (Robežu iela)-Carnikava-Rīga
            [27, 'daily',    '05:50:00'],
            [27, 'weekdays', '13:20:00'],
            // Route 28: Rīga-Carnikava-Zvejniekciems (Robežu iela)
            [28, 'daily',    '15:40:00'],
            // Route 29: Kadaga-Ādaži-Rīga
            [29, 'weekdays', '07:05:00'],
            [29, 'daily',    '14:15:00'],
            // Route 30: Rīga-Ādaži-Kadaga
            [30, 'daily',    '20:10:00'],
        ];

        foreach ($data as [$routeId, $scheduleType, $departureTime]) {
            TripPlan::create([
                'route_id'      => $routeId,
                'schedule_type' => $scheduleType,
                'departure_time'=> $departureTime,
            ]);
        }
    }
}