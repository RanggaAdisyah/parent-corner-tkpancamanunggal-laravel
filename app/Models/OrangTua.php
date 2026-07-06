<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'nama_ayah' => 'encrypted',
        'nama_ibu'  => 'encrypted',
        'no_hp'     => 'encrypted',
        'alamat'    => 'encrypted',
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function siswas() { return $this->hasMany(Siswa::class); }
}
