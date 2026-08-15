<?php

namespace App\Services;

use App\Models\Galeri;
use App\Models\Pengumuman;
use App\Models\Siswa;
use Illuminate\Support\Collection;

class NotificationRecipientResolver
{
    /**
     * Resolve recipients (OrangTua) untuk galeri tertentu.
     * - Jika galeri personal (target siswa), hanya ortu dari siswa tsb.
     * - Jika galeri kelas, semua ortu di kelas tsb.
     */
    public function forGaleri(Galeri $galeri): Collection
    {
        $galeri->loadMissing('kelas', 'siswa');

        // Personal: target siswa tertentu
        if ($galeri->siswa->isNotEmpty()) {
            $siswaIds = $galeri->siswa->pluck('id');
            return $this->ortuFromSiswa($siswaIds);
        }

        // Kelas: target seluruh kelas
        if ($galeri->kelas->isNotEmpty()) {
            $kelasIds = $galeri->kelas->pluck('id');
            $siswaIds = Siswa::whereIn('kelas_id', $kelasIds)->pluck('id');
            return $this->ortuFromSiswa($siswaIds);
        }

        // Fallback: tidak ada target, tidak kirim
        return collect();
    }

    /**
     * Resolve recipients untuk pengumuman.
     */
    public function forPengumuman(Pengumuman $pengumuman): Collection
    {
        $pengumuman->loadMissing('kelas');

        if ($pengumuman->kelas->isEmpty()) {
            return collect();
        }

        $kelasIds = $pengumuman->kelas->pluck('id');
        $siswaIds = Siswa::whereIn('kelas_id', $kelasIds)->pluck('id');
        return $this->ortuFromSiswa($siswaIds);
    }

    /**
     * Ambil data orang tua unik (by user_id) yang punya email valid.
     * Relasi: siswa -> orangTua (satu siswa satu orang tua) -> user (untuk email)
     */
    protected function ortuFromSiswa($siswaIds): Collection
    {
        return \App\Models\OrangTua::query()
            ->whereHas('siswas', function($q) use ($siswaIds) {
                $q->whereIn('id', $siswaIds);
            })
            ->with('user')
            ->get()
            ->pluck('user')
            ->filter(fn($u) => $u && $u->email)
            ->unique('id')
            ->values();
    }
}
