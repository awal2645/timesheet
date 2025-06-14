<?php

namespace App\View\Components\Task;

use Illuminate\View\Component;

class Timer extends Component
{
    public function __construct(
        public int $taskId,
        public string $initialTime = '00:00'
    ) {}

    public function render()
    {
        return view('components.task.timer');
    }
} 