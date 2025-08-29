@section('title')
    {{ 'Project Management' }}
@endsection

<x-app-layout>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Enhanced Header Section -->
            <div class="mb-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div class="mb-6 lg:mb-0">
                        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-3 tracking-tight">
                            {{ __('Project Management') }}
                        </h1>
                        <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl">
                            {{ __('Comprehensive dashboard to manage, track, and analyze all your projects and their progress') }}
                        </p>
                    </div>
                    
                    <!-- Quick Stats Cards -->
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-200 dark:border-gray-700 text-center">
                            <div class="text-2xl font-bold text-blue-600 dark:text-blue-400 mb-1">
                                {{ $projects->total() }}
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                {{ __('Total Projects') }}
                            </div>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-200 dark:border-gray-700 text-center">
                            <div class="text-2xl font-bold text-green-600 dark:text-green-400 mb-1">
                                {{ $projects->where('status', 1)->count() }}
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                {{ __('Active') }}
                            </div>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-200 dark:border-gray-700 text-center">
                            <div class="text-2xl font-bold text-red-600 dark:text-red-400 mb-1">
                                {{ $projects->where('status', 0)->count() }}
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                {{ __('Inactive') }}
                            </div>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-200 dark:border-gray-700 text-center">
                            <div class="text-2xl font-bold text-purple-600 dark:text-purple-400 mb-1">
                                {{ $projects->sum('total_paid_client') > 0 ? '$' . number_format($projects->sum('total_paid_client'), 0) : '$0' }}
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                {{ __('Total Revenue') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Search and Filters Section -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mb-8">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 sm:mb-0 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z"></path>
                            </svg>
                            {{ __('Search & Filters') }}
                        </h2>
                        <div class="flex items-center space-x-3">
                            @if(request()->hasAny(['search', 'status', 'payment_type']))
                                <button id="clearFilters" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition-all duration-200 border border-gray-300 dark:border-gray-600 backdrop-blur-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    {{ __('Clear All') }}
                                </button>
                            @endif
                            <button id="toggleFilters" class="inline-flex items-center px-6 py-2.5 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 font-medium rounded-full hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200 border border-gray-300 dark:border-gray-600 shadow-sm backdrop-blur-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                                </svg>
                                {{ __('Advanced Filters') }}
                            </button>
            @canany('Project create')
                <a href="{{ route('project.create') }}"
                                   class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold rounded-full transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-green-500/50 backdrop-blur-sm">
                                    <div class="flex items-center justify-center w-6 h-6 bg-white/20 rounded-lg mr-3">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </div>
                                    {{ __('Create Project') }}
                                    <svg class="w-4 h-4 ml-3 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                </a>
            @endcanany
        </div>
                    </div>
                </div>
                
                <form action="{{ route('project.index') }}" method="GET" class="p-6">
                    <!-- Main Search Row -->
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 mb-6">
                        <!-- Search Input -->
                        <div class="lg:col-span-6">
                            <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('Search') }}
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" 
                                       id="search" 
                                       name="search" 
                                       value="{{ request('search') }}"
                                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                       placeholder="{{ __('Search by project name or client...') }}" />
                            </div>
                        </div>
                        
                        <!-- Status Filter -->
                        <div class="lg:col-span-3">
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('Status') }}
                            </label>
                            <select name="status" id="status" class="block w-full py-3 px-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                <option value="">{{ __('All Status') }}</option>
                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>{{ __('Active') }}</option>
                                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                            </select>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="lg:col-span-3 flex items-end space-x-3">
                            <button type="submit" class="group flex-1 inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-full transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-blue-500/50 backdrop-blur-sm">
                                <div class="flex items-center justify-center w-6 h-6 bg-white/20 rounded-lg mr-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                {{ __('Search') }}
                                <svg class="w-4 h-4 ml-3 transition-transform duration-200 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5-5 5M6 12h12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Advanced Filters (Initially Hidden) -->
                    <div id="advancedFilters" class="hidden border-t border-gray-200 dark:border-gray-700 pt-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <!-- Payment Type -->
                            <div>
                                <label for="payment_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('Payment Type') }}
                                </label>
                                <select name="payment_type" id="payment_type" class="block w-full py-2.5 px-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                    <option value="">{{ __('All Payment Types') }}</option>
                                    <option value="fixed" {{ request('payment_type') == 'fixed' ? 'selected' : '' }}>{{ __('Fixed') }}</option>
                                    <option value="hourly" {{ request('payment_type') == 'hourly' ? 'selected' : '' }}>{{ __('Hourly') }}</option>
                                </select>
                            </div>
                            
                            <!-- Budget Range -->
                            <div>
                                <label for="min_budget" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('Min Budget') }}
                                </label>
                                <input type="number" 
                                       id="min_budget" 
                                       name="min_budget" 
                                       value="{{ request('min_budget') }}"
                                       placeholder="0"
                                       class="block w-full py-2.5 px-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" />
                            </div>
                            
                            <div>
                                <label for="max_budget" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('Max Budget') }}
                                </label>
                                <input type="number" 
                                       id="max_budget" 
                                       name="max_budget" 
                                       value="{{ request('max_budget') }}"
                                       placeholder="100000"
                                       class="block w-full py-2.5 px-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" />
                            </div>
                        </div>
                        
                        <!-- Quick Filter Buttons -->
                        <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex flex-wrap gap-2">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300 mr-4 flex items-center">{{ __('Quick Filters:') }}</span>
                                <button type="button" class="quick-filter px-3 py-1.5 text-xs bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200" data-filter="active">
                                    {{ __('Active Only') }}
                                </button>
                                <button type="button" class="quick-filter px-3 py-1.5 text-xs bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200" data-filter="inactive">
                                    {{ __('Inactive Only') }}
                                </button>
                                <button type="button" class="quick-filter px-3 py-1.5 text-xs bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200" data-filter="high-budget">
                                    {{ __('High Budget (10K+)') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                
                <!-- Active Filters Display -->
                <div id="activeFilters" class="hidden px-6 pb-4">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Active Filters:') }}</span>
                        <div id="filterTags" class="flex flex-wrap gap-2"></div>
                    </div>
                </div>
            </div>

            <!-- Projects Table Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <!-- Table Header -->
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white flex items-center">
                        <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        {{ __('Project List') }}
                        @if($projects->total() > 0)
                            <span class="ml-3 px-3 py-1 text-sm bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 rounded-full">
                                {{ $projects->total() }} {{ __('Total') }}
                            </span>
                        @endif
                    </h2>
                </div>

                <!-- Table Content -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 dark:bg-gray-900/50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    {{ __('Project Information') }}
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    {{ __('Client & Type') }}
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    {{ __('Financial Summary') }}
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    {{ __('Status') }}
                                            </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider sticky right-0 bg-gray-50 dark:bg-gray-900/50 z-10 shadow-[-4px_0_6px_-1px_rgba(0,0,0,0.1)] dark:shadow-[-4px_0_6px_-1px_rgba(0,0,0,0.3)]">
                                    {{ __('Actions') }}
                                            </th>
                                        </tr>
                                    </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($projects as $project)
                                                @php
                                                    $totalMinutes = 0;

                                                    // Loop through each task to sum the time in minutes
                                                    foreach ($project->tasks as $task) {
                                                        if (!empty($task->time) && strpos($task->time, ':') !== false) {
                                                            $timeParts = explode(':', $task->time);

                                                            // Convert hours and minutes to integers for calculation
                                                            $hours = isset($timeParts[0]) ? (int) $timeParts[0] : 0;
                                                            $minutes = isset($timeParts[1]) ? (int) $timeParts[1] : 0;

                                                            // Convert hours to minutes and add minutes
                                                            $taskMinutes = $hours * 60 + $minutes;
                                                            $totalMinutes += $taskMinutes;
                                                        }
                                                    }

                                                    // Convert total minutes to hours
                                                    $totalHours = $totalMinutes / 60;

                                                    // Ensure hr_budget is numeric before calculation
                                    $hrBudget = is_numeric($project->hr_budget) ? $project->hr_budget : 0;

                                                    // Calculate total cost based on hours
                                                    $totalCost = $totalHours * $hrBudget;
                                                @endphp
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-12 h-12 relative">
                                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center border-2 border-gray-200 dark:border-gray-600">
                                                    <span class="text-white font-semibold text-lg">
                                                        {{ substr($project->project_name, 0, 1) }}
                                                    </span>
                                                </div>
                                                <div class="absolute -bottom-1 -right-1 w-4 h-4 rounded-full {{ $project->status === 1 ? 'bg-green-500' : 'bg-red-500' }} border-2 border-white dark:border-gray-800"></div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-semibold text-gray-900 dark:text-white">
                                                    {{ $project->project_name }}
                                                </div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ number_format($totalHours, 2) }} {{ __('hours tracked') }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center mr-3">
                                                <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ $project->client->client_name ?? 'N/A' }}
                                                </div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ ucfirst($project->payment_type ?? 'N/A') }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-4">
                                            <div class="text-center">
                                                <div class="text-lg font-bold text-blue-600 dark:text-blue-400">
                                                    ${{ number_format($totalCost, 0) }}
                                                </div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ __('Total Cost') }}
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div class="text-lg font-bold text-green-600 dark:text-green-400">
                                                    ${{ number_format($project->total_paid_client, 0) }}
                                                </div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ __('Paid') }}
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div class="text-lg font-bold text-orange-600 dark:text-orange-400">
                                                    ${{ number_format($totalCost - $project->total_paid_client, 0) }}
                                                </div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ __('Balance') }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-3">
                                            <!-- Status Toggle Switch -->
                                                    @canany('Project view')
                                                <div class="relative">
                                                    <input type="checkbox" 
                                                           id="status-toggle-{{ $project->id }}"
                                                           class="sr-only"
                                                           {{ $project->status === 1 ? 'checked' : '' }}
                                                           onchange="toggleStatus({{ $project->id }}, this.checked)">
                                                    <label for="status-toggle-{{ $project->id }}" 
                                                           class="flex items-center cursor-pointer">
                                                        <div class="relative">
                                                            <!-- Toggle Background -->
                                                            <div class="toggle-bg w-12 h-6 rounded-full shadow-inner transition-colors duration-200 ease-in-out {{ $project->status === 1 ? 'bg-green-500' : 'bg-gray-300 dark:bg-gray-600' }}"></div>
                                                            <!-- Toggle Circle -->
                                                            <div class="toggle-dot absolute top-0.5 left-0.5 bg-white w-5 h-5 rounded-full shadow transition-transform duration-200 ease-in-out {{ $project->status === 1 ? 'transform translate-x-6' : '' }}"></div>
                                                                    </div>
                                                                </label>
                                                </div>
                                                
                                                <!-- Status Badge -->
                                                <span class="status-badge inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $project->status === 1 ? 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300' : 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300' }}">
                                                    <div class="status-dot w-2 h-2 rounded-full mr-1.5 {{ $project->status === 1 ? 'bg-green-500' : 'bg-red-500' }}"></div>
                                                    <span class="status-text">
                                                        {{ $project->status === 1 ? __('Active') : __('Inactive') }}
                                                    </span>
                                                </span>
                                                
                                                <!-- Hidden form for status update -->
                                                <form id="statusForm{{ $project->id }}"
                                                      action="{{ route('project.updateStatus', $project->id) }}"
                                                      method="post"
                                                      class="hidden">
                                                    @csrf
                                                    <input type="hidden" name="status" value="{{ $project->status }}">
                                                            </form>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $project->status === 1 ? 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300' : 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300' }}">
                                                    <div class="w-2 h-2 rounded-full mr-1.5 {{ $project->status === 1 ? 'bg-green-500' : 'bg-red-500' }}"></div>
                                                    {{ $project->status === 1 ? __('Active') : __('Inactive') }}
                                                </span>
                                            @endcanany
                                        </div>
                                                        </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium sticky right-0 bg-white dark:bg-gray-800 z-10 shadow-[-4px_0_6px_-1px_rgba(0,0,0,0.1)] dark:shadow-[-4px_0_6px_-1px_rgba(0,0,0,0.3)]">
                                                    @canany('Project create')
                                            <div class="flex items-center space-x-3">
                                                                <a href="{{ route('project.edit', $project->id) }}"
                                                   class="group relative inline-flex items-center justify-center p-2 text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-lg transition-all duration-200">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                    <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                                                        {{ __('Edit') }}
                                                    </span>
                                                </a>
                                                                <button onclick="showConfirmation({{ $project->id }})"
                                                        class="group relative inline-flex items-center justify-center p-2 text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-all duration-200">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                                                        {{ __('Delete') }}
                                                    </span>
                                                </button>
                                                            </div>
                                        @endcanany
                                                        </td>
                                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="w-24 h-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                                </svg>
                                            </div>
                                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">{{ __('No projects found') }}</h3>
                                            <p class="text-gray-500 dark:text-gray-400 mb-6 max-w-sm">{{ __('You haven\'t added any projects yet. Get started by creating your first project.') }}</p>
                                            @canany('Project create')
                                                <a href="{{ route('project.create') }}"
                                                   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                    </svg>
                                                    {{ __('Create First Project') }}
                                                </a>
                                            @endcanany
                                        </div>
                                                </td>
                                            </tr>
                            @endforelse
                                    </tbody>
                                </table>
                </div>

                <!-- Pagination -->
                @if ($projects->total() > $projects->count())
                    <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                {{ __('Showing') }} 
                                <span class="font-medium">{{ $projects->firstItem() }}</span>
                                {{ __('to') }}
                                <span class="font-medium">{{ $projects->lastItem() }}</span>
                                {{ __('of') }}
                                <span class="font-medium">{{ $projects->total() }}</span>
                                {{ __('results') }}
                            </div>
                            <div class="pagination-wrapper">
                                {{ $projects->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function showConfirmation(id) {
            Swal.fire({
                title: '{{ __("Are you sure?") }}',
                text: "{{ __('You want to delete this project. This action cannot be undone!') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: "{{ __('Yes, delete it!') }}",
                cancelButtonText: "{{ __('Cancel') }}",
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg mr-3 transition-colors duration-200',
                    cancelButton: 'px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('project.destroy', '') }}/" + id;
                }
            });
        }

        // Enhanced Filter Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const toggleFilters = document.getElementById('toggleFilters');
            const advancedFilters = document.getElementById('advancedFilters');
            const clearFilters = document.getElementById('clearFilters');
            const activeFilters = document.getElementById('activeFilters');
            const filterTags = document.getElementById('filterTags');
            const quickFilters = document.querySelectorAll('.quick-filter');

            // Toggle advanced filters
            if (toggleFilters) {
                toggleFilters.addEventListener('click', function() {
                    if (advancedFilters.classList.contains('hidden')) {
                        advancedFilters.classList.remove('hidden');
                        toggleFilters.innerHTML = `
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                            </svg>
                            {{ __('Hide Filters') }}
                        `;
                    } else {
                        advancedFilters.classList.add('hidden');
                        toggleFilters.innerHTML = `
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                            </svg>
                            {{ __('Advanced Filters') }}
                        `;
                    }
                });
            }

            // Clear all filters
            if (clearFilters) {
                clearFilters.addEventListener('click', function() {
                    // Redirect to page without any parameters
                    const url = new URL(window.location.href);
                    url.search = '';
                    window.location.href = url.href;
                });
            }

            // Quick filter functionality
            quickFilters.forEach(button => {
                button.addEventListener('click', function() {
                    const filter = this.dataset.filter;
                    const url = new URL(window.location.href);
                    const params = new URLSearchParams();
                    
                    switch(filter) {
                        case 'active':
                            params.set('status', '1');
                            break;
                        case 'inactive':
                            params.set('status', '0');
                            break;
                        case 'high-budget':
                            params.set('min_budget', '10000');
                            break;
                    }
                    
                    // Update URL and navigate
                    url.search = params.toString();
                    window.location.href = url.href;
                });
            });

            // Update active filters display
            function updateActiveFilters() {
                const filters = [];
                const search = document.getElementById('search') ? document.getElementById('search').value : '';
                const status = document.getElementById('status') ? document.getElementById('status').value : '';
                const paymentType = document.getElementById('payment_type') ? document.getElementById('payment_type').value : '';
                const minBudget = document.getElementById('min_budget') ? document.getElementById('min_budget').value : '';
                const maxBudget = document.getElementById('max_budget') ? document.getElementById('max_budget').value : '';

                if (search) filters.push({ label: `Search: ${search}`, field: 'search', value: search });
                if (status) filters.push({ label: `Status: ${status === '1' ? 'Active' : 'Inactive'}`, field: 'status', value: status });
                if (paymentType) filters.push({ label: `Payment: ${paymentType}`, field: 'payment_type', value: paymentType });
                if (minBudget) filters.push({ label: `Min Budget: $${minBudget}`, field: 'min_budget', value: minBudget });
                if (maxBudget) filters.push({ label: `Max Budget: $${maxBudget}`, field: 'max_budget', value: maxBudget });

                if (filters.length > 0) {
                    activeFilters.classList.remove('hidden');
                    filterTags.innerHTML = filters.map(filter => `
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300">
                            ${filter.label}
                            <button type="button" class="ml-2 inline-flex items-center justify-center w-4 h-4 text-blue-400 hover:text-blue-600 dark:text-blue-300 dark:hover:text-blue-200" onclick="removeFilter('${filter.field}')">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </span>
                    `).join('');
                } else {
                    activeFilters.classList.add('hidden');
                }
            }

            // Initialize active filters on page load
            updateActiveFilters();

            // Update active filters when form inputs change
            document.querySelectorAll('input, select').forEach(input => {
                input.addEventListener('change', updateActiveFilters);
                input.addEventListener('input', updateActiveFilters);
            });
        });

        // Remove individual filter
        function removeFilter(fieldName) {
            // Get current URL and its parameters
            const url = new URL(window.location.href);
            const params = new URLSearchParams(url.search);
            
            // Remove the specific parameter
            params.delete(fieldName);
            
            // Update the URL without the removed parameter
            url.search = params.toString();
            
            // Redirect to the new URL
            window.location.href = url.href;
        }

        // Toggle status function
        function toggleStatus(projectId, isChecked) {
            console.log('toggleStatus called:', projectId, isChecked);
            
            const statusValue = isChecked ? 1 : 0;
            const form = document.getElementById(`statusForm${projectId}`);
            const checkbox = document.getElementById(`status-toggle-${projectId}`);
            const row = checkbox.closest('tr');
            
            // Verify all elements exist
            if (!form || !checkbox || !row) {
                console.error('Required elements not found:', { form, checkbox, row });
                showToast('{{ __("Error: Form elements not found") }}', 'error');
                return;
            }
            
            // Find elements within this row
            const toggleBg = row.querySelector('.toggle-bg');
            const toggleDot = row.querySelector('.toggle-dot');
            const statusBadge = row.querySelector('.status-badge');
            const statusDot = row.querySelector('.status-dot');
            const statusText = row.querySelector('.status-text');
            
            // Verify toggle elements exist
            if (!toggleBg || !toggleDot || !statusBadge || !statusDot || !statusText) {
                console.error('Toggle elements not found:', { toggleBg, toggleDot, statusBadge, statusDot, statusText });
                showToast('{{ __("Error: Toggle elements not found") }}', 'error');
                return;
            }
            
            // Disable checkbox during update
            checkbox.disabled = true;
            
            // Show loading state
            const originalText = statusText.textContent;
            statusText.textContent = '{{ __("Updating...") }}';
            
            // Update visual state immediately for better UX
            if (isChecked) {
                // Active state
                toggleBg.className = 'toggle-bg w-12 h-6 rounded-full shadow-inner transition-colors duration-200 ease-in-out bg-green-500';
                toggleDot.className = 'toggle-dot absolute top-0.5 left-0.5 bg-white w-5 h-5 rounded-full shadow transition-transform duration-200 ease-in-out transform translate-x-6';
                statusBadge.className = 'status-badge inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300';
                statusDot.className = 'status-dot w-2 h-2 rounded-full mr-1.5 bg-green-500';
            } else {
                // Inactive state
                toggleBg.className = 'toggle-bg w-12 h-6 rounded-full shadow-inner transition-colors duration-200 ease-in-out bg-gray-300 dark:bg-gray-600';
                toggleDot.className = 'toggle-dot absolute top-0.5 left-0.5 bg-white w-5 h-5 rounded-full shadow transition-transform duration-200 ease-in-out';
                statusBadge.className = 'status-badge inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300';
                statusDot.className = 'status-dot w-2 h-2 rounded-full mr-1.5 bg-red-500';
            }
            
            // Update the hidden form input
            const hiddenInput = form.querySelector('input[name="status"]');
            if (!hiddenInput) {
                console.error('Hidden input not found');
                showToast('{{ __("Error: Hidden input not found") }}', 'error');
                checkbox.disabled = false;
                return;
            }
            hiddenInput.value = statusValue;
            
            // Submit form via AJAX
            const formData = new FormData(form);
            
            console.log('Submitting to:', form.action);
            console.log('Form data:', Object.fromEntries(formData));
            
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || formData.get('_token')
                }
            })
            .then(response => {
                console.log('Response status:', response.status);
                if (response.ok) {
                    // Success - update text
                    statusText.textContent = isChecked ? '{{ __("Active") }}' : '{{ __("Inactive") }}';
                    showToast('{{ __("Status updated successfully") }}', 'success');
                } else {
                    throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                }
            })
            .catch(error => {
                console.error('Error updating status:', error);
                
                // Revert checkbox state
                checkbox.checked = !isChecked;
                
                // Revert visual state
                if (!isChecked) {
                    // Revert to active
                    toggleBg.className = 'toggle-bg w-12 h-6 rounded-full shadow-inner transition-colors duration-200 ease-in-out bg-green-500';
                    toggleDot.className = 'toggle-dot absolute top-0.5 left-0.5 bg-white w-5 h-5 rounded-full shadow transition-transform duration-200 ease-in-out transform translate-x-6';
                    statusBadge.className = 'status-badge inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300';
                    statusDot.className = 'status-dot w-2 h-2 rounded-full mr-1.5 bg-green-500';
                } else {
                    // Revert to inactive
                    toggleBg.className = 'toggle-bg w-12 h-6 rounded-full shadow-inner transition-colors duration-200 ease-in-out bg-gray-300 dark:bg-gray-600';
                    toggleDot.className = 'toggle-dot absolute top-0.5 left-0.5 bg-white w-5 h-5 rounded-full shadow transition-transform duration-200 ease-in-out';
                    statusBadge.className = 'status-badge inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300';
                    statusDot.className = 'status-dot w-2 h-2 rounded-full mr-1.5 bg-red-500';
                }
                
                // Revert hidden input
                hiddenInput.value = !isChecked ? 1 : 0;
                
                // Revert text
                statusText.textContent = originalText;
                
                showToast('{{ __("Failed to update status. Please try again.") }}', 'error');
            })
            .finally(() => {
                checkbox.disabled = false;
            });
        }
        
        // Simple toast notification function
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `fixed top-4 right-4 px-6 py-3 rounded-lg text-white font-medium z-50 transform transition-all duration-300 ${
                type === 'success' ? 'bg-green-500' : 'bg-red-500'
            }`;
            toast.textContent = message;
            
            document.body.appendChild(toast);
            
            // Animate in
            setTimeout(() => {
                toast.style.transform = 'translateY(0)';
                toast.style.opacity = '1';
            }, 10);
            
            // Remove after 3 seconds
            setTimeout(() => {
                toast.style.transform = 'translateY(-100%)';
                toast.style.opacity = '0';
                setTimeout(() => document.body.removeChild(toast), 300);
            }, 3000);
        }
    </script>
    
    <style>
        .dropdown:hover .dropdown-menu {
            display: block;
        }
        
        /* Toggle Switch Custom Styles */
        .toggle-bg {
            transition: background-color 0.2s ease-in-out;
        }
        
        .toggle-dot {
            transition: transform 0.2s ease-in-out;
        }
        
        /* Dark mode toggle adjustments */
        @media (prefers-color-scheme: dark) {
            .toggle-bg:not(.bg-green-500) {
                background-color: #4B5563;
            }
        }
        
        /* Ensure toggle is not affected by disabled state styling */
        input[type="checkbox"]:disabled + label .toggle-bg,
        input[type="checkbox"]:disabled + label .toggle-dot {
            opacity: 0.8;
            cursor: not-allowed;
        }
    </style>
</x-app-layout>