<header class="sticky top-0 bg-header-light dark:bg-header-dark border-b border-slate-200 dark:border-slate-700 z-10">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 -mb-px">
            <!-- Header: Left side -->
            <div>
                <!-- Logo -->
                <button x-show="sidebarExpanded" class="text-slate-500 text-2xl hover:text-slate-600"
                    @click.stop="sidebarOpen = !sidebarOpen" aria-controls="sidebar" :aria-expanded="sidebarOpen"
                    @click="sidebarExpanded = !sidebarExpanded">
                    <span class="sr-only">{{ __('Open sidebar') }}</span>
                    <i class="fa-solid fa-bars text-black dark:text-white"></i>
                </button>

                <!-- Logo -->
                <button x-show="!sidebarExpanded" class=" lg:hidden text-slate-500 text-2xl hover:text-slate-600"
                    @click.stop="sidebarOpen = !sidebarOpen" aria-controls="sidebar" :aria-expanded="sidebarOpen"
                    @click="sidebarExpanded = !sidebarExpanded">
                    <span class="sr-only">{{ __('Open sidebar') }}</span>
                    <i class="fa-solid fa-bars text-2xl p-3 text-text-light dark:text-text-dark"></i>
                </button>
                <a x-show="!sidebarExpanded" class="hidden lg:block mt-5" href="{{ route('dashboard') }}">
                    <img src="{{ asset('images/logo-inv.png') }}" alt="Logo" class="w-48 h-auto hidden dark:block ">
                    <img src="{{ asset('images/dark_logo.png') }}" alt="Logo" class="dark:hidden w-48 h-auto ">


                </a>
            </div>

            <!-- Header: Right side -->
            <div class="flex items-center space-x-3">

                <!-- Search Button with Modal -->
                {{--
                <x-modal-search /> --}}


                @php
                $languages = loadLanguage();
                $hasMultipleLanguages = count($languages) > 1;
                $current_language = currentLanguage() ?: loadDefaultLanguage();
                // dd($current_language);
                @endphp

                @if ($hasMultipleLanguages)
                <form action="{{ route('changeLanguage') }}" method="GET" id="language-switcher-form" class="!mb-0">
                    <select name="language" id="language-switcher" class="appearance-none bg-sidebar-light border-none dark:bg-sidebar-dark text-text-light dark:text-text-dark 
                               px-4 py-2 rounded-md pr-10 
                               bg-[url('data:image/svg+xml;utf8,<svg fill=\" %23ffffff\" viewBox=\"0 0 20 20\"
                        xmlns=\"http://www.w3.org/2000/svg\">
                        <path d=\"M5.516 7.548l4.484 4.5 4.484-4.5L16 9l-6 6-6-6 1.516-1.452z\" /></svg>')] bg-no-repeat
                        bg-right">
                        @foreach ($languages as $lang)
                        <option value="{{ $lang->code }}" {{ $lang->code === $current_language ? 'selected' : '' }}>
                            {{ $lang->name }}
                        </option>
                        @endforeach
                    </select>

                </form>


                @endif
                <!-- Dark mode toggle -->
                <x-theme-toggle />
                <!-- Notifications button -->
                <x-dropdown-notifications align="right" />


                <!-- Divider -->
                <hr class="w-px h-6 bg-slate-200 dark:bg-slate-700 border-none" />

                <!-- User button -->
                <x-dropdown-profile align="right" />

            </div>

        </div>
    </div>
</header>