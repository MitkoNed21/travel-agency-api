<?php

namespace Database\Seeders;

use App\Models\Holiday;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Holiday::factory()->count(150)->create();
        Holiday::factory()->count(100)->hasReservations(20)->create();
        Holiday::factory()->count(35)->hasReservations(10)->create();
        Holiday::factory()->count(8)->hasReservations(1)->create();
    }
}
