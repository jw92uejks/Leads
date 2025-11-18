<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\LeadEnteredNewStep;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class SendLeadWebhookListener
{
    public function handle(LeadEnteredNewStep $event): void
    {
        if (app()->runningUnitTests()) {
            return;
        }

        $lead = $event->lead->loadMissing(['broker.user', 'supplier']);

        $idempotencyKey = "lead_webhook_{$lead->id}_{$event->step}_{$event->user->id}";

        if (Cache::has($idempotencyKey)) {
            return;
        }

        Cache::put($idempotencyKey, 'processing', now()->addMinutes(5));

        $payload = [
            'event' => 'lead.entered_new',
            'occurred_at' => now()->toISOString(),
            'lead' => [
                'id' => $lead->id,
                'supplier_id' => $lead->supplier_id,
                'broker_id' => $lead->broker_id,
                'name' => $lead->name,
                'corporateName' => $lead->corporateName,
                'phone' => $lead->phone,
                'email' => $lead->email,
                'type' => $lead->type?->value ?? $lead->type,
                'cpf' => $lead->cpf,
                'cnpj' => $lead->cnpj,
                'city' => $lead->city,
                'state' => $lead->state,
                'status' => $lead->status?->value ?? $lead->status,
                'source' => $lead->source,
                'code' => $lead->code,
                'isAutomation' => $lead->isAutomation,
                'lifes' => $lead->lifes,
                'acceptContestation' => $lead->acceptContestation,
                'temperature' => $lead->temperature?->value ?? $lead->temperature,
                'description' => $lead->description,
                'startPrice' => $lead->startPrice,
                'currentPrice' => $lead->currentPrice,
                'pricingType' => $lead->pricingType?->value ?? $lead->pricingType,
                'depreciationPercent' => $lead->depreciationPercent,
                'depreciationInterval' => $lead->depreciationInterval,
                'lead_expires_at' => $lead->lead_expires_at?->toISOString(),
                'acquired_at' => $lead->acquired_at?->toISOString(),
                'step' => $lead->step,
                'created_at' => $lead->created_at?->toISOString(),
                'updated_at' => $lead->updated_at?->toISOString(),
            ],
            'user' => [
                'name' => $event->user->name,
                'email' => $event->user->email,
                'broker' => [
                    'phone' => $lead->broker?->user?->phone,
                    'token' => $lead->broker?->user?->ucode,
                ],
            ],
        ];

        $url = config('services.lead_webhook.url', env('WEBHOOK_LEAD_URL', 'https://whnn.niceapi.xyz/webhook/inputleadkanban'));

        try {
            $response = Http::timeout(10)
                ->retry(3, 500)
                ->withoutVerifying()
                ->acceptJson()
                ->withHeaders([
                    'Idempotency-Key' => $idempotencyKey,
                    'User-Agent' => 'Ondeal/LeadWebhookListener',
                    'Content-Type' => 'application/json',
                ])
                ->post($url, $payload);

            if ($response->successful()) {
                Cache::put($idempotencyKey, 'sent', now()->addHours(24));
            } else {
                Cache::forget($idempotencyKey);

                \Log::error('SendLeadWebhookListener: webhook retornou status não-sucesso', [
                    'lead_id' => $lead->id,
                    'step' => $event->step,
                    'user_id' => $event->user->id,
                    'status' => $response->status(),
                    'body' => substr((string) $response->body(), 0, 500),
                    'headers' => $response->headers()
                ]);
            }
        } catch (\Throwable $e) {
            Cache::forget($idempotencyKey);

            \Log::error('SendLeadWebhookListener: falha ao enviar webhook', [
                'lead_id' => $lead->id,
                'step' => $event->step,
                'user_id' => $event->user->id,
                'url' => $url,
                'idempotency_key' => $idempotencyKey,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return;
        }
    }
}


