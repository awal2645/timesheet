<?php

namespace App\View\Components\Task;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TaskTypeBadge extends Component
{
    public string $type;
    public string $class;
    public array $config;

    /**
     * Create a new component instance.
     */
    public function __construct(string $type = 'task', string $class = '')
    {
        $this->type = $type;
        $this->class = $class;
        $this->config = $this->getBadgeConfig();
    }

    /**
     * Get the badge configuration for task type.
     */
    private function getBadgeConfig(): array
    {
        return match($this->type) {
            'story' => [
                'color' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                'icon' => 'fa-book',
                'label' => 'Story'
            ],
            'bug' => [
                'color' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                'icon' => 'fa-bug',
                'label' => 'Bug'
            ],
            'epic' => [
                'color' => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300',
                'icon' => 'fa-flag',
                'label' => 'Epic'
            ],
            default => [
                'color' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                'icon' => 'fa-tasks',
                'label' => 'Task'
            ]
        };
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.task.task-type-badge');
    }
}
