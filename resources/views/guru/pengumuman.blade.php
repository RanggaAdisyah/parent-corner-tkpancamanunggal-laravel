<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Buat Pengumuman Baru - Dashboard Guru</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/pengumuman.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/dashboard.css') }}">
</head>
<body>
    <div class="dashboard-guru">
        @include('partials.sidebar-guru', ['active' => 'buat-pengumuman'])

        <main class="main">
            <header class="header-top">
                <div class="header-left">
                    <h1 class="page-title-main">Pengumuman</h1>
                    <nav class="breadcrumb">
                        <span>Portal Guru</span>
                        <span>›</span>
                        <span class="breadcrumb-active">Buat Pengumuman</span>
                    </nav>
                </div>
                <div class="header-right">
                    <!-- Icons for Theme/Notification could go here -->
                </div>
            </header>

            <a href="{{ url('/guru/daftar-pengumuman') }}" class="back-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                Kembali ke Daftar Pengumuman
            </a>

            <section class="title-section">
                <h2 class="title-text">Buat Pengumuman Baru</h2>
                <p class="subtitle-text">Buat dan bagikan informasi kepada wali murid.</p>
            </section>

            <div class="form-card">
                <div class="form-body">
                    <div class="form-group">
                        <div class="label-row">
                            <label class="form-label">Judul Pengumuman</label>
                            <span class="label-required">*</span>
                        </div>
                        <input type="text" class="input-text" placeholder="Contoh: Kegiatan Berenang Hari Jumat">
                    </div>

                    <div class="form-group">
                        <div class="label-row">
                            <label class="form-label">Isi Pengumuman</label>
                            <span class="label-required">*</span>
                        </div>
                        <textarea class="input-textarea" placeholder="Tuliskan detail pengumuman, waktu, tempat, dan perlengkapan yang perlu dibawa..."></textarea>
                    </div>

                    <div class="photo-section">
                        <div class="photo-header">
                            <label class="photo-label">Lampiran Foto</label>
                            <span class="photo-optional">Opsional</span>
                        </div>
                        <div class="photo-grid">
                            <div class="upload-box">
                                <div class="upload-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                                </div>
                                <span class="upload-text">Klik untuk upload foto</span>
                                <span class="upload-subtext">Maksimal 5MB (JPG, PNG)</span>
                            </div>
                            <div class="preview-box">
                                <img src="{{ asset('img/placeholder-photo.jpg') }}" alt="Preview" class="preview-img" onerror="this.src='https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&q=80&w=1000'">
                                <span class="cover-badge">COVER</span>
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="form-footer">
                    <button class="btn-cancel">Batal</button>
                    <button class="btn-submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                        Kirim Pengumuman
                    </button>
                </footer>
            </div>

            @include('partials.footer')
        </main>
    </div>
</body>
</html>
