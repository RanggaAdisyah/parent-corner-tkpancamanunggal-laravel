<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Truncate nilais table to avoid null/data conflict since schema completely changes
        DB::table('nilais')->truncate();

        Schema::table('nilais', function (Blueprint $table) {
            $table->dropColumn(['kegiatan', 'catatan']);
            $table->string('level')->after('tanggal');
            $table->string('hal')->after('level');
            $table->text('keterangan')->nullable()->after('nilai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nilais', function (Blueprint $table) {
            $table->dropColumn(['level', 'hal', 'keterangan']);
            $table->string('kegiatan');
            $table->text('catatan')->nullable();
        });
    }
};
