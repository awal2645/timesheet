<header class="sticky top-0 bg-white/95 dark:bg-gray-900/95 backdrop-blur-lg border-b border-gray-200 dark:border-gray-700 z-50 shadow-sm">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Header: Left side -->
            <div class="flex items-center gap-4">
                <!-- Hamburger Menu (visible on mobile) -->
                <button 
                    class="p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 lg:hidden rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    @click="mobileMenu = !mobileMenu"
                    aria-controls="sidebar"
                    :aria-expanded="mobileMenu">
                    <span class="sr-only">{{ __('Open sidebar') }}</span>
                    <svg class="w-6 h-6 transition-transform duration-200" :class="mobileMenu ? 'rotate-90' : ''" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M3 12h18v-2H3v2zm0-5h18V5H3v2zm0 10h18v-2H3v2z"/>
                    </svg>
                </button>
                
                <!-- Logo with enhanced styling -->
                <a class="inline-block group" href="{{ route('dashboard') }}">
                    <div class="transition-transform duration-200 group-hover:scale-105">
                        <img src="{{ asset('images/logo-inv.png') }}" alt="{{ config('app.name') }}" class="w-36 md:w-48 h-auto hidden dark:block">
                        <img src="{{ asset('images/dark_logo.png') }}" alt="{{ config('app.name') }}" class="dark:hidden w-36 md:w-48 h-auto">
                    </div>
                </a>
            </div>

            <!-- Header: Right side -->
            <div class="flex items-center gap-3">
                <!-- Search Button (for future implementation) -->
                {{-- <button class="p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <span class="sr-only">{{ __('Search') }}</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button> --}}

                @php
                    $languages = loadLanguage();
                    $hasMultipleLanguages = count($languages) > 1;
                    $current_language = currentLanguage() ?: loadDefaultLanguage();
                @endphp

                <!-- Language Switcher with enhanced design -->
                @if ($hasMultipleLanguages)
                    <!-- Desktop Language Switcher -->
                    <div class="relative group hidden md:block" x-data="{ open: false }">
                        <button @click="open = !open" 
                                @click.outside="open = false"
                                class="flex items-center gap-2 px-3 py-2 bg-white/10 dark:bg-gray-800/50 backdrop-blur-sm border border-white/20 dark:border-gray-700/50 rounded-xl text-gray-700 dark:text-gray-300 hover:bg-white/20 dark:hover:bg-gray-700/50 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/30"
                                :class="{ 'bg-white/20 dark:bg-gray-700/50': open }">
                            <!-- Current Language Flag -->
                            <div class="w-5 h-5 rounded-full overflow-hidden flex items-center justify-center bg-gradient-to-r from-indigo-500 to-purple-500">
                                <span class="text-white text-xs font-bold">
                                    {{ strtoupper(substr($current_language, 0, 2)) }}
                                </span>
                            </div>
                            
                            <!-- Current Language Name -->
                            <span class="text-sm font-medium">
                                @foreach ($languages as $lang)
                                    @if($lang->code === $current_language)
                                        {{ $lang->name }}
                                        @break
                                    @endif
                                @endforeach
                            </span>
                            
                            <!-- Dropdown Arrow -->
                            <svg class="w-4 h-4 transition-transform duration-200" 
                                 :class="{ 'rotate-180': open }"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <!-- Enhanced Dropdown Menu -->
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                             x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                             class="absolute right-0 top-full mt-2 w-48 bg-white/95 dark:bg-gray-900/95 backdrop-blur-lg border border-white/20 dark:border-gray-700/50 rounded-xl shadow-xl shadow-gray-200/20 dark:shadow-gray-900/40 overflow-hidden z-50"
                             x-cloak>
                            
                            <!-- Dropdown Header -->
                            <div class="bg-gradient-to-r from-indigo-500 to-purple-500 px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                                    </svg>
                                    <h3 class="text-white font-semibold text-sm">{{ __('Select Language') }}</h3>
                                </div>
                            </div>
                            
                            <!-- Language Options -->
                            <div class="py-2">
                                @foreach ($languages as $lang)
                                    <form action="{{ route('changeLanguage') }}" method="GET" class="!mb-0">
                                        <input type="hidden" name="language" value="{{ $lang->code }}">
                                        <button type="submit" 
                                                @click="open = false"
                                                class="w-full flex items-center gap-3 px-4 py-3 text-left hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 dark:hover:from-indigo-900/30 dark:hover:to-purple-900/30 transition-all duration-200 group {{ $lang->code === $current_language ? 'bg-indigo-50 dark:bg-indigo-900/20 text-indigo-700 dark:text-indigo-300' : 'text-gray-700 dark:text-gray-300' }}">
                                            <!-- Language Flag/Code -->
                                            <div class="w-6 h-6 rounded-full overflow-hidden flex items-center justify-center {{ $lang->code === $current_language ? 'bg-gradient-to-r from-indigo-500 to-purple-500' : 'bg-gradient-to-r from-gray-400 to-gray-500' }}">
                                                <span class="text-white text-xs font-bold">
                                                    {{ strtoupper(substr($lang->code, 0, 2)) }}
                                                </span>
                                            </div>
                                            
                                            <!-- Language Name -->
                                            <span class="flex-1 font-medium">{{ $lang->name }}</span>
                                            
                                            <!-- Current Language Indicator -->
                                            @if($lang->code === $current_language)
                                                <div class="w-2 h-2 bg-indigo-500 rounded-full"></div>
                                            @endif
                                            
                                            <!-- Hover Arrow -->
                                            <svg class="w-4 h-4 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </button>
                                    </form>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Language Switcher -->
                    <div class="relative md:hidden" x-data="{ open: false }">
                        <button @click="open = !open" 
                                @click.outside="open = false"
                                class="flex items-center gap-2 p-2 bg-white/10 dark:bg-gray-800/50 backdrop-blur-sm border border-white/20 dark:border-gray-700/50 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-white/20 dark:hover:bg-gray-700/50 transition-all duration-200"
                                :class="{ 'bg-white/20 dark:bg-gray-700/50': open }">
                            <div class="w-5 h-5 rounded-full overflow-hidden flex items-center justify-center bg-gradient-to-r from-indigo-500 to-purple-500">
                                <span class="text-white text-xs font-bold">
                                    {{ strtoupper(substr($current_language, 0, 2)) }}
                                </span>
                            </div>
                            <svg class="w-4 h-4 transition-transform duration-200" 
                                 :class="{ 'rotate-180': open }"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <!-- Mobile Dropdown -->
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 top-full mt-2 w-40 bg-white/95 dark:bg-gray-900/95 backdrop-blur-lg border border-white/20 dark:border-gray-700/50 rounded-lg shadow-xl overflow-hidden z-50"
                             x-cloak>
                            @foreach ($languages as $lang)
                                <form action="{{ route('changeLanguage') }}" method="GET" class="!mb-0">
                                    <input type="hidden" name="language" value="{{ $lang->code }}">
                                    <button type="submit" 
                                            @click="open = false"
                                            class="w-full flex items-center gap-2 px-3 py-2 text-left hover:bg-indigo-50 dark:hover:bg-indigo-900/30 transition-colors duration-200 {{ $lang->code === $current_language ? 'bg-indigo-50 dark:bg-indigo-900/20 text-indigo-700 dark:text-indigo-300' : 'text-gray-700 dark:text-gray-300' }}">
                                        <div class="w-4 h-4 rounded-full overflow-hidden flex items-center justify-center {{ $lang->code === $current_language ? 'bg-gradient-to-r from-indigo-500 to-purple-500' : 'bg-gradient-to-r from-gray-400 to-gray-500' }}">
                                            <span class="text-white text-xs font-bold">
                                                {{ strtoupper(substr($lang->code, 0, 2)) }}
                                            </span>
                                        </div>
                                        <span class="text-sm font-medium">{{ $lang->name }}</span>
                                        @if($lang->code === $current_language)
                                            <div class="w-1.5 h-1.5 bg-indigo-500 rounded-full ml-auto"></div>
                                        @endif
                                    </button>
                                </form>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Divider -->
                <div class="hidden sm:block w-px h-6 bg-gray-200 dark:bg-gray-700"></div>

                <!-- Action buttons container -->
                <div class="flex items-center gap-2">
                <!-- Dark mode toggle -->
                <x-theme-toggle />
                    
                <!-- Notifications button -->
                <x-dropdown-notifications align="right" />

                    <!-- User profile dropdown -->
                <x-dropdown-profile align="right" />
                </div>
            </div>
        </div>
    </div>
</header>
