<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GaleriNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $namaOrtu,
        public string $namaAnak,
        public string $judulGaleri,
        public string $kategori,
        public string $tanggalKegiatan,
        public ?string $deskripsi,
        public int $jumlahFoto,
        public string $urlDetail,
        public string $event = 'created',
    ) {}

    public function envelope(): Envelope
    {
        $prefix = $this->event === 'updated' ? '🔄 Galeri Diperbarui' : '📸 Galeri Baru';
        return new Envelope(
            subject: "{$prefix}: {$this->judulGaleri}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.galeri-notification',
            with: [
                'namaOrtu' => $this->namaOrtu,
                'namaAnak' => $this->namaAnak,
                'judulGaleri' => $this->judulGaleri,
                'kategori' => $this->kategori,
                'tanggalKegiatan' => $this->tanggalKegiatan,
                'deskripsi' => $this->deskripsi,
                'jumlahFoto' => $this->jumlahFoto,
                'urlDetail' => $this->urlDetail,
                'event' => $this->event,
            ],
        );
    }
}
