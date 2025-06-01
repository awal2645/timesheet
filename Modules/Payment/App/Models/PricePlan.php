<?php

namespace Modules\Payment\App\Models;

use Illuminate\Database\Eloquent\Model;

class PricePlan extends Model
{
    protected $fillable = [
        'name',
        'price',
        'duration',
        'features'
    ];

    protected $casts = [
        'price' => 'float',
        'duration' => 'integer',
        'features' => 'array'
    ];
} 