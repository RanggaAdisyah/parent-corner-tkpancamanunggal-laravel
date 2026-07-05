<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;
use App\Models\JadwalPelajaran;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan kelas TK A dan TK B ada
        $tkB = Kelas::firstOrCreate(['nama_kelas' => 'TK B'], ['tingkat' => 'TK B']);
        $tkA = Kelas::firstOrCreate(['nama_kelas' => 'TK A'], ['tingkat' => 'TK A']);

        $jadwals = [

            // ── TK B  Senin – Kamis ──────────────────────────────────────
            ['kelas_id' => $tkB->id, 'hari' => 'Senin',  'jam_mulai' => '07:00', 'jam_selesai' => '07:30', 'kegiatan' => 'Kedatangan & Doa Pagi',      'keterangan' => 'Menyapa guru, berdoa bersama'],
            ['kelas_id' => $tkB->id, 'hari' => 'Senin',  'jam_mulai' => '07:30', 'jam_selesai' => '08:00', 'kegiatan' => 'Kegiatan Pembukaan',          'keterangan' => 'Menyanyi, senam pagi, diskusi tema hari ini'],
            ['kelas_id' => $tkB->id, 'hari' => 'Senin',  'jam_mulai' => '08:00', 'jam_selesai' => '09:00', 'kegiatan' => 'Kegiatan Inti',               'keterangan' => 'Sentra bermain/aktivitas tematik (motorik, bahasa, seni)'],
            ['kelas_id' => $tkB->id, 'hari' => 'Senin',  'jam_mulai' => '09:00', 'jam_selesai' => '09:30', 'kegiatan' => 'Istirahat & Makan Bekal',     'keterangan' => 'Makan bersama, cuci tangan'],
            ['kelas_id' => $tkB->id, 'hari' => 'Senin',  'jam_mulai' => '09:30', 'jam_selesai' => null,    'kegiatan' => 'Penutup & Pulang',            'keterangan' => 'Doa bersama dan pulang'],

            ['kelas_id' => $tkB->id, 'hari' => 'Selasa', 'jam_mulai' => '07:00', 'jam_selesai' => '07:30', 'kegiatan' => 'Kedatangan & Doa Pagi',      'keterangan' => 'Menyapa guru, berdoa bersama'],
            ['kelas_id' => $tkB->id, 'hari' => 'Selasa', 'jam_mulai' => '07:30', 'jam_selesai' => '08:00', 'kegiatan' => 'Kegiatan Pembukaan',          'keterangan' => 'Menyanyi, senam pagi, diskusi tema hari ini'],
            ['kelas_id' => $tkB->id, 'hari' => 'Selasa', 'jam_mulai' => '08:00', 'jam_selesai' => '09:00', 'kegiatan' => 'Kegiatan Inti',               'keterangan' => 'Sentra bermain/aktivitas tematik (motorik, bahasa, seni)'],
            ['kelas_id' => $tkB->id, 'hari' => 'Selasa', 'jam_mulai' => '09:00', 'jam_selesai' => '09:30', 'kegiatan' => 'Istirahat & Makan Bekal',     'keterangan' => 'Makan bersama, cuci tangan'],
            ['kelas_id' => $tkB->id, 'hari' => 'Selasa', 'jam_mulai' => '09:30', 'jam_selesai' => null,    'kegiatan' => 'Penutup & Pulang',            'keterangan' => 'Doa bersama dan pulang'],

            ['kelas_id' => $tkB->id, 'hari' => 'Rabu',   'jam_mulai' => '07:00', 'jam_selesai' => '07:30', 'kegiatan' => 'Kedatangan & Doa Pagi',      'keterangan' => 'Menyapa guru, berdoa bersama'],
            ['kelas_id' => $tkB->id, 'hari' => 'Rabu',   'jam_mulai' => '07:30', 'jam_selesai' => '08:00', 'kegiatan' => 'Kegiatan Pembukaan',          'keterangan' => 'Menyanyi, senam pagi, diskusi tema hari ini'],
            ['kelas_id' => $tkB->id, 'hari' => 'Rabu',   'jam_mulai' => '08:00', 'jam_selesai' => '09:00', 'kegiatan' => 'Kegiatan Inti',               'keterangan' => 'Sentra bermain/aktivitas tematik (motorik, bahasa, seni)'],
            ['kelas_id' => $tkB->id, 'hari' => 'Rabu',   'jam_mulai' => '09:00', 'jam_selesai' => '09:30', 'kegiatan' => 'Istirahat & Makan Bekal',     'keterangan' => 'Makan bersama, cuci tangan'],
            ['kelas_id' => $tkB->id, 'hari' => 'Rabu',   'jam_mulai' => '09:30', 'jam_selesai' => null,    'kegiatan' => 'Penutup & Pulang',            'keterangan' => 'Doa bersama dan pulang'],

            ['kelas_id' => $tkB->id, 'hari' => 'Kamis',  'jam_mulai' => '07:00', 'jam_selesai' => '07:30', 'kegiatan' => 'Kedatangan & Doa Pagi',      'keterangan' => 'Menyapa guru, berdoa bersama'],
            ['kelas_id' => $tkB->id, 'hari' => 'Kamis',  'jam_mulai' => '07:30', 'jam_selesai' => '08:00', 'kegiatan' => 'Kegiatan Pembukaan',          'keterangan' => 'Menyanyi, senam pagi, diskusi tema hari ini'],
            ['kelas_id' => $tkB->id, 'hari' => 'Kamis',  'jam_mulai' => '08:00', 'jam_selesai' => '09:00', 'kegiatan' => 'Kegiatan Inti',               'keterangan' => 'Sentra bermain/aktivitas tematik (motorik, bahasa, seni)'],
            ['kelas_id' => $tkB->id, 'hari' => 'Kamis',  'jam_mulai' => '09:00', 'jam_selesai' => '09:30', 'kegiatan' => 'Istirahat & Makan Bekal',     'keterangan' => 'Makan bersama, cuci tangan'],
            ['kelas_id' => $tkB->id, 'hari' => 'Kamis',  'jam_mulai' => '09:30', 'jam_selesai' => null,    'kegiatan' => 'Penutup & Pulang',            'keterangan' => 'Doa bersama dan pulang'],

            // ── TK B  Jumat ──────────────────────────────────────────────
            ['kelas_id' => $tkB->id, 'hari' => 'Jumat',  'jam_mulai' => '07:00', 'jam_selesai' => '07:30', 'kegiatan' => 'Kedatangan & Doa Pagi',      'keterangan' => 'Menyapa guru, berdoa bersama'],
            ['kelas_id' => $tkB->id, 'hari' => 'Jumat',  'jam_mulai' => '07:30', 'jam_selesai' => '07:45', 'kegiatan' => 'Kegiatan Pembukaan',          'keterangan' => 'Menyanyi, senam pagi, diskusi tema hari ini'],
            ['kelas_id' => $tkB->id, 'hari' => 'Jumat',  'jam_mulai' => '07:45', 'jam_selesai' => '08:30', 'kegiatan' => 'Kegiatan Inti',               'keterangan' => 'Sentra bermain/aktivitas tematik (motorik, bahasa, seni)'],
            ['kelas_id' => $tkB->id, 'hari' => 'Jumat',  'jam_mulai' => '08:30', 'jam_selesai' => '09:00', 'kegiatan' => 'Istirahat & Makan Bekal',     'keterangan' => 'Makan bersama, cuci tangan'],
            ['kelas_id' => $tkB->id, 'hari' => 'Jumat',  'jam_mulai' => '09:00', 'jam_selesai' => null,    'kegiatan' => 'Penutup & Pulang',            'keterangan' => 'Doa bersama dan pulang'],

            // ── TK A  Senin – Kamis ──────────────────────────────────────
            ['kelas_id' => $tkA->id, 'hari' => 'Senin',  'jam_mulai' => '09:30', 'jam_selesai' => '10:00', 'kegiatan' => 'Kedatangan & Doa Pagi',      'keterangan' => 'Menyapa guru, berdoa bersama'],
            ['kelas_id' => $tkA->id, 'hari' => 'Senin',  'jam_mulai' => '10:00', 'jam_selesai' => '10:30', 'kegiatan' => 'Kegiatan Pembukaan',          'keterangan' => 'Menyanyi, senam pagi, diskusi tema hari ini'],
            ['kelas_id' => $tkA->id, 'hari' => 'Senin',  'jam_mulai' => '10:30', 'jam_selesai' => '11:30', 'kegiatan' => 'Kegiatan Inti',               'keterangan' => 'Sentra bermain/aktivitas tematik (motorik, bahasa, seni)'],
            ['kelas_id' => $tkA->id, 'hari' => 'Senin',  'jam_mulai' => '11:30', 'jam_selesai' => '11:45', 'kegiatan' => 'Istirahat & Makan Bekal',     'keterangan' => 'Makan bersama, cuci tangan'],
            ['kelas_id' => $tkA->id, 'hari' => 'Senin',  'jam_mulai' => '11:45', 'jam_selesai' => null,    'kegiatan' => 'Penutup & Pulang',            'keterangan' => 'Doa bersama dan pulang'],

            ['kelas_id' => $tkA->id, 'hari' => 'Selasa', 'jam_mulai' => '09:30', 'jam_selesai' => '10:00', 'kegiatan' => 'Kedatangan & Doa Pagi',      'keterangan' => 'Menyapa guru, berdoa bersama'],
            ['kelas_id' => $tkA->id, 'hari' => 'Selasa', 'jam_mulai' => '10:00', 'jam_selesai' => '10:30', 'kegiatan' => 'Kegiatan Pembukaan',          'keterangan' => 'Menyanyi, senam pagi, diskusi tema hari ini'],
            ['kelas_id' => $tkA->id, 'hari' => 'Selasa', 'jam_mulai' => '10:30', 'jam_selesai' => '11:30', 'kegiatan' => 'Kegiatan Inti',               'keterangan' => 'Sentra bermain/aktivitas tematik (motorik, bahasa, seni)'],
            ['kelas_id' => $tkA->id, 'hari' => 'Selasa', 'jam_mulai' => '11:30', 'jam_selesai' => '11:45', 'kegiatan' => 'Istirahat & Makan Bekal',     'keterangan' => 'Makan bersama, cuci tangan'],
            ['kelas_id' => $tkA->id, 'hari' => 'Selasa', 'jam_mulai' => '11:45', 'jam_selesai' => null,    'kegiatan' => 'Penutup & Pulang',            'keterangan' => 'Doa bersama dan pulang'],

            ['kelas_id' => $tkA->id, 'hari' => 'Rabu',   'jam_mulai' => '09:30', 'jam_selesai' => '10:00', 'kegiatan' => 'Kedatangan & Doa Pagi',      'keterangan' => 'Menyapa guru, berdoa bersama'],
            ['kelas_id' => $tkA->id, 'hari' => 'Rabu',   'jam_mulai' => '10:00', 'jam_selesai' => '10:30', 'kegiatan' => 'Kegiatan Pembukaan',          'keterangan' => 'Menyanyi, senam pagi, diskusi tema hari ini'],
            ['kelas_id' => $tkA->id, 'hari' => 'Rabu',   'jam_mulai' => '10:30', 'jam_selesai' => '11:30', 'kegiatan' => 'Kegiatan Inti',               'keterangan' => 'Sentra bermain/aktivitas tematik (motorik, bahasa, seni)'],
            ['kelas_id' => $tkA->id, 'hari' => 'Rabu',   'jam_mulai' => '11:30', 'jam_selesai' => '11:45', 'kegiatan' => 'Istirahat & Makan Bekal',     'keterangan' => 'Makan bersama, cuci tangan'],
            ['kelas_id' => $tkA->id, 'hari' => 'Rabu',   'jam_mulai' => '11:45', 'jam_selesai' => null,    'kegiatan' => 'Penutup & Pulang',            'keterangan' => 'Doa bersama dan pulang'],

            ['kelas_id' => $tkA->id, 'hari' => 'Kamis',  'jam_mulai' => '09:30', 'jam_selesai' => '10:00', 'kegiatan' => 'Kedatangan & Doa Pagi',      'keterangan' => 'Menyapa guru, berdoa bersama'],
            ['kelas_id' => $tkA->id, 'hari' => 'Kamis',  'jam_mulai' => '10:00', 'jam_selesai' => '10:30', 'kegiatan' => 'Kegiatan Pembukaan',          'keterangan' => 'Menyanyi, senam pagi, diskusi tema hari ini'],
            ['kelas_id' => $tkA->id, 'hari' => 'Kamis',  'jam_mulai' => '10:30', 'jam_selesai' => '11:30', 'kegiatan' => 'Kegiatan Inti',               'keterangan' => 'Sentra bermain/aktivitas tematik (motorik, bahasa, seni)'],
            ['kelas_id' => $tkA->id, 'hari' => 'Kamis',  'jam_mulai' => '11:30', 'jam_selesai' => '11:45', 'kegiatan' => 'Istirahat & Makan Bekal',     'keterangan' => 'Makan bersama, cuci tangan'],
            ['kelas_id' => $tkA->id, 'hari' => 'Kamis',  'jam_mulai' => '11:45', 'jam_selesai' => null,    'kegiatan' => 'Penutup & Pulang',            'keterangan' => 'Doa bersama dan pulang'],

            // ── TK A  Jumat ──────────────────────────────────────────────
            ['kelas_id' => $tkA->id, 'hari' => 'Jumat',  'jam_mulai' => '09:15', 'jam_selesai' => '09:30', 'kegiatan' => 'Kedatangan & Doa Pagi',      'keterangan' => 'Menyapa guru, berdoa bersama'],
            ['kelas_id' => $tkA->id, 'hari' => 'Jumat',  'jam_mulai' => '09:30', 'jam_selesai' => '09:45', 'kegiatan' => 'Kegiatan Pembukaan',          'keterangan' => 'Menyanyi, senam pagi, diskusi tema hari ini'],
            ['kelas_id' => $tkA->id, 'hari' => 'Jumat',  'jam_mulai' => '09:45', 'jam_selesai' => '10:45', 'kegiatan' => 'Kegiatan Inti',               'keterangan' => 'Sentra bermain/aktivitas tematik (motorik, bahasa, seni)'],
            ['kelas_id' => $tkA->id, 'hari' => 'Jumat',  'jam_mulai' => '10:45', 'jam_selesai' => '11:00', 'kegiatan' => 'Istirahat & Makan Bekal',     'keterangan' => 'Makan bersama, cuci tangan'],
            ['kelas_id' => $tkA->id, 'hari' => 'Jumat',  'jam_mulai' => '11:00', 'jam_selesai' => null,    'kegiatan' => 'Penutup & Pulang',            'keterangan' => 'Doa bersama dan pulang'],

            // ── TK A & TK B  Sabtu ───────────────────────────────────────
            ['kelas_id' => $tkA->id, 'hari' => 'Sabtu',  'jam_mulai' => '07:00', 'jam_selesai' => '07:15', 'kegiatan' => 'Kedatangan & Doa Pagi',      'keterangan' => 'Menyapa guru, berdoa bersama'],
            ['kelas_id' => $tkA->id, 'hari' => 'Sabtu',  'jam_mulai' => '07:15', 'jam_selesai' => '07:30', 'kegiatan' => 'Kegiatan Pembukaan',          'keterangan' => 'Menyanyi, senam pagi, diskusi tema hari ini'],
            ['kelas_id' => $tkA->id, 'hari' => 'Sabtu',  'jam_mulai' => '07:30', 'jam_selesai' => '08:30', 'kegiatan' => 'Kegiatan Inti',               'keterangan' => 'Makan bersama / Ekstra Karate / Jalan-jalan'],
            ['kelas_id' => $tkA->id, 'hari' => 'Sabtu',  'jam_mulai' => '08:30', 'jam_selesai' => '09:00', 'kegiatan' => 'Istirahat & Makan Bekal',     'keterangan' => 'Makan bersama, cuci tangan'],
            ['kelas_id' => $tkA->id, 'hari' => 'Sabtu',  'jam_mulai' => '09:00', 'jam_selesai' => null,    'kegiatan' => 'Penutup & Pulang',            'keterangan' => 'Doa bersama dan pulang'],

            ['kelas_id' => $tkB->id, 'hari' => 'Sabtu',  'jam_mulai' => '07:00', 'jam_selesai' => '07:15', 'kegiatan' => 'Kedatangan & Doa Pagi',      'keterangan' => 'Menyapa guru, berdoa bersama'],
            ['kelas_id' => $tkB->id, 'hari' => 'Sabtu',  'jam_mulai' => '07:15', 'jam_selesai' => '07:30', 'kegiatan' => 'Kegiatan Pembukaan',          'keterangan' => 'Menyanyi, senam pagi, diskusi tema hari ini'],
            ['kelas_id' => $tkB->id, 'hari' => 'Sabtu',  'jam_mulai' => '07:30', 'jam_selesai' => '08:30', 'kegiatan' => 'Kegiatan Inti',               'keterangan' => 'Makan bersama / Ekstra Karate / Jalan-jalan'],
            ['kelas_id' => $tkB->id, 'hari' => 'Sabtu',  'jam_mulai' => '08:30', 'jam_selesai' => '09:00', 'kegiatan' => 'Istirahat & Makan Bekal',     'keterangan' => 'Makan bersama, cuci tangan'],
            ['kelas_id' => $tkB->id, 'hari' => 'Sabtu',  'jam_mulai' => '09:00', 'jam_selesai' => null,    'kegiatan' => 'Penutup & Pulang',            'keterangan' => 'Doa bersama dan pulang'],
        ];

        foreach ($jadwals as $jadwal) {
            JadwalPelajaran::firstOrCreate(
                [
                    'kelas_id'   => $jadwal['kelas_id'],
                    'hari'       => $jadwal['hari'],
                    'jam_mulai'  => $jadwal['jam_mulai'],
                    'kegiatan'   => $jadwal['kegiatan'],
                ],
                [
                    'jam_selesai' => $jadwal['jam_selesai'],
                    'keterangan'  => $jadwal['keterangan'],
                ]
            );
        }
    }
}
