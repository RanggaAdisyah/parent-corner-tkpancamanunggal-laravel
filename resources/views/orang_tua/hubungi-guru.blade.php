<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Hubungi Guru - Dashboard Orang Tua</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/dashboard.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/orang_tua/dashboard.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/orang_tua/hubungi-guru.css') }}">
</head>
<body>
    <div class="dashboard-guru">
        {{-- Sidebar Orang Tua --}}
        @include('partials.sidebar-orang-tua', ['active' => 'hubungi-guru'])

        <main class="main ot-main">

            {{-- Top Bar --}}
            <div class="hubungi-top-bar">
                <nav class="breadcrumb" aria-label="Breadcrumb">
                    <a href="{{ url('/orang-tua/dashboard') }}" class="breadcrumb-link">Dashboard</a>
                    <span class="breadcrumb-sep">&rsaquo;</span>
                    <span class="breadcrumb-active">Hubungi Guru</span>
                </nav>
                <div class="hubungi-top-actions">
                    <button class="header-icon-btn" aria-label="Toggle Dark Mode">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
                    </button>
                    <button class="header-icon-btn" aria-label="Notifikasi">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                    </button>
                </div>
            </div>

            {{-- Page Header --}}
            <header class="hubungi-header">
                <h1 class="hubungi-title">Hubungi Guru</h1>
                <p class="hubungi-subtitle">Konsultasi perkembangan ananda di sekolah</p>
            </header>

            {{-- Main Layout --}}
            <div class="hubungi-layout">

                {{-- Teacher Profile Card --}}
                <section class="teacher-card">
                    <div class="teacher-card-banner"></div>
                    <div class="teacher-card-body">
                        <div class="teacher-avatar-wrap">
                            <img src="https://picsum.photos/seed/guru-sarah/160/160" alt="Ibu Sarah Wijaya" class="teacher-avatar">
                            <span class="teacher-online" aria-label="Online"></span>
                        </div>

                        <h2 class="teacher-name">Ibu Sarah Wijaya, S.Pd</h2>

                        <div class="teacher-role-tag">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg>
                            Wali Kelas B1
                        </div>

                        <p class="teacher-bio">
                            Selamat datang, Ayah &amp; Bunda. Saya siap berdiskusi mengenai perkembangan,
                            potensi, dan keseharian ananda selama di sekolah.
                        </p>

                        <div class="teacher-actions">
                            <a href="#" class="btn-whatsapp">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.435 9.884-9.881 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
                                Hubungi via WhatsApp
                            </a>
                            <a href="#" class="btn-email">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                Kirim Email
                            </a>
                        </div>
                    </div>
                </section>

                {{-- Right Sidebar --}}
                <aside class="hubungi-sidebar">

                    {{-- Jam Konsultasi --}}
                    <div class="side-card jam-konsultasi-card">
                        <h3 class="side-card-title">
                            <span class="side-card-icon side-card-icon-orange">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                            </span>
                            Jam Konsultasi
                        </h3>
                        <ul class="jam-list">
                            <li class="jam-item">
                                <span class="jam-day">Senin – Kamis</span>
                                <span class="jam-time">08.00 – 14.00 WIB</span>
                            </li>
                            <li class="jam-item">
                                <span class="jam-day">Jumat</span>
                                <span class="jam-time">08.00 – 11.00 WIB</span>
                            </li>
                            <li class="jam-item">
                                <span class="jam-day">Sabtu – Minggu</span>
                                <span class="jam-time jam-libur">Libur</span>
                            </li>
                        </ul>
                        <div class="jam-info-box">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                            <p>Untuk keadaan mendesak di luar jam konsultasi, silakan tinggalkan pesan WhatsApp. Ibu guru akan membalas secepatnya.</p>
                        </div>
                    </div>

                    {{-- Riwayat Pesan --}}
                    <div class="side-card riwayat-pesan-card">
                        <h3 class="side-card-title">Riwayat Pesan</h3>
                        <div class="riwayat-empty">
                            <div class="riwayat-empty-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                            </div>
                            <p>Belum ada riwayat percakapan yang tersimpan melalui website.</p>
                        </div>
                    </div>

                </aside>

            </div>


            @include('partials.footer')
        </main>
    </div>
</body>
</html>
