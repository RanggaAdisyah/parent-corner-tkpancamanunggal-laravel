<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ppdb extends Model
{
    // Arahkan spesifik ke tabel 'ppdb' karena nama tabelnya tidak jamak (ppdbs)
    protected $table = 'ppdb';

    // Matikan timestamps bawaan Laravel (created_at, updated_at)
    // karena tabel ini menggunakan createdAt dan updatedAt
    public $timestamps = false;

    // Izinkan pengisian masal ke semua kolom
    protected $guarded = [];
}
