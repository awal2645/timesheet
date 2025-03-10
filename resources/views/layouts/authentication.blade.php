<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ langDirection() }}">

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


    <link href="{{ asset('css/theme.css') }}?v={{ filemtime(public_path('css/theme.css')) }}" rel="stylesheet">
</head>

<body>
    <div class="min-h-screen w-full flex">
        <!-- Left Section -->
        <div class="w-full md:w-1/2 p-8 flex flex-col">
            <div class="mb-16">
                <img src="{{ asset('images/logo-inv.png') }}" alt="Logo" class="w-48 h-auto hidden dark:block ">
                <img src="{{ asset('images/dark_logo.png') }}" alt="Logo" class="dark:hidden w-48 h-auto ">

            </div>

            <div class="flex-grow flex flex-col justify-center max-w-md mx-auto w-full">
                <h1 class="text-2xl font-semibold mb-8">Hi There!</h1>
                <form action="{{ route('login') }}" method="POST">

                    <div class="space-y-4">
                        @csrf
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 h-5 w-5"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <input type="text" placeholder="Username" name="username"
                                class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        </div>

                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 h-5 w-5"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            <input type="password" placeholder="Password" name="password"
                                class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="flex items-center">
                                <input type="checkbox"
                                    class="rounded border-gray-300 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                                <span class="ml-2 text-sm text-gray-600">Remember device</span>
                            </label>
                            <a href="#" class="text-sm text-blue-500 hover:text-blue-600">Forgot password?</a>
                        </div>

                        <button
                            class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition-colors">
                            Login
                        </button>

                        <p class="text-center text-sm text-gray-600">
                            Need an account? <a href="#" class="text-blue-500 hover:text-blue-600">SignUp</a>
                        </p>
                    </div>
                </form>
            </div>

            <div class="mt-auto flex justify-between text-sm text-gray-500">
                <a href="#" class="hover:text-gray-700">Terms of service</a>
                <a href="#" class="hover:text-gray-700">Privacy Policy</a>
                <span>© 2025 zenx services</span>
            </div>
        </div>

        <!-- Right Section - Background Image -->
        <div class="hidden md:block w-1/2 relative">
            <div class="absolute inset-0 bg-cover bg-center"
                style="background-image: url('https://images.unsplash.com/photo-1522083165195-3424ed129620?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2340&q=80')">
                <div class="absolute bottom-8 right-8 text-white">
                    <div class="text-6xl font-light">
                        <script>
                            document.write(new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true })); 
                        </script>
                    </div>
                    <div class="text-xl">New York </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>