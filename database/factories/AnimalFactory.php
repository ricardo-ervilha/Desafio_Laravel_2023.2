<?php

namespace Database\Factories;

use App\Models\Owner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Animal>
 */
class AnimalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $owner_id = Owner::factory()->create()->id;

        return [
            'name' => fake()->name(),
            'species' => fake()->text(),
            'breed' => fake()->text(),
            'dateBirth' => fake()->date(),
            'owner_id' => $owner_id
        ];
    }
}
