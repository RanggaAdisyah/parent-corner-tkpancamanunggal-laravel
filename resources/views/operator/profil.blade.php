<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Profil - Portal Operator | TK Panca Manunggal</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/operator/dashboard.css') }}">
</head>
<body>
    <div class="dashboard-operator">
        @include('partials.sidebar', ['active' => 'profil'])

        <main class="main">
            <div>
                <div style="margin-bottom: 16px;">
                <h1 style="font-size: 24px; font-weight: 700; color: #1e293b; margin: 0;">Profil Operator</h1>
                <p style="font-size: 14px; color: #64748b; margin: 4px 0 0 0;">Kelola informasi akun Anda</p>
            </div>



            <div style="background: white; padding: 32px; border-radius: 12px; border: 1px solid #e2e8f0;">
                <div style="display:flex; align-items:center; gap: 20px; margin-bottom: 32px;">
                    <div style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #f59e0b, #d97706); color: white; display:flex; align-items:center; justify-content:center; font-size: 32px; font-weight:bold; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h2 style="margin: 0; font-size: 24px; color: #1e293b;">{{ $user->name }}</h2>
                        <p style="margin: 4px 0 0; color: #64748b; font-size: 15px;">Admin Operator</p>
                    </div>
                </div>

                <hr style="border:none; border-top: 1px solid #f1f5f9; margin: 32px 0;">

                <form action="{{ route('operator.profil.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div style="max-width: 600px;">
                        <h3 style="font-size: 16px; color: #0f172a; margin-bottom: 20px;">Informasi Akun</h3>
                        
                        <div style="margin-bottom: 20px;">
                            <label style="display:block; font-weight: 500; color: #475569; margin-bottom: 8px; font-size: 14px;">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 15px; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#f59e0b'" onblur="this.style.borderColor='#cbd5e1'">
                            @error('email')
                                <div style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr style="border:none; border-top: 1px solid #f1f5f9; margin: 32px 0;">

                        <h3 style="font-size: 16px; color: #0f172a; margin-bottom: 20px;">Ubah Password</h3>
                        <p style="color: #64748b; font-size: 14px; margin-bottom: 20px;">Biarkan kosong jika tidak ingin mengubah password.</p>

                        <div style="margin-bottom: 20px;">
                            <label style="display:block; font-weight: 500; color: #475569; margin-bottom: 8px; font-size: 14px;">Password Baru</label>
                            <input type="password" name="password" style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 15px; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#f59e0b'" onblur="this.style.borderColor='#cbd5e1'">
                            @error('password')
                                <div style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div style="margin-bottom: 32px;">
                            <label style="display:block; font-weight: 500; color: #475569; margin-bottom: 8px; font-size: 14px;">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 15px; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#f59e0b'" onblur="this.style.borderColor='#cbd5e1'">
                        </div>

                        <button type="submit" style="background: #f59e0b; color: white; border: none; padding: 12px 24px; border-radius: 8px; font-size: 15px; font-weight: 600; cursor: pointer; transition: background 0.2s;" onmouseover="this.style.background='#d97706'" onmouseout="this.style.background='#f59e0b'">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
            </div>
        </main>
    </div>
</body>
</html>
