<?php

namespace App\View\Components\Task;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Task;

class TaskTimer extends Component
{
    public Task $task;
    public bool $showControls;

    /**
     * Create a new component instance.
     */
    public function __construct(Task $task, bool $showControls = true)
    {
        $this->task = $task;
        $this->showControls = $showControls;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.task.task-timer');
    }
}
