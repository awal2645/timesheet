<?php

namespace App\View\Components\Task;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TaskStatusBadge extends Component
{
    public string $status;
    public string $class;
    public array $config;

    /**
     * Create a new component instance.
     */
    public function __construct(string $status = 'pending', string $class = '')
    {
        $this->status = $status;
        $this->class = $class;
        $this->config = $this->getBadgeConfig();
    }

    /**
     * Get the badge configuration for status.
     */
    private function getBadgeConfig(): array
    {
        return match($this->status) {
            'completed' => [
                'color' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                'icon' => 'fa-check-circle',
                'label' => 'Completed'
            ],
            'inprogress' => [
                'color' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                'icon' => 'fa-clock',
                'label' => 'In Progress'
            ],
            'pending' => [
                'color' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                'icon' => 'fa-pause-circle',
                'label' => 'Pending'
            ],
            default => [
                'color' => 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300',
                'icon' => 'fa-circle',
                'label' => 'Unknown'
            ]
        };
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.task.task-status-badge');
    }
}
