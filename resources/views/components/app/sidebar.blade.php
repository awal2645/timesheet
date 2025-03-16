<div>
    <!-- Sidebar backdrop -->
    <div 
        class="fixed inset-0 bg-slate-900 bg-opacity-30 z-40 lg:hidden transition-opacity duration-200"
        x-show="mobileMenu"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="mobileMenu = false"
        aria-hidden="true">
    </div>

    <!-- Sidebar -->
    <div 
        id="sidebar"
        class="fixed lg:static inset-y-0 left-0 z-40 w-64 flex-shrink-0 bg-[#f1f2f6] dark:bg-[#202327] lg:h-[calc(100vh-128px)] overflow-y-scroll lg:overflow-y-auto no-scrollbar transition-transform duration-200 ease-in-out lg:translate-x-0"
        :class="mobileMenu ? 'translate-x-0 h-screen' : '-translate-x-64 lg:translate-x-0'"
        @click.outside="if($event.target.closest('#sidebar') === null && $event.target.closest('button') === null) mobileMenu = false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="-translate-x-64"
        x-transition:enter-end="translate-x-0">

        <!-- Sidebar content -->
        <div class="space-y-8 py-3 px-8">
            <!-- Pages group -->
            <div>
                <ul class="mt-3 space-y-2">
                    <!-- Dashboard -->
                    <li>Dashboard</li>
                    <li>
                        <a class="sidebar-menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                            href="{{ route('dashboard') }}">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="sidebar-menu-icon">
                                        <i class="fa-solid fa-gauge text-base"></i>
                                    </span>
                                    <span class="sidebar-menu-text">
                                        {{ __('Dashboard') }}</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!-- Order -->
                    @canany('Order view')
                        <li>
                            <a class="sidebar-menu-item {{ request()->routeIs('order.*') ? 'active' : '' }}"
                                href="{{ route('order.index') }}">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="sidebar-menu-icon">
                                            <i class="fa-solid fa-money-bill-wave text-base"></i>
                                        </span>
                                        <span class="sidebar-menu-text">
                                            {{ __('Order') }}</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endcanany
                    <!-- employer -->
                    <li>Data Section</li>
                    @canany('Employer view')
                        <li>
                            <a href="{{ route('employer.index') }}"
                                class="sidebar-menu-item {{ request()->routeIs('employer.*') ? 'active' : '' }}"
                                href="#0">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="sidebar-menu-icon">
                                            <i class="fa-solid fa-building text-base"></i>
                                        </span>
                                        <span class="sidebar-menu-text">
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
                                class="sidebar-menu-item {{ request()->routeIs('employee.*') ? 'active' : '' }} ">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="sidebar-menu-icon">
                                            <i class="fa-solid fa-user-tie text-base"></i>
                                        </span>
                                        <span class="sidebar-menu-text">
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
                                class="sidebar-menu-item {{ request()->routeIs('client.*') ? 'active' : '' }} ">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="sidebar-menu-icon">
                                            <i class="fa-solid fa-user-secret text-base"></i>
                                        </span>
                                        <span class="sidebar-menu-text">
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
                                class="sidebar-menu-item {{ request()->routeIs('project.*') ? 'active' : '' }} ">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="sidebar-menu-icon">
                                            <i class="fa-solid fa-list-check text-base"></i>
                                        </span>
                                        <span class="sidebar-menu-text">
                                            {{ __('Project') }}</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endif
                    <!-- task -->
                    <li>
                        <a href="{{ route('task.index') }}"
                            class="sidebar-menu-item {{ request()->routeIs('task.*') ? 'active' : '' }} ">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="sidebar-menu-icon">
                                        <i class="fa-solid fa-briefcase"> </i>
                                    </span>
                                    <span class="sidebar-menu-text">
                                        {{ __('Task') }}</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!-- plan -->
                    @canany('Plan view')
                        <li>
                            <a href="{{ route('plans.index') }}"
                                class="sidebar-menu-item {{ request()->routeIs('plans.*') ? 'active' : '' }} ">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="sidebar-menu-icon">
                                            <i class="fa-solid fa-money-check-dollar text-base"></i>
                                        </span>
                                        <span class="sidebar-menu-text">

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
                                class="sidebar-menu-item {{ request()->routeIs('timesheet.*') ? 'active' : '' }} ">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="sidebar-menu-icon">
                                            <i class="fa-solid fa-hourglass text-base"></i>
                                        </span>
                                        <span class="sidebar-menu-text">
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
                                class="sidebar-menu-item {{ request()->routeIs('reports.index') ? 'active' : '' }} ">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="sidebar-menu-icon">
                                            <i class="fa-solid fa-chart-line text-base"></i>
                                        </span>
                                        <span class="sidebar-menu-text">
                                            {{ __('Timesheet Report') }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endcanany

                    <!-- Leave Management Dropdown -->
                    @canany('Leave view')

                        <li x-data="{
                            open: {{ request()->routeIs('weekly_holidays.*') || request()->routeIs('holidays.*') || request()->routeIs('leave_types.*') || request()->routeIs('leave.*') ? 'true' : 'false' }}
                        }">
                            <a href="#" @click.stop="open = !open"
                                class="flex justify-between items-center gap-2 px-3 py-1.5 rounded {{ request()->routeIs('leave.*') || request()->routeIs('weekly_holidays.*') || request()->routeIs('holidays.*') || request()->routeIs('leave_types.*') ? 'active' : '' }} ">
                                <div class="flex items-center">
                                    <span class="sidebar-menu-icon">
                                        <i class="fa-solid fa-person-walking-arrow-right"></i> </span>
                                    <span class="sidebar-menu-text text-text-light dark:text-text-dark">
                                        {{ __('Leave Management') }}
                                    </span>
                                </div>
                                <div 
                                    class="flex justify-center items-center shrink-0 w-6 h-6 cursor-pointer">
                                    <svg class="w-3 h-3 shrink-0 ms-1 fill-current text-gray-white"
                                        :class="open ? 'rotate-180' : ''" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </a>
                            <div class="lg:hidden lg:sidebar-expanded:block 2xl:block bg-transparent ps-5">
                                <ul class="mt-1" x-show="open" x-collapse>
                                    @canany('Leave view')
                                        <!--  Leave -->
                                        <li class="mb-1 last:mb-0">
                                            <a href="{{ route('leave.index') }}"
                                                class="sidebar-menu-item {{ request()->routeIs('leave.*') ? 'active' : '' }} ">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center">
                                                        <span class="sidebar-menu-text">
                                                            {{ __('Leave') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    @endcanany
                                    <!-- Weekly Holidays -->
                                    @canany('Weekly Holidays view')
                                        <li class="mb-1 last:mb-0">
                                            <a href="{{ route('weekly_holidays.index') }}"
                                                class="sidebar-menu-item {{ request()->routeIs('weekly_holidays.*') ? 'active' : '' }} ">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center">
                                                        <span class="sidebar-menu-icon">
                                                            <i class="fa-solid fa-retweet"></i> </span>
                                                        <span class="sidebar-menu-text">
                                                            {{ __('Weekly Holidays') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    @endcanany
                                    <!-- Holidays -->
                                    @canany('Holiday view')
                                        <li class="mb-1 last:mb-0">
                                            <a href="{{ route('holidays.index') }}"
                                                class="sidebar-menu-item {{ request()->routeIs('holidays.*') ? 'active' : '' }} ">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center">
                                                        <span class="sidebar-menu-icon">
                                                            <i class="fa-solid fa-mug-hot"></i>
                                                        </span>
                                                        <span class="sidebar-menu-text">
                                                            {{ __('Holidays') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    @endcanany
                                    <!-- Leave Types -->
                                    @canany('Leave Types view')
                                        <li class="mb-1 last:mb-0">
                                            <a href="{{ route('leave_types.index') }}"
                                                class="sidebar-menu-item {{ request()->routeIs('leave_types.*') ? 'active' : '' }} ">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center">
                                                        <span class="sidebar-menu-icon">
                                                            <i class="fa-solid fa-calendar-alt text-base"></i>
                                                        </span>
                                                        <span class="sidebar-menu-text">
                                                            {{ __('Leave Types') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    @endcanany
                                </ul>
                            </div>
                        </li>
                    @endcanany
                    <!-- Notice -->
                    @canany('Notice view')
                        <li>
                            <a href="{{ route('notices.index') }}"
                                class="sidebar-menu-item {{ request()->routeIs('notices.*') ? 'active' : '' }} ">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="sidebar-menu-icon">
                                            <i class="fa-solid fa-bullhorn text-base"></i>
                                        </span>
                                        <span class="sidebar-menu-text">
                                            {{ __('Notice') }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endcanany
                    <!-- Zoom Meeting -->
                    <li>Setting Section</li>
                    @canany('Zoom Meeting view')
                        <li>
                            <a href="{{ route('meeting.index') }}"
                                class="sidebar-menu-item {{ request()->routeIs('meeting.*') ? 'active' : '' }} ">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="sidebar-menu-icon">
                                            <i class="fa-solid fa-video text-base"></i>
                                        </span>
                                        <span class="sidebar-menu-text">
                                            {{ __('Zoom Meeting') }}</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endcanany
                    <!-- Invoice -->
                    @canany('Invoice view')
                        <li>
                            <a href="{{ route('invoice.index') }}"
                                class="sidebar-menu-item {{ request()->routeIs('invoice.*') ? 'active' : '' }} ">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="sidebar-menu-icon">
                                            <i class="fa-solid fa-file-invoice text-base"></i>
                                        </span>
                                        <span class="sidebar-menu-text">
                                            {{ __('Invoice') }}</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endcanany
                    <!-- invite -->
                    @canany('Invite send')
                        <li>
                            <a href="{{ route('invite.send.employer.page') }}"
                                class="sidebar-menu-item {{ request()->routeIs('invite.send.employer.page') ? 'active' : '' }}  ">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="sidebar-menu-icon">
                                            <i class="fa-regular fa-paper-plane text-base"></i>
                                        </span>
                                        <span class="sidebar-menu-text">
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
                                class="sidebar-menu-item {{ request()->routeIs('emails.*') ? 'active' : '' }} ">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="sidebar-menu-icon">
                                            <i class="fa-regular fa-envelope text-base"></i>
                                        </span>
                                        <span class="sidebar-menu-text">
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
                                class="sidebar-menu-item {{ request()->routeIs('role.*') ? 'active' : '' }} ">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="sidebar-menu-icon">
                                            <i class="fa-solid fa-user-lock text-base"></i>
                                        </span>
                                        <span class="sidebar-menu-text">
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
                                class="sidebar-menu-item {{ request()->routeIs('smtp') ? 'active' : '' }} ">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="sidebar-menu-icon">
                                            <i class="fa-brands fa-mailchimp tetx-base"></i>
                                        </span>
                                        <span class="sidebar-menu-text">
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
                                class="sidebar-menu-item {{ request()->routeIs('email_templates') ? 'active' : '' }}  ">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="sidebar-menu-icon">
                                            <i class="fa-regular fa-envelope text-base"></i>
                                        </span>
                                        <span class="sidebar-menu-text">
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
                                class="sidebar-menu-item {{ request()->routeIs('payment') ? 'active' : '' }}  ">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="sidebar-menu-icon">
                                            <i class="fa-solid fa-file-invoice-dollar text-base"></i>
                                        </span>
                                        <span class="sidebar-menu-text">
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
                                class="sidebar-menu-item {{ request()->routeIs('languages.*') ? 'active' : '' }}  ">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="sidebar-menu-icon">
                                            <i class="fa-solid fa-language text-base"></i>
                                        </span>
                                        <span class="sidebar-menu-text">
                                            {{ __('Language') }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    {{-- @endcanany --}}
                    <!-- Contact -->
                    @canany('Contact view')
                        <li>
                            <a href="{{ route('contact.index') }}"
                                class="sidebar-menu-item {{ request()->routeIs('contact.*') ? 'active' : '' }}  ">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="sidebar-menu-icon">
                                            <i class="fa-solid fa-phone text-base"></i>
                                        </span>
                                        <span class="sidebar-menu-text">
                                            {{ __('Contact') }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endcanany
                    <!-- Newsletter -->
                    @canany('Newsletter view')
                        <li>
                            <a href="{{ route('newsletter.index') }}"
                                class="sidebar-menu-item {{ request()->routeIs('newsletter.*') ? 'active' : '' }}  ">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="sidebar-menu-icon">
                                            <i class="fa-solid fa-envelope text-base"></i>
                                        </span>
                                        <span class="sidebar-menu-text">
                                            {{ __('Newsletter') }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endcanany
                    <!-- General -->
                    @canany('General Settings')
                        <li>
                            <a href="{{ route('setting') }}"
                                class="sidebar-menu-item {{ request()->routeIs('setting') ? 'active' : '' }}  ">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="sidebar-menu-icon">
                                            <i class="fa-solid fa-gears text-base"></i>
                                        </span>
                                        <span class="sidebar-menu-text">
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
                                class="sidebar-menu-item {{ request()->routeIs('themes.*') ? 'active' : '' }}  ">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="sidebar-menu-icon">
                                            <i class="fa-brands fa-elementor"></i> </span>
                                        <span class="sidebar-menu-text">
                                            {{ __('Theme Settings') }}

                                        </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endcanany
                    <!-- Cms -->
                    @canany('Cms')
                        <li>
                            <a href="{{ route('cms.index') }}"
                                class="sidebar-menu-item {{ request()->routeIs('cms.index') ? 'active' : '' }}  ">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="sidebar-menu-icon">
                                            <i class="fa-solid fa-arrows-to-circle"></i> </span>
                                        <span class="sidebar-menu-text">
                                            {{ __('CMS') }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endcanany

                    <!-- testimonial -->
                    @canany('Testimonial view')
                        <li>
                            <a href="{{ route('testimonial.index') }}"
                                class="sidebar-menu-item {{ request()->routeIs('testimonial.*') ? 'active' : '' }}  ">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="sidebar-menu-icon">
                                            <i class="fa-solid fa-user-tie"></i>
                                        </span>
                                        <span class="sidebar-menu-text">
                                            {{ __('Testimonial') }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endcanany
                    <!-- Employee Salary -->
                    @canany('Employee Salary view')
                        <li>
                            <a href="{{ route('salary') }}"
                                class="sidebar-menu-item {{ request()->routeIs('salary') ? 'active' : '' }}  ">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="sidebar-menu-icon">
                                            <i class="fa-solid fa-money-bill-wave"></i> </span>
                                        <span class="sidebar-menu-text">
                                            {{ __('Employee Salary') }}
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
                                class="sidebar-menu-item {{ request()->routeIs('upgrade') ? 'active' : '' }}  ">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="sidebar-menu-icon">
                                            <i class="fa-solid fa-upload text-base"></i>
                                        </span>
                                        <span class="sidebar-menu-text">
                                            {{ __('Update Application') }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endcanany
                    @if (auth()->user()->role === 'employer')
                        <li>
                            <a href="{{ route('employer.plan') }}"
                                class="sidebar-menu-item {{ request()->routeIs('employer.plan') ? 'active' : '' }}"
                                href="#0">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="sidebar-menu-icon">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                        </span>
                                        <span class="sidebar-menu-text">
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
