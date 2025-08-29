<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormSection extends Component
{
    public string $title;
    public string $description;
    public string $class;

    /**
     * Create a new component instance.
     */
    public function __construct(string $title, string $description = '', string $class = '')
    {
        $this->title = $title;
        $this->description = $description;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.form-section');
    }
}
