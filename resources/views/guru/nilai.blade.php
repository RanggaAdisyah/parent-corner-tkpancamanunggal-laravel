<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Input Nilai Perkembangan - Dashboard Guru</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/nilai.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/dashboard.css') }}">
</head>
<body>
    <div class="dashboard-guru">
        @include('partials.sidebar_guru', ['active' => 'input-nilai'])

        <main class="main">


            <header class="page-header">
                <div class="header-content">
                    <h1 class="page-title">Input Nilai Perkembangan</h1>
                    <p class="page-subtitle">Lengkapi form penilaian mingguan siswa di bawah ini.</p>
                </div>

            </header>
            <form action="{{ route('guru.nilai.store') }}" method="POST" style="display: contents;">
                @csrf

            <section class="selection-section">
                <div class="selection-group">
                    <label class="selection-label">Pilih Siswa</label>
                    <div class="selection-input-wrapper">
                        <svg class="selection-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        <select class="selection-select" name="siswa_id" required>
                            <option selected disabled>Pilih nama siswa...</option>
                            @foreach($siswas as $siswa)
                            <option value="{{ $siswa->id }}">{{ $siswa->nama }} (NIS: {{ $siswa->nis ?? '-' }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="selection-group">
                    <label class="selection-label">Tanggal</label>
                    <div class="selection-input-wrapper">
                        <svg class="selection-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" class="selection-select" style="border:none; outline:none; background:transparent;">
                    </div>
                </div>
            </section>

            <section class="category-card" style="margin-top: 24px;">
                <header class="category-header">
                    <div class="category-icon-bg icon-blue">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                    </div>
                    <h2 class="category-title">Data Penilaian Siswa</h2>
                </header>
                <div class="category-body">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px;">
                        <div class="form-group">
                            <label class="form-label">Level</label>
                            <input type="text" name="level" class="form-input" placeholder="Contoh: Jilid 1, Iqro 2, dll" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Halaman (Hal)</label>
                            <input type="text" name="hal" class="form-input" placeholder="Contoh: 15-18" required>
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label class="form-label">Nilai</label>
                        <input type="text" name="nilai" class="form-input" placeholder="Contoh: A, B, 85, dll" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Keterangan / Catatan</label>
                        <textarea name="keterangan" class="form-input" style="min-height: 120px; resize: vertical;" placeholder="Tuliskan keterangan atau catatan perkembangan siswa di sini..."></textarea>
                    </div>
                </div>
            </section>

            <footer class="footer-actions" style="display: flex; justify-content: flex-end; gap: 16px; margin-top: 32px; margin-bottom: 40px;">
                <a href="{{ route('guru.dashboard') }}" class="btn-batal" style="text-decoration:none; display:inline-flex; align-items:center; justify-content:center; padding: 10px 24px; background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 9999px; font-family: 'Inter-SemiBold', Helvetica; font-weight: 600; font-size: 14px; color: #64748b; cursor: pointer;">Batal</a>
                <button type="submit" class="btn-simpan" style="padding: 10px 24px; background-color: #3b82f6; border: none; border-radius: 9999px; font-family: 'Inter-SemiBold', Helvetica; font-weight: 600; font-size: 14px; color: #ffffff; display: flex; align-items: center; gap: 8px; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.2);">
                    <svg class="btn-icon" style="width: 16px; height: 16px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                    Simpan Penilaian
                </button>
            </footer>
            </form>

            @include('partials.footer')
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // AJAX Fetch logic
            const siswaSelect = document.querySelector('select[name="siswa_id"]');
            const tanggalInput = document.querySelector('input[name="tanggal"]');
            
            const inputs = {
                level: document.querySelector('input[name="level"]'),
                hal: document.querySelector('input[name="hal"]'),
                nilai: document.querySelector('input[name="nilai"]'),
                keterangan: document.querySelector('textarea[name="keterangan"]')
            };

            function clearForm() {
                if (inputs.level) inputs.level.value = '';
                if (inputs.hal) inputs.hal.value = '';
                if (inputs.nilai) inputs.nilai.value = '';
                if (inputs.keterangan) inputs.keterangan.value = '';
            }

            function fetchNilai() {
                const siswa_id = siswaSelect.value;
                const tanggal = tanggalInput.value;

                if (siswa_id && siswa_id !== 'Pilih nama siswa...' && tanggal) {
                    fetch(`{{ route('guru.get-nilai') }}?siswa_id=${siswa_id}&tanggal=${tanggal}`)
                        .then(response => response.json())
                        .then(data => {
                            clearForm();
                            if (data && Object.keys(data).length > 0) {
                                if (inputs.level) inputs.level.value = data.level || '';
                                if (inputs.hal) inputs.hal.value = data.hal || '';
                                if (inputs.nilai) inputs.nilai.value = data.nilai || '';
                                if (inputs.keterangan) inputs.keterangan.value = data.keterangan || '';
                            }
                        })
                        .catch(error => console.error('Error fetching nilai:', error));
                } else {
                    clearForm();
                }
            }

            siswaSelect.addEventListener('change', fetchNilai);
            tanggalInput.addEventListener('change', fetchNilai);
        });
    </script>
</body>
</html>
