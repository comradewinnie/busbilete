<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TicketCategory;

class TicketCategorySeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['Parastā', 1.0],
            ['Personām ar invaliditāti un viņu pavadoņiem', 0.0],
            ['Bērniem līdz 7 g. vecumam', 0.0],
            ['Bērniem bāreņiem', 0.0],
            ['Politiski represētām personām un nacionālās pretošanās kustības dalībniekiem', 0.0],
            ['Pieaugušiem ar 3+ Ģimenes karti', 0.5],
            ['Skolēniem un studentiem līdz 24 g. vecumam ar 3+ Ģimenes karti)', 0.1],
            ['Personām ar 3+ Ģimenes karti valsts svētku dienās', 0.0],
        ];

        foreach ($data as [$name, $multiplier]) {
            TicketCategory::create([
                'name'       => $name,
                'multiplier' => $multiplier,
            ]);
        }
    }
}