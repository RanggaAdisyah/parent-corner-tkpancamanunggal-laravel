<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

\DB::table('jobs')->truncate();
\App\Models\NotificationLog::truncate();

$guru = \App\Models\Guru::with('user')->whereHas('kelas')->first();
$pengumuman = \App\Models\Pengumuman::create([
    'judul' => '[FIXED MODAL] ' . now()->format('H:i:s'),
    'isi_pesan' => 'Sekarang link harusnya auto-open modal.',
    'lampiran' => null,
]);
$pengumuman->kelas()->attach($guru->kelas_id);

echo "Pengumuman dibuat dengan ID: {$pengumuman->id}\n";
echo "URL: " . url('/orang-tua/lihat-pengumuman?focus=' . $pengumuman->id) . "\n\n";

$resolver = new \App\Services\NotificationRecipientResolver();
$recipients = $resolver->forPengumuman($pengumuman);

foreach ($recipients as $user) {
    \App\Jobs\SendPengumumanNotificationJob::dispatch(
        $pengumuman->id, $user->id, $user->email, $user->name ?? 'Ortu', 'created'
    );
}

echo "Dispatched " . $recipients->count() . " job(s). Processing...\n";
shell_exec('php artisan queue:work --stop-when-empty --tries=1 2>&1');

echo "\n=== Logs ===\n";
foreach (\App\Models\NotificationLog::all() as $l) {
    echo "  [{$l->status}] {$l->recipient_email} | ID:{$l->notifiable_id} | {$l->subject}\n";
}

echo "\n>>> PENTING: Jangan hapus pengumuman ini sebelum dites!\n";
echo ">>> Buka Gmail → email '[FIXED MODAL]' → klik link → modal harusnya auto-open\n";
