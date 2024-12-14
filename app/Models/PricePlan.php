<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricePlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'description',
        'price',
        'old_price',
        'discount_percentage',
        'employee_limit',
        'client_limit',
        'project_limit',
        'recommended',
        'frontend_show',
    ];
}
