<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Location::factory()->count(20)->create();
        Location::factory()->count(15)->hasHolidays(5)->create();
        Location::factory()->count(10)->hasHolidays(3)->create();
    }
}
