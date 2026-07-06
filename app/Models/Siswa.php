<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'nama'          => 'encrypted',
        'tanggal_lahir' => 'encrypted',
    ];

    public function orangTua() { return $this->belongsTo(OrangTua::class); }
    public function kelasLokal() { return $this->belongsTo(Kelas::class, 'kelas_id'); }
}
