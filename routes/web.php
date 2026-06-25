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
    $credentials = $request->validate([
        'email'    => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    return back()->withErrors([
        'email' => 'Email atau kata sandi yang Anda masukkan salah.',
    ])->onlyInput('email');
});

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

// Operator Routes
Route::middleware(['auth', 'role:operator'])->prefix('operator')->name('operator.')->group(function () {
    Route::get('/dashboard', function () {
        return view('Operator.dashboard');
    })->name('dashboard');

    Route::get('/kelola_wali', [\App\Http\Controllers\OperatorController::class, 'indexWali'])->name('kelola_wali');
    Route::post('/kelola_wali', [\App\Http\Controllers\OperatorController::class, 'storeWali']);
    Route::put('/kelola_wali/{id}', [\App\Http\Controllers\OperatorController::class, 'updateWali'])->name('operator.kelola_wali.update');
    Route::delete('/kelola_wali/{id}', [\App\Http\Controllers\OperatorController::class, 'destroyWali'])->name('operator.kelola_wali.destroy');

    Route::get('/kelola-kelas', [\App\Http\Controllers\OperatorController::class, 'indexKelas'])->name('kelola-kelas');
    Route::post('/kelola-kelas', [\App\Http\Controllers\OperatorController::class, 'storeKelas']);
    Route::put('/kelola-kelas/{id}', [\App\Http\Controllers\OperatorController::class, 'updateKelas'])->name('operator.kelola-kelas.update');
    Route::delete('/kelola-kelas/{id}', [\App\Http\Controllers\OperatorController::class, 'destroyKelas'])->name('operator.kelola-kelas.destroy');

    Route::get('/kelola-kelas/{kelas_id}/jadwal', [\App\Http\Controllers\OperatorController::class, 'indexJadwalKelas'])->name('operator.jadwal-kelas');
    Route::post('/kelola-kelas/{kelas_id}/jadwal', [\App\Http\Controllers\OperatorController::class, 'storeJadwalKelas']);
    Route::put('/jadwal-kelas/{id}', [\App\Http\Controllers\OperatorController::class, 'updateJadwalKelas']);
    Route::delete('/jadwal-kelas/{id}', [\App\Http\Controllers\OperatorController::class, 'destroyJadwalKelas']);

    Route::get('/kelola-guru', function () {
        return view('Operator.kelola_guru');
    })->name('kelola-guru');

    Route::get('/lihat-jadwal', function () {
        return view('Operator.lihat_jadwal');
    })->name('lihat-jadwal');

    Route::get('/kalender-kegiatan', [App\Http\Controllers\OperatorController::class, 'indexKalenderKegiatan'])->name('kalender-kegiatan');
    Route::post('/kalender-kegiatan', [App\Http\Controllers\OperatorController::class, 'storeKalenderKegiatan']);
    Route::put('/kalender-kegiatan/{id}', [App\Http\Controllers\OperatorController::class, 'updateKalenderKegiatan']);
    Route::delete('/kalender-kegiatan/{id}', [App\Http\Controllers\OperatorController::class, 'destroyKalenderKegiatan']);

    Route::get('/pengumuman', function () {
        return view('Operator.daftar_pengumuman');
    })->name('pengumuman');

    Route::get('/galeri', function () {
        return view('Operator.galeri_kegiatan');
    })->name('galeri');
});

// Guru Routes
Route::middleware(['auth', 'role:guru'])->prefix('guru')->name('guru.')->group(function () {
    Route::get('/dashboard', function () {
        return view('guru.dashboard');
    })->name('dashboard');

    Route::get('/kehadiran', function () {
        return view('guru.kehadiran');
    })->name('kehadiran');

    Route::get('/nilai', function () {
        return view('guru.nilai');
    })->name('nilai');

    Route::get('/lihat-jadwal', function () {
        return view('guru.lihat_jadwal');
    })->name('lihat-jadwal');

    Route::get('/unggah-foto', function () {
        return view('guru.galeri');
    })->name('galeri');

    Route::get('/buat-pengumuman', function () {
        return view('guru.pengumuman');
    })->name('buat-pengumuman');

    Route::get('/daftar-pengumuman', function () {
        return view('guru.daftar_pengumuman');
    })->name('daftar-pengumuman');
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
