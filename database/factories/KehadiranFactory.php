<?php

namespace Database\Factories;

use App\Models\Kehadiran;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Kehadiran>
 */
class KehadiranFactory extends Factory
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
            'status' => $this->faker->randomElement(['hadir', 'sakit', 'izin', 'alpa']),
            'keterangan' => $this->faker->sentence(),
        ];
    }
}
