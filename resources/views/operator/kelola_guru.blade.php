<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Kelola Akun Guru</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/Operator/kelola_guru.css') }}">
</head>
<body>
    <div class="kelola-akun-guru">
        @include('partials.sidebar', ['active' => 'akun-guru'])

        <main class="main">
            <section class="background">
                <div class="container-3">
                    <section class="container-4">
                        <div class="container-5">
                            <div class="container-6">
                                <div class="div-2">
                                    <h1 class="text-6">Kelola Akun Guru</h1>
                                </div>
                                <div class="div-2">
                                    <p class="p">Pilih guru untuk melihat detail informasi.</p>
                                </div>
                            </div>

                            <div class="action-buttons" aria-label="Aksi halaman">
                                <button class="button-2" type="button">
                                    <div class="text-wrapper-6">Backup Guru</div>
                                </button>

                                <button id="btnTambahGuru" class="button-3" type="button">
                                    <div class="container-7">
                                        <img class="icon-7" src="{{ asset('img/icon-19.svg') }}" alt="" />
                                    </div>
                                    <div class="text-wrapper-6">Tambah Guru</div>
                                </button>
                            </div>
                        </div>

                        <div class="background-border">
                            <form action="#" method="get" role="search" aria-label="Cari guru" style="flex: 1; display: flex; align-items: center; max-width: 400px; margin-right: auto;">
                                <input id="search-guru" name="q" type="search" placeholder="Cari nama guru atau NIP..." aria-label="Cari nama guru atau NIP" style="width: 100%; padding: 10px 16px; border: 1px solid #e2e8f0; border-radius: 8px; outline: none; font-size: 14px; background: white;" />
                            </form>

                            <div class="options-wrapper" style="display: flex; gap: 10px;">
                                <select id="filter-kelas" style="padding: 8px 12px; border: 1px solid #e2e8f0; border-radius: 8px; outline: none; font-size: 14px; background: white; cursor: pointer; min-width: 130px; appearance: auto;" aria-label="Filter kelas">
                                    <option value="" selected>Semua Kelas</option>
                                    @foreach($kelasList as $kelas)
                                        <option value="{{ $kelas->id }}">{{ $kelas->tingkat }} - {{ $kelas->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <section class="table-wrapper" aria-label="Daftar akun guru">
                            <div class="table" role="table" aria-label="Tabel akun guru">
                                <header class="header" role="rowgroup">
                                    <div class="row" role="row">
                                        <div class="cell" role="columnheader">
                                            <div class="text-8">NAMA GURU</div>
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
                                    @foreach($daftarGuru as $guru)
                                    <button
                                        class="row-3"
                                        type="button"
                                        aria-label="Lihat detail {{ $guru->nama_lengkap }}"
                                        data-id="{{ $guru->user_id }}"
                                        data-nama="{{ $guru->nama_lengkap }}"
                                        data-email="{{ $guru->user->email }}"
                                        data-nip="{{ $guru->nip }}"
                                        data-jabatan="{{ $guru->jabatan }}"
                                        data-walikelas="{{ $guru->kelas_id }}"
                                        data-namakelas="{{ $guru->kelas ? $guru->kelas->tingkat . ' - ' . $guru->kelas->nama_kelas : 'Bukan Wali Kelas' }}"
                                        data-wa="{{ $guru->no_wa }}"
                                        data-alamat="{{ $guru->alamat }}"
                                    >
                                        <div class="data" role="cell">
                                            <div class="container-11">
                                                <div class="background-border-2" aria-hidden="true">
                                                    <div class="text-11">{{ strtoupper(substr($guru->nama_lengkap, 0, 2)) }}</div>
                                                </div>
                                            </div>
                                            <div class="margin-2">
                                                <div class="div">
                                                    <div class="div-2">
                                                        <div class="text-12">{{ $guru->nama_lengkap }}</div>
                                                    </div>
                                                    <div class="div-2">
                                                        <div class="text-13">NIP: {{ $guru->nip ?? '-' }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="data-2" role="cell">
                                            <div class="text-14">{{ $guru->kelas ? $guru->kelas->tingkat . ' - ' . $guru->kelas->nama_kelas : '-' }}</div>
                                        </div>

                                        <div class="background-wrapper" role="cell">
                                            <div class="background-2">
                                                <div class="background-3" aria-hidden="true"></div>
                                                <div class="text-15">Aktif</div>
                                            </div>
                                        </div>

                                        <div class="img-wrapper" aria-hidden="true">
                                            <img class="icon-9" src="{{ asset('img/icon-13.svg') }}" alt="" />
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

            <aside class="background-7" aria-label="Detail akun guru">

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
                    <section class="container-13" aria-label="Ringkasan guru">
                        <div class="heading-ananda" id="detailNamaLengkap1">Nama Guru</div>

                        <div class="margin-3">
                            <div class="container-14">
                                <div class="container-7">
                                    <div class="text-28" id="detailNip1">NIP: -</div>
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

                    <section class="container-16" aria-labelledby="data-guru-heading">
                        <div class="heading">
                            <div class="div">
                                <img class="icon-11" src="{{ asset('img/icon-2.svg') }}" alt="" />
                            </div>
                            <div class="text-30" id="data-guru-heading">DATA GURU</div>
                        </div>

                        <div class="container-16">
                            <div class="container-17">
                                <div class="div-2">
                                    <div class="text-wrapper-8">Nama Lengkap</div>
                                </div>
                                <div class="div-2">
                                    <div class="text-wrapper-9" id="detailNamaLengkap2">-</div>
                                </div>
                            </div>

                            <div class="container-18">
                                <div class="container-19">
                                    <div class="div-2">
                                        <div class="text-wrapper-8">Kelas</div>
                                    </div>
                                    <div class="div-2">
                                        <div class="text-wrapper-9" id="detailKelas">-</div>
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

                    <section class="container-16" aria-labelledby="informasi-pendukung-heading">
                        <div class="heading">
                            <div class="div">
                                <img class="icon-12" src="{{ asset('img/icon-10.svg') }}" alt="" />
                            </div>
                            <div class="text-31" id="informasi-pendukung-heading">INFORMASI PENDUKUNG</div>
                        </div>

                        <div class="container-16">
                            <div class="container-17">
                                <div class="div-2">
                                    <div class="text-wrapper-8">Email</div>
                                </div>
                                <div class="div-2">
                                    <div class="text-wrapper-9" id="detailEmail">-</div>
                                </div>
                            </div>

                            <div class="container-17">
                                <div class="div-2">
                                    <div class="text-wrapper-8">No. Telepon / WA</div>
                                </div>
                                <div class="container-21">
                                    <div class="div">
                                        <a class="text-32" href="#" id="detailWaL">-</a>
                                    </div>
                                    <button class="button-5" type="button" aria-label="Hubungi melalui WhatsApp">
                                        <div class="icon-wrapper">
                                            <img class="icon-13" src="{{ asset('img/icon-8.svg') }}" alt="" />
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
                                        -
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="background-8">
                    <button id="btnUbahDataGuru" class="button-6" type="button">
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

        <!-- Modal Tambah/Ubah Guru -->
        <div id="teacherModal" class="modal-overlay">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title-wrapper">
                        <div class="modal-icon-bg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        </div>
                        <h3 id="modalTitleGuru" class="modal-title">Tambah Data Guru</h3>
                    </div>
                    <button type="button" class="btn-close-modal" id="btnCloseModalGuruX">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                
                <form id="teacherForm" method="POST" action="{{ url('/operator/kelola-guru') }}">
                    @csrf
                    <input type="hidden" name="_method" id="formMethodGuru" value="POST">
                    <div class="modal-body">
                        <!-- Informasi Guru -->
                        <div class="form-section">
                            <div class="section-title-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #3b82f6;"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <span class="section-title">Informasi Guru</span>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-input" id="guruNama" placeholder="Masukkan nama lengkap guru" required>
                            </div>
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Jabatan</label>
                                    <input type="text" name="jabatan" class="form-input" id="guruJabatan" placeholder="Contoh: Guru Kelas / Kepala Sekolah">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">NIP / Kode Guru</label>
                                    <input type="text" name="nip" class="form-input" id="guruNip" placeholder="Masukkan NIP atau kode">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Wali Kelas (Opsional)</label>
                                <select name="kelas_id" id="guruKelas" class="form-select">
                                    <option value="">Bukan Wali Kelas</option>
                                    @foreach($kelasList as $kelas)
                                        <option value="{{ $kelas->id }}">{{ $kelas->tingkat }} - {{ $kelas->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Informasi Kredensial -->
                        <div class="form-section">
                            <div class="section-title-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #3b82f6;"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                <span class="section-title">Akun Login</span>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email Login</label>
                                <input type="email" name="email" class="form-input" id="guruEmail" placeholder="Contoh: guru@sekolah.com" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-input" id="guruPassword" placeholder="Kosongkan jika tidak diubah (saat edit)">
                            </div>
                        </div>

                        <!-- Informasi Kontak -->
                        <div class="form-section">
                            <div class="section-title-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #3b82f6;"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                <span class="section-title">Kontak & Alamat</span>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">No. WhatsApp Aktif</label>
                                <div class="input-with-icon">
                                    <div class="input-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                    </div>
                                    <input type="text" name="no_wa" id="guruWa" class="form-input" placeholder="Contoh: 081234567890">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Alamat Domisili</label>
                                <textarea name="alamat" id="guruAlamat" class="form-textarea" placeholder="Masukkan alamat lengkap rumah"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer" style="display: flex; justify-content: space-between; width: 100%;">
                        <button type="submit" class="btn-modal-danger" id="btnHapusGuruModal" style="display: none; background: #ef4444; color: white; padding: 10px 16px; border-radius: 8px; border: none; font-weight: 500; cursor: pointer;">Hapus Guru</button>
                        <div style="display: flex; gap: 12px; margin-left: auto;">
                            <button type="button" class="btn-modal-secondary" id="btnBatalGuruModal">Batal</button>
                            <button type="submit" class="btn-modal-primary" id="btnSubmitGuruModal">Tambah Guru</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const detailPanel = document.querySelector('.background-7');
            const closeBtn = document.querySelector('.button-4');
            const teacherRows = document.querySelectorAll('.table button');
            let activeRow = null;

            teacherRows.forEach(row => {
                if (row.classList.contains('row-2') || row.classList.contains('row-3')) {
                    row.addEventListener('click', function() {
                        if (activeRow === this) {
                            detailPanel.classList.remove('active');
                            this.classList.remove('selected-row');
                            activeRow = null;
                        } else {
                            if (activeRow) activeRow.classList.remove('selected-row');
                            detailPanel.classList.add('active');
                            this.classList.add('selected-row');
                            activeRow = this;

                            const d = this.dataset;
                            document.getElementById('detailNamaLengkap1').innerText = d.nama;
                            document.getElementById('detailNip1').innerText = 'NIP: ' + (d.nip || '-');
                            document.getElementById('detailNamaLengkap2').innerText = d.nama;
                            document.getElementById('detailKelas').innerText = d.namakelas;
                            document.getElementById('detailEmail').innerText = d.email;
                            document.getElementById('detailWaL').innerText = d.wa || '-';
                            document.getElementById('detailWaL').href = d.wa ? 'tel:' + d.wa : '#';
                            document.getElementById('detailAlamat').innerText = d.alamat || '-';
                        }
                    });
                }
            });

            if (closeBtn) {
                closeBtn.addEventListener('click', function() {
                    detailPanel.classList.remove('active');
                    if (activeRow) activeRow.classList.remove('selected-row');
                    activeRow = null;
                });
            }

            // Modal Guru Logic
            const modalGuru = document.getElementById('teacherModal');
            const btnTambahGuru = document.getElementById('btnTambahGuru');
            const btnUbahDataGuru = document.getElementById('btnUbahDataGuru');
            const btnCloseModalGuruX = document.getElementById('btnCloseModalGuruX');
            const btnBatalGuruModal = document.getElementById('btnBatalGuruModal');
            const modalTitleGuru = document.getElementById('modalTitleGuru');
            const btnSubmitGuruModal = document.getElementById('btnSubmitGuruModal');
            const btnHapusGuruModal = document.getElementById('btnHapusGuruModal');
            const formMethodGuru = document.getElementById('formMethodGuru');
            const teacherForm = document.getElementById('teacherForm');

            const openModalGuru = (type = 'tambah') => {
                if (type === 'ubah' && activeRow) {
                    modalTitleGuru.innerText = 'Ubah Data Guru';
                    btnSubmitGuruModal.innerText = 'Simpan Perubahan';
                    btnHapusGuruModal.style.display = 'inline-flex';
                    
                    const d = activeRow.dataset;
                    teacherForm.action = `/operator/kelola-guru/${d.id}`;
                    formMethodGuru.value = 'PUT';

                    document.getElementById('guruNama').value = d.nama || '';
                    document.getElementById('guruJabatan').value = d.jabatan || '';
                    document.getElementById('guruNip').value = d.nip || '';
                    document.getElementById('guruEmail').value = d.email || '';
                    document.getElementById('guruPassword').value = '';
                    document.getElementById('guruWa').value = d.wa || '';
                    document.getElementById('guruAlamat').value = d.alamat || '';
                    
                    if(d.walikelas) {
                        document.getElementById('guruKelas').value = d.walikelas;
                    } else {
                        document.getElementById('guruKelas').value = '';
                    }
                    
                    document.getElementById('guruPassword').required = false;

                } else {
                    modalTitleGuru.innerText = 'Tambah Data Guru';
                    btnSubmitGuruModal.innerText = 'Tambah Guru';
                    btnHapusGuruModal.style.display = 'none';
                    
                    teacherForm.reset();
                    teacherForm.action = `/operator/kelola-guru`;
                    formMethodGuru.value = 'POST';
                    document.getElementById('guruPassword').required = true;
                }
                modalGuru.classList.add('active');
            };

            const closeModalGuru = () => {
                modalGuru.classList.remove('active');
            };

            if (btnTambahGuru) btnTambahGuru.addEventListener('click', () => openModalGuru('tambah'));
            if (btnUbahDataGuru) btnUbahDataGuru.addEventListener('click', () => openModalGuru('ubah'));
            if (btnCloseModalGuruX) btnCloseModalGuruX.addEventListener('click', closeModalGuru);
            if (btnBatalGuruModal) btnBatalGuruModal.addEventListener('click', closeModalGuru);

            if (btnHapusGuruModal) {
                btnHapusGuruModal.addEventListener('click', (e) => {
                    e.preventDefault();
                    if(confirm('Yakin ingin menghapus guru ini?')) {
                        formMethodGuru.value = 'DELETE';
                        teacherForm.submit();
                    }
                });
            }

            modalGuru.addEventListener('click', (e) => {
                if (e.target === modalGuru) closeModalGuru();
            });
        });

        // Search & Filter Logic
        const searchInput = document.getElementById('search-guru');
        const filterKelas = document.getElementById('filter-kelas');

        function filterRows() {
            const query = searchInput.value.toLowerCase();
            const selectedClass = filterKelas.value;

            document.querySelectorAll('.row-3').forEach(row => {
                const nama = (row.dataset.nama || '').toLowerCase();
                const nip = (row.dataset.nip || '').toLowerCase();
                const kelasId = row.dataset.walikelas || '';

                const matchesSearch = nama.includes(query) || nip.includes(query);
                let matchesClass = true;
                if (selectedClass && selectedClass !== '') {
                    matchesClass = (kelasId === selectedClass);
                }

                if (matchesSearch && matchesClass) {
                    row.style.display = 'flex';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        if (searchInput) searchInput.addEventListener('input', filterRows);
        if (filterKelas) filterKelas.addEventListener('change', filterRows);
    </script>
</body>
</html>