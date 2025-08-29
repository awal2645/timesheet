<footer class="bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm border-t border-gray-200 dark:border-gray-700 mt-auto">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row items-center justify-between py-6 gap-4">
            <!-- Left side: Copyright and branding -->
            <div class="flex flex-col sm:flex-row items-center gap-4">
                <!-- App info -->
                <div class="text-center sm:text-left">
                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        &copy; {{ date('Y') }} {{ config('app.name') }}
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        {{ __('All rights reserved') }}
                    </p>
                </div>
                
                <!-- Version info (if available) -->
                @if(config('app.version'))
                    <div class="hidden sm:block w-px h-8 bg-gray-200 dark:bg-gray-700"></div>
                    <div class="text-center sm:text-left">
                        <p class="text-xs font-medium text-gray-600 dark:text-gray-400">
                            {{ __('Version') }} {{ config('app.version') }}
                        </p>
                        @if(config('app.build_date'))
                            <p class="text-xs text-gray-500 dark:text-gray-500">
                                {{ __('Build') }}: {{ config('app.build_date') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Right side: Additional links and info -->
            <div class="flex flex-col sm:flex-row items-center gap-4 text-sm">
                <!-- Status indicator -->
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-xs text-gray-600 dark:text-gray-400">
                        {{ __('System Operational') }}
                    </span>
                </div>

                <!-- Environment indicator (only show in development) -->
                @if(config('app.env') !== 'production')
                    <div class="hidden sm:block w-px h-4 bg-gray-200 dark:bg-gray-700"></div>
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                        <span class="text-xs font-medium text-yellow-600 dark:text-yellow-400 uppercase">
                            {{ config('app.env') }}
                        </span>
                    </div>
                @endif

                <!-- User info -->
                @auth
                    <div class="hidden sm:block w-px h-4 bg-gray-200 dark:bg-gray-700"></div>
                    <div class="text-center sm:text-right">
                        <p class="text-xs text-gray-600 dark:text-gray-400">
                            {{ __('Welcome back') }}, <span class="font-medium">{{ auth()->user()->name }}</span>
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-500">
                            {{ __('Last login') }}: {{ auth()->user()->last_login_at ? auth()->user()->last_login_at->format('M j, H:i') : __('Never') }}
                        </p>
                    </div>
                @endauth
            </div>
        </div>

        <!-- Mobile-specific layout for additional info -->
        <div class="sm:hidden border-t border-gray-200 dark:border-gray-700 py-4">
            <div class="flex justify-center items-center gap-6 text-xs text-gray-500 dark:text-gray-400">
                <!-- Version info on mobile -->
                @if(config('app.version'))
                    <span>v{{ config('app.version') }}</span>
                @endif
                
                <!-- Environment indicator on mobile -->
                @if(config('app.env') !== 'production')
                    <span class="flex items-center gap-1">
                        <div class="w-1.5 h-1.5 bg-yellow-500 rounded-full"></div>
                        {{ strtoupper(config('app.env')) }}
                    </span>
                @endif
                
                <!-- Last login on mobile -->
                @auth
                    <span>
                        {{ __('Last login') }}: {{ auth()->user()->last_login_at ? auth()->user()->last_login_at->format('M j') : __('Never') }}
                    </span>
                @endauth
            </div>
        </div>
    </div>
</footer>
