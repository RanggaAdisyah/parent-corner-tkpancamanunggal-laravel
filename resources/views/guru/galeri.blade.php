<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Unggah Foto Kegiatan - Dashboard Guru</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/galeri.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/dashboard.css') }}">
</head>
<body>
    <div class="dashboard-guru">
        @include('partials.sidebar-guru', ['active' => 'unggah-foto'])

        <main class="main">
            <nav class="breadcrumb">
                <span class="breadcrumb-item">Komunikasi</span>
                <span class="breadcrumb-separator">›</span>
                <span class="breadcrumb-item breadcrumb-active">Unggah Foto</span>
            </nav>

            <header class="page-header">
                <h1 class="page-title">Unggah Foto Kegiatan</h1>
                <div class="class-badge">
                    <div class="badge-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg>
                    </div>
                    <div class="badge-info">
                        <span class="badge-label">Kelas Aktif</span>
                        <span class="badge-value">Kelompok B - Matahari</span>
                    </div>
                </div>
            </header>

            <section class="upload-card">
                <div class="section-label-row">
                    <h2 class="section-title">Area Unggah Foto</h2>
                    <span class="limit-badge">Maks 5MB (JPG, PNG)</span>
                </div>

                <div class="dropzone-area" id="dropzone">
                    <div class="upload-icon-bg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                    </div>
                    <h3 class="dropzone-title">Seret & Lepas Foto Disini</h3>
                    <p class="dropzone-subtitle">atau klik untuk memilih file dari komputer</p>
                    <input type="file" id="fileInput" hidden accept="image/*">
                    <button class="btn-select" onclick="document.getElementById('fileInput').click()">Pilih Foto</button>
                </div>

                <div class="caption-section">
                    <label class="caption-label">Keterangan Foto</label>
                    <span class="caption-subtitle">Berikan deskripsi singkat tentang kegiatan yang dilakukan anak-anak untuk orang tua.</span>
                    <textarea class="caption-textarea" placeholder="Contoh: Hari ini anak-anak belajar menanam bunga matahari di kebun sekolah..."></textarea>
                </div>

                <footer class="form-footer">
                    <button class="btn-cancel">Batal</button>
                    <button class="btn-submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                        Unggah Sekarang
                    </button>
                </footer>
            </section>

            <p class="footer-note">
                Foto yang diunggah akan langsung tersedia di aplikasi orang tua siswa. Pastikan tidak ada informasi sensitif yang terlihat dalam foto.
            </p>

            @include('partials.footer')
        </main>
    </div>
</body>
</html>
