<style>
    /* Transisi untuk animasi ciut */
    .aside {
        transition: width 0.3s ease;
    }
    
    /* State Collapsed (Desktop & Mobile) */
    .aside.collapsed,
    @media (max-width: 991px) {
        .aside {
            width: 80px !important;
            min-width: 80px !important;
            flex: none !important;
        }
    }
    
    /* Sembunyikan elemen teks saat collapsed atau di layar mobile */
    .aside.collapsed .text,
    .aside.collapsed .text-wrapper,
    .aside.collapsed .text-2,
    .aside.collapsed .text-3,
    .aside.collapsed .text-4,
    .aside.collapsed .text-5,
    .aside.collapsed .text-wrapper-2,
    .aside.collapsed .text-wrapper-3,
    .aside.collapsed .text-wrapper-4,
    .aside.collapsed .text-wrapper-5,
    .aside.collapsed .margin,
    .aside.collapsed .container,
    .aside.collapsed .container-wrapper {
        display: none !important;
    }
    
    .aside.collapsed .div-wrapper.toggle-wrapper {
        margin: 0 auto !important;
    }

    @media (max-width: 991px) {
        #mainSidebar {
            position: fixed !important;
            bottom: 0 !important;
            left: 0 !important;
            right: 0 !important;
            top: auto !important;
            width: 100vw !important;
            max-width: none !important;
            height: 65px !important;
            z-index: 9999 !important;
            display: flex !important;
            flex-direction: row !important;
            border-right: none !important;
            border-top: 1px solid #e2e8f0 !important;
            background: #ffffff !important;
            margin: 0 !important;
            padding: 0 !important;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.05) !important;
            transform: none !important;
        }

        #mainSidebar > *:not(.nav) {
            display: none !important;
        }

        #mainSidebar .nav {
            position: static !important;
            display: flex !important;
            flex-direction: row !important;
            width: 100% !important;
            max-width: 100% !important;
            justify-content: space-around !important;
            align-items: center !important;
            height: 100% !important;
            margin: 0 !important;
            padding: 0 4px !important;
            gap: 0 !important;
            transform: none !important;
        }
        
        
        #mainSidebar .nav a {
            position: static !important;
            display: flex !important;
            flex-direction: row !important;
            justify-content: center !important;
            align-items: center !important;
            flex: 1 !important;
            height: 100% !important;
            padding: 8px 2px !important;
            margin: 0 !important;
            background: none !important;
            border: none !important;
            transform: none !important;
        }
        
        #mainSidebar .nav a * {
            position: static !important;
            transform: none !important;
            margin: 0 !important;
        }

        #mainSidebar .nav a div[class^="text-"],
        #mainSidebar .nav .container {
            display: none !important;
        }
        
        body {
            padding-bottom: 65px !important;
        }
        
        .dashboard-guru {
            flex-direction: column !important;
        }
        
        .dashboard-guru .main {
            margin-left: 0 !important;
            width: 100% !important;
        }
    }
</style>

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
