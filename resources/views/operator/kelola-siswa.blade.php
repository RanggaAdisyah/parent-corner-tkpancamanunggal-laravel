<!DOCTYPE html>
<html lang="id">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Kelola Akun Siswa</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/Operator/kelola-siswa.css') }}">
</head>

<body>
    <div class="kelola-akun-siswa">
        @include('partials.sidebar', ['active' => 'akun-siswa'])

        <main class="main">
            <section class="background">
                <div class="container-3">
                    <section class="container-4">
                        <div class="container-5">
                            <div class="container-6">
                                <div class="div-2">
                                    <h1 class="text-6">Kelola Akun Siswa</h1>
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
                                    <div class="text-wrapper-6">Tambah Siswa</div>
                                </button>
                            </div>
                        </div>

                        <div class="background-border">
                            <form class="container-8" action="#" method="get" role="search"
                                aria-label="Cari siswa">
                                <label class="input" for="search-siswa">
                                    <div class="div-2">
                                        <input id="search-siswa" name="q" class="text-wrapper-7" type="search"
                                            placeholder="Cari nama siswa atau NIS..."
                                            aria-label="Cari nama siswa atau NIS" />
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

                        <section class="table-wrapper" aria-label="Daftar akun siswa">
                            <div class="table" role="table" aria-label="Tabel akun siswa">
                                <header class="header" role="rowgroup">
                                    <div class="row" role="row">
                                        <div class="cell" role="columnheader">
                                            <div class="text-8">NAMA SISWA</div>
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
                                    <button class="row-2" type="button"
                                        aria-label="Lihat detail Ananda Rizky, kelas TK B - Matahari, status Aktif"
                                        data-nama="Ananda Rizky Pratama"
                                        data-nis="2023001"
                                        data-kelas="TK-B-Matahari"
                                        data-ayah="Rizki Santoso"
                                        data-ibu="Anita Wijaya"
                                        data-wa="081234567890"
                                        data-alamat="Jl. Merpati No. 45, RT 02/RW 05, Kel. Sukamaju, Kec. Pancoran, Jakarta Selatan">
                                        <div class="data" role="cell">
                                            <div class="container-11">
                                                <div class="background-border-2" aria-hidden="true">
                                                    <div class="text-11">AR</div>
                                                </div>
                                            </div>
                                            <div class="margin-2">
                                                <div class="div">
                                                    <div class="div-2">
                                                        <div class="text-12">Ananda Rizky</div>
                                                    </div>
                                                    <div class="div-2">
                                                        <div class="text-13">NIS: 2023001</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="data-2" role="cell">
                                            <div class="text-14">TK B - Matahari</div>
                                        </div>

                                        <div class="background-wrapper" role="cell">
                                            <div class="background-2">
                                                <div class="background-3" aria-hidden="true"></div>
                                                <div class="text-15">Aktif</div>
                                            </div>
                                        </div>

                                        <div class="img-wrapper" aria-hidden="true">
                                            <img class="icon-9" src="{{ asset('img/icon-13.svg') }}"
                                                alt="" />
                                        </div>
                                    </button>

                                    <button class="row-3" type="button"
                                        aria-label="Lihat detail Cantika Putri, kelas TK B - Matahari, status Aktif"
                                        data-nama="Cantika Putri"
                                        data-nis="2023002"
                                        data-kelas="TK-B-Matahari"
                                        data-ayah="Budi Setiawan"
                                        data-ibu="Rina Setiawati"
                                        data-wa="087812345678"
                                        data-alamat="Jl. Kenanga No. 12, Jakarta Selatan">
                                        <div class="data" role="cell">
                                            <div class="container-11">
                                                <div class="siswa-cantika" role="img"
                                                    aria-label="Foto Cantika Putri"></div>
                                            </div>
                                            <div class="margin-2">
                                                <div class="div">
                                                    <div class="div-2">
                                                        <div class="text-16">Cantika Putri</div>
                                                    </div>
                                                    <div class="div-2">
                                                        <div class="text-17">NIS: 2023002</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="data-2" role="cell">
                                            <div class="text-18">TK B - Matahari</div>
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

                                    <button class="row-3" type="button"
                                        aria-label="Lihat detail Dimas Anggara, kelas TK A - Mawar, status Nonaktif"
                                        data-nama="Dimas Anggara"
                                        data-nis="2023045"
                                        data-kelas="TK-A-Bulan"
                                        data-ayah="Agus Anggara"
                                        data-ibu="Sari Anggara"
                                        data-wa="081345678901"
                                        data-alamat="Jl. Melati No. 8, Depok">
                                        <div class="data" role="cell">
                                            <div class="container-11">
                                                <div class="background-4" aria-hidden="true">
                                                    <div class="text-19">DA</div>
                                                </div>
                                            </div>
                                            <div class="margin-2">
                                                <div class="div">
                                                    <div class="div-2">
                                                        <div class="text-20">Dimas Anggara</div>
                                                    </div>
                                                    <div class="div-2">
                                                        <div class="text-21">NIS: 2023045</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="data-2" role="cell">
                                            <div class="text-22">TK A - Mawar</div>
                                        </div>

                                        <div class="background-wrapper" role="cell">
                                            <div class="background-5">
                                                <div class="background-6" aria-hidden="true"></div>
                                                <div class="text-23">Nonaktif</div>
                                            </div>
                                        </div>

                                        <div class="img-wrapper" aria-hidden="true">
                                            <img class="icon-9" src="{{ asset('img/icon.svg') }}" alt="" />
                                        </div>
                                    </button>

                                    <button class="row-3" type="button"
                                        aria-label="Lihat detail Fajar Hidayat, kelas TK B - Anggrek, status Aktif"
                                        data-nama="Fajar Hidayat"
                                        data-nis="2023050"
                                        data-kelas="TK-B-Bintang"
                                        data-ayah="Hidayat Saputra"
                                        data-ibu="Dewi Hidayat"
                                        data-wa="082156789012"
                                        data-alamat="Jl. Anggrek No. 3, Tangerang Selatan">
                                        <div class="data" role="cell">
                                            <div class="container-11">
                                                <div class="siswa-fajar" role="img"
                                                    aria-label="Foto Fajar Hidayat"></div>
                                            </div>
                                            <div class="margin-2">
                                                <div class="div">
                                                    <div class="div-2">
                                                        <div class="text-24">Fajar Hidayat</div>
                                                    </div>
                                                    <div class="div-2">
                                                        <div class="text-25">NIS: 2023050</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="data-3" role="cell">
                                            <div class="text-26">TK B - Anggrek</div>
                                        </div>

                                        <div class="data-4" role="cell">
                                            <div class="background-2">
                                                <div class="background-3" aria-hidden="true"></div>
                                                <div class="text-15">Aktif</div>
                                            </div>
                                        </div>

                                        <div class="data-5" aria-hidden="true">
                                            <img class="icon-9" src="{{ asset('img/icon-3.svg') }}" alt="" />
                                        </div>
                                    </button>
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
                    <section class="container-13" aria-label="Ringkasan siswa">
                        <div class="heading-ananda">Ananda Rizky</div>

                        <div class="margin-3">
                            <div class="container-14">
                                <div class="container-7">
                                    <div class="text-28">NIS: 2023001</div>
                                </div>
                            </div>
                        </div>

                        <div class="container-15">
                            <div class="background-border-3" aria-hidden="true">
                                <div class="text-29">AR</div>
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
                            <div class="text-30" id="data-siswa-heading">DATA SISWA</div>
                        </div>

                        <div class="container-16">
                            <div class="container-17">
                                <div class="div-2">
                                    <div class="text-wrapper-8">Nama Lengkap</div>
                                </div>
                                <div class="div-2">
                                    <div class="text-wrapper-9">Ananda Rizky Pratama</div>
                                </div>
                            </div>

                            <div class="container-18">
                                <div class="container-19">
                                    <div class="div-2">
                                        <div class="text-wrapper-8">Kelas</div>
                                    </div>
                                    <div class="div-2">
                                        <div class="text-wrapper-9">TK B - Matahari</div>
                                    </div>
                                </div>

                                <div class="container-20">
                                    <div class="div-2">
                                        <div class="text-wrapper-8">Jenis Kelamin</div>
                                    </div>
                                    <div class="div-2">
                                        <div class="text-wrapper-9">Laki-laki</div>
                                    </div>
                                </div>
                            </div>

                            <div class="container-17">
                                <div class="div-2">
                                    <div class="text-wrapper-8">Tanggal Lahir</div>
                                </div>
                                <div class="div-2">
                                    <div class="text-wrapper-9">12 Mei 2018</div>
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
                                    <div class="text-wrapper-9">Bapak Rizki Santoso</div>
                                </div>
                            </div>

                            <div class="container-17">
                                <div class="div-2">
                                    <div class="text-wrapper-8">Nama Ibu</div>
                                </div>
                                <div class="div-2">
                                    <div class="text-wrapper-9">Ibu Anita Wijaya</div>
                                </div>
                            </div>

                            <div class="container-17">
                                <div class="div-2">
                                    <div class="text-wrapper-8">No. Telepon / WA</div>
                                </div>
                                <div class="container-21">
                                    <div class="div">
                                        <a class="text-32" href="tel:081234567890">0812-3456-7890</a>
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
                                    <p class="jl-merpati-no-RT">
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

                    <button class="button-7" type="button">
                        <div class="container-7">
                            <img class="icon-15" src="{{ asset('img/icon-11.svg') }}" alt="" />
                        </div>
                        <div class="text-34">Hapus Akun</div>
                    </button>
                </div>
            </aside>

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
                        <h3 id="modalTitle" class="modal-title">Tambah Data Siswa</h3>
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

                <form id="studentForm">
                    <div class="modal-body">
                        <!-- Informasi Siswa -->
                        <div class="form-section">
                            <div class="section-title-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" style="color: #3b82f6;">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span class="section-title">Informasi Siswa</span>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-input" placeholder="Masukkan nama lengkap siswa"
                                    required>
                            </div>

                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Kelas</label>
                                    <select class="form-select">
                                        <option value="">Pilih Kelas</option>
                                        <option value="TK-B-Bintang">TK - B (Bintang)</option>
                                        <option value="TK-B-Matahari">TK - B (Matahari)</option>
                                        <option value="TK-A-Bulan">TK - A (Bulan)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Nomor Induk Siswa (NIS)</label>
                                    <input type="text" class="form-input" placeholder="Contoh: 20230155">
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
                                    <input type="text" class="form-input" placeholder="Nama lengkap ayah">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Nama Ibu</label>
                                    <input type="text" class="form-input" placeholder="Nama lengkap ibu">
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
                                    <input type="text" class="form-input" placeholder="Contoh: 081234567890">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Alamat Domisili</label>
                                <textarea class="form-textarea" placeholder="Masukkan alamat lengkap rumah"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn-modal-secondary" id="btnBatalModal">Batal</button>
                        <button type="submit" class="btn-modal-primary" id="btnSubmitModal">Tambah Siswa</button>
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

                // Modal logic
                const modal = document.getElementById('studentModal');
                const btnTambahSiswa = document.getElementById('btnTambahSiswa');
                const btnUbahData = document.getElementById('btnUbahData');
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
                        document.querySelector('#studentForm [placeholder="Masukkan nama lengkap siswa"]').value = d.nama || '';
                        document.querySelector('#studentForm [placeholder="Contoh: 20230155"]').value   = d.nis  || '';
                        document.querySelector('#studentForm [placeholder="Nama lengkap ayah"]').value  = d.ayah || '';
                        document.querySelector('#studentForm [placeholder="Nama lengkap ibu"]').value   = d.ibu  || '';
                        document.querySelector('#studentForm [placeholder="Contoh: 081234567890"]').value = d.wa || '';
                        document.querySelector('#studentForm textarea').value                            = d.alamat || '';

                        // Set dropdown kelas
                        const kelasSelect = document.querySelector('#studentForm select');
                        if (kelasSelect && d.kelas) {
                            kelasSelect.value = d.kelas;
                        }
                    } else {
                        modalTitle.innerText = 'Tambah Data Siswa';
                        btnSubmitModal.innerText = 'Tambah Siswa';
                        document.getElementById('studentForm').reset();
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

</body>

</html>
