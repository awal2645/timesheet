<?php

namespace App\View\Components\Task;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TaskPriorityBadge extends Component
{
    public string $priority;
    public string $class;
    public array $config;

    /**
     * Create a new component instance.
     */
    public function __construct(string $priority = 'medium', string $class = '')
    {
        $this->priority = $priority;
        $this->class = $class;
        $this->config = $this->getBadgeConfig();
    }

    /**
     * Get the badge configuration for priority.
     */
    private function getBadgeConfig(): array
    {
        return match($this->priority) {
            'high' => [
                'color' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                'icon' => 'fa-arrow-up',
                'label' => 'High'
            ],
            'medium' => [
                'color' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                'icon' => 'fa-equals',
                'label' => 'Medium'
            ],
            'low' => [
                'color' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                'icon' => 'fa-arrow-down',
                'label' => 'Low'
            ],
            default => [
                'color' => 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300',
                'icon' => 'fa-equals',
                'label' => 'Medium'
            ]
        };
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.task.task-priority-badge');
    }
}
