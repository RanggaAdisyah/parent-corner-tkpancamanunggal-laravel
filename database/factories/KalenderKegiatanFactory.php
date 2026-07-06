<?php

namespace Database\Factories;

use App\Models\KalenderKegiatan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<KalenderKegiatan>
 */
class KalenderKegiatanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'judul' => $this->faker->sentence(),
            'tanggal' => $this->faker->date(),
            'waktu_mulai' => '08:00',
            'waktu_selesai' => '10:00',
            'kategori' => $this->faker->randomElement(['Akademik', 'Lomba', 'Libur', 'Rapat']),
            'deskripsi' => $this->faker->paragraph(),
        ];
    }
}
