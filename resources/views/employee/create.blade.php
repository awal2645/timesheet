@section('title')
{{ __('Create Employee') }}
@endsection

<x-app-layout>
    <!-- Breadcrumb Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 mt-6">
        <x-breadcrumb :items="[
            [
                'label' => __('Employees'),
                'url' => route('employee.index'),
                'icon' => true
            ],
            [
                'label' => __('Create Employee'),
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
                            <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            {{ __('Employee Information') }}
                        </h2>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Complete all required fields to register a new employee. Fields marked with * are mandatory.') }}
                        </p>
                    </div>
                    
                    <!-- Form Progress -->
                    <div class="hidden md:flex items-center space-x-2">
                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('Required fields') }}</div>
                        <div class="w-2 h-2 bg-red-400 rounded-full"></div>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <div class="p-8">
                <form method="POST" action="{{ route('employee.store') }}" class="space-y-8" id="employeeForm">
            @csrf
                    
                    <!-- Basic Information Section -->
                    <div class="space-y-6">
                        <div class="border-b border-gray-200 dark:border-gray-600 pb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ __('Basic Information') }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ __('Essential employee details and contact information') }}</p>
                        </div>

                        <!-- Form Grid - Basic Info -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Employee Name -->
                            <div class="space-y-2">
                                <label for="employee_name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                        {{ __('Employee Name') }}
                                        <span class="text-red-500 ml-1">*</span>
                                    </span>
                    </label>
                                <div class="relative group">
                                    <input type="text" name="employee_name" id="employee_name" required
                                           value="{{ old('employee_name') }}"
                                           class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md"
                                           placeholder="Enter employee full name..." />
                                </div>
                    @error('employee_name')
                                <div class="flex items-center mt-2 p-3 text-red-700 bg-red-50 dark:bg-red-900/20 dark:text-red-400 rounded-lg border border-red-200 dark:border-red-800">
                                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm font-medium">{{ $message }}</span>
                                </div>
                    @enderror
                </div>

                <!-- Employee Email -->
                            <div class="space-y-2">
                                <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                        {{ __('Email Address') }} 
                                        <span class="text-red-500 ml-1">*</span>
                                    </span>
                                </label>
                                <div class="relative group">
                                    <input type="email" name="email" id="email" required
                                           value="{{ old('email') }}"
                                           class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md"
                                           placeholder="employee@company.com" />
                                </div>
                    @error('email')
                                <div class="flex items-center mt-2 p-3 text-red-700 bg-red-50 dark:bg-red-900/20 dark:text-red-400 rounded-lg border border-red-200 dark:border-red-800">
                                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm font-medium">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div class="space-y-2">
                                <label for="phone" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                        {{ __('Phone Number') }}
                                    </span>
                                </label>
                                <div class="relative group">
                                    <input type="text" name="phone" id="phone"
                                           value="{{ old('phone') }}"
                                           class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md"
                                           placeholder="+1 (555) 123-4567" />
                                </div>
                                @error('phone')
                                <div class="flex items-center mt-2 p-3 text-red-700 bg-red-50 dark:bg-red-900/20 dark:text-red-400 rounded-lg border border-red-200 dark:border-red-800">
                                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm font-medium">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>

                            <!-- Gender -->
                            <div class="space-y-2">
                                <label for="gender_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        {{ __('Gender') }}
                                    </span>
                                </label>
                                <div class="relative group">
                                    <select name="gender" id="gender_id" 
                                            class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 appearance-none hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md">
                                        <option value="male">👨 {{ __('Male') }}</option>
                                        <option value="female">👩 {{ __('Female') }}</option>
                                        <option value="other">🧑 {{ __('Other') }}</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400 transition-colors duration-200 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                </div>
                                @error('gender')
                                <div class="flex items-center mt-2 p-3 text-red-700 bg-red-50 dark:bg-red-900/20 dark:text-red-400 rounded-lg border border-red-200 dark:border-red-800">
                                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm font-medium">{{ $message }}</span>
                                </div>
                    @enderror
                </div>
    
                            <!-- Total Leave -->
                            <div class="space-y-2">
                                <label for="total_leave" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0a2 2 0 00-2 2v6a2 2 0 002 2h8a2 2 0 002-2V9a2 2 0 00-2-2H8z"/>
                                        </svg>
                                        {{ __('Total Leave Days') }}
                                    </span>
                                </label>
                                <div class="relative group">
                                    <input type="number" name="total_leave" id="total_leave"
                                           value="{{ old('total_leave') }}"
                                           class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md"
                                           placeholder="Enter total leave days..." />
                                </div>
                                @error('total_leave')
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

                    <!-- Employer & Client Information -->
                    <div class="space-y-6">
                        <div class="border-b border-gray-200 dark:border-gray-600 pb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                {{ __('Employer & Client Information') }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ __('Associate employee with employer and client') }}</p>
                        </div>

                        <!-- Form Grid - Employer & Client -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Employer Name -->
                @if (auth('web')->user()->role != 'employer')
                            <div class="space-y-2">
                                <label for="employer_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                        {{ __('Employer') }}
                                    </span>
                                </label>
                                <div class="relative group">
                                    <select name="employer_id" id="employer_id" 
                                            class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 appearance-none hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md">
                                        <option value="" disabled selected>{{ __('Select Employer...') }}</option>
                        @foreach ($employers as $employer)
                                        <option value="{{ $employer->id }}">{{ $employer->employer_name }}</option>
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
                @endif
                @if (auth('web')->user()->role == 'employer')
                <input type="hidden" name="employer_id" value="{{ auth('web')->user()->employer->id }}">
                @endif

                <!-- Client -->
                            <div class="space-y-2">
                                <label for="client_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                        {{ __('Client') }}
                                    </span>
                                </label>
                                <div class="relative group">
                                    <select name="client_id" id="client_id" 
                                            class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 appearance-none hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md">
                                        <option value="" disabled selected>{{ __('Select Client...') }}</option>
                        @if (auth('web')->user()->role == 'employer')
                            @foreach ($clients as $client)
                                            <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                            @endforeach
                        @endif
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
                        </div>
                </div>

                    <!-- Payment Information -->
                    <div class="space-y-6">
                        <div class="border-b border-gray-200 dark:border-gray-600 pb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                </svg>
                                {{ __('Payment Information') }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ __('Configure employee compensation and billing details') }}</p>
                </div>

                        <!-- Form Grid - Payment Info -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Payment Type -->
                            <div class="space-y-2">
                                <label for="payment_type" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                        </svg>
                                        {{ __('Payment Type') }}
                                    </span>
                                </label>
                                <div class="relative group">
                                    <select name="payment_type" id="payment_type" 
                                            class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 appearance-none hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md">
                                        <option value="" disabled selected>{{ __('Select Payment Type...') }}</option>
                                        <option value="monthly" {{ 'monthly' == old('payment_type') ? 'selected' : '' }}>
                                            💰 {{ __('Monthly Salary') }}
                        </option>
                                        <option value="project" {{ 'project' == old('payment_type') ? 'selected' : '' }}>
                                            📊 {{ __('Project Based') }}
                        </option>
                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400 transition-colors duration-200 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                </div>
                    @error('payment_type')
                                <div class="flex items-center mt-2 p-3 text-red-700 bg-red-50 dark:bg-red-900/20 dark:text-red-400 rounded-lg border border-red-200 dark:border-red-800">
                                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm font-medium">{{ $message }}</span>
                                </div>
                    @enderror
                </div>

                            <!-- Monthly Salary (visible if monthly selected) -->
                            <div id="monthly_salary_field" class="space-y-2">
                                <label for="monthly_salary" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                        </svg>
                                        {{ __('Monthly Salary ($)') }}
                                    </span>
                    </label>
                                <div class="relative group">
                                    <input type="number" step="0.01" name="monthly_salary" id="monthly_salary"
                                           value="{{ old('monthly_salary') }}"
                                           class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md"
                                           placeholder="Enter monthly salary..." />
                                </div>
                    @error('monthly_salary')
                                <div class="flex items-center mt-2 p-3 text-red-700 bg-red-50 dark:bg-red-900/20 dark:text-red-400 rounded-lg border border-red-200 dark:border-red-800">
                                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm font-medium">{{ $message }}</span>
                                </div>
                    @enderror
                            </div>
                </div>

                <!-- Project Details (visible if project based selected) -->
                        <div id="project_details_field" style="display: none;" class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Employee Share -->
                            <div class="space-y-2">
                                <label for="employee_share" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                        </svg>
                            {{ __('Employee Share (%)') }}
                                    </span>
                        </label>
                                <div class="relative group">
                                    <input type="number" name="employee_share" id="employee_share"
                                           value="{{ old('employee_share') }}" min="0" max="100" step="0.01"
                                           class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md"
                                           placeholder="Enter employee share percentage..." />
                                </div>
                        @error('employee_share')
                                <div class="flex items-center mt-2 p-3 text-red-700 bg-red-50 dark:bg-red-900/20 dark:text-red-400 rounded-lg border border-red-200 dark:border-red-800">
                                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm font-medium">{{ $message }}</span>
                                </div>
                        @enderror
                    </div>

                    <!-- Billing Rate -->
                            <div class="space-y-2">
                                <label for="billing_rate" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ __('Billing Rate Per Hour ($)') }}
                                    </span>
                        </label>
                                <div class="relative group">
                                    <input type="number" step="0.01" name="billing_rate" id="billing_rate"
                                           value="{{ old('billing_rate') }}"
                                           class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md"
                                           placeholder="Enter hourly billing rate..." />
                                </div>
                        @error('billing_rate')
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

                    <!-- Help Text Section -->
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-6 mt-8">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-semibold text-blue-800 dark:text-blue-300 mb-2">
                                    {{ __('Important Information') }}
                                </h3>
                                <p class="text-sm text-blue-700 dark:text-blue-400">
                                    {{ __('Make sure to select the correct employer and payment type. The payment details will affect how the employee is compensated and billed to clients. Choose "Monthly Salary" for fixed monthly compensation or "Project Based" for hourly billing with shared revenue.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-between pt-8 border-t border-gray-200 dark:border-gray-600 space-y-4 sm:space-y-0">
                        <a href="{{ route('employee.index') }}" 
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <span class="submit-text">{{ __('Create Employee') }}</span>
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

    <!-- JavaScript for Enhanced UX -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM Content Loaded');
            
            const form = document.getElementById('employeeForm');
            const submitBtn = document.getElementById('submitBtn');
            const submitText = submitBtn ? submitBtn.querySelector('.submit-text') : null;
            const loadingSpinner = submitBtn ? submitBtn.querySelector('.loading-spinner') : null;
            
            let employerSelect = document.getElementById('employer_id');
            let clientSelect = document.getElementById('client_id');
            let paymentTypeSelect = document.getElementById('payment_type');
            let monthlySalaryField = document.getElementById('monthly_salary_field');
            let projectDetailsField = document.getElementById('project_details_field');

            console.log('Elements found:', {
                employerSelect: !!employerSelect,
                clientSelect: !!clientSelect,
                paymentTypeSelect: !!paymentTypeSelect,
                monthlySalaryField: !!monthlySalaryField,
                projectDetailsField: !!projectDetailsField
            });

            // Form submission with loading state
            if (form && submitBtn) {
                form.addEventListener('submit', function() {
                    submitBtn.disabled = true;
                    if (submitText) submitText.textContent = '{{ __("Creating Employee...") }}';
                    if (loadingSpinner) loadingSpinner.classList.remove('hidden');
                    submitBtn.classList.add('opacity-75');
                });
            }

            // Get CSRF token from meta tag
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Real-time form validation feedback
            const requiredFields = ['employee_name', 'email'];
            const allFields = ['employee_name', 'email', 'phone', 'total_leave', 'monthly_salary', 'employee_share', 'billing_rate'];
            
            allFields.forEach(fieldName => {
                const field = document.getElementById(fieldName);
                if (field) {
                    field.addEventListener('input', function() {
                        if (this.value) {
                            this.classList.remove('border-red-300', 'border-gray-300');
                            this.classList.add('border-green-300');
                        } else {
                            this.classList.remove('border-green-300');
                            this.classList.add('border-gray-300');
                        }
                });
            }
            });

            // Auto-focus first empty required field
            const firstEmptyField = requiredFields.find(fieldName => {
                const field = document.getElementById(fieldName);
                return field && !field.value;
            });
            
            if (firstEmptyField) {
                document.getElementById(firstEmptyField).focus();
            }

            // Handle employer change for client loading
            if (employerSelect) {
                console.log('Adding employer change listener');
                employerSelect.addEventListener('change', function() {
                    const employerId = this.value;
                    console.log('Employer selected:', employerId);

                    // Clear previous options
                    if (clientSelect) {
                        clientSelect.innerHTML = '<option value="" disabled selected>{{ __("Select Client...") }}</option>';
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
                                if (!response.ok) {
                                    if (response.status === 401) {
                                        throw new Error('Unauthorized - Please log in');
                                    }
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                if (clientSelect) {
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
                                alert('Error loading clients. Please try again.');
                            });
                    }
                });
            }

            // Function to show/hide fields based on payment type
            function toggleFields() {
                if (paymentTypeSelect && monthlySalaryField && projectDetailsField) {
                if (paymentTypeSelect.value === 'monthly') {
                    monthlySalaryField.style.display = 'block';
                    projectDetailsField.style.display = 'none';
                } else if (paymentTypeSelect.value === 'project') {
                    monthlySalaryField.style.display = 'none';
                    projectDetailsField.style.display = 'block';
                } else {
                    monthlySalaryField.style.display = 'none';
                    projectDetailsField.style.display = 'none';
                    }
                }
            }

            // Initially toggle fields based on selected payment type
            toggleFields();

            // Listen for change events on the payment type select
            if (paymentTypeSelect) {
                paymentTypeSelect.addEventListener('change', function() {
                    toggleFields();
                });
            }

            // Format phone number input
            const phoneField = document.getElementById('phone');
            if (phoneField) {
                phoneField.addEventListener('input', function() {
                    let value = this.value.replace(/\D/g, '');
                    if (value.length >= 6) {
                        value = value.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
                    } else if (value.length >= 3) {
                        value = value.replace(/(\d{3})(\d{0,3})/, '($1) $2');
                    }
                    this.value = value;
                });
            }

            // Add validation hints
            const requiredInputs = document.querySelectorAll('input[required], select[required]');
            requiredInputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (!this.value) {
                        this.classList.add('border-red-300');
                        this.classList.remove('border-green-300');
                    }
                });
            });
        });
    </script>
</x-app-layout>