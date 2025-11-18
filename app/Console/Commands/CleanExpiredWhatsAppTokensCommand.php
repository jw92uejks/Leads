<?php

namespace App\Console\Commands;

use App\Models\WhatsAppTokenCache;
use Illuminate\Console\Command;

class CleanExpiredWhatsAppTokensCommand extends Command
{
    protected $signature = 'whatsapp:clean-expired-tokens';

    protected $description = 'Remove tokens expirados do cache de WhatsApp';

    public function handle(): int
    {
        $this->info('Iniciando limpeza de tokens expirados...');

        $expiredCount = WhatsAppTokenCache::query()
            ->where('expires_at', '<=', now())
            ->count();

        if ($expiredCount === 0) {
            $this->info('✓ Nenhum token expirado encontrado.');
            return self::SUCCESS;
        }

        $deleted = WhatsAppTokenCache::query()
            ->where('expires_at', '<=', now())
            ->delete();

        $this->info("✓ {$deleted} token(s) expirado(s) removido(s) do cache.");

        return self::SUCCESS;
    }
}

