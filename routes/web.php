<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        $role = Auth::user()->role;
        if ($role === 'operator') return redirect()->route('operator.dashboard');
        if ($role === 'guru') return redirect()->route('guru.dashboard');
        if ($role === 'orang_tua') return redirect()->route('orang-tua.dashboard');
    }
    return redirect()->route('login');
});

// Serve CSS files from resources/css/
Route::get('/css/{filename}', function (string $filename) {
    $path = resource_path('css/' . $filename);

    if (!file_exists($path) || !str_ends_with($filename, '.css')) {
        abort(404);
    }

    return Response::make(file_get_contents($path), 200, [
        'Content-Type' => 'text/css',
        'Cache-Control' => 'no-cache, must-revalidate',
    ]);
})->where('filename', '.*\.css');

// Login routes
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {
    $request->validate([
        'login_identifier' => ['required'],
        'password' => ['required'],
    ]);

    $loginIdentifier = $request->input('login_identifier');
    $field = filter_var($loginIdentifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

    $credentials = [
        $field => $loginIdentifier,
        'password' => $request->input('password'),
    ];

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    return back()->withErrors([
        'login_identifier' => 'Kredensial yang Anda masukkan salah.',
    ])->onlyInput('login_identifier');
});

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Route API untuk AJAX Autocomplete PPDB
Route::prefix('api/ppdb')->group(function () {
    Route::get('/search', function (\Illuminate\Http\Request $request) {
        $query = $request->get('q');
        if (!$query) return response()->json([]);

        $data = \App\Models\Ppdb::where('isVerified', 1)
            ->where('nama', 'like', "{$query}%")
            ->select('id', 'nama', 'namaAyah', 'namaIbu', 'no_hp', 'alamat', 'jk', 'tgl_lahir')
            ->take(10)->get();

        return response()->json($data);
    })->name('api.ppdb.search');
});

Route::prefix('api/siswa')->group(function () {
    Route::get('/search', function (\Illuminate\Http\Request $request) {
        $query = $request->get('q');
        if (!$query) return response()->json([]);

        // Tampilkan siswa yang belum punya wali, atau jika mau mencari semua juga bisa, 
        // tapi logikanya untuk ditautkan ke akun wali baru maka yang belum punya wali.
        $data = \App\Models\Siswa::where('nama', 'like', "%{$query}%")
            ->whereNull('orang_tua_id')
            ->select('id', 'nama', 'nis')
            ->take(10)->get();

        return response()->json($data);
    })->name('api.siswa.search');
});

// Operator Routes
Route::middleware(['auth', 'role:operator'])->prefix('operator')->name('operator.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\OperatorController::class, 'indexDashboard'])->name('dashboard');

    Route::get('/data_siswa', [\App\Http\Controllers\OperatorController::class, 'indexAnak'])->name('data_siswa');
    Route::post('/data_siswa', [\App\Http\Controllers\OperatorController::class, 'storeAnak']);
    Route::put('/data_siswa/{id}', [\App\Http\Controllers\OperatorController::class, 'updateAnak'])->name('data_siswa.update');
    Route::delete('/data_siswa/{id}', [\App\Http\Controllers\OperatorController::class, 'destroyAnak'])->name('data_siswa.destroy');

    Route::get('/kelola_orang_tua', [\App\Http\Controllers\OperatorController::class, 'indexOrangTua'])->name('kelola_orang_tua');
    Route::get('/kelola_orang_tua/buat', [\App\Http\Controllers\OperatorController::class, 'createOrangTua'])->name('kelola_orang_tua.buat');
    Route::post('/kelola_orang_tua', [\App\Http\Controllers\OperatorController::class, 'storeOrangTua'])->name('kelola_orang_tua.store');
    Route::get('/kelola_orang_tua/{id}/edit', [\App\Http\Controllers\OperatorController::class, 'editOrangTua'])->name('kelola_orang_tua.edit');
    Route::put('/kelola_orang_tua/{id}', [\App\Http\Controllers\OperatorController::class, 'updateOrangTua'])->name('kelola_orang_tua.update');
    Route::delete('/kelola_orang_tua/{id}', [\App\Http\Controllers\OperatorController::class, 'destroyOrangTua'])->name('kelola_orang_tua.destroy');

    Route::get('/kelola-kelas', [\App\Http\Controllers\OperatorController::class, 'indexKelas'])->name('kelola-kelas');
    Route::post('/kelola-kelas', [\App\Http\Controllers\OperatorController::class, 'storeKelas']);
    Route::put('/kelola-kelas/{id}', [\App\Http\Controllers\OperatorController::class, 'updateKelas'])->name('kelola-kelas.update');
    Route::delete('/kelola-kelas/{id}', [\App\Http\Controllers\OperatorController::class, 'destroyKelas'])->name('kelola-kelas.destroy');

    Route::get('/kelola-kelas/{kelas_id}/jadwal', [\App\Http\Controllers\OperatorController::class, 'indexJadwalKelas'])->name('jadwal-kelas');
    Route::post('/kelola-kelas/{kelas_id}/jadwal', [\App\Http\Controllers\OperatorController::class, 'storeJadwalKelas']);
    Route::put('/jadwal-kelas/{id}', [\App\Http\Controllers\OperatorController::class, 'updateJadwalKelas']);
    Route::delete('/jadwal-kelas/{id}', [\App\Http\Controllers\OperatorController::class, 'destroyJadwalKelas']);

    Route::get('/kelola-guru', [App\Http\Controllers\OperatorController::class, 'indexGuru'])->name('kelola-guru');
    Route::get('/kelola-guru/buat', [App\Http\Controllers\OperatorController::class, 'createGuru'])->name('kelola-guru.buat');
    Route::post('/kelola-guru', [App\Http\Controllers\OperatorController::class, 'storeGuru'])->name('kelola-guru.store');
    Route::get('/kelola-guru/{id}/edit', [App\Http\Controllers\OperatorController::class, 'editGuru'])->name('kelola-guru.edit');
    Route::put('/kelola-guru/{id}', [App\Http\Controllers\OperatorController::class, 'updateGuru'])->name('kelola-guru.update');
    Route::delete('/kelola-guru/{id}', [App\Http\Controllers\OperatorController::class, 'destroyGuru'])->name('kelola-guru.destroy');

    Route::get('/lihat-jadwal', function () {
        return view('Operator.lihat_jadwal');
    })->name('lihat-jadwal');

    Route::get('/kalender-kegiatan', [App\Http\Controllers\OperatorController::class, 'indexKalenderKegiatan'])->name('kalender-kegiatan');
    Route::post('/kalender-kegiatan', [App\Http\Controllers\OperatorController::class, 'storeKalenderKegiatan']);
    Route::put('/kalender-kegiatan/{id}', [App\Http\Controllers\OperatorController::class, 'updateKalenderKegiatan']);
    Route::delete('/kalender-kegiatan/{id}', [App\Http\Controllers\OperatorController::class, 'destroyKalenderKegiatan']);

    Route::get('/pengumuman', [App\Http\Controllers\OperatorController::class, 'indexPengumuman'])->name('pengumuman');
    Route::get('/pengumuman/buat', [App\Http\Controllers\OperatorController::class, 'createPengumuman'])->name('pengumuman.buat');
    Route::post('/pengumuman', [App\Http\Controllers\OperatorController::class, 'storePengumuman'])->name('pengumuman.store');
    Route::get('/pengumuman/{id}/edit', [App\Http\Controllers\OperatorController::class, 'editPengumuman'])->name('pengumuman.edit');
    Route::put('/pengumuman/{id}', [App\Http\Controllers\OperatorController::class, 'updatePengumuman'])->name('pengumuman.update');
    Route::delete('/pengumuman/{id}', [App\Http\Controllers\OperatorController::class, 'destroyPengumuman'])->name('pengumuman.destroy');

    Route::get('/galeri', [App\Http\Controllers\OperatorController::class, 'indexGaleri'])->name('galeri');
    Route::get('/galeri/buat', [App\Http\Controllers\OperatorController::class, 'createGaleri'])->name('galeri.buat');
    Route::post('/galeri', [App\Http\Controllers\OperatorController::class, 'storeGaleri'])->name('galeri.store');
    Route::get('/galeri/{id}/edit', [App\Http\Controllers\OperatorController::class, 'editGaleri'])->name('galeri.edit');
    Route::put('/galeri/{id}', [App\Http\Controllers\OperatorController::class, 'updateGaleri'])->name('galeri.update');
    Route::delete('/galeri/{id}', [App\Http\Controllers\OperatorController::class, 'destroyGaleri'])->name('galeri.destroy');
});

// Guru Routes
Route::middleware(['auth', 'role:guru'])->prefix('guru')->name('guru.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\GuruController::class, 'dashboard'])->name('dashboard');
    
    Route::get('/kehadiran', [App\Http\Controllers\GuruController::class, 'kehadiran'])->name('kehadiran');
    Route::post('/kehadiran', [App\Http\Controllers\GuruController::class, 'storeKehadiran'])->name('kehadiran.store');

    Route::get('/nilai', [App\Http\Controllers\GuruController::class, 'nilai'])->name('nilai');
    Route::post('/nilai', [App\Http\Controllers\GuruController::class, 'storeNilai'])->name('nilai.store');

    Route::get('/lihat-jadwal', [App\Http\Controllers\GuruController::class, 'jadwal'])->name('lihat-jadwal');

    Route::get('/unggah-foto', [App\Http\Controllers\GuruController::class, 'galeri'])->name('galeri');
    Route::post('/unggah-foto', [App\Http\Controllers\GuruController::class, 'storeGaleri'])->name('galeri.store');
    Route::delete('/unggah-foto/{id}', [App\Http\Controllers\GuruController::class, 'destroyGaleri'])->name('galeri.destroy');

    Route::get('/buat-pengumuman', [App\Http\Controllers\GuruController::class, 'buatPengumuman'])->name('buat-pengumuman');
    Route::post('/buat-pengumuman', [App\Http\Controllers\GuruController::class, 'storePengumuman'])->name('pengumuman.store');
    
    Route::get('/daftar-pengumuman', [App\Http\Controllers\GuruController::class, 'daftarPengumuman'])->name('daftar-pengumuman');
    Route::delete('/pengumuman/{id}', [App\Http\Controllers\GuruController::class, 'destroyPengumuman'])->name('pengumuman.destroy');
});

// Orang Tua Routes
Route::middleware(['auth', 'role:orang_tua'])->prefix('orang-tua')->name('orang-tua.')->group(function () {
    Route::get('/dashboard', function () {
        return view('orang_tua.dashboard');
    })->name('dashboard');

    Route::get('/lihat-nilai', function () {
        return view('orang_tua.lihat_nilai');
    })->name('lihat-nilai');

    Route::get('/lihat-jadwal', function () {
        return view('orang_tua.lihat_jadwal');
    })->name('lihat-jadwal');

    Route::get('/lihat-kehadiran', function () {
        return view('orang_tua.lihat_kehadiran');
    })->name('lihat-kehadiran');

    Route::get('/unduh-laporan', function () {
        return view('orang_tua.unduh_laporan');
    })->name('unduh-laporan');

    Route::get('/lihat-pengumuman', function () {
        return view('orang_tua.lihat_pengumuman');
    })->name('lihat-pengumuman');

    Route::get('/foto-kegiatan', function () {
        return view('orang_tua.foto_kegiatan');
    })->name('foto-kegiatan');

    Route::get('/hubungi-guru', function () {
        return view('orang_tua.hubungi_guru');
    })->name('hubungi-guru');
});
