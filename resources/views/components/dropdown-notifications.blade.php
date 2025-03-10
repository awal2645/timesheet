@props([
    'align' => 'right',
])
<div class="relative inline-flex" x-data="{ open: false }">
    <button
        class="w-8 h-8 flex items-center justify-center  hover:bg-primary-50 dark:hover:bg-primary-50 rounded-full"
        :class="{ 'bg-primary-50': open }" aria-haspopup="true" @click.prevent="open = !open" :aria-expanded="open">
        <span class="sr-only text-text-light dark:text-text-dark">{{ __('Notifications') }}</span>
        <i class="fa-solid fa-bell"></i>
        <div
            class="absolute top-0 right-0 w-2.5 h-2.5 bg-rose-500 border-2 border-white dark:border-[#182235] rounded-full">
        </div>
    </button>
    <div class="origin-top-right z-10 absolute top-full -me-48 sm:me-0 min-w-[220px] md:min-w-80 bg-white dark:bg-slate-800   text-text-light  
 dark:text-text-dark   border border-slate-200 dark:border-slate-700 py-1.5 rounded shadow-lg overflow-hidden mt-1 {{ $align === 'right' ? 'right-0' : 'left-0' }}"
        @click.outside="open = false" @keydown.escape.window="open = false" x-show="open"
        x-transition:enter="transition ease-out duration-200 transform"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-out duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" x-cloak>
        <div class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase pt-1.5 pb-2 px-4">Notifications
        </div>
        <ul>
            @foreach (notification() as $notification)
                <li class="border-b border-card-light dark:border-card-dark last:border-0">
                    <a class="block py-2 px-4 hover:bg-primary-50 dark:hover:bg-primary-50"
                        href="{{ $notification->page_url ?? '#' }}" @click="open = false" @focus="open = true"
                        @focusout="open = false">
                        <span class="block text-sm mb-2">📣
                            <span class="font-medium text-text-light dark:text-text-dark">
                                {{ $notification->message }}
                            </span>
                        </span>
                        <span
                            class="block text-xs font-medium text-text-light dark:text-text-dark">{{ $notification->created_at->diffForHumans() }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="flex justify-center">
            <a href="{{ route('notification.del') }}"
                class="text-text-light dark:text-text-dark cursor-pointer hover:text-primary-00">
                {{ __('Mark as Read') }}
            </a>
        </div>
    </div>
</div>
