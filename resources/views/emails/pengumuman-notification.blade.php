<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $event === 'updated' ? 'Pengumuman Diperbarui' : 'Pengumuman Baru' }}</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background: #f1f5f9; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; }
        .header { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); padding: 32px 24px; text-align: center; }
        .header h1 { color: #ffffff; margin: 0; font-size: 22px; font-weight: 700; }
        .header p { color: #fef3c7; margin: 8px 0 0; font-size: 14px; }
        .body { padding: 32px 24px; }
        .greeting { font-size: 16px; color: #0f172a; margin: 0 0 16px; }
        .greeting strong { color: #d97706; }
        .card { background: #fffbeb; border: 1px solid #fde68a; border-radius: 12px; padding: 20px; margin: 20px 0; }
        .card-title { font-size: 18px; font-weight: 700; color: #0f172a; margin: 0 0 12px; }
        .description { color: #334155; line-height: 1.6; margin: 16px 0 0; font-size: 14px; }
        .lampiran-box { background: #ffffff; border: 1px solid #fde68a; border-radius: 8px; padding: 12px 16px; margin: 16px 0 0; display: flex; align-items: center; gap: 10px; }
        .lampiran-box svg { flex-shrink: 0; color: #d97706; }
        .lampiran-box span { color: #92400e; font-size: 13px; font-weight: 600; }
        .btn-container { text-align: center; margin: 32px 0 16px; }
        .btn { display: inline-block; padding: 14px 32px; background: #f59e0b; color: #ffffff !important; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 14px; }
        .footer { background: #f8fafc; padding: 20px 24px; text-align: center; border-top: 1px solid #e2e8f0; }
        .footer p { color: #64748b; font-size: 12px; margin: 4px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $event === 'updated' ? '🔄 Pengumuman Diperbarui' : '📢 Pengumuman Baru' }}</h1>
            <p>Parent Corner – {{ config('app.name') }}</p>
        </div>

        <div class="body">
            <p class="greeting">Halo <strong>{{ $namaOrtu }}</strong>,</p>

            @if($event === 'updated')
                <p>Ada pembaruan pengumuman untuk Anda:</p>
            @else
                <p>Ada pengumuman baru untuk Anda:</p>
            @endif

            <div class="card">
                <div class="card-title">{{ $judul }}</div>

                <div class="description">
                    {!! $isiPesan !!}
                </div>

                @if($hasLampiran)
                    <div class="lampiran-box">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg>
                        <span>Pengumuman ini memiliki lampiran. Klik tombol di bawah untuk melihat detail.</span>
                    </div>
                @endif
            </div>

            <div class="btn-container">
                <a href="{{ $urlDetail }}" class="btn">Lihat Pengumuman Selengkapnya</a>
            </div>

            <p style="color: #64748b; font-size: 13px; line-height: 1.6; margin-top: 24px;">
                Anda menerima email ini karena terdaftar sebagai orang tua/wali siswa di Parent Corner.
            </p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p>Email ini dikirim otomatis oleh sistem, mohon tidak membalas.</p>
        </div>
    </div>
</body>
</html>
