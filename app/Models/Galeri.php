<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
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
}
