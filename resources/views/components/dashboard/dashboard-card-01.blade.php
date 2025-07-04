<!-- Enhanced Dashboard Card Component -->
<div class="group relative flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white/80 dark:bg-gray-900/80 backdrop-blur-lg border border-gray-200/50 dark:border-gray-700/50 rounded-2xl shadow-lg shadow-gray-200/20 dark:shadow-gray-900/40 hover:shadow-xl hover:shadow-gray-200/30 dark:hover:shadow-gray-900/60 transition-all duration-300 hover:scale-[1.02] hover:-translate-y-1 overflow-hidden">
    
    <!-- Gradient Background Overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-transparent via-transparent to-indigo-50/30 dark:to-indigo-900/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
    
    <!-- Card Content -->
    <div class="relative px-6 py-6">
        <!-- Header Section -->
        <header class="flex justify-between items-start mb-4">
            <!-- Enhanced Icon Container -->
            <div class="relative">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-indigo-500 to-purple-500 flex items-center justify-center shadow-lg shadow-indigo-500/25 group-hover:shadow-indigo-500/40 transition-all duration-300 group-hover:scale-110">
                    @if (auth('web')->user()->role != 'employer' && auth('web')->user()->role != 'employee' && auth('web')->user()->role != 'client')
                        <!-- Employers Icon -->
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    @elseif (auth('web')->user()->role == 'client')
                        <!-- Projects Icon -->
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    @else
                        <!-- Reports Icon -->
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    @endif
                </div>
                <!-- Decorative Ring -->
                <div class="absolute inset-0 rounded-xl ring-2 ring-indigo-500/20 group-hover:ring-indigo-500/40 transition-all duration-300 scale-110"></div>
            </div>

            <!-- Status Indicator -->
            <div class="flex items-center gap-2">
                <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                <span class="text-xs font-medium text-gray-500 dark:text-gray-400">{{ __('Live') }}</span>
            </div>
        </header>

        <!-- Content Section -->
        <div class="space-y-3">
            @if (auth('web')->user()->role != 'employer' && auth('web')->user()->role != 'employee' && auth('web')->user()->role != 'client')
                <!-- Employers Section -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3 flex items-center gap-2">
                        {{ __('Employer(s)') }}
                        <span class="text-xs bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400 px-2 py-1 rounded-full font-medium">
                            {{ __('Active') }}
                        </span>
                    </h2>
                    <div class="flex items-end justify-between">
                        <div class="flex items-baseline gap-3">
                            <div class="text-4xl font-bold text-gray-900 dark:text-gray-100 transition-all duration-300 group-hover:text-indigo-600 dark:group-hover:text-indigo-400">
                                {{ number_format(employerCount()) }}
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400 font-medium">
                                {{ __('Total') }}
                            </div>
                        </div>
                        <!-- Trend Arrow -->
                        <div class="flex items-center gap-1 text-green-600 dark:text-green-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17l9.2-9.2M17 17V7H7"/>
                            </svg>
                            <span class="text-xs font-medium">{{ __('Active') }}</span>
                        </div>
                    </div>
                </div>
                
            @elseif (auth('web')->user()->role == 'client')
                <!-- Projects Section -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3 flex items-center gap-2">
                        {{ __('Project(s)') }}
                        <span class="text-xs bg-purple-100 dark:bg-purple-900/50 text-purple-600 dark:text-purple-400 px-2 py-1 rounded-full font-medium">
                            {{ __('Ongoing') }}
                        </span>
                    </h2>
                    <div class="flex items-end justify-between">
                        <div class="flex items-baseline gap-3">
                            <div class="text-4xl font-bold text-gray-900 dark:text-gray-100 transition-all duration-300 group-hover:text-purple-600 dark:group-hover:text-purple-400">
                                {{ number_format(projectCount()) }}
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400 font-medium">
                                {{ __('Projects') }}
                            </div>
                        </div>
                        <!-- Progress Indicator -->
                        <div class="flex items-center gap-1 text-blue-600 dark:text-blue-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            <span class="text-xs font-medium">{{ __('In Progress') }}</span>
                        </div>
                    </div>
                </div>
                
            @else
                <!-- Reports Section -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3 flex items-center gap-2">
                        {{ __('Report(s)') }}
                        <span class="text-xs bg-emerald-100 dark:bg-emerald-900/50 text-emerald-600 dark:text-emerald-400 px-2 py-1 rounded-full font-medium">
                            {{ __('Generated') }}
                        </span>
                    </h2>
                    <div class="flex items-end justify-between">
                        <div class="flex items-baseline gap-3">
                            <div class="text-4xl font-bold text-gray-900 dark:text-gray-100 transition-all duration-300 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">
                                {{ number_format(reportCount()) }}
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400 font-medium">
                                {{ __('Reports') }}
                            </div>
                        </div>
                        <!-- Status Indicator -->
                        <div class="flex items-center gap-1 text-emerald-600 dark:text-emerald-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-xs font-medium">{{ __('Ready') }}</span>
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
                <button class="text-xs font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 transition-colors duration-200 flex items-center gap-1 group/btn">
                    {{ __('View Details') }}
                    <svg class="w-3 h-3 transition-transform duration-200 group-hover/btn:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Loading State Overlay -->
    <div class="absolute inset-0 bg-white/50 dark:bg-gray-900/50 backdrop-blur-sm rounded-2xl flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-200" id="card-loading-{{ uniqid() }}">
        <div class="w-8 h-8 border-2 border-indigo-200 border-t-indigo-600 rounded-full animate-spin"></div>
    </div>
</div>

<!-- Enhanced CSS for animations -->
<style>
@keyframes countUp {
    from { transform: translateY(20px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

.dashboard-card-01 .count-number {
    animation: countUp 0.6s ease-out forwards;
}

/* Hover effect for the entire card */
.dashboard-card-01:hover .count-number {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}
</style>
