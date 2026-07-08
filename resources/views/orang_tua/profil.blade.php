<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Profil - Portal Orang Tua | TK Panca Manunggal</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/dashboard_master.css') }}">
<body>
    <div class="dashboard-guru">
        @include('partials.sidebar_orang_tua', ['active' => 'profil'])

        <main class="main">
            <div>
                <div style="margin-bottom: 16px;">
                <h1 style="font-size: 24px; font-weight: 700; color: #1e293b; margin: 0;">Profil Pengguna</h1>
                <p style="font-size: 14px; color: #64748b; margin: 4px 0 0 0;">Informasi akun dan data terkait</p>
            </div>
            
            <div style="background: white; padding: 24px; border-radius: 12px; border: 1px solid #e2e8f0;">
                <div style="display:flex; align-items:center; gap: 20px; margin-bottom: 24px;">
                    <div style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; display:flex; align-items:center; justify-content:center; font-size: 32px; font-weight:bold; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h2 style="margin: 0; font-size: 20px; color: #1e293b;">{{ $user->name }}</h2>
                        <p style="margin: 4px 0 0; color: #64748b; font-size: 14px;">Orang Tua / Wali Siswa</p>
                    </div>
                </div>
                
                <hr style="border:none; border-top: 1px solid #f1f5f9; margin: 24px 0;">
                
                {{-- Data Akun --}}
                <h3 style="font-size: 16px; color: #3b82f6; margin-bottom: 16px;">Informasi Akun</h3>
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

                {{-- Data Orang Tua --}}
                @if($orangTua)
                <h3 style="font-size: 16px; color: #3b82f6; margin-bottom: 16px;">Data Orang Tua</h3>
                <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 24px; margin-bottom: 32px; background: #f8fafc; padding: 20px; border-radius: 8px;">
                    <div>
                        <label style="display:block; color: #94a3b8; font-size: 13px; font-weight: 500; margin-bottom: 6px;">Nama Ayah</label>
                        <div style="font-size: 15px; font-weight: 600; color: #334155;">{{ $orangTua->nama_ayah ?? '-' }}</div>
                    </div>
                    <div>
                        <label style="display:block; color: #94a3b8; font-size: 13px; font-weight: 500; margin-bottom: 6px;">Nama Ibu</label>
                        <div style="font-size: 15px; font-weight: 600; color: #334155;">{{ $orangTua->nama_ibu ?? '-' }}</div>
                    </div>
                    <div>
                        <label style="display:block; color: #94a3b8; font-size: 13px; font-weight: 500; margin-bottom: 6px;">No. WhatsApp / HP</label>
                        <div style="font-size: 15px; font-weight: 600; color: #334155;">{{ $orangTua->no_hp ?? '-' }}</div>
                    </div>
                    <div style="grid-column: 1 / -1;">
                        <label style="display:block; color: #94a3b8; font-size: 13px; font-weight: 500; margin-bottom: 6px;">Alamat Domisili</label>
                        <div style="font-size: 15px; font-weight: 600; color: #334155;">{{ $orangTua->alamat ?? '-' }}</div>
                    </div>
                </div>
                @endif

                {{-- Data Anak --}}
                <h3 style="font-size: 16px; color: #3b82f6; margin-bottom: 16px;">Data Siswa</h3>
                @if($siswas && $siswas->count() > 0)
                    @foreach($siswas as $siswa)
                    <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 24px; background: #f8fafc; padding: 20px; border-radius: 8px; margin-bottom: 16px;">
                        <div>
                            <label style="display:block; color: #94a3b8; font-size: 13px; font-weight: 500; margin-bottom: 6px;">Nama Lengkap Siswa</label>
                            <div style="font-size: 15px; font-weight: 600; color: #334155;">{{ $siswa->nama }}</div>
                        </div>
                        <div>
                            <label style="display:block; color: #94a3b8; font-size: 13px; font-weight: 500; margin-bottom: 6px;">NIS</label>
                            <div style="font-size: 15px; font-weight: 600; color: #334155;">{{ $siswa->nis ?? '-' }}</div>
                        </div>
                        <div>
                            <label style="display:block; color: #94a3b8; font-size: 13px; font-weight: 500; margin-bottom: 6px;">Kelas</label>
                            <div style="font-size: 15px; font-weight: 600; color: #334155;">{{ $siswa->kelasLokal ? $siswa->kelasLokal->tingkat . ' - ' . $siswa->kelasLokal->nama_kelas : ($siswa->kelas ?? '-') }}</div>
                        </div>
                        <div>
                            <label style="display:block; color: #94a3b8; font-size: 13px; font-weight: 500; margin-bottom: 6px;">Jenis Kelamin</label>
                            <div style="font-size: 15px; font-weight: 600; color: #334155;">{{ $siswa->jenis_kelamin ?? '-' }}</div>
                        </div>
                        <div>
                            <label style="display:block; color: #94a3b8; font-size: 13px; font-weight: 500; margin-bottom: 6px;">Tanggal Lahir</label>
                            <div style="font-size: 15px; font-weight: 600; color: #334155;">{{ $siswa->tanggal_lahir ? \Carbon\Carbon::parse($siswa->tanggal_lahir)->translatedFormat('d F Y') : '-' }}</div>
                        </div>
                    </div>
                    @endforeach
                @else
                <div style="padding: 20px; background: #fff1f2; color: #be123c; border-radius: 8px; font-size: 14px;">
                    Belum ada data siswa yang ditautkan ke akun ini.
                </div>
                @endif
            </div>
            
            @include('partials.footer')
        </main>
    </div>
</body>
</html>
