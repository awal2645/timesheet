@section('title')
    {{ __('Edit Project') }}
@endsection

<x-app-layout>
    <!-- Breadcrumb Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 mt-6">
        <x-breadcrumb :items="[
            [
                'label' => __('Projects'),
                'url' => route('project.index'),
                'icon' => true
            ],
            [
                'label' => __('Edit Project') . ' #' . $project->id,
                'icon' => true
            ]
        ]" />
    </div>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white dark:bg-slate-800 shadow-2xl rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-slate-700 dark:to-slate-800 px-8 py-8 border-b border-gray-200 dark:border-gray-600">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                            <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </div>
                            {{ __('Edit Project Information') }}
                        </h2>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Update project details. Fields marked with * are mandatory.') }}
                        </p>
                    </div>
                    
                    <!-- Project Status Badge -->
                    <div class="hidden md:flex items-center space-x-4">
                        <div class="bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 px-4 py-2 rounded-full text-sm font-semibold">
                            {{ __('Project ID: #:id', ['id' => $project->id]) }}
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('Modified fields') }}</div>
                        <div class="w-2 h-2 bg-red-400 rounded-full"></div>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <div class="p-8">
                <form method="POST" action="{{ route('project.update', $project->id) }}" class="space-y-8" id="projectEditForm">
            @csrf
            @method('PUT')

                    <!-- Basic Information Section -->
                    <div class="space-y-6">
                        <div class="border-b border-gray-200 dark:border-gray-600 pb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ __('Project Information') }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ __('Update project details and assignments') }}</p>
                        </div>

                        <!-- Form Grid - Basic Info -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            @if (auth('web')->user()->role != 'employer')
                            <!-- Employer Selection -->
                            <div class="space-y-2">
                                <label for="employer_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                        {{ __('Employer') }} 
                                        <span class="text-red-500 ml-1">*</span>
                                    </span>
                                </label>
                                <div class="relative group">
                                    <select name="employer_id" id="employer_id" required
                                            class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 appearance-none hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md change-highlight">
                        @foreach ($employers as $employer)
                                        <option value="{{ $employer->id }}" {{ $project->employer_id == $employer->id ? 'selected' : '' }}>
                                {{ $employer->employer_name }}
                            </option>
                        @endforeach
                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400 transition-colors duration-200 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
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

                            <!-- Client Selection -->
                            <div class="space-y-2">
                                <label for="client_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                        {{ __('Client') }} 
                                        <span class="text-red-500 ml-1">*</span>
                                    </span>
                                </label>
                                <div class="relative group">
                                    <select name="client_id" id="client_id" required
                                            class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 appearance-none hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md change-highlight">
                        @foreach ($clients as $client)
                                        <option value="{{ $client->id }}" {{ $project->client_id == $client->id ? 'selected' : '' }}>
                                {{ $client->client_name }}
                            </option>
                        @endforeach
                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400 transition-colors duration-200 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                </div>
                    @error('client_id')
                                <div class="flex items-center mt-2 p-3 text-red-700 bg-red-50 dark:bg-red-900/20 dark:text-red-400 rounded-lg border border-red-200 dark:border-red-800">
                                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm font-medium">{{ $message }}</span>
                                </div>
                    @enderror
                </div>

                            <!-- Employee Selection -->
                            <div class="space-y-2">
                                <label for="employee_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        {{ __('Employee') }} 
                                        <span class="text-red-500 ml-1">*</span>
                                    </span>
                                </label>
                                <div class="relative group">
                                    <select name="employee_id" id="employee_id" required
                                            class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 appearance-none hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md change-highlight">
                        @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ $project->employee_id == $employee->id ? 'selected' : '' }}>
                                {{ $employee->employee_name }}
                            </option>
                        @endforeach
                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400 transition-colors duration-200 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
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
            @elseif (auth('web')->user()->role == 'employer')
                <input type="hidden" name="employer_id" value="{{ auth('web')->user()->employer->id }}">
                
                            <!-- Client Selection for Employer -->
                            <div class="space-y-2">
                                <label for="client_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                        {{ __('Client') }} 
                                        <span class="text-red-500 ml-1">*</span>
                                    </span>
                                </label>
                                <div class="relative group">
                                    <select name="client_id" id="client_id" required
                                            class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 appearance-none hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md change-highlight">
                        @foreach ($clients as $client)
                                        <option value="{{ $client->id }}" {{ $project->client_id == $client->id ? 'selected' : '' }}>
                                {{ $client->client_name }}
                            </option>
                        @endforeach
                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400 transition-colors duration-200 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                </div>
                    @error('client_id')
                                <div class="flex items-center mt-2 p-3 text-red-700 bg-red-50 dark:bg-red-900/20 dark:text-red-400 rounded-lg border border-red-200 dark:border-red-800">
                                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm font-medium">{{ $message }}</span>
                                </div>
                    @enderror
                </div>

                            <!-- Employee Selection for Employer -->
                            <div class="space-y-2">
                                <label for="employee_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        {{ __('Employee') }} 
                                        <span class="text-red-500 ml-1">*</span>
                                    </span>
                                </label>
                                <div class="relative group">
                                    <select name="employee_id" id="employee_id" required
                                            class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 appearance-none hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md change-highlight">
                        @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ $project->employee_id == $employee->id ? 'selected' : '' }}>
                                {{ $employee->employee_name }}
                            </option>
                        @endforeach
                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400 transition-colors duration-200 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
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

                            <!-- Project Name -->
                            <div class="space-y-2">
                                <label for="project_name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                        </svg>
                                        {{ __('Project Name') }} 
                                        <span class="text-red-500 ml-1">*</span>
                                    </span>
                                </label>
                                <div class="relative group">
                                    <input type="text" name="project_name" id="project_name" required
                                           value="{{ $project->project_name }}"
                                           class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md change-highlight"
                                           placeholder="Enter project name..." />
                                </div>
                @error('project_name')
                                <div class="flex items-center mt-2 p-3 text-red-700 bg-red-50 dark:bg-red-900/20 dark:text-red-400 rounded-lg border border-red-200 dark:border-red-800">
                                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm font-medium">{{ $message }}</span>
                                </div>
                @enderror
            </div>

                            <!-- Payment Type -->
                            <div class="space-y-2">
                                <label for="payment_type" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                        </svg>
                                        {{ __('Payment Type') }} 
                                        <span class="text-red-500 ml-1">*</span>
                                    </span>
                                </label>
                                <div class="relative group">
                                    <select name="payment_type" id="payment_type" required
                                            class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 appearance-none hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md change-highlight">
                                        <option value="hourly" {{ $project->payment_type == 'hourly' ? 'selected' : '' }}>⏰ {{ __('Hourly Based') }}</option>
                                        <option value="fixed" {{ $project->payment_type == 'fixed' ? 'selected' : '' }}>💰 {{ __('Fixed Price') }}</option>
                                        <option value="non" {{ $project->payment_type == 'non' ? 'selected' : '' }}>🚫 {{ __('Non Billable') }}</option>
                </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400 transition-colors duration-200 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                </div>
            </div>

            <!-- Hourly Budget -->
                            <div id="hourly" class="space-y-2">
                                <label for="hr_budget" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ __('Per-Hour Rate ($)') }}
                                    </span>
                                </label>
                                <div class="relative group">
                                    <input type="number" name="hr_budget" id="hr_budget" step="0.01"
                                           value="{{ old('hr_budget') ?? $project->hr_budget }}"
                                           class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md change-highlight"
                                           placeholder="0.00" />
                                </div>
                @error('hr_budget')
                                <div class="flex items-center mt-2 p-3 text-red-700 bg-red-50 dark:bg-red-900/20 dark:text-red-400 rounded-lg border border-red-200 dark:border-red-800">
                                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm font-medium">{{ $message }}</span>
                                </div>
                @enderror
            </div>

            <!-- Fixed Budget -->
                            <div id="fixed" class="space-y-2 hidden">
                                <label for="fixed_budget" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                        {{ __('Total Project Budget ($)') }}
                                    </span>
                                </label>
                                <div class="relative group">
                                    <input type="number" name="fixed_budget" id="fixed_budget" step="0.01"
                                           value="{{ old('fixed_budget') ?? $project->fixed_budget }}"
                                           class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md change-highlight"
                                           placeholder="0.00" />
                                </div>
                @error('fixed_budget')
                                <div class="flex items-center mt-2 p-3 text-red-700 bg-red-50 dark:bg-red-900/20 dark:text-red-400 rounded-lg border border-red-200 dark:border-red-800">
                                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm font-medium">{{ $message }}</span>
                                </div>
                @enderror
            </div>

                            <!-- Total Cost -->
                            <div class="space-y-2">
                                <label for="total_cost" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                        {{ __('Total Cost ($)') }}
                                    </span>
                                </label>
                                <div class="relative group">
                                    <input type="number" name="total_cost" id="total_cost" step="0.01"
                                           value="{{ old('total_cost') ?? $project->total_cost }}"
                                           class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md change-highlight"
                                           placeholder="0.00" />
                                </div>
                            </div>

                            <!-- Total Paid Client -->
                            <div class="space-y-2">
                                <label for="total_paid_client" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                        </svg>
                                        {{ __('Total Paid by Client ($)') }}
                                    </span>
                                </label>
                                <div class="relative group">
                                    <input type="number" name="total_paid_client" id="total_paid_client" step="0.01"
                                           value="{{ old('total_paid_client') ?? $project->total_paid_client }}"
                                           class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md change-highlight"
                                           placeholder="0.00" />
                                </div>
                            </div>
                        </div>
            </div>

                    <!-- Help Text Section -->
                    <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl p-6 mt-8">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-semibold text-green-800 dark:text-green-300 mb-2">
                                    {{ __('Project Update Information') }}
                                </h3>
                                <p class="text-sm text-green-700 dark:text-green-400">
                                    {{ __('When editing a project, be careful with payment type changes as this affects billing calculations. Modified fields will be highlighted in green. Review all changes before saving.') }}
                                </p>
                            </div>
                        </div>
            </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-between pt-8 border-t border-gray-200 dark:border-gray-600 space-y-4 sm:space-y-0">
                        <a href="{{ route('project.index') }}" 
                           class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl text-sm font-semibold text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-200 hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            {{ __('Cancel') }}
                        </a>
                        
                        <button type="submit" id="submitBtn"
                                class="w-full sm:w-auto group inline-flex items-center justify-center px-10 py-4 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold rounded-xl transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-green-500/50 backdrop-blur-sm disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                            <div class="flex items-center justify-center w-6 h-6 bg-white/20 rounded-lg mr-3">
                                <svg class="w-4 h-4 transition-transform duration-200 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </div>
                            <span class="submit-text">{{ __('Update Project') }}</span>
                            <div class="loading-spinner hidden ml-3">
                                <svg class="animate-spin w-5 h-5 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </div>
                            <svg class="w-5 h-5 ml-3 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5-5 5M6 12h12"></path>
                            </svg>
                </button>
            </div>
        </form>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Enhanced JavaScript for Edit Page -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
    console.log('Project Edit Page Loaded');
    
    // Get form elements
    const form = document.getElementById('projectEditForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = submitBtn.querySelector('.submit-text');
    const loadingSpinner = submitBtn.querySelector('.loading-spinner');
    
    // Form field elements
        let employerSelect = document.getElementById('employer_id');
        let clientSelect = document.getElementById('client_id');
        let employeeSelect = document.getElementById('employee_id');
        let paymentTypeSelect = document.getElementById('payment_type');
        let hourlyBudgetDiv = document.getElementById('hourly');
        let fixedBudgetDiv = document.getElementById('fixed');

    // Store original values for change tracking
    const originalValues = {};
    const formInputs = form.querySelectorAll('input, select, textarea');
    formInputs.forEach(input => {
        originalValues[input.name] = input.value;
    });

    console.log('Original values stored:', originalValues);

    // Get CSRF token
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Change tracking functionality
    function trackChanges() {
        formInputs.forEach(input => {
            const currentValue = input.value;
            const originalValue = originalValues[input.name] || '';
            
            if (currentValue !== originalValue) {
                input.classList.add('border-green-400', 'bg-green-50', 'dark:bg-green-900/20');
                input.classList.remove('border-gray-300', 'dark:border-gray-600');
            } else {
                input.classList.remove('border-green-400', 'bg-green-50', 'dark:bg-green-900/20');
                input.classList.add('border-gray-300', 'dark:border-gray-600');
            }
        });
    }

    // Add change listeners to all form inputs
    formInputs.forEach(input => {
        input.addEventListener('input', trackChanges);
        input.addEventListener('change', trackChanges);
    });

    // Auto-focus first field
    const firstInput = form.querySelector('input[type="text"], input[type="email"], select');
    if (firstInput) {
        setTimeout(() => firstInput.focus(), 100);
    }

    // Form validation
    function validateForm() {
        let isValid = true;
        const requiredFields = form.querySelectorAll('[required]');
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('border-red-500', 'bg-red-50', 'dark:bg-red-900/20');
                isValid = false;
            } else {
                field.classList.remove('border-red-500', 'bg-red-50', 'dark:bg-red-900/20');
            }
        });
        
        return isValid;
    }

    // Enhanced form submission with loading state
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!validateForm()) {
            alert('Please fill in all required fields.');
            return;
        }
        
        // Show loading state
        submitBtn.disabled = true;
        submitText.textContent = 'Updating...';
        loadingSpinner.classList.remove('hidden');
        
        // Simulate processing time (remove in production)
        setTimeout(() => {
            form.submit();
        }, 1000);
    });

    // Employer change handler (if exists)
        if (employerSelect) {
        employerSelect.addEventListener('change', function() {
            const employerId = this.value;
            console.log('Employer changed to:', employerId);

            // Clear dependent dropdowns
                if (clientSelect) {
                clientSelect.innerHTML = '<option value="" disabled selected>{{ __("Loading clients...") }}</option>';
                }
                if (employeeSelect) {
                employeeSelect.innerHTML = '<option value="" disabled selected>{{ __("Loading employees...") }}</option>';
                }

                if (employerId) {
                    // Fetch clients
                    fetch(`/get/client/${employerId}`, {
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json'
                        },
                        credentials: 'same-origin'
                    })
                        .then(response => {
                    if (!response.ok) throw new Error('Failed to fetch clients');
                            return response.json();
                        })
                        .then(data => {
                            if (clientSelect) {
                        clientSelect.innerHTML = '<option value="" disabled selected>{{ __("Select Client...") }}</option>';
                                data.forEach(client => {
                            const option = document.createElement('option');
                            option.value = client.id;
                            option.textContent = client.client_name;
                            clientSelect.appendChild(option);
                        });
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching clients:', error);
                    if (clientSelect) {
                        clientSelect.innerHTML = '<option value="" disabled selected>{{ __("Error loading clients") }}</option>';
                    }
                        });

                    // Fetch employees
                    fetch(`/get/employee/${employerId}`, {
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json'
                        },
                        credentials: 'same-origin'
                    })
                        .then(response => {
                    if (!response.ok) throw new Error('Failed to fetch employees');
                            return response.json();
                        })
                        .then(data => {
                            if (employeeSelect) {
                        employeeSelect.innerHTML = '<option value="" disabled selected>{{ __("Select Employee...") }}</option>';
                                data.forEach(employee => {
                            const option = document.createElement('option');
                            option.value = employee.id;
                            option.textContent = employee.employee_name;
                            employeeSelect.appendChild(option);
                        });
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching employees:', error);
                    if (employeeSelect) {
                        employeeSelect.innerHTML = '<option value="" disabled selected>{{ __("Error loading employees") }}</option>';
                    }
                        });
                }
            });
        }

    // Payment type change handler
        if (paymentTypeSelect) {
        paymentTypeSelect.addEventListener('change', function() {
            togglePaymentFields(this.value);
            });

        // Initial setup
        togglePaymentFields(paymentTypeSelect.value);
        }

        function togglePaymentFields(paymentType) {
            if (paymentType === 'hourly') {
            if (hourlyBudgetDiv) {
                hourlyBudgetDiv.classList.remove('hidden');
                hourlyBudgetDiv.style.display = 'block';
            }
            if (fixedBudgetDiv) {
                fixedBudgetDiv.classList.add('hidden');
                fixedBudgetDiv.style.display = 'none';
            }
            } else if (paymentType === 'fixed') {
            if (hourlyBudgetDiv) {
                hourlyBudgetDiv.classList.add('hidden');
                hourlyBudgetDiv.style.display = 'none';
            }
            if (fixedBudgetDiv) {
                fixedBudgetDiv.classList.remove('hidden');
                fixedBudgetDiv.style.display = 'block';
            }
            } else {
            // Non-billable
            if (hourlyBudgetDiv) {
                hourlyBudgetDiv.classList.add('hidden');
                hourlyBudgetDiv.style.display = 'none';
            }
            if (fixedBudgetDiv) {
                fixedBudgetDiv.classList.add('hidden');
                fixedBudgetDiv.style.display = 'none';
            }
        }
    }

    // Add enhanced visual feedback
    formInputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('ring-2', 'ring-green-500/20');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('ring-2', 'ring-green-500/20');
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
            const cancelBtn = document.querySelector('a[href*="project.index"]');
            if (cancelBtn && confirm('Are you sure you want to cancel? Any unsaved changes will be lost.')) {
                window.location.href = cancelBtn.href;
            }
        }
    });

    console.log('Project Edit Page JavaScript initialized successfully');
    });
</script>

<!-- Add CSS for change highlighting -->
<style>
.change-highlight {
    transition: all 0.3s ease;
}

.change-highlight:focus {
    transform: translateY(-1px);
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

/* Enhanced hover effects */
.group:hover .group-hover\:shadow-md {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

/* Loading animation */
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.loading-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
</style>
