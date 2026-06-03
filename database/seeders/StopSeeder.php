<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stop;

class StopSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['Dobeles AO', 56.6279, 23.2848],
            ['Jelgavas AO', 56.6498, 23.7218],
            ['Pērnavas iela', 56.6672, 23.7574],
            ['Dalbe', 56.7411, 23.8773],
            ['Olaines stacija', 56.7839, 23.9497],
            ['Medemciems', 56.8564, 24.0639],
            ['Rīgas SAO', 56.9450, 24.1145],
            ['Ogres AO', 56.8149, 24.6032],
            ['Ikšķile', 56.8382, 24.4936],
            ['Salaspils', 56.8523, 24.3329],
            ['Eglaines iela / Dole', 56.9050, 24.1911],
            ['Ķegums', 56.7465, 24.7185],
            ['Robežnieki', 56.7132, 24.7454],
            ['Reibužas', 56.6858, 24.7935],
            ['Priedītes', 56.6538, 24.7772],
            ['Lāčplēša stacija', 56.5763, 24.7939],
            ['Siguldas AO', 57.1534, 24.8544],
            ['Krimulda', 57.1698, 24.8263],
            ['Ragana', 57.1796, 24.7150],
            ['Gauja', 57.1275, 24.7035],
            ['Allaži', 57.0622, 24.8445],
            ['Vangaži', 57.0900, 24.5539],
            ['Garkalne', 57.0430, 24.4099],
            ['Tumšupe', 57.0202, 24.6218],
            ['Zaķumuiža', 56.9704, 24.4792],
            ['Ulbrokas rotācijas aplis', 56.9446, 24.2796],
            ['Jugla', 56.9899, 24.2431],
            ['Matīsa iela', 56.9603, 24.1306],
            ['Jaunķemeri (Kūrorta RC)', 56.9701, 23.5621],
            ['Slokas stacija', 56.9475, 23.6171],
            ['Kauguri 2', 56.6931, 23.6033],
            ['Vaivaru rehabilitācijas centrs', 56.9578, 23.6673],
            ['Valteri', 56.9418, 23.6939],
            ['Spuņciems', 56.9294, 23.6910],
            ['SIVA koledža', 56.9540, 23.7706],
            ['Majoru stacija', 56.9715, 23.7973],
            ['Varkaļi', 56.9513, 23.8040],
            ['Zolitūdes iela', 56.9291, 24.0159],
            ['Vecumnieki', 56.6063, 24.5223],
            ['Zvirgzde', 56.6433, 24.4478],
            ['Pagrieziens uz Dzelzāmuru', 56.6888, 24.3921],
            ['Baldone', 56.7433, 24.4025],
            ['Ķekava', 56.8290, 24.2388],
            ['Robežu iela', 57.3207, 24.4242],
            ['Koklītes', 57.2945, 24.4099],
            ['Saulkrasti', 57.2640, 24.4148],
            ['Inčupe', 57.2342, 24.3940],
            ['Medzābaki', 57.1850, 24.3446],
            ['Kadaga', 57.0956, 24.3673],
            ['Dārziņi', 57.1253, 24.2961],
            ['Carnikava', 57.1289, 24.2783],
            ['Carnikava (tirgus)', 57.1283, 24.2804],
            ['Ādaži', 57.0758, 24.3196],
            ['Kalngale', 57.0782, 24.1591],
            ['Baltezers', 57.0440, 24.3156],
            ['Autoserviss', 57.0049, 24.2918],
            ['Sarkandaugava', 56.9948, 24.1268],
            ['Rīga (Spīķeri)', 56.9422, 24.1136],
        ];

        foreach ($data as [$name, $latitude, $longitude]) {
            Stop::create([
                'name'      => $name,
                'latitude'  => $latitude,
                'longitude' => $longitude,
            ]);
        }
    }
}