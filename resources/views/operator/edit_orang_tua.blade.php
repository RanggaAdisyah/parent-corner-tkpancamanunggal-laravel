<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Edit Akun Orang Tua - Operator Panel</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/pengumuman_master.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/dashboard_master.css') }}">
    <style>
        .buat-orang-tua-page { max-width: 860px; margin: 0 auto; padding: 32px 24px 48px; }
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
        
        .autocomplete-items { position: absolute; border: 1px solid #e2e8f0; border-bottom: none; border-top: none; z-index: 99; top: 100%; left: 0; right: 0; background-color: #fff; border-radius: 0 0 8px 8px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); overflow: hidden; }
        .autocomplete-items div { padding: 10px; cursor: pointer; border-bottom: 1px solid #e2e8f0; font-size: 14px; }
        .autocomplete-items div:hover { background-color: #f8fafc; color: #3b82f6; }
        .siswa-row { margin-bottom: 16px; position: relative; }
        .btn-tambah-siswa { display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; background: #f1f5f9; color: #475569; border: 1px dashed #cbd5e1; border-radius: 8px; font-size: 14px; cursor: pointer; font-weight: 500; transition: all 0.2s; }
        .btn-tambah-siswa:hover { background: #e2e8f0; color: #1e293b; border-color: #94a3b8; }
        .btn-tambah-siswa:disabled { opacity: 0.5; cursor: not-allowed; }
    </style>
</head>
<body>
    <div class="dashboard-guru buat-orang-tua">
        @include('partials.sidebar', ['active' => 'akun_orang_tua'])

        <main class="main">
            <header class="page-header" style="flex-direction: column; align-items: flex-start; gap: 16px;">
                <a href="{{ route('operator.kelola_orang_tua') }}" class="page-back">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                    Kembali
                </a>
                <div class="header-left">
                    <h1 class="header-title">Ubah Akun Orang Tua</h1>
                    <p class="header-subtitle">Perbarui data Orang Tua dan kelola tautan anak.</p>
                </div>
            </header>

            <div class="responsive-container">
                <form method="POST" action="{{ route('operator.kelola_orang_tua.update', $orangTua->user_id) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-layout">
                        <!-- Step 1: Login -->
                        <div>
                            <h2 style="font-size: 16px; font-weight: 700; margin-bottom: 24px; display: flex; align-items: center; gap: 8px;">
                                <div style="width: 28px; height: 28px; background: #0ea5e9; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px;">1</div>
                                Akun Login
                            </h2>
                            
                            <div class="form-grid">
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label class="form-label" style="display:block; margin-bottom:8px; font-weight:600; font-size:14px;">Nomor HP <span style="color:#ef4444">*</span></label>
                                    <input type="text" name="no_hp" class="form-input" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; background:#f8fafc;" placeholder="Contoh: 081234567890" required value="{{ old('no_hp', $orangTua->no_hp) }}" />
                                </div>
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label class="form-label" style="display:block; margin-bottom:8px; font-weight:600; font-size:14px;">Email <span style="color:#ef4444">*</span></label>
                                    <input type="email" name="email" class="form-input" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; background:#f8fafc;" placeholder="Contoh: bapak@email.com" required value="{{ old('email', $orangTua->user->email ?? '') }}" />
                                </div>
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label class="form-label" style="display:block; margin-bottom:8px; font-weight:600; font-size:14px;">Password Baru</label>
                                    <input type="password" name="password" class="form-input" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; background:#f8fafc;" placeholder="Kosongkan jika tidak diubah" />
                                </div>
                            </div>
                        </div>

                        <hr style="border:none; border-top:1px solid #e2e8f0; margin: 0;">

                        <!-- Step 2: Identitas -->
                        <div>
                            <h2 style="font-size: 16px; font-weight: 700; margin-bottom: 24px; display: flex; align-items: center; gap: 8px;">
                                <div style="width: 28px; height: 28px; background: #0ea5e9; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px;">2</div>
                                Data Orang Tua
                            </h2>

                            <div class="form-grid">
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label class="form-label" style="display:block; margin-bottom:8px; font-weight:600; font-size:14px;">Nama Ayah <span style="color:#ef4444">*</span></label>
                                    <input type="text" name="nama_ayah" class="form-input" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; background:#f8fafc;" placeholder="Nama Lengkap Ayah" required value="{{ old('nama_ayah', $orangTua->nama_ayah) }}" />
                                </div>
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label class="form-label" style="display:block; margin-bottom:8px; font-weight:600; font-size:14px;">Nama Ibu <span style="color:#ef4444">*</span></label>
                                    <input type="text" name="nama_ibu" class="form-input" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; background:#f8fafc;" placeholder="Nama Lengkap Ibu" required value="{{ old('nama_ibu', $orangTua->nama_ibu) }}" />
                                </div>
                            </div>
                            
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label class="form-label" style="display:block; margin-bottom:8px; font-weight:600; font-size:14px;">Alamat Domisili</label>
                                <textarea name="alamat" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; background:#f8fafc; min-height:80px;" placeholder="Masukkan alamat lengkap">{{ old('alamat', $orangTua->alamat) }}</textarea>
                            </div>
                        </div>
                        
                        <hr style="border:none; border-top:1px solid #e2e8f0; margin: 0;">

                        <!-- Step 3: Tautkan Anak -->
                        <div>
                            <h2 style="font-size: 16px; font-weight: 700; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                                <div style="width: 28px; height: 28px; background: #0ea5e9; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px;">3</div>
                                Kelola Tautan Siswa <span style="color:#ef4444">*</span>
                            </h2>
                            <p style="font-size:14px; color:#64748b; margin-bottom:24px;">Cari dan pilih siswa yang akan ditautkan ke akun Orang Tua ini. Maksimal 5 siswa (Siswa pertama wajib). Jika Anda menghapus baris siswa, tautan akan diputus.</p>

                            <div id="siswa-container">
                                @php
                                    $siswasTertaut = $orangTua->siswas;
                                    $count = count($siswasTertaut);
                                    if($count == 0) $count = 1;
                                @endphp
                                
                                @for($i = 0; $i < $count; $i++)
                                    <div class="siswa-row" id="row-siswa-{{ $i+1 }}">
                                        <label class="form-label" style="display:block; margin-bottom:8px; font-weight:600; font-size:14px;">Siswa {{ $i+1 }} {{ $i==0 ? '(Wajib)' : '(Opsional)' }} {!! $i==0 ? '<span style="color:#ef4444">*</span>' : '' !!}</label>
                                        <div style="position: relative; display:flex; gap:12px;">
                                            <div style="position:relative; flex:1;">
                                                <input type="text" class="form-input autocomplete-input" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; background:#f8fafc;" placeholder="Ketik nama siswa..." autocomplete="off" {{ $i==0 ? 'required' : '' }} value="{{ isset($siswasTertaut[$i]) ? $siswasTertaut[$i]->nama : '' }}" />
                                                <input type="hidden" name="siswa_id[]" class="siswa-hidden-id" {{ $i==0 ? 'required' : '' }} value="{{ isset($siswasTertaut[$i]) ? $siswasTertaut[$i]->id : '' }}">
                                                <div class="autocomplete-items"></div>
                                            </div>
                                            @if($i > 0)
                                            <button type="button" class="btn-hapus-row" style="background:none; border:none; cursor:pointer; color:#ef4444;" title="Hapus baris ini">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
                                            </button>
                                            @endif
                                        </div>
                                    </div>
                                @endfor
                            </div>
                            
                            <div style="margin-top: 16px;">
                                <button type="button" id="btn-tambah-siswa" class="btn-tambah-siswa" {{ $count >= 5 ? 'disabled' : '' }}>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                    Tambah Siswa Lain
                                </button>
                                <span id="max-siswa-msg" style="display:{{ $count >= 5 ? 'inline-block' : 'none' }}; font-size:12px; color:#ef4444; margin-left:8px;">Maksimal 5 siswa</span>
                            </div>
                        </div>

                    </div>

                    <!-- Footer -->
                    <div style="margin-top: 40px; padding-top: 24px; border-top: 1px solid #e2e8f0; display: flex; justify-content: flex-end; gap: 16px;">
                        <a href="{{ route('operator.kelola_orang_tua') }}" style="padding: 12px 24px; border: 1px solid #cbd5e1; background: #fff; color: #475569; font-weight: 600; border-radius: 8px; text-decoration: none; display: flex; align-items: center;">Batal</a>
                        <button type="submit" style="padding: 12px 24px; background: #3b82f6; color: white; border: none; font-weight: 600; border-radius: 8px; cursor: pointer;">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
            @include('partials.footer')
        </main>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let rowCount = {{ $count }};
            const maxRows = 5;
            const container = document.getElementById('siswa-container');
            const btnTambah = document.getElementById('btn-tambah-siswa');
            const maxMsg = document.getElementById('max-siswa-msg');

            // Fungsi Autocomplete
            function setupAutocomplete(inputEl, hiddenEl, listEl) {
                let timeout = null;
                inputEl.addEventListener('input', function() {
                    const query = this.value.trim();
                    listEl.innerHTML = '';
                    hiddenEl.value = ''; // Reset ID if user types something new
                    
                    if (query.length < 2) {
                        listEl.style.display = 'none';
                        return;
                    }

                    clearTimeout(timeout);
                    timeout = setTimeout(() => {
                        // Di form edit, kita mungkin juga memperbolehkan mencari siswa yang sudah tertaut
                        fetch('/api/siswa/search?q=' + encodeURIComponent(query))
                            .then(res => res.json())
                            .then(data => {
                                listEl.innerHTML = '';
                                if(data.length === 0) {
                                    listEl.innerHTML = '<div style="color:#ef4444;">Siswa tidak ditemukan atau sudah punya Orang Tua</div>';
                                } else {
                                    data.forEach(item => {
                                        const div = document.createElement('div');
                                        div.innerHTML = `<strong>${item.nama}</strong> <small style="color:#64748b;">(NIS: ${item.nis || '-'})</small>`;
                                        div.addEventListener('click', function() {
                                            inputEl.value = item.nama;
                                            hiddenEl.value = item.id;
                                            listEl.style.display = 'none';
                                        });
                                        listEl.appendChild(div);
                                    });
                                }
                                listEl.style.display = 'block';
                            }).catch(err => console.error(err));
                    }, 300);
                });

                document.addEventListener('click', function(e) {
                    if (e.target !== inputEl) listEl.style.display = 'none';
                });
            }

            // Setup baris yang sudah ada
            document.querySelectorAll('.siswa-row').forEach(row => {
                setupAutocomplete(
                    row.querySelector('.autocomplete-input'),
                    row.querySelector('.siswa-hidden-id'),
                    row.querySelector('.autocomplete-items')
                );

                const btnHapus = row.querySelector('.btn-hapus-row');
                if(btnHapus) {
                    btnHapus.addEventListener('click', function() {
                        row.remove();
                        rowCount--;
                        btnTambah.disabled = false;
                        maxMsg.style.display = 'none';
                        reindexRows();
                    });
                }
            });

            function reindexRows() {
                const rows = container.querySelectorAll('.siswa-row');
                rowCount = rows.length;
                rows.forEach((row, index) => {
                    row.id = `row-siswa-${index+1}`;
                    const label = row.querySelector('.form-label');
                    if(index === 0) {
                        label.innerHTML = `Siswa 1 (Wajib) <span style="color:#ef4444">*</span>`;
                        row.querySelector('.autocomplete-input').required = true;
                        row.querySelector('.siswa-hidden-id').required = true;
                    } else {
                        label.innerHTML = `Siswa ${index+1} (Opsional)`;
                        row.querySelector('.autocomplete-input').required = false;
                        row.querySelector('.siswa-hidden-id').required = false;
                    }
                });
            }

            // Tombol tambah baris
            btnTambah.addEventListener('click', function() {
                if (rowCount >= maxRows) return;
                rowCount++;

                const rowDiv = document.createElement('div');
                rowDiv.className = 'siswa-row';
                rowDiv.id = `row-siswa-${rowCount}`;
                rowDiv.innerHTML = `
                    <label class="form-label" style="display:block; margin-bottom:8px; font-weight:600; font-size:14px;">Siswa ${rowCount} (Opsional)</label>
                    <div style="position: relative; display:flex; gap:12px;">
                        <div style="position:relative; flex:1;">
                            <input type="text" class="form-input autocomplete-input" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; background:#f8fafc;" placeholder="Ketik nama siswa..." autocomplete="off" />
                            <input type="hidden" name="siswa_id[]" class="siswa-hidden-id">
                            <div class="autocomplete-items"></div>
                        </div>
                        <button type="button" class="btn-hapus-row" style="background:none; border:none; cursor:pointer; color:#ef4444;" title="Hapus baris ini">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
                        </button>
                    </div>
                `;
                container.appendChild(rowDiv);

                setupAutocomplete(
                    rowDiv.querySelector('.autocomplete-input'),
                    rowDiv.querySelector('.siswa-hidden-id'),
                    rowDiv.querySelector('.autocomplete-items')
                );

                rowDiv.querySelector('.btn-hapus-row').addEventListener('click', function() {
                    rowDiv.remove();
                    rowCount--;
                    btnTambah.disabled = false;
                    maxMsg.style.display = 'none';
                    reindexRows();
                });

                if (rowCount >= maxRows) {
                    btnTambah.disabled = true;
                    maxMsg.style.display = 'inline-block';
                }
            });
        });
    </script>
</body>
</html>
