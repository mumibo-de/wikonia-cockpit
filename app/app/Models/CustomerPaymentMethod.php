<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerPaymentMethod extends Model
{
    protected $fillable = [
        'customer_id',
        'method',
        'data',
        'default',
        'last_used_at',
    ];

    protected $casts = [
        'data' => 'array',
        'default' => 'boolean',
        'last_used_at' => 'datetime',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}

