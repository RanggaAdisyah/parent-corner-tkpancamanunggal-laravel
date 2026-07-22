<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galeri_siswa', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('galeri_id');
            $table->foreign('galeri_id')->references('id')->on('galeris')->onDelete('cascade');
            $table->unsignedInteger('siswa_id');
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['galeri_id', 'siswa_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galeri_siswa');
    }
};
