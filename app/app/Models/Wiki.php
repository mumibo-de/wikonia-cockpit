<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Customer;
use App\Models\Package;
use App\Enums\WikiStatus;

class Wiki extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'name',
        'slug',
        'domain',
        'status',
        'storage_limit_mb',
        'package_id',
        'features',
        'flags',
    ];

    protected $casts = [
        'features' => 'array',
        'flags' => 'array',
        'status' => WikiStatus::class,
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}

