<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $event === 'updated' ? 'Galeri Diperbarui' : 'Galeri Baru' }}</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background: #f1f5f9; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; }
        .header { background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%); padding: 32px 24px; text-align: center; }
        .header h1 { color: #ffffff; margin: 0; font-size: 22px; font-weight: 700; }
        .header p { color: #e0f2fe; margin: 8px 0 0; font-size: 14px; }
        .body { padding: 32px 24px; }
        .greeting { font-size: 16px; color: #0f172a; margin: 0 0 16px; }
        .greeting strong { color: #0284c7; }
        .badge { display: inline-block; padding: 4px 12px; border-radius: 9999px; font-size: 12px; font-weight: 600; }
        .badge-update { background: #fef3c7; color: #92400e; }
        .badge-new { background: #dbeafe; color: #1e40af; }
        .card { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; margin: 20px 0; }
        .card-title { font-size: 18px; font-weight: 700; color: #0f172a; margin: 0 0 12px; }
        .meta { display: flex; flex-wrap: wrap; gap: 12px; margin: 12px 0; }
        .meta-item { display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 13px; color: #475569; }
        .meta-item svg { flex-shrink: 0; }
        .description { color: #334155; line-height: 1.6; margin: 16px 0 0; font-size: 14px; }
        .btn-container { text-align: center; margin: 32px 0 16px; }
        .btn { display: inline-block; padding: 14px 32px; background: #0ea5e9; color: #ffffff !important; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 14px; }
        .footer { background: #f8fafc; padding: 20px 24px; text-align: center; border-top: 1px solid #e2e8f0; }
        .footer p { color: #64748b; font-size: 12px; margin: 4px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $event === 'updated' ? '🔄 Galeri Diperbarui' : '📸 Galeri Baru' }}</h1>
            <p>Parent Corner – {{ config('app.name') }}</p>
        </div>

        <div class="body">
            <p class="greeting">Halo <strong>{{ $namaOrtu }}</strong>,</p>

            @if($event === 'updated')
                <p>Ada pembaruan pada galeri kegiatan untuk <strong>{{ $namaAnak }}</strong>:</p>
            @else
                <p>Ada galeri kegiatan baru untuk <strong>{{ $namaAnak }}</strong>:</p>
            @endif

            <div class="card">
                <div class="card-title">{{ $judulGaleri }}</div>

                <div class="meta">
                    <div class="meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        {{ $tanggalKegiatan }}
                    </div>
                    <div class="meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                        {{ $kategori }}
                    </div>
                    <div class="meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                        {{ $jumlahFoto }} foto
                    </div>
                </div>

                @if($deskripsi)
                    <div class="description">{!! $deskripsi !!}</div>
                @endif
            </div>

            <div class="btn-container">
                <a href="{{ $urlDetail }}" class="btn">Lihat Galeri Selengkapnya</a>
            </div>

            <p style="color: #64748b; font-size: 13px; line-height: 1.6; margin-top: 24px;">
                Anda menerima email ini karena <strong>{{ $namaAnak }}</strong> terdaftar di kelas terkait.
            </p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p>Email ini dikirim otomatis oleh sistem, mohon tidak membalas.</p>
        </div>
    </div>
</body>
</html>
