<?php

namespace Database\Factories;

use App\Models\OrangTua;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrangTua>
 */
class OrangTuaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_ayah' => $this->faker->name('male'),
            'nama_ibu' => $this->faker->name('female'),
            'no_hp' => $this->faker->phoneNumber(),
            'alamat' => $this->faker->address(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
