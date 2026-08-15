<?php

namespace App\Jobs;

use App\Mail\GaleriNotificationMail;
use App\Models\Galeri;
use App\Models\NotificationLog;
use App\Models\Siswa;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendGaleriNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $backoff = 60; // retry tiap 60 detik

    public function __construct(
        public int $galeriId,
        public int $userId,
        public string $userEmail,
        public string $namaOrtu,
        public string $event = 'created',
    ) {}

    public function handle(): void
    {
        $galeri = Galeri::with('siswa', 'kelas')->find($this->galeriId);
        if (!$galeri) {
            return;
        }

        // Tentukan nama anak (untuk personal) atau nama kelas
        $namaAnak = 'Seluruh Siswa';
        if ($galeri->siswa->isNotEmpty()) {
            $namaAnak = $galeri->siswa->pluck('nama')->implode(', ');
        } elseif ($galeri->kelas->isNotEmpty()) {
            $namaAnak = $galeri->kelas->pluck('nama_kelas')->implode(', ');
        }

        $kategori = is_array($galeri->kategori) ? implode(', ', $galeri->kategori) : 'Umum';
        $tanggal = $galeri->tanggal_kegiatan ? \Carbon\Carbon::parse($galeri->tanggal_kegiatan)->translatedFormat('d F Y') : '-';
        $jumlahFoto = is_array($galeri->foto) ? count($galeri->foto) : 0;
        $url = url('/orang-tua/foto-kegiatan?focus=' . $galeri->id);

        // Log: pending
        $log = NotificationLog::create([
            'type' => 'galeri',
            'event' => $this->event,
            'notifiable_id' => $galeri->id,
            'recipient_id' => $this->userId,
            'recipient_email' => $this->userEmail,
            'subject' => ($this->event === 'updated' ? '🔄 Galeri Diperbarui' : '📸 Galeri Baru') . ': ' . $galeri->judul,
            'status' => 'pending',
        ]);

        try {
            Mail::to($this->userEmail)->send(new GaleriNotificationMail(
                namaOrtu: $this->namaOrtu,
                namaAnak: $namaAnak,
                judulGaleri: $galeri->judul,
                kategori: $kategori,
                tanggalKegiatan: $tanggal,
                deskripsi: $galeri->deskripsi,
                jumlahFoto: $jumlahFoto,
                urlDetail: $url,
                event: $this->event,
            ));

            $log->update([
                'status' => 'sent',
                'sent_at' => now(),
            ]);
        } catch (\Exception $e) {
            $log->update([
                'status' => 'failed',
                'error_message' => $e->getMessage(),
            ]);
            throw $e; // trigger retry
        }
    }
}
