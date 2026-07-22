<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $casts = [
        'tanggal_lahir' => 'date',
    ];


    public function orangTua() { return $this->belongsTo(OrangTua::class); }
    public function kelasLokal() { return $this->belongsTo(Kelas::class, 'kelas_id'); }
    public function kelas() { return $this->belongsTo(Kelas::class, 'kelas_id'); }
    public function galeri()
    {
        return $this->belongsToMany(Galeri::class, 'galeri_siswa', 'siswa_id', 'galeri_id');
    }
}
