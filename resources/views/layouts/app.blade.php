<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ langDirection() }}" >

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title'){{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo_symbol.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@400;500;600&family=Montserrat:wght@400;500;600&family=Roboto:wght@400;500;600&family=Open+Sans:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script> --}}
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

    <!-- Theme CSS -->
    <link href="{{ asset('css/theme.css') }}?v={{ filemtime(public_path('css/theme.css')) }}" rel="stylesheet">

    <!-- Add this CSS near your other style tags -->
    <style>
        .cookie-consent {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            padding: 20px;
            border-radius: 10px;
            max-width: 400px;
            z-index: 999;
            display: none;
        }

        .dark .cookie-consent {
            background-color: #1e293b;
            border: 1px solid #334155;
        }

        .cookie-consent-buttons {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .cookie-btn {
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s;
        }

        .cookie-btn-accept {
            background-color: var(--primary-50);
            color: white;
            border: none;
        }

        .cookie-btn-accept:hover {
            background-color: var(--primary-300);
        }

        .cookie-btn-decline {
            background-color: transparent;
            border: 1px solid #e2e8f0;
            color: inherit;
        }

        .cookie-btn-decline:hover {
            background-color: #f1f5f9;
        }

        .dark .cookie-btn-decline:hover {
            background-color: #334155;
        }
    </style>
</head>

<body class="antialiased bg-body-light dark:bg-body-dark text-slate-600 dark:text-slate-400"
    :class="{ 'sidebar-expanded': sidebarExpanded }" x-data="{ sidebarOpen: false, sidebarExpanded: localStorage.getItem('sidebar-expanded') == 'true' }" x-init="$watch('sidebarExpanded', value => localStorage.setItem('sidebar-expanded', value))" x-cloak>

    <script>
        if (localStorage.getItem('sidebar-expanded') == 'true') {
            document.querySelector('body').classList.add('sidebar-expanded');
        } else {
            document.querySelector('body').classList.remove('sidebar-expanded');
        }
    </script>

    <!-- Page wrapper -->
    <div class="flex h-[100dvh] overflow-hidden">

        <x-app.sidebar />

        <!-- Content area -->
        <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden @if ($attributes['background']) {{ $attributes['background'] }} @endif"
            x-ref="contentarea">

            <x-app.header />

            <main class="grow">
                {{ $slot }}
            </main>
            <x-app.footer />
        </div>

    </div>

    @livewireScripts

    <!-- SweetAlert JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        @if (Session::has('success'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-center"
            }
            toastr.success("{{ session('success') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-center"
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-center"
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-center"
            }
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var searchInput = document.getElementById("searchInput");
            var dropdownItems = document.querySelectorAll("ul.dropdown-menu li");

            // Check if searchInput exists
            if (searchInput) {
                searchInput.addEventListener("keyup", function() {
                    var value = this.value.toLowerCase();
                    dropdownItems.forEach(function(item) {
                        if (item.textContent.toLowerCase().indexOf(value) > -1) {
                            item.style.display = "";
                        } else {
                            item.style.display = "none";
                        }
                    });
                });
            }
        });
    </script>

    <style>
        #searchInput {
            width: 160px;
            /* Adjust the width as needed */
        }
    </style>

    <div class="cookie-consent" id="cookieConsent">
        <div class="cookie-content">
            <h4 class="text-lg font-semibold mb-2">🍪 We use cookies</h4>
            <p class="text-sm">We use cookies to enhance your browsing experience and analyze our traffic. By clicking "Accept", you consent to our use of cookies.</p>
            <div class="cookie-consent-buttons">
                <button class="cookie-btn cookie-btn-accept" onclick="acceptCookies()">Accept</button>
                <button class="cookie-btn cookie-btn-decline" onclick="declineCookies()">Decline</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (!localStorage.getItem('cookieConsent')) {
                document.getElementById('cookieConsent').style.display = 'block';
            }
        });

        function acceptCookies() {
            localStorage.setItem('cookieConsent', 'accepted');
            document.getElementById('cookieConsent').style.display = 'none';
        }

        function declineCookies() {
            localStorage.setItem('cookieConsent', 'declined');
            document.getElementById('cookieConsent').style.display = 'none';
        }
    </script>
</body>

</html>
