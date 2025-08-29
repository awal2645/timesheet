<!-- Enhanced Welcome Banner Component -->
<div class="relative overflow-hidden bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-2xl shadow-2xl shadow-indigo-500/25 mb-8">
    <!-- Animated Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent transform -skew-x-12 translate-x-full animate-pulse"></div>
        <svg class="absolute top-0 left-0 w-full h-full" viewBox="0 0 400 200" fill="none">
            <defs>
                <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="0.5" opacity="0.3"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#grid)"/>
        </svg>
    </div>
    
    <!-- Content Container -->
    <div class="relative px-6 lg:px-8 py-8 lg:py-12">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <!-- Welcome Content -->
            <div class="flex-1">
                <!-- Greeting Section -->
                <div class="mb-4">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-2 h-2 bg-yellow-400 rounded-full animate-pulse"></div>
                        <span class="text-indigo-200 text-sm font-medium">
                            {{ now()->format('l, F j, Y') }}
                        </span>
                    </div>
                    <h1 class="text-3xl lg:text-4xl font-bold text-white mb-2">
                        {{ __('Welcome back') }}, 
                        <span class="bg-gradient-to-r from-yellow-300 to-orange-300 bg-clip-text text-transparent">
                            {{ auth()->user()->name ?? __('User') }}
                        </span>! 👋
                    </h1>
                    <p class="text-lg text-indigo-100 leading-relaxed">
                        @if (auth('web')->user()->role == 'employee')
                            {{ __('Ready to track your time and submit reports? Let\'s make today productive!') }}
                        @elseif (auth('web')->user()->role == 'employer')
                            {{ __('Manage your team and projects efficiently. Your dashboard is ready!') }}
                        @elseif (auth('web')->user()->role == 'client')
                            {{ __('Track project progress and manage tasks. Everything is at your fingertips!') }}
                        @else
                            {{ __('Your comprehensive timesheet management system is ready to go!') }}
                        @endif
                    </p>
                </div>

                <!-- Quick Stats -->
                <div class="flex flex-wrap gap-4">
                    <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-lg px-3 py-2">
                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-white font-semibold">{{ __('System Active') }}</div>
                            <div class="text-indigo-200 text-xs">{{ __('All services running') }}</div>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-lg px-3 py-2">
                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-white font-semibold">{{ now()->format('H:i') }}</div>
                            <div class="text-indigo-200 text-xs">{{ __('Current time') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Section -->
            <div class="flex flex-col lg:flex-row gap-4 lg:gap-6">
                <!-- Role-specific Quick Action -->
                @if (auth('web')->user()->role == 'employee')
                    <a href="#" class="group bg-white/15 hover:bg-white/25 backdrop-blur-sm border border-white/20 rounded-xl px-6 py-4 transition-all duration-300 hover:scale-105 hover:-translate-y-1">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-gradient-to-r from-green-400 to-emerald-500 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-white font-semibold">{{ __('Start Time Tracking') }}</div>
                                <div class="text-indigo-200 text-sm">{{ __('Begin your work session') }}</div>
                            </div>
                            <svg class="w-5 h-5 text-white/70 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                @elseif (auth('web')->user()->role == 'employer')
                    <a href="#" class="group bg-white/15 hover:bg-white/25 backdrop-blur-sm border border-white/20 rounded-xl px-6 py-4 transition-all duration-300 hover:scale-105 hover:-translate-y-1">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-400 to-indigo-500 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-white font-semibold">{{ __('Manage Team') }}</div>
                                <div class="text-indigo-200 text-sm">{{ __('View team performance') }}</div>
                            </div>
                            <svg class="w-5 h-5 text-white/70 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                @elseif (auth('web')->user()->role == 'client')
                    <a href="#" class="group bg-white/15 hover:bg-white/25 backdrop-blur-sm border border-white/20 rounded-xl px-6 py-4 transition-all duration-300 hover:scale-105 hover:-translate-y-1">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-gradient-to-r from-emerald-400 to-teal-500 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-white font-semibold">{{ __('View Projects') }}</div>
                                <div class="text-indigo-200 text-sm">{{ __('Track project progress') }}</div>
                            </div>
                            <svg class="w-5 h-5 text-white/70 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                @else
                    <a href="#" class="group bg-white/15 hover:bg-white/25 backdrop-blur-sm border border-white/20 rounded-xl px-6 py-4 transition-all duration-300 hover:scale-105 hover:-translate-y-1">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-gradient-to-r from-orange-400 to-red-500 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-white font-semibold">{{ __('View Reports') }}</div>
                                <div class="text-indigo-200 text-sm">{{ __('Analyze system data') }}</div>
                            </div>
                            <svg class="w-5 h-5 text-white/70 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                @endif

                <!-- Settings Button -->
                <button class="group bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/20 rounded-xl p-4 transition-all duration-300 hover:scale-105">
                    <svg class="w-6 h-6 text-white group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Decorative Elements -->
    <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-bl from-white/5 to-transparent rounded-full -translate-y-20 translate-x-20"></div>
    <div class="absolute bottom-0 left-0 w-32 h-32 bg-gradient-to-tr from-white/5 to-transparent rounded-full translate-y-16 -translate-x-16"></div>
</div>
