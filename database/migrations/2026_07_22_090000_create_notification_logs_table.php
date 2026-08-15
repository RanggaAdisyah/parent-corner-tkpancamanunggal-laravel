<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notification_logs', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['galeri', 'pengumuman', 'nilai', 'kehadiran']);
            $table->enum('event', ['created', 'updated', 'deleted']);
            $table->unsignedBigInteger('notifiable_id');      // galeri_id / pengumuman_id
            $table->unsignedBigInteger('recipient_id')->nullable(); // user_id ortu (null = broadcast)
            $table->string('recipient_email', 191)->nullable();
            $table->string('subject', 191);
            $table->enum('status', ['pending', 'sent', 'failed', 'skipped'])->default('pending');
            $table->text('error_message')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();

            $table->index(['type', 'event']);
            $table->index('notifiable_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_logs');
    }
};
