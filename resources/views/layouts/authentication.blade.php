<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ langDirection() }}" >

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400..700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    <script>
        if (localStorage.getItem('dark-mode') === 'false' || !('dark-mode' in localStorage)) {
            document.querySelector('html').classList.remove('dark');
            document.querySelector('html').style.colorScheme = 'light';
        } else {
            document.querySelector('html').classList.add('dark');
            document.querySelector('html').style.colorScheme = 'dark';
        }

        // Function to handle login form submission
        function submitLoginForm(role) {
            let username = '';

            // Set username based on the role
            if (role === 'superadmin') {
                username = 'timesheet';
            } else if (role === 'employer') {
                username = 'employer';
            } else if (role === 'employee') {
                username = 'employee';
            } else if (role === 'client') {
                username = 'client';
            }

            // Set the form values
            document.getElementById('username').value = username;

            // Submit the form
            document.getElementById('login-form').submit();
        }
    </script>
    <link href="{{ asset('css/theme.css') }}?v={{ filemtime(public_path('css/theme.css')) }}" rel="stylesheet">
</head>

<body class="font-montserrat antialiased bg-body-light dark:bg-body-dark" x-data="{ openMenu: false }">
    <header class="container">
        <div
            class="bg-card-light dark:bg-card-dark bg-opacity-50 backdrop-blur p-4 rounded-md shadow-lg flex justify-between items-center mx-12 my-6">
            {{-- <img src="{{ asset('images/logo-inv.png') }}" alt="timesheet Logo" class="h-10"> --}}
            <a href="/">
                <img src="{{ asset('images/logo-inv.png') }}" alt="Logo" class="w-48 h-auto hidden dark:block ">
                <img src="{{ asset('images/dark_logo.png') }}" alt="Logo" class="dark:hidden w-48 h-auto ">
            </a>

            <nav class="hidden lg:flex items-center gap-4">
                <a href="{{ route('terms') }}"
                    class="inline-flex font-semibold text-base text-text-light dark:text-text-dark hover:text-text-light/80 dark:hover:text-text-dark/80">
                    {{ __('Terms and Conditions') }}
                </a>
                <a href="{{ route('privacy') }}"
                    class="inline-flex font-semibold text-base text-text-light dark:text-text-dark hover:text-text-light/80 dark:hover:text-text-dark/80">
                    {{ __('Privacy Policy') }}
                </a>
                @php
                    $languages = loadLanguage();
                    $hasMultipleLanguages = count($languages) > 1;
                    $current_language = currentLanguage() ?: loadDefaultLanguage();
                @endphp

                @if ($hasMultipleLanguages)
                    <form action="{{ route('changeLanguage') }}" method="GET" id="language-switcher-form">
                        <select name="language" id="language-switcher"
                            class="form-select text-text-light dark:text-text-dark bg-card-light dark:bg-card-dark border-white/60"
                            onchange="document.getElementById('language-switcher-form').submit()">
                            @foreach ($languages as $lang)
                                <option value="{{ $lang->code }}"
                                    {{ $lang->code === $current_language ? 'selected' : '' }}>
                                    {{ $lang->name }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                @endif
            </nav>
            <button class="lg:hidden" @click="openMenu = !openMenu">
                <span class="hamburger-line block w-6 h-1 mb-1 bg-white"></span>
                <span class="hamburger-line block w-6 h-1 mb-1 bg-white"></span>
                <span class="hamburger-line block w-6 h-1 mb-1 bg-white"></span>
            </button>
        </div>
    </header>
    <div x-show="openMenu"
        class="z-[9999] fixed top-0 right-0 bg-black text-white w-[90%] h-screen transition-transform transform"
        x-transition:enter="transition-transform ease-in-out duration-300" x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0" x-transition:leave="transition-transform ease-in-out duration-300"
        x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">
        <nav class="py-6 px-8">
            <div class="flex justify-between items-center mb-12">
                <div>
                    <img src="{{ asset('images/logo-inv.png') }}" alt="Logo"
                        class="w-48 h-auto hidden dark:block ">
                    <img src="{{ asset('images/dark_logo.png') }}" alt="Logo" class="dark:hidden w-48 h-auto ">
                </div>
                <button @click="openMenu = false">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <nav class="flex flex-col gap-4">
                <a href="#"
                    class="inline-flex font-semibold text-base text-text-light dark:text-text-dark hover:text-text-light/80 dark:hover:text-text-dark/80">About
                    Us</a>
                <a href="#"
                    class="inline-flex font-semibold text-base text-text-light dark:text-text-dark hover:text-text-light/80 dark:hover:text-text-dark/80">Terms
                    and
                    Conditions</a>
                <a href="#"
                    class="inline-flex font-semibold text-base text-text-light dark:text-text-dark hover:text-text-light/80 dark:hover:text-text-dark/80">Privacy
                    Policy</a>
                @php
                    $languages = loadLanguage();
                    $hasMultipleLanguages = count($languages) > 1;
                    $current_language = currentLanguage() ?: loadDefaultLanguage();
                    // dd($current_language);
                @endphp

                @if ($hasMultipleLanguages)
                    <form action="{{ route('changeLanguage') }}" method="GET" id="language-switcher-form">
                        <select name="language" id="language-switcher"
                            class="form-select text-text-light dark:text-text-dark bg-card-light dark:bg-card-dark border-white/60"
                            onchange="document.getElementById('language-switcher-form').submit()">
                            @foreach ($languages as $lang)
                                <option value="{{ $lang->code }}"
                                    {{ $lang->code === $current_language ? 'selected' : '' }}>
                                    {{ $lang->name }}
                                </option>
                            @endforeach
                        </select>
                    </form>


                @endif
            </nav>
            {{-- Add more links as needed --}}
        </nav>
    </div>
    <div x-show="openMenu" class="z-[990] fixed top-0 left-0 bg-black bg-opacity-50 w-full h-screen"
        @click="openMenu = false"></div>
    <main class="container">
        <section
            class="min-h-[calc(100vh-200px)] flex lg:flex-row flex-col gap-8 justify-center lg:justify-between items-center">
            <div class="lg:w-1/2 hidden lg:flex items-center justify-center">
                <div class="clock w-full max-w-max">
                    <div class="hour"></div>
                    <div class="min"></div>
                    <div class="sec"></div>
                </div>
                <style>
                    :root {
                        --main-bg-color: #fff;
                        --main-text-color: #888888;
                    }

                    [data-theme="dark"] {
                        --main-bg-color: #1e1f26;
                        --main-text-color: #ccc;
                    }

                    * {
                        box-sizing: border-box;
                        /* 		transition: all ease 0.2s; */
                    }

                    body {
                        margin: 0;
                        height: 100vh;
                        display: flex;
                        flex-direction: column;
                        justify-content: space-between;
                        align-items: center;
                        font-size: 16px;
                        background-color: var(--main-bg-color);
                        position: relative;
                        transition: all ease 0.2s;
                    }

                    .page-header {
                        font-size: 2rem;
                        color: var(--main-text-color);
                        padding: 2rem 0;
                        font-family: monospace;
                        text-transform: uppercase;
                        letter-spacing: 4px;
                        transition: all ease 0.2s;
                    }

                    .clock {
                        min-height: 30em;
                        min-width: 30em;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        background-color: var(--main-bg-color);
                        background-image: url("https://imvpn22.github.io/analog-clock/clock.png");
                        background-position: center center;
                        background-size: cover;
                        border-radius: 50%;
                        border: 4px solid var(--main-bg-color);
                        box-shadow: 0 -15px 15px rgba(255, 255, 255, 0.05),
                            inset 0 -15px 15px rgba(255, 255, 255, 0.05), 0 15px 15px rgba(0, 0, 0, 0.3),
                            inset 0 15px 15px rgba(0, 0, 0, 0.3);
                        transition: all ease 0.2s;
                    }

                    .clock:before {
                        content: "";
                        height: 0.75rem;
                        width: 0.75rem;
                        background-color: var(--main-text-color);
                        border: 2px solid var(--main-bg-color);
                        position: absolute;
                        border-radius: 50%;
                        z-index: 1000;
                        transition: all ease 0.2s;
                    }

                    .hour,
                    .min,
                    .sec {
                        position: absolute;
                        display: flex;
                        justify-content: center;
                        border-radius: 50%;
                    }

                    .hour {
                        height: 10em;
                        width: 10em;
                    }

                    .hour:before {
                        content: "";
                        position: absolute;
                        height: 50%;
                        width: 6px;
                        background-color: var(--main-text-color);
                        border-radius: 6px;
                    }

                    .min {
                        height: 12em;
                        width: 12em;
                    }

                    .min:before {
                        content: "";
                        height: 50%;
                        width: 4px;
                        background-color: var(--main-text-color);
                        border-radius: 4px;
                    }

                    .sec {
                        height: 13em;
                        width: 13em;
                    }

                    .sec:before {
                        content: "";
                        height: 60%;
                        width: 2px;
                        background-color: #f00;
                        border-radius: 2px;
                    }

                    /* Style for theme switch btn */
                    .switch-cont {
                        margin: 2em auto;
                        /* position: absolute; */
                        bottom: 0;
                    }

                    .switch-cont .switch-btn {
                        font-family: monospace;
                        text-transform: uppercase;
                        outline: none;
                        padding: 0.5rem 1rem;
                        background-color: var(--main-bg-color);
                        color: var(--main-text-color);
                        border: 1px solid var(--main-text-color);
                        border-radius: 0.25rem;
                        cursor: pointer;
                        transition: all ease 0.3s;
                    }
                </style>
                <script>
                    const deg = 6;
                    const hour = document.querySelector(".hour");
                    const min = document.querySelector(".min");
                    const sec = document.querySelector(".sec");

                    const setClock = () => {
                        let day = new Date();
                        let hh = day.getHours() * 30;
                        let mm = day.getMinutes() * deg;
                        let ss = day.getSeconds() * deg;

                        hour.style.transform = `rotateZ(${hh + mm / 12}deg)`;
                        min.style.transform = `rotateZ(${mm}deg)`;
                        sec.style.transform = `rotateZ(${ss}deg)`;
                    };

                    // first time
                    setClock();
                    // Update every 1000 ms
                    setInterval(setClock, 1000);
                </script>
            </div>
            <div class="lg:w-1/2 w-full relative flex items-center justify-center">
                <div
                    class="relative z-50 w-full card bg-card-light dark:bg-card-dark bg-opacity-50 backdrop-blur rounded-lg shadow md:mt-0 sm:max-w-lg xl:p-0">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </section>
        <div class="fixed top-0 end-0 w-full md:w-1/2 bg-primary-50 h-screen -z-10"></div>
    </main>
    @livewireScripts
</body>

</html>
