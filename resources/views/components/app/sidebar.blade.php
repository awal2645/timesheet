<div>
    <!-- Sidebar backdrop -->
    <div 
        class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 lg:hidden transition-opacity duration-300"
        x-show="mobileMenu"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="mobileMenu = false"
        aria-hidden="true">
    </div>

    <!-- Sidebar -->
    <div 
        id="sidebar"
        class="fixed lg:static inset-y-0 left-0 z-40 w-80 flex-shrink-0 bg-white dark:bg-gray-900 lg:h-[calc(100vh-128px)] overflow-y-auto lg:overflow-y-auto scrollbar-thin scrollbar-thumb-gray-300 dark:scrollbar-thumb-gray-600 scrollbar-track-transparent transition-transform duration-300 ease-in-out lg:translate-x-0 border-r border-gray-200 dark:border-gray-700 shadow-xl lg:shadow-none"
        :class="mobileMenu ? 'translate-x-0 h-screen' : '-translate-x-80 lg:translate-x-0'"
        @click.outside="if($event.target.closest('#sidebar') === null && $event.target.closest('button') === null) mobileMenu = false"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="-translate-x-80"
        x-transition:enter-end="translate-x-0">

        <!-- Sidebar Header -->
        <div class="sticky top-0 z-10 bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-800 dark:to-purple-800 px-6 py-4 border-b border-indigo-500/20">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14-4H3m16 8H1"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-white font-bold text-lg">{{ __('Navigation') }}</h2>
                    <p class="text-indigo-200 text-xs">{{ __('Main Menu') }}</p>
                </div>
            </div>
        </div>

        <!-- Sidebar content -->
        <div class="flex-1 px-4 py-6 space-y-8">
            <!-- Dashboard Section -->
            <div class="space-y-3">
                <div class="flex items-center px-3 mb-4">
                    <div class="w-6 h-6 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Dashboard') }}</h3>
                </div>
                
                <!-- Dashboard Link -->
                <a class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-indigo-500 to-purple-500 text-white shadow-lg shadow-indigo-500/25' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 hover:shadow-md' }}"
                    href="{{ route('dashboard') }}">
                    <div class="flex items-center justify-center w-10 h-10 {{ request()->routeIs('dashboard') ? 'bg-white/20' : 'bg-blue-100 dark:bg-blue-900/30' }} rounded-lg mr-3 transition-colors duration-200">
                        <i class="fa-solid fa-gauge text-base {{ request()->routeIs('dashboard') ? 'text-white' : 'text-blue-600 dark:text-blue-400' }}"></i>
                    </div>
                    <span class="font-medium">{{ __('Dashboard') }}</span>
                    @if(request()->routeIs('dashboard'))
                        <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                    @endif
                </a>

                <!-- Order -->
                @canany('Order view')
                    <a class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('order.*') ? 'bg-gradient-to-r from-green-500 to-emerald-500 text-white shadow-lg shadow-green-500/25' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 hover:shadow-md' }}"
                        href="{{ route('order.index') }}">
                        <div class="flex items-center justify-center w-10 h-10 {{ request()->routeIs('order.*') ? 'bg-white/20' : 'bg-green-100 dark:bg-green-900/30' }} rounded-lg mr-3 transition-colors duration-200">
                            <i class="fa-solid fa-money-bill-wave text-base {{ request()->routeIs('order.*') ? 'text-white' : 'text-green-600 dark:text-green-400' }}"></i>
                        </div>
                        <span class="font-medium">{{ __('Order') }}</span>
                        @if(request()->routeIs('order.*'))
                            <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>
                @endcanany
            </div>

            <!-- Data Management Section -->
            <div class="space-y-3">
                <div class="flex items-center px-3 mb-4">
                    <div class="w-6 h-6 bg-gradient-to-r from-purple-500 to-pink-500 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14-4H3m16 8H1"/>
                        </svg>
                    </div>
                    <h3 class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Data Management') }}</h3>
                </div>

                <!-- Employer -->
                @canany('Employer view')
                    <a class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('employer.*') ? 'bg-gradient-to-r from-purple-500 to-pink-500 text-white shadow-lg shadow-purple-500/25' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 hover:shadow-md' }}"
                        href="{{ route('employer.index') }}">
                        <div class="flex items-center justify-center w-10 h-10 {{ request()->routeIs('employer.*') ? 'bg-white/20' : 'bg-purple-100 dark:bg-purple-900/30' }} rounded-lg mr-3 transition-colors duration-200">
                            <i class="fa-solid fa-building text-base {{ request()->routeIs('employer.*') ? 'text-white' : 'text-purple-600 dark:text-purple-400' }}"></i>
                        </div>
                        <span class="font-medium">{{ __('Employer') }}</span>
                        @if(request()->routeIs('employer.*'))
                            <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>
                @endcanany

                <!-- Employee -->
                @canany('Client view')
                    <a class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('employee.*') ? 'bg-gradient-to-r from-amber-500 to-orange-500 text-white shadow-lg shadow-amber-500/25' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 hover:shadow-md' }}"
                        href="{{ route('employee.index') }}">
                        <div class="flex items-center justify-center w-10 h-10 {{ request()->routeIs('employee.*') ? 'bg-white/20' : 'bg-amber-100 dark:bg-amber-900/30' }} rounded-lg mr-3 transition-colors duration-200">
                            <i class="fa-solid fa-user-tie text-base {{ request()->routeIs('employee.*') ? 'text-white' : 'text-amber-600 dark:text-amber-400' }}"></i>
                        </div>
                        <span class="font-medium">{{ __('Employee') }}</span>
                        @if(request()->routeIs('employee.*'))
                            <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>
                @endcanany

                <!-- Client -->
                @canany('Client view')
                    <a class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('client.*') ? 'bg-gradient-to-r from-teal-500 to-cyan-500 text-white shadow-lg shadow-teal-500/25' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 hover:shadow-md' }}"
                        href="{{ route('client.index') }}">
                        <div class="flex items-center justify-center w-10 h-10 {{ request()->routeIs('client.*') ? 'bg-white/20' : 'bg-teal-100 dark:bg-teal-900/30' }} rounded-lg mr-3 transition-colors duration-200">
                            <i class="fa-solid fa-user-secret text-base {{ request()->routeIs('client.*') ? 'text-white' : 'text-teal-600 dark:text-teal-400' }}"></i>
                        </div>
                        <span class="font-medium">{{ __('Client') }}</span>
                        @if(request()->routeIs('client.*'))
                            <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>
                @endcanany

                <!-- Project -->
                @if (auth('web')->user()->role != 'employee')
                    <a class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('project.*') ? 'bg-gradient-to-r from-rose-500 to-pink-500 text-white shadow-lg shadow-rose-500/25' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 hover:shadow-md' }}"
                        href="{{ route('project.index') }}">
                        <div class="flex items-center justify-center w-10 h-10 {{ request()->routeIs('project.*') ? 'bg-white/20' : 'bg-rose-100 dark:bg-rose-900/30' }} rounded-lg mr-3 transition-colors duration-200">
                            <i class="fa-solid fa-list-check text-base {{ request()->routeIs('project.*') ? 'text-white' : 'text-rose-600 dark:text-rose-400' }}"></i>
                        </div>
                        <span class="font-medium">{{ __('Project') }}</span>
                        @if(request()->routeIs('project.*'))
                            <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>
                @endif

                <!-- Task -->
                <a class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('task.*') ? 'bg-gradient-to-r from-slate-600 to-gray-600 text-white shadow-lg shadow-slate-500/25' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 hover:shadow-md' }}"
                    href="{{ route('task.index') }}">
                    <div class="flex items-center justify-center w-10 h-10 {{ request()->routeIs('task.*') ? 'bg-white/20' : 'bg-slate-100 dark:bg-slate-700' }} rounded-lg mr-3 transition-colors duration-200">
                        <i class="fa-solid fa-briefcase text-base {{ request()->routeIs('task.*') ? 'text-white' : 'text-slate-600 dark:text-slate-400' }}"></i>
                    </div>
                    <span class="font-medium">{{ __('Task') }}</span>
                    @if(request()->routeIs('task.*'))
                        <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                    @endif
                </a>
            </div>

            <!-- Business Management Section -->
            <div class="space-y-3">
                <div class="flex items-center px-3 mb-4">
                    <div class="w-6 h-6 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Business') }}</h3>
                </div>

                <!-- Plan -->
                @canany('Plan view')
                    <a href="{{ route('plans.index') }}"
                        class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('plans.*') ? 'bg-gradient-to-r from-emerald-500 to-teal-500 text-white shadow-lg shadow-emerald-500/25' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 hover:shadow-md' }}">
                        <div class="flex items-center justify-center w-10 h-10 {{ request()->routeIs('plans.*') ? 'bg-white/20' : 'bg-emerald-100 dark:bg-emerald-900/30' }} rounded-lg mr-3 transition-colors duration-200">
                            <i class="fa-solid fa-money-check-dollar text-base {{ request()->routeIs('plans.*') ? 'text-white' : 'text-emerald-600 dark:text-emerald-400' }}"></i>
                        </div>
                        <span class="font-medium">{{ __('Price Plan') }}</span>
                        @if(request()->routeIs('plans.*'))
                            <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>
                @endcanany

                <!-- Timesheet -->
                @canany('Timesheet view')
                    <a href="{{ route('timesheet.index') }}"
                        class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('timesheet.*') ? 'bg-gradient-to-r from-yellow-500 to-amber-500 text-white shadow-lg shadow-yellow-500/25' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 hover:shadow-md' }}">
                        <div class="flex items-center justify-center w-10 h-10 {{ request()->routeIs('timesheet.*') ? 'bg-white/20' : 'bg-yellow-100 dark:bg-yellow-900/30' }} rounded-lg mr-3 transition-colors duration-200">
                            <i class="fa-solid fa-hourglass text-base {{ request()->routeIs('timesheet.*') ? 'text-white' : 'text-yellow-600 dark:text-yellow-400' }}"></i>
                        </div>
                        <span class="font-medium">{{ __('Timesheet') }}</span>
                        @if(request()->routeIs('timesheet.*'))
                            <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>
                @endcanany

                <!-- Report -->
                @canany('Report view')
                    <a href="{{ route('reports.index') }}"
                        class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('reports.index') ? 'bg-gradient-to-r from-red-500 to-pink-500 text-white shadow-lg shadow-red-500/25' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 hover:shadow-md' }}">
                        <div class="flex items-center justify-center w-10 h-10 {{ request()->routeIs('reports.index') ? 'bg-white/20' : 'bg-red-100 dark:bg-red-900/30' }} rounded-lg mr-3 transition-colors duration-200">
                            <i class="fa-solid fa-chart-line text-base {{ request()->routeIs('reports.index') ? 'text-white' : 'text-red-600 dark:text-red-400' }}"></i>
                        </div>
                        <span class="font-medium">{{ __('Timesheet Report') }}</span>
                        @if(request()->routeIs('reports.index'))
                            <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>
                @endcanany

                <!-- Leave Management Dropdown -->
                @canany('Leave view')
                    <div x-data="{ open: {{ request()->routeIs('weekly_holidays.*') || request()->routeIs('holidays.*') || request()->routeIs('leave_types.*') || request()->routeIs('leave.*') ? 'true' : 'false' }} }">
                        <button @click.prevent="open = !open"
                            class="group flex items-center justify-between w-full px-3 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('leave.*') || request()->routeIs('weekly_holidays.*') || request()->routeIs('holidays.*') || request()->routeIs('leave_types.*') ? 'bg-gradient-to-r from-indigo-500 to-blue-500 text-white shadow-lg shadow-indigo-500/25' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 hover:shadow-md' }}">
                            <div class="flex items-center">
                                <div class="flex items-center justify-center w-10 h-10 {{ request()->routeIs('leave.*') || request()->routeIs('weekly_holidays.*') || request()->routeIs('holidays.*') || request()->routeIs('leave_types.*') ? 'bg-white/20' : 'bg-indigo-100 dark:bg-indigo-900/30' }} rounded-lg mr-3 transition-colors duration-200">
                                    <i class="fa-solid fa-person-walking-arrow-right text-base {{ request()->routeIs('leave.*') || request()->routeIs('weekly_holidays.*') || request()->routeIs('holidays.*') || request()->routeIs('leave_types.*') ? 'text-white' : 'text-indigo-600 dark:text-indigo-400' }}"></i>
                                </div>
                                <span class="font-medium">{{ __('Leave Management') }}</span>
                            </div>
                            <svg class="w-4 h-4 transition-transform duration-200 {{ request()->routeIs('leave.*') || request()->routeIs('weekly_holidays.*') || request()->routeIs('holidays.*') || request()->routeIs('leave_types.*') ? 'text-white' : 'text-gray-400' }}"
                                :class="open ? 'rotate-180' : ''" viewBox="0 0 12 12" fill="currentColor">
                                <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                            </svg>
                        </button>
                        <div x-show="open" x-collapse.duration.300ms class="mt-2">
                            <div class="ml-10 space-y-2 border-l-2 border-gray-200 dark:border-gray-700 pl-4">
                                @canany('Leave view')
                                    <a href="{{ route('leave.index') }}"
                                        class="block px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('leave.*') ? 'text-indigo-600 bg-indigo-50 dark:text-indigo-400 dark:bg-indigo-900/30' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50 dark:text-gray-400 dark:hover:text-gray-200 dark:hover:bg-gray-800' }}">
                                        {{ __('Leave') }}
                                    </a>
                                @endcanany
                                @canany('Weekly Holidays view')
                                    <a href="{{ route('weekly_holidays.index') }}"
                                        class="block px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('weekly_holidays.*') ? 'text-indigo-600 bg-indigo-50 dark:text-indigo-400 dark:bg-indigo-900/30' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50 dark:text-gray-400 dark:hover:text-gray-200 dark:hover:bg-gray-800' }}">
                                        {{ __('Weekly Holidays') }}
                                    </a>
                                @endcanany
                                @canany('Holiday view')
                                    <a href="{{ route('holidays.index') }}"
                                        class="block px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('holidays.*') ? 'text-indigo-600 bg-indigo-50 dark:text-indigo-400 dark:bg-indigo-900/30' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50 dark:text-gray-400 dark:hover:text-gray-200 dark:hover:bg-gray-800' }}">
                                        {{ __('Holidays') }}
                                    </a>
                                @endcanany
                                @canany('Leave Types view')
                                    <a href="{{ route('leave_types.index') }}"
                                        class="block px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('leave_types.*') ? 'text-indigo-600 bg-indigo-50 dark:text-indigo-400 dark:bg-indigo-900/30' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50 dark:text-gray-400 dark:hover:text-gray-200 dark:hover:bg-gray-800' }}">
                                        {{ __('Leave Types') }}
                                    </a>
                                @endcanany
                            </div>
                        </div>
                    </div>
                @endcanany
            </div>

            <!-- Communication Section -->
            <div class="space-y-3">
                <div class="flex items-center px-3 mb-4">
                    <div class="w-6 h-6 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                    <h3 class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Communication') }}</h3>
                </div>

                <!-- Notice -->
                @if(module_enabled('Notice'))
                    @canany('Notice view')
                        <a href="{{ route('notices.index') }}"
                            class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('notices.*') ? 'bg-gradient-to-r from-cyan-500 to-blue-500 text-white shadow-lg shadow-cyan-500/25' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 hover:shadow-md' }}">
                            <div class="flex items-center justify-center w-10 h-10 {{ request()->routeIs('notices.*') ? 'bg-white/20' : 'bg-cyan-100 dark:bg-cyan-900/30' }} rounded-lg mr-3 transition-colors duration-200">
                                <i class="fa-solid fa-bullhorn text-base {{ request()->routeIs('notices.*') ? 'text-white' : 'text-cyan-600 dark:text-cyan-400' }}"></i>
                            </div>
                            <span class="font-medium">{{ __('Notice') }}</span>
                            @if(request()->routeIs('notices.*'))
                                <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                            @endif
                        </a>
                    @endcanany
                @endif

                <!-- Zoom Meeting -->
                @if(module_enabled('Zoom'))
                    @canany('Zoom Meeting view')
                        <a href="{{ route('zoom.meeting.index') }}"
                            class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('zoom.meeting.*') ? 'bg-gradient-to-r from-violet-500 to-purple-500 text-white shadow-lg shadow-violet-500/25' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 hover:shadow-md' }}">
                            <div class="flex items-center justify-center w-10 h-10 {{ request()->routeIs('zoom.meeting.*') ? 'bg-white/20' : 'bg-violet-100 dark:bg-violet-900/30' }} rounded-lg mr-3 transition-colors duration-200">
                                <i class="fa-solid fa-video text-base {{ request()->routeIs('zoom.meeting.*') ? 'text-white' : 'text-violet-600 dark:text-violet-400' }}"></i>
                            </div>
                            <span class="font-medium">{{ __('Zoom Meeting') }}</span>
                            @if(request()->routeIs('zoom.meeting.*'))
                                <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                            @endif
                        </a>
                    @endcanany
                @endif

                <!-- Send Invite -->
                @canany('Invite send')
                    <a href="{{ route('invite.send.employer.page') }}"
                        class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('invite.send.employer.page') ? 'bg-gradient-to-r from-orange-500 to-red-500 text-white shadow-lg shadow-orange-500/25' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 hover:shadow-md' }}">
                        <div class="flex items-center justify-center w-10 h-10 {{ request()->routeIs('invite.send.employer.page') ? 'bg-white/20' : 'bg-orange-100 dark:bg-orange-900/30' }} rounded-lg mr-3 transition-colors duration-200">
                            <i class="fa-regular fa-paper-plane text-base {{ request()->routeIs('invite.send.employer.page') ? 'text-white' : 'text-orange-600 dark:text-orange-400' }}"></i>
                        </div>
                        <span class="font-medium">{{ __('Send Invite') }}</span>
                        @if(request()->routeIs('invite.send.employer.page'))
                            <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>
                @endcanany

                <!-- Send Mail -->
                @canany('Email view')
                    <a href="{{ route('emails.index') }}"
                        class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('emails.*') ? 'bg-gradient-to-r from-teal-500 to-green-500 text-white shadow-lg shadow-teal-500/25' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 hover:shadow-md' }}">
                        <div class="flex items-center justify-center w-10 h-10 {{ request()->routeIs('emails.*') ? 'bg-white/20' : 'bg-teal-100 dark:bg-teal-900/30' }} rounded-lg mr-3 transition-colors duration-200">
                            <i class="fa-regular fa-envelope text-base {{ request()->routeIs('emails.*') ? 'text-white' : 'text-teal-600 dark:text-teal-400' }}"></i>
                        </div>
                        <span class="font-medium">{{ __('Send Mail') }}</span>
                        @if(request()->routeIs('emails.*'))
                            <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>
                @endcanany

                <!-- Email Reminders -->
                @if(module_enabled('Email Reminders'))
                    @canany('Email view')
                        <a href="{{ route('emailreminders.index') }}"
                            class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('emailreminders.*') ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-lg shadow-indigo-600/25' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 hover:shadow-md' }}">
                            <div class="flex items-center justify-center w-10 h-10 {{ request()->routeIs('emailreminders.*') ? 'bg-white/20' : 'bg-indigo-100 dark:bg-indigo-900/30' }} rounded-lg mr-3 transition-colors duration-200">
                                <i class="fa-solid fa-clock text-base {{ request()->routeIs('emailreminders.*') ? 'text-white' : 'text-indigo-600 dark:text-indigo-400' }}"></i>
                            </div>
                            <span class="font-medium">{{ __('Email Reminders') }}</span>
                            @if(request()->routeIs('emailreminders.*'))
                                <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                            @endif
                        </a>
                    @endcanany
                @endif
            </div>

            <!-- Continue with other sections... -->
            <!-- System Settings Section -->
            <div class="space-y-3">
                <div class="flex items-center px-3 mb-4">
                    <div class="w-6 h-6 bg-gradient-to-r from-gray-600 to-slate-600 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('System Settings') }}</h3>
                </div>

                <!-- Role Management -->
                @canany('Role view')
                    <a href="{{ route('role.page') }}"
                        class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('role.*') ? 'bg-gradient-to-r from-purple-600 to-indigo-600 text-white shadow-lg shadow-purple-600/25' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 hover:shadow-md' }}">
                        <div class="flex items-center justify-center w-10 h-10 {{ request()->routeIs('role.*') ? 'bg-white/20' : 'bg-purple-100 dark:bg-purple-900/30' }} rounded-lg mr-3 transition-colors duration-200">
                            <i class="fa-solid fa-user-lock text-base {{ request()->routeIs('role.*') ? 'text-white' : 'text-purple-600 dark:text-purple-400' }}"></i>
                        </div>
                        <span class="font-medium">{{ __('Role Management') }}</span>
                        @if(request()->routeIs('role.*'))
                            <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>
                @endcanany

                <!-- SMTP Config -->
                @canany('SMTP Config')
                    <a href="{{ route('smtp') }}"
                        class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('smtp') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg shadow-blue-600/25' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 hover:shadow-md' }}">
                        <div class="flex items-center justify-center w-10 h-10 {{ request()->routeIs('smtp') ? 'bg-white/20' : 'bg-blue-100 dark:bg-blue-900/30' }} rounded-lg mr-3 transition-colors duration-200">
                            <i class="fa-brands fa-mailchimp text-base {{ request()->routeIs('smtp') ? 'text-white' : 'text-blue-600 dark:text-blue-400' }}"></i>
                        </div>
                        <span class="font-medium">{{ __('SMTP Config') }}</span>
                        @if(request()->routeIs('smtp'))
                            <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>
                @endcanany

                <!-- Email Templates -->
                @canany('Email Templates')
                    <a href="{{ route('emailtemplate.index') }}"
                        class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('emailtemplate.*') ? 'bg-gradient-to-r from-purple-500 to-pink-500 text-white shadow-lg shadow-purple-500/25' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 hover:shadow-md' }}">
                        <div class="flex items-center justify-center w-10 h-10 {{ request()->routeIs('emailtemplate.*') ? 'bg-white/20' : 'bg-purple-100 dark:bg-purple-900/30' }} rounded-lg mr-3 transition-colors duration-200">
                            <i class="fa-regular fa-envelope text-base {{ request()->routeIs('emailtemplate.*') ? 'text-white' : 'text-purple-600 dark:text-purple-400' }}"></i>
                        </div>
                        <span class="font-medium">{{ __('Email Templates') }}</span>
                        @if(request()->routeIs('emailtemplate.*'))
                            <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>
                @endcanany

                <!-- General Setting -->
                @canany('General Settings')
                    <a href="{{ route('setting') }}"
                        class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('setting') ? 'bg-gradient-to-r from-gray-600 to-slate-600 text-white shadow-lg shadow-gray-600/25' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 hover:shadow-md' }}">
                        <div class="flex items-center justify-center w-10 h-10 {{ request()->routeIs('setting') ? 'bg-white/20' : 'bg-gray-100 dark:bg-gray-700' }} rounded-lg mr-3 transition-colors duration-200">
                            <i class="fa-solid fa-gears text-base {{ request()->routeIs('setting') ? 'text-white' : 'text-gray-600 dark:text-gray-400' }}"></i>
                        </div>
                        <span class="font-medium">{{ __('General Setting') }}</span>
                        @if(request()->routeIs('setting'))
                            <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>
                @endcanany

                <!-- Theme Customization -->
                @canany('General Settings')
                    <a href="{{ route('themes.index') }}"
                        class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('themes.*') ? 'bg-gradient-to-r from-pink-600 to-rose-600 text-white shadow-lg shadow-pink-600/25' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 hover:shadow-md' }}">
                        <div class="flex items-center justify-center w-10 h-10 {{ request()->routeIs('themes.*') ? 'bg-white/20' : 'bg-pink-100 dark:bg-pink-900/30' }} rounded-lg mr-3 transition-colors duration-200">
                            <i class="fa-solid fa-palette text-base {{ request()->routeIs('themes.*') ? 'text-white' : 'text-pink-600 dark:text-pink-400' }}"></i>
                        </div>
                        <span class="font-medium">{{ __('Theme Customization') }}</span>
                        @if(request()->routeIs('themes.*'))
                            <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>
                @endcanany

                <!-- Module Management -->
                @canany('General Settings')
                    <a href="{{ route('admin.modules.index') }}"
                        class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.modules.*') ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-lg shadow-emerald-600/25' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 hover:shadow-md' }}">
                        <div class="flex items-center justify-center w-10 h-10 {{ request()->routeIs('admin.modules.*') ? 'bg-white/20' : 'bg-emerald-100 dark:bg-emerald-900/30' }} rounded-lg mr-3 transition-colors duration-200">
                            <i class="fa-solid fa-cubes text-base {{ request()->routeIs('admin.modules.*') ? 'text-white' : 'text-emerald-600 dark:text-emerald-400' }}"></i>
                        </div>
                        <span class="font-medium">{{ __('Module Management') }}</span>
                        @if(request()->routeIs('admin.modules.*'))
                            <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>
                @endcanany

                <!-- Backup & Restore -->
                @canany('General Settings')
                    <a href="{{ route('backuprestore.index') }}"
                        class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('backuprestore.*') ? 'bg-gradient-to-r from-amber-600 to-orange-600 text-white shadow-lg shadow-amber-600/25' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 hover:shadow-md' }}">
                        <div class="flex items-center justify-center w-10 h-10 {{ request()->routeIs('backuprestore.*') ? 'bg-white/20' : 'bg-amber-100 dark:bg-amber-900/30' }} rounded-lg mr-3 transition-colors duration-200">
                            <i class="fa-solid fa-shield-halved text-base {{ request()->routeIs('backuprestore.*') ? 'text-white' : 'text-amber-600 dark:text-amber-400' }}"></i>
                        </div>
                        <span class="font-medium">{{ __('Backup & Restore') }}</span>
                        @if(request()->routeIs('backuprestore.*'))
                            <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>
                @endcanany

                <!-- Log Viewer -->
                @canany('General Settings')
                    <a href="{{ url('/log-viewer') }}"
                        class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->is('log-viewer*') ? 'bg-gradient-to-r from-red-600 to-rose-600 text-white shadow-lg shadow-red-600/25' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 hover:shadow-md' }}">
                        <div class="flex items-center justify-center w-10 h-10 {{ request()->is('log-viewer*') ? 'bg-white/20' : 'bg-red-100 dark:bg-red-900/30' }} rounded-lg mr-3 transition-colors duration-200">
                            <i class="fa-solid fa-file-lines text-base {{ request()->is('log-viewer*') ? 'text-white' : 'text-red-600 dark:text-red-400' }}"></i>
                        </div>
                        <span class="font-medium">{{ __('Log Viewer') }}</span>
                        @if(request()->is('log-viewer*'))
                            <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>
                @endcanany
            </div>
        </div>

        <!-- Sidebar Footer -->
        <div class="sticky bottom-0 bg-gradient-to-t from-gray-50 to-transparent dark:from-gray-900 dark:to-transparent p-4 border-t border-gray-200 dark:border-gray-700">
            <div class="text-center">
                <p class="text-xs text-gray-500 dark:text-gray-400">{{ config('app.name') }}</p>
                <p class="text-xs text-gray-400 dark:text-gray-500">v{{ config('app.version', '1.0') }}</p>
            </div>
        </div>
    </div>
</div>
