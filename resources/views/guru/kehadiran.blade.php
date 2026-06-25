<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Input Kehadiran Siswa - Dashboard Guru</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/kehadiran.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/dashboard.css') }}">
</head>
<body>
    <div class="dashboard-guru">
        @include('partials.sidebar_guru', ['active' => 'input-kehadiran'])

        <main class="main">
            <header class="page-header">
                <h1 class="page-title">Input Kehadiran Siswa</h1>
                <p class="page-subtitle">Kelola kehadiran siswa harian dengan mudah.</p>
            </header>

            <section class="filter-section">
                <div class="filter-group">
                    <label class="filter-label">Tanggal Kehadiran</label>
                    <div class="filter-input-wrapper">
                        <svg class="filter-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        <input type="text" class="filter-input" value="10/24/2023" readonly>
                    </div>
            </section>

            <section class="attendance-card">
                <header class="attendance-header">
                    <div class="attendance-title-wrapper">
                        <svg class="attendance-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        <h2 class="attendance-title">Daftar Siswa (25 Siswa)</h2>
                    </div>
                    <span class="attendance-hint">Pilih status kehadiran untuk setiap siswa</span>
                </header>

                <table class="attendance-table">
                    <thead>
                        <tr>
                            <th class="col-no">NO</th>
                            <th class="col-student">NAMA SISWA</th>
                            <th class="col-status">STATUS KEHADIRAN</th>
                            <th class="col-note">CATATAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Row 1 -->
                        <tr>
                            <td class="col-no">1</td>
                            <td class="col-student">
                                <div class="student-info">
                                    <img src="https://ui-avatars.com/api/?name=Ahmad+Fauzan&background=0ea5e9&color=fff" alt="" class="student-avatar">
                                    <div class="student-details">
                                        <span class="student-name">Ahmad Fauzan</span>
                                        <span class="student-nis">NIS: 2023001</span>
                                    </div>
                                </div>
                            </td>
                            <td class="col-status">
                                <div class="status-options">
                                    <label class="status-option">
                                        <input type="radio" name="status_1" class="status-radio radio-hadir" checked> Hadir
                                    </label>
                                    <label class="status-option">
                                        <input type="radio" name="status_1" class="status-radio radio-sakit"> Sakit
                                    </label>
                                    <label class="status-option">
                                        <input type="radio" name="status_1" class="status-radio radio-izin"> Izin
                                    </label>
                                    <label class="status-option">
                                        <input type="radio" name="status_1" class="status-radio radio-alfa"> Alfa
                                    </label>
                                </div>
                            </td>
                            <td class="col-note">
                                <input type="text" class="note-input" placeholder="Catatan (opsional)">
                            </td>
                        </tr>
                        <!-- Row 2 -->
                        <tr>
                            <td class="col-no">2</td>
                            <td class="col-student">
                                <div class="student-info">
                                    <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=f59e0b&color=fff" alt="" class="student-avatar">
                                    <div class="student-details">
                                        <span class="student-name">Budi Santoso</span>
                                        <span class="student-nis">NIS: 2023002</span>
                                    </div>
                                </div>
                            </td>
                            <td class="col-status">
                                <div class="status-options">
                                    <label class="status-option">
                                        <input type="radio" name="status_2" class="status-radio radio-hadir"> Hadir
                                    </label>
                                    <label class="status-option">
                                        <input type="radio" name="status_2" class="status-radio radio-sakit" checked> Sakit
                                    </label>
                                    <label class="status-option">
                                        <input type="radio" name="status_2" class="status-radio radio-izin"> Izin
                                    </label>
                                    <label class="status-option">
                                        <input type="radio" name="status_2" class="status-radio radio-alfa"> Alfa
                                    </label>
                                </div>
                            </td>
                            <td class="col-note">
                                <input type="text" class="note-input" value="Demam tinggi">
                            </td>
                        </tr>
                        <!-- Row 3 -->
                        <tr>
                            <td class="col-no">3</td>
                            <td class="col-student">
                                <div class="student-info">
                                    <img src="https://ui-avatars.com/api/?name=Citra+Dewi&background=10b981&color=fff" alt="" class="student-avatar">
                                    <div class="student-details">
                                        <span class="student-name">Citra Dewi</span>
                                        <span class="student-nis">NIS: 2023003</span>
                                    </div>
                                </div>
                            </td>
                            <td class="col-status">
                                <div class="status-options">
                                    <label class="status-option">
                                        <input type="radio" name="status_3" class="status-radio radio-hadir" checked> Hadir
                                    </label>
                                    <label class="status-option">
                                        <input type="radio" name="status_3" class="status-radio radio-sakit"> Sakit
                                    </label>
                                    <label class="status-option">
                                        <input type="radio" name="status_3" class="status-radio radio-izin"> Izin
                                    </label>
                                    <label class="status-option">
                                        <input type="radio" name="status_3" class="status-radio radio-alfa"> Alfa
                                    </label>
                                </div>
                            </td>
                            <td class="col-note">
                                <input type="text" class="note-input" placeholder="Catatan (opsional)">
                            </td>
                        </tr>
                        <!-- Row 4 -->
                        <tr>
                            <td class="col-no">4</td>
                            <td class="col-student">
                                <div class="student-info">
                                    <img src="https://ui-avatars.com/api/?name=Dimas+Pratama&background=3b82f6&color=fff" alt="" class="student-avatar">
                                    <div class="student-details">
                                        <span class="student-name">Dimas Pratama</span>
                                        <span class="student-nis">NIS: 2023004</span>
                                    </div>
                                </div>
                            </td>
                            <td class="col-status">
                                <div class="status-options">
                                    <label class="status-option">
                                        <input type="radio" name="status_4" class="status-radio radio-hadir"> Hadir
                                    </label>
                                    <label class="status-option">
                                        <input type="radio" name="status_4" class="status-radio radio-sakit"> Sakit
                                    </label>
                                    <label class="status-option">
                                        <input type="radio" name="status_4" class="status-radio radio-izin" checked> Izin
                                    </label>
                                    <label class="status-option">
                                        <input type="radio" name="status_4" class="status-radio radio-alfa"> Alfa
                                    </label>
                                </div>
                            </td>
                            <td class="col-note">
                                <input type="text" class="note-input" value="Acara keluarga">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>

            <footer class="footer-actions">
                <button type="button" class="btn-batal">Batal</button>
                <button type="button" class="btn-simpan">
                    <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                    Simpan Kehadiran
                </button>
            </footer>

            @include('partials.footer')
        </main>
    </div>
</body>
</html>
