@props([
    'align' => 'right',
])

<div class="relative inline-flex" x-data="{ open: false }">
    <!-- Enhanced Notification Button -->
    <button class="group relative p-2.5 text-gray-500 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-indigo-400 rounded-xl hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 dark:hover:from-indigo-900/30 dark:hover:to-purple-900/30 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:bg-indigo-50 dark:focus:bg-indigo-900/30"
            :class="{ 'bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/30 dark:to-purple-900/30 text-indigo-600 dark:text-indigo-400': open }" 
            aria-haspopup="true" 
            @click.prevent="open = !open" 
            :aria-expanded="open">
        <span class="sr-only">{{ __('Notifications') }}</span>
        
        <!-- Bell Icon with Animation -->
        <div class="relative">
            <svg class="w-6 h-6 transition-transform duration-300 group-hover:scale-110" 
                 :class="open ? 'animate-pulse' : ''" 
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
            </svg>
            
            <!-- Notification Badge -->
            @if(notification() && count(notification()) > 0)
                <div class="absolute -top-1 -right-1 w-5 h-5 bg-gradient-to-r from-red-500 to-pink-500 border-2 border-white dark:border-gray-800 rounded-full flex items-center justify-center shadow-lg">
                    <span class="text-white text-xs font-bold">{{ count(notification()) > 9 ? '9+' : count(notification()) }}</span>
                </div>
            @endif
        </div>
    </button>

    <!-- Enhanced Dropdown Menu -->
    <div class="origin-top-right z-50 absolute top-full min-w-80 max-w-96 bg-white/95 dark:bg-gray-900/95 backdrop-blur-lg border border-gray-200/50 dark:border-gray-700/50 rounded-xl shadow-xl shadow-gray-200/20 dark:shadow-gray-900/40 overflow-hidden mt-2 {{ $align === 'right' ? 'right-0' : 'left-0' }}"
         @click.outside="open = false" 
         @keydown.escape.window="open = false" 
         x-show="open"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95 -translate-y-4"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
         x-transition:leave-end="opacity-0 scale-95 -translate-y-4"
         x-cloak>
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-white font-semibold text-base">{{ __('Notifications') }}</h3>
                        <p class="text-indigo-100 text-xs">
                            @if(notification() && count(notification()) > 0)
                                {{ count(notification()) }} {{ __('new notifications') }}
                            @else
                                {{ __('No new notifications') }}
                            @endif
                        </p>
                    </div>
                </div>
                @if(notification() && count(notification()) > 0)
                    <a href="{{ route('notification.del') }}" 
                       class="text-white/80 hover:text-white text-xs font-medium hover:bg-white/10 px-3 py-1.5 rounded-lg transition-colors duration-200"
                       @click="open = false">
                        {{ __('Mark All Read') }}
                    </a>
                @endif
            </div>
        </div>

        <!-- Notifications List -->
        <div class="max-h-80 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-300 dark:scrollbar-thumb-gray-600 scrollbar-track-transparent">
            @if(notification() && count(notification()) > 0)
                @foreach (notification() as $index => $notification)
                    <div class="border-b border-gray-200/50 dark:border-gray-700/50 last:border-0">
                        <a class="group block p-4 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 dark:hover:from-indigo-900/30 dark:hover:to-purple-900/30 transition-all duration-200"
                           href="{{ $notification->page_url ?? '#' }}" 
                           @click="open = false">
                            <div class="flex items-start gap-3">
                                <!-- Notification Icon -->
                                <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-lg flex items-center justify-center shadow-md">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                
                                <!-- Notification Content -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-start justify-between gap-2">
                                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100 line-clamp-2 group-hover:text-indigo-700 dark:group-hover:text-indigo-300 transition-colors duration-200">
                                            {{ $notification->message }}
                                        </p>
                                        <div class="flex-shrink-0 w-2 h-2 bg-indigo-500 rounded-full"></div>
                                    </div>
                                    <div class="flex items-center justify-between mt-2">
                                        <span class="text-xs text-gray-500 dark:text-gray-400 font-medium">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </span>
                                        <svg class="w-4 h-4 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @else
                <!-- Empty State -->
                <div class="py-12 text-center">
                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-medium text-gray-900 dark:text-gray-100 mb-1">
                        {{ __('No notifications') }}
                    </h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        {{ __('When you have notifications, they\'ll appear here') }}
                    </p>
                </div>
            @endif
        </div>

        <!-- Footer -->
        @if(notification() && count(notification()) > 0)
            <div class="bg-gray-50 dark:bg-gray-800/50 px-4 py-3 border-t border-gray-200/50 dark:border-gray-700/50">
                <div class="flex items-center justify-between">
                    <span class="text-xs text-gray-500 dark:text-gray-400">
                        {{ count(notification()) }} {{ count(notification()) === 1 ? __('notification') : __('notifications') }}
                    </span>
                    <a href="{{ route('notification.del') }}" 
                       class="text-xs font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 transition-colors duration-200"
                       @click="open = false">
                        {{ __('Clear All') }}
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
