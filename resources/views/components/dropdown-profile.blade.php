@props([
    'align' => 'right',
])

<div class="relative inline-flex" x-data="{ open: false }">
    <button class="inline-flex justify-center items-center group" aria-haspopup="true" @click.prevent="setTimeout(() => { open = !open }, 50)"
        :aria-expanded="open">

        @if (auth('web')->user()->role == 'employer' || auth('web')->user()->role == 'employee')
            <img class="w-8 h-8 rounded-full" src="{{ asset(auth('web')->user()->image ?? 'images/default-user.png') }}"
                width="32" height="32" alt="{{ auth('web')->user()->username }}" />
        @else
            <img class="w-8 h-8 rounded-full" src="{{ asset(auth('web')->user()->image ?? 'images/logo_symbol.png') }}"
                width="32" height="32" alt="{{ auth('web')->user()->username }}" />
        @endif
        <div class="flex gap-2 items-center truncate">
            <span
                class="truncate ms-3 text-sm font-medium text-primary-300 capitalize">{{ auth('web')->user()->username }}</span>
            <svg class="w-3 h-3 shrink-0 ms-1 fill-current text-primary-300" viewBox="0 0 12 12">
                <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
            </svg>
        </div>
    </button>
    <div class="origin-top-right z-10 absolute top-full min-w-44 bg-white dark:bg-slate-800 text-text-light dark:text-text-dark border border-slate-200 dark:border-slate-700 py-1.5 rounded shadow-lg overflow-hidden mt-1 {{ $align === 'right' ? 'right-0' : 'left-0' }}"
        @click.outside="open = false"
        @keydown.escape.window="open = false"
        x-show="open"
        x-transition:enter="transition ease-out duration-200 transform"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-out duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        x-cloak>
        <div class="pt-0.5 pb-2 px-3 mb-1 border-b border-slate-200 dark:border-slate-700">
            <div class="font-medium text-slate-800 dark:text-slate-100 capitalize">{{ auth('web')->user()->username }}
            </div>
        </div>
        <ul>
            @if (auth()->user()->role != 'superadmin')
                <li>
                    <a class="font-medium text-sm text-text-light dark:text-text-dark hover:text-primary-300 dark:hover:text-primary-300 flex items-center py-1 px-3"
                        href="{{ route('my.account') }}" @click="open = false">
                        <i class="fa-solid fa-gear me-2"></i>
                        {{ __('Account Settings') }}
                    </a>
                </li>
            @endif
            <li>
                <a class="font-medium text-sm text-text-light dark:text-text-dark hover:text-primary-300 dark:hover:text-primary-300 flex items-center py-1 px-3"
                    href="{{ route('profile.show') }}" @click="open = false">
                    <i class="fa-solid fa-user me-2"></i>
                    {{ __('User Settings') }}
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <a class="font-medium text-sm text-text-light dark:text-text-dark hover:text-primary-300 dark:hover:text-primary-300 flex items-center py-1 px-3"
                        href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        <i class="fa-solid fa-right-from-bracket me-2"></i>
                        {{ __('Sign Out') }}
                    </a>
                </form>
            </li>
        </ul>
    </div>
</div>
