<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadInteraction extends Model
{
    use HasFactory;

    protected $table = 'lead_interactions';

    protected $fillable = [
        'lead_id',
        'from_step',
        'to_step',
        'description',
        'negotiatedPrice',
        'return_date',
        'created_at'
    ];

    /**
     * Get the lead that owns the interaction.
     */
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}