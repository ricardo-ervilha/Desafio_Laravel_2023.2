<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;
use Psy\Util\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Owner>
 */
class OwnerFactory extends Factory
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
            'cpf' => \Illuminate\Support\Str::random('10'),
            'dateBirth' => fake()->date,
            'phone' => fake()->phoneNumber(),
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
        ];
    }
}
