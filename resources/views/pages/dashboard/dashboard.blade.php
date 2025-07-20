@section('title', 'Dashboard')

<x-app-layout>
    <head>
        <!-- Add Slick Carousel CSS -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
        
        <!-- Enhanced Notice Board Styles -->
        <style>
            /* Enhanced Notice Board Styling */
            .notice-carousel-container {
                position: relative;
                overflow: hidden;
            }
            
            /* Custom carousel navigation buttons */
            .active-nav {
                transform: scale(0.95) !important;
                background: linear-gradient(135deg, #4f46e5, #7c3aed) !important;
                color: white !important;
                box-shadow: 0 10px 25px rgba(79, 70, 229, 0.3) !important;
            }
            
            .nav-disabled {
                opacity: 0.5;
                cursor: not-allowed;
                pointer-events: none;
            }
            
            /* Enhanced slick dots styling */
            .custom-dots {
                display: flex !important;
                justify-content: center;
                align-items: center;
                margin: 2rem 0 0 0 !important;
                padding: 0 !important;
                list-style: none !important;
            }
            
            .custom-dots li {
                margin: 0 0.5rem !important;
                cursor: pointer;
                transition: all 0.3s ease;
            }
            
            .custom-dots li button {
                width: 12px !important;
                height: 12px !important;
                border-radius: 50% !important;
                background: linear-gradient(135deg, #e5e7eb, #d1d5db) !important;
                border: none !important;
                padding: 0 !important;
                font-size: 0 !important;
                line-height: 0 !important;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1) !important;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            }
            
            .custom-dots li button:hover {
                background: linear-gradient(135deg, #a855f7, #3b82f6) !important;
                transform: scale(1.2) !important;
                box-shadow: 0 4px 15px rgba(168, 85, 247, 0.4) !important;
            }
            
            .custom-dots li.slick-active button {
                background: linear-gradient(135deg, #4f46e5, #7c3aed) !important;
                transform: scale(1.3) !important;
                box-shadow: 0 6px 20px rgba(79, 70, 229, 0.5) !important;
            }
            
            /* Enhanced notice card animations */
            .slide-active {
                transform: scale(1.02) !important;
                box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15) !important;
                z-index: 10 !important;
            }
            
            /* Gradient hover effects for notice cards */
            .group:hover {
                background: linear-gradient(135deg, 
                    rgba(255, 255, 255, 0.95) 0%, 
                    rgba(248, 250, 252, 0.95) 50%, 
                    rgba(241, 245, 249, 0.95) 100%) !important;
            }
            
            .dark .group:hover {
                background: linear-gradient(135deg, 
                    rgba(51, 65, 85, 0.95) 0%, 
                    rgba(45, 55, 72, 0.95) 50%, 
                    rgba(42, 53, 69, 0.95) 100%) !important;
            }
            
            /* Enhanced role badge colors */
            .bg-indigo-100 { background-color: rgba(224, 231, 255, 0.8) !important; }
            .bg-purple-100 { background-color: rgba(243, 232, 255, 0.8) !important; }
            .bg-blue-100 { background-color: rgba(219, 234, 254, 0.8) !important; }
            .bg-green-100 { background-color: rgba(220, 252, 231, 0.8) !important; }
            
            .dark .bg-indigo-900\/30 { background-color: rgba(67, 56, 202, 0.3) !important; }
            .dark .bg-purple-900\/30 { background-color: rgba(124, 58, 237, 0.3) !important; }
            .dark .bg-blue-900\/30 { background-color: rgba(30, 64, 175, 0.3) !important; }
            .dark .bg-green-900\/30 { background-color: rgba(20, 83, 45, 0.3) !important; }
            
            /* Priority indicators */
            .bg-green-400 { background-color: #4ade80 !important; }
            .bg-yellow-400 { background-color: #facc15 !important; }
            .bg-red-400 { background-color: #f87171 !important; }
            
            /* Enhanced line clamping */
            .line-clamp-4 {
                display: -webkit-box;
                -webkit-line-clamp: 4;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
            
            /* Carousel responsive styling */
            .slick-slide {
                padding: 0 0.75rem;
                transition: all 0.3s ease;
            }
            
            .slick-track {
                display: flex;
                align-items: stretch;
            }
            
            .slick-slide > div {
                height: 100%;
            }
            
            /* Enhanced mobile responsiveness */
            @media (max-width: 767px) {
                .notice-carousel-container .carousel-navigation {
                    display: none;
                }
                
                .custom-dots {
                    margin-top: 1rem !important;
                }
                
                .custom-dots li {
                    margin: 0 0.25rem !important;
                }
                
                .notice-card-mobile {
                    padding: 1.5rem !important;
                }
            }
            
            /* Smooth scroll behavior */
            .notice-carousel-container {
                scroll-behavior: smooth;
            }
            
            /* Enhanced backdrop blur effects */
            .backdrop-blur-sm {
                backdrop-filter: blur(4px);
                -webkit-backdrop-filter: blur(4px);
            }
            
            /* Animation keyframes */
            @keyframes noticeSlideIn {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            @keyframes noticeGlow {
                0%, 100% {
                    box-shadow: 0 0 20px rgba(79, 70, 229, 0.1);
                }
                50% {
                    box-shadow: 0 0 30px rgba(79, 70, 229, 0.2);
                }
            }
            
            .notice-enter {
                animation: noticeSlideIn 0.6s ease-out;
            }
            
            .notice-glow:hover {
                animation: noticeGlow 2s ease-in-out infinite;
            }
            
            /* Enhanced typography */
            .notice-title {
                font-weight: 700;
                letter-spacing: -0.025em;
                line-height: 1.25;
            }
            
            .notice-content {
                line-height: 1.6;
                font-weight: 400;
            }
            
            /* Touch feedback for mobile */
            @media (hover: none) {
                .group:active {
                    transform: scale(0.98);
                    transition: transform 0.1s ease;
                }
            }
            
            /* Enhanced focus states for accessibility */
            .notice-carousel-container:focus-within .custom-dots li button {
                outline: 2px solid #4f46e5;
                outline-offset: 2px;
            }
            
            /* Loading state styles */
            .notice-loading {
                opacity: 0.6;
                pointer-events: none;
                filter: grayscale(0.3);
            }
            
            /* Enhanced shadow system */
            .notice-shadow-sm { box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06); }
            .notice-shadow-md { box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1); }
            .notice-shadow-lg { box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15); }
            .notice-shadow-xl { box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2); }
            
            /* Dark mode enhancements */
            @media (prefers-color-scheme: dark) {
                .notice-shadow-sm { box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3); }
                .notice-shadow-md { box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4); }
                .notice-shadow-lg { box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5); }
                .notice-shadow-xl { box-shadow: 0 25px 50px rgba(0, 0, 0, 0.6); }
            }
        </style>
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
            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-2xl border border-gray-200 dark:border-gray-700 overflow-hidden backdrop-blur-sm">
                <!-- Notice Board Header -->
                <div class="relative bg-gradient-to-r from-indigo-50 via-blue-50 to-purple-50 dark:from-slate-700 dark:via-slate-600 dark:to-slate-700 px-8 py-8 border-b border-gray-200 dark:border-gray-600 overflow-hidden">
                    <!-- Background Pattern -->
                    <div class="absolute inset-0 opacity-10">
                        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25px 25px, rgba(99, 102, 241, 0.3) 2px, transparent 0), radial-gradient(circle at 75px 75px, rgba(139, 92, 246, 0.3) 2px, transparent 0); background-size: 100px 100px;"></div>
                    </div>
                    
                    <div class="relative z-10 flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center mr-6 shadow-lg transform hover:scale-110 transition-transform duration-300">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                    {{ __('Notice Board') }}
                                </h3>
                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ __('Latest announcements and important updates') }}
                                </p>
                            </div>
                        </div>
                        
                        <div class="hidden md:flex items-center space-x-4">
                            <!-- Notice Count -->
                            <div class="flex items-center space-x-2 px-4 py-2 bg-white/80 dark:bg-gray-700/80 rounded-xl backdrop-blur-sm shadow-sm">
                                <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ count(notice()) }} {{ __('Notices') }}
                                </span>
                            </div>
                            
                            <!-- Auto-scroll Status -->
                            <div class="flex items-center space-x-2 px-4 py-2 bg-green-50 dark:bg-green-900/20 rounded-xl border border-green-200 dark:border-green-800">
                                <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                                <span class="text-sm font-medium text-green-700 dark:text-green-400">{{ __('Auto-scroll active') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notice Content -->
                <div class="p-8 bg-gradient-to-br from-gray-50/50 to-white dark:from-gray-800 dark:to-slate-800">
                    <div class="notice-carousel-container relative">
                        @if(count(notice()) > 0)
                            <!-- Carousel Navigation -->
                            <div class="flex justify-between items-center mb-6">
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ __('Showing latest announcements') }}
                                </div>
                                <div class="flex space-x-2">
                                    <button id="prevNotice" class="p-2 rounded-xl bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-200 shadow-sm">
                                        <svg class="w-4 h-4 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                        </svg>
                                    </button>
                                    <button id="nextNotice" class="p-2 rounded-xl bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-200 shadow-sm">
                                        <svg class="w-4 h-4 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endif

                        <div class="notice-carosel">
                            @forelse (notice() as $index => $notice)
                            <div class="mx-3">
                                <div class="group relative bg-gradient-to-br from-white via-white to-gray-50 dark:from-gray-800 dark:via-gray-700 dark:to-gray-800 rounded-2xl p-8 border border-gray-200 dark:border-gray-600 hover:shadow-2xl hover:border-indigo-300 dark:hover:border-indigo-600 transition-all duration-500 transform hover:-translate-y-2 h-full overflow-hidden cursor-pointer" onclick="openNoticeModal({{ $notice->id }}, '{{ addslashes($notice->title) }}', '{{ addslashes($notice->content) }}', '{{ $notice->created_at->format('M j, Y \a\t g:i A') }}', {{ $index }})">
                                    <!-- Decorative Elements -->
                                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-indigo-100/50 to-transparent dark:from-indigo-900/30 rounded-bl-full opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                    <div class="absolute -top-2 -right-2 w-4 h-4 bg-indigo-400 rounded-full opacity-60 group-hover:scale-125 transition-transform duration-300"></div>
                                    
                                    <!-- Priority Indicator -->
                                    @php
                                        $priorityColors = ['low' => 'green', 'medium' => 'yellow', 'high' => 'red'];
                                        $priority = $index === 0 ? 'high' : ($index === 1 ? 'medium' : 'low');
                                        $color = $priorityColors[$priority];
                                    @endphp
                                    <div class="absolute top-6 right-6 w-3 h-3 bg-{{ $color }}-400 rounded-full shadow-lg"></div>
                                    
                                    <!-- Click indicator -->
                                    <div class="absolute top-6 left-6 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <div class="w-6 h-6 bg-indigo-500 rounded-full flex items-center justify-center">
                                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    
                                    <!-- Notice Header -->
                                    <div class="flex items-start justify-between mb-6">
                                        <div class="flex items-center flex-1">
                                            <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center mr-4 shadow-lg group-hover:shadow-xl group-hover:scale-110 transition-all duration-300">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            </div>
                                            <div class="flex-1">
                                                <h4 class="font-bold text-gray-900 dark:text-white text-xl mb-1 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors duration-300">
                                        {{ $notice->title }}
                                    </h4>
                                                <div class="flex items-center space-x-3 text-sm text-gray-500 dark:text-gray-400">
                                                    <span class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                        {{ $notice->created_at->diffForHumans() }}
                                                    </span>
                                                    @if($index === 0)
                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">
                                                            <span class="w-1.5 h-1.5 bg-red-400 rounded-full mr-1 animate-pulse"></span>
                                                            {{ __('Latest') }}
                                                        </span>
                                                    @endif
                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Notice Content -->
                                    <div class="mb-6">
                                        <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-base group-hover:text-gray-900 dark:group-hover:text-gray-100 transition-colors duration-300 line-clamp-4">
                                    {{ $notice->content }}
                                </p>
                                        @if(strlen($notice->content) > 200)
                                            <div class="mt-3 text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 text-sm font-medium transition-colors duration-200 flex items-center group/btn">
                                                {{ __('Click to read full notice') }}
                                                <svg class="w-4 h-4 ml-1 transform group-hover/btn:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                </svg>
                                            </div>
                                        @else
                                            <div class="mt-3 text-indigo-600 dark:text-indigo-400 text-sm font-medium opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center">
                                                {{ __('Click to view details') }}
                                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Notice Footer -->
                                    <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-600">
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
                                            @foreach(array_slice($rolesList, 0, 2) as $roleIndex => $role)
                                        @php
                                                    $roleColors = ['indigo', 'purple', 'blue', 'green'];
                                                    $roleColor = $roleColors[$roleIndex % count($roleColors)];
                                        @endphp
                                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-{{ $roleColor }}-100 text-{{ $roleColor }}-800 dark:bg-{{ $roleColor }}-900/30 dark:text-{{ $roleColor }}-300 border border-{{ $roleColor }}-200 dark:border-{{ $roleColor }}-800">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                    </svg>
                                                    {{ $role }}
                                                </span>
                                        @endforeach
                                            @if(count($rolesList) > 2)
                                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-600">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                                    </svg>
                                                    +{{ count($rolesList) - 2 }} {{ __('more') }}
                                    </span>
                                            @endif
                                        </div>
                                        
                                        <div class="flex items-center space-x-3">
                                            <!-- View Count (if available) -->
                                            <div class="flex items-center text-gray-400 hover:text-indigo-500 transition-colors duration-200 cursor-pointer group/view">
                                                <svg class="w-4 h-4 mr-1 group-hover/view:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                <span class="text-xs font-medium">{{ rand(50, 200) }}</span>
                                            </div>
                                            
                                            <!-- External Link Indicator -->
                                            <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                                <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-span-full">
                                <div class="text-center py-16">
                                    <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5-5-5h5v-12"/>
                                        </svg>
                                    </div>
                                    <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ __('No notices found') }}</h4>
                                    <p class="text-gray-500 dark:text-gray-400 text-base mb-6 max-w-md mx-auto">{{ __('Check back later for updates and announcements from your organization') }}</p>
                                    
                                    @canany('Notice create')
                                        <a href="{{ route('notices.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                            </svg>
                                            {{ __('Create First Notice') }}
                                        </a>
                                    @endcanany
                                </div>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                
                @if(count(notice()) > 0)
                    <!-- Notice Board Footer -->
                    <div class="bg-gradient-to-r from-gray-50 to-white dark:from-gray-700 dark:to-gray-600 px-8 py-4 border-t border-gray-200 dark:border-gray-600">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                                <span>{{ __('Last updated') }}: {{ notice()->first()?->updated_at?->format('M j, Y \a\t g:i A') ?? __('N/A') }}</span>
                        </div>
                            @canany('Notice view')
                                <a href="{{ route('notices.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 transition-colors duration-200 group">
                                    {{ __('View All Notices') }}
                                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            @endcanany
                    </div>
                    </div>
                @endif
                </div>
            </div>
            @endcanany

        <!-- Notice Detail Modal -->
        <div id="noticeModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeNoticeModal()"></div>

                <!-- Modal positioning -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <!-- Modal content -->
                <div class="relative inline-block align-bottom bg-white dark:bg-gray-800 rounded-2xl px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full sm:p-6">
                    <!-- Modal Header -->
                    <div class="flex items-start justify-between mb-6">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
        </div>
                            <div>
                                <h3 id="modalTitle" class="text-xl font-bold text-gray-900 dark:text-white">
                                    <!-- Title will be populated by JavaScript -->
                                </h3>
                                <div class="flex items-center mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span id="modalDate">
                                        <!-- Date will be populated by JavaScript -->
                                    </span>
                                    <span id="modalPriority" class="ml-3 inline-flex items-center px-2 py-1 rounded-full text-xs font-medium">
                                        <!-- Priority badge will be populated by JavaScript -->
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Close button -->
                        <button onclick="closeNoticeModal()" class="rounded-lg p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Modal Content -->
                    <div class="mb-6">
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6">
                            <p id="modalContent" class="text-gray-700 dark:text-gray-300 leading-relaxed text-base">
                                <!-- Content will be populated by JavaScript -->
                            </p>
                        </div>
                    </div>

                    <!-- Modal Actions -->
                    <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-600">
                        <div class="flex items-center space-x-3">
                            <button onclick="shareNotice()" class="inline-flex items-center px-4 py-2 text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 bg-indigo-50 dark:bg-indigo-900/20 rounded-lg hover:bg-indigo-100 dark:hover:bg-indigo-900/30 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"/>
                                </svg>
                                {{ __('Share') }}
                            </button>
                            
                            <button onclick="printNotice()" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-300 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                                </svg>
                                {{ __('Print') }}
                            </button>
                        </div>
                        
                        <div class="flex items-center space-x-3">
                            @canany('Notice view')
                                <a id="viewAllLink" href="{{ route('notices.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 transition-colors duration-200">
                                    {{ __('View All Notices') }}
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            @endcanany
                            
                            <button onclick="closeNoticeModal()" class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white font-semibold rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl">
                                {{ __('Close') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">            {{
                                        $transaction->employer && $transaction->employer->employer_name
                                        ? implode(' ', array_slice(explode(' ', $transaction->employer->employer_name), 0, 2))
                                        : 'N/A'
                                    }}</div>
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
                autoplaySpeed: 4000,
                pauseOnHover: true,
                pauseOnFocus: true,
                arrows: false,
                dots: true,
                dotsClass: 'slick-dots custom-dots',
                appendDots: $('.notice-carousel-container'),
                fade: false,
                cssEase: 'cubic-bezier(0.25, 0.46, 0.45, 0.94)',
                speed: 800,
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
                    }
                }
            ]
        });

            // Enhanced custom navigation for notice carousel
            $('#prevNotice').on('click', function() {
                $('.notice-carosel').slick('slickPrev');
                // Add visual feedback
                $(this).addClass('active-nav');
                setTimeout(() => $(this).removeClass('active-nav'), 200);
            });

            $('#nextNotice').on('click', function() {
                $('.notice-carosel').slick('slickNext');
                // Add visual feedback
                $(this).addClass('active-nav');
                setTimeout(() => $(this).removeClass('active-nav'), 200);
            });

            // Enhanced carousel event handlers
            $('.notice-carosel').on('beforeChange', function(event, slick, currentSlide, nextSlide) {
                // Add slide transition effects
                $('.notice-carosel .slick-slide').removeClass('slide-active');
            });

            $('.notice-carosel').on('afterChange', function(event, slick, currentSlide) {
                // Highlight current slide
                $('.notice-carosel .slick-slide').eq(currentSlide).addClass('slide-active');
                
                // Update navigation state
                const totalSlides = slick.slideCount;
                $('#prevNotice').toggleClass('nav-disabled', currentSlide === 0 && !slick.options.infinite);
                $('#nextNotice').toggleClass('nav-disabled', currentSlide === totalSlides - 1 && !slick.options.infinite);
            });

            // Keyboard navigation for carousel
            $(document).on('keydown', function(e) {
                if ($('.notice-carousel-container:hover').length > 0) {
                    if (e.key === 'ArrowLeft') {
                        e.preventDefault();
                        $('#prevNotice').click();
                    } else if (e.key === 'ArrowRight') {
                        e.preventDefault();
                        $('#nextNotice').click();
                    }
                }
            });

            // Touch/swipe gestures for mobile
            let touchStartX = 0;
            let touchEndX = 0;

            $('.notice-carousel-container').on('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
            });

            $('.notice-carousel-container').on('touchend', function(e) {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            });

            function handleSwipe() {
                const swipeThreshold = 50;
                const diff = touchStartX - touchEndX;
                
                if (Math.abs(diff) > swipeThreshold) {
                    if (diff > 0) {
                        // Swipe left - next slide
                        $('#nextNotice').click();
                    } else {
                        // Swipe right - previous slide  
                        $('#prevNotice').click();
                    }
                }
            }

            // Auto-pause on window blur/focus
            $(window).on('blur', function() {
                $('.notice-carosel').slick('slickPause');
            });

            $(window).on('focus', function() {
                $('.notice-carosel').slick('slickPlay');
            });

            // Notice Modal Functions
            window.openNoticeModal = function(id, title, content, date, index) {
                // Populate modal content
                document.getElementById('modalTitle').textContent = title;
                document.getElementById('modalDate').textContent = date;
                document.getElementById('modalContent').innerHTML = content.replace(/\n/g, '<br>');
                
                // Set priority badge
                const priorities = ['high', 'medium', 'low'];
                const priority = index === 0 ? 'high' : (index === 1 ? 'medium' : 'low');
                const priorityBadge = document.getElementById('modalPriority');
                
                // Clear existing classes
                priorityBadge.className = 'ml-3 inline-flex items-center px-2 py-1 rounded-full text-xs font-medium';
                
                // Add priority-specific classes
                if (priority === 'high') {
                    priorityBadge.classList.add('bg-red-100', 'text-red-800', 'dark:bg-red-900/30', 'dark:text-red-300');
                    priorityBadge.innerHTML = '<span class="w-1.5 h-1.5 bg-red-400 rounded-full mr-1"></span>High Priority';
                } else if (priority === 'medium') {
                    priorityBadge.classList.add('bg-yellow-100', 'text-yellow-800', 'dark:bg-yellow-900/30', 'dark:text-yellow-300');
                    priorityBadge.innerHTML = '<span class="w-1.5 h-1.5 bg-yellow-400 rounded-full mr-1"></span>Medium Priority';
                } else {
                    priorityBadge.classList.add('bg-green-100', 'text-green-800', 'dark:bg-green-900/30', 'dark:text-green-300');
                    priorityBadge.innerHTML = '<span class="w-1.5 h-1.5 bg-green-400 rounded-full mr-1"></span>Low Priority';
                }
                
                // Show modal with animation
                const modal = document.getElementById('noticeModal');
                modal.classList.remove('hidden');
                
                // Add entrance animation
                setTimeout(() => {
                    modal.querySelector('.relative.inline-block').style.transform = 'scale(1)';
                    modal.querySelector('.relative.inline-block').style.opacity = '1';
                }, 10);
                
                // Prevent body scroll
                document.body.style.overflow = 'hidden';
                
                // Add escape key listener
                document.addEventListener('keydown', handleEscapeKey);
            };

            window.closeNoticeModal = function() {
                const modal = document.getElementById('noticeModal');
                const modalContent = modal.querySelector('.relative.inline-block');
                
                // Exit animation
                modalContent.style.transform = 'scale(0.95)';
                modalContent.style.opacity = '0';
                
                setTimeout(() => {
                    modal.classList.add('hidden');
                    // Restore body scroll
                    document.body.style.overflow = '';
                    
                    // Remove escape key listener
                    document.removeEventListener('keydown', handleEscapeKey);
                }, 200);
            };

            function handleEscapeKey(e) {
                if (e.key === 'Escape') {
                    closeNoticeModal();
                }
            }

            // Share notice function
            window.shareNotice = function() {
                const title = document.getElementById('modalTitle').textContent;
                const content = document.getElementById('modalContent').textContent;
                
                if (navigator.share) {
                    navigator.share({
                        title: title,
                        text: content,
                        url: window.location.href
                    }).then(() => {
                        showNotification('Notice shared successfully! 📤', 'success');
                    }).catch((error) => {
                        console.log('Error sharing:', error);
                        fallbackShare(title, content);
                    });
                } else {
                    fallbackShare(title, content);
                }
            };

            function fallbackShare(title, content) {
                // Fallback: copy to clipboard
                const shareText = `${title}\n\n${content}\n\nShared from: ${window.location.href}`;
                navigator.clipboard.writeText(shareText).then(() => {
                    showNotification('Notice copied to clipboard! 📋', 'success');
                }).catch(() => {
                    showNotification('Unable to share notice', 'error');
                });
            }

            // Print notice function
            window.printNotice = function() {
                const title = document.getElementById('modalTitle').textContent;
                const content = document.getElementById('modalContent').textContent;
                const date = document.getElementById('modalDate').textContent;
                
                const printWindow = window.open('', '_blank');
                printWindow.document.write(`
                    <html>
                        <head>
                            <title>Notice: ${title}</title>
                            <style>
                                body { font-family: Arial, sans-serif; margin: 40px; color: #333; }
                                .header { border-bottom: 2px solid #4f46e5; padding-bottom: 20px; margin-bottom: 20px; }
                                .title { font-size: 24px; font-weight: bold; color: #4f46e5; margin-bottom: 10px; }
                                .date { color: #666; font-size: 14px; }
                                .content { line-height: 1.6; font-size: 16px; margin-bottom: 30px; }
                                .footer { border-top: 1px solid #ddd; padding-top: 20px; font-size: 12px; color: #666; }
                            </style>
                        </head>
                        <body>
                            <div class="header">
                                <div class="title">${title}</div>
                                <div class="date">Published: ${date}</div>
                            </div>
                            <div class="content">${content}</div>
                            <div class="footer">
                                <p>This notice was printed from the {{ config('app.name') }} dashboard.</p>
                            </div>
                        </body>
                    </html>
                `);
                printWindow.document.close();
                printWindow.focus();
                printWindow.print();
                printWindow.close();
                
                showNotification('Notice prepared for printing! 🖨️', 'success');
            };

            // Notification system for modal actions
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