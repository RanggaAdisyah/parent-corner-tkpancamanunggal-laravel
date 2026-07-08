<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Kelola Kelas</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/Operator/kelola_data.css') }}">
</head>
<body>
    <div class="kelola-data-page">
        @include('partials.sidebar', ['active' => 'kelola-kelas'])

        <main class="main">
            <section class="background">
                <div class="container-3">
                    <section class="container-4">
                        <div class="container-5">
                            <div class="container-6">
                                <div class="div-2">
                                    <h1 class="text-6">Kelola Kelas</h1>
                                </div>
                                <div class="div-2">
                                    <p class="p">Tambahkan dan atur daftar kelas secara dinamis.</p>
                                </div>
                            </div>
                            <div class="action-buttons" aria-label="Aksi halaman">
                                <button id="btnTambahSiswa" class="button-3" type="button">
                                    <div class="container-7">
                                        <img class="icon-7" src="{{ asset('img/icon-19.svg') }}" alt="" />
                                    </div>
                                    <div class="text-wrapper-6">Tambah Kelas</div>
                                </button>
                            </div>
                        </div>

                        <div class="background-border">
                            <form action="#" method="get" role="search" aria-label="Cari kelas" style="flex: 1; display: flex; align-items: center; max-width: 400px;">
                                <input id="search-kelas" name="q" type="search" placeholder="Cari nama kelas atau tingkat..." aria-label="Cari nama kelas atau tingkat" style="width: 100%; padding: 10px 16px; border: 1px solid #e2e8f0; border-radius: 8px; outline: none; font-size: 14px; background: white;" />
                            </form>
                        </div>

                        <section class="table-wrapper" aria-label="Daftar Kelas">
                            <div class="table" role="table" aria-label="Tabel Kelas">
                                <header class="header" role="rowgroup">
                                    <div class="row" role="row">
                                        <div class="cell" role="columnheader">
                                            <div class="text-8">NAMA KELAS</div>
                                        </div>
                                        <div class="cell-2" role="columnheader">
                                            <div class="text-9">TINGKAT</div>
                                        </div>
                                    </div>
                                </header>
                                <div class="body" role="rowgroup">
                                    @foreach($kelasList as $kelas)
                                    @php $inisial = strtoupper(substr($kelas->nama_kelas, 0, 2)); @endphp
                                    <button class="row-3" type="button"
                                        aria-label="Lihat detail {{ $kelas->nama_kelas }}"
                                        data-id="{{ $kelas->id }}"
                                        data-tingkat="{{ $kelas->tingkat }}"
                                        data-nama="{{ $kelas->nama_kelas }}">
                                        <div class="data" role="cell">
                                            <div class="container-11">
                                                <div class="background-border-2" aria-hidden="true" style="display:flex; justify-content:center; align-items:center; background-color:#3b82f6; border-radius:50%; width:40px; height:40px;">
                                                    <div class="text-11" style="font-weight:bold; color:white; font-size:14px;">{{ $inisial }}</div>
                                                </div>
                                            </div>
                                            <div class="margin-2">
                                                <div class="div">
                                                    <div class="div-2">
                                                        <div class="text-16">{{ $kelas->nama_kelas }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="data-2" role="cell">
                                            <div class="text-18">{{ $kelas->tingkat }}</div>
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

            <aside class="background-7" aria-label="Detail Kelas">
                <div class="horizontal-border-2">
                    <div class="div">
                        <h2 class="text-27">Detail Kelas</h2>
                    </div>
                    <button class="button-4" type="button" aria-label="Tutup detail">
                        <div class="icon-wrapper">
                            <img class="icon-10" src="{{ asset('img/icon-4.svg') }}" alt="" />
                        </div>
                    </button>
                </div>
                <div class="container-12">
                    <section class="container-13" aria-label="Ringkasan">
                        <div class="heading-ananda" id="detailHeadingNama" style="font-size: 24px;">Nama Kelas</div>
                        <div class="margin-3">
                            <div class="container-14">
                                <div class="container-7">
                                    <div class="text-28" id="detailHeadingTingkat">TK - </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="background-8">
                    <a id="btnKelolaJadwal" href="#" class="button-6" style="background-color: #f59e0b; color: white; text-decoration: none; margin-bottom: 12px; border: none; display: flex; align-items: center; justify-content: center; gap: 8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        <div class="text-33" style="color: white; font-weight: 600;">Kelola Jadwal</div>
                    </a>
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
                        <div class="text-34">Hapus Kelas</div>
                    </button>
                </div>
            </aside>
            <form id="formHapusAkun" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        </main>
        <div class="overlay-shadow" id="detailOverlay" aria-hidden="true"></div>

        <!-- Modal Tambah/Ubah Kelas -->
        <div id="studentModal" class="modal-overlay">
            <div class="modal-content" style="max-width: 500px;">
                <div class="modal-header">
                    <div class="modal-title-wrapper">
                        <div class="modal-icon-bg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                        </div>
                        <h3 id="modalTitle" class="modal-title">Tambah Data Kelas</h3>
                    </div>
                    <button type="button" class="btn-close-modal" id="btnCloseModalX">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>

                <form id="studentForm" method="POST" action="{{ url('/operator/kelola-kelas') }}">
                    @csrf
                    <input type="hidden" name="_method" id="formMethod" value="POST" disabled>
                    <div class="modal-body">
                        <div class="form-section">
                            <div class="form-group">
                                <label class="form-label">Tingkat Kelas</label>
                                <select class="form-select" name="tingkat" required>
                                    <option value="">Pilih Tingkat</option>
                                    <option value="TK A">TK A</option>
                                    <option value="TK B">TK B</option>
                                </select>
                            </div>
                            <div class="form-group" style="margin-top: 15px;">
                                <label class="form-label">Nama Kelas (Grup) <span style="color:#64748b; font-size:12px; font-weight:normal;">(Opsional, jika kosong akan mengikuti Tingkat)</span></label>
                                <input type="text" name="nama_kelas" class="form-input" placeholder="Contoh: Bintang, Matahari...">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-modal-secondary" id="btnBatalModal">Batal</button>
                        <button type="submit" class="btn-modal-primary" id="btnSubmitModal">Tambah Kelas</button>
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
                    document.getElementById('detailHeadingTingkat').innerText = d.tingkat || '-';
                    document.getElementById('btnKelolaJadwal').href = '/operator/kelola-kelas/' + d.id + '/jadwal';

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
                    if (row.classList.contains('row-3') || row.classList.contains('row-2')) {
                        row.addEventListener('click', function() {
                            if (activeRow === this) closePanel();
                            else {
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
                            if (confirm('Apakah Anda yakin ingin menghapus kelas ini?')) {
                                formHapusAkun.action = '/operator/kelola-kelas/' + activeRow.dataset.id;
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
                        modalTitle.innerText = 'Ubah Data Kelas';
                        btnSubmitModal.innerText = 'Simpan Perubahan';
                        
                        const d = activeRow.dataset;
                        document.querySelector('#studentForm [name="nama_kelas"]').value = d.nama || '';
                        document.querySelector('#studentForm [name="tingkat"]').value = d.tingkat || '';

                        document.getElementById('studentForm').action = "{{ url('/operator/kelola-kelas') }}/" + d.id;
                        document.getElementById('formMethod').value = "PUT";
                        document.getElementById('formMethod').disabled = false;
                    } else {
                        modalTitle.innerText = 'Tambah Data Kelas';
                        btnSubmitModal.innerText = 'Tambah Kelas';
                        document.getElementById('studentForm').reset();
                        
                        document.getElementById('studentForm').action = "{{ url('/operator/kelola-kelas') }}";
                        document.getElementById('formMethod').value = "POST";
                        document.getElementById('formMethod').disabled = true;
                    }
                    modal.classList.add('active');
                };

                const closeModal = () => modal.classList.remove('active');

                if (btnTambahSiswa) btnTambahSiswa.addEventListener('click', () => openModal('tambah'));
                if (btnUbahData) btnUbahData.addEventListener('click', () => openModal('ubah'));
                if (btnCloseModalX) btnCloseModalX.addEventListener('click', closeModal);
                if (btnBatalModal) btnBatalModal.addEventListener('click', closeModal);

                modal.addEventListener('click', (e) => {
                    if (e.target === modal) closeModal();
                });
                // Search Logic
                const searchInput = document.getElementById('search-kelas');
                
                function filterRows() {
                    const query = searchInput.value.toLowerCase();
                    document.querySelectorAll('.row-3').forEach(row => {
                        const nama = (row.dataset.nama || '').toLowerCase();
                        const tingkat = (row.dataset.tingkat || '').toLowerCase();

                        if (nama.includes(query) || tingkat.includes(query)) {
                            row.style.display = 'flex';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                }
                
                if (searchInput) searchInput.addEventListener('input', filterRows);
            });
        </script>
    </div>
</body>
</html>
