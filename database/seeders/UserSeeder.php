<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['29100201', 'Pass123!'],
            ['26543210', 'Parole2026'],
            ['28334455', 'qwerty99'],
            ['27123456', 'bigpass'],
            ['25987654', 'my_passwrod'],
            ['20112233', 'hellloworld'],
            ['22334455', '1234strong'],
            ['24556677', 'wefsf34'],
            ['26778899', '@uloki34'],
            ['28990011', 'lololol12'],
            ['29221100', 'autoapp3411'],
            ['25332211', 'passwqwe432'],
            ['27443322', 'memmemesdc23'],
            ['20554433', '@parolefisj'],
            ['22665544', 'xyz3241'],
            ['24776655', 'bigbro228'],
            ['26887766', 'chertilaMEOW'],
            ['28998877', 'melnais@kakis'],
            ['29119988', 'STRONGPSWRD!'],
            ['25220099', 'gegege'],
            ['27331100', 'hahhaha23'],
            ['20442211', 'ZyX789!'],
            ['22553322', 'BUS_traveler'],
            ['24664433', 'User3000'],
            ['26775544', 'BULLdog'],
            ['28886655', 'aprilis2026'],
            ['29997766', 'latvianGuy345'],
            ['25118877', 'autobusi77'],
            ['27229988', 'bussSSSSS'],
            ['20330099', 'manaparole'],
            ['22441122', '@zcjYtiv467!'],
            ['24552233', 'aleksejs9643'],
            ['26663344', 'Ridzinieks'],
            ['28774455', 'test_test'],
            ['29885566', '*coolguy*'],
            ['28974543', 'imthebest'],
            ['25321652', 'newusernewpassword'],
            ['29457632', '@Administrator123']
        ];

        $baseDate = Carbon::parse('2026-04-25 10:45:32');
        foreach ($data as [$phone, $plainPassword]) {
            $randomSeconds = rand(0, 2592000);
            $createdAt = $baseDate->copy()->subSeconds($randomSeconds);
            $role = $phone === '29457632' ? 'admin' : 'passenger';
            
            User::create([
                'phone'      => $phone,
                'password'   => Hash::make($plainPassword),
                'role'       => $role,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);
        }
    }
}