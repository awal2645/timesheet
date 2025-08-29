@section('title')
    {{ 'Tasks' }}
@endsection

<!-- Add Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .task-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 1.5rem;
    }
    
    .filter-chip {
        @apply inline-flex items-center px-5 py-3 rounded-2xl text-sm font-medium bg-white text-gray-700 border border-gray-200 hover:bg-gray-50 hover:border-gray-300 hover:shadow-lg dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:border-gray-500 transition-all duration-300 cursor-pointer shadow-md;
    }
    
    .filter-chip.active {
        @apply bg-gradient-to-r from-blue-500 to-blue-600 text-white border-blue-600 shadow-xl hover:from-blue-600 hover:to-blue-700 hover:shadow-2xl dark:from-blue-600 dark:to-blue-700 transform hover:scale-105;
    }

    /* Status badge colors in filter chips */
    .filter-chip:not(.active) i.text-yellow-500 {
        color: #f59e0b !important;
    }
    
    .filter-chip:not(.active) i.text-blue-500 {
        color: #3b82f6 !important;
    }
    
    .filter-chip:not(.active) i.text-green-500 {
        color: #10b981 !important;
    }

    /* When filter chip is active, icons should be white */
    .filter-chip.active i {
        color: white !important;
    }

    /* Active filter indicator */
    .filter-indicator {
        @apply absolute -top-1 -right-1 bg-blue-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold shadow-lg;
    }

    /* Search container enhancements */
    .search-container {
        @apply relative flex-1 max-w-md;
    }

    /* Section headers */
    .filter-section-header {
        @apply flex items-center mb-4;
    }

    /* Divider styling */
    .filter-divider {
        @apply border-t border-gray-200 dark:border-gray-600 my-6;
    }

    /* Enhanced search input */
    .search-input {
        @apply relative overflow-hidden bg-white dark:bg-gray-700 rounded-xl border border-gray-200 dark:border-gray-600 shadow-sm hover:shadow-md focus-within:shadow-lg focus-within:ring-2 focus-within:ring-blue-500 focus-within:border-blue-500 transition-all duration-200;
    }

    .search-input input {
        @apply w-full pl-12 pr-4 py-3.5 bg-transparent border-0 focus:ring-0 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 text-sm;
    }

    .search-icon {
        @apply absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 dark:text-gray-500 transition-colors duration-200;
    }

    .search-input:focus-within .search-icon {
        @apply text-blue-500;
    }

    /* Enhanced buttons */
    .btn-search {
        @apply px-6 py-3.5 bg-gradient-to-r from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 text-gray-700 dark:from-gray-600 dark:to-gray-700 dark:hover:from-gray-500 dark:hover:to-gray-600 dark:text-gray-200 rounded-xl font-medium text-sm transition-all duration-200 shadow-sm hover:shadow-md border border-gray-200 dark:border-gray-600;
    }

    /* Modern toggle styles */
    .toggle-active {
        @apply text-gray-900 dark:text-white font-semibold;
    }

    .toggle-inactive {
        @apply text-gray-500 dark:text-gray-400;
    }

    /* Smooth indicator animation */
    #toggle-indicator {
        transition: transform 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Enhanced button hover effects */
    .create-task-btn {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }

    .create-task-btn:hover {
        background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
        transform: translateY(-1px);
    }

    /* Filter chips container */
    .filter-chips-container {
        @apply flex flex-wrap gap-3 items-center;
    }

    /* Enhanced filters section */
    .filters-container {
        @apply bg-gradient-to-r from-white to-gray-50 dark:from-gray-800 dark:to-gray-700 rounded-2xl border border-gray-200 dark:border-gray-600 shadow-lg backdrop-blur-sm;
    }

    .filters-inner {
        @apply relative p-8 bg-white/90 dark:bg-gray-800/90 rounded-2xl backdrop-blur-sm;
    }

    /* Responsive improvements */
    @media (max-width: 640px) {
        .task-header-actions {
            flex-direction: column;
            align-items: stretch;
            gap: 1rem;
        }
        
        .toggle-container {
            align-self: center;
            width: fit-content;
        }

        .filter-chips-container {
            justify-content: center;
        }

        .search-container {
            max-width: none;
        }
    }

    /* Enhanced header styling */
    .page-header {
        @apply bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-800 dark:to-gray-700 rounded-2xl p-6 mb-8 border border-blue-100 dark:border-gray-600;
    }

    .page-title {
        @apply text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent dark:from-blue-400 dark:to-indigo-400;
    }

    /* Global dropdown styles for task cards */
    [class*="task-type-select-"], 
    [class*="priority-select-"], 
    [class*="status-select-"],
    [class*="assignee-select-"] {
        position: absolute !important;
        z-index: 9999 !important;
        background: white !important;
        border: 1px solid #d1d5db !important;
        border-radius: 0.375rem !important;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
        min-width: 80px !important;
        padding: 0.25rem !important;
        font-size: 0.75rem !important;
        line-height: 1rem !important;
    }

    .dark [class*="task-type-select-"], 
    .dark [class*="priority-select-"], 
    .dark [class*="status-select-"],
    .dark [class*="assignee-select-"] {
        background: #374151 !important;
        border-color: #4b5563 !important;
        color: white !important;
    }

    /* Ensure parent containers have proper stacking context */
    .task-grid > div {
        position: relative;
        z-index: 1;
    }

    .task-grid > div:hover {
        z-index: 10;
    }

    /* Override any conflicting z-index */
    .task-grid > div select {
        z-index: 9999 !important;
    }

    /* Custom Select2 styling */
    .select2-container {
        width: 100% !important;
        z-index: 9999 !important;
    }

    .select2-container--default .select2-selection--single {
        height: auto !important;
        min-height: 2rem !important;
        border: 1px solid #d1d5db !important;
        border-radius: 0.375rem !important;
        padding: 0.25rem 0.5rem !important;
        font-size: 0.75rem !important;
    }

    .select2-dropdown {
        z-index: 9999 !important;
        border: 1px solid #d1d5db !important;
        border-radius: 0.375rem !important;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
        display: none !important; /* Hide by default */
    }

    .select2-dropdown.select2-dropdown--below {
        display: block !important; /* Show when opened */
    }

    .select2-dropdown.select2-dropdown--above {
        display: block !important; /* Show when opened */
    }

    .select2-results__option {
        font-size: 0.75rem !important;
        padding: 0.5rem !important;
    }

    /* Dark mode Select2 */
    .dark .select2-container--default .select2-selection--single {
        background-color: #374151 !important;
        border-color: #4b5563 !important;
        color: white !important;
    }

    .dark .select2-dropdown {
        background-color: #374151 !important;
        border-color: #4b5563 !important;
    }

    .dark .select2-results__option {
        background-color: #374151 !important;
        color: white !important;
    }

    .dark .select2-results__option--highlighted {
        background-color: #4b5563 !important;
    }

    /* Custom pagination styles */
    .pagination-wrapper nav {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .pagination-wrapper .flex {
        gap: 0.25rem;
    }

    .pagination-wrapper a,
    .pagination-wrapper span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 2.5rem;
        height: 2.5rem;
        padding: 0.5rem;
        text-sm;
        font-medium;
        border-radius: 0.5rem;
        transition: all 0.2s ease-in-out;
    }

    .pagination-wrapper a {
        color: #6b7280;
        background-color: white;
        border: 1px solid #d1d5db;
        text-decoration: none;
    }

    .pagination-wrapper a:hover {
        background-color: #f3f4f6;
        border-color: #9ca3af;
        color: #374151;
    }

    .pagination-wrapper span[aria-current="page"] {
        background-color: #3b82f6;
        color: white;
        border: 1px solid #3b82f6;
        font-weight: 600;
    }

    .pagination-wrapper span[aria-disabled="true"] {
        color: #9ca3af;
        background-color: #f9fafb;
        border: 1px solid #e5e7eb;
        cursor: not-allowed;
    }

    /* Dark mode pagination */
    .dark .pagination-wrapper a {
        background-color: #374151;
        border-color: #4b5563;
        color: #d1d5db;
    }

    .dark .pagination-wrapper a:hover {
        background-color: #4b5563;
        border-color: #6b7280;
        color: #f3f4f6;
    }

    .dark .pagination-wrapper span[aria-disabled="true"] {
        background-color: #1f2937;
        border-color: #374151;
        color: #6b7280;
    }
</style>

<x-app-layout>
    <div class="p-6 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <!-- Enhanced Header Section -->
        <div class="page-header">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="mb-4 lg:mb-0">
                    <h1 class="page-title">Tasks</h1>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400 flex items-center">
                        <i class="fa-solid fa-chart-line mr-2 text-blue-500"></i>
                        Manage and track your project tasks with advanced tools
                    </p>
                </div>
                
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                    <!-- Enhanced View Toggle -->
                    <div class="relative bg-gray-100 dark:bg-gray-700 p-1.5 rounded-2xl shadow-inner border border-gray-200 dark:border-gray-600">
                        <div class="flex relative">
                            <!-- Active indicator background -->
                            <div id="toggle-indicator" class="absolute top-1.5 left-1.5 w-[calc(50%-0.1875rem)] h-[calc(100%-0.75rem)] bg-white dark:bg-gray-600 rounded-xl shadow-lg transition-transform duration-200 ease-in-out"></div>
                            
                            <button onclick="switchView('grid')" id="grid-view-btn" 
                                    class="relative z-10 flex items-center justify-center px-5 py-3 text-sm font-medium transition-colors duration-200 rounded-xl min-w-[90px] text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                                <i class="fa-solid fa-grid-2 mr-2 text-sm"></i>
                                Grid
                            </button>
                            <button onclick="switchView('list')" id="list-view-btn" 
                                    class="relative z-10 flex items-center justify-center px-5 py-3 text-sm font-medium transition-colors duration-200 rounded-xl min-w-[90px] text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">
                                <i class="fa-solid fa-list mr-2 text-sm"></i>
                                List
                            </button>
                        </div>
                    </div>
                    
                    <!-- Enhanced Create Task Button -->
                    <a href="{{ route('task.create') }}" 
                       class="inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white text-sm font-semibold rounded-2xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 border border-blue-600">
                        <i class="fa-solid fa-plus mr-2 text-sm"></i>
                        Create Task
                        <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Enhanced Filters Section -->
        <div class="filters-container mb-8">
            <div class="filters-inner">
                <!-- Search Section -->
                <div class="mb-6">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mr-3 shadow-md">
                            <i class="fa-solid fa-search text-white text-sm"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Search Tasks</h3>
                    </div>
                    
                    <form action="{{ route('task.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                        <div class="search-input flex-1">
                            <i class="fa-solid fa-search search-icon"></i>
                            <input type="text" class="form-input dark:bg-gray-700 dark:text-white dark:border-gray-600"  name="search" 
                                   placeholder="Search by task name, description, project, or assignee..."
                                   value="{{ request('search') }}">
                        </div>
                        <button type="submit" class="btn-search  bg-blue-600 text-white  px-4 py-2  border border-blue-600  rounded-lg flex-shrink-0 dark:bg-gray-700 dark:text-white dark:border-gray-600">
                            <i class="fa-solid fa-search mr-2"></i>
                            Search
                        </button>
                    </form>
                </div>

                <!-- Divider -->
                <div class="border-t border-gray-200 dark:border-gray-600 my-6"></div>

                <!-- Quick Filters Section -->
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center mr-3 shadow-md">
                                <i class="fa-solid fa-filter text-white text-sm"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Quick Filters</h3>
                        </div>
                        @if(request('priority') || request('task_type') || request('client_id') || request('employer_id') || request('employee_id') || request('start_date') || request('end_date'))
                            <div class="flex items-center">
                                <span class="inline-flex items-center px-3 py-1.5 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-xs font-medium rounded-full mr-3">
                                    <i class="fa-solid fa-check-circle mr-1"></i>
                                    {{ (request('priority') ? 1 : 0) + (request('task_type') ? 1 : 0) + (request('client_id') ? 1 : 0) + (request('employer_id') ? 1 : 0) + (request('employee_id') ? 1 : 0) + (request('start_date') ? 1 : 0) + (request('end_date') ? 1 : 0) }} Active Filters
                                </span>
                                <a href="{{ route('task.index') }}" 
                                   class="text-sm text-gray-500 hover:text-red-600 dark:text-gray-400 dark:hover:text-red-400 transition-colors">
                                    <i class="fa-solid fa-times mr-1"></i>
                                    Clear All
                                </a>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Status Filters -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-3">Status</label>
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('task.index', array_merge(request()->all(), ['status' => ''])) }}" 
                               class="filter-chip {{ !request('status') ? 'active' : '' }}">
                                <i class="fa-solid fa-list-check mr-2"></i>
                                All Tasks
                                <span class="ml-2 text-xs bg-gray-200 dark:bg-gray-600 px-2 py-0.5 rounded-full">{{ $tasks->total() }}</span>
                            </a>
                            <a href="{{ route('task.index', array_merge(request()->all(), ['status' => 'pending'])) }}" 
                               class="filter-chip {{ request('status') == 'pending' ? 'active' : '' }}">
                                <i class="fa-solid fa-pause-circle mr-2 text-yellow-500"></i>
                                Pending
                            </a>
                            <a href="{{ route('task.index', array_merge(request()->all(), ['status' => 'inprogress'])) }}" 
                               class="filter-chip {{ request('status') == 'inprogress' ? 'active' : '' }}">
                                <i class="fa-solid fa-clock mr-2 text-blue-500"></i>
                                In Progress
                            </a>
                            <a href="{{ route('task.index', array_merge(request()->all(), ['status' => 'completed'])) }}" 
                               class="filter-chip {{ request('status') == 'completed' ? 'active' : '' }}">
                                <i class="fa-solid fa-check-circle mr-2 text-green-500"></i>
                                Completed
                            </a>
                        </div>
                    </div>

                    <!-- Advanced Filters -->
                    <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-700">
                        <span class="text-sm text-gray-600 dark:text-gray-400">
                            Need more specific filters?
                        </span>
                        <button onclick="openFilterModal()" 
                                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white text-sm font-medium rounded-lg shadow-md hover:shadow-lg transition-all duration-200 relative">
                            <i class="fa-solid fa-sliders mr-2"></i>
                            Advanced Filters
                            @if(request('priority') || request('task_type') || request('client_id') || request('employer_id') || request('employee_id') || request('start_date') || request('end_date'))
                                <span class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold shadow-lg">
                                    {{ (request('priority') ? 1 : 0) + (request('task_type') ? 1 : 0) + (request('client_id') ? 1 : 0) + (request('employer_id') ? 1 : 0) + (request('employee_id') ? 1 : 0) + (request('start_date') ? 1 : 0) + (request('end_date') ? 1 : 0) }}
                                </span>
                            @endif
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Task Content -->
        <div id="task-content">
            <!-- Grid View -->
            <div id="grid-view" class="task-grid">
                @forelse($tasks as $task)
                    <x-task.task-card :task="$task" />
                @empty
                    <div class="col-span-full">
                        <div class="text-center py-12">
                            <div class="mx-auto w-32 h-32 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                <i class="fa-solid fa-tasks text-4xl text-gray-400"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No tasks found</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-6">
                                Get started by creating your first task
                            </p>
                            <a href="{{ route('task.create') }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fa-solid fa-plus mr-2"></i>
                                Create Task
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- List View (Initially Hidden) -->
            <div id="list-view" class="hidden">
                <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b border-gray-200 dark:border-gray-600">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Task</th>
                                    <th scope="col" class="px-6 py-3">Type</th>
                                    <th scope="col" class="px-6 py-3">Priority</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3">Assignee</th>
                                    <th scope="col" class="px-6 py-3">Due Date</th>
                                    <th scope="col" class="px-6 py-3">Time</th>
                                    <th scope="col" class="px-6 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tasks as $task)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div>
                                                    <a href="{{ route('task.show', $task->id) }}" 
                                                       class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                        {{ $task->task_name }}
                                                    </a>
                                                    @if($task->description)
                                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                            {{ Str::limit($task->description, 60) }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="relative" onclick="event.stopPropagation();">
                                                <div class="task-type-badge-list-{{ $task->id }}">
                                                    <x-task.task-type-badge :type="$task->task_type" class="cursor-pointer hover:opacity-80 transition-opacity" />
                                                </div>
                                                <select class="task-type-select-list-{{ $task->id }} hidden absolute top-0 left-0 text-xs rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white z-10"
                                                        onchange="updateTaskFieldList({{ $task->id }}, 'task_type', this.value, 'task-type')">
                                                    <option value="task" {{ $task->task_type == 'task' ? 'selected' : '' }}>Task</option>
                                                    <option value="story" {{ $task->task_type == 'story' ? 'selected' : '' }}>Story</option>
                                                    <option value="bug" {{ $task->task_type == 'bug' ? 'selected' : '' }}>Bug</option>
                                                    <option value="epic" {{ $task->task_type == 'epic' ? 'selected' : '' }}>Epic</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="relative" onclick="event.stopPropagation();">
                                                <div class="priority-badge-list-{{ $task->id }}">
                                                    <x-task.task-priority-badge :priority="$task->priority" class="cursor-pointer hover:opacity-80 transition-opacity" />
                                                </div>
                                                <select class="priority-select-list-{{ $task->id }} hidden absolute top-0 left-0 text-xs rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white z-10"
                                                        onchange="updateTaskFieldList({{ $task->id }}, 'priority', this.value, 'priority')">
                                                    <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                                                    <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                                                    <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="relative" onclick="event.stopPropagation();">
                                                <div class="status-badge-list-{{ $task->id }}">
                                                    <x-task.task-status-badge :status="$task->status" class="cursor-pointer hover:opacity-80 transition-opacity" />
                                                </div>
                                                <select class="status-select-list-{{ $task->id }} hidden absolute top-0 left-0 text-xs rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white z-10"
                                                        onchange="updateTaskFieldList({{ $task->id }}, 'status', this.value, 'status')">
                                                    <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="inprogress" {{ $task->status == 'inprogress' ? 'selected' : '' }}>In Progress</option>
                                                    <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="relative" onclick="event.stopPropagation();">
                                                <div class="assignee-badge-list-{{ $task->id }}">
                                                    @if($task->employee)
                                                        <div class="flex items-center cursor-pointer hover:opacity-80 transition-opacity">
                                                            <div class="w-8 h-8 bg-gray-300 dark:bg-gray-600 rounded-full flex items-center justify-center mr-3">
                                                                <span class="text-xs font-medium text-gray-600 dark:text-gray-300">
                                                                    {{ substr($task->employee->employee_name, 0, 1) }}
                                                                </span>
                                                            </div>
                                                            <span class="text-sm text-gray-900 dark:text-white">
                                                                {{ $task->employee->employee_name }}
                                                            </span>
                                                        </div>
                                                    @else
                                                        <div class="flex items-center cursor-pointer hover:opacity-80 transition-opacity text-gray-400">
                                                            <div class="w-8 h-8 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mr-3">
                                                                <i class="fa-solid fa-user-plus text-gray-400 text-xs"></i>
                                                            </div>
                                                            <span class="text-sm">Assign</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <select class="assignee-select-list-{{ $task->id }} hidden absolute top-0 left-0 text-xs rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white z-10 min-w-[200px]">
                                                    <option value="">Unassigned</option>
                                                    @php
                                                        // Get employees that belong to the same employer as the task
                                                        $employees = \App\Models\Employee::where('employer_id', $task->employer_id)->active()->get();
                                                    @endphp
                                                    @foreach($employees as $employee)
                                                        <option value="{{ $employee->id }}" {{ $task->employee_id == $employee->id ? 'selected' : '' }}>
                                                            {{ $employee->employee_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($task->due_date)
                                                <span class="text-sm {{ $task->due_date->isPast() && $task->status !== 'completed' ? 'text-red-600 dark:text-red-400 font-medium' : 'text-gray-900 dark:text-white' }}">
                                                    {{ $task->due_date->format('M j, Y') }}
                                                </span>
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <x-task.task-timer :task="$task" :show-controls="false" />
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center space-x-2">
                                                <a href="{{ route('task.show', $task->id) }}" 
                                                   class="text-blue-600 dark:text-blue-500 hover:text-blue-800 dark:hover:text-blue-300">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                <a href="{{ route('task.edit', $task->id) }}" 
                                                   class="text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200">
                                                    <i class="fa-solid fa-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-12 text-center">
                                            <div class="text-gray-500 dark:text-gray-400">
                                                <i class="fa-solid fa-tasks text-4xl mb-4"></i>
                                                <p class="text-lg font-medium mb-2">No tasks found</p>
                                                <p class="text-sm">Get started by creating your first task</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            @if($tasks->hasPages())
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                    <!-- Results Info -->
                    <div class="text-sm text-gray-600 dark:text-gray-400">
                        Showing {{ $tasks->firstItem() }} to {{ $tasks->lastItem() }} of {{ $tasks->total() }} results
                    </div>
                    
                    <!-- Pagination Links -->
                    <div class="pagination-wrapper">
                        {{ $tasks->links() }}
                    </div>
                </div>
            @else
                <!-- Debug info when no pagination -->
                <div class="text-center text-sm text-gray-500 dark:text-gray-400 mt-4">
                    Total tasks: {{ $tasks->count() }} (Pagination shows when > {{ $tasks->perPage() }} tasks)
                </div>
            @endif
        </div>
    </div>

    <!-- Advanced Filter Modal -->
    <div id="filterModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto z-50">
        <div class="relative top-20 mx-auto p-4 border w-full max-w-md shadow-lg rounded-lg bg-white dark:bg-gray-800">
            <div class="flex items-center justify-between mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                    Advanced Filters
                </h3>
                <button onclick="closeFilterModal()" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                    <i class="fa-solid fa-times text-xl"></i>
                </button>
            </div>

            <form action="{{ route('task.index') }}" method="GET" class="space-y-4">
                <!-- Preserve search parameter -->
                <input type="hidden" name="search" value="{{ request('search') }}">

                <!-- Task Type Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Task Type</label>
                    <select name="task_type" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option value="">All Types</option>
                        <option value="task" {{ request('task_type') == 'task' ? 'selected' : '' }}>Task</option>
                        <option value="story" {{ request('task_type') == 'story' ? 'selected' : '' }}>User Story</option>
                        <option value="bug" {{ request('task_type') == 'bug' ? 'selected' : '' }}>Bug</option>
                        <option value="epic" {{ request('task_type') == 'epic' ? 'selected' : '' }}>Epic</option>
                    </select>
                </div>

                <!-- Priority Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Priority</label>
                    <select name="priority" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option value="">All Priorities</option>
                        <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                        <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                    </select>
                </div>

                <!-- Date Range Filters -->
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Start Date</label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}" 
                               class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">End Date</label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}" 
                               class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    </div>
                </div>

                <!-- Filter Buttons -->
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('task.index') }}" 
                       class="px-4 py-2 text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md transition-colors">
                        Reset
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors">
                        Apply Filters
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    function switchView(viewType) {
        const gridView = document.getElementById('grid-view');
        const listView = document.getElementById('list-view');
        const gridBtn = document.getElementById('grid-view-btn');
        const listBtn = document.getElementById('list-view-btn');
        const indicator = document.getElementById('toggle-indicator');

        if (viewType === 'grid') {
            // Show/hide views
            gridView.classList.remove('hidden');
            listView.classList.add('hidden');
            
            // Update button styles
            gridBtn.classList.remove('text-gray-500', 'dark:text-gray-400');
            gridBtn.classList.add('text-gray-900', 'dark:text-white', 'font-semibold');
            listBtn.classList.remove('text-gray-900', 'dark:text-white', 'font-semibold');
            listBtn.classList.add('text-gray-500', 'dark:text-gray-400');
            
            // Animate indicator to left (grid position)
            if (indicator) {
                indicator.style.transform = 'translateX(0)';
            }
        } else {
            // Show/hide views
            gridView.classList.add('hidden');
            listView.classList.remove('hidden');
            
            // Update button styles
            listBtn.classList.remove('text-gray-500', 'dark:text-gray-400');
            listBtn.classList.add('text-gray-900', 'dark:text-white', 'font-semibold');
            gridBtn.classList.remove('text-gray-900', 'dark:text-white', 'font-semibold');
            gridBtn.classList.add('text-gray-500', 'dark:text-gray-400');
            
            // Animate indicator to right (list position)
            if (indicator) {
                indicator.style.transform = 'translateX(100%)';
            }
        }

        // Save preference
        localStorage.setItem('taskViewPreference', viewType);
    }

    function openFilterModal() {
        document.getElementById('filterModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeFilterModal() {
        document.getElementById('filterModal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    // Load saved view preference
    document.addEventListener('DOMContentLoaded', function() {
        const savedView = localStorage.getItem('taskViewPreference') || 'grid';
        switchView(savedView);

        // Close modal when clicking outside
        document.getElementById('filterModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeFilterModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeFilterModal();
            }
        });

        // Add click handlers for list view badges
        addListViewBadgeHandlers();
    });

    // Function to add click handlers for list view badges
    function addListViewBadgeHandlers() {
        // Task Type badges in list view
        document.querySelectorAll('[class*="task-type-badge-list-"]').forEach(function(badge) {
            const taskId = badge.className.match(/task-type-badge-list-(\d+)/)[1];
            const select = document.querySelector(`.task-type-select-list-${taskId}`);
            
            if (badge && select) {
                badge.addEventListener('click', function(e) {
                    e.stopPropagation();
                    badge.classList.add('hidden');
                    select.classList.remove('hidden');
                    select.focus();
                });
                
                select.addEventListener('blur', function() {
                    setTimeout(() => {
                        badge.classList.remove('hidden');
                        select.classList.add('hidden');
                    }, 150);
                });
            }
        });

        // Priority badges in list view
        document.querySelectorAll('[class*="priority-badge-list-"]').forEach(function(badge) {
            const taskId = badge.className.match(/priority-badge-list-(\d+)/)[1];
            const select = document.querySelector(`.priority-select-list-${taskId}`);
            
            if (badge && select) {
                badge.addEventListener('click', function(e) {
                    e.stopPropagation();
                    badge.classList.add('hidden');
                    select.classList.remove('hidden');
                    select.focus();
                });
                
                select.addEventListener('blur', function() {
                    setTimeout(() => {
                        badge.classList.remove('hidden');
                        select.classList.add('hidden');
                    }, 150);
                });
            }
        });

        // Status badges in list view
        document.querySelectorAll('[class*="status-badge-list-"]').forEach(function(badge) {
            const taskId = badge.className.match(/status-badge-list-(\d+)/)[1];
            const select = document.querySelector(`.status-select-list-${taskId}`);
            
            if (badge && select) {
                badge.addEventListener('click', function(e) {
                    e.stopPropagation();
                    badge.classList.add('hidden');
                    select.classList.remove('hidden');
                    select.focus();
                });
                
                select.addEventListener('blur', function() {
                    setTimeout(() => {
                        badge.classList.remove('hidden');
                        select.classList.add('hidden');
                    }, 150);
                });
            }
        });

        // Assignee badges in list view
        document.querySelectorAll('[class*="assignee-badge-list-"]').forEach(function(badge) {
            const taskId = badge.className.match(/assignee-badge-list-(\d+)/)[1];
            const select = document.querySelector(`.assignee-select-list-${taskId}`);
            
            if (badge && select) {
                badge.addEventListener('click', function(e) {
                    e.stopPropagation();
                    badge.classList.add('hidden');
                    select.classList.remove('hidden');
                    
                    // Destroy existing Select2 if it exists
                    if ($(select).hasClass('select2-hidden-accessible')) {
                        $(select).select2('destroy');
                    }
                    
                    // Initialize Select2 fresh
                    $(select).select2({
                        placeholder: 'Select assignee...',
                        allowClear: true,
                        width: '200px',
                        dropdownParent: $(select).parent(),
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
                    $(select).off('select2:select select2:unselect').on('select2:select select2:unselect', function(e) {
                        const value = $(this).val();
                        const selectedText = $(this).find('option:selected').text();
                        
                        // Immediately update the badge content before AJAX call
                        if (value && selectedText && selectedText !== 'Unassigned') {
                            updateAssigneeBadgeContent(taskId, 'assignee-list', value, selectedText);
                        } else {
                            updateAssigneeBadgeContent(taskId, 'assignee-list', '', '');
                        }
                        
                        // Close the dropdown immediately
                        $(select).select2('close');
                        
                        // Then make the AJAX call
                        updateTaskAssignee(taskId, value, 'assignee-list');
                    });
                    
                    // Handle close event
                    $(select).off('select2:close').on('select2:close', function() {
                        setTimeout(() => {
                            badge.classList.remove('hidden');
                            select.classList.add('hidden');
                            // Destroy Select2 to prevent it from staying visible
                            if ($(select).hasClass('select2-hidden-accessible')) {
                                $(select).select2('destroy');
                            }
                        }, 100);
                    });
                    
                    // Open the dropdown immediately
                    setTimeout(() => {
                        $(select).select2('open');
                    }, 100);
                });
            }
        });
    }

    // Function to update task fields in list view
    window.updateTaskFieldList = function(taskId, field, value, type) {
        // Show loading state
        const badge = document.querySelector(`.${type}-badge-list-${taskId}`);
        const select = document.querySelector(`.${type}-select-list-${taskId}`);
        
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
                updateBadgeContentList(taskId, type, value);
                
                // Show success notification
                showNotificationList('Task updated successfully!', 'success');
            } else {
                showNotificationList('Failed to update task', 'error');
                // Reload on error to get correct state
                setTimeout(() => location.reload(), 1000);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotificationList('An error occurred', 'error');
            // Reload on error to get correct state
            setTimeout(() => location.reload(), 1000);
        })
        .finally(() => {
            // Restore opacity and hide select
            if (badge) {
                badge.style.opacity = '1';
                badge.classList.remove('hidden');
            }
            if (select) {
                select.classList.add('hidden');
            }
        });
    };

    // Function to update badge content in list view
    function updateBadgeContentList(taskId, type, value) {
        const badge = document.querySelector(`.${type}-badge-list-${taskId}`);
        if (!badge) {
            console.error('Badge not found:', `.${type}-badge-list-${taskId}`);
            return;
        }

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
        
        if (badgeHtml) {
            badge.innerHTML = badgeHtml;
            console.log(`${type} badge updated successfully for task ${taskId}`);
            
            // Re-add click handler for the updated badge
            setTimeout(() => {
                addListViewBadgeHandlers();
            }, 100);
        }
    }

    // Function to show notifications for list view
    function showNotificationList(message, type = 'success') {
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

    // Function to update assignee badge content
    function updateAssigneeBadgeContent(taskId, type, employeeId, employeeName) {
        console.log('updateAssigneeBadgeContent called:', { taskId, type, employeeId, employeeName });
        
        // Simple approach - update both views if they exist
        const gridBadge = document.querySelector(`.assignee-badge-${taskId}`);
        const listBadge = document.querySelector(`.assignee-badge-list-${taskId}`);
        
        console.log('Found badges:', { gridBadge: !!gridBadge, listBadge: !!listBadge });
        
        // Update grid view
        if (gridBadge) {
            updateSingleBadge(gridBadge, employeeId, employeeName, 'grid');
        }
        
        // Update list view
        if (listBadge) {
            updateSingleBadge(listBadge, employeeId, employeeName, 'list');
            // Re-add click handler for list view
            setTimeout(() => {
                addSingleListViewBadgeHandler(taskId, 'assignee');
            }, 100);
        }
    }

    // Simple function to update a single badge
    function updateSingleBadge(badge, employeeId, employeeName, viewType) {
        if (!badge) return;
        
        try {
            let badgeHtml = '';
            
            if (employeeId && employeeName) {
                if (viewType === 'grid') {
                    badgeHtml = `
                        <div class="flex items-center cursor-pointer hover:opacity-80 transition-opacity">
                            <div class="w-5 h-5 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mr-2">
                                <i class="fa-solid fa-user text-green-600 dark:text-green-400 text-xs"></i>
                            </div>
                            <span class="truncate text-xs">${employeeName}</span>
                        </div>
                    `;
                } else {
                    const firstLetter = employeeName.charAt(0).toUpperCase();
                    badgeHtml = `
                        <div class="flex items-center cursor-pointer hover:opacity-80 transition-opacity">
                            <div class="w-8 h-8 bg-gray-300 dark:bg-gray-600 rounded-full flex items-center justify-center mr-3">
                                <span class="text-xs font-medium text-gray-600 dark:text-gray-300">
                                    ${firstLetter}
                                </span>
                            </div>
                            <span class="text-sm text-gray-900 dark:text-white">
                                ${employeeName}
                            </span>
                        </div>
                    `;
                }
            } else {
                if (viewType === 'grid') {
                    badgeHtml = `
                        <div class="flex items-center cursor-pointer hover:opacity-80 transition-opacity text-gray-400">
                            <div class="w-5 h-5 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mr-2">
                                <i class="fa-solid fa-user-plus text-gray-400 text-xs"></i>
                            </div>
                            <span class="truncate text-xs">Assign</span>
                        </div>
                    `;
                } else {
                    badgeHtml = `
                        <div class="flex items-center cursor-pointer hover:opacity-80 transition-opacity text-gray-400">
                            <div class="w-8 h-8 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mr-3">
                                <i class="fa-solid fa-user-plus text-gray-400 text-xs"></i>
                            </div>
                            <span class="text-sm">Assign</span>
                        </div>
                    `;
                }
            }
            
            badge.innerHTML = badgeHtml;
            console.log(`${viewType} badge updated successfully`);
            
        } catch (error) {
            console.error(`Error updating ${viewType} badge:`, error);
            // Fallback - just reload the page if there's an error
            setTimeout(() => {
                location.reload();
            }, 1000);
        }
    }

    // Function to update grid view assignee badge
    function updateGridViewAssigneeBadge(taskId, employeeId, employeeName) {
        const badge = document.querySelector(`.assignee-badge-${taskId}`);
        updateSingleBadge(badge, employeeId, employeeName, 'grid');
    }

    // Function to update list view assignee badge
    function updateListViewAssigneeBadge(taskId, employeeId, employeeName) {
        const badge = document.querySelector(`.assignee-badge-list-${taskId}`);
        updateSingleBadge(badge, employeeId, employeeName, 'list');
        
        // Re-add click handler
        setTimeout(() => {
            addSingleListViewBadgeHandler(taskId, 'assignee');
        }, 100);
    }

    // Simplified function to add click handler for a single list view assignee badge
    function addSingleListViewBadgeHandler(taskId, badgeType) {
        const badge = document.querySelector(`.${badgeType}-badge-list-${taskId}`);
        const select = document.querySelector(`.${badgeType}-select-list-${taskId}`);
        
        if (!badge || !select) {
            console.log('Badge or select not found, skipping handler');
            return;
        }
        
        // Remove any existing click handlers by cloning
        const newBadge = badge.cloneNode(true);
        badge.parentNode.replaceChild(newBadge, badge);
        
        // Add fresh click handler
        newBadge.addEventListener('click', function(e) {
            e.stopPropagation();
            
            // Hide badge, show select
            newBadge.classList.add('hidden');
            select.classList.remove('hidden');
            
            // Clean up any existing Select2
            if ($(select).hasClass('select2-hidden-accessible')) {
                $(select).select2('destroy');
            }
            
            // Initialize Select2
            $(select).select2({
                placeholder: 'Select assignee...',
                allowClear: true,
                width: '200px',
                dropdownParent: $(select).parent(),
                templateResult: function(option) {
                    if (!option.id) return option.text;
                    return $('<span class="flex items-center"><div class="w-6 h-6 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mr-2"><i class="fa-solid fa-user text-green-600 dark:text-green-400 text-xs"></i></div><span class="text-sm">' + option.text + '</span></span>');
                }
            });
            
            // Handle selection
            $(select).on('select2:select select2:unselect', function(e) {
                const value = $(this).val();
                const selectedText = $(this).find('option:selected').text();
                
                // Update badge immediately
                if (value && selectedText && selectedText !== 'Unassigned') {
                    updateAssigneeBadgeContent(taskId, 'assignee-list', value, selectedText);
                } else {
                    updateAssigneeBadgeContent(taskId, 'assignee-list', '', '');
                }
                
                // Close dropdown
                $(select).select2('close');
                
                // Make AJAX call
                updateTaskAssignee(taskId, value, 'assignee-list');
            });
            
            // Handle close
            $(select).on('select2:close', function() {
                setTimeout(() => {
                    newBadge.classList.remove('hidden');
                    select.classList.add('hidden');
                    if ($(select).hasClass('select2-hidden-accessible')) {
                        $(select).select2('destroy');
                    }
                }, 100);
            });
            
            // Open dropdown
            setTimeout(() => {
                $(select).select2('open');
            }, 100);
        });
    }

    // Function to update assignee
    window.updateTaskAssignee = function(taskId, employeeId, type) {
        console.log('Updating assignee:', { taskId, employeeId, type });
        
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (!csrfToken) {
            console.error('CSRF token not found');
            showNotificationList('CSRF token not found', 'error');
            return;
        }

        // Make AJAX request to update the task
        fetch(`/tasks/${taskId}/update-field`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                field: 'employee_id',
                value: employeeId
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                showNotificationList('Assignee updated successfully!', 'success');
                
                // Re-render the assignee badge with updated data
                // Get the employee name from the select option
                let employeeName = '';
                if (employeeId) {
                    const selectElement = document.querySelector(`.assignee-select-list-${taskId}`);
                    if (selectElement) {
                        const selectedOption = selectElement.querySelector(`option[value="${employeeId}"]`);
                        if (selectedOption) {
                            employeeName = selectedOption.textContent.trim();
                        }
                    }
                }
                
                // Update both grid and list view badges
                updateAssigneeBadgeContent(taskId, type, employeeId, employeeName);
                
            } else {
                showNotificationList(data.message || 'Failed to update assignee', 'error');
                // On error, just reload to get correct state
                setTimeout(() => location.reload(), 1000);
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
            showNotificationList('Network error occurred', 'error');
            // On error, just reload to get correct state
            setTimeout(() => location.reload(), 1000);
        });
    };
</script>

<!-- Add Select2 JavaScript -->
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

<script>
    // Initialize Select2 when page loads
    $(document).ready(function() {
        // Select2 is now initialized individually when each assignee field is clicked
        // No global initialization needed
    });
</script>