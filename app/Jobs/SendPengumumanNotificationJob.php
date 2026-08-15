<?php

namespace App\Jobs;

use App\Mail\PengumumanNotificationMail;
use App\Models\NotificationLog;
use App\Models\Pengumuman;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendPengumumanNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $backoff = 60;

    public function __construct(
        public int $pengumumanId,
        public int $userId,
        public string $userEmail,
        public string $namaOrtu,
        public string $event = 'created',
    ) {}

    public function handle(): void
    {
        $pengumuman = Pengumuman::find($this->pengumumanId);
        if (!$pengumuman) {
            return;
        }

        $hasLampiran = is_array($pengumuman->lampiran) && count($pengumuman->lampiran) > 0;
        // Pakai query ?focus=ID → list view auto-open modal
        $url = url('/orang-tua/lihat-pengumuman?focus=' . $pengumuman->id);

        $log = NotificationLog::create([
            'type' => 'pengumuman',
            'event' => $this->event,
            'notifiable_id' => $pengumuman->id,
            'recipient_id' => $this->userId,
            'recipient_email' => $this->userEmail,
            'subject' => ($this->event === 'updated' ? '🔄 Pengumuman Diperbarui' : '📢 Pengumuman Baru') . ': ' . $pengumuman->judul,
            'status' => 'pending',
        ]);

        try {
            Mail::to($this->userEmail)->send(new PengumumanNotificationMail(
                namaOrtu: $this->namaOrtu,
                judul: $pengumuman->judul,
                isiPesan: $pengumuman->isi_pesan,
                hasLampiran: $hasLampiran,
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
            throw $e;
        }
    }
}
