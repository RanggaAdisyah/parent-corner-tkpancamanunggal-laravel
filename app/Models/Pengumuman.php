<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;
    protected $table = 'pengumumans';
    protected $fillable = ['judul', 'isi_pesan', 'lampiran'];
    protected $casts = [
        'lampiran' => 'array',
    ];

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'pengumuman_kelas');
    }
}
