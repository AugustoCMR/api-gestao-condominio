<?php

namespace Database\Factories;

use App\Models\Condominium;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Condominium>
 */
class CondominiumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'state' => fake()->stateAbbr(),
            'zip_code' => fake()->numerify('#####-###'),
            'cnpj' => fake()->unique()->numerify('##############'),
            'phone' => fake()->numerify('(##) ####-####'),
            'email' => fake()->unique()->companyEmail(),
            'neighborhood' => fake()->citySuffix(),
            'complement' => fake()->secondaryAddress(),
        ];
    }
}
