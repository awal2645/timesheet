<?php

namespace App\View\Components\Task;

use Illuminate\View\Component;

class Modal extends Component
{
    public function __construct(
        public string $id = 'modal',
        public string $title = '',
        public string $maxWidth = '2xl'
    ) {}

    public function render()
    {
        return view('components.task.modal');
    }
} 