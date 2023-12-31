<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => fake()->password(),
            'dateBirth' => fake()->date(),
            'phone' => fake()->phoneNumber() ,
            'workTime' => fake()->numberBetween(0, 24),
            'address_id' => function(){
                $address = Address::create([
                    'cep' => '01001-000',
                    'publicPlace' => fake()->streetAddress(),
                    'district' => fake()->locale(),
                    'uf' => 'SP',
                    'city' => fake()->city,
                    'num' => fake()->numberBetween(1, 10000)
                ]);

                return $address->id;
            },
            'isAdmin' => false
        ];
    }
}
