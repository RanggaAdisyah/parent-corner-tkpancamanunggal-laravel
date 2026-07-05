<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'nama_lengkap'  => 'encrypted',
        'nip'           => 'encrypted',
        'no_hp'         => 'encrypted',
        'alamat'        => 'encrypted',
        'tanggal_lahir' => 'encrypted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
