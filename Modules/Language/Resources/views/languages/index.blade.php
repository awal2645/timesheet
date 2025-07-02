@section('title', 'Language Management')

<x-app-layout>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Enhanced Header Section -->
            <div class="mb-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div class="mb-6 lg:mb-0">
                        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-3 tracking-tight">
                            {{ __('Language Management') }}
                        </h1>
                        <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl">
                            {{ __('Manage application languages, localization settings, and translation configurations for your multi-language platform') }}
                        </p>
                    </div>
                    
                    <!-- Quick Stats Cards -->
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-200 dark:border-gray-700 text-center">
                            <div class="text-2xl font-bold text-blue-600 dark:text-blue-400 mb-1">
                                {{ $languagesList->total() }}
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                {{ __('Total Languages') }}
                            </div>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-200 dark:border-gray-700 text-center">
                            <div class="text-2xl font-bold text-green-600 dark:text-green-400 mb-1">
                                {{ $languagesList->where('direction', 'ltr')->count() }}
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                {{ __('LTR Languages') }}
                            </div>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-200 dark:border-gray-700 text-center">
                            <div class="text-2xl font-bold text-purple-600 dark:text-purple-400 mb-1">
                                {{ $languagesList->where('direction', 'rtl')->count() }}
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                {{ __('RTL Languages') }}
                            </div>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-200 dark:border-gray-700 text-center">
                            <div class="text-2xl font-bold text-orange-600 dark:text-orange-400 mb-1">
                                {{ $languagesList->unique('code')->count() }}
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                {{ __('Unique Codes') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-8 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-6 py-4 rounded-xl" role="alert">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

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
                            <a href="{{ route('languages.create') }}"
                               class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold rounded-full transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-green-500/50 backdrop-blur-sm">
                                <div class="flex items-center justify-center w-6 h-6 bg-white/20 rounded-lg mr-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                {{ __('Add Language') }}
                                <svg class="w-4 h-4 ml-3 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                
                <form action="{{ route('languages.index') }}" method="GET" class="p-6">
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
                                       placeholder="{{ __('Search by language name, code, or direction...') }}" />
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
                            <!-- Direction Filter -->
                            <div>
                                <label for="direction_filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('Filter by Direction') }}
                                </label>
                                <select name="direction_filter" id="direction_filter" class="block w-full py-2.5 px-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                    <option value="">{{ __('All Directions') }}</option>
                                    <option value="ltr" {{ request('direction_filter') == 'ltr' ? 'selected' : '' }}>{{ __('LTR (Left to Right)') }}</option>
                                    <option value="rtl" {{ request('direction_filter') == 'rtl' ? 'selected' : '' }}>{{ __('RTL (Right to Left)') }}</option>
                                </select>
                            </div>
                            
                            <!-- Code Filter -->
                            <div>
                                <label for="code_filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('Filter by Code') }}
                                </label>
                                <select name="code_filter" id="code_filter" class="block w-full py-2.5 px-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                    <option value="">{{ __('All Codes') }}</option>
                                    @foreach($languagesList->unique('code')->pluck('code')->filter() as $code)
                                        <option value="{{ $code }}" {{ request('code_filter') == $code ? 'selected' : '' }}>
                                            {{ strtoupper($code) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <!-- Sort By -->
                            <div>
                                <label for="sort_by" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('Sort By') }}
                                </label>
                                <select name="sort_by" id="sort_by" class="block w-full py-2.5 px-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                    <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>{{ __('Language Name') }}</option>
                                    <option value="code" {{ request('sort_by') == 'code' ? 'selected' : '' }}>{{ __('Language Code') }}</option>
                                    <option value="direction" {{ request('sort_by') == 'direction' ? 'selected' : '' }}>{{ __('Direction') }}</option>
                                    <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>{{ __('Created Date') }}</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Quick Filter Buttons -->
                        <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex flex-wrap gap-2">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300 mr-4 flex items-center">{{ __('Quick Filters:') }}</span>
                                <button type="button" class="quick-filter px-3 py-1.5 text-xs bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200" data-filter="ltr">
                                    {{ __('LTR Languages') }}
                                </button>
                                <button type="button" class="quick-filter px-3 py-1.5 text-xs bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200" data-filter="rtl">
                                    {{ __('RTL Languages') }}
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

            <!-- Languages Table Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <!-- Table Header -->
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white flex items-center">
                        <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                        </svg>
                        {{ __('Languages List') }}
                        @if($languagesList->total() > 0)
                            <span class="ml-3 px-3 py-1 text-sm bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 rounded-full">
                                {{ $languagesList->total() }} {{ __('Total') }}
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
                                    {{ __('Language Details') }}
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    {{ __('Code & Direction') }}
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    {{ __('Configuration') }}
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider sticky right-0 bg-gray-50 dark:bg-gray-900/50 z-10 shadow-[-4px_0_6px_-1px_rgba(0,0,0,0.1)] dark:shadow-[-4px_0_6px_-1px_rgba(0,0,0,0.3)]">
                                    {{ __('Actions') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($languagesList as $language)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-150">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-10 h-10">
                                                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-semibold text-lg border-2 border-gray-200 dark:border-gray-600">
                                                    @if($language->icon)
                                                        <span class="flag-icon {{ $language->icon }} text-lg"></span>
                                                    @else
                                                        <span>{{ strtoupper(substr($language->code, 0, 2)) }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-semibold text-gray-900 dark:text-white">
                                                    {{ $language->name }}
                                                </div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ __('Language') }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="space-y-2">
                                            <div>
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                                                    </svg>
                                                    {{ strtoupper($language->code) }}
                                                </span>
                                            </div>
                                            <div>
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $language->direction == 'rtl' ? 'bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-300' : 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300' }}">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        @if($language->direction == 'rtl')
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                                        @else
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                        @endif
                                                    </svg>
                                                    {{ strtoupper($language->direction) }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="space-y-2">
                                            <div class="flex items-center space-x-2">
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300">
                                                    <div class="w-2 h-2 bg-gray-500 rounded-full mr-1.5"></div>
                                                    {{ __('Configured') }}
                                                </span>
                                            </div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ __('Translation files available') }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium sticky right-0 bg-white dark:bg-gray-800 z-10 shadow-[-4px_0_6px_-1px_rgba(0,0,0,0.1)] dark:shadow-[-4px_0_6px_-1px_rgba(0,0,0,0.3)]">
                                        <div class="flex items-center space-x-3">
                                            <!-- Edit Button -->
                                            <a href="{{ route('languages.edit', $language) }}" 
                                               class="group relative inline-flex items-center justify-center p-2 text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-lg transition-all duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                                                    {{ __('Edit') }}
                                                </span>
                                            </a>
                                            
                                            <!-- Translations Button -->
                                            <a href="{{ route('languages.json.edit', $language->code) }}" 
                                               class="group relative inline-flex items-center justify-center p-2 text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300 hover:bg-green-50 dark:hover:bg-green-900/30 rounded-lg transition-all duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                                                </svg>
                                                <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                                                    {{ __('Translations') }}
                                                </span>
                                            </a>
                                            
                                            <!-- Delete Button -->
                                            <form action="{{ route('languages.destroy', $language) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        onclick="return confirm('{{ __('Are you sure you want to delete this language?') }}')"
                                                        class="group relative inline-flex items-center justify-center p-2 text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-all duration-200">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                                                        {{ __('Delete') }}
                                                    </span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="w-24 h-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                                                </svg>
                                            </div>
                                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">{{ __('No languages configured') }}</h3>
                                            <p class="text-gray-500 dark:text-gray-400 mb-6 max-w-sm">{{ __('No languages have been added yet. Add your first language to start supporting multiple languages in your application.') }}</p>
                                            <a href="{{ route('languages.create') }}"
                                               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                                {{ __('Add First Language') }}
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($languagesList->total() > $languagesList->count())
                    <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                {{ __('Showing') }} 
                                <span class="font-medium">{{ $languagesList->firstItem() }}</span>
                                {{ __('to') }}
                                <span class="font-medium">{{ $languagesList->lastItem() }}</span>
                                {{ __('of') }}
                                <span class="font-medium">{{ $languagesList->total() }}</span>
                                {{ __('results') }}
                            </div>
                            <div class="pagination-wrapper">
                                {{ $languagesList->links() }}
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
                        case 'ltr':
                            params.set('direction_filter', 'ltr');
                            break;
                        case 'rtl':
                            params.set('direction_filter', 'rtl');
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
                const directionFilter = document.getElementById('direction_filter')?.value || '';
                const codeFilter = document.getElementById('code_filter')?.value || '';
                const sortBy = document.getElementById('sort_by')?.value || '';

                if (search) filters.push({ label: `Search: ${search}`, field: 'search', value: search });
                if (directionFilter) {
                    const directionSelect = document.getElementById('direction_filter');
                    const directionName = directionSelect.options[directionSelect.selectedIndex].text;
                    filters.push({ label: `Direction: ${directionName}`, field: 'direction_filter', value: directionFilter });
                }
                if (codeFilter) {
                    filters.push({ label: `Code: ${codeFilter.toUpperCase()}`, field: 'code_filter', value: codeFilter });
                }
                if (sortBy && sortBy !== 'name') {
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