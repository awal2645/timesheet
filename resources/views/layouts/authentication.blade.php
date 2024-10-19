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
    </script>
</head>

<body class="font-montserrat antialiased">

    <main class="min-h-screen flex flex-col relative">
        <header
            class="bg-white/10 border border-white/60 backdrop-blur p-4 rounded-md shadow-lg flex justify-between items-center mx-12 my-6">
            <img src="{{ asset('images/logo-inv.png') }}" alt="timesheet Logo" class="h-10">
            <nav class="flex items-center gap-4">
                <a href="#" class="inline-flex font-semibold text-base text-white hover:text-white/80">About Us</a>
                <a href="#" class="inline-flex font-semibold text-base text-white hover:text-white/80">Terms and
                    Conditions</a>
                <a href="#" class="inline-flex font-semibold text-base text-white hover:text-white/80">Privacy
                    Policy</a>
                <select class="text-sm text-gray-600 border-gray-300 rounded-md">
                    <option>English</option>
                    <option>Español</option>
                    <option>Français</option>
                </select>
            </nav>
        </header>
        <section
            class="flex-grow w-full flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0 relative z-20">
            <div class="flex gap-12 items-center">
                <div class="w-1/2 flex items-center justify-center">
                    <img src="{{ asset('/images/hero.png') }}" alt="timesheet Vector" class="w-4/5">
                </div>
                <div class="w-1/2 relative flex items-center justify-center">
                    <h2
                        class="text-[100px] tracking-wider text-teal-800 font-bold italic font-montserrat text-center absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10">
                        Task & Time Tracking Tools</h2>
                    <div
                        class=" relative z-50 w-full bg-white/10 border border-white/40 backdrop-blur rounded-lg shadow dark:border md:mt-0 sm:max-w-lg xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="fixed top-0 end-0 w-1/2 bg-teal-500 h-screen -z-10"></div>
    </main>

    @livewireScripts
</body>

</html>
