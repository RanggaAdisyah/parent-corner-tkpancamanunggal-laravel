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
        @include('partials.sidebar_guru', ['active' => 'buat-pengumuman'])

        <main class="main">


            <a href="{{ url('/guru/daftar-pengumuman') }}" class="back-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                Kembali ke Daftar Pengumuman
            </a>

            <section class="title-section">
                <h2 class="title-text">Buat Pengumuman Baru</h2>
                <p class="subtitle-text">Buat dan bagikan informasi kepada wali murid.</p>
            </section>

            <form action="{{ route('guru.pengumuman.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="form-card">
                <div class="form-body">
                    <div class="form-group">
                        <div class="label-row">
                            <label class="form-label">Judul Pengumuman</label>
                            <span class="label-required">*</span>
                        </div>
                        <input type="text" name="judul" class="input-text" placeholder="Contoh: Kegiatan Berenang Hari Jumat" required>
                    </div>

                    <div class="form-group">
                        <div class="label-row">
                            <label class="form-label">Isi Pengumuman</label>
                            <span class="label-required">*</span>
                        </div>
                        <textarea name="isi_pengumuman" class="input-textarea" placeholder="Tuliskan detail pengumuman, waktu, tempat, dan perlengkapan yang perlu dibawa..." required></textarea>
                    </div>

                    <div class="photo-section">
                        <div class="photo-header">
                            <label class="photo-label">Lampiran Foto</label>
                            <span class="photo-optional">Opsional</span>
                        </div>
                        <div class="photo-grid" style="position:relative;">
                            <input type="file" name="lampiran" accept="image/*" style="position:absolute; width:100%; height:100%; top:0; left:0; opacity:0; cursor:pointer; z-index:10;" onchange="this.nextElementSibling.querySelector('.upload-text').innerText = this.files[0].name">
                            <div class="upload-box">
                                <div class="upload-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                                </div>
                                <span class="upload-text">Klik untuk upload foto</span>
                                <span class="upload-subtext">Maksimal 5MB (JPG, PNG)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="form-footer">
                    <a href="{{ route('guru.daftar_pengumuman') }}" class="btn-cancel" style="text-decoration:none; display:inline-flex; align-items:center; justify-content:center;">Batal</a>
                    <button type="submit" class="btn-submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                        Kirim Pengumuman
                    </button>
                </footer>
            </div>
            </form>

            @include('partials.footer')
        </main>
    </div>
</body>
</html>
