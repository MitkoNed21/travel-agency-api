<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Holiday>
 */
class HolidayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(5),
            'start_date' => $this->faker->date(max: '2030-12-31'),
            'duration' => $this->faker->numberBetween(1, 14),
            'price' => (string)$this->faker->randomFloat(2, min: 0, max: 10000),
            'free_slots' => $this->faker->numberBetween(0, 30),

            'location_id' => Location::factory(),
        ];
    }
}
