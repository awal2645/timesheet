@section('title')
    {{ __('Edit Task') }}
@endsection

<!-- Add Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<style>
    /* Enhanced form field styling */
    .form-field {
        @apply relative mb-6;
    }

    .form-field input, .form-field select {
        @apply w-full px-4 py-4 text-gray-900 dark:text-white bg-white dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 text-sm placeholder-transparent peer;
    }

    .form-field label {
        @apply absolute left-4 top-4 text-gray-500 dark:text-gray-400 text-sm transition-all duration-200 pointer-events-none transform origin-left;
    }

    .form-field input:focus + label,
    .form-field input:not(:placeholder-shown) + label,
    .form-field select:focus + label,
    .form-field select:not(:placeholder-shown) + label {
        @apply -translate-y-6 -translate-x-1 scale-75 text-blue-600 dark:text-blue-400 bg-white dark:bg-gray-800 px-2 rounded;
    }

    /* Floating label for time input */
    .form-field input[type="text"]:focus + label,
    .form-field input[type="text"]:not([value=""]) + label {
        @apply -translate-y-6 -translate-x-1 scale-75 text-blue-600 dark:text-blue-400 bg-white dark:bg-gray-800 px-2 rounded;
    }

    /* Enhanced button styling */
    .btn-primary {
        @apply px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-blue-500/50;
    }

    .btn-secondary {
        @apply px-6 py-3 bg-gradient-to-r from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 text-gray-700 dark:from-gray-600 dark:to-gray-700 dark:hover:from-gray-500 dark:hover:to-gray-600 dark:text-gray-200 rounded-xl font-medium text-sm transition-all duration-200 shadow-sm hover:shadow-md border border-gray-200 dark:border-gray-600;
    }

    /* Enhanced card styling */
    .edit-card {
        @apply bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-700 rounded-2xl shadow-2xl border border-gray-200 dark:border-gray-600 overflow-hidden;
    }

    .card-header {
        @apply relative bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-700 dark:to-gray-600 px-8 py-6 border-b border-gray-200 dark:border-gray-600 overflow-hidden;
    }

    .card-content {
        @apply p-8 bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm;
    }

    /* Page header styling with hero image */
    .page-header {
        @apply relative bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-800 dark:to-gray-700 rounded-2xl p-6 mb-8 border border-blue-100 dark:border-gray-600 overflow-hidden;
    }

    .page-title {
        @apply text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent dark:from-blue-400 dark:to-indigo-400;
    }

    /* Hero illustration styling */
    .hero-illustration {
        @apply absolute right-0 top-0 h-full w-auto opacity-10 dark:opacity-5 object-cover pointer-events-none;
    }

    .card-illustration {
        @apply absolute right-4 top-4 w-16 h-16 opacity-20 dark:opacity-10 object-contain pointer-events-none;
    }

    /* Animated background patterns */
    .bg-pattern {
        @apply absolute inset-0 opacity-5 dark:opacity-3;
        background-image: radial-gradient(circle at 25px 25px, rgba(59, 130, 246, 0.1) 2px, transparent 0),
                          radial-gradient(circle at 75px 75px, rgba(99, 102, 241, 0.1) 2px, transparent 0);
        background-size: 100px 100px;
        animation: float 20s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-10px) rotate(1deg); }
    }

    /* Select2 custom styling */
    .select2-container {
        width: 100% !important;
        z-index: 9999 !important;
    }

    .select2-container--default .select2-selection--single {
        height: 56px !important;
        border: 2px solid #e5e7eb !important;
        border-radius: 0.75rem !important;
        padding: 0 1rem !important;
        background-color: white !important;
        font-size: 0.875rem !important;
        line-height: 1.5 !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        padding-left: 0 !important;
        padding-right: 0 !important;
        height: 52px !important;
        line-height: 52px !important;
        color: #111827 !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 52px !important;
        right: 1rem !important;
    }

    .dark .select2-container--default .select2-selection--single {
        background-color: #374151 !important;
        border-color: #4b5563 !important;
        color: white !important;
    }

    .dark .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: white !important;
    }

    .select2-dropdown {
        border: 2px solid #e5e7eb !important;
        border-radius: 0.75rem !important;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25) !important;
    }

    .dark .select2-dropdown {
        background-color: #374151 !important;
        border-color: #4b5563 !important;
    }

    .select2-results__option {
        padding: 0.75rem 1rem !important;
        font-size: 0.875rem !important;
    }

    .dark .select2-results__option {
        background-color: #374151 !important;
        color: white !important;
    }

    .dark .select2-results__option--highlighted {
        background-color: #4b5563 !important;
    }

    /* Enhanced error styling */
    .error-alert {
        @apply relative bg-gradient-to-r from-red-50 to-red-100 border-l-4 border-red-400 p-6 rounded-xl mb-6 shadow-md overflow-hidden;
    }

    /* Enhanced grid layout */
    .form-grid {
        @apply grid grid-cols-1 lg:grid-cols-2 gap-8;
    }

    .form-grid-full {
        @apply lg:col-span-2;
    }

    /* Time input special styling */
    .time-input {
        @apply text-center text-lg font-mono tracking-wider;
    }

    /* Priority and status select special styling */
    .status-select, .priority-select {
        @apply bg-gradient-to-r from-white to-gray-50 dark:from-gray-700 dark:to-gray-600;
    }

    /* Enhanced success message area */
    .success-illustration {
        @apply w-20 h-20 mx-auto mb-4 opacity-60;
    }

    /* Responsive improvements */
    @media (max-width: 768px) {
        .form-grid {
            @apply grid-cols-1 gap-6;
        }
        
        .card-content {
            @apply p-6;
        }
        
        .page-header {
            @apply p-4;
        }

        .hero-illustration {
            @apply opacity-5;
        }
    }

    /* Loading state */
    .btn-loading {
        @apply opacity-75 cursor-not-allowed;
    }

    .btn-loading::after {
        content: '';
        @apply inline-block w-4 h-4 ml-2 border-2 border-white border-t-transparent rounded-full animate-spin;
    }

    /* Form section illustrations */
    .form-section {
        @apply relative;
    }

    .form-section::before {
        content: '';
        @apply absolute -top-2 -left-2 w-8 h-8 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full opacity-20 animate-pulse;
    }

    /* Interactive hover effects */
    .form-field:hover input,
    .form-field:hover select {
        @apply border-blue-300 dark:border-blue-500 shadow-md;
    }

    /* Task status indicators */
    .status-indicator {
        @apply absolute top-2 right-2 w-3 h-3 rounded-full;
    }

    .status-pending { @apply bg-yellow-400; }
    .status-inprogress { @apply bg-blue-400; }
    .status-completed { @apply bg-green-400; }

    /* Enhanced visual feedback */
    .field-icon {
        @apply absolute left-4 top-1/2 transform -translate-y-1/2 text-lg opacity-60 transition-all duration-200;
    }

    .form-field:focus-within .field-icon {
        @apply text-blue-500 opacity-100 scale-110;
    }

    /* Decorative elements */
    .decorative-dot {
        @apply absolute w-2 h-2 bg-blue-400 rounded-full opacity-30 animate-bounce;
    }

    .decorative-dot:nth-child(2) { animation-delay: 0.1s; }
    .decorative-dot:nth-child(3) { animation-delay: 0.2s; }
</style>

<x-app-layout>
    <!-- Breadcrumb Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 mt-6">
        <x-breadcrumb :items="[
            [
                'label' => __('Tasks'),
                'url' => route('task.index'),
                'icon' => true
            ],
            [
                'label' => __('Edit Task'),
                'icon' => true
            ]
        ]" />
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white dark:bg-slate-800 shadow-2xl rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-100 dark:from-slate-700 dark:to-slate-800 px-8 py-8 border-b border-gray-200 dark:border-gray-600 relative overflow-hidden">
                <!-- Background Pattern -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25px 25px, rgba(59, 130, 246, 0.2) 2px, transparent 0), radial-gradient(circle at 75px 75px, rgba(99, 102, 241, 0.2) 2px, transparent 0); background-size: 100px 100px;"></div>
                </div>
                
                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white flex items-center">
                            <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center mr-4 shadow-lg transform hover:scale-110 transition-transform duration-200">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </div>
                            {{ __('Edit Task') }}
                        </h2>
                        <p class="mt-3 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Update task details and settings. Changes will be reflected immediately after saving.') }}
                        </p>
                    </div>
                    
                    <!-- Task Info -->
                    <div class="hidden md:flex flex-col items-end space-y-3">
                        <div class="flex items-center space-x-3">
                            <!-- Task Status Badge -->
                            <div class="flex items-center space-x-2 px-4 py-2 bg-white/80 dark:bg-gray-700/80 rounded-xl backdrop-blur-sm shadow-sm">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-400',
                                        'inprogress' => 'bg-blue-400', 
                                        'completed' => 'bg-green-400'
                                    ];
                                @endphp
                                <div class="w-3 h-3 {{ $statusColors[$task->status] ?? 'bg-gray-400' }} rounded-full"></div>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ ucfirst($task->status) }}
                                </span>
                            </div>
                            
                            <!-- Task ID -->
                            <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400">
                                <span>{{ __('Task ID') }}</span>
                                <div class="bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 px-3 py-1 rounded-full font-semibold">
                                    #{{ $task->id }}
                                </div>
                            </div>
                        </div>
                        
                        <!-- Creation Date -->
                        <div class="text-xs text-gray-400 dark:text-gray-500">
                            {{ __('Created') }}: {{ $task->created_at->format('M d, Y') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <div class="p-8">
                <!-- Error Messages with Enhanced Design -->
        @if ($errors->any())
                    <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-6 mb-8">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-red-800 dark:text-red-300 mb-2">
                                    {{ __('Please fix the following errors') }}
                                </h3>
                                <ul class="text-sm text-red-700 dark:text-red-400 space-y-1">
                    @foreach ($errors->all() as $error)
                                        <li class="flex items-start">
                                            <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $error }}
                                        </li>
                    @endforeach
                </ul>
                            </div>
                        </div>
            </div>
        @endif

                <!-- Current Task Info -->
                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-6 mb-8">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-semibold text-blue-800 dark:text-blue-300 mb-2">
                                {{ __('Current Task Details') }}
                            </h3>
                            <div class="text-sm text-blue-700 dark:text-blue-400 space-y-1">
                                <p><strong>{{ __('Task Name') }}:</strong> {{ $task->task_name }}</p>
                                <p><strong>{{ __('Duration') }}:</strong> {{ $task->time }}</p>
                                <p><strong>{{ __('Priority') }}:</strong> {{ ucfirst($task->priority) }}</p>
                                <p><strong>{{ __('Status') }}:</strong> {{ ucfirst($task->status) }}</p>
                                <p><strong>{{ __('Due Date') }}:</strong> {{ $task->due_date }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('task.update', $task->id) }}" class="space-y-8" id="editTaskForm">
            @csrf
            @method('PUT')

                    <!-- Task Information Section -->
                    <div class="space-y-6">
                        <div class="border-b border-gray-200 dark:border-gray-600 pb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                {{ __('Task Configuration') }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ __('Update task details and assignment information') }}</p>
                        </div>

                        <!-- Form Fields Grid -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Select Employer --}}
            @if (auth()->user()->role != 'employee' && auth()->user()->role != 'client')
                                <div class="space-y-2">
                                    <label for="employer_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                            </svg>
                                            {{ __('Employer Organization') }}
                                            <span class="text-red-500 ml-1">*</span>
                                        </span>
                                    </label>
                                    <div class="relative group">
                                        <select name="employer_id" id="employer_id" required
                                                class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md">
                                            <option value="" disabled>{{ __('Select Employer') }}</option>
                        @foreach ($employers as $employer)
                                                <option value="{{ $employer->id }}" {{ $task->employer_id == $employer->id ? 'selected' : '' }}>
                                {{ $employer->employer_name }}
                            </option>
                        @endforeach
                    </select>
                                    </div>
                    @error('employer_id')
                                        <div class="flex items-center mt-2 p-3 text-red-700 bg-red-50 dark:bg-red-900/20 dark:text-red-400 rounded-lg border border-red-200 dark:border-red-800">
                                            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            <span class="text-sm font-medium">{{ $message }}</span>
                                        </div>
                    @enderror
                </div>
            @else
                <input type="hidden" name="employer_id"
                    value="{{ auth()->user()->employer->id ?? (auth()->user()->client->employer_id ?? auth()->user()->employee->employer_id) }}">
            @endif

            {{-- Select Employee --}}
            @if (auth()->user()->role != 'employee')
                                <div class="space-y-2">
                                    <label for="employee_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            {{ __('Task Assignee') }}
                                            <span class="text-red-500 ml-1">*</span>
                                        </span>
                                    </label>
                                    <div class="relative group">
                                        <select name="employee_id" id="employee_id" required
                                                class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md">
                                            <option value="" disabled>{{ __('Select Employee') }}</option>
                        @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}" {{ $task->employee_id == $employee->id ? 'selected' : '' }}>
                                {{ $employee->employee_name }}
                            </option>
                        @endforeach
                    </select>
                                    </div>
                    @error('employee_id')
                                        <div class="flex items-center mt-2 p-3 text-red-700 bg-red-50 dark:bg-red-900/20 dark:text-red-400 rounded-lg border border-red-200 dark:border-red-800">
                                            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            <span class="text-sm font-medium">{{ $message }}</span>
                                        </div>
                    @enderror
                </div>
            @endif

            {{-- Select Project --}}
                            <div class="space-y-2">
                                <label for="project_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                                        </svg>
                                        {{ __('Project Workspace') }}
                                        <span class="text-red-500 ml-1">*</span>
                                    </span>
                                </label>
                                <div class="relative group">
                                    <select name="project_id" id="project_id" required
                                            class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md">
                                        <option value="" disabled>{{ __('Select Project') }}</option>
                    @foreach ($projects as $project)
                                            <option value="{{ $project->id }}" {{ $task->project_id == $project->id ? 'selected' : '' }}>
                            {{ $project->project_name }}
                        </option>
                    @endforeach
                </select>
                                </div>
                @error('project_id')
                                    <div class="flex items-center mt-2 p-3 text-red-700 bg-red-50 dark:bg-red-900/20 dark:text-red-400 rounded-lg border border-red-200 dark:border-red-800">
                                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-sm font-medium">{{ $message }}</span>
                                    </div>
                @enderror
            </div>

            {{-- Task Name --}}
                            <div class="space-y-2">
                                <label for="task_name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                        </svg>
                                        {{ __('Task Title') }}
                                        <span class="text-red-500 ml-1">*</span>
                                    </span>
                                </label>
                                <div class="relative group">
                                    <input type="text" name="task_name" id="task_name" required
                                           value="{{ old('task_name', $task->task_name) }}"
                                           class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md"
                                           placeholder="Enter a descriptive task name..." />
                                </div>
                @error('task_name')
                                    <div class="flex items-center mt-2 p-3 text-red-700 bg-red-50 dark:bg-red-900/20 dark:text-red-400 rounded-lg border border-red-200 dark:border-red-800">
                                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-sm font-medium">{{ $message }}</span>
                                    </div>
                @enderror
            </div>

            {{-- Task Time --}}
                            <div class="space-y-2">
                                <label for="time" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ __('Estimated Duration') }}
                                        <span class="text-red-500 ml-1">*</span>
                                    </span>
                                </label>
                                <div class="relative group">
                <input type="text" name="time" id="time" value="{{ old('time', $task->time) }}"
                                           class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md text-center font-mono text-lg"
                                           placeholder="HH:MM" maxlength="5" required />
                                </div>
                @error('time')
                                    <div class="flex items-center mt-2 p-3 text-red-700 bg-red-50 dark:bg-red-900/20 dark:text-red-400 rounded-lg border border-red-200 dark:border-red-800">
                                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-sm font-medium">{{ $message }}</span>
                                    </div>
                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Task Settings Section -->
                    <div class="space-y-6">
                        <div class="border-b border-gray-200 dark:border-gray-600 pb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"/>
                                </svg>
                                {{ __('Task Settings') }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ __('Configure priority, timeline, and status') }}</p>
            </div>

                        <!-- Settings Grid -->
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Priority --}}
                            <div class="space-y-2">
                                <label for="priority" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                        </svg>
                                        {{ __('Priority Level') }}
                                        <span class="text-red-500 ml-1">*</span>
                                    </span>
                                </label>
                                <div class="relative group">
                                    <select name="priority" id="priority" required
                                            class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md">
                                        <option value="" disabled>{{ __('Select Priority') }}</option>
                                        <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>
                                            🟢 {{ __('Low Priority') }}
                    </option>
                                        <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>
                                            🟡 {{ __('Medium Priority') }}
                    </option>
                                        <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>
                                            🔴 {{ __('High Priority') }}
                    </option>
                </select>
                                </div>
                @error('priority')
                                    <div class="flex items-center mt-2 p-3 text-red-700 bg-red-50 dark:bg-red-900/20 dark:text-red-400 rounded-lg border border-red-200 dark:border-red-800">
                                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-sm font-medium">{{ $message }}</span>
                                    </div>
                @enderror
            </div>

            {{-- Due Date --}}
                            <div class="space-y-2">
                                <label for="due_date" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ __('Target Completion Date') }}
                                        <span class="text-red-500 ml-1">*</span>
                                    </span>
                                </label>
                                <div class="relative group">
                                    <input type="text" name="due_date" id="due_date" value="{{ old('due_date', $task->due_date) }}"
                                           class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md"
                                           placeholder="Select due date..." required />
                                </div>
                @error('due_date')
                                    <div class="flex items-center mt-2 p-3 text-red-700 bg-red-50 dark:bg-red-900/20 dark:text-red-400 rounded-lg border border-red-200 dark:border-red-800">
                                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-sm font-medium">{{ $message }}</span>
                                    </div>
                @enderror
            </div>

            {{-- Task Status --}}
                            <div class="space-y-2">
                                <label for="status" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                        </svg>
                                        {{ __('Current Status') }}
                                        <span class="text-red-500 ml-1">*</span>
                                    </span>
                                </label>
                                <div class="relative group">
                                    <select name="status" id="status" required
                                            class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md">
                                        <option value="" disabled>{{ __('Select Status') }}</option>
                                        <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>
                                            ⏸️ {{ __('Pending') }}
                    </option>
                                        <option value="inprogress" {{ old('status', $task->status) == 'inprogress' ? 'selected' : '' }}>
                                            ▶️ {{ __('In Progress') }}
                    </option>
                                        <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>
                                            ✅ {{ __('Completed') }}
                    </option>
                </select>
                                </div>
                @error('status')
                                    <div class="flex items-center mt-2 p-3 text-red-700 bg-red-50 dark:bg-red-900/20 dark:text-red-400 rounded-lg border border-red-200 dark:border-red-800">
                                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-sm font-medium">{{ $message }}</span>
                                    </div>
                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Change Tracking -->
                    <div id="changeTracker" class="hidden bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-semibold text-blue-800 dark:text-blue-300 mb-2">
                                    {{ __('Changes Detected') }}
                                </h3>
                                <div id="changesList" class="text-sm text-blue-700 dark:text-blue-400">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Help Section -->
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-6 mt-8">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-semibold text-blue-800 dark:text-blue-300 mb-2">
                                    {{ __('Task Update Guidelines') }}
                                </h3>
                                <div class="text-sm text-blue-700 dark:text-blue-400 space-y-2">
                                    <p class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ __('Changes will be reflected immediately after saving') }}
                                    </p>
                                    <p class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ __('Time tracking logs will remain unchanged') }}
                                    </p>
                                    <p class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ __('Team members will be notified of status changes') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-between pt-8 border-t border-gray-200 dark:border-gray-600 space-y-4 sm:space-y-0">
                        <a href="{{ route('task.index') }}" 
                           class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl text-sm font-semibold text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-200 hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            {{ __('Cancel') }}
                        </a>
                        
                        <button type="submit" id="submitBtn"
                                class="w-full sm:w-auto group inline-flex items-center justify-center px-10 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold rounded-xl transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-blue-500/50 backdrop-blur-sm disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                            <div class="flex items-center justify-center w-6 h-6 bg-white/20 rounded-lg mr-3">
                                <svg class="w-4 h-4 transition-transform duration-200 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span class="submit-text">{{ __('Update Task') }}</span>
                            <div class="loading-spinner hidden ml-3">
                                <svg class="animate-spin w-5 h-5 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </div>
                            <svg class="w-5 h-5 ml-3 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5-5 5M6 12h12"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
            </div>

        <!-- Success Illustration (Hidden by default) -->
        <div id="successIllustration" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 text-center max-w-md mx-4">
                <img src="{{ asset('images/success.png') }}" alt="Success" class="success-illustration">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Task Updated Successfully!</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-4">Your task has been updated with the latest information.</p>
                <button onclick="closeSuccessModal()" class="btn-primary">
                    <i class="fa-solid fa-check mr-2"></i>
                    Continue
                </button>
            </div>
        </div>
    </div>

    <!-- Enhanced JavaScript with Modern Features -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Enhanced Task Edit Form - DOM Content Loaded');
            
            // Get form elements
            const form = document.getElementById('editTaskForm');
            const submitBtn = document.getElementById('submitBtn');
            const submitText = submitBtn.querySelector('.submit-text');
            const loadingSpinner = submitBtn.querySelector('.loading-spinner');
            const changeTracker = document.getElementById('changeTracker');
            const changesList = document.getElementById('changesList');

            // Form inputs
            const taskNameInput = document.getElementById('task_name');
            const timeInput = document.getElementById('time');
            const prioritySelect = document.getElementById('priority');
            const dueDateInput = document.getElementById('due_date');
            const statusSelect = document.getElementById('status');
            const employerSelect = document.getElementById('employer_id');
            const employeeSelect = document.getElementById('employee_id');
            const projectSelect = document.getElementById('project_id');

            // Store original values for change tracking
            const originalValues = {
                task_name: '{{ $task->task_name }}',
                time: '{{ $task->time }}',
                priority: '{{ $task->priority }}',
                due_date: '{{ $task->due_date }}',
                status: '{{ $task->status }}',
                @if($task->employer_id)
                employer_id: '{{ $task->employer_id }}',
                @endif
                @if($task->employee_id)
                employee_id: '{{ $task->employee_id }}',
                @endif
                project_id: '{{ $task->project_id }}'
            };

            // Get CSRF token
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Auto-focus first field
            setTimeout(() => {
                if (taskNameInput) {
                    taskNameInput.focus();
                    taskNameInput.select();
                }
            }, 100);

            // Change tracking function
            function trackChanges() {
                const currentValues = {
                    task_name: taskNameInput?.value.trim() || '',
                    time: timeInput?.value.trim() || '',
                    priority: prioritySelect?.value || '',
                    due_date: dueDateInput?.value || '',
                    status: statusSelect?.value || '',
                    employer_id: employerSelect?.value || '',
                    employee_id: employeeSelect?.value || '',
                    project_id: projectSelect?.value || ''
                };
                
                let changes = [];
                
                if (currentValues.task_name !== originalValues.task_name) {
                    changes.push(`📝 {{ __('Task name changed') }}: "${originalValues.task_name}" → "${currentValues.task_name}"`);
                }
                
                if (currentValues.time !== originalValues.time) {
                    changes.push(`⏱️ {{ __('Duration changed') }}: "${originalValues.time}" → "${currentValues.time}"`);
                }
                
                if (currentValues.priority !== originalValues.priority) {
                    const priorities = { low: 'Low', medium: 'Medium', high: 'High' };
                    changes.push(`🚩 {{ __('Priority changed') }}: "${priorities[originalValues.priority]}" → "${priorities[currentValues.priority]}"`);
                }
                
                if (currentValues.due_date !== originalValues.due_date) {
                    changes.push(`📅 {{ __('Due date changed') }}: "${originalValues.due_date}" → "${currentValues.due_date}"`);
                }
                
                if (currentValues.status !== originalValues.status) {
                    const statuses = { pending: 'Pending', inprogress: 'In Progress', completed: 'Completed' };
                    changes.push(`📊 {{ __('Status changed') }}: "${statuses[originalValues.status]}" → "${statuses[currentValues.status]}"`);
                }
                
                if (changes.length > 0) {
                    changesList.innerHTML = changes.join('<br>');
                    changeTracker.classList.remove('hidden');
                } else {
                    changeTracker.classList.add('hidden');
                }
            }

            // Add change tracking listeners
            [taskNameInput, timeInput, prioritySelect, dueDateInput, statusSelect, employerSelect, employeeSelect, projectSelect]
                .filter(element => element)
                .forEach(element => {
                    element.addEventListener('input', trackChanges);
                    element.addEventListener('change', trackChanges);
                });

            // Enhanced Flatpickr initialization
            if (dueDateInput) {
                flatpickr(dueDateInput, {
                    dateFormat: "Y-m-d",
                    minDate: "today",
                    theme: "material_blue",
                    allowInput: true,
                    clickOpens: true,
                    onChange: function(selectedDates, dateStr, instance) {
                        console.log('Date selected:', dateStr);
                        showNotification('📅 Due date updated', 'success');
                        trackChanges();
                    }
                });
            }

            // Enhanced time input handling
            if (timeInput) {
                timeInput.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/[^0-9]/g, '');
                    
                    // Format as HH:MM
                    if (value.length >= 3) {
                        value = value.slice(0, 2) + ':' + value.slice(2, 4);
                    }
                    
                    // Validate hours (00-23)
                    if (value.length >= 2) {
                        const hours = parseInt(value.slice(0, 2));
                        if (hours > 23) {
                            value = '23' + (value.length > 2 ? value.slice(2) : '');
                        }
                    }
                    
                    // Validate minutes (00-59)
                    if (value.length >= 5) {
                        const minutes = parseInt(value.slice(3, 5));
                        if (minutes > 59) {
                            value = value.slice(0, 3) + '59';
                        }
                    }
                    
                    e.target.value = value;
                    trackChanges();
                });

                // Add blur validation
                timeInput.addEventListener('blur', function(e) {
                    const value = e.target.value;
                    if (value && !value.match(/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/)) {
                        showNotification('⏰ Please enter a valid time format (HH:MM)', 'error');
                        e.target.focus();
                    }
                });
            }

            // Employer change handler for dynamic loading
            if (employerSelect) {
                employerSelect.addEventListener('change', function(e) {
                    const employerId = e.target.value;
                    console.log('Employer selected:', employerId);

                    if (employerId && employeeSelect) {
                        // Show loading state
                        showLoadingState(employeeSelect, 'Loading employees...');
                        fetchEmployees(employerId);
                    }
                    
                    if (employerId && projectSelect) {
                        // Show loading state  
                        showLoadingState(projectSelect, 'Loading projects...');
                        fetchProjects(employerId);
                    }
                    
                    trackChanges();
                });
            }

            // Enhanced fetch functions
            function fetchEmployees(employerId) {
                        fetch(`/get/employee/${employerId}`, {
                            headers: {
                                'X-CSRF-TOKEN': token,
                                'Accept': 'application/json'
                            },
                            credentials: 'same-origin'
                        })
                            .then(response => {
                    if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                                return response.json();
                            })
                            .then(data => {
                    populateSelect(employeeSelect, data, 'employee_name', 'Select Employee');
                    showNotification('✨ Employees loaded successfully', 'success');
                    trackChanges();
                            })
                            .catch(error => {
                                console.error('Error fetching employees:', error);
                    showNotification('❌ Failed to load employees. Please try again.', 'error');
                    populateSelect(employeeSelect, [], '', 'Error loading employees');
                            });
            }

            function fetchProjects(employerId) {
                        fetch(`/get/project/${employerId}`, {
                            headers: {
                                'X-CSRF-TOKEN': token,
                                'Accept': 'application/json'
                            },
                            credentials: 'same-origin'
                        })
                            .then(response => {
                    if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                                return response.json();
                            })
                            .then(data => {
                    populateSelect(projectSelect, data, 'project_name', 'Select Project');
                    showNotification('🚀 Projects loaded successfully', 'success');
                    trackChanges();
                            })
                            .catch(error => {
                                console.error('Error fetching projects:', error);
                    showNotification('❌ Failed to load projects. Please try again.', 'error');
                    populateSelect(projectSelect, [], '', 'Error loading projects');
                });
            }

            function populateSelect(selectElement, data, textField, placeholder) {
                if (!selectElement) return;
                selectElement.innerHTML = `<option value="" disabled selected>${placeholder}</option>`;
                data.forEach(item => {
                    const option = new Option(item[textField], item.id, false, false);
                    selectElement.appendChild(option);
                });
            }

            function showLoadingState(selectElement, message) {
                if (!selectElement) return;
                selectElement.innerHTML = `<option value="" disabled selected>${message}</option>`;
            }

            // Form validation
            function validateForm() {
                let isValid = true;
                const requiredFields = [taskNameInput, timeInput, prioritySelect, dueDateInput, statusSelect, projectSelect];
                
                requiredFields.filter(field => field).forEach(field => {
                    if (!field.value.trim()) {
                        field.classList.add('border-red-500', 'bg-red-50', 'dark:bg-red-900/20');
                        isValid = false;
                    } else {
                        field.classList.remove('border-red-500', 'bg-red-50', 'dark:bg-red-900/20');
                    }
                });
                
                return isValid;
            }

            // Enhanced form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                if (!validateForm()) {
                    showNotification('{{ __('Please fill in all required fields') }}', 'error');
                    return;
                }
                
                // Show loading state
                submitBtn.disabled = true;
                submitText.textContent = '{{ __('Updating Task...') }}';
                loadingSpinner.classList.remove('hidden');
                
                // Submit form after brief delay
                setTimeout(() => {
                    form.submit();
                }, 1000);
            });

            // Notification system
            function showNotification(message, type = 'info') {
                const colors = {
                    success: 'bg-green-500',
                    info: 'bg-blue-500',
                    warning: 'bg-yellow-500',
                    error: 'bg-red-500'
                };

                const notification = document.createElement('div');
                notification.className = `fixed top-4 right-4 ${colors[type]} text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-all duration-300`;
                notification.textContent = message;
                document.body.appendChild(notification);

                // Slide in animation
                setTimeout(() => notification.classList.remove('translate-x-full'), 100);

                // Remove after 3 seconds
                setTimeout(() => {
                    notification.classList.add('translate-x-full');
                    setTimeout(() => notification.remove(), 300);
                }, 3000);
            }

            // Enhanced visual feedback
            const formInputs = form.querySelectorAll('input, textarea, select');
            formInputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('ring-2', 'ring-blue-500/20');
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('ring-2', 'ring-blue-500/20');
                });
            });

            // Keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                // Ctrl/Cmd + S to save
                if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                    e.preventDefault();
                    if (validateForm()) {
                        form.dispatchEvent(new Event('submit'));
                    }
                }
                
                // Escape to cancel
                if (e.key === 'Escape') {
                    window.location.href = '{{ route('task.index') }}';
                }
            });

            // Add smooth entrance animation
            const card = document.querySelector('.bg-white');
            if (card) {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 100);
            }

            // Initialize change tracking
            trackChanges();

            console.log('Enhanced Task Edit Form - Initialization complete');
        });
    </script>
</x-app-layout>
