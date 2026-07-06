<!DOCTYPE html>
<html lang="id">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Kelola Akun orang tua</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/Operator/kelola_orang_tua.css') }}">
</head>

<body>
    <div class="kelola-akun-siswa">
        @include('partials.sidebar', ['active' => 'akun_orang_tua'])

        <main class="main">
            <section class="background">
                <div class="container-3">
                    <section class="container-4">
                        <div class="container-5">
                            <div class="container-6">
                                <div class="div-2">
                                    <h1 class="text-6">Kelola Akun orang tua</h1>
                                </div>
                                <div class="div-2">
                                    <p class="p">Pilih siswa untuk melihat detail informasi.</p>
                                </div>
                            </div>

                            <div class="action-buttons" aria-label="Aksi halaman">
                                <a href="{{ route('operator.kelola_orang_tua.buat') }}" class="button-3" style="text-decoration: none;">
                                    <div class="container-7">
                                        <img class="icon-7" src="{{ asset('img/icon-19.svg') }}" alt="" />
                                    </div>
                                    <div class="text-wrapper-6">Tambah Akun</div>
                                </a>
                            </div>
                        </div>
                        <div class="background-border">
                            <form action="#" method="get" role="search" aria-label="Cari orang tua" style="flex: 1; display: flex; align-items: center; max-width: 400px; margin-right: auto;">
                                <input id="search-orang-tua" name="q" type="search" placeholder="Cari nama orang tua atau nama anak..." aria-label="Cari orang tua" style="width: 100%; padding: 10px 16px; border: 1px solid #e2e8f0; border-radius: 8px; outline: none; font-size: 14px; background: white;" />
                            </form>
                            
                            <div class="options-wrapper" style="display: flex; gap: 10px;">
                                <select id="filter-kelas" style="padding: 8px 12px; border: 1px solid #e2e8f0; border-radius: 8px; outline: none; font-size: 14px; background: white; cursor: pointer; min-width: 130px; appearance: auto;" aria-label="Filter kelas">
                                    <option selected>Semua Kelas</option>
                                </select>
                            </div>
                        </div>
                        
                        <section class="table-wrapper" aria-label="Daftar akun orang tua">
                            <div class="table" role="table" aria-label="Tabel akun orang tua">
                                <header class="header" role="rowgroup">
                                    <div class="row" role="row">
                                        <div class="cell" role="columnheader">
                                            <div class="text-8">USERNAME (NO HP)</div>
                                        </div>
                                        <div class="cell-4" role="columnheader">
                                            <div class="text-11">AKSI</div>
                                        </div>
                                    </div>
                                </header>

                                <div class="body" role="rowgroup">
                                    @foreach($daftarOrangTua as $orangTua)
                                    @php
                                        // Ambil data anak pertama jika ada
                                        $siswa = $orangTua->siswas->first();
                                        $namaSiswa = $siswa ? $siswa->nama : 'Belum ada data siswa';
                                        $nisSiswa = $siswa ? $siswa->nis : '-';
                                        $kelasSiswa = $siswa ? $siswa->kelas : '-';
                                        
                                        $username = $orangTua->user->username ?? $orangTua->no_hp ?? '-';
                                        $inisial = strtoupper(substr($orangTua->nama_ayah, 0, 2));
                                        $emailOrangTua = $orangTua->user ? $orangTua->user->email : '';
                                    @endphp
                                    <button class="row-3" type="button"
                                        aria-label="Lihat detail Orang Tua {{ $orangTua->nama_ayah }}"
                                        data-ayah="{{ $orangTua->nama_ayah }}"
                                        data-ibu="{{ $orangTua->nama_ibu }}"
                                        data-wa="{{ $orangTua->no_hp }}"
                                        data-alamat="{{ $orangTua->alamat }}"
                                        data-email="{{ $emailOrangTua }}"
                                        data-id="{{ $orangTua->user_id }}"
                                        data-namasiswa="{{ $orangTua->siswas->pluck('nama')->implode(', ') }}"
                                        data-kelassiswa="{{ $orangTua->siswas->pluck('kelas')->implode(', ') }}">
                                        
                                        <div class="data" role="cell" style="flex:1;">
                                            <div class="container-11">
                                                <div class="background-border-2" aria-hidden="true" style="display:flex; justify-content:center; align-items:center; background-color:#3b82f6; border-radius:50%; width:40px; height:40px;">
                                                    <div class="text-11" style="font-weight:bold; color:white; font-size:14px;">{{ $inisial }}</div>
                                                </div>
                                            </div>
                                            <div class="margin-2">
                                                <div class="div">
                                                    <div class="div-2">
                                                        <div class="text-16" style="font-weight:600; color:#1e293b;">{{ $orangTua->nama_ayah }} / {{ $orangTua->nama_ibu }}</div>
                                                    </div>
                                                    <div class="div-2">
                                                        <div class="text-17" style="color:#64748b; font-size:13px;">Username: {{ $username }}</div>
                                                    </div>
                                                </div>
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
                    <section class="container-13" aria-label="Ringkasan siswa">
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
                            <div class="text-30" id="data-siswa-heading">DATA SISWA</div>
                        </div>

                        <div class="container-16">
                            <div class="container-17">
                                <div class="div-2">
                                    <div class="text-wrapper-8">Siswa Tertaut</div>
                                </div>
                                <div class="div-2" style="display:flex; flex-direction:column; gap:8px;">
                                    <div class="text-wrapper-9" id="detailNamaLengkap">Ananda Rizky Pratama</div>
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
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const detailPanel = document.querySelector('.background-7');
            const overlay = document.getElementById('detailOverlay');
            const closeBtn = document.querySelector('.button-4');
            const studentRows = document.querySelectorAll('.table button.row-3');
            let activeRow = null;

            const openPanel = (row) => {
                const d = row.dataset;
                
                document.getElementById('detailHeadingNama').innerText = d.ayah || '-';
                document.getElementById('detailHeadingNis').innerText = 'Orang Tua Murid';
                document.getElementById('detailHeadingInisial').innerText = d.ayah ? d.ayah.substring(0,2).toUpperCase() : 'W';
                document.getElementById('detailNamaLengkap').innerText = d.namasiswa || '-';
                
                document.getElementById('detailAyah').innerText = d.ayah || '-';
                document.getElementById('detailIbu').innerText = d.ibu || '-';
                document.getElementById('detailWaLink').innerText = d.wa || '-';
                document.getElementById('detailWaLink').href = 'tel:' + (d.wa || '');
                document.getElementById('detailAlamat').innerText = d.alamat || '-';

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
                row.addEventListener('click', function() {
                    if (activeRow === this) {
                        closePanel();
                    } else {
                        if (activeRow) activeRow.classList.remove('selected-row');
                        openPanel(this);
                    }
                });
            });

            if (closeBtn) closeBtn.addEventListener('click', closePanel);
            if (overlay) overlay.addEventListener('click', closePanel);

            // Ubah Data dan Hapus
            const btnUbahData = document.getElementById('btnUbahData');
            const btnHapusAkun = document.getElementById('btnHapusAkun');
            const formHapusAkun = document.getElementById('formHapusAkun');
            
            if (btnUbahData) {
                btnUbahData.addEventListener('click', () => {
                    if (activeRow && activeRow.dataset.id) {
                        window.location.href = `{{ url('/operator/kelola_orang_tua') }}/${activeRow.dataset.id}/edit`;
                    }
                });
            }

            if (btnHapusAkun) {
                btnHapusAkun.addEventListener('click', () => {
                    if (activeRow && activeRow.dataset.id) {
                        if (confirm('Apakah Anda yakin ingin menghapus akun orang tua ini beserta aksesnya? Data siswa tidak akan terhapus.')) {
                            formHapusAkun.action = '{{ url("/operator/kelola_orang_tua") }}/' + activeRow.dataset.id;
                            formHapusAkun.submit();
                        }
                    }
                });
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-orang-tua');
            const filterKelas = document.getElementById('filter-kelas');
            const rows = document.querySelectorAll('.row-3');

            // Populate class filter dynamically from data-kelassiswa
            let classes = new Set();
            rows.forEach(row => {
                const k = row.getAttribute('data-kelassiswa');
                if (k) {
                    k.split(',').forEach(item => classes.add(item.trim()));
                }
            });
            classes.forEach(c => {
                if (c && c !== '-') {
                    const opt = document.createElement('option');
                    opt.value = c;
                    opt.textContent = c;
                    filterKelas.appendChild(opt);
                }
            });

            function filterRows() {
                const query = searchInput.value.toLowerCase();
                const selectedClass = filterKelas.value;

                rows.forEach(row => {
                    const namaAyah = (row.getAttribute('data-ayah') || '').toLowerCase();
                    const namaIbu = (row.getAttribute('data-ibu') || '').toLowerCase();
                    const noWa = (row.getAttribute('data-wa') || '').toLowerCase();
                    const namaSiswa = (row.getAttribute('data-namasiswa') || '').toLowerCase();
                    const kelasSiswa = row.getAttribute('data-kelassiswa') || '';

                    // The row matches if any of these match the query
                    const matchesSearch = namaAyah.includes(query) || 
                                          namaIbu.includes(query) || 
                                          noWa.includes(query) || 
                                          namaSiswa.includes(query);

                    let matchesClass = true;
                    if (selectedClass !== 'Semua Kelas') {
                        matchesClass = kelasSiswa.includes(selectedClass);
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
        });
    </script>
</body>
</html>
