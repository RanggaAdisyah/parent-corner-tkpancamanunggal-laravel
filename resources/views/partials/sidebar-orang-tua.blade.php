<aside class="aside" id="mainSidebar" aria-label="Sidebar navigasi orang tua">
    <div class="horizontal-border">
        <div class="overlay" aria-hidden="true">
            <img class="icon" src="{{ asset('img/icon-6.svg') }}" alt="" />
        </div>

        <div class="div-wrapper">
            <div class="div">
                <div class="div-2">
                    <div class="text">TK Panca<br />Manunggal</div>
                </div>
                <div class="div-2">
                    <div class="text-wrapper">Parent Corner & Staff</div>
                </div>
            </div>
        </div>

        <div class="div-wrapper toggle-wrapper" style="margin-left: auto; padding-left: 0;">
            <button type="button" id="toggleButton" class="sidebar-toggle" aria-label="Toggle Sidebar">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
        </div>
    </div>

    <nav class="nav" aria-label="Navigasi utama">
        <a href="{{ url('/orang-tua/dashboard') }}" class="{{ isset($active) && $active == 'beranda' ? 'link' : 'link-2' }}" {{ isset($active) && $active == 'beranda' ? 'aria-current="page"' : '' }} title="Beranda">
            <div class="div">
                <img class="img" src="{{ asset('icon/guru/dashboard.svg') }}" alt="" />
            </div>
            <div class="div-wrapper">
                <div class="{{ isset($active) && $active == 'beranda' ? 'text-2' : 'text-3' }}">Beranda</div>
            </div>
        </a>

        <div class="container">
            <div class="text-wrapper-2">AKADEMIK</div>
        </div>

        <a href="{{ url('/orang-tua/lihat-nilai') }}" class="{{ isset($active) && $active == 'lihat-nilai' ? 'link' : 'link-2' }}" {{ isset($active) && $active == 'lihat-nilai' ? 'aria-current="page"' : '' }} title="Lihat Nilai">
            <div class="div">
                <img class="icon-2" src="{{ asset('icon/guru/nilai.svg') }}" alt="" />
            </div>
            <div class="div-wrapper">
                <div class="{{ isset($active) && $active == 'lihat-nilai' ? 'text-2' : 'text-wrapper-3' }}">Lihat Nilai</div>
            </div>
        </a>

        <a href="{{ url('/orang-tua/lihat-jadwal') }}" class="{{ isset($active) && $active == 'lihat-jadwal' ? 'link' : 'link-2' }}" {{ isset($active) && $active == 'lihat-jadwal' ? 'aria-current="page"' : '' }} title="Lihat Jadwal">
            <div class="div">
                <img class="icon-3" src="{{ asset('icon/guru/jadwal.svg') }}" alt="" />
            </div>
            <div class="div-wrapper">
                <div class="{{ isset($active) && $active == 'lihat-jadwal' ? 'text-2' : 'text-3' }}">Lihat Jadwal</div>
            </div>
        </a>

        <a href="{{ url('/orang-tua/lihat-kehadiran') }}" class="{{ isset($active) && $active == 'lihat-kehadiran' ? 'link' : 'link-2' }}" {{ isset($active) && $active == 'lihat-kehadiran' ? 'aria-current="page"' : '' }} title="Lihat kehadiran">
            <div class="div">
                <img class="icon-2" src="{{ asset('icon/guru/kehadiran.svg') }}" alt="" />
            </div>
            <div class="div-wrapper">
                <div class="{{ isset($active) && $active == 'lihat-kehadiran' ? 'text-2' : 'text-wrapper-3' }}">Lihat kehadiran</div>
            </div>
        </a>

        <a href="{{ url('/orang-tua/unduh-laporan') }}" class="{{ isset($active) && $active == 'unduh-laporan' ? 'link' : 'link-2' }}" {{ isset($active) && $active == 'unduh-laporan' ? 'aria-current="page"' : '' }} title="Unduh Laporan">
            <div class="div">
                <img class="icon-2" src="{{ asset('icon/guru/nilai.svg') }}" alt="" />
            </div>
            <div class="div-wrapper">
                <div class="{{ isset($active) && $active == 'unduh-laporan' ? 'text-2' : 'text-wrapper-3' }}">Unduh Laporan</div>
            </div>
        </a>

        <div class="container">
            <div class="text-wrapper-2">KOMUNIKASI & INFO</div>
        </div>

        <a href="{{ url('/orang-tua/lihat-pengumuman') }}" class="{{ isset($active) && $active == 'pengumuman' ? 'link' : 'link-2' }}" {{ isset($active) && $active == 'pengumuman' ? 'aria-current="page"' : '' }} title="Pengumuman">
            <div class="div">
                <img class="icon-4" src="{{ asset('icon/guru/pengumuman.svg') }}" alt="" />
            </div>
            <div class="div-wrapper">
                <div class="{{ isset($active) && $active == 'pengumuman' ? 'text-2' : 'text-4' }}">Pengumuman</div>
            </div>
        </a>

        <a href="{{ url('/orang-tua/foto-kegiatan') }}" class="{{ isset($active) && $active == 'foto-kegiatan' ? 'link' : 'link-2' }}" {{ isset($active) && $active == 'foto-kegiatan' ? 'aria-current="page"' : '' }} title="Foto Kegiatan">
            <div class="div">
                <img class="icon-5" src="{{ asset('icon/guru/foto.svg') }}" alt="" />
            </div>
            <div class="div-wrapper">
                <div class="{{ isset($active) && $active == 'foto-kegiatan' ? 'text-2' : 'text-5' }}">Foto Kegiatan</div>
            </div>
        </a>

        <a href="{{ url('/orang-tua/hubungi-guru') }}" class="{{ isset($active) && $active == 'hubungi-guru' ? 'link' : 'link-2' }}" {{ isset($active) && $active == 'hubungi-guru' ? 'aria-current="page"' : '' }} title="Hubungi Guru">
            <div class="div">
                <img class="icon-2" src="{{ asset('icon/guru/kehadiran.svg') }}" alt="" />
            </div>
            <div class="div-wrapper">
                <div class="{{ isset($active) && $active == 'hubungi-guru' ? 'text-2' : 'text-wrapper-3' }}">Hubungi Guru</div>
            </div>
        </a>
    </nav>

    <div class="container-wrapper">
        <div class="container-2">
            <div class="admin-profile" role="img" aria-label="Foto profil Orang Tua"></div>

            <div class="margin">
                <div class="div-2">
                    <div class="div-2">
                        <div class="text-wrapper-4">Ibu Sarah</div>
                    </div>
                    <div class="div-2">
                        <div class="text-wrapper-5">Wali Murid Budi</div>
                    </div>
                </div>
            </div>

            <div class="div-wrapper">
                <button class="button" type="button" aria-label="Opsi akun orang tua">
                    <div class="icon-wrapper">
                        <img class="icon-6" src="{{ asset('img/image.svg') }}" alt="" />
                    </div>
                </button>
            </div>
        </div>
    </div>
</aside>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('mainSidebar');
        const toggleBtn = document.getElementById('toggleButton');

        const isCollapsed = localStorage.getItem('sidebarOrangTuaCollapsed') === 'true';
        if (isCollapsed) {
            sidebar.classList.add('collapsed');
        }

        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            localStorage.setItem('sidebarOrangTuaCollapsed', sidebar.classList.contains('collapsed'));
        });
    });
</script>
