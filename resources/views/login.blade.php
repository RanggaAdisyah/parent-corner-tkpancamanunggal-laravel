<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta charset="utf-8"/>
    <title>Parent Corner TK Panca Manunggal</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style.css') }}">
    @include('partials.alert')
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


                        <div class="div-3">
                            <div class="div-wrapper-2">
                                <label class="text-wrapper-2" for="input-1">No HP atau Email</label>
                            </div>
                            <div class="container-3">
                                <div class="input">
                                    <input
                                        class="container-4 @error('login_identifier') is-invalid @enderror"
                                        placeholder="Masukkan No HP atau Email anda"
                                        type="text"
                                        id="input-1"
                                        name="login_identifier"
                                        value="{{ old('login_identifier') }}"
                                        autocomplete="username"
                                        inputmode="text"
                                        aria-describedby="input-1-hint"
                                        required
                                    >
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
                                <button class="button" type="button" id="togglePassword" aria-label="Tampilkan atau sembunyikan kata sandi">
                                    <div class="div">
                                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye-off">
                                            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                                            <line x1="1" y1="1" x2="23" y2="23"></line>
                                        </svg>
                                    </div>
                                </button>
                            </div>
                        </div>



                        <button class="submit-button" type="submit">
                            <div class="submit-button-shadow" aria-hidden="true"></div>
                            <div class="div">
                                <div class="text-4">Masuk</div>
                            </div>

                        </button>
                    </form>
                </div>

            </div>
            @include('partials.footer')
        </section>
    </main>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('input-2');
        const eyeIcon = document.getElementById('eyeIcon');

        if(togglePassword && passwordInput && eyeIcon) {
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                if (type === 'text') {
                    eyeIcon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
                } else {
                    eyeIcon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
                }
            });
        }
    });
</script>
</body>
</html>
