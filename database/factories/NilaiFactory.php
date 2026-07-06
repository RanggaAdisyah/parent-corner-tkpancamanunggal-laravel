<?php

namespace Database\Factories;

use App\Models\Nilai;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Nilai>
 */
class NilaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'siswa_id' => \App\Models\Siswa::factory(),
            'tanggal' => $this->faker->date(),
            'level' => $this->faker->randomElement(['IQRA 1', 'IQRA 2', 'AL-QURAN']),
            'hal' => (string) $this->faker->numberBetween(1, 100),
            'nilai' => $this->faker->randomElement(['A', 'B', 'C']),
            'keterangan' => $this->faker->sentence(),
        ];
    }
}
