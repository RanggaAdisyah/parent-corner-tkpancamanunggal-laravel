<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Input Nilai Perkembangan - Dashboard Guru</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/nilai.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/dashboard.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <style>
        .ql-toolbar.ql-snow { border-radius: 8px 8px 0 0; border-color: #e2e8f0; font-family: 'Inter', sans-serif; }
        .ql-container.ql-snow { border-radius: 0 0 8px 8px; border-color: #e2e8f0; font-family: 'Inter', sans-serif; font-size: 14px; }
        .ql-editor { min-height: 120px; }
    </style>
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

            <!-- Kategori: Kognitif -->
            <section class="category-card">
                <header class="category-header">
                    <div class="category-icon-bg icon-blue">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a10 10 0 1 0 10 10 10 10 0 0 0-10-10zm0 18a8 8 0 1 1 8-8 8 8 0 0 1-8 8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    </div>
                    <h2 class="category-title">Perkembangan Kognitif</h2>
                </header>
                <div class="category-body">
                    <div class="form-group">
                        <label class="form-label">Catatan Observasi</label>
                        <div id="editor-kognitif" style="background: white;"></div>
                        <input type="hidden" id="hidden-kognitif" name="catatan[kognitif]">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Penilaian</label>
                        <input type="number" name="nilai[kognitif]" class="form-input" placeholder="Contoh: 90">
                    </div>
                </div>
            </section>

            <!-- Kategori: Sosial Emosional -->
            <section class="category-card">
                <header class="category-header">
                    <div class="category-icon-bg icon-purple">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    </div>
                    <h2 class="category-title">Perkembangan Sosial Emosional</h2>
                </header>
                <div class="category-body">
                    <div class="form-group">
                        <label class="form-label">Catatan Observasi</label>
                        <div id="editor-sosial" style="background: white;"></div>
                        <input type="hidden" id="hidden-sosial" name="catatan[sosial_emosional]">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Penilaian</label>
                        <input type="number" name="nilai[sosial_emosional]" class="form-input" placeholder="Contoh: 90">
                    </div>
                </div>
            </section>

            <!-- Kategori: Fisik Motorik -->
            <section class="category-card">
                <header class="category-header">
                    <div class="category-icon-bg icon-green">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13.147 21a1 1 0 0 1-1-1v-5a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1h-5z"></path><path d="M2 21a1 1 0 0 1 1-1v-5a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"></path><path d="M9 3.221a1 1 0 0 1 .53-.894l5-2.5a1 1 0 0 1 1.34.447l2.5 5a1 1 0 0 1-.447 1.341l-5 2.5a1 1 0 0 1-1.34-.447l-2.5-5a1 1 0 0 1-.083-.447z"></path></svg>
                    </div>
                    <h2 class="category-title">Perkembangan Fisik Motorik</h2>
                </header>
                <div class="category-body">
                    <div class="form-group">
                        <label class="form-label">Catatan Observasi</label>
                        <div id="editor-fisik" style="background: white;"></div>
                        <input type="hidden" id="hidden-fisik" name="catatan[fisik_motorik]">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Penilaian</label>
                        <input type="number" name="nilai[fisik_motorik]" class="form-input" placeholder="Contoh: 90">
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
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quillConfig = {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        ['clean']
                    ]
                }
            };

            const editorKognitif = new Quill('#editor-kognitif', { ...quillConfig, placeholder: 'Contoh: Ananda mulai bisa mengelompokkan benda...' });
            const editorSosial = new Quill('#editor-sosial', { ...quillConfig, placeholder: 'Contoh: Mampu berbagi mainan dengan teman...' });
            const editorFisik = new Quill('#editor-fisik', { ...quillConfig, placeholder: 'Masukkan catatan observasi...' });

            editorKognitif.on('text-change', () => document.getElementById('hidden-kognitif').value = editorKognitif.root.innerHTML);
            editorSosial.on('text-change', () => document.getElementById('hidden-sosial').value = editorSosial.root.innerHTML);
            editorFisik.on('text-change', () => document.getElementById('hidden-fisik').value = editorFisik.root.innerHTML);

            // AJAX Fetch logic
            const siswaSelect = document.querySelector('select[name="siswa_id"]');
            const tanggalInput = document.querySelector('input[name="tanggal"]');
            const inputsNilai = {
                kognitif: document.querySelector('input[name="nilai[kognitif]"]'),
                sosial_emosional: document.querySelector('input[name="nilai[sosial_emosional]"]'),
                fisik_motorik: document.querySelector('input[name="nilai[fisik_motorik]"]')
            };

            function clearForm() {
                editorKognitif.setText('');
                editorSosial.setText('');
                editorFisik.setText('');
                if (inputsNilai.kognitif) inputsNilai.kognitif.value = '';
                if (inputsNilai.sosial_emosional) inputsNilai.sosial_emosional.value = '';
                if (inputsNilai.fisik_motorik) inputsNilai.fisik_motorik.value = '';
            }

            function fetchNilai() {
                const siswa_id = siswaSelect.value;
                const tanggal = tanggalInput.value;

                if (siswa_id && siswa_id !== 'Pilih nama siswa...' && tanggal) {
                    fetch(`{{ route('guru.get-nilai') }}?siswa_id=${siswa_id}&tanggal=${tanggal}`)
                        .then(response => response.json())
                        .then(data => {
                            clearForm();
                            if (data && data.length > 0) {
                                data.forEach(item => {
                                    if (item.kegiatan === 'kognitif') {
                                        if (inputsNilai.kognitif) inputsNilai.kognitif.value = item.nilai;
                                        if (item.catatan) {
                                            editorKognitif.root.innerHTML = item.catatan;
                                            document.getElementById('hidden-kognitif').value = item.catatan;
                                        }
                                    } else if (item.kegiatan === 'sosial_emosional') {
                                        if (inputsNilai.sosial_emosional) inputsNilai.sosial_emosional.value = item.nilai;
                                        if (item.catatan) {
                                            editorSosial.root.innerHTML = item.catatan;
                                            document.getElementById('hidden-sosial').value = item.catatan;
                                        }
                                    } else if (item.kegiatan === 'fisik_motorik') {
                                        if (inputsNilai.fisik_motorik) inputsNilai.fisik_motorik.value = item.nilai;
                                        if (item.catatan) {
                                            editorFisik.root.innerHTML = item.catatan;
                                            document.getElementById('hidden-fisik').value = item.catatan;
                                        }
                                    }
                                });
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
