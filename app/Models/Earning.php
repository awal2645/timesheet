<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stripe\Plan;

class Earning extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the plan that owns the Earning
     */
    public function plan()
    {
        return $this->belongsTo(PricePlan::class, 'price_plans_id');
    }

    /**
     * Get the company that owns the Earning
     */
    public function employer()
    {
        return $this->belongsTo(Employer::class, 'employer_id');
    }
}
