@section('title', 'Weekly Holidays')

<x-app-layout>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Enhanced Header Section -->
            <div class="mb-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div class="mb-6 lg:mb-0">
                        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-3 tracking-tight">
                            {{ __('Weekly Holidays Management') }}
                        </h1>
                        <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl">
                            {{ __('Configure and manage weekly holiday schedules to define non-working days for your organization') }}
                        </p>
                    </div>
                    
                    <!-- Quick Stats Cards -->
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-200 dark:border-gray-700 text-center">
                            <div class="text-2xl font-bold text-blue-600 dark:text-blue-400 mb-1">
                                {{ $holidays->total() }}
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                {{ __('Total Holidays') }}
                            </div>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-200 dark:border-gray-700 text-center">
                            <div class="text-2xl font-bold text-green-600 dark:text-green-400 mb-1">
                                {{ $holidays->sum(function($holiday) { 
                                    $days = json_decode($holiday->days_of_week);
                                    return is_array($days) ? count($days) : 1;
                                }) }}
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                {{ __('Holiday Days') }}
                            </div>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-200 dark:border-gray-700 text-center">
                            <div class="text-2xl font-bold text-purple-600 dark:text-purple-400 mb-1">
                                {{ $holidays->filter(function($holiday) {
                                    $days = json_decode($holiday->days_of_week);
                                    return is_array($days) && count($days) > 1;
                                })->count() }}
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                {{ __('Multi-Day') }}
                            </div>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-200 dark:border-gray-700 text-center">
                            <div class="text-2xl font-bold text-orange-600 dark:text-orange-400 mb-1">
                                {{ $holidays->filter(function($holiday) {
                                    $days = json_decode($holiday->days_of_week);
                                    return is_array($days) ? in_array('saturday', $days) || in_array('sunday', $days) : in_array($days, ['saturday', 'sunday']);
                                })->count() }}
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                {{ __('Weekend Days') }}
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
                            @if(request()->hasAny(['search']))
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
                            <a href="{{ route('weekly_holidays.create') }}"
                               class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold rounded-full transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-green-500/50 backdrop-blur-sm">
                                <div class="flex items-center justify-center w-6 h-6 bg-white/20 rounded-lg mr-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                {{ __('Add Weekly Holiday') }}
                                <svg class="w-4 h-4 ml-3 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                
                <form action="{{ route('holidays.index') }}" method="GET" class="p-6">
                    <!-- Main Search Row -->
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 mb-6">
                        <!-- Search Input -->
                        <div class="lg:col-span-8">
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
                                       placeholder="{{ __('Search by day name...') }}" />
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="lg:col-span-4 flex items-end space-x-3">
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
                            <!-- Day Type Filter -->
                            <div>
                                <label for="day_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('Day Type') }}
                                </label>
                                <select name="day_type" id="day_type" class="block w-full py-2.5 px-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                    <option value="">{{ __('All Days') }}</option>
                                    <option value="weekend" {{ request('day_type') == 'weekend' ? 'selected' : '' }}>{{ __('Weekend Days') }}</option>
                                    <option value="weekday" {{ request('day_type') == 'weekday' ? 'selected' : '' }}>{{ __('Weekdays') }}</option>
                                </select>
                            </div>
                            
                            <!-- Holiday Count -->
                            <div>
                                <label for="holiday_count" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('Holiday Count') }}
                                </label>
                                <select name="holiday_count" id="holiday_count" class="block w-full py-2.5 px-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                    <option value="">{{ __('All Counts') }}</option>
                                    <option value="single" {{ request('holiday_count') == 'single' ? 'selected' : '' }}>{{ __('Single Day') }}</option>
                                    <option value="multiple" {{ request('holiday_count') == 'multiple' ? 'selected' : '' }}>{{ __('Multiple Days') }}</option>
                                </select>
                            </div>
                            
                            <!-- Sort By -->
                            <div>
                                <label for="sort_by" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('Sort By') }}
                                </label>
                                <select name="sort_by" id="sort_by" class="block w-full py-2.5 px-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                    <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>{{ __('Created Date') }}</option>
                                    <option value="days_count" {{ request('sort_by') == 'days_count' ? 'selected' : '' }}>{{ __('Days Count') }}</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Quick Filter Buttons -->
                        <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex flex-wrap gap-2">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300 mr-4 flex items-center">{{ __('Quick Filters:') }}</span>
                                <button type="button" class="quick-filter px-3 py-1.5 text-xs bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200" data-filter="weekend">
                                    {{ __('Weekend Only') }}
                                </button>
                                <button type="button" class="quick-filter px-3 py-1.5 text-xs bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200" data-filter="single">
                                    {{ __('Single Day') }}
                                </button>
                                <button type="button" class="quick-filter px-3 py-1.5 text-xs bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200" data-filter="multiple">
                                    {{ __('Multiple Days') }}
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

            <!-- Weekly Holidays Table Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <!-- Table Header -->
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white flex items-center">
                        <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h6a2 2 0 012 2v4m-6 12h6m-6 0v-6m6 6v-6m-6 0h6"></path>
                        </svg>
                        {{ __('Weekly Holidays List') }}
                        @if($holidays->total() > 0)
                            <span class="ml-3 px-3 py-1 text-sm bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 rounded-full">
                                {{ $holidays->total() }} {{ __('Total') }}
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
                                    {{ __('Holiday Configuration') }}
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    {{ __('Day Summary') }}
                                        </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider sticky right-0 bg-gray-50 dark:bg-gray-900/50 z-10 shadow-[-4px_0_6px_-1px_rgba(0,0,0,0.1)] dark:shadow-[-4px_0_6px_-1px_rgba(0,0,0,0.3)]">
                                            {{ __('Actions') }}
                                        </th>
                                    </tr>
                                </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($holidays as $holiday)
                                @php
                                    $daysOfWeek = json_decode($holiday->days_of_week);
                                    $daysArray = is_array($daysOfWeek) ? $daysOfWeek : [$daysOfWeek];
                                    $dayCount = count($daysArray);
                                    $isWeekend = collect($daysArray)->intersect(['saturday', 'sunday'])->isNotEmpty();
                                                    @endphp
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-150">
                                    <td class="px-6 py-4">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0 w-12 h-12 relative">
                                                <div class="w-12 h-12 rounded-full bg-gradient-to-br {{ $isWeekend ? 'from-orange-500 to-red-600' : 'from-blue-500 to-indigo-600' }} flex items-center justify-center border-2 border-gray-200 dark:border-gray-600">
                                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h6a2 2 0 012 2v4m-6 12h6m-6 0v-6m6 6v-6m-6 0h6"></path>
                                                    </svg>
                                                </div>
                                                <div class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full {{ $dayCount > 1 ? 'bg-purple-500' : 'bg-green-500' }} border-2 border-white dark:border-gray-800 flex items-center justify-center">
                                                    <span class="text-white text-xs font-bold">{{ $dayCount }}</span>
                                                </div>
                                            </div>
                                            <div class="ml-4 flex-1">
                                                <div class="text-sm font-semibold text-gray-900 dark:text-white mb-2">
                                                    {{ __('Holiday Days Configuration') }}
                                                </div>
                                                <div class="flex flex-wrap gap-1">
                                                    @foreach ($daysArray as $day)
                                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium 
                                                            {{ in_array($day, ['saturday', 'sunday']) 
                                                                ? 'bg-orange-100 dark:bg-orange-900/30 text-orange-800 dark:text-orange-300' 
                                                                : 'bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300' }}">
                                                            {{ ucfirst($day) }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            </div>
                                                    </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="space-y-2">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v4"></path>
                                                </svg>
                                                <span class="text-sm text-gray-600 dark:text-gray-400">
                                                    {{ $dayCount }} {{ $dayCount === 1 ? __('day') : __('days') }}
                                                        </span>
                                                    </div>
                                            @if($isWeekend)
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707"></path>
                                                    </svg>
                                                    <span class="text-sm text-orange-600 dark:text-orange-400 font-medium">
                                                        {{ __('Includes Weekend') }}
                                                    </span>
                                                </div>
                                            @endif
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ __('Created: ') }}{{ $holiday->created_at ? $holiday->created_at->format('M d, Y') : __('Unknown') }}
                                                </div>
                                            </div>
                                        </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium sticky right-0 bg-white dark:bg-gray-800 z-10 shadow-[-4px_0_6px_-1px_rgba(0,0,0,0.1)] dark:shadow-[-4px_0_6px_-1px_rgba(0,0,0,0.3)]">
                                        <div class="flex items-center space-x-3">
                                            <!-- Edit Button -->
                                                <a href="{{ route('weekly_holidays.edit', $holiday->id) }}"
                                               class="group relative inline-flex items-center justify-center p-2 text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-lg transition-all duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                                                    {{ __('Edit') }}
                                                </span>
                                            </a>
                                            
                                            <!-- Delete Button -->
                                            <button onclick="showConfirmation({{ $holiday->id }})" 
                                                    class="group relative inline-flex items-center justify-center p-2 text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-all duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                                                    {{ __('Delete') }}
                                                </span>
                                            </button>
                                            </div>
                                        </td>
                                    </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="w-24 h-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h6a2 2 0 012 2v4m-6 12h6m-6 0v-6m6 6v-6m-6 0h6"></path>
                                                </svg>
                                            </div>
                                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">{{ __('No weekly holidays configured') }}</h3>
                                            <p class="text-gray-500 dark:text-gray-400 mb-6 max-w-sm">{{ __('No weekly holidays have been set up yet. Get started by adding your first weekly holiday configuration.') }}</p>
                                            <a href="{{ route('weekly_holidays.create') }}"
                                               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                                {{ __('Add First Holiday') }}
                                            </a>
                                        </div>
                                        </td>
                                    </tr>
                            @endforelse
                                </tbody>
                            </table>
                </div>

                <!-- Pagination -->
                @if ($holidays->total() > $holidays->count())
                    <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                {{ __('Showing') }} 
                                <span class="font-medium">{{ $holidays->firstItem() }}</span>
                                {{ __('to') }}
                                <span class="font-medium">{{ $holidays->lastItem() }}</span>
                                {{ __('of') }}
                                <span class="font-medium">{{ $holidays->total() }}</span>
                                {{ __('results') }}
                            </div>
                            <div class="pagination-wrapper">
                                {{ $holidays->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
    </div>
    </div>

    <script>
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
                        case 'weekend':
                            params.set('day_type', 'weekend');
                            break;
                        case 'single':
                            params.set('holiday_count', 'single');
                            break;
                        case 'multiple':
                            params.set('holiday_count', 'multiple');
                            break;
                    }
                    
                    url.search = params.toString();
                    window.location.href = url.href;
                });
            });

            // Update active filters display
            function updateActiveFilters() {
                const filters = [];
                const search = document.getElementById('search')?.value || '';
                const dayType = document.getElementById('day_type')?.value || '';
                const holidayCount = document.getElementById('holiday_count')?.value || '';
                const sortBy = document.getElementById('sort_by')?.value || '';

                if (search) filters.push({ label: `Search: ${search}`, field: 'search', value: search });
                if (dayType) filters.push({ label: `Type: ${dayType.charAt(0).toUpperCase() + dayType.slice(1)}`, field: 'day_type', value: dayType });
                if (holidayCount) filters.push({ label: `Count: ${holidayCount.charAt(0).toUpperCase() + holidayCount.slice(1)}`, field: 'holiday_count', value: holidayCount });
                if (sortBy && sortBy !== 'created_at') {
                    const sortSelect = document.getElementById('sort_by');
                    const sortName = sortSelect.options[sortSelect.selectedIndex].text;
                    filters.push({ label: `Sort: ${sortName}`, field: 'sort_by', value: sortBy });
                }

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
            const url = new URL(window.location.href);
            const params = new URLSearchParams(url.search);
            params.delete(fieldName);
            url.search = params.toString();
            window.location.href = url.href;
        }

        // Delete confirmation
        function showConfirmation(id) {
            Swal.fire({
                title: '{{ __("Want to delete this Holiday!") }}',
                text: "{{ __('If you are ready?') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "{{ __('Yes') }}",
                cancelButtonText: "{{ __('Cancel') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/weekly_holiday/destroy/" + id;
                }
            });
        }
    </script>
</x-app-layout>