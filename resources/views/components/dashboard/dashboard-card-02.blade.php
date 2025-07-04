<!-- Enhanced Dashboard Card 02 Component -->
<div class="group relative flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white/80 dark:bg-gray-900/80 backdrop-blur-lg border border-gray-200/50 dark:border-gray-700/50 rounded-2xl shadow-lg shadow-gray-200/20 dark:shadow-gray-900/40 hover:shadow-xl hover:shadow-gray-200/30 dark:hover:shadow-gray-900/60 transition-all duration-300 hover:scale-[1.02] hover:-translate-y-1 overflow-hidden">
    
    <!-- Gradient Background Overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-transparent via-transparent to-orange-50/30 dark:to-orange-900/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
    
    <!-- Card Content -->
    <div class="relative px-6 py-6">
        <!-- Header Section -->
        <header class="flex justify-between items-start mb-4">
            <!-- Enhanced Icon Container -->
            <div class="relative">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-orange-500 to-red-500 flex items-center justify-center shadow-lg shadow-orange-500/25 group-hover:shadow-orange-500/40 transition-all duration-300 group-hover:scale-110">
                    @if (auth('web')->user()->role == 'employee')
                        <!-- Pending Reports Icon -->
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    @elseif (auth('web')->user()->role == 'client')
                        <!-- Pending Tasks Icon -->
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    @else
                        <!-- Employees Icon -->
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                        </svg>
                    @endif
                </div>
                <!-- Decorative Ring -->
                <div class="absolute inset-0 rounded-xl ring-2 ring-orange-500/20 group-hover:ring-orange-500/40 transition-all duration-300 scale-110"></div>
            </div>

            <!-- Status Indicator -->
            <div class="flex items-center gap-2">
                @if (auth('web')->user()->role == 'employee' || auth('web')->user()->role == 'client')
                    <div class="w-2 h-2 bg-yellow-500 rounded-full animate-pulse"></div>
                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400">{{ __('Pending') }}</span>
                @else
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400">{{ __('Active') }}</span>
                @endif
            </div>
        </header>

        <!-- Content Section -->
        <div class="space-y-3">
            @if (auth('web')->user()->role == 'employee')
                <!-- Pending Reports Section -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3 flex items-center gap-2">
                        {{ __('Pending') }} {{ __('Report(s)') }}
                        <span class="text-xs bg-yellow-100 dark:bg-yellow-900/50 text-yellow-600 dark:text-yellow-400 px-2 py-1 rounded-full font-medium">
                            {{ __('Awaiting') }}
                        </span>
                    </h2>
                    <div class="flex items-end justify-between">
                        <div class="flex items-baseline gap-3">
                            <div class="text-4xl font-bold text-gray-900 dark:text-gray-100 transition-all duration-300 group-hover:text-orange-600 dark:group-hover:text-orange-400">
                                {{ number_format(reportCount('pending')) }}
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400 font-medium">
                                {{ __('Reports') }}
                            </div>
                        </div>
                        <!-- Clock Indicator -->
                        <div class="flex items-center gap-1 text-yellow-600 dark:text-yellow-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-xs font-medium">{{ __('Pending') }}</span>
                        </div>
                    </div>
                </div>
                
            @elseif (auth('web')->user()->role == 'client')
                <!-- Pending Tasks Section -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3 flex items-center gap-2">
                        {{ __('Pending') }} {{ __('Task(s)') }}
                        <span class="text-xs bg-orange-100 dark:bg-orange-900/50 text-orange-600 dark:text-orange-400 px-2 py-1 rounded-full font-medium">
                            {{ __('In Queue') }}
                        </span>
                    </h2>
                    <div class="flex items-end justify-between">
                        <div class="flex items-baseline gap-3">
                            <div class="text-4xl font-bold text-gray-900 dark:text-gray-100 transition-all duration-300 group-hover:text-orange-600 dark:group-hover:text-orange-400">
                                {{ number_format(taskCount('pending')) }}
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400 font-medium">
                                {{ __('Tasks') }}
                            </div>
                        </div>
                        <!-- Queue Indicator -->
                        <div class="flex items-center gap-1 text-orange-600 dark:text-orange-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            <span class="text-xs font-medium">{{ __('Queued') }}</span>
                        </div>
                    </div>
                </div>
                
            @else
                <!-- Employees Section -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3 flex items-center gap-2">
                        {{ __('Employee(s)') }}
                        <span class="text-xs bg-blue-100 dark:bg-blue-900/50 text-blue-600 dark:text-blue-400 px-2 py-1 rounded-full font-medium">
                            {{ __('Team') }}
                        </span>
                    </h2>
                    <div class="flex items-end justify-between">
                        <div class="flex items-baseline gap-3">
                            <div class="text-4xl font-bold text-gray-900 dark:text-gray-100 transition-all duration-300 group-hover:text-orange-600 dark:group-hover:text-orange-400">
                                {{ number_format(employeeCount()) }}
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400 font-medium">
                                {{ __('Members') }}
                            </div>
                        </div>
                        <!-- Team Indicator -->
                        <div class="flex items-center gap-1 text-blue-600 dark:text-blue-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <span class="text-xs font-medium">{{ __('Active') }}</span>
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
                <button class="text-xs font-medium text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 transition-colors duration-200 flex items-center gap-1 group/btn">
                    {{ __('View Details') }}
                    <svg class="w-3 h-3 transition-transform duration-200 group-hover/btn:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Loading State Overlay -->
    <div class="absolute inset-0 bg-white/50 dark:bg-gray-900/50 backdrop-blur-sm rounded-2xl flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-200" id="card-loading-02-{{ uniqid() }}">
        <div class="w-8 h-8 border-2 border-orange-200 border-t-orange-600 rounded-full animate-spin"></div>
    </div>
</div>
