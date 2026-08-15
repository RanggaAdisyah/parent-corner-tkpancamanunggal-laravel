<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PengumumanNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $namaOrtu,
        public string $judul,
        public string $isiPesan,
        public bool $hasLampiran,
        public string $urlDetail,
        public string $event = 'created',
    ) {}

    public function envelope(): Envelope
    {
        $prefix = $this->event === 'updated' ? '🔄 Pengumuman Diperbarui' : '📢 Pengumuman Baru';
        return new Envelope(
            subject: "{$prefix}: {$this->judul}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.pengumuman-notification',
            with: [
                'namaOrtu' => $this->namaOrtu,
                'judul' => $this->judul,
                'isiPesan' => $this->isiPesan,
                'hasLampiran' => $this->hasLampiran,
                'urlDetail' => $this->urlDetail,
                'event' => $this->event,
            ],
        );
    }
}
