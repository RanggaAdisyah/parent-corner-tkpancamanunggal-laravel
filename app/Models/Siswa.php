<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $guarded = [];
    public function orangTua() { return $this->belongsTo(OrangTua::class); }
    public function kelasLokal() { return $this->belongsTo(Kelas::class, 'kelas_id'); }
}
