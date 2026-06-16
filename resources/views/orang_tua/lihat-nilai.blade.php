<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Lihat Nilai - Dashboard Orang Tua</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/dashboard.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/orang_tua/dashboard.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/orang_tua/nilai.css') }}">
</head>
<body>
    <div class="dashboard-guru">
        {{-- Sidebar Orang Tua --}}
        @include('partials.sidebar-orang-tua', ['active' => 'lihat-nilai'])

        <main class="main ot-main">

            <header class="page-header">
                <div>
                    <h1 class="page-title">Laporan Nilai Perkembangan</h1>
                    <p class="page-subtitle">Pantau observasi dan penilaian guru untuk Ananda Budi.</p>
                </div>
            </header>

            {{-- Filter Section --}}
            <section class="filter-section">
                <div class="filter-group">
                    <label class="filter-label">Tahun & Semester</label>
                    <div class="filter-input-wrapper">
                        <svg class="filter-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        <select class="filter-select">
                            <option>Ganjil 2023/2024</option>
                            <option>Genap 2023/2024</option>
                        </select>
                    </div>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Minggu Ke-</label>
                    <div class="filter-input-wrapper">
                        <svg class="filter-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        <select class="filter-select">
                            <option>Minggu 3 (Agustus)</option>
                            <option>Minggu 2 (Agustus)</option>
                            <option>Minggu 1 (Agustus)</option>
                        </select>
                    </div>
                </div>
                <button class="filter-btn">
                    Tampilkan
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </button>
            </section>

            {{-- Result Categories --}}
            <section class="result-grid">
                {{-- Kognitif --}}
                <div class="category-card">
                    <header class="category-header">
                        <div class="category-title-wrap">
                            <div class="category-icon icon-kognitif">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a10 10 0 1 0 10 10 10 10 0 0 0-10-10zm0 18a8 8 0 1 1 8-8 8 8 0 0 1-8 8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            </div>
                            <h2 class="category-title">Kognitif</h2>
                        </div>
                        <div class="score-badge excellent">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                            95
                        </div>
                    </header>
                    <div class="category-body">
                        <span class="observation-label">Catatan Guru:</span>
                        <p class="observation-text">Ananda Budi sudah sangat baik dalam mengelompokkan bentuk geometri dasar dan mampu menyebutkan nama-nama bentuk tersebut tanpa bantuan. Ia sangat antusias saat bermain balok.</p>
                    </div>
                </div>

                {{-- Sosial Emosional --}}
                <div class="category-card">
                    <header class="category-header">
                        <div class="category-title-wrap">
                            <div class="category-icon icon-sosial">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            </div>
                            <h2 class="category-title">Sosial Emosional</h2>
                        </div>
                        <div class="score-badge good">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                            88
                        </div>
                    </header>
                    <div class="category-body">
                        <span class="observation-label">Catatan Guru:</span>
                        <p class="observation-text">Budi menunjukkan kemajuan besar dalam berbagi mainan dengan teman-teman. Terkadang masih terlihat malu jika diminta bernyanyi sendiri di depan kelas, namun mulai percaya diri.</p>
                    </div>
                </div>

                {{-- Bahasa --}}
                <div class="category-card">
                    <header class="category-header">
                        <div class="category-title-wrap">
                            <div class="category-icon icon-bahasa">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                            </div>
                            <h2 class="category-title">Bahasa</h2>
                        </div>
                        <div class="score-badge excellent">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                            92
                        </div>
                    </header>
                    <div class="category-body">
                        <span class="observation-label">Catatan Guru:</span>
                        <p class="observation-text">Kosakata Budi semakin kaya. Ia mampu menyusun kalimat dengan 4-5 kata untuk menceritakan pengalaman akhirnya pekannya dengan jelas dan antusias.</p>
                    </div>
                </div>

                {{-- Motorik Kasar & Halus --}}
                <div class="category-card">
                    <header class="category-header">
                        <div class="category-title-wrap">
                            <div class="category-icon icon-motorik">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20"></path><path d="M8 6l4-4 4 4"></path><path d="M8 18l4 4 4-4"></path></svg>
                            </div>
                            <h2 class="category-title">Fisik Motorik</h2>
                        </div>
                        <div class="score-badge excellent">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                            90
                        </div>
                    </header>
                    <div class="category-body">
                        <span class="observation-label">Catatan Guru:</span>
                        <p class="observation-text">Motorik kasar Budi berkembang baik, ia bisa melompat dengan satu kaki dan menjaga keseimbangan. Untuk motorik halus, memegang pensil warna sudah lebih kuat dan tidak mudah keluar garis.</p>
                    </div>
                </div>

            </section>

            <section class="result-grid" style="margin-top: 24px;">
                {{-- Seni --}}
                <div class="category-card">
                    <header class="category-header">
                        <div class="category-title-wrap">
                            <div class="category-icon icon-seni">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2c4.97 0 9 4.03 9 9 0 2.12-.74 4.07-1.97 5.61-.41.51-.81 1.05-.81 1.74 0 .91.73 1.65 1.64 1.65H20c.55 0 1 .45 1 1v1c0 1.1-.9 2-2 2H12c-4.97 0-9-4.03-9-9s4.03-9 9-9z"></path><circle cx="8.5" cy="10.5" r="1.5"></circle><circle cx="10.5" cy="6.5" r="1.5"></circle><circle cx="14.5" cy="6.5" r="1.5"></circle><circle cx="16.5" cy="10.5" r="1.5"></circle></svg>
                            </div>
                            <h2 class="category-title">Seni</h2>
                        </div>
                        <div class="score-badge excellent">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                            93
                        </div>
                    </header>
                    <div class="category-body">
                        <span class="observation-label">Catatan Guru:</span>
                        <p class="observation-text">Budi sangat kreatif dalam kegiatan mewarnai dan mencampur warna. Ia juga mulai menunjukkan ketertarikan pada alat musik ritmis saat kegiatan kesenian.</p>
                    </div>
                </div>

                {{-- Agama & Moral --}}
                <div class="category-card">
                    <header class="category-header">
                        <div class="category-title-wrap">
                            <div class="category-icon icon-agama">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                            </div>
                            <h2 class="category-title">Agama & Moral</h2>
                        </div>
                        <div class="score-badge excellent">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                            96
                        </div>
                    </header>
                    <div class="category-body">
                        <span class="observation-label">Catatan Guru:</span>
                        <p class="observation-text">Budi sudah terbiasa memimpin doa sebelum makan dengan suara yang lantang. Ia juga sangat peduli dan suka membantu merapikan mainan tanpa diminta.</p>
                    </div>
                </div>
            </section>


            @include('partials.footer')
        </main>
    </div>
</body>
</html>
