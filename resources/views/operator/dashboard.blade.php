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
                <div class="div">
                    <img class="icon-8" src="{{ asset('img/icon-4.svg') }}" alt="" />
                </div>
                <h2 class="text-8" id="aksi-cepat-title">Pilih Aksi Cepat</h2>
            </section>

            <section class="container-6" aria-label="Aksi cepat" style="grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));">
                <a class="link-3" href="{{ route('operator.kelola-siswa') }}" aria-label="Kelola Akun Siswa" style="grid-column: auto; grid-row: auto;">
                    <div class="background-2">
                        <div class="div">
                            <img class="icon-2" src="{{ asset('icon/operator/akun.svg') }}" alt="" />
                        </div>
                    </div>
                    <div class="heading-2">
                        <div class="text-9">Akun Siswa</div>
                    </div>
                    <div class="container-7">
                        <p class="text-10">
                            Tambah, edit, atau nonaktifkan akun siswa dan orang tua.
                        </p>
                    </div>
                    <div class="container-8">
                        <div class="text-11">Akses Menu</div>
                        <div class="div">
                            <img class="icon-9" src="{{ asset('img/icon-25.svg') }}" alt="" />
                        </div>
                    </div>
                    <div class="img-wrapper" aria-hidden="true">
                        <img class="icon-10" src="{{ asset('img/icon.svg') }}" alt="" />
                    </div>
                </a>

                <a class="link-3" href="{{ route('operator.kelola-guru') }}" aria-label="Kelola Akun Guru" style="grid-column: auto; grid-row: auto;">
                    <div class="background-2" style="background-color: #fef08a;">
                        <div class="div">
                            <img class="icon-2" src="{{ asset('icon/operator/akun.svg') }}" alt="" />
                        </div>
                    </div>
                    <div class="heading-2">
                        <div class="text-9">Akun Guru</div>
                    </div>
                    <div class="container-7">
                        <p class="text-10">
                            Kelola data, tambah atau nonaktifkan akun staf pengajar.
                        </p>
                    </div>
                    <div class="container-8">
                        <div class="text-11">Akses Menu</div>
                        <div class="div">
                            <img class="icon-9" src="{{ asset('img/icon-25.svg') }}" alt="" />
                        </div>
                    </div>
                    <div class="img-wrapper" aria-hidden="true">
                        <img class="icon-10" src="{{ asset('img/icon.svg') }}" alt="" />
                    </div>
                </a>

                <a class="link-4" href="{{ route('operator.kelola-jadwal') }}" aria-label="Kelola Jadwal" style="grid-column: auto; grid-row: auto;">
                    <div class="background-3">
                        <div class="div">
                            <img class="icon-11" src="{{ asset('icon/operator/jadwal.svg') }}" alt="" />
                        </div>
                    </div>
                    <div class="heading-2">
                        <div class="text-12">Kelola Jadwal</div>
                    </div>
                    <div class="container-7">
                        <p class="text-13">
                            Atur jadwal pelajaran mingguan dan kegiatan khusus.
                        </p>
                    </div>
                    <div class="container-8">
                        <div class="text-14">Akses Menu</div>
                        <div class="div">
                            <img class="icon-9" src="{{ asset('img/icon-24.svg') }}" alt="" />
                        </div>
                    </div>
                    <div class="img-wrapper" aria-hidden="true">
                        <img class="icon-12" src="{{ asset('img/icon-20.svg') }}" alt="" />
                    </div>
                </a>

                <a class="link-5" href="{{ route('operator.pengumuman') }}" aria-label="Buat Pengumuman" style="grid-column: auto; grid-row: auto;">
                    <div class="background-4">
                        <div class="div">
                            <img class="icon-5" src="{{ asset('icon/operator/pengumuman.svg') }}" alt="" />
                        </div>
                    </div>
                    <div class="heading-2">
                        <div class="text-15">Pengumuman</div>
                    </div>
                    <div class="container-7">
                        <p class="text-16">
                            Publikasikan informasi penting untuk wali murid.
                        </p>
                    </div>
                    <div class="container-9">
                        <div class="text-17">Akses Menu</div>
                        <div class="div">
                            <img class="icon-9" src="{{ asset('img/icon-12.svg') }}" alt="" />
                        </div>
                    </div>
                    <div class="img-wrapper" aria-hidden="true">
                        <img class="icon-13" src="{{ asset('img/icon-3.svg') }}" alt="" />
                    </div>
                </a>

                <a class="link-6" href="{{ route('operator.galeri') }}" aria-label="Galeri Kegiatan" style="grid-column: auto; grid-row: auto;">
                    <div class="background-5">
                        <div class="div">
                            <img class="icon-14" src="{{ asset('icon/operator/galeri.svg') }}" alt="" />
                        </div>
                    </div>
                    <div class="heading-2">
                        <div class="text-18" style="font-size: 16px;">Galeri Kegiatan</div>
                    </div>
                    <div class="container-7">
                        <p class="text-19">
                            Dokumentasikan kegiatan siswa ke dalam galeri.
                        </p>
                    </div>
                    <div class="container-9">
                        <div class="text-20">Akses Menu</div>
                        <div class="div">
                            <img class="icon-9" src="{{ asset('img/icon-10.svg') }}" alt="" />
                        </div>
                    </div>
                    <div class="img-wrapper" aria-hidden="true">
                        <img class="icon-12" src="{{ asset('img/icon-14.svg') }}" alt="" />
                    </div>
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
                        <article class="background-border-4">
                            <div class="background-6" aria-hidden="true">
                                <div class="div">
                                    <img class="icon-15" src="{{ asset('img/icon-16.svg') }}" alt="" />
                                </div>
                            </div>
                            <div class="container-4">
                                <div class="div-2">
                                    <h3 class="text-23">Libur Nasional &amp; Cuti Bersama</h3>
                                </div>
                                <div class="div-2">
                                    <p class="text-24">
                                        Diberitahukan kepada seluruh wali murid bahwa sekolah diliburkan pada tanggal...
                                    </p>
                                </div>
                                <div class="container-13">
                                    <div class="div">
                                        <img class="icon-16" src="{{ asset('img/icon-22.svg') }}" alt="" />
                                    </div>
                                    <div class="text-25">2 jam yang lalu</div>
                                </div>
                            </div>
                        </article>

                        <article class="background-border-4">
                            <div class="background-7" aria-hidden="true">
                                <div class="div">
                                    <img class="icon-17" src="{{ asset('img/icon-2.svg') }}" alt="" />
                                </div>
                            </div>
                            <div class="container-4">
                                <div class="div-2">
                                    <h3 class="text-26">Kegiatan Menanam Pohon</h3>
                                </div>
                                <div class="div-2">
                                    <p class="text-27">
                                        Siswa diharapkan membawa perlengkapan berkebun sederhana untuk kegiatan besok...
                                    </p>
                                </div>
                                <div class="container-13">
                                    <div class="div">
                                        <img class="icon-16" src="{{ asset('img/image.svg') }}" alt="" />
                                    </div>
                                    <div class="text-28">Kemarin</div>
                                </div>
                            </div>
                        </article>
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
                                    <div class="text-30" style="width: auto; text-align: right;">124</div>
                                </div>
                            </div>
                            <div class="background-wrapper" aria-label="Total siswa 75 persen">
                                <div class="background-8"></div>
                            </div>
                        </div>

                        <div class="container-15">
                            <div class="container-17">
                                <div class="div">
                                    <div class="text-31">Total Guru</div>
                                </div>
                                <div class="div">
                                    <div class="text-32" style="width: auto; text-align: right;">12</div>
                                </div>
                            </div>
                            <div class="background-wrapper" aria-label="Total guru 45 persen">
                                <div class="background-9"></div>
                            </div>
                        </div>

                        <div class="container-15">
                            <div class="container-17">
                                <div class="div">
                                    <div class="text-31" style="color: #64748b;">Total Foto</div>
                                </div>
                                <div class="div">
                                    <div class="text-32" style="width: auto; text-align: right;">350</div>
                                </div>
                            </div>
                            <div class="background-wrapper" aria-label="Total foto 80 persen">
                                <div class="background-9" style="background-color: #a855f7; width: 80%;"></div>
                            </div>
                        </div>

                        <div class="container-15">
                            <div class="container-16">
                                <div class="div">
                                    <div class="text-33">Foto Baru (Bulan Ini)</div>
                                </div>
                                <div class="div">
                                    <div class="text-34" style="width: auto; text-align: right;">48</div>
                                </div>
                            </div>
                            <div class="background-wrapper" aria-label="Foto baru bulan ini 30 persen">
                                <div class="background-10"></div>
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