<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Input Nilai Perkembangan - Dashboard Guru</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/nilai.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/dashboard_master.css') }}">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        .kategori-section {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 20px;
            transition: box-shadow 0.2s;
        }
        .kategori-section:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.04); }
        .kategori-header-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid #f1f5f9;
        }
        .kategori-icon-circle {
            width: 44px; height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }
        .kategori-title { font-size: 16px; font-weight: 700; color: #1e293b; margin: 0; }
        .skala-radio-group {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }
        .skala-radio-item {
            flex: 1;
            min-width: 130px;
            position: relative;
        }
        .skala-radio-item input[type="radio"] {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }
        .skala-radio-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s;
            background: #ffffff;
            text-align: center;
            min-height: 80px;
        }
        .skala-radio-label:hover { border-color: #cbd5e1; background: #f8fafc; }
        .skala-radio-item input[type="radio"]:checked + .skala-radio-label {
            border-color: #3b82f6;
            background: #eff6ff;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
        }
        .skala-short { font-size: 18px; font-weight: 800; color: #1e293b; line-height: 1.2; }
        .skala-stars { font-size: 12px; margin: 4px 0; }
        .skala-label-text { font-size: 11px; color: #64748b; line-height: 1.2; }
        .quill-wrapper { background: #fff; border-radius: 8px; }
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

            @if(session('success'))
                <div style="background:#d1fae5; color:#065f46; padding:12px 16px; border-radius:8px; margin: 0 32px 16px; border:1px solid #6ee7b7;">
                    ✓ {{ session('success') }}
                </div>
            @endif

            <form id="form-nilai" action="{{ route('guru.nilai.store') }}" method="POST" style="display: contents;">
                @csrf

                {{-- Selection Section --}}
                <section class="selection-section">
                    <div class="selection-group">
                        <label class="selection-label">Pilih Siswa</label>
                        <div class="selection-input-wrapper">
                            <svg class="selection-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            <select class="selection-select" name="siswa_id" id="siswaSelect" required>
                                <option selected disabled>Pilih nama siswa...</option>
                                @foreach($siswas as $siswa)
                                    <option value="{{ $siswa->id }}" {{ ($selectedSiswaId ?? null) == $siswa->id ? 'selected' : '' }}>{{ $siswa->nama }} (NIS: {{ $siswa->nis ?? '-' }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="selection-group">
                        <label class="selection-label">Tanggal</label>
                        <div class="selection-input-wrapper">
                            <svg class="selection-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                            <input type="date" name="tanggal" id="tanggalInput" value="{{ old('tanggal', date('Y-m-d')) }}" class="selection-select" style="border:none; outline:none; background:transparent;" required>
                        </div>
                    </div>

                    <div style="display: flex; gap: 12px; padding: 10px 14px; background: #f0f9ff; border: 1px solid #bae6fd; border-radius: 8px; align-items: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0284c7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                        <span style="font-size: 13px; color: #075985;">
                            <strong id="infoBulan">{{ \Carbon\Carbon::now()->translatedFormat('F') }}</strong> · <strong>Minggu <span id="infoMinggu">{{ ceil(date('j') / 7) }}</span></strong>
                        </span>
                        <span style="font-size: 12px; color: #64748b; margin-left: auto;">(otomatis dari tanggal)</span>
                    </div>
                </section>

                {{-- 4 Kategori Section --}}
                @foreach($kategoriList as $key => $meta)
                    @php $existing = $existingNilai[$key] ?? null; @endphp
                    <section class="kategori-section" style="margin-top: 24px;">
                        <div class="kategori-header-row">
                            <div class="kategori-icon-circle" style="background: {{ $meta['color'] }}15; color: {{ $meta['color'] }};">
                                <span style="font-size: 24px;">{{ $meta['icon'] }}</span>
                            </div>
                            <h2 class="kategori-title">Perkembangan {{ $meta['label'] }}</h2>
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label class="form-label" style="display:block; margin-bottom:10px; font-weight:600; font-size:13px; color:#475569;">PENILAIAN</label>
                            <div class="skala-radio-group">
                                @foreach($skalaList as $skalaKey => $skalaMeta)
                                    <div class="skala-radio-item">
                                        <input type="radio" name="nilai[{{ $key }}][skala]" value="{{ $skalaKey }}" id="skala-{{ $key }}-{{ $skalaKey }}" data-was-checked="{{ ($existing && $existing->nilai == $skalaKey) ? 'true' : 'false' }}" {{ ($existing && $existing->nilai == $skalaKey) ? 'checked' : '' }}>
                                        <label class="skala-radio-label" for="skala-{{ $key }}-{{ $skalaKey }}">
                                            <span class="skala-short" style="color: {{ $skalaMeta['color'] }};">{{ $skalaKey }}</span>
                                            <span class="skala-stars" style="color: {{ $skalaMeta['color'] }};">{{ str_repeat('⭐', $skalaMeta['stars']) }}</span>
                                            <span class="skala-label-text">{{ $skalaMeta['label'] }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <label class="form-label" style="display:block; margin-bottom:10px; font-weight:600; font-size:13px; color:#475569;">CATATAN OBSERVASI</label>
                            <div class="quill-wrapper">
                                <div id="editor-{{ $key }}" style="min-height: 110px; background: #fff;">{!! $existing->keterangan ?? '' !!}</div>
                                <input type="hidden" name="nilai[{{ $key }}][keterangan]" id="hidden-{{ $key }}" value="{{ $existing->keterangan ?? '' }}">
                                <input type="hidden" name="nilai[{{ $key }}][_delete]" id="delete-{{ $key }}" value="{{ ($existing && !$existing->nilai) ? '1' : '0' }}">
                            </div>
                        </div>
                    </section>
                @endforeach

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
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Init Quill untuk tiap kategori
            const kategoriKeys = @json(array_keys($kategoriList));
            const quillInstances = {};

            kategoriKeys.forEach(key => {
                quillInstances[key] = new Quill('#editor-' + key, {
                    theme: 'snow',
                    placeholder: 'Tuliskan catatan observasi perkembangan...',
                    modules: {
                        toolbar: [
                            ['bold', 'italic', 'underline', 'strike'],
                            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                            ['clean']
                        ]
                    }
                });

                // Set Quill state berdasar radio checked
                const initialRadio = document.querySelector('input[name="nilai[' + key + '][skala]"]:checked');
                applyQuillState(key, !!initialRadio, true);
            });

            // Fungsi: enable/disable Quill editor + styling wrapper & label
            function applyQuillState(key, enabled, isInitial = false) {
                const q = quillInstances[key];
                if (!q) return;
                q.enable(enabled);
                const wrapper = q.container.closest('.quill-wrapper');
                if (wrapper) {
                    wrapper.style.opacity = enabled ? '1' : '0.5';
                    wrapper.style.pointerEvents = enabled ? 'auto' : 'none';
                    wrapper.style.background = enabled ? '#fff' : '#f1f5f9';
                    wrapper.style.borderRadius = '8px';
                    wrapper.style.padding = '4px';
                    wrapper.style.transition = 'all 0.2s ease';
                }
                // Tandai label section
                const section = document.querySelector('section.kategori-section');
                // (kosongkan catatan hanya saat disable non-initial)
                if (!enabled && !isInitial) {
                    q.setText('');
                    document.getElementById('hidden-' + key).value = '';
                }
            }

            // Form Submit: simpan Quill content ke hidden input
            const form = document.getElementById('form-nilai');
            form.addEventListener('submit', function() {
                Object.keys(quillInstances).forEach(key => {
                    const q = quillInstances[key];
                    document.getElementById('hidden-' + key).value = q.root.innerHTML;
                });
            });

            // Auto-update read-only info saat tanggal berubah
            const tanggalInput = document.getElementById('tanggalInput');
            const infoBulan = document.getElementById('infoBulan');
            const infoMinggu = document.getElementById('infoMinggu');
            const siswaSelect = document.getElementById('siswaSelect');

            const monthNames = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

            function updateInfo() {
                if (!tanggalInput.value) return;
                const d = new Date(tanggalInput.value);
                infoBulan.textContent = monthNames[d.getMonth()];
                infoMinggu.textContent = Math.ceil((d.getDate()) / 7);
            }
            tanggalInput.addEventListener('change', () => {
                updateInfo();
                clearForm();
            });

            function clearForm() {
                Object.keys(quillInstances).forEach(key => {
                    quillInstances[key].root.innerHTML = '';
                    document.getElementById('hidden-' + key).value = '';
                    const radios = document.querySelectorAll('input[name="nilai[' + key + '][skala]"]');
                    radios.forEach(r => {
                        r.checked = false;
                        r.dataset.wasChecked = 'false';
                    });
                    if (typeof checkedState !== 'undefined') {
                        checkedState.set(key, null);
                    }
                    applyQuillState(key, false);
                });
            }

            // Track wasChecked manual via Map, override checked state di label handler
            const checkedState = new Map();
            kategoriKeys.forEach(key => {
                // Init state dari server (existing checked)
                const initial = document.querySelector('input[name="nilai[' + key + '][skala]"]:checked');
                checkedState.set(key, initial ? initial.value : null);
                if (initial) initial.dataset.wasChecked = 'true';

                const radios = document.querySelectorAll('input[name="nilai[' + key + '][skala]"]');

                radios.forEach(radio => {
                    // Pasang handler di LABEL (parent), bukan radio itu sendiri
                    const label = radio.nextElementSibling;
                    if (!label) return;
                    const deleteInput = document.getElementById('delete-' + key);
                    const hiddenInput = document.getElementById('hidden-' + key);

                    label.addEventListener('click', function(e) {
                        e.preventDefault(); // Block default radio toggle
                        const targetRadio = document.getElementById(this.getAttribute('for'));
                        if (!targetRadio) return;

                        const currentChecked = checkedState.get(key);

                        if (currentChecked === targetRadio.value) {
                            // Klik radio yang SEDANG checked → uncheck + tandai hapus
                            targetRadio.checked = false;
                            targetRadio.dataset.wasChecked = 'false';
                            checkedState.set(key, null);
                            if (deleteInput) deleteInput.value = '1';
                            if (hiddenInput) hiddenInput.value = '';
                            applyQuillState(key, false);
                        } else {
                            // Klik radio BARU → check
                            radios.forEach(r => {
                                r.checked = false;
                                r.dataset.wasChecked = 'false';
                            });
                            targetRadio.checked = true;
                            targetRadio.dataset.wasChecked = 'true';
                            checkedState.set(key, targetRadio.value);
                            if (deleteInput) deleteInput.value = '0';
                            applyQuillState(key, true);
                        }
                    });
                });
            });

            // Auto-fetch saat siswa dipilih
            function fetchNilai() {
                const siswaId = siswaSelect.value;
                if (!siswaId || siswaId === 'Pilih nama siswa...') {
                    clearForm();
                    return;
                }

                const tgl = tanggalInput.value;
                if (!tgl) { clearForm(); return; }

                const url = new URL('{{ route('guru.get-nilai') }}', window.location.origin);
                url.searchParams.set('siswa_id', siswaId);
                url.searchParams.set('tanggal', tgl);

                fetch(url)
                    .then(r => r.json())
                    .then(data => {
                        clearForm();
                        if (data && data.kategori) {
                            Object.keys(data.kategori).forEach(key => {
                                const entry = data.kategori[key];
                                if (!entry) return;
                                if (entry.skala) {
                                    const radio = document.getElementById('skala-' + key + '-' + entry.skala);
                                    if (radio) {
                                        radio.checked = true;
                                        radio.dataset.wasChecked = 'true';
                                        checkedState.set(key, entry.skala);
                                    }
                                }
                                if (entry.keterangan && quillInstances[key]) {
                                    quillInstances[key].root.innerHTML = entry.keterangan;
                                    document.getElementById('hidden-' + key).value = entry.keterangan;
                                }
                                // Apply state berdasar radio checked
                                const hasChecked = document.querySelector('input[name="nilai[' + key + '][skala]"]:checked');
                                applyQuillState(key, !!hasChecked);
                            });
                            // Jangan override tanggalInput — biarkan user/default (hari ini)
                        }
                    })
                    .catch(err => console.error('Error fetching nilai:', err));
            }

            siswaSelect.addEventListener('change', fetchNilai);
            tanggalInput.addEventListener('change', () => {
                tanggalInput.dataset.userTouched = '1';
                fetchNilai();
            });

            // Initial load
            updateInfo();
            if (siswaSelect.value && siswaSelect.value !== 'Pilih nama siswa...') {
                fetchNilai();
            }
        });
    </script>
</body>
</html>
