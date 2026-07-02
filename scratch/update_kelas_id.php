<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$siswas = App\Models\Siswa::all();
foreach($siswas as $siswa) {
    if ($siswa->kelas) {
        $parts = explode(' - ', $siswa->kelas);
        if (count($parts) == 2) {
            $kelas = App\Models\Kelas::where('tingkat', trim($parts[0]))->where('nama_kelas', trim($parts[1]))->first();
            if ($kelas) {
                $siswa->kelas_id = $kelas->id;
                $siswa->save();
                echo "Updated {$siswa->nama} with kelas_id {$kelas->id}\n";
            }
        }
    }
}
