<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('orang_tua_id')->nullable();
            $table->foreign('orang_tua_id')->references('id')->on('orang_tuas')->onDelete('set null');
            $table->unsignedInteger('kelas_id')->nullable();
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('set null');
            $table->string('nama');
            $table->string('nis')->unique()->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index('nama');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
