<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Profil - Portal Guru | TK Panca Manunggal</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/dashboard.css') }}">
</head>
<body>
    <div class="dashboard-guru">
        @include('partials.sidebar_guru', ['active' => 'profil'])

        <main class="main">
            <div>
                <div style="margin-bottom: 16px;">
                <h1 style="font-size: 24px; font-weight: 700; color: #1e293b; margin: 0;">Profil Guru</h1>
                <p style="font-size: 14px; color: #64748b; margin: 4px 0 0 0;">Kelola informasi akun Anda</p>
            </div>

            <div style="background: white; padding: 24px; border-radius: 12px; border: 1px solid #e2e8f0;">
                <div style="display:flex; align-items:center; gap: 20px; margin-bottom: 24px;">
                    <div style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #6366f1, #8b5cf6); color: white; display:flex; align-items:center; justify-content:center; font-size: 32px; font-weight:bold; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h2 style="margin: 0; font-size: 20px; color: #1e293b;">{{ $user->name }}</h2>
                        <p style="margin: 4px 0 0; color: #64748b; font-size: 14px;">Guru</p>
                    </div>
                </div>

                <hr style="border:none; border-top: 1px solid #f1f5f9; margin: 24px 0;">

                {{-- Data Akun --}}
                <h3 style="font-size: 16px; color: #6366f1; margin-bottom: 16px;">Informasi Akun</h3>
                <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 24px; margin-bottom: 32px;">
                    <div>
                        <label style="display:block; color: #94a3b8; font-size: 13px; font-weight: 500; margin-bottom: 6px;">Username / ID Login</label>
                        <div style="font-size: 15px; font-weight: 600; color: #334155;">{{ $user->username ?? '-' }}</div>
                    </div>
                    <div>
                        <label style="display:block; color: #94a3b8; font-size: 13px; font-weight: 500; margin-bottom: 6px;">Email</label>
                        <div style="font-size: 15px; font-weight: 600; color: #334155;">{{ $user->email ?? 'Tidak ada email tersimpan' }}</div>
                    </div>
                </div>

                {{-- Data Guru --}}
                @if($guru)
                <h3 style="font-size: 16px; color: #6366f1; margin-bottom: 16px;">Data Guru</h3>
                <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 24px; background: #f8fafc; padding: 20px; border-radius: 8px;">
                    <div>
                        <label style="display:block; color: #94a3b8; font-size: 13px; font-weight: 500; margin-bottom: 6px;">Nama Lengkap</label>
                        <div style="font-size: 15px; font-weight: 600; color: #334155;">{{ $guru->nama_lengkap ?? '-' }}</div>
                    </div>
                    <div>
                        <label style="display:block; color: #94a3b8; font-size: 13px; font-weight: 500; margin-bottom: 6px;">NIP / NUPTK</label>
                        <div style="font-size: 15px; font-weight: 600; color: #334155;">{{ $guru->nip ?? '-' }}</div>
                    </div>
                    <div>
                        <label style="display:block; color: #94a3b8; font-size: 13px; font-weight: 500; margin-bottom: 6px;">Jabatan</label>
                        <div style="font-size: 15px; font-weight: 600; color: #334155;">{{ $guru->jabatan ?? '-' }}</div>
                    </div>
                    <div>
                        <label style="display:block; color: #94a3b8; font-size: 13px; font-weight: 500; margin-bottom: 6px;">Kelas Diampu</label>
                        <div style="font-size: 15px; font-weight: 600; color: #334155;">{{ $guru->kelas ? $guru->kelas->tingkat . ' - ' . $guru->kelas->nama_kelas : '-' }}</div>
                    </div>
                    <div>
                        <label style="display:block; color: #94a3b8; font-size: 13px; font-weight: 500; margin-bottom: 6px;">Jenis Kelamin</label>
                        <div style="font-size: 15px; font-weight: 600; color: #334155;">{{ $guru->jenis_kelamin ?? '-' }}</div>
                    </div>
                    <div>
                        <label style="display:block; color: #94a3b8; font-size: 13px; font-weight: 500; margin-bottom: 6px;">Tanggal Lahir</label>
                        <div style="font-size: 15px; font-weight: 600; color: #334155;">{{ $guru->tanggal_lahir ? \Carbon\Carbon::parse($guru->tanggal_lahir)->translatedFormat('d F Y') : '-' }}</div>
                    </div>
                    <div>
                        <label style="display:block; color: #94a3b8; font-size: 13px; font-weight: 500; margin-bottom: 6px;">No. WhatsApp</label>
                        <div style="font-size: 15px; font-weight: 600; color: #334155;">{{ $guru->no_hp ?? '-' }}</div>
                    </div>
                    <div style="grid-column: 1 / -1;">
                        <label style="display:block; color: #94a3b8; font-size: 13px; font-weight: 500; margin-bottom: 6px;">Alamat</label>
                        <div style="font-size: 15px; font-weight: 600; color: #334155;">{{ $guru->alamat ?? '-' }}</div>
                    </div>
                </div>
                @endif
            </div>
            </div>
        </main>
    </div>
</body>
</html>
