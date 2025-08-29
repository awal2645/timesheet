@section('title')
    {{ 'Leave Type Management' }}
@endsection

<x-app-layout>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Enhanced Header Section -->
            <div class="mb-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div class="mb-6 lg:mb-0">
                        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-3 tracking-tight">
                            {{ __('Leave Type Management') }}
                        </h1>
                        <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl">
                            {{ __('Configure and manage different types of leave available for employees in your organization') }}
                        </p>
                    </div>
                    
                    <!-- Quick Stats Cards -->
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-200 dark:border-gray-700 text-center">
                            <div class="text-2xl font-bold text-blue-600 dark:text-blue-400 mb-1">
                                {{ $leaveTypes->total() }}
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                {{ __('Total Types') }}
                            </div>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-200 dark:border-gray-700 text-center">
                            <div class="text-2xl font-bold text-green-600 dark:text-green-400 mb-1">
                                {{ $leaveTypes->where('description', '!=', null)->count() }}
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                {{ __('With Details') }}
                            </div>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-200 dark:border-gray-700 text-center">
                            <div class="text-2xl font-bold text-purple-600 dark:text-purple-400 mb-1">
                                {{ $leaveTypes->filter(function($type) {
                                    return strlen($type->type) > 10;
                                })->count() }}
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                {{ __('Detailed Names') }}
                            </div>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-200 dark:border-gray-700 text-center">
                            <div class="text-2xl font-bold text-orange-600 dark:text-orange-400 mb-1">
                                {{ $leaveTypes->where('description', '!=', null)->where('description', '!=', '')->count() }}
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                {{ __('Configured') }}
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
                            <a href="{{ route('leave_types.create') }}"
                               class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold rounded-full transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-green-500/50 backdrop-blur-sm">
                                <div class="flex items-center justify-center w-6 h-6 bg-white/20 rounded-lg mr-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                {{ __('Create Leave Type') }}
                                <svg class="w-4 h-4 ml-3 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                
                <form action="{{ route('leave_types.index') }}" method="GET" class="p-6">
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
                                       placeholder="{{ __('Search by leave type name or description...') }}" />
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
                            <!-- Sort By -->
                            <div>
                                <label for="sort_by" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('Sort By') }}
                                </label>
                                <select name="sort_by" id="sort_by" class="block w-full py-2.5 px-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                    <option value="type" {{ request('sort_by') == 'type' ? 'selected' : '' }}>{{ __('Leave Type Name') }}</option>
                                    <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>{{ __('Created Date') }}</option>
                                    <option value="description" {{ request('sort_by') == 'description' ? 'selected' : '' }}>{{ __('Description') }}</option>
                                </select>
                            </div>
                            
                            <!-- Sort Order -->
                            <div>
                                <label for="sort_order" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('Sort Order') }}
                                </label>
                                <select name="sort_order" id="sort_order" class="block w-full py-2.5 px-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                    <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>{{ __('Ascending') }}</option>
                                    <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>{{ __('Descending') }}</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Quick Filter Buttons -->
                        <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex flex-wrap gap-2">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300 mr-4 flex items-center">{{ __('Quick Filters:') }}</span>
                                <button type="button" class="quick-filter px-3 py-1.5 text-xs bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200" data-filter="with-description">
                                    {{ __('With Description') }}
                                </button>
                                <button type="button" class="quick-filter px-3 py-1.5 text-xs bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200" data-filter="recent">
                                    {{ __('Recently Added') }}
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

            <!-- Leave Types Table Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <!-- Table Header -->
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white flex items-center">
                        <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        {{ __('Leave Type List') }}
                        @if($leaveTypes->total() > 0)
                            <span class="ml-3 px-3 py-1 text-sm bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 rounded-full">
                                {{ $leaveTypes->total() }} {{ __('Total') }}
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
                                    {{ __('Leave Type Information') }}
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    {{ __('Description & Details') }}
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider sticky right-0 bg-gray-50 dark:bg-gray-900/50 z-10 shadow-[-4px_0_6px_-1px_rgba(0,0,0,0.1)] dark:shadow-[-4px_0_6px_-1px_rgba(0,0,0,0.3)]">
                                    {{ __('Actions') }}
                                </th>
                                    </tr>
                                </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($leaveTypes as $leaveType)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-150">
                                    <td class="px-6 py-4">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0 w-12 h-12">
                                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center border-2 border-gray-200 dark:border-gray-600">
                                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="ml-4 flex-1">
                                                <div class="text-sm font-semibold text-gray-900 dark:text-white mb-1">
                                                    {{ $leaveType->type }}
                                                </div>
                                                <div class="flex items-center space-x-2">
                                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300">
                                                        <div class="w-2 h-2 bg-blue-500 rounded-full mr-1.5"></div>
                                                        {{ __('Leave Type') }}
                                                    </span>
                                                    @if($leaveType->description)
                                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300">
                                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"></path>
                                                            </svg>
                                                            {{ __('Configured') }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="space-y-2">
                                            @if($leaveType->description)
                                                <div class="text-sm text-gray-900 dark:text-white">
                                                    {{ Str::limit($leaveType->description, 100) }}
                                                </div>
                                                @if(strlen($leaveType->description) > 100)
                                                    <span class="text-xs text-blue-600 dark:text-blue-400 cursor-pointer hover:underline" onclick="showFullDescription('{{ addslashes($leaveType->description) }}')">
                                                        {{ __('Read more...') }}
                                                    </span>
                                                @endif
                                            @else
                                                <div class="text-sm text-gray-500 dark:text-gray-400 italic">
                                                    {{ __('No description provided') }}
                                                </div>
                                            @endif
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ __('Created:') }} {{ $leaveType->created_at ? $leaveType->created_at->format('M d, Y') : __('Unknown') }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium sticky right-0 bg-white dark:bg-gray-800 z-10 shadow-[-4px_0_6px_-1px_rgba(0,0,0,0.1)] dark:shadow-[-4px_0_6px_-1px_rgba(0,0,0,0.3)]">
                                        <div class="flex items-center space-x-3">
                                            <!-- Edit Button -->
                                            <a href="{{ route('leave_types.edit', $leaveType->id) }}" 
                                               class="group relative inline-flex items-center justify-center p-2 text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-lg transition-all duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                                                    {{ __('Edit') }}
                                                </span>
                                            </a>
                                            
                                            <!-- Delete Button -->
                                            <button onclick="showConfirmation({{ $leaveType->id }})" 
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
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                            </div>
                                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">{{ __('No leave types configured') }}</h3>
                                            <p class="text-gray-500 dark:text-gray-400 mb-6 max-w-sm">{{ __('No leave types have been added yet. Get started by creating your first leave type.') }}</p>
                                            <a href="{{ route('leave_types.create') }}"
                                               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                                {{ __('Add First Leave Type') }}
                                            </a>
                                        </div>
                                        </td>
                                    </tr>
                            @endforelse
                                </tbody>
                            </table>
                </div>

                <!-- Pagination -->
                @if ($leaveTypes->total() > $leaveTypes->count())
                    <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                {{ __('Showing') }} 
                                <span class="font-medium">{{ $leaveTypes->firstItem() }}</span>
                                {{ __('to') }}
                                <span class="font-medium">{{ $leaveTypes->lastItem() }}</span>
                                {{ __('of') }}
                                <span class="font-medium">{{ $leaveTypes->total() }}</span>
                                {{ __('results') }}
                            </div>
                            <div class="pagination-wrapper">
                                {{ $leaveTypes->links() }}
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
                        case 'with-description':
                            params.set('has_description', '1');
                            break;
                        case 'recent':
                            params.set('sort_by', 'created_at');
                            params.set('sort_order', 'desc');
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
                const sortBy = document.getElementById('sort_by')?.value || '';
                const sortOrder = document.getElementById('sort_order')?.value || '';

                if (search) filters.push({ label: `Search: ${search}`, field: 'search', value: search });
                if (sortBy && sortBy !== 'type') {
                    const sortSelect = document.getElementById('sort_by');
                    const sortName = sortSelect.options[sortSelect.selectedIndex].text;
                    filters.push({ label: `Sort: ${sortName}`, field: 'sort_by', value: sortBy });
                }
                if (sortOrder && sortOrder !== 'asc') {
                    filters.push({ label: `Order: ${sortOrder === 'desc' ? 'Descending' : 'Ascending'}`, field: 'sort_order', value: sortOrder });
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

        // Show full description in modal
        function showFullDescription(description) {
            Swal.fire({
                title: '{{ __("Leave Type Description") }}',
                text: description,
                icon: 'info',
                confirmButtonText: "{{ __('Close') }}",
                customClass: {
                    popup: 'text-left'
                }
            });
        }

        // Delete confirmation
        function showConfirmation(id) {
            Swal.fire({
                title: '{{ __("Want to delete this Leave Type!") }}',
                text: "{{ __('If you are ready?') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "{{ __('Yes') }}",
                cancelButtonText: "{{ __('Cancel') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/leave_type/destroy/" + id;
                }
            });
        }
    </script>
</x-app-layout>