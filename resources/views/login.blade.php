<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta charset="utf-8"/>
    <title>Parent Corner TK Panca Manunggal</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style.css') }}">
</head>
<body>
<div class="body">
    <main class="main-container">
        <section class="left-side-visual" aria-labelledby="welcome-heading">
            <div class="decorative" aria-hidden="true"></div>
            <div class="overlay-blur" aria-hidden="true"></div>
            <div class="illustration-image">
                <div class="margin">
                    <img class="image" src="{{ asset('img/image.png') }}" alt="Ilustrasi dua anak bermain balok bersama">
                </div>
                <div class="heading-margin">
                    <div class="div">
                        <h1 class="text" id="welcome-heading">Tumbuh Kembang Bersama</h1>
                    </div>
                </div>
                <div class="container">
                    <p class="text-wrapper">Platform digital untuk memantau aktivitas dan<br>perkembangan buah hati Anda di TK Panca<br>Manunggal.</p>
                </div>
            </div>
        </section>
        <section class="right-side-login" aria-label="Formulir masuk">
            <div class="login-card-container">
                <header class="div-2">
                    <div class="logo-placeholder">
                        <div class="container-wrapper">
                            <div class="div">
                                <img class="icon" src="{{ asset('img/image.svg') }}" alt="Logo Parent Corner TK Panca Manunggal">
                            </div>
                        </div>
                    </div>
                    <div class="div-wrapper">
                        <div class="container-2">
                            <div class="div-2">
                                <h2 class="text-2">Selamat Datang</h2>
                            </div>
                            <div class="div-2">
                                <p class="p">Masuk ke Parent Corner TK Panca Manunggal</p>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="form-section-margin">
                    <form class="form-section" action="{{ route('login') }}" method="post">
                        @csrf

                        @if ($errors->any())
                            <div role="alert" aria-live="assertive">
                                @foreach ($errors->all() as $error)
                                    <p class="error-message">{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif

                        <div class="div-3">
                            <div class="div-wrapper-2">
                                <label class="text-wrapper-2" for="input-1">Username atau Email</label>
                            </div>
                            <div class="container-3">
                                <div class="input">
                                    <input
                                        class="container-4 @error('email') is-invalid @enderror"
                                        placeholder="Masukkan username atau email anda"
                                        type="email"
                                        id="input-1"
                                        name="email"
                                        value="{{ old('email') }}"
                                        autocomplete="username"
                                        inputmode="email"
                                        aria-describedby="input-1-hint"
                                        required
                                    >
                                </div>
                                <div class="container-5" aria-hidden="true">
                                    <div class="container-6">
                                        <img class="img" src="{{ asset('img/icon-5.svg') }}" alt="">
                                    </div>
                                </div>
                            </div>
                            <span id="input-1-hint" class="sr-only">Masukkan username atau alamat email Anda</span>
                        </div>

                        <div class="div-3">
                            <div class="div-wrapper-2">
                                <label class="text-wrapper-2" for="input-2">Kata Sandi</label>
                            </div>
                            <div class="container-3">
                                <div class="input-2">
                                    <div class="div-wrapper-2">
                                        <input
                                            class="text-wrapper-3 @error('password') is-invalid @enderror"
                                            id="input-2"
                                            name="password"
                                            type="password"
                                            placeholder="Masukkan kata sandi anda"
                                            autocomplete="current-password"
                                            required
                                        >
                                    </div>
                                </div>
                                <div class="container-5" aria-hidden="true">
                                    <div class="container-6">
                                        <img class="icon-2" src="{{ asset('img/icon.svg') }}" alt="">
                                    </div>
                                </div>
                                <button class="button" type="button" aria-label="Tampilkan atau sembunyikan kata sandi">
                                    <div class="div">
                                        <img class="icon-3" src="{{ asset('img/icon-6.svg') }}" alt="">
                                    </div>
                                </button>
                            </div>
                        </div>

                        <div class="forgot-password-link">
                            <a class="link" href="#" aria-label="Lupa kata sandi">
                                <div class="text-3">Lupa Kata Sandi?</div>
                            </a>
                        </div>

                        <button class="submit-button" type="submit">
                            <div class="submit-button-shadow" aria-hidden="true"></div>
                            <div class="div">
                                <div class="text-4">Masuk</div>
                            </div>
                            <div class="div">
                                <img class="icon-4" src="{{ asset('img/icon-2.svg') }}" alt="">
                            </div>
                        </button>
                    </form>
                </div>
                <div class="divider" aria-hidden="true">
                    <div class="horizontal-divider"></div>
                    <div class="margin-2">
                        <div class="text-5">Butuh bantuan?</div>
                    </div>
                    <div class="horizontal-divider"></div>
                </div>
                <a class="link-help-admin" href="#" aria-label="Hubungi Admin Sekolah">
                    <div class="background" aria-hidden="true">
                        <div class="container-6">
                            <img class="icon-5" src="{{ asset('img/icon-3.svg') }}" alt="">
                        </div>
                    </div>
                    <div class="container-6">
                        <div class="div-wrapper-2">
                            <div class="text-6">Hubungi Admin Sekolah</div>
                        </div>
                        <div class="div-wrapper-2">
                            <p class="text-7">Kami siap membantu kendala akses Anda</p>
                        </div>
                    </div>
                    <div class="margin-3" aria-hidden="true">
                        <div class="container-6">
                            <img class="icon-6" src="{{ asset('img/icon-4.svg') }}" alt="">
                        </div>
                    </div>
                </a>
            </div>
            @include('partials.footer')
        </section>
    </main>
</div>
</body>
</html>
