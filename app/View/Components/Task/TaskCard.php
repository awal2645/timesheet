<?php

namespace App\View\Components\Task;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Task;

class TaskCard extends Component
{
    public Task $task;
    public bool $showTimer;
    public bool $isClickable;

    /**
     * Create a new component instance.
     */
    public function __construct(Task $task, bool $showTimer = true, bool $isClickable = true)
    {
        $this->task = $task;
        $this->showTimer = $showTimer;
        $this->isClickable = $isClickable;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.task.task-card');
    }
}
