<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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
</head>

<body class="font-montserrat antialiased">

    <main class="min-h-screen flex flex-col relative">
        <header
            class="bg-black bg-opacity-50 backdrop-blur p-4 rounded-md shadow-lg flex justify-between items-center mx-12 my-6">
            <img src="{{ asset('images/logo-inv.png') }}" alt="timesheet Logo" class="h-10">
            <nav class="flex items-center gap-4">
                <a href="#" class="inline-flex font-semibold text-base text-white hover:text-white/80">About
                    Us</a>
                <a href="#" class="inline-flex font-semibold text-base text-white hover:text-white/80">Terms and
                    Conditions</a>
                <a href="#" class="inline-flex font-semibold text-base text-white hover:text-white/80">Privacy
                    Policy</a>
                {{-- <select class="text-sm text-gray-600 border-gray-300 rounded-md">
                    <option>English</option>
                    <option>Español</option>
                    <option>Français</option>
                </select> --}}
                @php
                    $languages = loadLanguage();
                    $hasMultipleLanguages = count($languages) > 1;
                    $current_language = currentLanguage() ?: loadDefaultLanguage();
                    // dd($current_language);
                @endphp

                @if ($hasMultipleLanguages)
                    <form action="{{ route('changeLanguage') }}" method="GET" id="language-switcher-form">
                        <select name="language" id="language-switcher"
                            class="form-select text-white bg-transparent border-white/60"
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
        </header>
        <section
            class="flex-grow w-full flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0 relative z-20">
            <div class="flex gap-96 items-center">
                <div class="w-1/4 items-center justify-center">
                    <div class="clock w-full">
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
                <div class="w-1/2 relative flex items-center justify-center">

                    <div
                        class="relative z-50 w-full bg-black bg-opacity-50 backdrop-blur rounded-lg shadow md:mt-0 sm:max-w-lg xl:p-0">
                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="fixed top-0 end-0 w-1/2 bg-purple-500 h-screen -z-10"></div>
    </main>

    @livewireScripts
</body>

</html>
