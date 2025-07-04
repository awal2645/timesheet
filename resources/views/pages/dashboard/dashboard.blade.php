@section('title', 'Dashboard')

<x-app-layout>
    <head>
        <!-- Add Slick Carousel CSS -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    </head>

    <!-- Main Dashboard Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Enhanced Welcome Banner -->
        <div class="relative bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 dark:from-slate-800 dark:via-slate-700 dark:to-slate-600 rounded-3xl shadow-2xl border border-gray-200 dark:border-gray-600 p-8 mb-8 overflow-hidden">
            
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute right-0 top-0 -mt-4 me-16 pointer-events-none hidden xl:block" aria-hidden="true">
                    <svg width="319" height="198" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <defs>
                            <path id="welcome-a" d="M64 0l64 128-64-20-64 20z" />
                            <path id="welcome-e" d="M40 0l40 80-40-12.5L0 80z" />
                            <path id="welcome-g" d="M40 0l40 80-40-12.5L0 80z" />
                            <linearGradient x1="50%" y1="0%" x2="50%" y2="100%" id="welcome-b">
                                <stop stop-color="#A5B4FC" offset="0%" />
                                <stop stop-color="#818CF8" offset="100%" />
                            </linearGradient>
                            <linearGradient x1="50%" y1="24.537%" x2="50%" y2="100%" id="welcome-c">
                                <stop stop-color="#4338CA" offset="0%" />
                                <stop stop-color="#6366F1" stop-opacity="0" offset="100%" />
                            </linearGradient>
                        </defs>
                        <g fill="none" fill-rule="evenodd">
                            <g transform="rotate(64 36.592 105.604)">
                                <mask id="welcome-d" fill="#fff">
                                    <use xlink:href="#welcome-a" />
                                </mask>
                                <use fill="url(#welcome-b)" xlink:href="#welcome-a" />
                                <path fill="url(#welcome-c)" mask="url(#welcome-d)" d="M64-24h80v152H64z" />
                            </g>
                            <g transform="rotate(-51 91.324 -105.372)">
                                <mask id="welcome-f" fill="#fff">
                                    <use xlink:href="#welcome-e" />
                                </mask>
                                <use fill="url(#welcome-b)" xlink:href="#welcome-e" />
                                <path fill="url(#welcome-c)" mask="url(#welcome-f)" d="M40.333-15.147h50v95h-50z" />
                            </g>
                            <g transform="rotate(44 61.546 392.623)">
                                <mask id="welcome-h" fill="#fff">
                                    <use xlink:href="#welcome-g" />
                                </mask>
                                <use fill="url(#welcome-b)" xlink:href="#welcome-g" />
                                <path fill="url(#welcome-c)" mask="url(#welcome-h)" d="M40.333-15.147h50v95h-50z" />
                            </g>
                        </g>
                    </svg>
                </div>
            </div>

            <!-- Welcome Content -->
            <div class="relative z-10">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6H8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/>
                        </svg>
                    </div>
                    <h1 id="greeting" class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 bg-clip-text text-transparent">
                        Loading...
                    </h1>
                </div>
                
                @if (auth('web')->user()->role == 'employee')
                    <div class="bg-white/10 dark:bg-gray-800/30 backdrop-blur-sm rounded-xl p-6 border border-white/20 dark:border-gray-600/30">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2v0"/>
                            </svg>
                            {{ __('Your Employment Details') }}
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-white/20 dark:bg-gray-700/30 rounded-lg p-4">
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">{{ __('Employer Name') }}</p>
                                <p class="font-semibold text-gray-800 dark:text-gray-200">{{ auth('web')->user()->employee->employer->employer_name }}</p>
                            </div>
                            <div class="bg-white/20 dark:bg-gray-700/30 rounded-lg p-4">
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">{{ __('Employer Email') }}</p>
                                <p class="font-semibold text-gray-800 dark:text-gray-200">{{ auth('web')->user()->employee->employer->user->email }}</p>
                            </div>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 mt-4">{{ __('Here is what\'s happening with your projects today') }}</p>
                    </div>
                @else
                    <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl">
                        {{ __('Welcome to your dashboard! Here\'s an overview of your recent activity and important updates.') }}
                    </p>
                @endif
            </div>
        </div>

        <!-- Dashboard Cards Grid -->
        <div class="grid grid-cols-12 gap-6 mb-8">
            <!-- Line chart (Acme Plus) -->
            <x-dashboard.dashboard-card-01 />

            <!-- Line chart (Acme Advanced) -->
            <x-dashboard.dashboard-card-02 />

            <!-- Line chart (Acme Professional) -->
            <x-dashboard.dashboard-card-03 />

            <!-- Enhanced Monthly Earnings Chart -->
            @if (auth()->user()->role != 'client' && auth()->user()->role != 'employee')
            <div class="col-span-12 xl:col-span-6">
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 p-6 h-full">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                                <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                    </svg>
                                </div>
                                {{ __('Monthly Earnings') }}
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Revenue trends over the year') }}</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            <span class="text-sm text-gray-600 dark:text-gray-400">{{ __('Live Data') }}</span>
                        </div>
                    </div>
                    <div style="height: 320px;">
                        <canvas id="monthlyChart"></canvas>
                    </div>
                </div>
            </div>
            @endif

            <!-- Enhanced Task Distribution Chart -->
            <div class="col-span-12 xl:col-span-6">
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 p-6 h-full">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                                <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                </div>
                                {{ __('Task Distribution') }}
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Current task status breakdown') }}</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-blue-500 rounded-full animate-pulse"></div>
                            <span class="text-sm text-gray-600 dark:text-gray-400">{{ __('Real-time') }}</span>
                        </div>
                    </div>
                    <div style="height: 320px;">
                        <canvas id="taskChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Notice Board -->
        @canany('Notice view')
        <div class="mb-8">
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <!-- Notice Board Header -->
                <div class="bg-gradient-to-r from-indigo-50 to-blue-50 dark:from-slate-700 dark:to-slate-600 px-8 py-6 border-b border-gray-200 dark:border-gray-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                                <div class="w-8 h-8 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                                    </svg>
                                </div>
                                {{ __('Notice Board') }}
                            </h3>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Latest announcements and important updates') }}
                            </p>
                        </div>
                        <div class="hidden md:flex items-center space-x-3">
                            <div class="flex items-center space-x-2 text-sm text-gray-500">
                                <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                                <span>{{ __('Auto-scroll active') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notice Content -->
                <div class="p-8">
                    <div class="notice-carousel-container relative">
                        <div class="notice-carosel">
                            @forelse (notice() as $notice)
                            <div class="mx-3">
                                <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-gray-200 dark:border-gray-600 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 h-full">
                                    <!-- Notice Header -->
                                    <div class="flex justify-between items-start mb-4">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-blue-600 rounded-lg flex items-center justify-center mr-3">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-gray-900 dark:text-white text-lg">
                                                    {{ $notice->title }}
                                                </h4>
                                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $notice->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Notice Content -->
                                    <p class="text-gray-700 dark:text-gray-300 mb-4 leading-relaxed line-clamp-3">
                                        {{ $notice->content }}
                                    </p>
                                    
                                    <!-- Notice Footer -->
                                    <div class="flex items-center justify-between">
                                        <div class="flex flex-wrap gap-2">
                                            @php
                                            $noticeRoles = explode(',', $notice->role);
                                            $rolesList = [];
                                            @endphp
                                            @foreach (roles() as $role)
                                                @if (in_array($role->id, $noticeRoles))
                                                    @php $rolesList[] = ucfirst($role->name); @endphp
                                                @endif
                                            @endforeach
                                            @foreach(array_slice($rolesList, 0, 2) as $role)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-300">
                                                    {{ $role }}
                                                </span>
                                            @endforeach
                                            @if(count($rolesList) > 2)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                                    +{{ count($rolesList) - 2 }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="flex items-center text-gray-400">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-span-full">
                                <div class="text-center py-12">
                                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5-5-5h5v-12"/>
                                        </svg>
                                    </div>
                                    <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">{{ __('No notices found') }}</p>
                                    <p class="text-gray-400 dark:text-gray-500 text-sm mt-2">{{ __('Check back later for updates and announcements') }}</p>
                                </div>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcanany

        <!-- Enhanced Recent Invoice Section -->
        @if (auth()->user()->role != 'employee' && auth()->user()->role != 'client')
        <div class="mb-8">
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <!-- Invoice Header -->
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-slate-700 dark:to-slate-600 px-8 py-6 border-b border-gray-200 dark:border-gray-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                                <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                {{ __('Recent Invoices') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Latest payment transactions and billing information') }}
                            </p>
                        </div>
                        <div class="hidden md:flex items-center space-x-4">
                            <div class="text-center">
                                <div class="text-lg font-bold text-green-600 dark:text-green-400">{{ $transactions->count() }}</div>
                                <div class="text-xs text-gray-500">{{ __('Recent') }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Invoice Table -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 dark:bg-gray-900">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <span>{{ __('Invoice Number') }}</span>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Date') }}</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Plan Name') }}</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Employer') }}</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Amount') }}</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Gateway') }}</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Status') }}</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($transactions as $transaction)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10">
                                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">#{{ $transaction->order_id }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('Order ID') }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ formatTime($transaction->created_at, 'M d, Y') }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ formatTime($transaction->created_at, 'g:i A') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($transaction->payment_type == 'per_job_based')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2v0"/>
                                            </svg>
                                            {{ ucfirst(Str::replace('_', ' ', $transaction->payment_type)) }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                            </svg>
                                            {{ $transaction->plan->label }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ ucfirst($transaction->employer->employer_name) ?? '' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-lg font-bold text-green-600 dark:text-green-400">${{ number_format($transaction->usd_amount, 2) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center mr-2">
                                            <svg class="w-4 h-4 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                            </svg>
                                        </div>
                                        <span class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $transaction->payment_provider == 'offline' ? __('Offline') . (optional($transaction->manualPayment)->name ? " ({$transaction->manualPayment->name})" : '') : ucfirst($transaction->payment_provider) }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $transaction->payment_status == 'paid' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300' }}">
                                        <div class="w-2 h-2 rounded-full mr-2 {{ $transaction->payment_status == 'paid' ? 'bg-green-500' : 'bg-yellow-500' }}"></div>
                                        {{ $transaction->payment_status == 'paid' ? __('Paid') : __('Unpaid') }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </div>
                                        <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">{{ __('No invoices found') }}</p>
                                        <p class="text-gray-400 dark:text-gray-500 text-sm mt-2">{{ __('Recent transactions will appear here') }}</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($transactions->total() > $transactions->count())
                <div class="bg-gray-50 dark:bg-gray-900 px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-center">
                        {{ $transactions->links() }}
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>

    <!-- Enhanced JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        // Enhanced greeting system
        function updateGreeting() {
            const currentHour = new Date().getHours();
            const greetingElement = document.getElementById('greeting');
            const username = "{{ auth('web')->user()->username }}";
            
            let greeting, icon;
            if (currentHour >= 5 && currentHour < 12) {
                greeting = `{{ __('Good morning') }}, ${username}`;
                icon = '🌅';
            } else if (currentHour >= 12 && currentHour < 18) {
                greeting = `{{ __('Good afternoon') }}, ${username}`;
                icon = '☀️';
            } else {
                greeting = `{{ __('Good evening') }}, ${username}`;
                icon = '🌙';
            }
            
            greetingElement.innerHTML = `${greeting} <span class="text-2xl">${icon}</span>`;
        }

        // Chart initialization with enhanced styling
        document.addEventListener('DOMContentLoaded', function() {
            updateGreeting();

            // Enhanced Monthly Chart
            const monthlyChartElement = document.getElementById('monthlyChart');
            if (monthlyChartElement) {
                const monthlyCtx = monthlyChartElement.getContext('2d');
                new Chart(monthlyCtx, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        datasets: [{
                            label: '{{ __('Monthly Earnings') }}',
                            data: [
                                {{ earnings()->get(1) ?? 0 }},
                                {{ earnings()->get(2) ?? 0 }},
                                {{ earnings()->get(3) ?? 0 }},
                                {{ earnings()->get(4) ?? 0 }},
                                {{ earnings()->get(5) ?? 0 }},
                                {{ earnings()->get(6) ?? 0 }},
                                {{ earnings()->get(7) ?? 0 }},
                                {{ earnings()->get(8) ?? 0 }},
                                {{ earnings()->get(9) ?? 0 }},
                                {{ earnings()->get(10) ?? 0 }},
                                {{ earnings()->get(11) ?? 0 }},
                                {{ earnings()->get(12) ?? 0 }}
                            ],
                            borderColor: 'rgb(34, 197, 94)',
                            backgroundColor: 'rgba(34, 197, 94, 0.1)',
                            tension: 0.4,
                            fill: true,
                            pointBackgroundColor: 'rgb(34, 197, 94)',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 6,
                            pointHoverRadius: 8
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                titleColor: '#fff',
                                bodyColor: '#fff',
                                borderColor: 'rgb(34, 197, 94)',
                                borderWidth: 1,
                                cornerRadius: 8,
                                displayColors: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: document.documentElement.classList.contains('dark') ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)',
                                    borderDash: [5, 5]
                                },
                                ticks: {
                                    color: document.documentElement.classList.contains('dark') ? '#9CA3AF' : '#6B7280',
                                    callback: function(value) {
                                        return '$' + value;
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    color: document.documentElement.classList.contains('dark') ? '#9CA3AF' : '#6B7280'
                                }
                            }
                        }
                    }
                });
            }

            // Enhanced Task Chart
            const taskChartElement = document.getElementById('taskChart');
            if (taskChartElement) {
                const taskCtx = taskChartElement.getContext('2d');
                new Chart(taskCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['{{ __('Completed') }}', '{{ __('In Progress') }}', '{{ __('Pending') }}'],
                        datasets: [{
                            data: [
                                {{ auth()->user()->role == 'client' ? taskCount('completed') : tasks()->where('status', 'completed')->count() }},
                                {{ auth()->user()->role == 'client' ? taskCount('inprogress') : tasks()->where('status', 'inprogress')->count() }},
                                {{ auth()->user()->role == 'client' ? taskCount('pending') : tasks()->where('status', 'pending')->count() }}
                            ],
                            backgroundColor: [
                                'rgb(34, 197, 94)',
                                'rgb(59, 130, 246)',
                                'rgb(239, 68, 68)'
                            ],
                            borderWidth: 0,
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '70%',
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    color: document.documentElement.classList.contains('dark') ? '#F3F4F6' : '#374151',
                                    padding: 20,
                                    usePointStyle: true,
                                    pointStyle: 'circle'
                                }
                            },
                            tooltip: {
                                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                titleColor: '#fff',
                                bodyColor: '#fff',
                                borderWidth: 1,
                                cornerRadius: 8,
                                displayColors: true
                            }
                        }
                    }
                });
            }

            // Enhanced Notice Carousel
            $('.notice-carosel').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
                pauseOnHover: true,
                pauseOnFocus: true,
                arrows: true,
                dots: true,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            arrows: false
                        }
                    }
                ]
            });

            // Add smooth entrance animations
            const cards = document.querySelectorAll('.bg-white, .bg-gradient-to-br');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</x-app-layout>