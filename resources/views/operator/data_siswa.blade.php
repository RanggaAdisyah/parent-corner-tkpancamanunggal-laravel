<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Data Siswa - Operator Panel</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/Operator/kelola_guru.css') }}">
</head>
<body>
    <div class="kelola-akun-guru">
        @include('partials.sidebar', ['active' => 'data_siswa'])

        <main class="main">
            <section class="background">
                <div class="container-3">
                    <section class="container-4">
                        <div class="container-5">
                            <div class="container-6">
                                <div class="div-2">
                                    <h1 class="text-6">Data Siswa</h1>
                                </div>
                                <div class="div-2">
                                    <p class="p">Pilih siswa untuk melihat detail informasi.</p>
                                </div>
                            </div>

                            <div class="action-buttons" aria-label="Aksi halaman">
                                <button id="btnTambahAnak" class="button-3" type="button">
                                    <div class="container-7">
                                        <img class="icon-7" src="{{ asset('img/icon-19.svg') }}" alt="" />
                                    </div>
                                    <div class="text-wrapper-6">Tambah Siswa</div>
                                </button>
                            </div>
                        </div>

                        <div class="background-border">
                            <form action="#" method="get" role="search" style="flex: 1; display: flex; align-items: center; max-width: 400px; margin-right: auto;">
                                <input
                                    id="search-anak"
                                    name="q"
                                    type="search"
                                    placeholder="Cari nama siswa atau NIS..."
                                    style="width: 100%; padding: 10px 16px; border: 1px solid #e2e8f0; border-radius: 8px; outline: none; font-size: 14px; background: white;"
                                />
                            </form>

                            <div class="options-wrapper" style="display: flex; gap: 10px;">
                                <select id="filter-kelas" style="padding: 8px 12px; border: 1px solid #e2e8f0; border-radius: 8px; outline: none; font-size: 14px; background: white; cursor: pointer; min-width: 130px; appearance: auto;">
                                    <option value="" selected>Semua Kelas</option>
                                    @foreach($kelasList as $kelas)
                                        <option value="{{ $kelas->tingkat }} - {{ $kelas->nama_kelas }}">{{ $kelas->tingkat }} - {{ $kelas->nama_kelas }}</option>
                                    @endforeach
                                </select>
                                
                                <select id="filter-status" style="padding: 8px 12px; border: 1px solid #e2e8f0; border-radius: 8px; outline: none; font-size: 14px; background: white; cursor: pointer; min-width: 130px; appearance: auto;">
                                    <option value="" selected>Semua Status</option>
                                    <option value="Terkait">Terkait</option>
                                    <option value="Belum">Belum</option>
                                </select>
                            </div>
                        </div>

                        <section class="table-wrapper">
                            <div class="table" role="table">
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
                                    @foreach($daftarAnak as $anak)
                                    <button
                                        class="row-3"
                                        type="button"
                                        data-id="{{ $anak->id }}"
                                        data-nama="{{ $anak->nama }}"
                                        data-nis="{{ $anak->nis }}"
                                        data-kelasid="{{ $anak->kelas_id }}"
                                        data-kelas="{{ $anak->kelasLokal ? $anak->kelasLokal->tingkat . ' - ' . $anak->kelasLokal->nama_kelas : $anak->kelas }}"
                                        data-jk="{{ $anak->jenis_kelamin }}"
                                        data-tgllahir="{{ $anak->tanggal_lahir }}"
                                        data-status="{{ $anak->orang_tua_id ? 'Terkait' : 'Belum' }}"
                                        data-orangtua="{{ $anak->orangTua ? $anak->orangTua->nama_ayah . ' / ' . $anak->orangTua->nama_ibu : 'Belum Ditautkan' }}"
                                    >
                                        <div class="data" role="cell">
                                            <div class="container-11">
                                                <div class="background-border-2" aria-hidden="true" style="background:#fce7f3; color:#db2777;">
                                                    <div class="text-11">{{ strtoupper(substr($anak->nama, 0, 2)) }}</div>
                                                </div>
                                            </div>
                                            <div class="margin-2">
                                                <div class="div">
                                                    <div class="div-2">
                                                        <div class="text-12">{{ $anak->nama }}</div>
                                                    </div>
                                                    <div class="div-2">
                                                        <div class="text-13">NIS: {{ $anak->nis ?? '-' }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="data-2" role="cell">
                                            <div class="text-14">{{ $anak->kelasLokal ? $anak->kelasLokal->tingkat . ' - ' . $anak->kelasLokal->nama_kelas : ($anak->kelas ?? '-') }}</div>
                                        </div>

                                        <div class="background-wrapper" role="cell">
                                            <div class="background-2" style="white-space: nowrap; padding: 4px 8px; border-radius: 4px; display: inline-block; {{ $anak->orang_tua_id ? 'background:#dbeafe; color:#1d4ed8;' : 'background:#fee2e2; color:#b91c1c;' }}">
                                                <div class="text-15" style="font-size: 13px;">{{ $anak->orang_tua_id ? 'Terkait' : 'Belum' }}</div>
                                            </div>
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

            <aside class="background-7" aria-label="Detail data siswa">

                <div class="horizontal-border-2">
                    <div class="div">
                        <h2 class="text-27">Detail Siswa</h2>
                    </div>
                    <button class="button-4" type="button" aria-label="Tutup detail">
                        <div class="icon-wrapper">
                            <img class="icon-10" src="{{ asset('img/icon-4.svg') }}" alt="" />
                        </div>
                    </button>
                </div>

                <div class="container-12">
                    <section class="container-13">
                        <div class="heading-ananda" id="detailNamaLengkap1">Nama Siswa</div>

                        <div class="margin-3">
                            <div class="container-14">
                                <div class="container-7">
                                    <div class="text-28" id="detailNis">NIS: -</div>
                                </div>
                            </div>
                        </div>

                        <div class="container-15">
                            <div class="background-border-3" aria-hidden="true" style="background:#fce7f3; color:#db2777;">
                                <div class="text-29">AN</div>
                            </div>
                        </div>
                    </section>

                    <div class="horizontal-divider" aria-hidden="true"></div>

                    <section class="container-16">
                        <div class="heading">
                            <div class="div">
                                <img class="icon-11" src="{{ asset('img/icon-2.svg') }}" alt="" />
                            </div>
                            <div class="text-30">DATA SISWA</div>
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
                                        <div class="text-wrapper-9" id="detailJk">-</div>
                                    </div>
                                </div>
                            </div>

                            <div class="container-17">
                                <div class="div-2">
                                    <div class="text-wrapper-8">Tanggal Lahir</div>
                                </div>
                                <div class="div-2">
                                    <div class="text-wrapper-9" id="detailTgllahir">-</div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <div class="horizontal-divider" aria-hidden="true"></div>

                    <section class="container-16">
                        <div class="heading">
                            <div class="div">
                                <img class="icon-12" src="{{ asset('img/icon-10.svg') }}" alt="" />
                            </div>
                            <div class="text-31">INFORMASI ORANG TUA</div>
                        </div>

                        <div class="container-16">
                            <div class="container-17">
                                <div class="div-2">
                                    <div class="text-wrapper-8">Orang Tua Ditautkan</div>
                                </div>
                                <div class="div-2">
                                    <div class="text-wrapper-9" id="detailOrangTua">-</div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="background-8">
                    <button id="btnUbahDataAnak" class="button-6" type="button">
                        <div class="container-7">
                            <img class="icon-14" src="{{ asset('img/icon-16.svg') }}" alt="" />
                        </div>
                        <div class="text-33">Ubah Data</div>
                    </button>

                    <button class="button-7" type="button" onclick="if(confirm('Hapus anak ini?')) { document.getElementById('formHapusAnak').submit(); }">
                        <div class="container-7">
                            <img class="icon-15" src="{{ asset('img/icon-11.svg') }}" alt="" />
                        </div>
                        <div class="text-34">Hapus Data</div>
                    </button>
                    <form id="formHapusAnak" method="POST" style="display:none;">
                        @csrf @method('DELETE')
                    </form>
                </div>
            </aside>
        </main>

        <!-- Modal Tambah/Ubah Anak -->
        <div id="anakModal" class="modal-overlay">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title-wrapper">
                        <div class="modal-icon-bg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>
                        </div>
                        <h3 id="modalTitleAnak" class="modal-title">Tambah Data Siswa</h3>
                    </div>
                    <button type="button" class="btn-close-modal" id="btnCloseModalAnakX">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                
                <form id="anakForm" method="POST" action="{{ url('/operator/data_siswa') }}">
                    @csrf
                    <input type="hidden" name="_method" id="formMethodAnak" value="POST">
                    <div class="modal-body">
                        <div class="form-section">
                            <div class="section-title-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: #3b82f6;"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <span class="section-title">Informasi Siswa</span>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-input" id="anakNama" placeholder="Masukkan nama lengkap siswa" required>
                            </div>
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">NIS</label>
                                    <input type="text" name="nis" class="form-input" id="anakNis" placeholder="Nomor Induk Siswa" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Kelas</label>
                                    <select name="kelas_id" id="anakKelas" class="form-select" required>
                                        <option value="">Pilih Kelas</option>
                                        @foreach($kelasList as $kelas)
                                            <option value="{{ $kelas->id }}">{{ $kelas->tingkat }} - {{ $kelas->nama_kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="anakJk" class="form-select" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" id="anakTglLahir" class="form-input" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer" style="display: flex; justify-content: flex-end; width: 100%;">
                        <div style="display: flex; gap: 12px;">
                            <button type="button" class="btn-modal-secondary" id="btnBatalAnakModal">Batal</button>
                            <button type="submit" class="btn-modal-primary" id="btnSubmitAnakModal">Simpan Data</button>
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
            const rows = document.querySelectorAll('.table button');
            let activeRow = null;

            rows.forEach(row => {
                if (row.classList.contains('row-3')) {
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
                            document.getElementById('detailNis').innerText = 'NIS: ' + (d.nis || '-');
                            document.getElementById('detailNamaLengkap2').innerText = d.nama;
                            document.getElementById('detailKelas').innerText = d.kelas || '-';
                            document.getElementById('detailJk').innerText = d.jk || '-';
                            document.getElementById('detailTgllahir').innerText = d.tgllahir || '-';
                            document.getElementById('detailOrangTua').innerText = d.orangtua || '-';
                            document.getElementById('formHapusAnak').action = `/operator/data_siswa/${d.id}`;
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

            // Modal Anak Logic
            const modalAnak = document.getElementById('anakModal');
            const btnTambahAnak = document.getElementById('btnTambahAnak');
            const btnUbahDataAnak = document.getElementById('btnUbahDataAnak');
            const btnCloseModalAnakX = document.getElementById('btnCloseModalAnakX');
            const btnBatalAnakModal = document.getElementById('btnBatalAnakModal');
            const modalTitleAnak = document.getElementById('modalTitleAnak');
            const btnSubmitAnakModal = document.getElementById('btnSubmitAnakModal');
            const formMethodAnak = document.getElementById('formMethodAnak');
            const anakForm = document.getElementById('anakForm');

            const openModalAnak = (type = 'tambah') => {
                if (type === 'ubah' && activeRow) {
                    modalTitleAnak.innerText = 'Ubah Data Siswa';
                    btnSubmitAnakModal.innerText = 'Simpan Perubahan';
                    
                    const d = activeRow.dataset;
                    anakForm.action = `/operator/data_siswa/${d.id}`;
                    formMethodAnak.value = 'PUT';

                    document.getElementById('anakNama').value = d.nama || '';
                    document.getElementById('anakNis').value = d.nis || '';
                    document.getElementById('anakKelas').value = d.kelasid || '';
                    document.getElementById('anakJk').value = d.jk || '';
                    document.getElementById('anakTglLahir').value = d.tgllahir || '';

                } else {
                    modalTitleAnak.innerText = 'Tambah Data Siswa';
                    btnSubmitAnakModal.innerText = 'Tambah Siswa';
                    
                    anakForm.reset();
                    anakForm.action = `/operator/data_siswa`;
                    formMethodAnak.value = 'POST';
                }
                modalAnak.classList.add('active');
            };

            const closeModalAnak = () => {
                modalAnak.classList.remove('active');
            };

            if (btnTambahAnak) btnTambahAnak.addEventListener('click', () => openModalAnak('tambah'));
            if (btnUbahDataAnak) btnUbahDataAnak.addEventListener('click', () => openModalAnak('ubah'));
            if (btnCloseModalAnakX) btnCloseModalAnakX.addEventListener('click', closeModalAnak);
            if (btnBatalAnakModal) btnBatalAnakModal.addEventListener('click', closeModalAnak);

            modalAnak.addEventListener('click', (e) => {
                if (e.target === modalAnak) closeModalAnak();
            });

            // Search & Filter Logic
            const searchInput = document.getElementById('search-anak');
            const filterKelas = document.getElementById('filter-kelas');
            const filterStatus = document.getElementById('filter-status');

            function filterRows() {
                const query = searchInput.value.toLowerCase();
                const selectedClass = filterKelas.value;
                const selectedStatus = filterStatus.value;

                rows.forEach(row => {
                    if (!row.classList.contains('row-3')) return;
                    
                    const nama = (row.dataset.nama || '').toLowerCase();
                    const nis = (row.dataset.nis || '').toLowerCase();
                    const kelas = row.dataset.kelas || '';
                    const status = row.dataset.status || '';

                    const matchesSearch = nama.includes(query) || nis.includes(query);
                    let matchesClass = true;
                    if (selectedClass && selectedClass !== '') {
                        matchesClass = (kelas === selectedClass);
                    }

                    let matchesStatus = true;
                    if (selectedStatus && selectedStatus !== '') {
                        matchesStatus = (status === selectedStatus);
                    }

                    if (matchesSearch && matchesClass && matchesStatus) {
                        row.style.display = 'flex';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            if (searchInput) searchInput.addEventListener('input', filterRows);
            if (filterKelas) filterKelas.addEventListener('change', filterRows);
            if (filterStatus) filterStatus.addEventListener('change', filterRows);
        });
    </script>
</body>
</html>
