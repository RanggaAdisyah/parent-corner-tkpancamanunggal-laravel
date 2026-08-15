<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use App\Mail\GaleriNotificationMail;
use App\Models\Galeri;
use App\Models\User;

class MailTest extends Command
{
    protected $signature = 'mail:test
                            {--to= : Email tujuan (default: user pertama)}
                            {--provider= : Quick test preset: hostinger|domainesia|gmail|niagahoster}
                            {--smtp : Force pakai driver SMTP (override MAIL_MAILER=log)}';

    protected $description = 'Test konfigurasi email/SMTP dan kirim email percobaan';

    public function handle()
    {
        $this->info("\n📧  Mail Test — Parent Corner");
        $this->line(str_repeat('═', 60));

        // 1. Tampilkan config saat ini
        $this->showConfig();
        $this->newLine();

        // 2. Quick preset
        if ($preset = $this->option('provider')) {
            $this->applyPreset($preset);
            $this->newLine();
            $this->info("✓ Preset '{$preset}' diterapkan ke ENV (runtime saja)");
            $this->showConfig();
            $this->newLine();
        }

        // Reset mailer supaya pakai config baru
        $this->refreshMailerConfig();

        // Override driver kalau --smtp
        if ($this->option('smtp')) {
            Config::set('mail.default', 'smtp');
            $this->warn("⚠ Override: pakai driver SMTP (override MAIL_MAILER di .env)");
        }

        // 3. Tentukan email tujuan
        $to = $this->option('to') ?? User::whereNotNull('email')->first()?->email;
        if (!$to) {
            $this->error("❌ Tidak ada email tujuan. Gunakan --to=email@domain.com");
            return 1;
        }

        $this->info("📨 Akan kirim ke: {$to}");
        $this->newLine();

        // 4. Test koneksi SMTP dulu (jika smtp)
        $driver = Config::get('mail.default');
        if ($driver === 'smtp') {
            $this->info("🔌 Testing koneksi SMTP...");
            try {
                $this->testConnection();
                $this->info("✅ Koneksi SMTP berhasil!");
            } catch (\Throwable $e) {
                $this->error("❌ Koneksi gagal: " . $e->getMessage());
                $this->line("\n💡 Troubleshooting:");
                $this->line("   - Cek MAIL_HOST, MAIL_PORT benar");
                $this->line("   - Cek MAIL_USERNAME/MAIL_PASSWORD");
                $this->line("   - Port 465 (SSL) vs 587 (TLS) jangan salah");
                $this->line("   - Beberapa hosting butuh MAIL_SCHEME=ssl");
                $this->line("   - Firewall server biasanya block port 25/465/587");
                return 1;
            }
        } else {
            $this->warn("⚠ MAIL_MAILER=log → email tidak terkirim beneran, hanya ditulis ke storage/logs/laravel.log");
        }

        $this->newLine();

        // 5. Kirim email test
        $this->info("📤 Mengirim email test...");
        try {
            Mail::raw(
                "🎉 Email test berhasil!\n\nWaktu: " . now()->translatedFormat('d F Y H:i:s') . "\nDriver: {$driver}\n\nJika Anda menerima email ini, konfigurasi SMTP sudah benar.\n\n— Parent Corner System",
                function ($message) use ($to) {
                    $message->to($to)
                        ->subject('✅ Test Email dari Parent Corner');
                }
            );
            $this->info("✅ Email terkirim!");
        } catch (\Throwable $e) {
            $this->error("❌ Gagal kirim: " . $e->getMessage());
            return 1;
        }

        $this->newLine();

        if ($driver === 'log') {
            $this->info("📂 Cek email di: storage/logs/laravel.log");
        } else {
            $this->info("📂 Cek inbox (atau spam) di: {$to}");
        }

        $this->newLine();
        $this->line(str_repeat('═', 60));
        $this->info("✅ Selesai.\n");
        return 0;
    }

    protected function showConfig(): void
    {
        $data = [
            'MAIL_MAILER'  => Config::get('mail.default'),
            'MAIL_HOST'    => Config::get('mail.mailers.smtp.host'),
            'MAIL_PORT'    => Config::get('mail.mailers.smtp.port'),
            'MAIL_SCHEME'  => Config::get('mail.mailers.smtp.scheme') ?? 'null',
            'MAIL_USERNAME'=> Config::get('mail.mailers.smtp.username') ?? 'null',
            'MAIL_PASSWORD'=> Config::get('mail.mailers.smtp.password') ? '••••••••' : 'null',
            'FROM_ADDRESS' => Config::get('mail.from.address'),
            'FROM_NAME'    => Config::get('mail.from.name'),
        ];

        $this->table(['Key', 'Value'], collect($data)->map(fn($v, $k) => [$k, $v])->values()->toArray());
    }

    protected function testConnection(): void
    {
        $host = Config::get('mail.mailers.smtp.host');
        $port = Config::get('mail.mailers.smtp.port');
        $timeout = 5;

        $connection = @fsockopen($host, $port, $errno, $errstr, $timeout);
        if (!$connection) {
            throw new \Exception("Cannot connect to {$host}:{$port} - {$errstr} ({$errno})");
        }
        fclose($connection);
    }

    protected function applyPreset(string $preset): void
    {
        $presets = [
            'hostinger' => [
                'host' => 'smtp.hostinger.com',
                'port' => 465,
                'scheme' => 'ssl',     // port 465 + ssl
            ],
            'domainesia' => [
                'host' => 'mail.YOURDOMAIN.com',
                'port' => 465,
                'scheme' => 'ssl',
            ],
            'niagahoster' => [
                'host' => 'mail.YOURDOMAIN.com',
                'port' => 465,
                'scheme' => 'ssl',
            ],
            'gmail' => [
                'host' => 'smtp.gmail.com',
                'port' => 587,
                'scheme' => null,      // port 587 + tls (encryption)
                'encryption' => 'tls',
            ],
        ];

        if (!isset($presets[$preset])) {
            $this->warn("Unknown preset: {$preset}");
            return;
        }

        $p = $presets[$preset];
        Config::set('mail.mailers.smtp.host', $p['host']);
        Config::set('mail.mailers.smtp.port', $p['port']);
        Config::set('mail.mailers.smtp.scheme', $p['scheme'] ?? null);
        Config::set('mail.mailers.smtp.encryption', $p['encryption'] ?? null);

        // Re-resolve transport based on scheme
        $this->refreshMailerConfig();
    }

    protected function refreshMailerConfig(): void
    {
        $scheme = Config::get('mail.mailers.smtp.scheme');
        $encryption = Config::get('mail.mailers.smtp.encryption');
        $isSsl = $scheme === 'ssl' || $encryption === 'ssl';
        $isTls = $encryption === 'tls';

        // SSL (port 465) → transport = smtps, no scheme/encryption
        // TLS (port 587) → transport = smtp, encryption = tls (Laravel handle STARTTLS)
        // NULL (port 25) → transport = smtp, no encryption
        Config::set('mail.mailers.smtp.transport', $isSsl ? 'smtps' : 'smtp');
        if ($isSsl) {
            Config::set('mail.mailers.smtp.scheme', null);
            Config::set('mail.mailers.smtp.encryption', null);
        }

        // Register smtps mailer kalau dipakai
        if ($isSsl) {
            Config::set('mail.mailers.smtps', [
                'transport' => 'smtps',
                'host' => Config::get('mail.mailers.smtp.host'),
                'port' => Config::get('mail.mailers.smtp.port'),
                'username' => Config::get('mail.mailers.smtp.username'),
                'password' => Config::get('mail.mailers.smtp.password'),
                'timeout' => Config::get('mail.mailers.smtp.timeout', 30),
                'local_domain' => Config::get('mail.mailers.smtp.local_domain'),
            ]);
        }

        // Purge both mailers
        Mail::purge('smtp');
        Mail::purge('smtps');

        // Re-create mailer instance
        $this->laravel->forgetInstance('mail.manager');
    }
}
