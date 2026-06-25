<!DOCTYPE html>
<html lang="id">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Kelola Akun Wali</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/Operator/kelola_wali.css') }}">
</head>

<body>
    <div class="kelola-akun-siswa">
        @include('partials.sidebar', ['active' => 'akun_wali'])

        <main class="main">
            <section class="background">
                <div class="container-3">
                    <section class="container-4">
                        <div class="container-5">
                            <div class="container-6">
                                <div class="div-2">
                                    <h1 class="text-6">Kelola Akun Wali</h1>
                                </div>
                                <div class="div-2">
                                    <p class="p">Pilih siswa untuk melihat detail informasi.</p>
                                </div>
                            </div>

                            <div class="action-buttons" aria-label="Aksi halaman">
                                <button class="button-2" type="button">
                                    <div class="text-wrapper-6">Backup Siswa</div>
                                </button>

                                <button id="btnTambahSiswa" class="button-3" type="button">
                                    <div class="container-7">
                                        <img class="icon-7" src="{{ asset('img/icon-19.svg') }}" alt="" />
                                    </div>
                                    <div class="text-wrapper-6">Tambah Akun Wali</div>
                                </button>
                            </div>
                        </div>

                        <div class="background-border">
                            <form class="container-8" action="#" method="get" role="search"
                                aria-label="Cari wali">
                                <label class="input" for="search-wali">
                                    <div class="div-2">
                                        <input id="search-wali" name="q" class="text-wrapper-7" type="search"
                                            placeholder="Cari nama wali atau NAMA ANAK..."
                                            aria-label="Cari nama wali atau NAMA ANAK" />
                                    </div>
                                </label>

                                <div class="container-9" aria-hidden="true">
                                    <div class="div">
                                        <img class="icon-8" src="{{ asset('img/icon-12.svg') }}" alt="" />
                                    </div>
                                </div>
                            </form>

                            <div class="options-wrapper">
                                <label class="options" for="filter-kelas">
                                    <div class="image-fill" aria-hidden="true">
                                        <div class="SVG">
                                            <img class="vector" src="{{ asset('img/vector.svg') }}" alt="" />
                                        </div>
                                    </div>

                                    <div class="container-10">
                                        <select id="filter-kelas" class="text-7" aria-label="Filter kelas">
                                            <option selected>Semua Kelas</option>
                                        </select>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <section class="table-wrapper" aria-label="Daftar akun wali">
                            <div class="table" role="table" aria-label="Tabel akun wali">
                                <header class="header" role="rowgroup">
                                    <div class="row" role="row">
                                        <div class="cell" role="columnheader">
                                            <div class="text-8">NAMA ANAK</div>
                                        </div>
                                        <div class="cell-2" role="columnheader">
                                            <div class="text-9">KELAS</div>
                                        </div>
                                        <div class="cell-3" role="columnheader">
                                            <div class="text-10">STATUS</div>
                                        </div>
                                    </div>
                                </header>

                                <div class="body" role="rowgroup">
                                    @foreach($daftarWali as $wali)
                                    @php
                                        // Ambil data anak pertama jika ada
                                        $siswa = $wali->siswas->first();
                                        $namaSiswa = $siswa ? $siswa->nama : 'Belum ada data anak';
                                        $kelasSiswa = $siswa ? $siswa->kelas : '-';
                                        $nisSiswa = $siswa ? $siswa->nis : '-';
                                        $inisial = strtoupper(substr($namaSiswa, 0, 2));
                                        $emailWali = $wali->user ? $wali->user->email : '';
                                    @endphp
                                    <button class="row-3" type="button"
                                        aria-label="Lihat detail {{ $namaSiswa }}"
                                        data-nama="{{ $namaSiswa }}"
                                        data-nis="{{ $nisSiswa }}"
                                        data-kelas="{{ $kelasSiswa }}"
                                        data-ayah="{{ $wali->nama_ayah }}"
                                        data-ibu="{{ $wali->nama_ibu }}"
                                        data-wa="{{ $wali->no_wa }}"
                                        data-alamat="{{ $wali->alamat }}"
                                        data-email="{{ $emailWali }}"
                                        data-id="{{ $wali->user_id }}"
                                        data-jk="{{ $siswa ? $siswa->jenis_kelamin : '' }}"
                                        data-tgl="{{ $siswa ? $siswa->tanggal_lahir : '' }}">
                                        <div class="data" role="cell">
                                            <div class="container-11">
                                                <div class="background-border-2" aria-hidden="true" style="display:flex; justify-content:center; align-items:center; background-color:#3b82f6; border-radius:50%; width:40px; height:40px;">
                                                    <div class="text-11" style="font-weight:bold; color:white; font-size:14px;">{{ $inisial }}</div>
                                                </div>
                                            </div>
                                            <div class="margin-2">
                                                <div class="div">
                                                    <div class="div-2">
                                                        <div class="text-16">{{ $namaSiswa }}</div>
                                                    </div>
                                                    <div class="div-2">
                                                        <div class="text-17">NIS: {{ $nisSiswa }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="data-2" role="cell">
                                            <div class="text-18">{{ $kelasSiswa }}</div>
                                        </div>

                                        <div class="background-wrapper" role="cell">
                                            <div class="background-2">
                                                <div class="background-3" aria-hidden="true"></div>
                                                <div class="text-15">Aktif</div>
                                            </div>
                                        </div>

                                        <div class="img-wrapper" aria-hidden="true">
                                            <img class="icon-9" src="{{ asset('img/icon-7.svg') }}" alt="" />
                                        </div>
                                    </button>
                                    @endforeach
                                </div>
                            </div>
                        </section>
                    </section>
                </div>

                @include('partials.footer')
            </section>

            <aside class="background-7" aria-label="Detail akun siswa">
                <div class="horizontal-border-2">
                    <div class="div">
                        <h2 class="text-27">Detail Akun</h2>
                    </div>
                    <button class="button-4" type="button" aria-label="Tutup detail akun">
                        <div class="icon-wrapper">
                            <img class="icon-10" src="{{ asset('img/icon-4.svg') }}" alt="" />
                        </div>
                    </button>
                </div>

                <div class="container-12">
                    <section class="container-13" aria-label="Ringkasan anak">
                        <div class="heading-ananda" id="detailHeadingNama">Ananda Rizky</div>

                        <div class="margin-3">
                            <div class="container-14">
                                <div class="container-7">
                                    <div class="text-28" id="detailHeadingNis">NIS: 2023001</div>
                                </div>
                            </div>
                        </div>

                        <div class="container-15">
                            <div class="background-border-3" aria-hidden="true" style="display:flex; justify-content:center; align-items:center; background-color:#3b82f6; border-radius:50%; width:40px; height:40px;">
                                <div class="text-29" id="detailHeadingInisial" style="font-weight:bold; color:white; font-size:14px; margin-left: 0; margin-top:0;">AR</div>
                            </div>
                            <div class="background-border-4" aria-label="Status aktif" role="img"></div>
                        </div>
                    </section>

                    <div class="horizontal-divider" aria-hidden="true"></div>

                    <section class="container-16" aria-labelledby="data-siswa-heading">
                        <div class="heading">
                            <div class="div">
                                <img class="icon-11" src="{{ asset('img/icon-2.svg') }}" alt="" />
                            </div>
                            <div class="text-30" id="data-siswa-heading">DATA ANAK</div>
                        </div>

                        <div class="container-16">
                            <div class="container-17">
                                <div class="div-2">
                                    <div class="text-wrapper-8">Nama Lengkap</div>
                                </div>
                                <div class="div-2">
                                    <div class="text-wrapper-9" id="detailNamaLengkap">Ananda Rizky Pratama</div>
                                </div>
                            </div>

                            <div class="container-18">
                                <div class="container-19">
                                    <div class="div-2">
                                        <div class="text-wrapper-8">Kelas</div>
                                    </div>
                                    <div class="div-2">
                                        <div class="text-wrapper-9" id="detailKelas">TK B - Matahari</div>
                                    </div>
                                </div>

                                <div class="container-20">
                                    <div class="div-2">
                                        <div class="text-wrapper-8">Jenis Kelamin</div>
                                    </div>
                                    <div class="div-2">
                                        <div class="text-wrapper-9" id="detailJk">-</div>
                                    </div>
                                </div>
                            </div>

                            <div class="container-17">
                                <div class="div-2">
                                    <div class="text-wrapper-8">Tanggal Lahir</div>
                                </div>
                                <div class="div-2">
                                    <div class="text-wrapper-9" id="detailTgl">-</div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <div class="horizontal-divider" aria-hidden="true"></div>

                    <section class="container-16" aria-labelledby="orang-tua-heading">
                        <div class="heading">
                            <div class="div">
                                <img class="icon-12" src="{{ asset('img/icon-10.svg') }}" alt="" />
                            </div>
                            <div class="text-31" id="orang-tua-heading">INFORMASI ORANG TUA</div>
                        </div>

                        <div class="container-16">
                            <div class="container-17">
                                <div class="div-2">
                                    <div class="text-wrapper-8">Nama Ayah</div>
                                </div>
                                <div class="div-2">
                                    <div class="text-wrapper-9" id="detailAyah">Bapak Rizki Santoso</div>
                                </div>
                            </div>

                            <div class="container-17">
                                <div class="div-2">
                                    <div class="text-wrapper-8">Nama Ibu</div>
                                </div>
                                <div class="div-2">
                                    <div class="text-wrapper-9" id="detailIbu">Ibu Anita Wijaya</div>
                                </div>
                            </div>

                            <div class="container-17">
                                <div class="div-2">
                                    <div class="text-wrapper-8">No. Telepon / WA</div>
                                </div>
                                <div class="container-21">
                                    <div class="div">
                                        <a class="text-32" id="detailWaLink" href="tel:081234567890">0812-3456-7890</a>
                                    </div>
                                    <button class="button-5" type="button" aria-label="Hubungi melalui WhatsApp">
                                        <div class="icon-wrapper">
                                            <img class="icon-13" src="{{ asset('img/icon-8.svg') }}"
                                                alt="" />
                                        </div>
                                    </button>
                                </div>
                            </div>

                            <div class="container-22">
                                <div class="div-2">
                                    <div class="text-wrapper-8">Alamat</div>
                                </div>
                                <div class="jl-merpati-no-RT-wrapper">
                                    <p class="jl-merpati-no-RT" id="detailAlamat">
                                        Jl. Merpati No. 45, RT 02/RW 05, Kel. Sukamaju,<br />
                                        Kec. Pancoran, Jakarta Selatan
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="background-8">
                    <button id="btnUbahData" class="button-6" type="button">
                        <div class="container-7">
                            <img class="icon-14" src="{{ asset('img/icon-16.svg') }}" alt="" />
                        </div>
                        <div class="text-33">Ubah Data</div>
                    </button>

                    <button id="btnHapusAkun" class="button-7" type="button">
                        <div class="container-7">
                            <img class="icon-15" src="{{ asset('img/icon-11.svg') }}" alt="" />
                        </div>
                        <div class="text-34">Hapus Akun</div>
                    </button>
                </div>
            </aside>

            <form id="formHapusAkun" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>

        </main>

        <div class="overlay-shadow" id="detailOverlay" aria-hidden="true"></div>

        <!-- Modal Tambah/Ubah Siswa -->
        <div id="studentModal" class="modal-overlay">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title-wrapper">
                        <div class="modal-icon-bg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <line x1="19" y1="8" x2="19" y2="14"></line>
                                <line x1="16" y1="11" x2="22" y2="11"></line>
                            </svg>
                        </div>
                        <h3 id="modalTitle" class="modal-title">Tambah Data Akun Wali</h3>
                    </div>
                    <button type="button" class="btn-close-modal" id="btnCloseModalX">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>

                <form id="studentForm" method="POST" action="{{ route('operator.kelola_wali') }}">
                    @csrf
                    <input type="hidden" name="_method" id="formMethod" value="POST" disabled>
                    <div class="modal-body">
                        <!-- Informasi Akun Login -->
                        <div class="form-section">
                            <div class="section-title-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #3b82f6;"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                <span class="section-title">Informasi Akun Login</span>
                            </div>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Email Wali</label>
                                    <input type="email" name="email" class="form-input" placeholder="contoh: wali@email.com" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-input" placeholder="Minimal 6 karakter" required>
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Siswa -->
                        <div class="form-section">
                            <div class="section-title-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" style="color: #3b82f6;">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span class="section-title">Informasi Anak</span>
                            </div>

                            <div class="form-group" style="position: relative;">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama_anak" class="form-input" id="inputNamaAnak" placeholder="Masukkan nama lengkap anak" autocomplete="off" required>
                                <div id="autocomplete-list" class="autocomplete-items" style="display:none; position: absolute; top: 100%; left: 0; right: 0; z-index: 99; border: 1px solid #d4d4d4; background-color: #fff; max-height: 200px; overflow-y: auto; border-radius: 4px; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);"></div>
                            </div>

                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Kelas</label>
                                    <select class="form-select" name="kelas">
                                        <option value="">Pilih Kelas</option>
                                        <option value="TK-B-Bintang">TK - B (Bintang)</option>
                                        <option value="TK-B-Matahari">TK - B (Matahari)</option>
                                        <option value="TK-A-Bulan">TK - A (Bulan)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Nomor Induk Siswa (NIS)</label>
                                    <input type="text" name="nis" class="form-input" placeholder="Contoh: 20230155">
                                </div>
                            </div>

                            <div class="form-grid" style="margin-top: 1rem;">
                                <div class="form-group">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" name="jenis_kelamin">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-input">
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Orang Tua -->
                        <div class="form-section">
                            <div class="section-title-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" style="color: #3b82f6;">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                <span class="section-title">Informasi Orang Tua</span>
                            </div>

                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Nama Ayah</label>
                                    <input type="text" name="nama_ayah" class="form-input" id="inputNamaAyah" placeholder="Nama lengkap ayah" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Nama Ibu</label>
                                    <input type="text" name="nama_ibu" class="form-input" id="inputNamaIbu" placeholder="Nama lengkap ibu" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">No. WhatsApp Aktif</label>
                                <div class="input-with-icon">
                                    <div class="input-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path
                                                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                            </path>
                                        </svg>
                                    </div>
                                    <input type="text" name="no_wa" class="form-input" id="inputWa" placeholder="Contoh: 081234567890">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Alamat Domisili</label>
                                <textarea name="alamat" class="form-input" id="inputAlamat" placeholder="Masukkan alamat lengkap rumah" style="height: 80px;"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn-modal-secondary" id="btnBatalModal">Batal</button>
                        <button type="submit" class="btn-modal-primary" id="btnSubmitModal">Tambah Akun Wali</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const detailPanel = document.querySelector('.background-7');
                const overlay = document.getElementById('detailOverlay');
                const closeBtn = document.querySelector('.button-4');
                const studentRows = document.querySelectorAll('.table button');
                let activeRow = null;

                const openPanel = (row) => {
                    const d = row.dataset;
                    
                    document.getElementById('detailHeadingNama').innerText = d.nama || '-';
                    document.getElementById('detailHeadingNis').innerText = 'NIS: ' + (d.nis || '-');
                    document.getElementById('detailHeadingInisial').innerText = d.nama ? d.nama.substring(0,2).toUpperCase() : 'NA';
                    document.getElementById('detailNamaLengkap').innerText = d.nama || '-';
                    document.getElementById('detailKelas').innerText = d.kelas || '-';
                    document.getElementById('detailAyah').innerText = d.ayah || '-';
                    document.getElementById('detailIbu').innerText = d.ibu || '-';
                    document.getElementById('detailWaLink').innerText = d.wa || '-';
                    document.getElementById('detailWaLink').href = 'tel:' + (d.wa || '');
                    document.getElementById('detailAlamat').innerText = d.alamat || '-';
                    document.getElementById('detailJk').innerText = (d.jk === 'L' ? 'Laki-laki' : (d.jk === 'P' ? 'Perempuan' : (d.jk || '-')));
                    document.getElementById('detailTgl').innerText = d.tgl || '-';

                    detailPanel.classList.add('active');
                    if (overlay) overlay.style.display = 'block';
                    row.classList.add('selected-row');
                    activeRow = row;
                };

                const closePanel = () => {
                    detailPanel.classList.remove('active');
                    if (overlay) overlay.style.display = 'none';
                    if (activeRow) activeRow.classList.remove('selected-row');
                    activeRow = null;
                };

                studentRows.forEach(row => {
                    if (row.classList.contains('row-2') || row.classList.contains('row-3')) {
                        row.addEventListener('click', function() {
                            if (activeRow === this) {
                                closePanel();
                            } else {
                                if (activeRow) activeRow.classList.remove('selected-row');
                                openPanel(this);
                            }
                        });
                    }
                });

                if (closeBtn) closeBtn.addEventListener('click', closePanel);
                if (overlay) overlay.addEventListener('click', closePanel);

                // Modal & Hapus logic
                const modal = document.getElementById('studentModal');
                const btnTambahSiswa = document.getElementById('btnTambahSiswa');
                const btnUbahData = document.getElementById('btnUbahData');
                const btnHapusAkun = document.getElementById('btnHapusAkun');
                const formHapusAkun = document.getElementById('formHapusAkun');
                
                if (btnHapusAkun) {
                    btnHapusAkun.addEventListener('click', () => {
                        if (activeRow && activeRow.dataset.id) {
                            if (confirm('Apakah Anda yakin ingin menghapus akun wali ini beserta data anaknya?')) {
                                formHapusAkun.action = '/operator/kelola_wali/' + activeRow.dataset.id;
                                formHapusAkun.submit();
                            }
                        }
                    });
                }
                const btnCloseModalX = document.getElementById('btnCloseModalX');
                const btnBatalModal = document.getElementById('btnBatalModal');
                const modalTitle = document.getElementById('modalTitle');
                const btnSubmitModal = document.getElementById('btnSubmitModal');

                const openModal = (type = 'tambah') => {
                    if (type === 'ubah' && activeRow) {
                        modalTitle.innerText = 'Ubah Data Siswa';
                        btnSubmitModal.innerText = 'Simpan Perubahan';

                        // Ambil data dari data-* attributes baris aktif
                        const d = activeRow.dataset;
                        document.querySelector('#studentForm [name="nama_anak"]').value = d.nama || '';
                        document.querySelector('#studentForm [name="nis"]').value   = d.nis  || '';
                        document.querySelector('#studentForm [name="nama_ayah"]').value  = d.ayah || '';
                        document.querySelector('#studentForm [name="nama_ibu"]').value   = d.ibu  || '';
                        document.querySelector('#studentForm [name="no_wa"]').value = d.wa || '';
                        document.querySelector('#studentForm [name="alamat"]').value = d.alamat || '';
                        
                        document.querySelector('#studentForm [name="jenis_kelamin"]').value = d.jk || '';
                        document.querySelector('#studentForm [name="tanggal_lahir"]').value = d.tgl || '';

                        document.querySelector('#studentForm [name="email"]').closest('.form-section').style.display = 'block';
                        document.querySelector('#studentForm [name="email"]').value = d.email || '';
                        document.querySelector('#studentForm [name="password"]').required = false;
                        document.querySelector('#studentForm [name="password"]').placeholder = 'Kosongkan jika tidak diubah';

                        document.getElementById('studentForm').action = "/operator/kelola_wali/" + d.id;
                        document.getElementById('formMethod').value = "PUT";
                        document.getElementById('formMethod').disabled = false;

                        // Set dropdown kelas
                        const kelasSelect = document.querySelector('#studentForm [name="kelas"]');
                        if (kelasSelect && d.kelas) {
                            kelasSelect.value = d.kelas;
                        }
                    } else {
                        modalTitle.innerText = 'Tambah Data Akun Wali';
                        btnSubmitModal.innerText = 'Tambah Akun Wali';
                        document.getElementById('studentForm').reset();
                        
                        document.getElementById('studentForm').action = "{{ route('operator.kelola_wali') }}";
                        document.getElementById('formMethod').value = "POST";
                        document.getElementById('formMethod').disabled = true;

                        document.querySelector('#studentForm [name="email"]').closest('.form-section').style.display = 'block';
                        document.querySelector('#studentForm [name="password"]').required = true;
                        document.querySelector('#studentForm [name="password"]').placeholder = 'Minimal 6 karakter';
                    }
                    modal.classList.add('active');
                };

                const closeModal = () => {
                    modal.classList.remove('active');
                };

                if (btnTambahSiswa) btnTambahSiswa.addEventListener('click', () => openModal('tambah'));
                if (btnUbahData) btnUbahData.addEventListener('click', () => openModal('ubah'));
                if (btnCloseModalX) btnCloseModalX.addEventListener('click', closeModal);
                if (btnBatalModal) btnBatalModal.addEventListener('click', closeModal);

                modal.addEventListener('click', (e) => {
                    if (e.target === modal) closeModal();
                });
            });
        </script>

        <script>
            // AJAX Autocomplete Logic
            document.addEventListener('DOMContentLoaded', function() {
                const inputNama = document.getElementById('inputNamaAnak');
                const listDropdown = document.getElementById('autocomplete-list');
                const inputAyah = document.getElementById('inputNamaAyah');
                const inputIbu = document.getElementById('inputNamaIbu');
                const inputWa = document.getElementById('inputWa');
                const inputAlamat = document.getElementById('inputAlamat');

                let timeout = null;

                if(inputNama) {
                    inputNama.addEventListener('input', function() {
                        const query = this.value.trim();
                        listDropdown.innerHTML = '';
                        
                        if (query.length < 2) {
                            listDropdown.style.display = 'none';
                            return;
                        }

                        clearTimeout(timeout);
                        timeout = setTimeout(() => {
                            fetch('/api/ppdb/search?q=' + encodeURIComponent(query))
                                .then(response => response.json())
                                .then(data => {
                                    listDropdown.innerHTML = '';
                                    if(data.length === 0) {
                                        listDropdown.style.display = 'none';
                                        return;
                                    }
                                    
                                    data.forEach(item => {
                                        const div = document.createElement('div');
                                        div.style.padding = '10px 15px';
                                        div.style.cursor = 'pointer';
                                        div.style.borderBottom = '1px solid #f0f0f0';
                                        div.innerHTML = `<strong>${item.nama}</strong><br><small style="color:#64748b;">Ayah: ${item.namaAyah}</small>`;
                                        
                                        div.addEventListener('mouseover', () => div.style.backgroundColor = '#f8fafc');
                                        div.addEventListener('mouseout', () => div.style.backgroundColor = 'transparent');
                                        
                                        div.addEventListener('click', function() {
                                            inputNama.value = item.nama;
                                            if(inputAyah) inputAyah.value = item.namaAyah;
                                            if(inputIbu) inputIbu.value = item.namaIbu;
                                            if(inputWa) inputWa.value = item.no_hp;
                                            if(inputAlamat) inputAlamat.value = item.alamat;
                                            if(document.querySelector('#studentForm [name="jenis_kelamin"]')) document.querySelector('#studentForm [name="jenis_kelamin"]').value = item.jk;
                                            if(document.querySelector('#studentForm [name="tanggal_lahir"]')) document.querySelector('#studentForm [name="tanggal_lahir"]').value = item.tgl_lahir;
                                            
                                            listDropdown.style.display = 'none';
                                        });
                                        listDropdown.appendChild(div);
                                    });
                                    listDropdown.style.display = 'block';
                                })
                                .catch(err => console.error('Error fetching PPDB:', err));
                        }, 300); // delay 300ms (debounce)
                    });
                    
                    // Hide dropdown when clicking outside
                    document.addEventListener('click', function(e) {
                        if (e.target !== inputNama) {
                            listDropdown.style.display = 'none';
                        }
                    });
                }
            });
        </script>
</body>

</html>
