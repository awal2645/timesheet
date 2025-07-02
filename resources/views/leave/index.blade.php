@section('title')
    {{ 'Leave Management' }}
@endsection

<x-app-layout>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Enhanced Header Section -->
            <div class="mb-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div class="mb-6 lg:mb-0">
                        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-3 tracking-tight">
                            {{ __('Leave Management') }}
                        </h1>
                        <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl">
                            {{ __('Comprehensive dashboard to manage, approve, and track all employee leave applications and requests') }}
                        </p>
                    </div>
                    
                    <!-- Quick Stats Cards -->
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-200 dark:border-gray-700 text-center">
                            <div class="text-2xl font-bold text-blue-600 dark:text-blue-400 mb-1">
                                {{ $applications->total() }}
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                {{ __('Total Applications') }}
                            </div>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-200 dark:border-gray-700 text-center">
                            <div class="text-2xl font-bold text-yellow-600 dark:text-yellow-400 mb-1">
                                {{ $applications->where('status', 'pending')->count() }}
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                {{ __('Pending') }}
                            </div>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-200 dark:border-gray-700 text-center">
                            <div class="text-2xl font-bold text-green-600 dark:text-green-400 mb-1">
                                {{ $applications->where('status', 'approved')->count() }}
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                {{ __('Approved') }}
                            </div>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-200 dark:border-gray-700 text-center">
                            <div class="text-2xl font-bold text-red-600 dark:text-red-400 mb-1">
                                {{ $applications->where('status', 'denied')->count() }}
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                {{ __('Denied') }}
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
                            @if(request()->hasAny(['search', 'status', 'employee']))
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
                            <a href="{{ route('leave.create') }}"
                               class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold rounded-full transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-green-500/50 backdrop-blur-sm">
                                <div class="flex items-center justify-center w-6 h-6 bg-white/20 rounded-lg mr-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                {{ __('Create Leave Application') }}
                                <svg class="w-4 h-4 ml-3 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                
                <form action="{{ route('leave.index') }}" method="GET" class="p-6">
                    <!-- Main Search Row -->
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 mb-6">
                        <!-- Search Input -->
                        <div class="lg:col-span-5">
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
                                       placeholder="{{ __('Search by employee name or reason...') }}" />
                            </div>
                        </div>
                        
                        <!-- Status Filter -->
                        <div class="lg:col-span-2">
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('Status') }}
                            </label>
                            <select name="status" id="status" class="block w-full py-3 px-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                <option value="">{{ __('All Status') }}</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>{{ __('Approved') }}</option>
                                <option value="denied" {{ request('status') == 'denied' ? 'selected' : '' }}>{{ __('Denied') }}</option>
                            </select>
                        </div>
                        
                        <!-- Employee Filter -->
                        <div class="lg:col-span-2">
                            <label for="employee" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('Employee') }}
                            </label>
                            <select name="employee" id="employee" class="block w-full py-3 px-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                <option value="">{{ __('All Employees') }}</option>
                                @foreach($applications->pluck('employee')->unique('id') as $employee)
                                    @if($employee)
                                        <option value="{{ $employee->id }}" {{ request('employee') == $employee->id ? 'selected' : '' }}>
                                            {{ $employee->employee_name }}
                                        </option>
                                    @endif
                                @endforeach
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
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <!-- Date Range -->
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('Leave Start Date') }}
                                </label>
                                <input type="date" 
                                       id="start_date" 
                                       name="start_date" 
                                       value="{{ request('start_date') }}"
                                       class="block w-full py-2.5 px-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" />
                            </div>
                            
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('Leave End Date') }}
                                </label>
                                <input type="date" 
                                       id="end_date" 
                                       name="end_date" 
                                       value="{{ request('end_date') }}"
                                       class="block w-full py-2.5 px-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" />
                            </div>
                            
                            <!-- Application Date -->
                            <div>
                                <label for="applied_from" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('Applied From') }}
                                </label>
                                <input type="date" 
                                       id="applied_from" 
                                       name="applied_from" 
                                       value="{{ request('applied_from') }}"
                                       class="block w-full py-2.5 px-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" />
                            </div>
                            
                            <!-- Sort By -->
                            <div>
                                <label for="sort_by" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('Sort By') }}
                                </label>
                                <select name="sort_by" id="sort_by" class="block w-full py-2.5 px-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                    <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>{{ __('Application Date') }}</option>
                                    <option value="start_date" {{ request('sort_by') == 'start_date' ? 'selected' : '' }}>{{ __('Leave Start Date') }}</option>
                                    <option value="employee_name" {{ request('sort_by') == 'employee_name' ? 'selected' : '' }}>{{ __('Employee Name') }}</option>
                                    <option value="status" {{ request('sort_by') == 'status' ? 'selected' : '' }}>{{ __('Status') }}</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Quick Filter Buttons -->
                        <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex flex-wrap gap-2">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300 mr-4 flex items-center">{{ __('Quick Filters:') }}</span>
                                <button type="button" class="quick-filter px-3 py-1.5 text-xs bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200" data-filter="pending">
                                    {{ __('Pending Only') }}
                                </button>
                                <button type="button" class="quick-filter px-3 py-1.5 text-xs bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200" data-filter="approved">
                                    {{ __('Approved Only') }}
                                </button>
                                <button type="button" class="quick-filter px-3 py-1.5 text-xs bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200" data-filter="denied">
                                    {{ __('Denied Only') }}
                                </button>
                                <button type="button" class="quick-filter px-3 py-1.5 text-xs bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200" data-filter="this-month">
                                    {{ __('This Month') }}
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

            <!-- Leave Applications Table Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <!-- Table Header -->
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white flex items-center">
                        <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h6a2 2 0 012 2v4m-6 12h6m-6 0v-6m6 6v-6m-6 0h6"></path>
                        </svg>
                        {{ __('Leave Applications') }}
                        @if($applications->total() > 0)
                            <span class="ml-3 px-3 py-1 text-sm bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 rounded-full">
                                {{ $applications->total() }} {{ __('Total') }}
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
                                    {{ __('Employee Information') }}
                                        </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    {{ __('Leave Period') }}
                                        </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    {{ __('Reason & Duration') }}
                                        </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            {{ __('Status') }}
                                        </th>
                                @if (auth()->user()->role === 'superadmin' || auth()->user()->role === 'employer')
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider sticky right-0 bg-gray-50 dark:bg-gray-900/50 z-10 shadow-[-4px_0_6px_-1px_rgba(0,0,0,0.1)] dark:shadow-[-4px_0_6px_-1px_rgba(0,0,0,0.3)]">
                                        {{ __('Actions') }}
                                    </th>
                                        @endif
                                    </tr>
                                </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($applications as $application)
                                @php
                                    $startDate = \Carbon\Carbon::parse($application->start_date);
                                    $endDate = \Carbon\Carbon::parse($application->end_date);
                                    $duration = $startDate->diffInDays($endDate) + 1;
                                @endphp
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-12 h-12 relative">
                                                @if ($application->employee && $application->employee->user && $application->employee->user->image)
                                                    <img class="w-12 h-12 rounded-full object-cover border-2 border-gray-200 dark:border-gray-600"
                                                         src="{{ asset($application->employee->user->image) }}"
                                                         alt="{{ $application->employee->employee_name }}">
                                                @else
                                                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-teal-500 to-cyan-600 flex items-center justify-center border-2 border-gray-200 dark:border-gray-600">
                                                        <span class="text-white font-semibold text-lg">
                                                            {{ $application->employee ? substr($application->employee->employee_name, 0, 1) : 'N' }}
                                                        </span>
                                                    </div>
                                                @endif
                                                <div class="absolute -bottom-1 -right-1 w-4 h-4 rounded-full {{ $application->status === 'approved' ? 'bg-green-500' : ($application->status === 'denied' ? 'bg-red-500' : 'bg-yellow-500') }} border-2 border-white dark:border-gray-800"></div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-semibold text-gray-900 dark:text-white">
                                                    {{ $application->employee->employee_name ?? 'Unknown Employee' }}
                                                </div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ __('Applied: ') }}{{ $application->created_at->format('M d, Y') }}
                                                </div>
                                            </div>
                                            </div>
                                        </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-white">
                                            <div class="font-medium">{{ $startDate->format('M d, Y') }}</div>
                                            <div class="text-gray-500 dark:text-gray-400">{{ __('to') }}</div>
                                            <div class="font-medium">{{ $endDate->format('M d, Y') }}</div>
                                        </div>
                                        </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 dark:text-white">
                                            <div class="font-medium mb-1 line-clamp-2">{{ $application->reason }}</div>
                                            <div class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h6a2 2 0 012 2v4m-6 12h6m-6 0v-6m6 6v-6m-6 0h6"></path>
                                                </svg>
                                                {{ $duration }} {{ $duration === 1 ? __('day') : __('days') }}
                                            </div>
                                        </div>
                                        </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                            {{ $application->status === 'approved' ? 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300' : 
                                               ($application->status === 'denied' ? 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300' : 
                                                'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300') }}">
                                            <div class="w-2 h-2 rounded-full mr-2 
                                                {{ $application->status === 'approved' ? 'bg-green-500' : 
                                                   ($application->status === 'denied' ? 'bg-red-500' : 'bg-yellow-500') }}">
                                            </div>
                                            {{ ucfirst($application->status) }}
                                        </span>
                                        </td>
                                    @if (auth()->user()->role === 'superadmin' || auth()->user()->role === 'employer')
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium sticky right-0 bg-white dark:bg-gray-800 z-10 shadow-[-4px_0_6px_-1px_rgba(0,0,0,0.1)] dark:shadow-[-4px_0_6px_-1px_rgba(0,0,0,0.3)]">
                                                @if ($application->status === 'pending')
                                                <div class="flex items-center space-x-3">
                                                <!-- Approve Button -->
                                                    <form action="{{ route('leave.approve', $application->id) }}" method="POST" class="inline">
                                                    @csrf
                                                        <button type="submit" class="group relative inline-flex items-center justify-center px-6 py-2.5 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold rounded-full transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-green-500/50 backdrop-blur-sm">
                                                            <div class="flex items-center justify-center w-5 h-5 bg-white/20 rounded-lg mr-2">
                                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                                                </svg>
                                                            </div>
                                                        {{ __('Approve') }}
                                                            <svg class="w-3 h-3 ml-2 transition-transform duration-200 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5-5 5M6 12h12"></path>
                                                            </svg>
                                                    </button>
                                                </form>

                                                <!-- Deny Button -->
                                                    <form action="{{ route('leave.deny', $application->id) }}" method="POST" class="inline">
                                                    @csrf
                                                        <button type="submit" class="group relative inline-flex items-center justify-center px-6 py-2.5 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-semibold rounded-full transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-red-500/50 backdrop-blur-sm">
                                                            <div class="flex items-center justify-center w-5 h-5 bg-white/20 rounded-lg mr-2">
                                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                                                                </svg>
                                                            </div>
                                                        {{ __('Deny') }}
                                                            <svg class="w-3 h-3 ml-2 transition-transform duration-200 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5-5 5M6 12h12"></path>
                                                            </svg>
                                                    </button>
                                                </form>
                                                </div>
                                                @else
                                                <!-- Action Taken -->
                                                <div class="inline-flex items-center px-6 py-2.5 text-sm font-semibold text-gray-600 dark:text-gray-400 bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 rounded-full shadow-sm border border-gray-300 dark:border-gray-600">
                                                    <div class="flex items-center justify-center w-5 h-5 bg-white/40 dark:bg-gray-800/40 rounded-lg mr-2">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                    </div>
                                                    {{ __('Action Taken') }}
                                                </div>
                                                @endif
                                        </td>
                                        @endif
                                    </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ (auth()->user()->role === 'superadmin' || auth()->user()->role === 'employer') ? '5' : '4' }}" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="w-24 h-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h6a2 2 0 012 2v4m-6 12h6m-6 0v-6m6 6v-6m-6 0h6"></path>
                                                </svg>
                                            </div>
                                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">{{ __('No leave applications found') }}</h3>
                                            <p class="text-gray-500 dark:text-gray-400 mb-6 max-w-sm">{{ __('No leave applications have been submitted yet. Get started by creating your first leave application.') }}</p>
                                            <a href="{{ route('leave.create') }}"
                                               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                                {{ __('Create First Application') }}
                                            </a>
                                        </div>
                                        </td>
                                    </tr>
                            @endforelse
                                </tbody>
                            </table>
                </div>

                <!-- Pagination -->
                @if ($applications->total() > $applications->count())
                    <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                {{ __('Showing') }} 
                                <span class="font-medium">{{ $applications->firstItem() }}</span>
                                {{ __('to') }}
                                <span class="font-medium">{{ $applications->lastItem() }}</span>
                                {{ __('of') }}
                                <span class="font-medium">{{ $applications->total() }}</span>
                                {{ __('results') }}
                            </div>
                            <div class="pagination-wrapper">
                                {{ $applications->links() }}
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
                        case 'pending':
                            params.set('status', 'pending');
                            break;
                        case 'approved':
                            params.set('status', 'approved');
                            break;
                        case 'denied':
                            params.set('status', 'denied');
                            break;
                        case 'this-month':
                            const now = new Date();
                            const startOfMonth = new Date(now.getFullYear(), now.getMonth(), 1);
                            const endOfMonth = new Date(now.getFullYear(), now.getMonth() + 1, 0);
                            params.set('start_date', startOfMonth.toISOString().split('T')[0]);
                            params.set('end_date', endOfMonth.toISOString().split('T')[0]);
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
                const status = document.getElementById('status')?.value || '';
                const employee = document.getElementById('employee')?.value || '';
                const startDate = document.getElementById('start_date')?.value || '';
                const endDate = document.getElementById('end_date')?.value || '';
                const appliedFrom = document.getElementById('applied_from')?.value || '';
                const sortBy = document.getElementById('sort_by')?.value || '';

                if (search) filters.push({ label: `Search: ${search}`, field: 'search', value: search });
                if (status) filters.push({ label: `Status: ${status.charAt(0).toUpperCase() + status.slice(1)}`, field: 'status', value: status });
                if (employee) {
                    const employeeSelect = document.getElementById('employee');
                    const employeeName = employeeSelect.options[employeeSelect.selectedIndex].text;
                    filters.push({ label: `Employee: ${employeeName}`, field: 'employee', value: employee });
                }
                if (startDate) filters.push({ label: `From: ${startDate}`, field: 'start_date', value: startDate });
                if (endDate) filters.push({ label: `To: ${endDate}`, field: 'end_date', value: endDate });
                if (appliedFrom) filters.push({ label: `Applied From: ${appliedFrom}`, field: 'applied_from', value: appliedFrom });
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
    </script>
</x-app-layout>