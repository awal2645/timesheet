<!-- Enhanced Dashboard Card 03 Component -->
<div class="group relative flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white/80 dark:bg-gray-900/80 backdrop-blur-lg border border-gray-200/50 dark:border-gray-700/50 rounded-2xl shadow-lg shadow-gray-200/20 dark:shadow-gray-900/40 hover:shadow-xl hover:shadow-gray-200/30 dark:hover:shadow-gray-900/60 transition-all duration-300 hover:scale-[1.02] hover:-translate-y-1 overflow-hidden">
    
    <!-- Gradient Background Overlay -->
    @if (auth('web')->user()->role == 'employee')
        <div class="absolute inset-0 bg-gradient-to-br from-transparent via-transparent to-red-50/30 dark:to-red-900/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
    @elseif (auth('web')->user()->role == 'employer')
        <div class="absolute inset-0 bg-gradient-to-br from-transparent via-transparent to-purple-50/30 dark:to-purple-900/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
    @elseif (auth('web')->user()->role == 'client')
        <div class="absolute inset-0 bg-gradient-to-br from-transparent via-transparent to-emerald-50/30 dark:to-emerald-900/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
    @else
        <div class="absolute inset-0 bg-gradient-to-br from-transparent via-transparent to-amber-50/30 dark:to-amber-900/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
    @endif
    
    <!-- Card Content -->
    <div class="relative px-6 py-6">
        <!-- Header Section -->
        <header class="flex justify-between items-start mb-4">
            <!-- Enhanced Icon Container -->
            <div class="relative">
                @if (auth('web')->user()->role == 'employee')
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-red-500 to-pink-500 flex items-center justify-center shadow-lg shadow-red-500/25 group-hover:shadow-red-500/40 transition-all duration-300 group-hover:scale-110">
                        <!-- Report Decline Icon -->
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                @elseif (auth('web')->user()->role == 'employer')
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-purple-500 to-indigo-500 flex items-center justify-center shadow-lg shadow-purple-500/25 group-hover:shadow-purple-500/40 transition-all duration-300 group-hover:scale-110">
                        <!-- Clients Icon -->
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6"/>
                        </svg>
                    </div>
                @elseif (auth('web')->user()->role == 'client')
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-500 flex items-center justify-center shadow-lg shadow-emerald-500/25 group-hover:shadow-emerald-500/40 transition-all duration-300 group-hover:scale-110">
                        <!-- Completed Tasks Icon -->
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                @else
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-amber-500 to-yellow-500 flex items-center justify-center shadow-lg shadow-amber-500/25 group-hover:shadow-amber-500/40 transition-all duration-300 group-hover:scale-110">
                        <!-- Earnings Icon -->
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                    </div>
                @endif
                <!-- Decorative Ring -->
                <div class="absolute inset-0 rounded-xl ring-2 {{ auth('web')->user()->role == 'employee' ? 'ring-red-500/20 group-hover:ring-red-500/40' : (auth('web')->user()->role == 'employer' ? 'ring-purple-500/20 group-hover:ring-purple-500/40' : (auth('web')->user()->role == 'client' ? 'ring-emerald-500/20 group-hover:ring-emerald-500/40' : 'ring-amber-500/20 group-hover:ring-amber-500/40')) }} transition-all duration-300 scale-110"></div>
            </div>

            <!-- Status Indicator -->
            <div class="flex items-center gap-2">
                @if (auth('web')->user()->role == 'employee')
                    <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400">{{ __('Declined') }}</span>
                @elseif (auth('web')->user()->role == 'employer')
                    <div class="w-2 h-2 bg-purple-500 rounded-full animate-pulse"></div>
                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400">{{ __('Partners') }}</span>
                @elseif (auth('web')->user()->role == 'client')
                    <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400">{{ __('Completed') }}</span>
                @else
                    <div class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></div>
                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400">{{ __('Revenue') }}</span>
                @endif
            </div>
        </header>

        <!-- Content Section -->
        <div class="space-y-3">
            @if (auth('web')->user()->role == 'employee')
                <!-- Report Declines Section -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3 flex items-center gap-2">
                        {{ __('Report Decline(s)') }}
                        <span class="text-xs bg-red-100 dark:bg-red-900/50 text-red-600 dark:text-red-400 px-2 py-1 rounded-full font-medium">
                            {{ __('Review') }}
                        </span>
                    </h2>
                    <div class="flex items-end justify-between">
                        <div class="flex items-baseline gap-3">
                            <div class="text-4xl font-bold text-gray-900 dark:text-gray-100 transition-all duration-300 group-hover:text-red-600 dark:group-hover:text-red-400">
                                {{ number_format(reportCount('decline')) }}
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400 font-medium">
                                {{ __('Declined') }}
                            </div>
                        </div>
                        <!-- Warning Indicator -->
                        <div class="flex items-center gap-1 text-red-600 dark:text-red-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <span class="text-xs font-medium">{{ __('Needs Review') }}</span>
                        </div>
                    </div>
                </div>
                
            @elseif (auth('web')->user()->role == 'employer')
                <!-- Clients Section -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3 flex items-center gap-2">
                        {{ __('Client(s)') }}
                        <span class="text-xs bg-purple-100 dark:bg-purple-900/50 text-purple-600 dark:text-purple-400 px-2 py-1 rounded-full font-medium">
                            {{ __('Partners') }}
                        </span>
                    </h2>
                    <div class="flex items-end justify-between">
                        <div class="flex items-baseline gap-3">
                            <div class="text-4xl font-bold text-gray-900 dark:text-gray-100 transition-all duration-300 group-hover:text-purple-600 dark:group-hover:text-purple-400">
                                {{ number_format(clientCount()) }}
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400 font-medium">
                                {{ __('Clients') }}
                            </div>
                        </div>
                        <!-- Partnership Indicator -->
                        <div class="flex items-center gap-1 text-purple-600 dark:text-purple-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <span class="text-xs font-medium">{{ __('Active') }}</span>
                        </div>
                    </div>
                </div>
                
            @elseif (auth('web')->user()->role == 'client')
                <!-- Completed Tasks Section -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3 flex items-center gap-2">
                        {{ __('Completed') }} {{ __('Task(s)') }}
                        <span class="text-xs bg-emerald-100 dark:bg-emerald-900/50 text-emerald-600 dark:text-emerald-400 px-2 py-1 rounded-full font-medium">
                            {{ __('Finished') }}
                        </span>
                    </h2>
                    <div class="flex items-end justify-between">
                        <div class="flex items-baseline gap-3">
                            <div class="text-4xl font-bold text-gray-900 dark:text-gray-100 transition-all duration-300 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">
                                {{ number_format(taskCount('completed')) }}
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400 font-medium">
                                {{ __('Tasks') }}
                            </div>
                        </div>
                        <!-- Success Indicator -->
                        <div class="flex items-center gap-1 text-emerald-600 dark:text-emerald-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-xs font-medium">{{ __('Done') }}</span>
                        </div>
                    </div>
                </div>
                
            @else
                <!-- Earnings Section -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3 flex items-center gap-2">
                        {{ __('Earning(s)') }}
                        <span class="text-xs bg-amber-100 dark:bg-amber-900/50 text-amber-600 dark:text-amber-400 px-2 py-1 rounded-full font-medium">
                            {{ __('Revenue') }}
                        </span>
                    </h2>
                    <div class="flex items-end justify-between">
                        <div class="flex items-baseline gap-3">
                            <div class="text-4xl font-bold text-gray-900 dark:text-gray-100 transition-all duration-300 group-hover:text-amber-600 dark:group-hover:text-amber-400">
                                ${{ number_format(earningCount(), 2) }}
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400 font-medium">
                                {{ __('Total') }}
                            </div>
                        </div>
                        <!-- Money Indicator -->
                        <div class="flex items-center gap-1 text-amber-600 dark:text-amber-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11"/>
                            </svg>
                            <span class="text-xs font-medium">{{ __('Earned') }}</span>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Footer with Quick Action -->
        <div class="mt-6 pt-4 border-t border-gray-200/50 dark:border-gray-700/50">
            <div class="flex items-center justify-between">
                <div class="text-xs text-gray-500 dark:text-gray-400">
                    {{ __('Last updated') }}: {{ now()->format('M j, H:i') }}
                </div>
                <button class="text-xs font-medium {{ auth('web')->user()->role == 'employee' ? 'text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300' : (auth('web')->user()->role == 'employer' ? 'text-purple-600 dark:text-purple-400 hover:text-purple-700 dark:hover:text-purple-300' : (auth('web')->user()->role == 'client' ? 'text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300' : 'text-amber-600 dark:text-amber-400 hover:text-amber-700 dark:hover:text-amber-300')) }} transition-colors duration-200 flex items-center gap-1 group/btn">
                    {{ __('View Details') }}
                    <svg class="w-3 h-3 transition-transform duration-200 group-hover/btn:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Loading State Overlay -->
    <div class="absolute inset-0 bg-white/50 dark:bg-gray-900/50 backdrop-blur-sm rounded-2xl flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-200" id="card-loading-03-{{ uniqid() }}">
        <div class="w-8 h-8 border-2 {{ auth('web')->user()->role == 'employee' ? 'border-red-200 border-t-red-600' : (auth('web')->user()->role == 'employer' ? 'border-purple-200 border-t-purple-600' : (auth('web')->user()->role == 'client' ? 'border-emerald-200 border-t-emerald-600' : 'border-amber-200 border-t-amber-600')) }} rounded-full animate-spin"></div>
    </div>
</div>
