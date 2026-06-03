<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Route;

class RouteSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['7017', 'Jelgava-Rīga', 44.6, '40003262339'],
            ['7017', 'Rīga-Jelgava', 44.6, '40003262339'],
            ['7376', 'Dobele-Jelgava-Rīga', 72.4, '40003262339'],
            ['7376', 'Rīga-Jelgava-Dobele', 72.4, '40003262339'],
            ['7788', 'Ogre-Rīga', 35.8, '40003015652'],
            ['7788', 'Rīga-Ogre', 35.8, '40003015652'],
            ['6117', 'Ogre-Ķeguma HES-Birzgale-Lāčplēša stacija', 41.0, '40003015652'],
            ['6117', 'Lāčplēša stacija-Birzgale-Ķeguma HES-Ogre', 41.0, '40003015652'],
            ['6256', 'Rīga-Sigulda', 56.2, '40003016840'],
            ['6256', 'Sigulda-Rīga', 56.2, '40003016840'],
            ['5612', 'Sigulda-Krimulda-Ragana-Rīga', 66.0, '40003016840'],
            ['5612', 'Rīga-Ragana-Krimulda-Sigulda', 65.0, '40003016840'],
            ['6251', 'Sigulda-Allaži-Tumšupe-Ropaži-Zaķumuiža-Rīga', 76.0, '40003016840'],
            ['6251', 'Rīga-Zaķumuiža-Ropaži-Tumšupe-Allaži-Sigulda', 76.0, '40003016840'],
            ['6251', 'Sigulda-Allaži-Tumšupe-Garkalne-Rīga', 69.3, '40003016840'],
            ['6251', 'Rīga-Garkalne-Tumšupe-Allaži-Sigulda', 68.3, '40003016840'],
            ['7023', 'Rīga-Sloka', 40.0, '48503004916'],
            ['7023', 'Sloka-Rīga', 39.0, '48503004916'],
            ['7018', 'Jaunķemeri-Spuņciems-Lielupe-Rīga', 48.0, '40003015652'],
            ['7020', 'Jaunķemeri-Valteri-Spice-Rīga', 45.0, '40003015652'],
            ['7018', 'Rīga-Lielupe-Spuņciems-Jaunķemeri', 48.0, '40003015652'],
            ['7020', 'Rīga-Spice-Valteri-Jaunķemeri', 45.0, '40003015652'],
            ['7467', 'Vecumnieki-Baldone-Rīga', 52.0, '40003022404'],
            ['7467', 'Rīga-Baldone-Vecumnieki', 53.0, '40003022404'],
            ['6824', 'Rīga-Ādaži-Carnikava (Tirgus)', 32.4, '48503004916'],
            ['6824', 'Carnikava (Tirgus)-Ādaži-Rīga', 32.4, '48503004916'],
            ['5371', 'Zvejniekciems (Robežu iela)-Carnikava-Rīga', 58.0, '40003016840'],
            ['5371', 'Rīga-Carnikava-Zvejniekciems (Robežu iela)', 58.0, '40003016840'],
            ['6821', 'Kadaga-Ādaži-Rīga', 27.0, '48503004916'],
            ['6821', 'Rīga-Ādaži-Kadaga', 27.0, '48503004916'],
        ];

        foreach ($data as [$number, $name, $distanceKm, $carrierRegNumber]) {
            Route::create([
                'number'                     => $number,
                'name'                       => $name,
                'distance_km'                => $distanceKm,
                'carrier_registration_number' => $carrierRegNumber,
            ]);
        }
    }
}