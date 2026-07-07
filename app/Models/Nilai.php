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
        'level',
        'hal',
        'nilai',
        'keterangan',
    ];



    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
