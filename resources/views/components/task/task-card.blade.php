<div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-md transition-all duration-200 {{ $isClickable ? 'cursor-pointer hover:border-blue-300 dark:hover:border-blue-600' : '' }}">
    <!-- Task Header -->
    <div class="p-4 border-b border-gray-100 dark:border-gray-700">
        <div class="flex items-start justify-between">
            <div class="flex-1 min-w-0 pr-3">
                @if($isClickable)
                    <a href="{{ route('task.show', $task->id) }}" class="block group">
                        <h3 class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 truncate">
                            {{ $task->task_name }}
                        </h3>
                    </a>
                @else
                    <h3 class="text-sm font-medium text-gray-900 dark:text-white truncate">
                        {{ $task->task_name }}
                    </h3>
                @endif
                
                @if($task->description)
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400 line-clamp-2">
                        {{ Str::limit($task->description, 100) }}
                    </p>
                @endif
            </div>
            
            <!-- Task Type Badge - Clickable -->
            <div class="flex-shrink-0 relative z-30" onclick="event.stopPropagation();">
                <div class="task-type-badge-{{ $task->id }}">
                    <x-task.task-type-badge :type="$task->task_type" class="cursor-pointer hover:opacity-80 transition-opacity" />
                </div>
                <select class="task-type-select-{{ $task->id }} hidden absolute top-0 right-0 text-xs rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white min-w-[80px] z-40 shadow-lg"
                        onchange="updateTaskField({{ $task->id }}, 'task_type', this.value, 'task-type')">
                    <option value="task" {{ $task->task_type == 'task' ? 'selected' : '' }}>Task</option>
                    <option value="story" {{ $task->task_type == 'story' ? 'selected' : '' }}>Story</option>
                    <option value="bug" {{ $task->task_type == 'bug' ? 'selected' : '' }}>Bug</option>
                    <option value="epic" {{ $task->task_type == 'epic' ? 'selected' : '' }}>Epic</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Task Details -->
    <div class="p-4">
        <!-- Task ID and Badges Row -->
        <div class="flex items-center justify-between mb-4">
            <!-- Priority and Status - Clickable -->
            <div class="flex items-center space-x-3" onclick="event.stopPropagation();">
                <!-- Priority Badge -->
                <div class="relative z-30">
                    <div class="priority-badge-{{ $task->id }}">
                        <x-task.task-priority-badge :priority="$task->priority" class="cursor-pointer hover:opacity-80 transition-opacity" />
                    </div>
                    <select class="priority-select-{{ $task->id }} hidden absolute top-0 left-0 text-xs rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white min-w-[80px] z-40 shadow-lg"
                            onchange="updateTaskField({{ $task->id }}, 'priority', this.value, 'priority')">
                        <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
                    </select>
                </div>

                <!-- Status Badge -->
                <div class="relative z-30">
                    <div class="status-badge-{{ $task->id }}">
                        <x-task.task-status-badge :status="$task->status" class="cursor-pointer hover:opacity-80 transition-opacity" />
                    </div>
                    <select class="status-select-{{ $task->id }} hidden absolute top-0 left-0 text-xs rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white min-w-[100px] z-40 shadow-lg"
                            onchange="updateTaskField({{ $task->id }}, 'status', this.value, 'status')">
                        <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="inprogress" {{ $task->status == 'inprogress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
            </div>
            
            <!-- Task ID -->
            <span class="text-xs text-gray-400 dark:text-gray-500 font-mono">
                #{{ $task->id }}
            </span>
        </div>

        <!-- Assignment Info -->
        <div class="space-y-2 text-xs text-gray-600 dark:text-gray-400 mb-4">
            <!-- Assignee - Clickable -->
            <div class="relative" onclick="event.stopPropagation();" style="z-index: 100;">
                <div class="assignee-badge-{{ $task->id }}">
                    @if($task->employee)
                        <div class="flex items-center cursor-pointer hover:opacity-80 transition-opacity">
                            <div class="w-5 h-5 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mr-2">
                                <i class="fa-solid fa-user text-green-600 dark:text-green-400 text-xs"></i>
                            </div>
                            <span class="truncate">{{ $task->employee->employee_name }}</span>
                        </div>
                    @else
                        <div class="flex items-center cursor-pointer hover:opacity-80 transition-opacity text-gray-400">
                            <div class="w-5 h-5 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mr-2">
                                <i class="fa-solid fa-user-plus text-gray-400 text-xs"></i>
                            </div>
                            <span class="truncate">Assign</span>
                        </div>
                    @endif
                </div>
                <select class="assignee-select-{{ $task->id }} hidden absolute top-full left-0 mt-1 text-xs rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white min-w-[200px] shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        style="z-index: 1000;">
                    <option value="">Unassigned</option>
                    @php
                        // Get employees based on user role
                        $employees = collect();
                        if(auth('web')->user()->role == 'employer') {
                            $employees = \App\Models\Employee::where('employer_id', auth('web')->user()->employer->id)->active()->get();
                        } elseif(auth('web')->user()->role == 'employee') {
                            $employees = \App\Models\Employee::where('employer_id', auth('web')->user()->employee->employer_id)->active()->get();
                        } elseif(auth('web')->user()->role == 'client') {
                            $employees = \App\Models\Employee::where('employer_id', auth('web')->user()->client->employer_id)->active()->get();
                        } else {
                            $employees = \App\Models\Employee::active()->get();
                        }
                    @endphp
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" {{ $task->employee_id == $employee->id ? 'selected' : '' }}>
                            {{ $employee->employee_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            @if($task->project)
                <div class="flex items-center">
                    <div class="w-5 h-5 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mr-2">
                        <i class="fa-solid fa-folder text-blue-600 dark:text-blue-400 text-xs"></i>
                    </div>
                    <span class="truncate">{{ $task->project->project_name }}</span>
                </div>
            @endif
            
            @if($task->due_date)
                <div class="flex items-center">
                    <div class="w-5 h-5 bg-orange-100 dark:bg-orange-900 rounded-full flex items-center justify-center mr-2">
                        <i class="fa-solid fa-calendar text-orange-600 dark:text-orange-400 text-xs"></i>
                    </div>
                    <span class="truncate {{ $task->due_date->isPast() && $task->status !== 'completed' ? 'text-red-500 font-medium' : '' }}">
                        {{ $task->due_date->format('M j, Y') }}
                    </span>
                </div>
            @endif
        </div>

        <!-- Labels -->
        @if($task->labels && count($task->labels) > 0)
            <div class="mb-4 flex flex-wrap gap-1">
                @foreach($task->labels as $label)
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                        {{ $label }}
                    </span>
                @endforeach
            </div>
        @endif

        <!-- Timer Section -->
        @if($showTimer)
            <div class="pt-3 border-t border-gray-100 dark:border-gray-700">
                <x-task.task-timer :task="$task" />
            </div>
        @endif
    </div>

    <!-- Task Footer -->
    <div class="px-4 py-3 bg-gray-50 dark:bg-gray-700/50 rounded-b-lg border-t border-gray-100 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <!-- Attachments and Comments Count -->
            <div class="flex items-center space-x-4 text-xs text-gray-500 dark:text-gray-400">
                @if($task->attachments_count ?? $task->attachments()->count())
                    <div class="flex items-center">
                        <i class="fa-solid fa-paperclip w-3"></i>
                        <span class="ml-1">{{ $task->attachments_count ?? $task->attachments()->count() }}</span>
                    </div>
                @endif
                
                @if($task->comments_count ?? $task->comments()->count())
                    <div class="flex items-center">
                        <i class="fa-solid fa-comment w-3"></i>
                        <span class="ml-1">{{ $task->comments_count ?? $task->comments()->count() }}</span>
                    </div>
                @endif
            </div>
            
            <!-- Actions -->
            <div class="flex items-center space-x-1">
                <a href="{{ route('task.edit', $task->id) }}" 
                   class="inline-flex items-center justify-center w-7 h-7 text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors rounded hover:bg-gray-100 dark:hover:bg-gray-600"
                   onclick="event.stopPropagation();">
                    <i class="fa-solid fa-edit text-xs"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
/* Custom styles for dropdowns */
.task-card-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    right: auto;
    z-index: 50;
    min-width: 120px;
    max-width: 200px;
    background: white;
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    font-size: 0.75rem;
    line-height: 1rem;
}

.dark .task-card-dropdown {
    background: #374151;
    border-color: #4b5563;
    color: white;
}

.task-card-dropdown option {
    padding: 0.25rem 0.5rem;
}

/* Ensure dropdowns appear above other elements */
.relative.z-30 {
    z-index: 30;
}

.absolute.z-40 {
    z-index: 40;
}
</style>

<script>
// Add click handlers for badges
document.addEventListener('DOMContentLoaded', function() {
    // Task Type Badge Click Handler
    const taskTypeBadge{{ $task->id }} = document.querySelector('.task-type-badge-{{ $task->id }}');
    const taskTypeSelect{{ $task->id }} = document.querySelector('.task-type-select-{{ $task->id }}');
    
    if (taskTypeBadge{{ $task->id }}) {
        taskTypeBadge{{ $task->id }}.addEventListener('click', function(e) {
            e.stopPropagation();
            e.preventDefault();
            
            // Hide all other dropdowns first
            hideAllDropdowns{{ $task->id }}();
            
            taskTypeBadge{{ $task->id }}.classList.add('hidden');
            taskTypeSelect{{ $task->id }}.classList.remove('hidden');
            taskTypeSelect{{ $task->id }}.focus();
        });
        
        taskTypeSelect{{ $task->id }}.addEventListener('blur', function() {
            setTimeout(() => {
                taskTypeBadge{{ $task->id }}.classList.remove('hidden');
                taskTypeSelect{{ $task->id }}.classList.add('hidden');
            }, 200);
        });
        
        taskTypeSelect{{ $task->id }}.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                taskTypeBadge{{ $task->id }}.classList.remove('hidden');
                taskTypeSelect{{ $task->id }}.classList.add('hidden');
            }
        });
    }

    // Priority Badge Click Handler
    const priorityBadge{{ $task->id }} = document.querySelector('.priority-badge-{{ $task->id }}');
    const prioritySelect{{ $task->id }} = document.querySelector('.priority-select-{{ $task->id }}');
    
    if (priorityBadge{{ $task->id }}) {
        priorityBadge{{ $task->id }}.addEventListener('click', function(e) {
            e.stopPropagation();
            e.preventDefault();
            
            // Hide all other dropdowns first
            hideAllDropdowns{{ $task->id }}();
            
            priorityBadge{{ $task->id }}.classList.add('hidden');
            prioritySelect{{ $task->id }}.classList.remove('hidden');
            prioritySelect{{ $task->id }}.focus();
        });
        
        prioritySelect{{ $task->id }}.addEventListener('blur', function() {
            setTimeout(() => {
                priorityBadge{{ $task->id }}.classList.remove('hidden');
                prioritySelect{{ $task->id }}.classList.add('hidden');
            }, 200);
        });
        
        prioritySelect{{ $task->id }}.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                priorityBadge{{ $task->id }}.classList.remove('hidden');
                prioritySelect{{ $task->id }}.classList.add('hidden');
            }
        });
    }

    // Status Badge Click Handler
    const statusBadge{{ $task->id }} = document.querySelector('.status-badge-{{ $task->id }}');
    const statusSelect{{ $task->id }} = document.querySelector('.status-select-{{ $task->id }}');
    
    if (statusBadge{{ $task->id }}) {
        statusBadge{{ $task->id }}.addEventListener('click', function(e) {
            e.stopPropagation();
            e.preventDefault();
            
            // Hide all other dropdowns first
            hideAllDropdowns{{ $task->id }}();
            
            statusBadge{{ $task->id }}.classList.add('hidden');
            statusSelect{{ $task->id }}.classList.remove('hidden');
            statusSelect{{ $task->id }}.style.zIndex = '9999';
            statusSelect{{ $task->id }}.focus();
        });
        
        statusSelect{{ $task->id }}.addEventListener('blur', function() {
            setTimeout(() => {
                statusBadge{{ $task->id }}.classList.remove('hidden');
                statusSelect{{ $task->id }}.classList.add('hidden');
            }, 200);
        });
        
        statusSelect{{ $task->id }}.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                statusBadge{{ $task->id }}.classList.remove('hidden');
                statusSelect{{ $task->id }}.classList.add('hidden');
            }
        });
    }

    // Assignee Badge Click Handler
    const assigneeBadge{{ $task->id }} = document.querySelector('.assignee-badge-{{ $task->id }}');
    const assigneeSelect{{ $task->id }} = document.querySelector('.assignee-select-{{ $task->id }}');
    
    if (assigneeBadge{{ $task->id }}) {
        assigneeBadge{{ $task->id }}.addEventListener('click', function(e) {
            e.stopPropagation();
            e.preventDefault();
            
            // Hide all other dropdowns first
            hideAllDropdowns{{ $task->id }}();
            
            // Hide the badge and show the select
            assigneeBadge{{ $task->id }}.classList.add('hidden');
            assigneeSelect{{ $task->id }}.classList.remove('hidden');
            assigneeSelect{{ $task->id }}.style.zIndex = '9999';
            
            // Destroy existing Select2 if it exists
            if ($(assigneeSelect{{ $task->id }}).hasClass('select2-hidden-accessible')) {
                $(assigneeSelect{{ $task->id }}).select2('destroy');
            }
            
            // Initialize Select2 fresh
            $(assigneeSelect{{ $task->id }}).select2({
                placeholder: 'Select assignee...',
                allowClear: true,
                width: '200px',
                dropdownParent: $(assigneeSelect{{ $task->id }}).parent(),
                templateResult: function(option) {
                    if (!option.id) return option.text;
                    
                    var $option = $(
                        '<span class="flex items-center">' +
                            '<div class="w-6 h-6 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mr-2">' +
                                '<i class="fa-solid fa-user text-green-600 dark:text-green-400 text-xs"></i>' +
                            '</div>' +
                            '<span class="text-sm">' + option.text + '</span>' +
                        '</span>'
                    );
                    return $option;
                },
                templateSelection: function(option) {
                    if (!option.id) return option.text;
                    return option.text;
                }
            });
            
            // Handle selection change
            $(assigneeSelect{{ $task->id }}).off('select2:select select2:unselect').on('select2:select select2:unselect', function(e) {
                const value = $(this).val();
                const selectedText = $(this).find('option:selected').text();
                
                // Immediately update both grid and list view badges before AJAX call
                if (value && selectedText && selectedText !== 'Unassigned') {
                    updateAssigneeBadgeContent({{ $task->id }}, 'assignee', value, selectedText);
                } else {
                    updateAssigneeBadgeContent({{ $task->id }}, 'assignee', '', '');
                }
                
                // Close the dropdown immediately
                $(assigneeSelect{{ $task->id }}).select2('close');
                
                // Then make the AJAX call
                updateTaskAssignee({{ $task->id }}, value, 'assignee-grid');
            });
            
            // Handle close event
            $(assigneeSelect{{ $task->id }}).off('select2:close').on('select2:close', function() {
                setTimeout(() => {
                    assigneeBadge{{ $task->id }}.classList.remove('hidden');
                    assigneeSelect{{ $task->id }}.classList.add('hidden');
                    // Destroy Select2 to prevent it from staying visible
                    if ($(assigneeSelect{{ $task->id }}).hasClass('select2-hidden-accessible')) {
                        $(assigneeSelect{{ $task->id }}).select2('destroy');
                    }
                }, 100);
            });
            
            // Open the dropdown immediately
            setTimeout(() => {
                $(assigneeSelect{{ $task->id }}).select2('open');
            }, 100);
        });
    }
    
    // Function to hide all dropdowns for this task
    function hideAllDropdowns{{ $task->id }}() {
        const allBadges = [
            { badge: taskTypeBadge{{ $task->id }}, select: taskTypeSelect{{ $task->id }} },
            { badge: priorityBadge{{ $task->id }}, select: prioritySelect{{ $task->id }} },
            { badge: statusBadge{{ $task->id }}, select: statusSelect{{ $task->id }} },
            { badge: assigneeBadge{{ $task->id }}, select: assigneeSelect{{ $task->id }} }
        ];
        
        allBadges.forEach(item => {
            if (item.badge && item.select) {
                item.badge.classList.remove('hidden');
                item.select.classList.add('hidden');
                
                // Close Select2 if it's open
                if ($(item.select).hasClass('select2-hidden-accessible')) {
                    $(item.select).select2('close');
                }
            }
        });
    }
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.relative.z-30')) {
            hideAllDropdowns{{ $task->id }}();
        }
    });
});

// Global function to update task fields
window.updateTaskField = function(taskId, field, value, type) {
    // Show loading state
    const badge = document.querySelector(`.${type}-badge-${taskId}`);
    const select = document.querySelector(`.${type}-select-${taskId}`);
    
    if (badge) {
        badge.style.opacity = '0.5';
    }

    // Make AJAX request to update the task
    fetch(`/tasks/${taskId}/update-field`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            field: field,
            value: value
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update the badge with new content
            updateBadgeContent(taskId, type, value);
            
            // Show success notification
            showNotification('Task updated successfully!', 'success');
        } else {
            showNotification('Failed to update task', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('An error occurred', 'error');
    })
    .finally(() => {
        // Hide select and show badge
        if (badge && select) {
            badge.style.opacity = '1';
            badge.classList.remove('hidden');
            select.classList.add('hidden');
        }
    });
};

// Function to update badge content
function updateBadgeContent(taskId, type, value) {
    const badge = document.querySelector(`.${type}-badge-${taskId}`);
    if (!badge) return;

    let badgeHtml = '';
    
    if (type === 'task-type') {
        const configs = {
            'task': { color: 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300', icon: 'fa-tasks', label: 'Task' },
            'story': { color: 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300', icon: 'fa-book', label: 'Story' },
            'bug': { color: 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300', icon: 'fa-bug', label: 'Bug' },
            'epic': { color: 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300', icon: 'fa-flag', label: 'Epic' }
        };
        const config = configs[value] || configs['task'];
        badgeHtml = `<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${config.color} cursor-pointer hover:opacity-80 transition-opacity">
            <i class="fa-solid ${config.icon} mr-1"></i>
            ${config.label}
        </span>`;
    } else if (type === 'priority') {
        const configs = {
            'high': { color: 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300', icon: 'fa-arrow-up', label: 'High' },
            'medium': { color: 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300', icon: 'fa-equals', label: 'Medium' },
            'low': { color: 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300', icon: 'fa-arrow-down', label: 'Low' }
        };
        const config = configs[value] || configs['medium'];
        badgeHtml = `<span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium ${config.color} cursor-pointer hover:opacity-80 transition-opacity">
            <i class="fa-solid ${config.icon} mr-1 text-xs"></i>
            ${config.label}
        </span>`;
    } else if (type === 'status') {
        const configs = {
            'pending': { color: 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300', icon: 'fa-pause-circle', label: 'Pending' },
            'inprogress': { color: 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300', icon: 'fa-clock', label: 'In Progress' },
            'completed': { color: 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300', icon: 'fa-check-circle', label: 'Completed' }
        };
        const config = configs[value] || configs['pending'];
        badgeHtml = `<span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium ${config.color} cursor-pointer hover:opacity-80 transition-opacity">
            <i class="fa-solid ${config.icon} mr-1 text-xs"></i>
            ${config.label}
        </span>`;
    }
    
    badge.innerHTML = badgeHtml;
}

// Function to show notifications
function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 px-4 py-2 rounded-lg text-white text-sm font-medium transition-all duration-300 transform translate-x-full opacity-0 ${
        type === 'success' ? 'bg-green-500' : 'bg-red-500'
    }`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
        notification.style.opacity = '1';
    }, 100);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        notification.style.opacity = '0';
        setTimeout(() => {
            if (document.body.contains(notification)) {
                document.body.removeChild(notification);
            }
        }, 300);
    }, 3000);
}
</script>