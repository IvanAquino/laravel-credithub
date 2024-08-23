<?php

namespace IvanAquino\LaravelCredithub\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class CreditTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'creditable_type',
        'creditable_id',
        'amount',
        'type',
        'payload',
    ];

    protected function casts(): array
    {
        return [
            'payload' => 'array',
            'amount' => 'integer',
            'type' => 'string',
        ];
    }

    public function creditable(): MorphTo
    {
        return $this->morphTo();
    }
}
