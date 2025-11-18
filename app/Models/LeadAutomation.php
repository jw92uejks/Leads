<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeadAutomation extends Model
{
    protected $table = 'lead_automation';

    protected $fillable = [
        'lead_id',
        'assist_status',
        'assist_substatus',
        'estimated_payment',
        'billetdue_date',
        'renewal_date',
        'selected_menu',
        'current_state',
        'birthday',
        'wedding',
        'company_niver',
        'holidays',
        'important_updates',
        'active_days',
        'periodic_contact',
    ];

    protected $casts = [
        'estimated_payment' => 'datetime',
        'billetdue_date' => 'datetime',
        'renewal_date' => 'datetime',
        'birthday' => 'date',
        'wedding' => 'date',
        'company_niver' => 'date',
        'periodic_contact' => 'datetime',
        'selected_menu' => 'integer',
        'active_days' => 'array',
    ];

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }
}
