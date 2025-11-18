<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrokerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'subscription_id' => $this->subscription_id,
            'plan_type' => $this->plan_type?->value,
            'is_active' => $this->is_active,
            'subscription_expires_at' => $this->subscription_expires_at,
            'team_id' => $this->team_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
                'ucode' => $this->user->ucode,
            ],
            'subscription' => $this->when($this->subscription, [
                'id' => $this->subscription?->id,
                'name' => $this->subscription?->name,
                'description' => $this->subscription?->description,
                'price' => $this->subscription?->price,
                'duration_days' => $this->subscription?->durationDays,
            ]),
        ];
    }
}


