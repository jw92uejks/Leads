<?php

namespace App\Models;

use App\Enums\Participant\RelationshipType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'name',
        'birth_date',
        'relationship_type',
        'relationship_type_other',
        'cpf',
        'weight',
        'height',
        'additional_notes',
    ];

    protected function casts(): array
    {
        return [
            'relationship_type' => RelationshipType::class,
            'birth_date' => 'date',
            'weight' => 'float',
            'height' => 'float',
        ];
    }

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }
}
