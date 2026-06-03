<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            CarrierSeeder::class,
            RouteSeeder::class,
            StopSeeder::class,
            RouteStopSeeder::class,
            TripPlanSeeder::class,
            TripPlanStopSeeder::class,
            BusSeeder::class,
            TripSeeder::class,
            BusLocationSeeder::class,
            TariffSeeder::class,
            UserSeeder::class,
            FavoriteRouteSeeder::class,
            TicketCategorySeeder::class,
            PaymentSeeder::class,
            TicketSeeder::class
        ]);
    }
}
