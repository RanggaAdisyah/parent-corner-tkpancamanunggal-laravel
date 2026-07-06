<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Jadwal Kelas: {{ $kelas->tingkat }} - {{ $kelas->nama_kelas }}</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/Operator/kelola_jadwal.css') }}">
    <style>
        .back-btn { display: inline-flex; align-items: center; gap: 8px; color: #64748b; text-decoration: none; font-weight: 500; margin-bottom: 16px; transition: color 0.2s; }
        .back-btn:hover { color: #3b82f6; }
        .jh-hari-tabs { display: flex; flex-wrap: wrap; background-color: #f1f5f9; padding: 4px; border-radius: 8px; gap: 4px; }
        .jh-hari-tab { flex: 1 1 auto; white-space: nowrap; text-align: center; }
        .jh-table-wrapper { overflow-x: auto; width: 100%; }
        .header-wrapper { display: flex; flex-direction: column; width: 100%; align-items: flex-start; gap: 16px; margin-bottom: 16px; }
        .jadwal-container { padding: 24px; background: white; margin: 24px; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        @media (min-width: 768px) {
            .header-wrapper { flex-direction: row; justify-content: space-between; align-items: center; }
        }
        @media (max-width: 767px) {
            .jadwal-container { margin: 16px 0; padding: 16px; border-radius: 8px; }
            .jh-table-wrapper { overflow-x: hidden !important; }
            .jh-table, .jh-table tbody, .jh-table tr, .jh-table td { display: block; width: 100% !important; min-width: 0 !important; max-width: 100% !important; box-sizing: border-box; }
            .jh-table thead { display: none; }
            .jh-table tr { margin-bottom: 12px; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px; background: #fff; box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
            .jh-table td { text-align: left; padding: 8px 0; position: relative; border-bottom: 1px solid #f1f5f9; display: flex; flex-direction: column; align-items: flex-start; }
            .jh-table td:last-child { border-bottom: none; }
            .jh-table td::before { content: attr(data-label); text-align: left; font-weight: 600; font-size: 11px; color: #94a3b8; text-transform: uppercase; margin-bottom: 4px; }
            .td-aksi { flex-direction: row !important; justify-content: flex-start !important; gap: 16px; padding-top: 12px; }
            .td-keterangan { display: none !important; }
        }
        /* Modal Button Override */
        .modal-footer { display: flex; justify-content: flex-end; padding: 16px 24px; }
        .footer-right { display: flex !important; flex-direction: row !important; justify-content: flex-end !important; gap: 12px !important; width: auto !important; }
        .btn-batal, .btn-simpan { width: auto !important; padding: 10px 20px !important; flex: none !important; }
    </style>
</head>
<body>
    <div class="kelola-jadwal">
        @include('partials.sidebar', ['active' => 'kelola-kelas'])

        <main class="main">
            <header class="header" style="flex-direction: column; align-items: flex-start; gap: 10px;">
                <a href="{{ route('operator.kelola-kelas') }}" class="back-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                    Kembali ke Kelola Kelas
                </a>
                <div class="header-wrapper">
                    <div class="header-left">
                        <h1 class="page-title" style="margin-bottom: 8px;">Jadwal Harian: {{ $kelas->tingkat }} - {{ $kelas->nama_kelas }}</h1>
                        <p class="page-subtitle" style="margin-bottom: 0;">Atur jadwal pelajaran spesifik untuk kelas ini.</p>
                    </div>
                    <div class="header-right">
                        <button id="btnBuatJadwalHarian" class="btn btn-primary" style="padding: 10px 20px;">
                            <span class="btn-icon">+</span> Jadwal Baru
                        </button>
                    </div>
                </div>
            </header>

            <div class="tab-panel active jadwal-container">
                <div class="jadwal-harian-wrapper">
                    @php $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']; @endphp
                    
                    <div class="jh-kelas-panel active">
                        <div class="jh-hari-tabs">
                            @foreach($hariList as $index => $hari)
                                <button class="jh-hari-tab {{ $index === 0 ? 'active' : '' }}" data-hari="{{ strtolower($hari) }}">{{ $hari }}</button>
                            @endforeach
                        </div>

                        @foreach($hariList as $index => $hari)
                            <div class="jh-schedule {{ $index === 0 ? 'active' : '' }}" id="{{ strtolower($hari) }}">
                                <div class="jh-badge">{{ $kelas->tingkat }} {{ $kelas->nama_kelas }} &nbsp;&middot;&nbsp; {{ $hari }}</div>
                                <div class="jh-table-wrapper">
                                    <table class="jh-table">
                                        <thead><tr><th>Waktu</th><th>Kegiatan</th><th class="td-keterangan">Keterangan</th><th>Aksi</th></tr></thead>
                                        <tbody>
                                            @php $jadwalHariIni = $jadwalList->where('hari', $hari); @endphp
                                            @forelse($jadwalHariIni as $j)
                                                <tr>
                                                    <td data-label="Waktu">{{ $j->jam_mulai }} {{ $j->jam_selesai ? '- '.$j->jam_selesai : '' }}</td>
                                                    <td data-label="Kegiatan">{{ $j->kegiatan }}</td>
                                                    <td data-label="Keterangan" class="td-keterangan">{{ $j->keterangan }}</td>
                                                    <td data-label="Aksi" class="td-aksi">
                                                        <button class="btn-icon-action btn-edit" title="Ubah" 
                                                            onclick="openHarianModal('ubah', {id: {{ $j->id }}, hari: '{{ $j->hari }}', waktu_mulai: '{{ $j->jam_mulai }}', waktu_selesai: '{{ $j->jam_selesai }}', kegiatan: '{{ $j->kegiatan }}', keterangan: '{{ $j->keterangan }}'})">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                                        </button>
                                                        <form method="POST" action="{{ url('/operator/jadwal-kelas/'.$j->id) }}" style="display:inline; margin:0;" onsubmit="return confirm('Hapus jadwal ini?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn-icon-action btn-delete" title="Hapus" style="border:none; cursor:pointer; background:none; padding:0; display:flex;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" style="text-align: center; color: #94a3b8; padding: 20px;">Belum ada jadwal untuk hari ini.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @include('partials.footer')
        </main>

        <!-- Modal Tambah/Ubah Jadwal Harian -->
        <div id="jadwalHarianModal" class="modal-overlay">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="modalTitleHarian" class="modal-title">Buat Jadwal Baru</h3>
                    <button type="button" class="btn-close-modal" id="btnCloseHarianX">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                
                <form id="harianForm" method="POST" action="{{ url('/operator/kelola-kelas/'.$kelas->id.'/jadwal') }}">
                    @csrf
                    <input type="hidden" name="_method" id="formMethod" value="POST" disabled>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">Hari</label>
                            <select class="form-select" name="hari" id="harianHari" required style="width: 100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 8px;">
                                @foreach($hariList as $hari)
                                    <option value="{{ $hari }}">{{ $hari }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                            <div class="form-group">
                                <label class="form-label">Waktu Mulai</label>
                                <input type="time" name="jam_mulai" class="form-input" id="harianWaktuMulai" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Waktu Selesai</label>
                                <input type="time" name="jam_selesai" class="form-input" id="harianWaktuSelesai">
                                <small style="font-size: 11px; color: #6b7280;">*Opsional</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Kegiatan / Mata Pelajaran</label>
                            <input type="text" name="kegiatan" class="form-input" id="harianKegiatan" placeholder="Contoh: Kegiatan Pembukaan" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-input" id="harianKeterangan" placeholder="Contoh: Menyanyi, senam pagi..."></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="footer-left"></div>
                        <div class="footer-right">
                            <button type="button" class="btn-batal" id="btnBatalHarian">Batal</button>
                            <button type="submit" class="btn-simpan" id="btnSimpanHarian">Simpan Jadwal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // TABS HARI
            document.querySelectorAll('.jh-hari-tab').forEach(tab => {
                tab.addEventListener('click', () => {
                    document.querySelectorAll('.jh-hari-tab').forEach(t => t.classList.remove('active'));
                    document.querySelectorAll('.jh-schedule').forEach(s => s.classList.remove('active'));
                    tab.classList.add('active');
                    document.getElementById(tab.dataset.hari).classList.add('active');
                });
            });

            // MODAL LOGIC
            const harianModal = document.getElementById('jadwalHarianModal');
            const btnBuatJadwalHarian = document.getElementById('btnBuatJadwalHarian');
            const modalTitleHarian = document.getElementById('modalTitleHarian');
            const btnSimpanHarian = document.getElementById('btnSimpanHarian');
            const harianForm = document.getElementById('harianForm');
            const formMethod = document.getElementById('formMethod');

            window.openHarianModal = (type = 'tambah', data = null) => {
                if (type === 'ubah') {
                    modalTitleHarian.innerText = 'Ubah Jadwal';
                    btnSimpanHarian.innerText = 'Simpan Perubahan';
                    harianForm.action = '/operator/jadwal-kelas/' + data.id;
                    formMethod.value = "PUT";
                    formMethod.disabled = false;
                    
                    document.getElementById('harianHari').value = data.hari;
                    document.getElementById('harianWaktuMulai').value = data.waktu_mulai;
                    document.getElementById('harianWaktuSelesai').value = data.waktu_selesai;
                    document.getElementById('harianKegiatan').value = data.kegiatan;
                    document.getElementById('harianKeterangan').value = data.keterangan;
                } else {
                    modalTitleHarian.innerText = 'Buat Jadwal Baru';
                    btnSimpanHarian.innerText = 'Tambahkan Jadwal';
                    harianForm.reset();
                    harianForm.action = '/operator/kelola-kelas/{{ $kelas->id }}/jadwal';
                    formMethod.value = "POST";
                    formMethod.disabled = true;

                    // Set default hari ke tab yang sedang aktif
                    const activeTab = document.querySelector('.jh-hari-tab.active');
                    if(activeTab) {
                        const capitalizedHari = activeTab.dataset.hari.charAt(0).toUpperCase() + activeTab.dataset.hari.slice(1);
                        document.getElementById('harianHari').value = capitalizedHari;
                    }
                }
                harianModal.classList.add('active');
            };

            const closeHarianModal = () => harianModal.classList.remove('active');

            if (btnBuatJadwalHarian) btnBuatJadwalHarian.addEventListener('click', () => openHarianModal('tambah'));
            document.getElementById('btnCloseHarianX').addEventListener('click', closeHarianModal);
            document.getElementById('btnBatalHarian').addEventListener('click', closeHarianModal);

            harianModal.addEventListener('click', (e) => { if (e.target === harianModal) closeHarianModal(); });
        });
    </script>
</body>
</html>
