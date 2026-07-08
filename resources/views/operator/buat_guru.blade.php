<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Tambah Akun Guru - Operator Panel</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/daftar_pengumuman.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/dashboard_master.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/Operator/buat_pengumuman.css') }}">
    <style>
        .buat-wali-page { max-width: 860px; margin: 0 auto; padding: 32px 24px 48px; }
        .page-back { display: inline-flex; align-items: center; gap: 8px; color: #64748b; font-size: 14px; font-weight: 500; margin-bottom: 24px; text-decoration: none; transition: color 0.15s; }
        .page-back:hover { color: #3b82f6; }
        .page-back svg { flex-shrink: 0; }
        
        .form-layout { display: flex; flex-direction: column; gap: 40px; }
        .responsive-container { padding: 32px; background: #ffffff; margin: 24px 32px; border-radius: 12px; border: 1px solid #e2e8f0; }
        
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        @media (max-width: 768px) {
            .responsive-container { padding: 20px; margin: 16px; }
            .form-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="dashboard-guru buat-wali">
        @include('partials.sidebar', ['active' => 'akun-guru'])

        <main class="main">
            <header class="page-header" style="flex-direction: column; align-items: flex-start; gap: 16px;">
                <a href="{{ route('operator.kelola-guru') }}" class="page-back">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                    Kembali
                </a>
                <div class="header-left">
                    <h1 class="header-title">Tambah Akun Guru Baru</h1>
                    <p class="header-subtitle">Lengkapi data pribadi dan kredensial login guru.</p>
                </div>
            </header>

            <div class="responsive-container">
                @if ($errors->any())
                    <div style="background-color: #fee2e2; border: 1px solid #ef4444; color: #b91c1c; padding: 16px; border-radius: 8px; margin-bottom: 24px;">
                        <ul style="margin: 0; padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('operator.kelola-guru.store') }}">
                    @csrf
                    
                    <div class="form-layout">
                        <!-- Step 1: Login -->
                        <div>
                            <h2 style="font-size: 16px; font-weight: 700; margin-bottom: 24px; display: flex; align-items: center; gap: 8px;">
                                <div style="width: 28px; height: 28px; background: #0ea5e9; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px;">1</div>
                                Akun Login
                            </h2>
                            
                            <div class="form-grid">
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label class="form-label" style="display:block; margin-bottom:8px; font-weight:600; font-size:14px;">Nomor HP (WhatsApp) / Username <span style="color:#ef4444">*</span></label>
                                    <input type="text" name="no_hp" class="form-input" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; background:#f8fafc;" placeholder="Contoh: 081234567890" required value="{{ old('no_hp') }}" />
                                </div>
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label class="form-label" style="display:block; margin-bottom:8px; font-weight:600; font-size:14px;">Email <span style="color:#ef4444">*</span></label>
                                    <input type="email" name="email" class="form-input" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; background:#f8fafc;" placeholder="guru@sekolah.com" required value="{{ old('email') }}" />
                                </div>
                            </div>
                            
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label class="form-label" style="display:block; margin-bottom:8px; font-weight:600; font-size:14px;">Password <span style="color:#ef4444">*</span></label>
                                <input type="password" name="password" class="form-input" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; background:#f8fafc;" placeholder="Minimal 6 karakter" required />
                            </div>
                        </div>

                        <hr style="border:none; border-top:1px solid #e2e8f0; margin: 0;">

                        <!-- Step 2: Identitas -->
                        <div>
                            <h2 style="font-size: 16px; font-weight: 700; margin-bottom: 24px; display: flex; align-items: center; gap: 8px;">
                                <div style="width: 28px; height: 28px; background: #0ea5e9; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px;">2</div>
                                Informasi Pribadi
                            </h2>

                            <div class="form-grid">
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label class="form-label" style="display:block; margin-bottom:8px; font-weight:600; font-size:14px;">Nama Lengkap <span style="color:#ef4444">*</span></label>
                                    <input type="text" name="nama_lengkap" class="form-input" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; background:#f8fafc;" placeholder="Nama lengkap beserta gelar" required value="{{ old('nama_lengkap') }}" />
                                </div>
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label class="form-label" style="display:block; margin-bottom:8px; font-weight:600; font-size:14px;">Jabatan</label>
                                    <input type="text" name="jabatan" class="form-input" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; background:#f8fafc;" placeholder="Contoh: Guru Kelas, Kepala Sekolah" value="{{ old('jabatan') }}" />
                                </div>
                            </div>

                            <div class="form-grid">
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label class="form-label" style="display:block; margin-bottom:8px; font-weight:600; font-size:14px;">NIP / Kode Guru</label>
                                    <input type="text" name="nip" class="form-input" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; background:#f8fafc;" placeholder="Masukkan NIP" value="{{ old('nip') }}" />
                                </div>
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label class="form-label" style="display:block; margin-bottom:8px; font-weight:600; font-size:14px;">Wali Kelas</label>
                                    <select name="kelas_id" class="form-input" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; background:#f8fafc; appearance: auto;">
                                        <option value="">-- Bukan Wali Kelas --</option>
                                        @foreach($kelasList as $kelas)
                                            <option value="{{ $kelas->id }}" {{ old('kelas_id') == $kelas->id ? 'selected' : '' }}>{{ $kelas->tingkat }} - {{ $kelas->nama_kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-grid">
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label class="form-label" style="display:block; margin-bottom:8px; font-weight:600; font-size:14px;">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-input" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; background:#f8fafc; appearance: auto;">
                                        <option value="">-- Pilih --</option>
                                        <option value="Laki-Laki" {{ old('jenis_kelamin') == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label class="form-label" style="display:block; margin-bottom:8px; font-weight:600; font-size:14px;">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-input" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; background:#f8fafc;" value="{{ old('tanggal_lahir') }}" />
                                </div>
                            </div>
                            
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label class="form-label" style="display:block; margin-bottom:8px; font-weight:600; font-size:14px;">Alamat Domisili</label>
                                <textarea name="alamat" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; background:#f8fafc; min-height:80px;" placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                            </div>
                        </div>

                    </div>

                    <!-- Footer -->
                    <div style="margin-top: 40px; padding-top: 24px; border-top: 1px solid #e2e8f0; display: flex; justify-content: flex-end; gap: 16px;">
                        <a href="{{ route('operator.kelola-guru') }}" style="padding: 12px 24px; border: 1px solid #cbd5e1; background: #fff; color: #475569; font-weight: 600; border-radius: 8px; text-decoration: none; display: flex; align-items: center;">Batal</a>
                        <button type="submit" style="padding: 12px 24px; background: #3b82f6; color: white; border: none; font-weight: 600; border-radius: 8px; cursor: pointer;">Simpan Akun Guru</button>
                    </div>
                </form>
            </div>
            @include('partials.footer')
        </main>
    </div>
</body>
</html>
