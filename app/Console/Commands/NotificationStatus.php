<?php

namespace App\Console\Commands;

use App\Models\NotificationLog;
use Illuminate\Console\Command;

class NotificationStatus extends Command
{
    protected $signature = 'notifications:status {--pending : Tampilkan hanya pending} {--failed : Tampilkan hanya failed} {--retry : Retry semua failed jobs}';
    protected $description = 'Cek status notifikasi email';

    public function handle()
    {
        if ($this->option('retry')) {
            return $this->retryFailed();
        }

        $query = NotificationLog::query();

        if ($this->option('pending')) {
            $query->where('status', 'pending');
        } elseif ($this->option('failed')) {
            $query->where('status', 'failed');
        }

        $total = $query->count();
        $sent = NotificationLog::where('status', 'sent')->count();
        $failed = NotificationLog::where('status', 'failed')->count();
        $pending = NotificationLog::where('status', 'pending')->count();

        $this->info("\n📊 Notification Logs Summary");
        $this->line(str_repeat('─', 50));
        $this->line("  Total   : {$total}");
        $this->line("  ✅ Sent  : {$sent}");
        $this->line("  ⏳ Pending: {$pending}");
        $this->line("  ❌ Failed: {$failed}");
        $this->line(str_repeat('─', 50));

        if ($this->option('pending') || $this->option('failed')) {
            $logs = $query->latest()->limit(20)->get();
            if ($logs->isEmpty()) {
                $this->warn("\nTidak ada notifikasi dengan status tersebut.");
                return;
            }

            $this->table(
                ['ID', 'Type', 'Event', 'Recipient', 'Subject', 'Status', 'Sent At'],
                $logs->map(fn($l) => [
                    $l->id,
                    $l->type,
                    $l->event,
                    $l->recipient_email ?? 'broadcast',
                    substr($l->subject, 0, 40) . (strlen($l->subject) > 40 ? '...' : ''),
                    $l->status,
                    $l->sent_at?->format('Y-m-d H:i:s') ?? '-',
                ])->toArray()
            );
        }
    }

    protected function retryFailed()
    {
        $failed = NotificationLog::where('status', 'failed')->get();
        if ($failed->isEmpty()) {
            $this->info('Tidak ada notifikasi yang failed.');
            return 0;
        }

        if (!$this->confirm("Retry {$failed->count()} notifikasi yang failed?")) {
            return 1;
        }

        foreach ($failed as $log) {
            $log->update(['status' => 'pending', 'error_message' => null]);
        }

        $this->info("✅ {$failed->count()} notifikasi di-reset ke pending. Jalankan 'php artisan queue:work' untuk memproses.");
        return 0;
    }
}
