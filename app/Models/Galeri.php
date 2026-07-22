<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;
    protected $table = 'galeris';
    protected $fillable = ['judul', 'deskripsi', 'tanggal_kegiatan', 'kategori', 'foto'];
    
    protected $casts = [
        'kategori' => 'array',
        'foto' => 'array',
    ];

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'galeri_kelas', 'galeri_id', 'kelas_id');
    }

    public function siswa()
    {
        return $this->belongsToMany(Siswa::class, 'galeri_siswa', 'galeri_id', 'siswa_id');
    }
}
