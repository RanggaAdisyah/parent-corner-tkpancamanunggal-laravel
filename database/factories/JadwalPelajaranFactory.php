<?php

namespace Database\Factories;

use App\Models\JadwalPelajaran;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<JadwalPelajaran>
 */
class JadwalPelajaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kelas_id' => \App\Models\Kelas::factory(),
            'hari' => $this->faker->randomElement(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']),
            'jam_mulai' => '07:30',
            'jam_selesai' => '09:00',
            'kegiatan' => $this->faker->sentence(3),
            'keterangan' => $this->faker->sentence(),
        ];
    }
}
