<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function pengumumans()
    {
        return $this->belongsToMany(Pengumuman::class, 'pengumuman_kelas');
    }

    public function galeris()
    {
        return $this->belongsToMany(Galeri::class, 'galeri_kelas');
    }
}
