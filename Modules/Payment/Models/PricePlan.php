<?php

namespace Modules\Payment\Models;

use Illuminate\Database\Eloquent\Model;

class PricePlan extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'discount_price',
        'features',
        'is_popular',
        'duration',
        'status'
    ];

    protected $casts = [
        'features' => 'array',
        'is_popular' => 'boolean',
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'status' => 'boolean'
    ];
} 