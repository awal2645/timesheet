<?php

namespace Modules\Payment\View\Components;

use Illuminate\View\Component;

class EmployerPlanCard extends Component
{
    public $plan;

    public function __construct($plan)
    {
        $this->plan = $plan;
    }

    public function render()
    {
        return view('payment::components.employer-plan-card');
    }
} 