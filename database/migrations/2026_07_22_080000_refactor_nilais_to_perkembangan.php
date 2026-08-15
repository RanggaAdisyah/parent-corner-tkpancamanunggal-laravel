<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Step 1: Drop FK supaya bisa drop unique index
        $fkExists = collect(DB::select("SELECT CONSTRAINT_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'nilais' AND REFERENCED_TABLE_NAME = 'siswas'"))->isNotEmpty();
        if ($fkExists) {
            Schema::table('nilais', function (Blueprint $table) {
                $table->dropForeign(['siswa_id']);
            });
        }

        // Step 2: Tambah kolom bulan & minggu_ke jika belum ada
        if (!Schema::hasColumn('nilais', 'bulan')) {
            Schema::table('nilais', function (Blueprint $table) {
                $table->unsignedTinyInteger('bulan')->nullable()->after('tanggal');
                $table->unsignedTinyInteger('minggu_ke')->nullable()->after('bulan');
            });
        }

        // Step 3: Jadikan 'hal' nullable (legacy column, tidak dipakai lagi)
        if (Schema::hasColumn('nilais', 'hal')) {
            DB::statement('ALTER TABLE nilais MODIFY hal VARCHAR(255) NULL');
        }

        // Step 4: Drop unique key lama, add unique key baru
        $oldUniqueExists = collect(DB::select("SHOW INDEX FROM nilais WHERE Key_name = 'nilais_siswa_id_tanggal_level_hal_unique'"))->isNotEmpty();
        if ($oldUniqueExists) {
            Schema::table('nilais', function (Blueprint $table) {
                $table->dropUnique(['siswa_id', 'tanggal', 'level', 'hal']);
            });
        }

        $newUniqueExists = collect(DB::select("SHOW INDEX FROM nilais WHERE Key_name = 'nilais_siswa_tanggal_kategori_unique'"))->isNotEmpty();
        if (!$newUniqueExists) {
            Schema::table('nilais', function (Blueprint $table) {
                $table->unique(['siswa_id', 'tanggal', 'level'], 'nilais_siswa_tanggal_kategori_unique');
            });
        }

        // Step 5: Re-add FK
        if ($fkExists) {
            Schema::table('nilais', function (Blueprint $table) {
                $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        $fkExists = collect(DB::select("SELECT CONSTRAINT_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'nilais' AND REFERENCED_TABLE_NAME = 'siswas'"))->isNotEmpty();
        if ($fkExists) {
            Schema::table('nilais', function (Blueprint $table) {
                $table->dropForeign(['siswa_id']);
            });
        }

        $newUniqueExists = collect(DB::select("SHOW INDEX FROM nilais WHERE Key_name = 'nilais_siswa_tanggal_kategori_unique'"))->isNotEmpty();
        if ($newUniqueExists) {
            Schema::table('nilais', function (Blueprint $table) {
                $table->dropUnique('nilais_siswa_tanggal_kategori_unique');
            });
        }

        DB::statement('ALTER TABLE nilais MODIFY hal VARCHAR(255) NOT NULL');

        $oldUniqueExists = collect(DB::select("SHOW INDEX FROM nilais WHERE Key_name = 'nilais_siswa_id_tanggal_level_hal_unique'"))->isNotEmpty();
        if (!$oldUniqueExists) {
            Schema::table('nilais', function (Blueprint $table) {
                $table->unique(['siswa_id', 'tanggal', 'level', 'hal']);
            });
        }

        if (Schema::hasColumn('nilais', 'bulan')) {
            Schema::table('nilais', function (Blueprint $table) {
                $table->dropColumn(['bulan', 'minggu_ke']);
            });
        }

        if (!$fkExists) {
            Schema::table('nilais', function (Blueprint $table) {
                $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
            });
        }
    }
};
