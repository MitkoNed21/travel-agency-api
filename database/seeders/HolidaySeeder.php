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
        Holiday::factory()->count(15)->create();
        Holiday::factory()->count(10)->hasReservations(5)->create();
        Holiday::factory()->count(8)->hasReservations(4)->create();
        Holiday::factory()->count(3)->hasReservations(1)->create();
    }
}
