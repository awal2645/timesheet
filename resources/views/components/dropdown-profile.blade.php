@props([
    'align' => 'right',
])

<div class="relative inline-flex" x-data="{ open: false }">
    <button class="group inline-flex justify-center items-center gap-2 p-2 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:bg-indigo-50 dark:focus:bg-indigo-900/30" 
            aria-haspopup="true" 
            @click.prevent="setTimeout(() => { open = !open }, 50)"
            :aria-expanded="open">

        <!-- Profile Image with Enhanced Styling -->
        <div class="relative">
            @if (auth('web')->user()->role == 'employer' || auth('web')->user()->role == 'employee')
                <img class="w-10 h-10 rounded-full border-2 border-gray-200 dark:border-gray-700 shadow-md transition-all duration-200 group-hover:border-indigo-300 dark:group-hover:border-indigo-600" 
                     src="{{ asset(auth('web')->user()->image ?? 'images/default-user.png') }}"
                     width="40" height="40" 
                     alt="{{ auth('web')->user()->username }}" />
            @else
                <img class="w-10 h-10 rounded-full border-2 border-gray-200 dark:border-gray-700 shadow-md transition-all duration-200 group-hover:border-indigo-300 dark:group-hover:border-indigo-600" 
                     src="{{ asset(auth('web')->user()->image ?? 'images/logo_symbol.png') }}"
                     width="40" height="40" 
                     alt="{{ auth('web')->user()->username }}" />
            @endif
            <!-- Online Status Indicator -->
            <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 border-2 border-white dark:border-gray-800 rounded-full shadow-sm"></div>
        </div>

        <!-- User Info (Hidden on Mobile) -->
        <div class="hidden md:flex flex-col items-start min-w-0">
            <span class="text-sm font-semibold text-gray-700 dark:text-gray-300 capitalize truncate max-w-32">
                {{ auth('web')->user()->username }}
            </span>
            <span class="text-xs text-gray-500 dark:text-gray-400 capitalize">
                {{ auth('web')->user()->role }}
            </span>
        </div>

        <!-- Dropdown Arrow -->
        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400 transition-transform duration-200 group-hover:text-indigo-600 dark:group-hover:text-indigo-400" 
             :class="open ? 'rotate-180' : ''" 
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    <!-- Enhanced Dropdown Menu -->
    <div class="origin-top-right z-50 absolute top-full min-w-64 bg-white/95 dark:bg-gray-900/95 backdrop-blur-lg border border-gray-200/50 dark:border-gray-700/50 rounded-xl shadow-xl shadow-gray-200/20 dark:shadow-gray-900/40 overflow-hidden mt-2 {{ $align === 'right' ? 'right-0' : 'left-0' }}"
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
        
        <!-- Enhanced User Header -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-4 py-4">
            <div class="flex items-center gap-3">
                <div class="relative">
                    @if (auth('web')->user()->role == 'employer' || auth('web')->user()->role == 'employee')
                        <img class="w-12 h-12 rounded-full border-3 border-white/30 shadow-lg" 
                             src="{{ asset(auth('web')->user()->image ?? 'images/default-user.png') }}"
                             width="48" height="48" 
                             alt="{{ auth('web')->user()->username }}" />
                    @else
                        <img class="w-12 h-12 rounded-full border-3 border-white/30 shadow-lg" 
                             src="{{ asset(auth('web')->user()->image ?? 'images/logo_symbol.png') }}"
                             width="48" height="48" 
                             alt="{{ auth('web')->user()->username }}" />
                    @endif
                    <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 border-2 border-white rounded-full"></div>
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="text-white font-semibold text-base capitalize truncate">
                        {{ auth('web')->user()->username }}
                    </h3>
                    <p class="text-indigo-100 text-sm capitalize">
                        {{ auth('web')->user()->role }}
                    </p>
                    @if(auth('web')->user()->email)
                        <p class="text-indigo-200 text-xs truncate">
                            {{ auth('web')->user()->email }}
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Menu Items -->
        <div class="py-2">
            @if (auth()->user()->role != 'superadmin')
                <a class="group flex items-center px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 dark:hover:from-indigo-900/30 dark:hover:to-purple-900/30 hover:text-indigo-700 dark:hover:text-indigo-300 transition-all duration-200"
                   href="{{ route('my.account') }}" 
                   @click="open = false">
                    <div class="w-8 h-8 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center mr-3 group-hover:bg-orange-200 dark:group-hover:bg-orange-800/40 transition-colors duration-200">
                        <i class="fa-solid fa-gear text-orange-600 dark:text-orange-400 text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <div class="font-medium">{{ __('Account Settings') }}</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ __('Manage your account') }}</div>
                    </div>
                    <i class="fa-solid fa-chevron-right text-gray-400 text-xs opacity-0 group-hover:opacity-100 transition-opacity duration-200"></i>
                </a>
            @endif
            
            <a class="group flex items-center px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 dark:hover:from-blue-900/30 dark:hover:to-indigo-900/30 hover:text-blue-700 dark:hover:text-blue-300 transition-all duration-200"
               href="{{ route('profile.show') }}" 
               @click="open = false">
                <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center mr-3 group-hover:bg-blue-200 dark:group-hover:bg-blue-800/40 transition-colors duration-200">
                    <i class="fa-solid fa-user text-blue-600 dark:text-blue-400 text-sm"></i>
                </div>
                <div class="flex-1">
                    <div class="font-medium">{{ __('User Settings') }}</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ __('Update your profile') }}</div>
                </div>
                <i class="fa-solid fa-chevron-right text-gray-400 text-xs opacity-0 group-hover:opacity-100 transition-opacity duration-200"></i>
            </a>

            <!-- Divider -->
            <div class="my-2 mx-4">
                <div class="h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent dark:via-gray-600"></div>
            </div>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf
                <button type="submit" 
                        class="group w-full flex items-center px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gradient-to-r hover:from-red-50 hover:to-pink-50 dark:hover:from-red-900/30 dark:hover:to-pink-900/30 hover:text-red-700 dark:hover:text-red-300 transition-all duration-200"
                        @click="open = false">
                    <div class="w-8 h-8 bg-red-100 dark:bg-red-900/30 rounded-lg flex items-center justify-center mr-3 group-hover:bg-red-200 dark:group-hover:bg-red-800/40 transition-colors duration-200">
                        <i class="fa-solid fa-right-from-bracket text-red-600 dark:text-red-400 text-sm"></i>
                    </div>
                    <div class="flex-1 text-left">
                        <div class="font-medium">{{ __('Sign Out') }}</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ __('End your session') }}</div>
                    </div>
                    <i class="fa-solid fa-chevron-right text-gray-400 text-xs opacity-0 group-hover:opacity-100 transition-opacity duration-200"></i>
                </button>
            </form>
        </div>

        <!-- Footer Info -->
        <div class="bg-gray-50 dark:bg-gray-800/50 px-4 py-3 border-t border-gray-200/50 dark:border-gray-700/50">
            <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                <span class="flex items-center gap-1">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    {{ __('Online') }}
                </span>
                @if(auth('web')->user()->last_login_at)
                    <span>{{ __('Last login') }}: {{ auth('web')->user()->last_login_at->format('M j, H:i') }}</span>
                @endif
            </div>
        </div>
    </div>
</div>
