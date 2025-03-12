<header class="sticky top-0 bg-white dark:bg-[#0D0D0D] border-b border-slate-200 dark:border-slate-700 z-10">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 -mb-px">
            <!-- Header: Left side -->
            <div>
                <!-- Logo -->
                <a class="inline-block" href="{{ route('dashboard') }}">
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
                    <form action="{{ route('changeLanguage') }}" method="GET" id="language-switcher-form"
                        class="!mb-0">
                        <select name="language" id="language-switcher"
                            class="appearance-none bg-transparent border-none focus:ring-0 text-primary-300
                               px-4 py-2 rounded-md bg-no-repeat
                        bg-right">
                            @foreach ($languages as $lang)
                                <option value="{{ $lang->code }}"
                                    {{ $lang->code === $current_language ? 'selected' : '' }}>
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
                {{-- <hr class="w-px h-6 bg-slate-200 dark:bg-slate-700 border-none" /> --}}

                <!-- User button -->
                <x-dropdown-profile align="right" />

            </div>

        </div>
    </div>
</header>
