<div>
    <!-- Sidebar backdrop (mobile only) -->
    <div class="relative inset-0 bg-gray-900 bg-opacity-30 z-40 lg:hidden  lg:z-auto transition-opacity duration-200"
        :class="sidebarOpen ? 'opacity-100' : 'opacity-0 pointer-events-none'" aria-hidden="true" x-cloak></div>

    <!-- Sidebar -->
    <div id="sidebar"
        class="flex flex-col absolute z-40 left-0 top-0 lg:static lg:left-auto lg:top-auto lg:translate-x-0 p-3 h-screen overflow-y-scroll lg:overflow-y-auto no-scrollbar w-64 lg:w-20 lg:sidebar-expanded:!w-64  shrink-0 dark:bg-gray-900 bg-white  transition-all duration-200 ease-in-out"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'" @click.outside="sidebarOpen = false"
        @keydown.escape.window="sidebarOpen = false" x-cloak="lg">

        <!-- Sidebar header -->
        <div class="flex justify-between  pr-3 sm:px-2">

            <!-- Hamburger button -->
            <button x-show="!sidebarExpanded" class="text-slate-500 hover:text-slate-600 lg:block hidden"
                @click.stop="sidebarOpen = !sidebarOpen" aria-controls="sidebar" :aria-expanded="sidebarOpen"
                @click="sidebarExpanded = !sidebarExpanded">
                <span class="sr-only">Open sidebar</span>
                <i class="fa-solid fa-bars text-3xl text-black dark:text-white w-8"></i>
            </button>
            <!-- Logo link (shown only when sidebarExpanded is true) -->
            <a class="block" x-show="sidebarExpanded" href="{{ route('dashboard') }}">
                <img src="{{ asset('images/logo-inv.png') }}" alt="" class="">
            </a>

            <a class="lg:hidden" x-show="!sidebarExpanded" href="{{ route('dashboard') }}">
                <img src="{{ asset('images/logo-inv.png') }}" alt="" class="">
            </a>
        </div>

        <!-- Links -->
        <div class="space-y-8">
            <!-- Pages group -->
            <div>
                <ul class="mt-3">
                    <!-- Dashboard -->
                    <li class="px-3 text-2xl p-2 rounded-sm mb-0.5 last:mb-0 ">
                        <a class="block {{ request()->routeIs('dashboard') ? 'text-indigo-600' : 'dark:text-slate-200' }} hover:text-[#1da8f7] truncate transition duration-150 text-gray-600"
                            href="{{ route('dashboard') }}">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-gauge w-8 w-8"></i>
                                    <span
                                        class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">{{
                                        __('Dashboard') }}</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!-- Order -->
                    @canany('Order view')
                    <li class="px-3 text-2xl p-2 rounded-sm mb-0.5 last:mb-0 ">
                        <a class="block {{ request()->routeIs('order.*') ? 'text-indigo-600' : 'dark:text-slate-200' }} hover:text-[#1da8f7] truncate transition duration-150 text-gray-600"
                            href="{{ route('order.index') }}">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-money-bill-wave w-8 w-8"></i>
                                    <span
                                        class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">{{
                                        __('Order') }}</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endcanany
                    <!-- employer -->
                    @canany('Employer view')
                    <li class="px-3 text-2xl p-2 rounded-sm mb-0.5 last:mb-0">
                        <a href="{{ route('employer.index') }}"
                            class="block {{ request()->routeIs('employer.*') ? 'text-indigo-600' : 'dark:text-slate-200' }} hover:text-[#1da8f7] truncate transition duration-150 text-gray-600"
                            href="#0">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-building w-8 w-8"></i>
                                    <span
                                        class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Employer</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endcanany
                    <!-- employee -->
                    @canany('Client view')
                    <li class="px-3 text-2xl p-2 rounded-sm mb-0.5 last:mb-0 ">
                        <a href="{{ route('employee.index') }}"
                            class="block {{ request()->routeIs('employee.*') ? 'text-indigo-600' : 'dark:text-slate-200' }} hover:text-[#1da8f7] truncate transition duration-150 text-gray-600">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-user-tie w-8 w-8"></i>
                                    <span
                                        class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Employee</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endcanany
                    <!-- client -->
                    @canany('Client view')
                    <li class="px-3 text-2xl p-2 rounded-sm mb-0.5 last:mb-0 ">
                        <a href="{{ route('client.index') }}"
                            class="block {{ request()->routeIs('client.*') ? 'text-indigo-600' : 'dark:text-slate-200' }} hover:text-[#1da8f7] truncate transition duration-150 text-gray-600">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-user-secret w-8 w-8"></i>
                                    <span
                                        class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Client</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endcanany
                    <!-- project -->
                    @if (auth('web')->user()->role != 'employee')
                    <li class="px-3 text-2xl p-2 rounded-sm mb-0.5 last:mb-0">
                        <a href="{{ route('project.index') }}"
                            class="block {{ request()->routeIs('project.*') ? 'text-indigo-600' : 'dark:text-slate-200' }} hover:text-[#1da8f7] truncate transition duration-150 text-gray-600">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-list-check w-8"></i>
                                    <span
                                        class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Project</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endif
                    <!-- plan -->
                    @canany('Plan view')
                    <li class="px-3 text-2xl p-2 rounded-sm mb-0.5 last:mb-0">
                        <a href="{{ route('plans.index') }}"
                            class="block {{ request()->routeIs('plans.*') ? 'text-indigo-600' : 'dark:text-slate-200' }} hover:text-[#1da8f7] truncate transition duration-150 text-gray-600">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-money-check-dollar w-8 w-8 w-8"></i>
                                    <span
                                        class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                        Price Plan</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endcanany
                    <!-- timesheet -->
                    @canany('Timesheet view')
                    <li class="px-3 text-2xl p-2 rounded-sm mb-0.5 last:mb-0">
                        <a href="{{ route('timesheet.index') }}"
                            class="block {{ request()->routeIs('timesheet.*') ? 'text-indigo-600' : 'dark:text-slate-200' }} hover:text-[#1da8f7]  truncate transition duration-150 text-gray-600">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-hourglass w-8 w-8"></i>
                                    <span
                                        class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Timesheet</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endcanany
                    <!-- Report -->
                    @canany('Report view')
                    <li class="px-3 text-2xl p-2 rounded-sm mb-0.5 last:mb-0">
                        <a href="{{ route('reports.index') }}"
                            class="block {{ request()->routeIs('reports.index') ? 'text-indigo-600' : 'dark:text-slate-200' }} hover:text-[#1da8f7] truncate transition duration-150 text-gray-600">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-chart-line w-8"></i>
                                    <span
                                        class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Timesheet
                                        Report</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endcanany
                    <!-- invite -->
                    @canany('Invite send')
                    <li class="px-3 text-2xl p-2 rounded-sm mb-0.5 last:mb-0">
                        <a href="{{ route('invite.send.employer.page') }}"
                            class="block {{ request()->routeIs('invite.send.employer.page') ? 'text-indigo-600' : 'dark:text-slate-200' }} hover:text-[#1da8f7] truncate transition duration-150 text-gray-600 ">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="fa-regular fa-paper-plane w-8"></i>
                                    <span
                                        class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Send
                                        Invite</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endcanany
                    <!-- role -->
                    @canany('Role view')
                    <li class="px-3 text-2xl p-2 rounded-sm mb-0.5 last:mb-0">
                        <a href="{{ route('role.page') }}"
                            class="block {{ request()->routeIs('role.*') ? 'text-indigo-600' : 'dark:text-slate-200' }} hover:text-[#1da8f7] truncate transition duration-150 text-gray-600 ">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-user-lock w-8"></i>
                                    <span
                                        class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Role
                                        Management
                                    </span>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endcanany
                    <!-- Smtp -->
                    @canany('SMTP Config')
                    <li class="px-3 text-2xl p-2 rounded-sm mb-0.5 last:mb-0">
                        <a href="{{ route('smtp') }}"
                            class="block {{ request()->routeIs('smtp') ? 'text-indigo-600' : 'dark:text-slate-200' }} hover:text-[#1da8f7] truncate transition duration-150 text-gray-600 ">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="fa-brands fa-mailchimp w-8"></i>
                                    <span
                                        class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">SMTP
                                        Config
                                    </span>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endcanany
                    <!-- email -->
                    @canany('Email Templates')
                    <li class="px-3 text-2xl p-2 rounded-sm mb-0.5 last:mb-0">
                        <a href="{{ route('email_templates') }}"
                            class="block {{ request()->routeIs('email_templates') ? 'text-indigo-600' : 'dark:text-slate-200' }} hover:text-[#1da8f7] truncate transition duration-150 text-gray-600 ">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="fa-regular fa-envelope w-8"></i> <span
                                        class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                        Email Templates
                                    </span>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endcanany
                    <!-- General -->
                    @canany('General Settings')
                    <li class="px-3 text-2xl p-2 rounded-sm mb-0.5 last:mb-0">
                        <a href="{{ route('payment') }}"
                            class="block {{ request()->routeIs('payment') ? 'text-indigo-600' : 'dark:text-slate-200' }} hover:text-[#1da8f7] truncate transition duration-150 text-gray-600 ">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-file-invoice-dollar w-8"></i> <span
                                        class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                        Payment Gateway
                                    </span>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endcanany
                    <!-- General -->
                    @canany('General Settings')
                    <li class="px-3 text-2xl p-2 rounded-sm mb-0.5 last:mb-0">
                        <a href="{{ route('setting') }}"
                            class="block {{ request()->routeIs('setting') ? 'text-indigo-600' : 'dark:text-slate-200' }} hover:text-[#1da8f7] truncate transition duration-150 text-gray-600 ">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-gears w-8"></i>
                                    <span
                                        class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                        General Setting
                                    </span>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endcanany
                    <!-- upgrade -->
                    @canany('General Settings')
                    <li class="px-3 text-2xl p-2 rounded-sm mb-0.5 last:mb-0">
                        <a href="{{ route('upgrade') }}"
                            class="block {{ request()->routeIs('upgrade') ? 'text-indigo-600' : 'dark:text-slate-200' }} hover:text-[#1da8f7] truncate transition duration-150 text-gray-600 ">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-upload w-8"></i>                                    <span
                                        class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                        Upgrade Application
                                    </span>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endcanany
                    @if(auth()->user()->role === 'employer')
                    <li class="px-3 text-2xl p-2 rounded-sm mb-0.5 last:mb-0">
                        <a href="{{ route('employer.plan') }}"
                            class="block {{ request()->routeIs('employer.plan') ? 'text-indigo-600' : 'dark:text-slate-200' }} hover:text-[#1da8f7] truncate transition duration-150"
                            href="#0">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-cart-shopping w-8"></i> <span
                                        class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Biling
                                        & Plan</span>
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