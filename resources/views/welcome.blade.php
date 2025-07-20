<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ langDirection() }}" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Timesheet') }} - {{ __('Time Tracking Tool') }}</title>
    @vite(['resources/css/app.css'])
    <link href="{{ asset('css/theme.css') }}?v={{ filemtime(public_path('css/theme.css')) }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo_symbol.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body >
    <header
        class="p-10 bg-card-dark dark:bg-card-dark inset-x-0 flex flex-wrap md:justify-start md:flex-nowrap z-50 w-full">
        <nav class="relative container px-4 xl:px-0 mx-auto w-full md:flex md:items-center md:justify-between"
            aria-label="Global">
            <div class="w-full flex items-center justify-between">
                <!-- Logo -->
                <a class="flex-none rounded-md text-2xl text-white inline-block font-semibold focus:outline-none focus:opacity-80"
                    href="/" aria-label="Timesheet">
                    <img src="{{ asset('images/logo-inv.png') }}" alt="Logo" class="w-48 h-auto">
                </a>
                <!-- End Logo -->
                <div>
                    <a class="group inline-flex items-center gap-x-2 py-2 bg-primary-50 font-medium text-sm text-text-light dark:text-text-dark rounded-md focus:outline-none px-5"
                        href="{{ route('login') }}" data-aos="fade-up">
                        {{ __('Login') }}
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="p-10 bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-700 relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-bl from-blue-400/20 to-transparent rounded-full -translate-y-32 translate-x-32"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-gradient-to-tr from-indigo-400/20 to-transparent rounded-full translate-y-32 -translate-x-32"></div>
            <div class="absolute top-1/2 left-1/2 w-32 h-32 bg-gradient-to-r from-purple-400/10 to-blue-400/10 rounded-full -translate-x-16 -translate-y-16"></div>
        </div>

        <div class="container px-4 xl:px-0 py-20 lg:py-32 mx-auto relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="space-y-8">
                    <!-- Feature Badge -->
                    <div class="inline-block" data-aos="fade-in">
                        <span class="inline-flex items-center rounded-full bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-2 text-sm font-semibold text-white shadow-lg">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            {{ __('Complete Business Solution') }}
                        </span>
                    </div>

                    <!-- Main Heading -->
                    <div class="space-y-4">
                        <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-gray-900 dark:text-white leading-tight" data-aos="fade-up">
                            <span class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                {{ __('Smart') }}
                            </span>
                            <br>
                            <span class="text-gray-900 dark:text-white">
                                {{ __('Timesheet') }}
                            </span>
                            <br>
                            <span class="text-gray-600 dark:text-gray-300 text-4xl md:text-5xl lg:text-6xl">
                                {{ __('Management') }}
                            </span>
                    </h1>
                        <p class="text-xl md:text-2xl text-gray-700 dark:text-gray-300 max-w-2xl leading-relaxed" data-aos="fade-up" data-aos-delay="100">
                            {{ __('The ultimate all-in-one platform for time tracking, employee management, project coordination, and business automation. Transform your workforce productivity today.') }}
                        </p>
                    </div>

                    <!-- Key Stats -->
                    <div class="grid grid-cols-3 gap-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-blue-600 dark:text-blue-400">10+</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">{{ __('Core Features') }}</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">1000+</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">{{ __('Happy Users') }}</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-purple-600 dark:text-purple-400">24/7</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">{{ __('Support') }}</div>
                        </div>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4" data-aos="fade-up" data-aos-delay="300">
                        <a href="/login" class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ __('Try Live Demo') }}
                        </a>
                        <a href="#features" class="inline-flex items-center justify-center px-8 py-4 bg-white dark:bg-gray-800 text-gray-900 dark:text-white font-semibold rounded-xl border-2 border-gray-200 dark:border-gray-600 hover:border-blue-500 dark:hover:border-blue-400 transition-all duration-300 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                            </svg>
                            {{ __('Explore Features') }}
                        </a>
                    </div>
                </div>

                <!-- Hero Image/Dashboard Preview -->
                <div class="relative" data-aos="fade-up" data-aos-delay="400">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl bg-white dark:bg-gray-800 p-4">
                        <!-- Dashboard Mock -->
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-gray-700 dark:to-gray-600 rounded-xl p-6">
                            <div class="flex items-center space-x-4 mb-6">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                    </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('Dashboard Overview') }}</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('Real-time insights') }}</p>
                                </div>
                            </div>
                            
                            <!-- Mock Stats Cards -->
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow-md">
                                    <div class="text-2xl font-bold text-green-600">156h</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">{{ __('This Week') }}</div>
                                </div>
                                <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow-md">
                                    <div class="text-2xl font-bold text-blue-600">23</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">{{ __('Active Projects') }}</div>
                                </div>
                            </div>

                            <!-- Mock Chart -->
                            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow-md">
                                <div class="h-24 bg-gradient-to-r from-blue-100 to-indigo-100 dark:from-blue-900/30 dark:to-indigo-900/30 rounded-md flex items-end justify-between px-2 pb-2">
                                    <div class="w-6 bg-blue-500 rounded-t" style="height: 60%"></div>
                                    <div class="w-6 bg-indigo-500 rounded-t" style="height: 80%"></div>
                                    <div class="w-6 bg-purple-500 rounded-t" style="height: 45%"></div>
                                    <div class="w-6 bg-blue-500 rounded-t" style="height: 90%"></div>
                                    <div class="w-6 bg-indigo-500 rounded-t" style="height: 70%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Floating Feature Icons -->
                    <div class="absolute -top-4 -right-4 w-16 h-16 bg-gradient-to-br from-green-400 to-emerald-500 rounded-xl flex items-center justify-center shadow-lg animate-bounce">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="absolute -bottom-4 -left-4 w-16 h-16 bg-gradient-to-br from-orange-400 to-red-500 rounded-xl flex items-center justify-center shadow-lg animate-pulse">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Trust Badge -->
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm py-12 border-t border-gray-200/50 dark:border-gray-600/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <p class="text-center text-gray-700 dark:text-gray-300 mb-8 text-lg font-semibold">{{ __('Trusted by 1000+ Organizations Worldwide') }}</p>
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-8 items-center opacity-60 hover:opacity-100 transition-opacity duration-300">
                    <div class="flex justify-center" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{ asset(cms()->client_image1) }}" alt="Client 1" class="h-12 w-auto object-contain filter grayscale hover:grayscale-0 transition-all duration-300">
                    </div>
                    <div class="flex justify-center" data-aos="fade-up" data-aos-delay="200">
                        <img src="{{ asset(cms()->client_image2) }}" alt="Client 2" class="h-12 w-auto object-contain filter grayscale hover:grayscale-0 transition-all duration-300">
                    </div>
                    <div class="flex justify-center" data-aos="fade-up" data-aos-delay="300">
                        <img src="{{ asset(cms()->client_image3) }}" alt="Client 3" class="h-12 w-auto object-contain filter grayscale hover:grayscale-0 transition-all duration-300">
                    </div>
                    <div class="flex justify-center" data-aos="fade-up" data-aos-delay="400">
                        <img src="{{ asset(cms()->client_image4) }}" alt="Client 4" class="h-12 w-auto object-contain filter grayscale hover:grayscale-0 transition-all duration-300">
                    </div>
                    <div class="flex justify-center" data-aos="fade-up" data-aos-delay="500">
                        <img src="{{ asset(cms()->client_image5) }}" alt="Client 5" class="h-12 w-auto object-contain filter grayscale hover:grayscale-0 transition-all duration-300">
                    </div>
                    <div class="flex justify-center" data-aos="fade-up" data-aos-delay="600">
                        <img src="{{ asset(cms()->client_image6) }}" alt="Client 6" class="h-12 w-auto object-contain filter grayscale hover:grayscale-0 transition-all duration-300">
                    </div>
                    <div class="flex justify-center" data-aos="fade-up" data-aos-delay="700">
                        <img src="{{ asset(cms()->client_image7) }}" alt="Client 7" class="h-12 w-auto object-contain filter grayscale hover:grayscale-0 transition-all duration-300">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-white dark:bg-gray-900">
        <div class="container px-4 xl:px-0 mx-auto">
            <!-- Section Header -->
            <div class="text-center max-w-4xl mx-auto mb-20">
                <span class="inline-block px-4 py-2 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-full text-sm font-semibold mb-4" data-aos="fade-up">
                    {{ __('POWERFUL FEATURES') }}
                </span>
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 dark:text-white mb-6" data-aos="fade-up" data-aos-delay="100">
                    {{ __('Everything You Need to') }}
                    <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                        {{ __('Manage Your Business') }}
                    </span>
                    </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 leading-relaxed" data-aos="fade-up" data-aos-delay="200">
                    {{ __('From time tracking to employee management, project coordination to financial reporting - our comprehensive platform handles every aspect of your business operations.') }}
                </p>
            </div>

            <!-- Core Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-20">
                <!-- Time Tracking Feature -->
                <div class="group bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-2xl p-8 border border-blue-100 dark:border-blue-800/30 hover:shadow-2xl hover:scale-105 transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ __('Smart Time Tracking') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-6 leading-relaxed">
                        {{ __('Advanced timesheet management with weekly reports, automatic calculations, and seamless approval workflows for accurate time tracking.') }}
                    </p>
                    <ul class="space-y-2 text-sm text-gray-500 dark:text-gray-400">
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('Weekly timesheet creation') }}
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('Automatic time calculations') }}
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('Approval workflow system') }}
                        </li>
                    </ul>
                </div>

                <!-- Employee Management Feature -->
                <div class="group bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-2xl p-8 border border-green-100 dark:border-green-800/30 hover:shadow-2xl hover:scale-105 transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ __('Employee Management') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-6 leading-relaxed">
                        {{ __('Comprehensive employee profiles, role management, invitation system, and detailed performance tracking for your entire workforce.') }}
                    </p>
                    <ul class="space-y-2 text-sm text-gray-500 dark:text-gray-400">
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('Employee profiles & roles') }}
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('Invitation & onboarding') }}
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('Performance tracking') }}
                        </li>
                    </ul>
                </div>

                <!-- Project Management Feature -->
                <div class="group bg-gradient-to-br from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 rounded-2xl p-8 border border-purple-100 dark:border-purple-800/30 hover:shadow-2xl hover:scale-105 transition-all duration-300" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ __('Project Coordination') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-6 leading-relaxed">
                        {{ __('Advanced project management with task assignments, progress tracking, client coordination, and comprehensive project analytics.') }}
                    </p>
                    <ul class="space-y-2 text-sm text-gray-500 dark:text-gray-400">
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-purple-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('Task management & assignment') }}
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-purple-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('Progress tracking & analytics') }}
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-purple-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('Client collaboration tools') }}
                        </li>
                    </ul>
                </div>

                <!-- Leave Management Feature -->
                <div class="group bg-gradient-to-br from-orange-50 to-red-50 dark:from-orange-900/20 dark:to-red-900/20 rounded-2xl p-8 border border-orange-100 dark:border-orange-800/30 hover:shadow-2xl hover:scale-105 transition-all duration-300" data-aos="fade-up" data-aos-delay="400">
                    <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ __('Leave Management') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-6 leading-relaxed">
                        {{ __('Complete leave management system with customizable leave types, approval workflows, holiday calendars, and automated notifications.') }}
                    </p>
                    <ul class="space-y-2 text-sm text-gray-500 dark:text-gray-400">
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-orange-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('Custom leave types') }}
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-orange-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('Approval workflows') }}
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-orange-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('Holiday calendar management') }}
                        </li>
                    </ul>
                </div>

                <!-- Financial Management Feature -->
                <div class="group bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20 rounded-2xl p-8 border border-emerald-100 dark:border-emerald-800/30 hover:shadow-2xl hover:scale-105 transition-all duration-300" data-aos="fade-up" data-aos-delay="500">
                    <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ __('Financial Management') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-6 leading-relaxed">
                        {{ __('Comprehensive financial tools including invoice generation, salary calculations, payment processing, and detailed financial reporting.') }}
                    </p>
                    <ul class="space-y-2 text-sm text-gray-500 dark:text-gray-400">
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-emerald-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('Invoice generation & billing') }}
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-emerald-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('Salary & payroll management') }}
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-emerald-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('Payment gateway integration') }}
                        </li>
                    </ul>
                </div>

                <!-- Analytics & Reporting Feature -->
                <div class="group bg-gradient-to-br from-indigo-50 to-blue-50 dark:from-indigo-900/20 dark:to-blue-900/20 rounded-2xl p-8 border border-indigo-100 dark:border-indigo-800/30 hover:shadow-2xl hover:scale-105 transition-all duration-300" data-aos="fade-up" data-aos-delay="600">
                    <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ __('Analytics & Reporting') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-6 leading-relaxed">
                        {{ __('Advanced analytics dashboard with real-time insights, custom reports, performance metrics, and data visualization tools.') }}
                    </p>
                    <ul class="space-y-2 text-sm text-gray-500 dark:text-gray-400">
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-indigo-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('Real-time dashboards') }}
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-indigo-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('Custom report generation') }}
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-indigo-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('Performance analytics') }}
                        </li>
                    </ul>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="text-center bg-gradient-to-r from-blue-600 to-indigo-600 rounded-3xl p-12 text-white" data-aos="fade-up" data-aos-delay="700">
                <h3 class="text-3xl md:text-4xl font-bold mb-4">{{ __('Ready to Transform Your Business?') }}</h3>
                <p class="text-xl opacity-90 mb-8 max-w-2xl mx-auto">
                    {{ __('Join thousands of businesses already using our platform to streamline their operations and boost productivity.') }}
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/login" class="inline-flex items-center justify-center px-8 py-4 bg-white text-blue-600 font-semibold rounded-xl hover:bg-gray-100 transition-all duration-300 shadow-lg hover:shadow-xl">
                        {{ __('Start Free Trial') }}
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                    <a href="#pricing" class="inline-flex items-center justify-center px-8 py-4 bg-transparent text-white font-semibold rounded-xl border-2 border-white/30 hover:border-white/60 hover:bg-white/10 transition-all duration-300">
                        {{ __('View Pricing') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Business Workflow Section -->
    <section class="py-20 bg-gradient-to-br from-gray-50 to-blue-50 dark:from-gray-900 dark:to-gray-800 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-72 h-72 bg-blue-400/10 rounded-full -translate-x-36 -translate-y-36"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-indigo-400/10 rounded-full translate-x-48 translate-y-48"></div>
        </div>
        
        <div class="container px-4 xl:px-0 mx-auto relative z-10">
            <!-- Section Header -->
            <div class="text-center max-w-4xl mx-auto mb-20">
                <span class="inline-block px-4 py-2 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-full text-sm font-semibold mb-4" data-aos="fade-up">
                    {{ __('HOW IT WORKS') }}
                </span>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6" data-aos="fade-up" data-aos-delay="100">
                    {{ __('Streamlined') }}
                    <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                        {{ __('Business Workflow') }}
                    </span>
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300" data-aos="fade-up" data-aos-delay="200">
                    {{ __('From employee onboarding to project completion and payment - see how our platform simplifies your entire business operation in just a few simple steps.') }}
                    </p>
                </div>

            <!-- Workflow Steps -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-20">
                <!-- Steps Content -->
                <div class="space-y-8" data-aos="fade-right">
                    <!-- Step 1 -->
                    <div class="flex items-start space-x-6 group">
                        <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg group-hover:scale-110 transition-transform duration-300">
                            1
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ __('Setup & Onboarding') }}</h3>
                            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                                {{ __('Create your organization, invite employees, set up projects and define roles with our intuitive setup wizard.') }}
                            </p>
                        </div>
                </div>

                    <!-- Step 2 -->
                    <div class="flex items-start space-x-6 group">
                        <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg group-hover:scale-110 transition-transform duration-300">
                            2
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ __('Time Tracking & Management') }}</h3>
                            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                                {{ __('Employees track time, submit timesheets, request leaves, and manage tasks while you maintain complete oversight.') }}
                            </p>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="flex items-start space-x-6 group">
                        <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg group-hover:scale-110 transition-transform duration-300">
                            3
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ __('Review & Approval') }}</h3>
                            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                                {{ __('Review timesheets, approve leave requests, monitor project progress, and provide feedback through automated workflows.') }}
                            </p>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="flex items-start space-x-6 group">
                        <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg group-hover:scale-110 transition-transform duration-300">
                            4
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ __('Analytics & Payment') }}</h3>
                            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                                {{ __('Generate detailed reports, process payments, calculate salaries, and gain insights from comprehensive analytics.') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Visual Representation -->
                <div class="relative" data-aos="fade-left" data-aos-delay="200">
                    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl p-8 border border-gray-200 dark:border-gray-600">
                        <!-- Dashboard Preview -->
                        <div class="space-y-6">
                            <!-- Header -->
                            <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-600 pb-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg"></div>
                                    <div>
                                        <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ __('Business Dashboard') }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ __('Real-time Overview') }}</div>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <div class="w-3 h-3 bg-green-400 rounded-full"></div>
                                    <div class="w-3 h-3 bg-yellow-400 rounded-full"></div>
                                    <div class="w-3 h-3 bg-red-400 rounded-full"></div>
                                </div>
                            </div>

                            <!-- Stats Grid -->
                            <div class="grid grid-cols-3 gap-4">
                                <div class="bg-blue-50 dark:bg-blue-900/30 rounded-lg p-4 text-center">
                                    <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">24</div>
                                    <div class="text-xs text-gray-600 dark:text-gray-400">{{ __('Employees') }}</div>
                                </div>
                                <div class="bg-green-50 dark:bg-green-900/30 rounded-lg p-4 text-center">
                                    <div class="text-2xl font-bold text-green-600 dark:text-green-400">156h</div>
                                    <div class="text-xs text-gray-600 dark:text-gray-400">{{ __('This Week') }}</div>
                                </div>
                                <div class="bg-purple-50 dark:bg-purple-900/30 rounded-lg p-4 text-center">
                                    <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">12</div>
                                    <div class="text-xs text-gray-600 dark:text-gray-400">{{ __('Projects') }}</div>
                                </div>
                            </div>

                            <!-- Progress Bars -->
                            <div class="space-y-3">
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-gray-600 dark:text-gray-400">{{ __('Project Alpha') }}</span>
                                        <span class="text-gray-900 dark:text-white font-medium">75%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-2 rounded-full" style="width: 75%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-gray-600 dark:text-gray-400">{{ __('Project Beta') }}</span>
                                        <span class="text-gray-900 dark:text-white font-medium">45%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-green-500 to-emerald-600 h-2 rounded-full" style="width: 45%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-gray-600 dark:text-gray-400">{{ __('Project Gamma') }}</span>
                                        <span class="text-gray-900 dark:text-white font-medium">90%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-purple-500 to-pink-600 h-2 rounded-full" style="width: 90%"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Recent Activity -->
                            <div class="space-y-2">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ __('Recent Activity') }}</div>
                                <div class="space-y-2">
                                    <div class="flex items-center space-x-3 p-2 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                        <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                                        <div class="text-sm text-gray-600 dark:text-gray-300">{{ __('Timesheet approved') }}</div>
                                    </div>
                                    <div class="flex items-center space-x-3 p-2 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                        <div class="w-2 h-2 bg-blue-400 rounded-full"></div>
                                        <div class="text-sm text-gray-600 dark:text-gray-300">{{ __('New project created') }}</div>
                                    </div>
                                    <div class="flex items-center space-x-3 p-2 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                        <div class="w-2 h-2 bg-orange-400 rounded-full"></div>
                                        <div class="text-sm text-gray-600 dark:text-gray-300">{{ __('Leave request pending') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Floating Elements -->
                    <div class="absolute -top-4 -right-4 w-16 h-16 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-2xl flex items-center justify-center shadow-lg animate-bounce">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <div class="absolute -bottom-4 -left-4 w-16 h-16 bg-gradient-to-br from-green-400 to-emerald-500 rounded-2xl flex items-center justify-center shadow-lg animate-pulse">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Benefits Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center group" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ __('Save Time') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('Automate repetitive tasks and streamline workflows to save hours every week.') }}</p>
                </div>

                <div class="text-center group" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ __('Boost Productivity') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('Increase team efficiency by up to 40% with better project management and time tracking.') }}</p>
                </div>

                <div class="text-center group" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ __('Reduce Costs') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('Cut operational costs by 30% through better resource management and automated processes.') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Time Tracking Tool Section -->
    <section class="p-10 bg-primary-50 text-white pb-20">
        <div class="container px-4 xl:px-0 py-10 lg:py-20 mx-auto">
            <div class="text-center space-y-4 mb-12">
                <p class="text-sm font-semibold text-primary-50">{{ __('FEATURES') }}</p>
                <h2 class="text-3xl md:text-4xl font-bold">{{ __('Theme Customization') }}</h2>
                <p class="text-gray-800 max-w-2xl mx-auto">
                    {{ __('Personalize your dashboard to suit your brand and preferences.') }}
                </p>
            </div>

            <div class="rounded-lg overflow-hidden shadow-2xl" data-aos="fade-up" data-aos-delay="100">
                <img src="{{ asset(cms()->approach_image) }}" alt="Time Tracking Dashboard" class="w-full h-auto">
            </div>
        </div>
    </section>

    <!-- Product Screenshots Section -->
    <section class="p-10 bg-white py-20">
        <div class="container px-4 xl:px-0 py-10 lg:py-20 mx-auto">
            <!-- First Screenshot -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-20">
                <div class="space-y-6">
                    <p class="text-sm font-semibold text-Timesheet-green">{{ __('FEATURES') }}</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">{{ __('Time Tracking Made Easy') }}</h2>
                    <p class="text-gray-600" data-aos="fade-up" data-aos-delay="100">
                        {{ __('Stay on top of your team\'s progress with real-time tracking.') }}
                    </p>
                    <a href="#pricing"
                        class="inline-flex items-center px-6 py-3 bg-primary-50 text-white rounded-md hover:bg-primary-300"
                        data-aos="fade-up" data-aos-delay="200">
                        {{ __('Buy Now') }} <span class="ms-2">↓</span>
                    </a>
                </div>
                <div class="rounded-xl overflow-hidden shadow-2xl border border-gray-200" data-aos="fade-up"
                    data-aos-delay="300">
                    <img src="{{ asset(cms()->features_image1) }}" alt="Timesheet View" class="w-full h-auto">
                </div>
            </div>

            <!-- Second Screenshot -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="rounded-xl overflow-hidden shadow-2xl border border-gray-200 order-2 lg:order-1"
                    data-aos="fade-up" data-aos-delay="200">
                    <img src="{{ asset(cms()->features_image2) }}" alt="Project Templates View"
                        class="w-full h-auto">
                </div>
                <div class="space-y-6 order-1 lg:order-2" data-aos="fade-up" data-aos-delay="100">
                    <p class="text-sm font-semibold text-Timesheet-green">{{ __('FEATURES') }}</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">{{ __('Leave Managements') }}</h2>
                    <p class="text-gray-600">
                        {{ __('Manage your employees\' leave requests and approvals with ease.') }}
                    </p>
                    <a href="#pricing"
                        class="inline-flex items-center px-6 py-3 bg-Timesheet-green bg-primary-50 text-white rounded-md hover:bg-primary-300"
                        data-aos="fade-up" data-aos-delay="200">
                        {{ __('Buy Now') }} <span class="ms-2">↓</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing -->
    <section class="p-10 bg-gray-50" id="pricing">
        <div class="container px-4 xl:px-0 py-10 lg:py-20 mx-auto">
            <h2 class="text-4xl text-3xl md:text-4xl font-bold text-gray-900  mb-16 text-center" data-aos="fade-up">
                {{ __('Our Pricing') }}
            </h2>
            <div class="px-8 py-6 border border-white/30 rounded-xl bg-primary-50 shadow-xl backdrop-blur"
                data-aos="fade-up" data-aos-delay="100">
                <div class="space-y-2 mb-8">
                    <h1 class="text-2xl md:text-3xl font-semibold text-white" data-aos="fade-up">
                        {{ __('The biggest ever Black Friday sale!') }}
                    </h1>
                    <p class="text-white/90" data-aos="fade-up" data-aos-delay="100">
                        {{ __('You\'ll love these great deals that were handpicked just for you.') }}
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-6">
                    <!-- Pricing Plan -->
                    @foreach (pricePlans() as $plan)
                        <div class="bg-white rounded-lg p-6" data-aos="fade-up" data-aos-delay="200">
                            <h2 class="text-xl font-semibold text-text-white flex items-center justify-between">
                                <span>{{ $plan->label }}</span>
                                @if ($plan->recommended)
                                    <span
                                        class="bg-green-500 text-white text-xs font-bold rounded-full px-2 py-1 ms-2">RECOMMENDED</span>
                                @endif
                            </h2>
                            <p class="text-text-white/90 mb-12">
                                {{ $plan->description }}
                            </p>
                            <div class="relative inline-block">
                                <div class="text-text-white/90 line-through text-sm">
                                    {{ $plan->old_price ? '$' . $plan->old_price : 'N/A' }}
                                </div>
                                <div class="absolute start-full -top-2 rotate-60">
                                    <span
                                        class="inline-block whitespace-nowrap bg-rose-500 text-text-white text-sm px-3 py-1 rounded-full">
                                        {{ $plan->discount_percentage ? $plan->discount_percentage . '% OFF' : 'N/A' }}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <div class="text-sm text-text-white/90 mt-6 mb-2">From</div>
                                <div class="flex items-baseline gap-1">
                                    <span class="text-3xl text-text-white font-bold">
                                        {{ $plan->price ? '$' . $plan->price : 'N/A' }}
                                    </span>
                                    <span class="text-text-white/90">/mo</span>
                                </div>
                                <div class="text-sm text-text-white/90 my-8">
                                    <div class=" ">
                                        <ul class="space-y-4">
                                            <li class="flex items-center">
                                                <x-svgs.check class="text-green-500 me-3" />
                                                <span class="text-text-white">{{ __('Employee can create') }}
                                                    {{ $plan->employee_limit }} {{ __('projects') }}</span>
                                            </li>
                                            <li class="flex items-center">
                                                <x-svgs.check class="text-green-500 me-2" />
                                                <span class="text-text-white">{{ __('Client can create') }}
                                                    {{ $plan->client_limit }} {{ __('projects') }}</span>
                                            </li>
                                            <li class="flex items-center">
                                                <x-svgs.check class="text-green-500 me-2" />
                                                <span class="text-text-white">{{ __('Project can create') }}
                                                    {{ $plan->project_limit }} {{ __('projects') }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('plans.index') }}"
                                class="w-full py-2 px-4 bg-primary-50 bg-opacity-10 rounded-md hover:bg-opacity-20 transition-colors"
                                data-aos="fade-up" data-aos-delay="300">
                                {{ __('Get deal') }}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial -->
    <section class="p-10 bg-white py-20">
        <div class="container px-4 xl:px-0 py-10 lg:py-20 mx-auto">
            <div class="space-y-4 max-w-3xl mb-12">
                <p class="text-sm font-semibold text-gray-900">{{ __('TESTIMONIALS') }}</p>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">{{ __('From our Clients') }}</h2>
                <p class="text-gray-900">
                    {{ __('What our clients say about us') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <!-- Testimonial Card 1 -->
                @foreach (testimonials() as $testimonial)
                    <div class="bg-primary-50 rounded-lg p-8 space-y-4 shadow-xl" data-aos="fade-up"
                        data-aos-delay="100">
                        <div class="flex justify-between items-start">
                            <div class="w-8 h-8 bg-gray-900 flex items-center justify-center rounded">
                                <span class="text-white">"</span>
                            </div>
                            <div class="flex flex-wrap">
                                @for ($i = 0; $i < $testimonial->rating; $i++)
                                    <span class="text-yellow-500">★</span>
                                @endfor
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold text-white">{{ $testimonial->name }}</h3>
                        <p class="text-gray-800 italic" data-aos="fade-up" data-aos-delay="200">
                            {{ $testimonial->description }}
                        </p>
                        <div class="flex items-center gap-3 pt-4">
                            <img src="{{ asset($testimonial->image) }}" alt=""
                                class="w-10 h-10 rounded-full">
                            <div class="text-sm">
                                <p class="text-white font-medium">{{ $testimonial->company }}</p>
                                <p class="text-gray-800">{{ $testimonial->designation }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact -->
    <section class="p-10 bg-primary-50">
        <div class="container px-4 xl:px-0 py-10 lg:py-20 mx-auto">
            <!-- Title -->
            <div class="max-w-3xl mb-10 lg:mb-14">
                <h2 class="text-white font-semibold text-2xl md:text-4xl md:leading-tight" data-aos="fade-up">
                    {{ __('Contact us') }}
                </h2>
                <p class="mt-1 text-gray-800" data-aos="fade-up" data-aos-delay="100">
                    {{ __('Whatever your goal - we will get you there.') }}
                </p>
            </div>
            <!-- End Title -->

            <!-- Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 lg:gap-x-16">
                <!-- Form Section -->
                <div class="md:order-2 bg-card-500 p-8 rounded-lg bg-white card border border-white/30 mb-10"
                    data-aos="fade-up" data-aos-delay="200">
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <!-- Input -->
                            <div class="relative">
                                <input type="text" required id="hs-tac-input-name" name="name"
                                    class="peer p-4 block w-full bg-black/5 border-transparent rounded-lg text-sm text-text-light placeholder:text-transparent focus:outline-none focus:ring-0 focus:border-transparent disabled:opacity-50 disabled:pointer-events-none focus:pt-6 focus:pb-2 [&:not(:placeholder-shown)]:pt-6 [&:not(:placeholder-shown)]:pb-2 autofill:pt-6 autofill:pb-2"
                                    placeholder="Name">
                                <label for="hs-tac-input-name"
                                    class="absolute top-0 start-0 p-4 h-full text-gray-800 text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent peer-disabled:opacity-50 peer-disabled:pointer-events-none peer-focus:text-xs peer-focus:-translate-y-1.5 peer-focus:text-gray-800 peer-[:not(:placeholder-shown)]:text-xs peer-[:not(:placeholder-shown)]:-translate-y-1.5 peer-[:not(:placeholder-shown)]:text-gray-800">
                                    {{ __('Name') }}
                                </label>
                                @error('name')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- End Input -->

                            <!-- Input -->
                            <div class="relative">
                                <input type="email" required name="email" id="hs-tac-input-email"
                                    class="peer p-4 block w-full bg-black/5 border-transparent rounded-lg text-sm text-text-light placeholder:text-transparent focus:outline-none focus:ring-0 focus:border-transparent disabled:opacity-50 disabled:pointer-events-none focus:pt-6 focus:pb-2 [&:not(:placeholder-shown)]:pt-6 [&:not(:placeholder-shown)]:pb-2 autofill:pt-6 autofill:pb-2"
                                    placeholder="Email">
                                <label for="hs-tac-input-email"
                                    class="absolute top-0 start-0 p-4 h-full text-gray-800 text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent peer-disabled:opacity-50 peer-disabled:pointer-events-none peer-focus:text-xs peer-focus:-translate-y-1.5 peer-focus:text-gray-800 peer-[:not(:placeholder-shown)]:text-xs peer-[:not(:placeholder-shown)]:-translate-y-1.5 peer-[:not(:placeholder-shown)]:text-gray-800">
                                    {{ __('Email') }}
                                </label>
                                @error('email')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- End Input -->

                            <!-- Input -->
                            <div class="relative">
                                <input type="text" required name="company" id="hs-tac-input-company"
                                    class="peer p-4 block w-full bg-black/5 border-transparent rounded-lg text-sm text-text-light placeholder:text-transparent focus:outline-none focus:ring-0 focus:border-transparent disabled:opacity-50 disabled:pointer-events-none focus:pt-6 focus:pb-2 [&:not(:placeholder-shown)]:pt-6 [&:not(:placeholder-shown)]:pb-2 autofill:pt-6 autofill:pb-2"
                                    placeholder="Company">
                                <label for="hs-tac-input-company"
                                    class="absolute top-0 start-0 p-4 h-full text-gray-800 text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent peer-disabled:opacity-50 peer-disabled:pointer-events-none peer-focus:text-xs peer-focus:-translate-y-1.5 peer-focus:text-gray-800 peer-[:not(:placeholder-shown)]:text-xs peer-[:not(:placeholder-shown)]:-translate-y-1.5 peer-[:not(:placeholder-shown)]:text-gray-800">
                                    {{ __('Company') }}
                                </label>
                                @error('company')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- End Input -->

                            <!-- Input -->
                            <div class="relative">
                                <input type="text" name="phone" id="hs-tac-input-phone"
                                    class="peer p-4 block w-full bg-black/5 border-transparent rounded-lg text-sm text-text-light placeholder:text-transparent focus:outline-none focus:ring-0 focus:border-transparent disabled:opacity-50 disabled:pointer-events-none focus:pt-6 focus:pb-2 [&:not(:placeholder-shown)]:pt-6 [&:not(:placeholder-shown)]:pb-2 autofill:pt-6 autofill:pb-2"
                                    placeholder="Phone">
                                <label for="hs-tac-input-phone"
                                    class="absolute top-0 start-0 p-4 h-full text-gray-800 text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent peer-disabled:opacity-50 peer-disabled:pointer-events-none peer-focus:text-xs peer-focus:-translate-y-1.5 peer-focus:text-gray-800 peer-[:not(:placeholder-shown)]:text-xs peer-[:not(:placeholder-shown)]:-translate-y-1.5 peer-[:not(:placeholder-shown)]:text-gray-800">
                                    {{ __('Phone') }}
                                </label>
                                @error('phone')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- End Input -->

                            <!-- Textarea -->
                            <div class="relative">
                                <textarea name="message" required id="hs-tac-message"
                                    class="peer p-4 block w-full bg-black/5 border-transparent rounded-lg text-sm text-text-light placeholder:text-transparent focus:outline-none focus:ring-0 focus:border-transparent disabled:opacity-50 disabled:pointer-events-none focus:pt-6 focus:pb-2 [&:not(:placeholder-shown)]:pt-6 [&:not(:placeholder-shown)]:pb-2 autofill:pt-6 autofill:pb-2"
                                    placeholder="This is a textarea placeholder"></textarea>
                                <label for="hs-tac-message"
                                    class="absolute top-0 start-0 p-4 h-full text-gray-800 text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent peer-disabled:opacity-50 peer-disabled:pointer-events-none peer-focus:text-xs peer-focus:-translate-y-1.5 peer-focus:text-gray-800 peer-[:not(:placeholder-shown)]:text-xs peer-[:not(:placeholder-shown)]:-translate-y-1.5 peer-[:not(:placeholder-shown)]:text-gray-800">
                                    {{ __('Tell us about your project') }}
                                </label>
                                @error('message')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- End Textarea -->
                        </div>

                        <div class="mt-2">
                            <p class="text-xs text-white">
                                {{ __('All fields are required') }}
                            </p>

                            <p class="mt-5">
                                <button type="submit"
                                    class="group inline-flex items-center gap-x-2 py-2 px-3 bg-gray-900 font-medium text-sm text-white rounded focus:outline-none"
                                    href="#">
                                    {{ __('Submit') }}
                                    <svg class="flex-shrink-0  shadow-xlsize-4 transition group-hover:translate-x-0.5 group-hover:translate-x-0 group-focus:translate-x-0.5 group-focus:translate-x-0"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14" />
                                        <path d="m12 5 7 7-7 7" />
                                    </svg>
                                </button>
                            </p>
                        </div>
                    </form>
                </div>
                <!-- End Form Section -->

                <!-- Details Section -->
                <div class="space-y-14" data-aos="fade-up" data-aos-delay="300">
                    <!-- Item -->
                    <div class="flex gap-x-5">
                        <svg class="flex-shrink-0  shadow-xlsize-6 text-white" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                        <div class="grow">
                            <h4 class="text-white font-semibold" data-aos="fade-up">
                                {{ __('Our address:') }}
                            </h4>

                            <address class="mt-1 text-gray-800 text-sm not-italic" data-aos="fade-up"
                                data-aos-delay="100">
                                {{ __('300 Bath Street, Tay House') }}<br>
                                {{ __('Glasgow G2 4JR, United Kingdom') }}
                            </address>
                        </div>
                    </div>
                    <!-- End Item -->

                    <!-- Item -->
                    <div class="flex gap-x-5">
                        <svg class="flex-shrink-0  shadow-xlsize-6 text-white" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M21.2 8.4c.5.38.8.97.8 1.6v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V10a2 2 0 0 1 .8-1.6l8-6a2 2 0 0 1 2.4 0l8 6Z" />
                            <path d="m22 10-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 10" />
                        </svg>
                        <div class="grow">
                            <h4 class="text-white font-semibold" data-aos="fade-up">
                                {{ __('Email us:') }}
                            </h4>

                            <a class="mt-1 text-gray-800 text-sm" href="mailto:example@site.co" target="_blank">
                                {{ __('hello@example.so') }}
                            </a>
                        </div>
                    </div>
                    <!-- End Item -->

                    <!-- Item -->
                    <div class="flex gap-x-5">
                        <svg class="flex-shrink-0  shadow-xlsize-6 text-white" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m3 11 18-5v12L3 14v-3z" />
                            <path d="M11.6 16.8a3 3 0 1 1-5.8-1.6" />
                        </svg>
                        <div class="grow">
                            <h4 class="text-white font-semibold" data-aos="fade-up">
                                {{ __('We\'re hiring') }}
                            </h4>
                            <p class="mt-1 text-gray-800" data-aos="fade-up" data-aos-delay="100">
                                {{ __('We\'re thrilled to announce that we\'re expanding our team and looking for talented individuals like you to join us.') }}
                            </p>
                            <p class="mt-2">
                                <a class="group inline-flex items-center gap-x-2 font-medium text-sm text-primary-500 decoration-2 hover:underline focus:outline-none focus:underline"
                                    href="#">
                                    {{ __('Job openings') }}
                                    <svg class="flex-shrink-0  shadow-xlsize-4 transition group-hover:translate-x-0.5 group-hover:translate-x-0 group-focus:translate-x-0.5 group-focus:translate-x-0"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14" />
                                        <path d="m12 5 7 7-7 7" />
                                    </svg>
                                </a>
                            </p>
                        </div>
                    </div>
                    <!-- End Item -->
                </div>
                <!-- End Details Section -->
            </div>
            <!-- End Grid -->
        </div>
    </section>

    <!-- Footer -->
    <footer class="p-10 bg-card-dark  border-t">
        <div class="container px-4 xl:px-0 py-10 lg:py-20 mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Logo and Description -->
                <div class="space-y-4" data-aos="fade-up">
                    <img src="{{ asset('images/logo-inv.png') }}" alt="Logo" class="w-48 h-auto">
                    <p class="text-text-light text-white">
                        {{ __('We build modern web tools to help you jump-start your daily business work.') }}
                    </p>
                    <div class="flex space-x-4">
                        <a href="{{ getSocialLinks()->facebook_url }}" target="_blank"
                            class="text-white hover:text-primary-500">
                            <i class="fa-brands fa-facebook" style="font-size: 30px;"></i>
                        </a>
                        <a href="{{ getSocialLinks()->twitter_url }}" target="_blank"
                            class="text-white hover:text-primary-500">
                            <i class="fa-brands fa-twitter" style="font-size: 30px;"></i>
                        </a>
                        <a href="{{ getSocialLinks()->linkedin_url }}" target="_blank"
                            class="text-white hover:text-primary-500">
                            <i class="fa-brands fa-linkedin" style="font-size: 30px;"></i>
                        </a>
                        <a href="{{ getSocialLinks()->instagram_url }}" target="_blank"
                            class="text-white hover:text-primary-500">
                            <i class="fa-brands fa-instagram" style="font-size: 30px;"></i>
                        </a>
                        <a href="{{ getSocialLinks()->youtube_url }}" target="_blank"
                            class="text-white hover:text-primary-500">
                            <i class="fa-brands fa-youtube" style="font-size: 30px;"></i>
                        </a>
                    </div>
                </div>
                <!-- Links -->
                <div data-aos="fade-up">
                    <ul class="space-y-3">
                        <li><a href="{{ route('terms') }}"
                                class="text-white hover:text-primary-500">{{ __('Terms and Conditions') }}</a></li>
                        <li><a href="{{ route('privacy') }}"
                                class="text-white hover:text-primary-500">{{ __('Privacy Policy') }}</a></li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div class="space-y-4" data-aos="fade-up">
                    <h3 class="text-xl font-bold text-white">
                        {{ __('Join Our Community') }}
                    </h3>
                    <p class="text-white">
                        {{ __('We build modern web tools to help you jump-start your daily business work.') }}
                    </p>
                    <form class="flex gap-2" action="{{ route('newsletter.store') }}" method="POST">
                        @csrf
                        <input type="email" name="email" placeholder="Type your email address..."
                            class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <button type="submit"
                            class="px-6 py-2 bg-primary-50 text-white rounded-md hover:bg-gray-800">
                            {{ __('Join Us!') }}
                        </button>
                    </form>
                </div>
            </div>

            <div class="border-t mt-12 pt-8 text-center text-white">
                © 2024 Timesheet
            </div>
        </div>
    </footer>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            once: false,
        });
    </script>

    <!-- SweetAlert JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        @if (Session::has('success'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-center"
            }
            toastr.success("{{ session('success') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-center"
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-center"
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-center"
            }
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var searchInput = document.getElementById("searchInput");
            var dropdownItems = document.querySelectorAll("ul.dropdown-menu li");

            // Check if searchInput exists
            if (searchInput) {
                searchInput.addEventListener("keyup", function() {
                    var value = this.value.toLowerCase();
                    dropdownItems.forEach(function(item) {
                        if (item.textContent.toLowerCase().indexOf(value) > -1) {
                            item.style.display = "";
                        } else {
                            item.style.display = "none";
                        }
                    });
                });
            }
        });
    </script>

    <!-- Technical Features & Integrations Section -->
    <section class="py-20 bg-white dark:bg-gray-900">
        <div class="container px-4 xl:px-0 mx-auto">
            <!-- Section Header -->
            <div class="text-center max-w-4xl mx-auto mb-20">
                <span class="inline-block px-4 py-2 bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 rounded-full text-sm font-semibold mb-4" data-aos="fade-up">
                    {{ __('TECHNICAL EXCELLENCE') }}
                </span>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6" data-aos="fade-up" data-aos-delay="100">
                    {{ __('Enterprise-Grade') }}
                    <span class="bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                        {{ __('Platform') }}
                    </span>
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300" data-aos="fade-up" data-aos-delay="200">
                    {{ __('Built with cutting-edge technology and robust integrations to ensure scalability, security, and seamless operations for businesses of all sizes.') }}
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-20">
                <!-- Left: Features List -->
                <div class="space-y-8" data-aos="fade-right">
                    <!-- Multi-Role System -->
                    <div class="flex items-start space-x-4 group">
                        <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ __('Advanced Role Management') }}</h3>
                            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                                {{ __('Sophisticated multi-role system supporting Super Admin, Employer, Employee, and Client roles with granular permissions and custom access controls.') }}
                            </p>
                        </div>
                    </div>

                    <!-- Real-time Notifications -->
                    <div class="flex items-start space-x-4 group">
                        <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5-5-5h5v-12"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ __('Real-time Notifications') }}</h3>
                            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                                {{ __('Instant email notifications for timesheet submissions, approvals, leave requests, and project updates with customizable notification preferences.') }}
                            </p>
                        </div>
                    </div>

                    <!-- Payment Integration -->
                    <div class="flex items-start space-x-4 group">
                        <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ __('Secure Payment Processing') }}</h3>
                            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                                {{ __('Integrated payment gateways including Stripe and PayPal for secure subscription management, invoice processing, and automated billing cycles.') }}
                            </p>
                        </div>
                    </div>

                    <!-- Theme Customization -->
                    <div class="flex items-start space-x-4 group">
                        <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ __('Complete Customization') }}</h3>
                            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                                {{ __('Full theme customization, multi-language support, custom branding options, and white-label solutions to match your organization\'s identity.') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right: Visual Dashboard -->
                <div class="relative" data-aos="fade-left" data-aos-delay="200">
                    <!-- Main Dashboard Container -->
                    <div class="bg-gradient-to-br from-gray-50 to-blue-50 dark:from-gray-800 dark:to-gray-700 rounded-3xl p-8 shadow-2xl border border-gray-200 dark:border-gray-600">
                        <!-- Dashboard Header -->
                        <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200 dark:border-gray-600">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-lg font-bold text-gray-900 dark:text-white">{{ __('Analytics Dashboard') }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('Advanced Insights') }}</div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                                <span class="text-sm text-gray-600 dark:text-gray-400">{{ __('Live') }}</span>
                            </div>
                        </div>

                        <!-- Feature Highlights -->
                        <div class="space-y-4">
                            <!-- Role Management -->
                            <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('User Roles') }}</span>
                                    <span class="text-xs text-green-600 dark:text-green-400 font-medium">{{ __('Active') }}</span>
                                </div>
                                <div class="flex space-x-2">
                                    <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 text-xs rounded-full">{{ __('Admin') }}</span>
                                    <span class="px-2 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-xs rounded-full">{{ __('Employer') }}</span>
                                    <span class="px-2 py-1 bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 text-xs rounded-full">{{ __('Employee') }}</span>
                                    <span class="px-2 py-1 bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-300 text-xs rounded-full">{{ __('Client') }}</span>
                                </div>
                            </div>

                            <!-- Payment Status -->
                            <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Payment Gateway') }}</span>
                                    <div class="flex items-center space-x-2">
                                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                        <span class="text-xs text-gray-600 dark:text-gray-400">{{ __('Connected') }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-6 h-6 bg-blue-500 rounded flex items-center justify-center">
                                            <span class="text-white text-xs font-bold">S</span>
                                        </div>
                                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ __('Stripe') }}</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <div class="w-6 h-6 bg-yellow-500 rounded flex items-center justify-center">
                                            <span class="text-white text-xs font-bold">P</span>
                                        </div>
                                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ __('PayPal') }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Real-time Updates -->
                            <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-sm">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Live Updates') }}</span>
                                    <span class="text-xs text-blue-600 dark:text-blue-400 font-medium">{{ __('Real-time') }}</span>
                                </div>
                                <div class="space-y-2">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                        <span class="text-xs text-gray-600 dark:text-gray-300">{{ __('Timesheet submitted') }}</span>
                                        <span class="text-xs text-gray-400">{{ __('2m ago') }}</span>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div class="w-2 h-2 bg-blue-400 rounded-full animate-pulse"></div>
                                        <span class="text-xs text-gray-600 dark:text-gray-300">{{ __('Leave approved') }}</span>
                                        <span class="text-xs text-gray-400">{{ __('5m ago') }}</span>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div class="w-2 h-2 bg-purple-400 rounded-full animate-pulse"></div>
                                        <span class="text-xs text-gray-600 dark:text-gray-300">{{ __('Invoice generated') }}</span>
                                        <span class="text-xs text-gray-400">{{ __('8m ago') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Floating Tech Badges -->
                    <div class="absolute -top-6 -left-6 bg-gradient-to-br from-green-400 to-emerald-500 rounded-2xl p-4 shadow-lg transform rotate-12 hover:rotate-0 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="absolute -bottom-6 -right-6 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-2xl p-4 shadow-lg transform -rotate-12 hover:rotate-0 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Integration & Tech Stack -->
            <div class="bg-gradient-to-r from-gray-50 to-blue-50 dark:from-gray-800 dark:to-gray-700 rounded-3xl p-12" data-aos="fade-up">
                <div class="text-center mb-12">
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">{{ __('Built with Modern Technology') }}</h3>
                    <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                        {{ __('Powered by robust frameworks and integrated with leading platforms for maximum reliability and performance.') }}
                    </p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8 items-center">
                    <!-- Laravel -->
                    <div class="flex flex-col items-center group" data-aos="fade-up" data-aos-delay="100">
                        <div class="w-16 h-16 bg-white dark:bg-gray-800 rounded-xl shadow-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                            <span class="text-2xl font-bold text-red-500">L</span>
                        </div>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Laravel') }}</span>
                    </div>

                    <!-- MySQL -->
                    <div class="flex flex-col items-center group" data-aos="fade-up" data-aos-delay="200">
                        <div class="w-16 h-16 bg-white dark:bg-gray-800 rounded-xl shadow-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                            <span class="text-2xl font-bold text-blue-600">M</span>
                        </div>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('MySQL') }}</span>
                    </div>

                    <!-- Stripe -->
                    <div class="flex flex-col items-center group" data-aos="fade-up" data-aos-delay="300">
                        <div class="w-16 h-16 bg-white dark:bg-gray-800 rounded-xl shadow-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                            <span class="text-2xl font-bold text-purple-600">S</span>
                        </div>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Stripe') }}</span>
                    </div>

                    <!-- PayPal -->
                    <div class="flex flex-col items-center group" data-aos="fade-up" data-aos-delay="400">
                        <div class="w-16 h-16 bg-white dark:bg-gray-800 rounded-xl shadow-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                            <span class="text-2xl font-bold text-blue-700">P</span>
                        </div>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('PayPal') }}</span>
                    </div>

                    <!-- Email -->
                    <div class="flex flex-col items-center group" data-aos="fade-up" data-aos-delay="500">
                        <div class="w-16 h-16 bg-white dark:bg-gray-800 rounded-xl shadow-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('SMTP') }}</span>
                    </div>

                    <!-- Security -->
                    <div class="flex flex-col items-center group" data-aos="fade-up" data-aos-delay="600">
                        <div class="w-16 h-16 bg-white dark:bg-gray-800 rounded-xl shadow-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Secure') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Showcase Section -->
    <section class="py-20 bg-gray-50 dark:bg-gray-900">
        <div class="container px-4 xl:px-0 mx-auto">
            <!-- Section Header -->
            <div class="text-center max-w-4xl mx-auto mb-20">
                <span class="inline-block px-4 py-2 bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 rounded-full text-sm font-semibold mb-4" data-aos="fade-up">
                    {{ __('PRODUCT SHOWCASE') }}
                </span>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6" data-aos="fade-up" data-aos-delay="100">
                    {{ __('See the Platform') }}
                    <span class="bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">
                        {{ __('In Action') }}
                    </span>
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300" data-aos="fade-up" data-aos-delay="200">
                    {{ __('Explore real screenshots and features from our comprehensive business management platform. See how it transforms your daily operations.') }}
                </p>
            </div>

            <!-- First Screenshot - Time Tracking -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-24">
                <div class="space-y-6" data-aos="fade-right">
                    <div class="inline-flex items-center px-4 py-2 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-full text-sm font-semibold">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ __('TIME TRACKING') }}
                    </div>
                    <h3 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">
                        {{ __('Effortless Time Management') }}
                    </h3>
                    <p class="text-lg text-gray-600 dark:text-gray-300 leading-relaxed">
                        {{ __('Comprehensive timesheet system with weekly tracking, automatic calculations, visual progress indicators, and seamless approval workflows. Employees can easily log hours while managers maintain complete oversight.') }}
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center text-gray-700 dark:text-gray-300">
                            <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('Weekly timesheet creation with calendar integration') }}
                        </li>
                        <li class="flex items-center text-gray-700 dark:text-gray-300">
                            <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('Real-time submission and approval status tracking') }}
                        </li>
                        <li class="flex items-center text-gray-700 dark:text-gray-300">
                            <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('Automated email notifications and reporting') }}
                        </li>
                    </ul>
                    <div class="pt-4">
                        <a href="/login" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                            {{ __('Try Time Tracking') }}
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="relative" data-aos="fade-left" data-aos-delay="200">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800">
                        <img src="{{ asset(cms()->features_image1) }}" alt="Time Tracking Interface" class="w-full h-auto">
                        <!-- Overlay with feature callouts -->
                        <div class="absolute top-4 right-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-medium animate-pulse">
                            {{ __('Live Demo') }}
                        </div>
                    </div>
                    <!-- Floating elements -->
                    <div class="absolute -bottom-4 -left-4 w-20 h-20 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-2xl flex items-center justify-center shadow-lg transform rotate-12 animate-bounce">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Second Screenshot - Leave Management -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-24">
                <div class="relative order-2 lg:order-1" data-aos="fade-right" data-aos-delay="200">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800">
                        <img src="{{ asset(cms()->features_image2) }}" alt="Leave Management System" class="w-full h-auto">
                        <!-- Overlay features -->
                        <div class="absolute top-4 left-4 bg-orange-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                            {{ __('New Feature') }}
                        </div>
                    </div>
                    <!-- Floating elements -->
                    <div class="absolute -top-4 -right-4 w-20 h-20 bg-gradient-to-br from-orange-400 to-red-500 rounded-2xl flex items-center justify-center shadow-lg transform -rotate-12 animate-pulse">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
                <div class="space-y-6 order-1 lg:order-2" data-aos="fade-left">
                    <div class="inline-flex items-center px-4 py-2 bg-orange-100 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400 rounded-full text-sm font-semibold">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ __('LEAVE MANAGEMENT') }}
                    </div>
                    <h3 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">
                        {{ __('Smart Leave Administration') }}
                    </h3>
                    <p class="text-lg text-gray-600 dark:text-gray-300 leading-relaxed">
                        {{ __('Complete leave management ecosystem with customizable leave types, automated approval workflows, holiday calendars, and comprehensive tracking. Simplify leave requests for employees and approvals for managers.') }}
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center text-gray-700 dark:text-gray-300">
                            <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('Custom leave types and policies configuration') }}
                        </li>
                        <li class="flex items-center text-gray-700 dark:text-gray-300">
                            <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('One-click approval and rejection workflows') }}
                        </li>
                        <li class="flex items-center text-gray-700 dark:text-gray-300">
                            <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('Holiday calendar and team availability overview') }}
                        </li>
                    </ul>
                    <div class="pt-4">
                        <a href="/login" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-600 to-red-600 text-white font-semibold rounded-xl hover:from-orange-700 hover:to-red-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                            {{ __('Explore Leave System') }}
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Third Screenshot - Dashboard Analytics -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="space-y-6" data-aos="fade-right">
                    <div class="inline-flex items-center px-4 py-2 bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 rounded-full text-sm font-semibold">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        {{ __('ANALYTICS & INSIGHTS') }}
                    </div>
                    <h3 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">
                        {{ __('Powerful Business Intelligence') }}
                    </h3>
                    <p class="text-lg text-gray-600 dark:text-gray-300 leading-relaxed">
                        {{ __('Advanced dashboard with real-time analytics, customizable reports, performance metrics, and data visualization. Make informed decisions with comprehensive business insights and trend analysis.') }}
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center text-gray-700 dark:text-gray-300">
                            <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('Real-time dashboard with interactive charts') }}
                        </li>
                        <li class="flex items-center text-gray-700 dark:text-gray-300">
                            <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('Custom report generation and export options') }}
                        </li>
                        <li class="flex items-center text-gray-700 dark:text-gray-300">
                            <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('Performance tracking and productivity insights') }}
                        </li>
                    </ul>
                    <div class="pt-4">
                        <a href="/login" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold rounded-xl hover:from-purple-700 hover:to-pink-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                            {{ __('View Analytics') }}
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="relative" data-aos="fade-left" data-aos-delay="200">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800">
                        <img src="{{ asset(cms()->approach_image) }}" alt="Analytics Dashboard" class="w-full h-auto">
                        <!-- Live indicator -->
                        <div class="absolute top-4 right-4 flex items-center space-x-2 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                            <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
                            <span>{{ __('Live Data') }}</span>
                        </div>
                    </div>
                    <!-- Floating elements -->
                    <div class="absolute -bottom-4 -left-4 w-20 h-20 bg-gradient-to-br from-purple-400 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg transform rotate-12 animate-bounce">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
