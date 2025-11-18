<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeadAutomationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'lead_id' => $this->lead_id,
            'lead' => [
                'id' => $this->lead->id ?? null,
                'name' => $this->lead->name ?? null,
                'email' => $this->lead->email ?? null,
                'phone' => $this->lead->phone ?? null,
            ],
            'assist_status' => $this->assist_status,
            'assist_substatus' => $this->assist_substatus,
            'estimated_payment' => $this->estimated_payment?->format('Y-m-d H:i:s'),
            'billetdue_date' => $this->billetdue_date?->format('Y-m-d H:i:s'),
            'renewal_date' => $this->renewal_date?->format('Y-m-d H:i:s'),
            'selected_menu' => $this->selected_menu,
            'current_state' => $this->current_state,
            'birthday' => $this->birthday?->format('Y-m-d'),
            'wedding' => $this->wedding?->format('Y-m-d'),
            'company_niver' => $this->company_niver?->format('Y-m-d'),
            'holidays' => $this->holidays,
            'important_updates' => $this->important_updates,
            'active_days' => $this->active_days,
            'periodic_contact' => $this->periodic_contact?->format('Y-m-d H:i:s'),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
