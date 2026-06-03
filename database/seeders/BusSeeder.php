<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bus;

class BusSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['EX-4021', 50],
            ['EX-4022', 50],
            ['EU-8810', 48],
            ['EU-8811', 52],
            ['EX-3045', 55],
            ['JD-1290', 50],
            ['JD-1291', 45],
            ['JK-5540', 50],
            ['JK-5541', 50],
            ['JD-7723', 52],
            ['GK-9001', 48],
            ['GL-9002', 55],
            ['GK-1122', 50],
            ['GL-3344', 45],
            ['GK-5566', 50],
            ['HS-2010', 52],
            ['HT-2011', 50],
            ['HS-6677', 48],
            ['HT-8899', 55],
            ['HS-1100', 50],
            ['KG-4432', 52],
            ['KH-4433', 50],
            ['KG-9901', 45],
            ['KH-9902', 48],
            ['KG-1212', 55],
            ['MP-7030', 50],
            ['MR-7031', 50],
            ['MP-2288', 52],
            ['MR-3399', 45],
            ['MP-1010', 50],
        ];

        foreach ($data as [$plateNumber, $numberOfSeats]) {
            Bus::create([
                'plate_number'    => $plateNumber,
                'number_of_seats' => $numberOfSeats,
            ]);
        }
    }
}