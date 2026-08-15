<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'tanggal',
        'bulan',
        'minggu_ke',
        'level',     // Dipakai sebagai kategori: sosial_emosional | fisik_motorik | bahasa | kognitif
        'hal',       // Legacy, tidak dipakai lagi
        'nilai',     // Dipakai sebagai skala: BB | MB | BSH | BSB
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'bulan' => 'integer',
        'minggu_ke' => 'integer',
    ];

    public const KATEGORI = [
        'sosial_emosional' => ['label' => 'Sosial Emosional', 'icon' => '👥', 'color' => '#ec4899'],
        'fisik_motorik'    => ['label' => 'Fisik Motorik',    'icon' => '🏃', 'color' => '#f97316'],
        'bahasa'           => ['label' => 'Bahasa',           'icon' => '💬', 'color' => '#14b8a6'],
        'kognitif'         => ['label' => 'Kognitif',         'icon' => '💡', 'color' => '#3b82f6'],
    ];

    public const SKALA = [
        'BB'  => ['label' => 'Belum Berkembang',               'short' => 'BB',  'color' => '#ef4444', 'stars' => 1],
        'MB'  => ['label' => 'Mulai Berkembang',               'short' => 'MB',  'color' => '#f59e0b', 'stars' => 2],
        'BSH' => ['label' => 'Berkembang Sesuai Harapan',      'short' => 'BSH', 'color' => '#3b82f6', 'stars' => 3],
        'BSB' => ['label' => 'Berkembang Sangat Baik',         'short' => 'BSB', 'color' => '#10b981', 'stars' => 4],
    ];

    public static function kategoriList(): array
    {
        return self::KATEGORI;
    }

    public static function skalaList(): array
    {
        return self::SKALA;
    }

    public function getKategoriLabelAttribute(): string
    {
        return self::KATEGORI[$this->level]['label'] ?? $this->level;
    }

    public function getSkalaLabelAttribute(): string
    {
        return self::SKALA[$this->nilai]['label'] ?? $this->nilai;
    }

    public function getSkalaColorAttribute(): string
    {
        return self::SKALA[$this->nilai]['color'] ?? '#64748b';
    }

    public function getKategoriColorAttribute(): string
    {
        return self::KATEGORI[$this->level]['color'] ?? '#64748b';
    }

    public function getKategoriIconAttribute(): string
    {
        return self::KATEGORI[$this->level]['icon'] ?? '📋';
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
