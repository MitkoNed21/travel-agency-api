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
        Location::factory()->count(200)->create();
        Location::factory()->count(150)->hasHolidays(25)->create();
        Location::factory()->count(100)->hasHolidays(10)->create();
    }
}
