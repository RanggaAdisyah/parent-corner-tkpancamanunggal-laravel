<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Dashboard Operator</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/operator/dashboard.css') }}">
</head>
<body>
    <div class="dashboard-operator">
        @include('partials.sidebar', ['active' => 'dashboard'])

        <main class="main">
            <section class="container-3" aria-label="Header dashboard">
                <div class="container-4">
                    <div class="div-2">
                        <h1 class="text-6">Selamat Datang Kembali, Operator</h1>
                    </div>
                    <div class="div-2">
                        <p class="p">Berikut adalah ringkasan aktivitas sistem hari ini.</p>
                    </div>
                </div>


            </section>

            <section class="heading" aria-labelledby="aksi-cepat-title">
                <h2 class="text-8" id="aksi-cepat-title">Pilih Aksi Cepat</h2>
            </section>

            <section class="container-6" aria-label="Aksi cepat" style="grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));">
                <a class="link-3" href="{{ route('operator.kelola_orang_tua') }}" aria-label="Akun Orang Tua" style="grid-column: auto; grid-row: auto;">
                    <div class="background-2">
                        <div class="div">
                            <img class="icon-2" src="{{ asset('icon/operator/akun.svg') }}" alt="" />
                        </div>
                    </div>
                    <div class="heading-2"><div class="text-9">Akun Orang Tua</div></div>
                    <div class="container-7"><p class="text-10">Tambah, edit, atau nonaktifkan akun orang tua murid.</p></div>
                    <div class="container-8"><div class="text-11">Akses Menu</div></div>
                </a>

                <a class="link-3" href="{{ route('operator.data_siswa') }}" aria-label="Data Siswa" style="grid-column: auto; grid-row: auto;">
                    <div class="background-2" style="background-color: #dbeafe;">
                        <div class="div">
                            <img class="icon-2" src="{{ asset('icon/operator/akun.svg') }}" alt="" />
                        </div>
                    </div>
                    <div class="heading-2"><div class="text-9">Data Siswa</div></div>
                    <div class="container-7"><p class="text-10">Lihat dan kelola data seluruh siswa aktif.</p></div>
                    <div class="container-8"><div class="text-11">Akses Menu</div></div>
                </a>

                <a class="link-3" href="{{ route('operator.kelola-guru') }}" aria-label="Akun Guru" style="grid-column: auto; grid-row: auto;">
                    <div class="background-2" style="background-color: #fef08a;">
                        <div class="div">
                            <img class="icon-2" src="{{ asset('icon/operator/akun.svg') }}" alt="" />
                        </div>
                    </div>
                    <div class="heading-2"><div class="text-9">Akun Guru</div></div>
                    <div class="container-7"><p class="text-10">Kelola data dan akun seluruh staf pengajar.</p></div>
                    <div class="container-8"><div class="text-11">Akses Menu</div></div>
                </a>

                <a class="link-4" href="{{ route('operator.kelola-kelas') }}" aria-label="Kelola Kelas" style="grid-column: auto; grid-row: auto;">
                    <div class="background-3">
                        <div class="div">
                            <img class="icon-11" src="{{ asset('icon/operator/jadwal.svg') }}" alt="" />
                        </div>
                    </div>
                    <div class="heading-2"><div class="text-12">Kelola Kelas</div></div>
                    <div class="container-7"><p class="text-13">Atur daftar kelas dan wali kelas yang bertugas.</p></div>
                    <div class="container-8"><div class="text-14">Akses Menu</div></div>
                </a>

                <a class="link-4" href="{{ route('operator.kalender-kegiatan') }}" aria-label="Kalender Kegiatan" style="grid-column: auto; grid-row: auto;">
                    <div class="background-3" style="background-color: #d1fae5;">
                        <div class="div">
                            <img class="icon-11" src="{{ asset('icon/operator/jadwal.svg') }}" alt="" />
                        </div>
                    </div>
                    <div class="heading-2"><div class="text-12">Kalender Kegiatan</div></div>
                    <div class="container-7"><p class="text-13">Jadwalkan dan pantau kegiatan sekolah.</p></div>
                    <div class="container-8"><div class="text-14">Akses Menu</div></div>
                </a>

                <a class="link-5" href="{{ route('operator.pengumuman') }}" aria-label="Pengumuman" style="grid-column: auto; grid-row: auto;">
                    <div class="background-4">
                        <div class="div">
                            <img class="icon-5" src="{{ asset('icon/operator/pengumuman.svg') }}" alt="" />
                        </div>
                    </div>
                    <div class="heading-2"><div class="text-15">Pengumuman</div></div>
                    <div class="container-7"><p class="text-16">Publikasikan informasi penting untuk wali murid.</p></div>
                    <div class="container-9"><div class="text-17">Akses Menu</div></div>
                </a>

                <a class="link-6" href="{{ route('operator.galeri') }}" aria-label="Galeri Kegiatan" style="grid-column: auto; grid-row: auto;">
                    <div class="background-5">
                        <div class="div">
                            <img class="icon-14" src="{{ asset('icon/operator/galeri.svg') }}" alt="" />
                        </div>
                    </div>
                    <div class="heading-2"><div class="text-18" style="font-size: 16px;">Galeri Kegiatan</div></div>
                    <div class="container-7"><p class="text-19">Dokumentasikan kegiatan siswa ke dalam galeri.</p></div>
                    <div class="container-9"><div class="text-20">Akses Menu</div></div>
                </a>

                <a class="link-6" href="{{ route('operator.backup.semua') }}" aria-label="Backup Database" style="grid-column: auto; grid-row: auto;">
                    <div class="background-5" style="background-color: #fee2e2;">
                        <div class="div">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        </div>
                    </div>
                    <div class="heading-2"><div class="text-18" style="font-size: 16px; ">Backup Database</div></div>
                    <div class="container-7"><p class="text-19">Unduh seluruh data dalam format Excel.</p></div>
                    <div class="container-9"><div class="text-20" style="color: #dc2626;">Unduh Sekarang</div></div>
                </a>
            </section>


            <section class="container-10" aria-label="Ringkasan data">
                <section class="background-border-3" aria-labelledby="pengumuman-terkini-title">
                    <div class="container-11">
                        <div class="div">
                            <h2 class="text-21" id="pengumuman-terkini-title">Pengumuman Terkini</h2>
                        </div>
                        <div class="div">
                            <a class="text-22" href="#">Lihat Semua</a>
                        </div>
                    </div>

                    <div class="container-12">
                        @forelse($pengumumanTerkini as $item)
                        <a href="{{ route('operator.pengumuman.edit', $item->id) }}" style="text-decoration: none; color: inherit; display: block; width: 100%;">
                            <article class="background-border-4" style="cursor: pointer; transition: background 0.15s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background=''">
                                <div class="container-4">
                                    <div class="div-2">
                                        <h3 class="text-23">{{ $item->judul }}</h3>
                                    </div>
                                    <div class="div-2">
                                        <p class="text-24">
                                            {{ Str::limit(strip_tags($item->isi_pesan), 80) }}
                                        </p>
                                    </div>
                                    <div class="container-13">
                                        <div class="text-25">{{ $item->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                            </article>
                        </a>
                        @empty
                        <p style="color:#94a3b8; font-size:14px; padding:16px 0;">Belum ada pengumuman.</p>
                        @endforelse
                    </div>
                </section>

                <section class="background-border-5" aria-labelledby="status-data-title">
                    <div class="div-2">
                        <h2 class="text-wrapper-6" id="status-data-title">Status Data</h2>
                    </div>

                    <div class="container-14">
                        <div class="container-15">
                            <div class="container-16">
                                <div class="div">
                                    <div class="text-29">Total Siswa</div>
                                </div>
                                <div class="div">
                                    <div class="text-30" style="width: auto; text-align: right;">{{ $totalSiswa }}</div>
                                </div>
                            </div>

                        </div>

                        <div class="container-15">
                            <div class="container-17">
                                <div class="div">
                                    <div class="text-31">Total Guru</div>
                                </div>
                                <div class="div">
                                    <div class="text-32" style="width: auto; text-align: right;">{{ $totalGuru }}</div>
                                </div>
                            </div>

                        </div>

                        <div class="container-15">
                            <div class="container-17">
                                <div class="div">
                                    <div class="text-31" style="color: #64748b;">Total Galeri</div>
                                </div>
                                <div class="div">
                                    <div class="text-32" style="width: auto; text-align: right;">{{ $totalFoto }}</div>
                                </div>
                            </div>

                        </div>

                        <div class="container-15">
                            <div class="container-16">
                                <div class="div">
                                    <div class="text-33">Galeri Baru (Bulan Ini)</div>
                                </div>
                                <div class="div">
                                    <div class="text-34" style="width: auto; text-align: right;">{{ $fotoBulanIni }}</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
            </section>

            @include('partials.footer')
        </main>
    </div>
</body>
</html>