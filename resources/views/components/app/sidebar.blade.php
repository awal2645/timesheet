<div>
    <!-- Sidebar backdrop (mobile only) -->
    <div class="relative inset-0 bg-sidebar-light dark:bg-sidebar-dark bg-opacity-30 z-40 lg:hidden lg:z-auto transition-opacity duration-200"
        :class="sidebarOpen ? 'opacity-100' : 'opacity-0 pointer-events-none'" aria-hidden="true" x-cloak></div>

    <!-- Sidebar -->
    <div id="sidebar"
        class="flex flex-col absolute z-40 left-0 top-0 lg:static lg:left-auto lg:top-auto lg:translate-x-0 h-screen overflow-y-scroll lg:overflow-y-auto no-scrollbar w-64 lg:w-20 lg:sidebar-expanded:!w-64  shrink-0 bg-sidebar-light dark:bg-sidebar-dark transition-all duration-200 ease-in-out"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'" @click.outside="sidebarOpen = false"
        @keydown.escape.window="sidebarOpen = false" x-cloak="lg" class="relative">

        <!-- Sidebar header -->
        <div class="px-3 py-1 sticky top-0 z-50 bg-sidebar-light dark:bg-sidebar-dark">

            <div class="flex" :class="sidebarExpanded ? 'justify-between':'justify-center'">
                <!-- Hamburger button -->
                <button x-show="!sidebarExpanded" class="text-slate-500 hover:text-slate-600 lg:block hidden"
                    @click.stop="sidebarOpen = !sidebarOpen" aria-controls="sidebar" :aria-expanded="sidebarOpen"
                    @click="sidebarExpanded = !sidebarExpanded">
                    <span class="sr-only">Open sidebar</span>
                    <i class="fa-solid fa-bars text-2xl text-gray-900/80 dark:text-white/40 w-6"></i>
                </button>
                <!-- Logo link (shown only when sidebarExpanded is true) -->
                <a class="block" x-show="sidebarExpanded" href="{{ route('dashboard') }}">
                    <img src="{{ asset('images/logo-inv.png') }}" alt="" class="">
                </a>
            </div>

            <a class="lg:hidden" x-show="!sidebarExpanded" href="{{ route('dashboard') }}">
                <img src="{{ asset('images/logo-inv.png') }}" alt="" class="">
            </a>
        </div>

        <!-- Links -->
        <div class="space-y-8 p-3">
            <!-- Pages group -->
            <div>
                <ul class="mt-3 space-y-2">
                    <!-- Dashboard -->
                    <li>
                        <a class="block px-3 py-1.5 rounded {{ request()->routeIs('dashboard') ? 'text-white bg-primary-500 dark:bg-primary-900 hover:text-primary-900 dark:hover:text-primary-500' : 'dark:text-slate-200' }} hover:text-primary-500 font-medium truncate transition duration-150 text-slate-900"
                            href="{{ route('dashboard') }}">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span
                                        class="w-8 h-8 rounded bg-white dark:bg-gray-500 border border-gray-50 dark:border-transparent shadow-lg text-primary-500 dark:text-primary-500 inline-flex justify-center items-center">
                                        <i class="fa-solid fa-gauge text-base"></i>
                                    </span>
                                    <span
                                        class="text-sm font-semibold ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                        {{ __('Dashboard') }}</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!-- Order -->
                    @canany('Order view')
                        <li>
                            <a class="block px-3 py-1.5 rounded {{ request()->routeIs('order.*') ? 'text-white bg-primary-500 dark:bg-primary-900 hover:text-primary-900 dark:hover:text-primary-500' : 'dark:text-slate-200' }} hover:text-primary-500 truncate transition duration-150 text-gray-600"
                                href="{{ route('order.index') }}">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span
                                            class="w-8 h-8 rounded bg-white dark:bg-gray-500 border border-gray-50 dark:border-transparent shadow-lg text-primary-500 inline-flex justify-center items-center">
                                            <i class="fa-solid fa-money-bill-wave text-base"></i>
                                        </span>
                                        <span
                                            class="text-sm font-semibold ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                            {{ __('Order') }}</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endcanany
                    <!-- employer -->
                    @canany('Employer view')
                        <li>
                            <a href="{{ route('employer.index') }}"
                                class="block px-3 py-1.5 rounded {{ request()->routeIs('employer.*') ? 'text-white bg-primary-500 dark:bg-primary-900 hover:text-primary-900 dark:hover:text-primary-500' : 'dark:text-slate-200' }} hover:text-primary-500 truncate transition duration-150 text-gray-600"
                                href="#0">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span
                                            class="w-8 h-8 rounded bg-white dark:bg-gray-500 border border-gray-50 dark:border-transparent shadow-lg text-primary-500 inline-flex justify-center items-center">
                                            <i class="fa-solid fa-building text-base"></i>
                                        </span>
                                        <span
                                            class="text-sm font-semibold ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                            {{ __('Employer') }}</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endcanany
                    <!-- employee -->
                    @canany('Client view')
                        <li>
                            <a href="{{ route('employee.index') }}"
                                class="block px-3 py-1.5 rounded {{ request()->routeIs('employee.*') ? 'text-white bg-primary-500 dark:bg-primary-900 hover:text-primary-900 dark:hover:text-primary-500' : 'dark:text-slate-200' }} hover:text-primary-500 truncate transition duration-150 text-gray-600">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span
                                            class="w-8 h-8 rounded bg-white dark:bg-gray-500 border border-gray-50 dark:border-transparent shadow-lg text-primary-500 inline-flex justify-center items-center">
                                            <i class="fa-solid fa-user-tie text-base"></i>
                                        </span>
                                        <span
                                            class="text-sm font-semibold ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                            {{ __('Employee') }}</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endcanany
                    <!-- client -->
                    @canany('Client view')
                        <li>
                            <a href="{{ route('client.index') }}"
                                class="block px-3 py-1.5 rounded {{ request()->routeIs('client.*') ? 'text-white bg-primary-500 dark:bg-primary-900 hover:text-primary-900 dark:hover:text-primary-500' : 'dark:text-slate-200' }} hover:text-primary-500 truncate transition duration-150 text-gray-600">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span
                                            class="w-8 h-8 rounded bg-white dark:bg-gray-500 border border-gray-50 dark:border-transparent shadow-lg text-primary-500 inline-flex justify-center items-center">
                                            <i class="fa-solid fa-user-secret text-base"></i>
                                        </span>
                                        <span
                                            class="text-sm font-semibold ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                            {{ __('Client') }}</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endcanany
                    <!-- project -->
                    @if (auth('web')->user()->role != 'employee')
                        <li>
                            <a href="{{ route('project.index') }}"
                                class="block px-3 py-1.5 rounded {{ request()->routeIs('project.*') ? 'text-white bg-primary-500 dark:bg-primary-900 hover:text-primary-900 dark:hover:text-primary-500' : 'dark:text-slate-200' }} hover:text-primary-500 truncate transition duration-150 text-gray-600">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span
                                            class="w-8 h-8 rounded bg-white dark:bg-gray-500 border border-gray-50 dark:border-transparent shadow-lg text-primary-500 inline-flex justify-center items-center">
                                            <i class="fa-solid fa-list-check text-base"></i>
                                        </span>
                                        <span
                                            class="text-sm font-semibold ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                            {{ __('Project') }}</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endif
                    <!-- task -->
                    <li>
                        <a href="{{ route('task.index') }}"
                            class="block px-3 py-1.5 rounded {{ request()->routeIs('task.*') ? 'text-white bg-primary-500 dark:bg-primary-900 hover:text-primary-900 dark:hover:text-primary-500' : 'dark:text-slate-200' }} hover:text-primary-500 truncate transition duration-150 text-gray-600">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span
                                        class="w-8 h-8 rounded bg-white dark:bg-gray-500 border border-gray-50 dark:border-transparent shadow-lg text-primary-500 inline-flex justify-center items-center">
                                        <i class="fa-solid fa-briefcase"></i> </span>
                                    <span
                                        class="text-sm font-semibold ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                        {{ __('Task') }}</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!-- plan -->
                    @canany('Plan view')
                        <li>
                            <a href="{{ route('plans.index') }}"
                                class="block px-3 py-1.5 rounded {{ request()->routeIs('plans.*') ? 'text-white bg-primary-500 dark:bg-primary-900 hover:text-primary-900 dark:hover:text-primary-500' : 'dark:text-slate-200' }} hover:text-primary-500 truncate transition duration-150 text-gray-600">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span
                                            class="w-8 h-8 rounded bg-white dark:bg-gray-500 border border-gray-50 dark:border-transparent shadow-lg text-primary-500 inline-flex justify-center items-center">
                                            <i class="fa-solid fa-money-check-dollar text-base"></i>
                                        </span>
                                        <span
                                            class="text-sm font-semibold ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">

                                            {{ __('Price Plan') }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endcanany
                    <!-- timesheet -->
                    @canany('Timesheet view')
                        <li>
                            <a href="{{ route('timesheet.index') }}"
                                class="block px-3 py-1.5 rounded {{ request()->routeIs('timesheet.*') ? 'text-white bg-primary-500 dark:bg-primary-900 hover:text-primary-900 dark:hover:text-primary-500' : 'dark:text-slate-200' }} hover:text-primary-500  truncate transition duration-150 text-gray-600">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span
                                            class="w-8 h-8 rounded bg-white dark:bg-gray-500 border border-gray-50 dark:border-transparent shadow-lg text-primary-500 inline-flex justify-center items-center">
                                            <i class="fa-solid fa-hourglass text-base"></i>
                                        </span>
                                        <span
                                            class="text-sm font-semibold ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                            {{ __('Timesheet') }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endcanany
                    <!-- Report -->
                    @canany('Report view')
                        <li>
                            <a href="{{ route('reports.index') }}"
                                class="block px-3 py-1.5 rounded {{ request()->routeIs('reports.index') ? 'text-white bg-primary-500 dark:bg-primary-900 hover:text-primary-900 dark:hover:text-primary-500' : 'dark:text-slate-200' }} hover:text-primary-500 truncate transition duration-150 text-gray-600">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span
                                            class="w-8 h-8 rounded bg-white dark:bg-gray-500 border border-gray-50 dark:border-transparent shadow-lg text-primary-500 inline-flex justify-center items-center">
                                            <i class="fa-solid fa-chart-line text-base"></i>
                                        </span>
                                        <span
                                            class="text-sm font-semibold ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                            {{ __('Timesheet Report') }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endcanany

                    <!-- Leave Management Dropdown -->
                    <li x-data="{ 
                        open: {{ request()->routeIs('weekly_holidays.*') || request()->routeIs('holidays.*') || request()->routeIs('leave_types.*') ? 'true' : 'false' }} 
                    }" 
                    x-effect="if (!sidebarExpanded) open = true">
                        <a href="#" @click.stop="sidebarExpanded && (open = !open)"
                            class="flex justify-between items-center gap-2 px-3 py-1.5 rounded {{ request()->routeIs('leave.*') || request()->routeIs('weekly_holidays.*') || request()->routeIs('holidays.*') || request()->routeIs('leave_types.*') ? 'text-white bg-primary-500 dark:bg-primary-900 hover:text-primary-900 dark:hover:text-primary-500' : 'dark:text-slate-200' }} hover:text-primary-500 truncate transition duration-150 text-gray-600">
                            <div>
                                <span
                                    class="w-8 h-8 rounded bg-white dark:bg-gray-500 border border-gray-50 dark:border-transparent shadow-lg text-primary-500 inline-flex justify-center items-center">
                                    <i class="fa-solid fa-cog text-base"></i>
                                </span>
                                <span
                                    class="text-sm font-semibold ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    {{ __('Leave Management') }}
                                </span>
                            </div>
                            <div class="flex justify-center items-center shrink-0 w-6 h-6 cursor-pointer"
                               >
                                <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-white"
                                    :class="open ? 'rotate-180' : ''" viewBox="0 0 12 12">
                                    <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                </svg>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block bg-transparent">
                            <ul class="mt-1" :class="sidebarExpanded ? 'pl-9':'pl-0'" x-show="open" x-collapse>
                                  <!-- Weekly Holidays -->
                                  <li class="mb-1 last:mb-0">
                                    <a href="{{ route('leave.index') }}"
                                        class="block px-3 py-1.5 rounded {{ request()->routeIs('leave.*') ? 'text-white bg-primary-500 dark:bg-primary-900 hover:text-primary-900 dark:hover:text-primary-500' : 'dark:text-slate-200' }} hover:text-primary-500 truncate transition duration-150 text-gray-600">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <span
                                                    class="w-8 h-8 rounded bg-white dark:bg-gray-500 border border-gray-50 dark:border-transparent shadow-lg text-primary-500 inline-flex justify-center items-center">
                                                    <i class="fa-solid fa-calendar-alt text-base"></i>
                                                </span>
                                                <span
                                                    class="text-sm font-semibold ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                                    {{ __('Leave') }}
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- Weekly Holidays -->
                                <li class="mb-1 last:mb-0">
                                    <a href="{{ route('weekly_holidays.index') }}"
                                        class="block px-3 py-1.5 rounded {{ request()->routeIs('weekly_holidays.*') ? 'text-white bg-primary-500 dark:bg-primary-900 hover:text-primary-900 dark:hover:text-primary-500' : 'dark:text-slate-200' }} hover:text-primary-500 truncate transition duration-150 text-gray-600">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <span
                                                    class="w-8 h-8 rounded bg-white dark:bg-gray-500 border border-gray-50 dark:border-transparent shadow-lg text-primary-500 inline-flex justify-center items-center">
                                                    <i class="fa-solid fa-calendar-alt text-base"></i>
                                                </span>
                                                <span
                                                    class="text-sm font-semibold ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                                    {{ __('Weekly Holidays') }}
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </li>

                                <!-- Holidays -->
                                <li class="mb-1 last:mb-0">
                                    <a href="{{ route('holidays.index') }}"
                                        class="block px-3 py-1.5 rounded {{ request()->routeIs('holidays.*') ? 'text-white bg-primary-500 dark:bg-primary-900 hover:text-primary-900 dark:hover:text-primary-500' : 'dark:text-slate-200' }} hover:text-primary-500 truncate transition duration-150 text-gray-600">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <span
                                                    class="w-8 h-8 rounded bg-white dark:bg-gray-500 border border-gray-50 dark:border-transparent shadow-lg text-primary-500 inline-flex justify-center items-center">
                                                    <i class="fa-solid fa-calendar-alt text-base"></i>
                                                </span>
                                                <span
                                                    class="text-sm font-semibold ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                                    {{ __('Holidays') }}
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- Leave Types -->
                                <li class="mb-1 last:mb-0">
                                    <a href="{{ route('leave_types.index') }}"
                                        class="block px-3 py-1.5 rounded {{ request()->routeIs('leave_types.*') ? 'text-white bg-primary-500 dark:bg-primary-900 hover:text-primary-900 dark:hover:text-primary-500' : 'dark:text-slate-200' }} hover:text-primary-500 truncate transition duration-150 text-gray-600">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <span
                                                    class="w-8 h-8 rounded bg-white dark:bg-gray-500 border border-gray-50 dark:border-transparent shadow-lg text-primary-500 inline-flex justify-center items-center">
                                                    <i class="fa-solid fa-calendar-alt text-base"></i>
                                                </span>
                                                <span
                                                    class="text-sm font-semibold ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                                    {{ __('Leave Types') }}
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- Notice -->
                    {{-- @canany('Notice') --}}
                    <li>
                        <a href="{{ route('notices.index') }}"
                            class="block px-3 py-1.5 rounded {{ request()->routeIs('notices.*') ? 'text-white bg-primary-500 dark:bg-primary-900 hover:text-primary-900 dark:hover:text-primary-500' : 'dark:text-slate-200' }} hover:text-primary-500 truncate transition duration-150 text-gray-600">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span
                                        class="w-8 h-8 rounded bg-white dark:bg-gray-500 border border-gray-50 dark:border-transparent shadow-lg text-primary-500 inline-flex justify-center items-center">
                                        <i class="fa-solid fa-bullhorn text-base"></i>
                                    </span>
                                    <span
                                        class="text-sm font-semibold ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                        {{ __('Notice') }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </li>
                    {{-- @endcanany           --}}
                    <!-- Zoom Meeting -->
                    @canany('Zoom Meeting')
                        <li>
                            <a href="{{ route('meeting.index') }}"
                                class="block px-3 py-1.5 rounded {{ request()->routeIs('meeting.*') ? 'text-white bg-primary-500 dark:bg-primary-900 hover:text-primary-900 dark:hover:text-primary-500' : 'dark:text-slate-200' }} hover:text-primary-500 truncate transition duration-150 text-gray-600">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span
                                            class="w-8 h-8 rounded bg-white dark:bg-gray-500 border border-gray-50 dark:border-transparent shadow-lg text-primary-500 inline-flex justify-center items-center">
                                            <i class="fa-solid fa-video text-base"></i>
                                        </span>
                                        <span
                                            class="text-sm font-semibold ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                            {{ __('Zoom Meeting') }}</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endcanany
                    <!-- Invoice -->
                    {{-- @canany('Invoice view') --}}
                    <li>
                        <a href="{{ route('invoice.index') }}"
                            class="block px-3 py-1.5 rounded {{ request()->routeIs('invoice.*') ? 'text-white bg-primary-500 dark:bg-primary-900 hover:text-primary-900 dark:hover:text-primary-500' : 'dark:text-slate-200' }} hover:text-primary-500 truncate transition duration-150 text-gray-600">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span
                                        class="w-8 h-8 rounded bg-white dark:bg-gray-500 border border-gray-50 dark:border-transparent shadow-lg text-primary-500 inline-flex justify-center items-center">
                                        <i class="fa-solid fa-file-invoice text-base"></i>
                                    </span>
                                    <span
                                        class="text-sm font-semibold ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                        {{ __('Invoice') }}</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    {{-- @endcanany --}}
                    <!-- invite -->
                    @canany('Invite send')
                        <li>
                            <a href="{{ route('invite.send.employer.page') }}"
                                class="block px-3 py-1.5 rounded {{ request()->routeIs('invite.send.employer.page') ? 'text-white bg-primary-500 dark:bg-primary-900 hover:text-primary-900 dark:hover:text-primary-500' : 'dark:text-slate-200' }} hover:text-primary-500 truncate transition duration-150 text-gray-600 ">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span
                                            class="w-8 h-8 rounded bg-white dark:bg-gray-500 border border-gray-50 dark:border-transparent shadow-lg text-primary-500 inline-flex justify-center items-center">
                                            <i class="fa-regular fa-paper-plane text-base"></i>
                                        </span>
                                        <span
                                            class="text-sm font-semibold ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                            {{ __('Send Invite') }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endcanany
                    <!-- Email -->
                    @canany('Email view')
                        <li>
                            <a href="{{ route('emails.index') }}"
                                class="block px-3 py-1.5 rounded {{ request()->routeIs('emails.*') ? 'text-white bg-primary-500 dark:bg-primary-900 hover:text-primary-900 dark:hover:text-primary-500' : 'dark:text-slate-200' }} hover:text-primary-500 truncate transition duration-150 text-gray-600 ">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span
                                            class="w-8 h-8 rounded bg-white dark:bg-gray-500 border border-gray-50 dark:border-transparent shadow-lg text-primary-500 inline-flex justify-center items-center">
                                            <i class="fa-regular fa-envelope text-base"></i>
                                        </span>
                                        <span
                                            class="text-sm font-semibold ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                            {{ __('Send Mail') }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endcanany
                    <!-- role -->
                    @canany('Role view')
                        <li>
                            <a href="{{ route('role.page') }}"
                                class="block px-3 py-1.5 rounded {{ request()->routeIs('role.*') ? 'text-white bg-primary-500 dark:bg-primary-900 hover:text-primary-900 dark:hover:text-primary-500' : 'dark:text-slate-200' }} hover:text-primary-500 truncate transition duration-150 text-gray-600 ">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span
                                            class="w-8 h-8 rounded bg-white dark:bg-gray-500 border border-gray-50 dark:border-transparent shadow-lg text-primary-500 inline-flex justify-center items-center">
                                            <i class="fa-solid fa-user-lock text-base"></i>
                                        </span>
                                        <span
                                            class="text-sm font-semibold ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                            {{ __('Role Management') }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endcanany
                    <!-- Smtp -->
                    @canany('SMTP Config')
                        <li>
                            <a href="{{ route('smtp') }}"
                                class="block px-3 py-1.5 rounded {{ request()->routeIs('smtp') ? 'text-white bg-primary-500 dark:bg-primary-900 hover:text-primary-900 dark:hover:text-primary-500' : 'dark:text-slate-200' }} hover:text-primary-500 truncate transition duration-150 text-gray-600 ">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span
                                            class="w-8 h-8 rounded bg-white dark:bg-gray-500 border border-gray-50 dark:border-transparent shadow-lg text-primary-500 inline-flex justify-center items-center">
                                            <i class="fa-brands fa-mailchimp tetx-base"></i>
                                        </span>
                                        <span
                                            class="text-sm font-semibold ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                            {{ __('SMTP Config') }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endcanany
                    <!-- email -->
                    @canany('Email Templates')
                        <li>
                            <a href="{{ route('email_templates') }}"
                                class="block px-3 py-1.5 rounded {{ request()->routeIs('email_templates') ? 'text-white bg-primary-500 dark:bg-primary-900 hover:text-primary-900 dark:hover:text-primary-500' : 'dark:text-slate-200' }} hover:text-primary-500 truncate transition duration-150 text-gray-600 ">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span
                                            class="w-8 h-8 rounded bg-white dark:bg-gray-500 border border-gray-50 dark:border-transparent shadow-lg text-primary-500 inline-flex justify-center items-center">
                                            <i class="fa-regular fa-envelope text-base"></i>
                                        </span>
                                        <span
                                            class="text-sm font-semibold ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                            {{ __('Email Templates') }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endcanany
                    <!-- General -->
                    @canany('General Settings')
                        <li>
                            <a href="{{ route('payment') }}"
                                class="block px-3 py-1.5 rounded {{ request()->routeIs('payment') ? 'text-white bg-primary-500 dark:bg-primary-900 hover:text-primary-900 dark:hover:text-primary-500' : 'dark:text-slate-200' }} hover:text-primary-500 truncate transition duration-150 text-gray-600 ">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span
                                            class="w-8 h-8 rounded bg-white dark:bg-gray-500 border border-gray-50 dark:border-transparent shadow-lg text-primary-500 inline-flex justify-center items-center">
                                            <i class="fa-solid fa-file-invoice-dollar text-base"></i>
                                        </span>
                                        <span
                                            class="text-sm font-semibold ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                            {{ __('Payment Gateway') }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endcanany
                    <!-- Language -->
                    {{-- @canany('Language') --}}
                    <li>
                        <a href="{{ route('languages.index') }}"
                            class="block px-3 py-1.5 rounded {{ request()->routeIs('languages.*') ? 'text-white bg-primary-500 dark:bg-primary-900 hover:text-primary-900 dark:hover:text-primary-500' : 'dark:text-slate-200' }} hover:text-primary-500 truncate transition duration-150 text-gray-600 ">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span
                                        class="w-8 h-8 rounded bg-white dark:bg-gray-500 border border-gray-50 dark:border-transparent shadow-lg text-primary-500 inline-flex justify-center items-center">
                                        <i class="fa-solid fa-language text-base"></i>
                                    </span>
                                    <span
                                        class="text-sm font-semibold ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                        {{ __('Language') }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </li>
                    {{-- @endcanany --}}
                    <!-- General -->
                    @canany('General Settings')
                        <li>
                            <a href="{{ route('setting') }}"
                                class="block px-3 py-1.5 rounded {{ request()->routeIs('setting') ? 'text-white bg-primary-500 dark:bg-primary-900 hover:text-primary-900 dark:hover:text-primary-500' : 'dark:text-slate-200' }} hover:text-primary-500 truncate transition duration-150 text-gray-600 ">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span
                                            class="w-8 h-8 rounded bg-white dark:bg-gray-500 border border-gray-50 dark:border-transparent shadow-lg text-primary-500 inline-flex justify-center items-center">
                                            <i class="fa-solid fa-gears text-base"></i>
                                        </span>
                                        <span
                                            class="text-sm font-semibold ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                            {{ __('General Setting') }}

                                        </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endcanany
                    <!-- Theme -->
                    @canany('General Settings')
                        <li>
                            <a href="{{ route('themes.index') }}"
                                class="block px-3 py-1.5 rounded {{ request()->routeIs('themes.*') ? 'text-white bg-primary-500 dark:bg-primary-900 hover:text-primary-900 dark:hover:text-primary-500' : 'dark:text-slate-200' }} hover:text-primary-500 truncate transition duration-150 text-gray-600 ">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span
                                            class="w-8 h-8 rounded bg-white dark:bg-gray-500 border border-gray-50 dark:border-transparent shadow-lg text-primary-500 inline-flex justify-center items-center">
                                            <i class="fa-solid fa-gears text-base"></i>
                                        </span>
                                        <span
                                            class="text-sm font-semibold ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                            {{ __('Theme Settings') }}

                                        </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endcanany
                    <!-- upgrade -->
                    @canany('General Settings')
                        <li>
                            <a href="{{ route('upgrade') }}"
                                class="block px-3 py-1.5 rounded {{ request()->routeIs('upgrade') ? 'text-white bg-primary-500 dark:bg-primary-900 hover:text-primary-900 dark:hover:text-primary-500' : 'dark:text-slate-200' }} hover:text-primary-500 truncate transition duration-150 text-gray-600 ">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span
                                            class="w-8 h-8 rounded bg-white dark:bg-gray-500 border border-gray-50 dark:border-transparent shadow-lg text-primary-500 inline-flex justify-center items-center">
                                            <i class="fa-solid fa-upload text-base"></i>
                                        </span>
                                        <span
                                            class="text-sm font-semibold ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                            {{ __('Upgrade Application') }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endcanany
                    @if (auth()->user()->role === 'employer')
                        <li>
                            <a href="{{ route('employer.plan') }}"
                                class="block px-3 py-1.5 rounded {{ request()->routeIs('employer.plan') ? 'text-white bg-primary-500 dark:bg-primary-900 hover:text-primary-900 dark:hover:text-primary-500' : 'dark:text-slate-200' }} hover:text-primary-500 truncate transition duration-150"
                                href="#0">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span
                                            class="w-8 h-8 rounded bg-white dark:bg-gray-500 border border-gray-50 dark:border-transparent shadow-lg text-primary-500 inline-flex justify-center items-center">
                                            <i class="fa-solid fa-cart-shopping w-8"></i>
                                        </span>
                                        <span
                                            class="text-sm font-semibold ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                            {{ __('Biling & Plan') }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endif

                </ul>
            </div>
        </div>
    </div>
</div>
