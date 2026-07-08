<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Daftar Pengumuman - Dashboard Guru</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/daftar_pengumuman.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/dashboard_master.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/Operator/buat_pengumuman.css') }}">
</head>
<body>
    <div class="dashboard-guru">
        @include('partials.sidebar_guru', ['active' => 'pengumuman'])

        <main class="main">
            <header class="page-header">
                <div class="header-left">
                    <h1 class="header-title">Daftar Pengumuman</h1>
                    <p class="header-subtitle">Kelola dan lihat semua pengumuman yang telah Anda bagikan.</p>
                </div>
                <a href="{{ route('guru.buat-pengumuman') }}" class="btn-add" style="display:inline-flex; align-items:center; gap:6px; text-decoration:none;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Buat Pengumuman Baru
                </a>
            </header>

            <div class="table-container">
                <div class="table-header">
                    <h2 class="table-title">Semua Pengumuman</h2>
                    <div class="search-wrapper">
                        <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        <input type="text" class="search-input" placeholder="Cari judul pengumuman...">
                    </div>
                </div>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Pengumuman</th>
                            <th>Tanggal Kirim</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengumumans as $pengumuman)
                        <tr>
                            <td>
                                <div style="display:flex; align-items:center; gap:8px;">
                                    <span class="announcement-title">{{ $pengumuman->judul }}</span>
                                </div>
                            </td>
                            <td><span class="date-text">{{ $pengumuman->created_at->format('d M Y, H:i') }}</span></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('guru.pengumuman.edit', $pengumuman->id) }}" class="btn-icon" title="Edit" style="display:inline-flex; align-items:center; justify-content:center; text-decoration:none;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </a>
                                    <form action="{{ route('guru.pengumuman.destroy', $pengumuman->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?');" style="display:inline-block; margin:0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon btn-icon-delete" title="Hapus" style="background:none; border:none; cursor:pointer;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" style="text-align: center; padding: 24px; color: #64748b;">Belum ada pengumuman yang dibuat.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="pagination">
                    {{ $pengumumans->links() }}
                </div>
            </div>

            @include('partials.footer')
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('.search-input');
            const rows = document.querySelectorAll('tbody tr');

            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const query = this.value.toLowerCase();
                    rows.forEach(row => {
                        const titleEl = row.querySelector('.announcement-title');
                        if (!titleEl) return;
                        
                        const title = titleEl.textContent.toLowerCase();
                        if (title.includes(query)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            }
        });
    </script>
</body>
</html>
