<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$siswa = \App\Models\Siswa::where('nama', 'like', '%Anak Lengkap%')->first();

$today = \Carbon\Carbon::now();
$bulan = (int) $today->format('n');
$minggu = (int) ceil($today->day / 7);

echo "Today: " . $today->format('Y-m-d') . "\n";
echo "Derived bulan: $bulan, minggu_ke: $minggu\n\n";

$rows = \App\Models\Nilai::where('siswa_id', $siswa->id)
    ->whereIn('level', array_keys(\App\Models\Nilai::kategoriList()))
    ->where('bulan', $bulan)
    ->where('minggu_ke', $minggu)
    ->get();

echo "Found records: " . $rows->count() . "\n";
foreach ($rows as $n) {
    echo "  - {$n->tanggal->format('Y-m-d')} | {$n->level} | {$n->nilai} | bulan={$n->bulan} minggu_ke={$n->minggu_ke}\n";
}
