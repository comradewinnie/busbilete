<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Carrier;

class CarrierSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['40003262339', 'Tukuma auto', '80700002', 'info@hansalines.lv'],
            ['40003015652', 'Liepājas autobusu parks', '63426778', 'info@lap.lv'],
            ['40003016840', 'CATA', '64122121', 'cata@cata.lv'],
            ['48503004916', 'Latvijas Sabiedriskais Autobuss', '67113322', 'latvia@busgroup.world'],
            ['40003022404', 'Nordeka', '80000115', 'nordeka@nordeka.lv'],
            ['40003187350', 'Dautrans', '29298772', 'dautrans@apollo.lv'],
            ['40003009139', 'Talsu autotransports', '63232100', 'info@autotransports.lv'],
        ];

        foreach ($data as [$regNumber, $name, $phone, $email]) {
            Carrier::create([
                'registration_number' => $regNumber,
                'name'                => $name,
                'phone'               => $phone,
                'email'               => $email,
            ]);
        }
    }
}