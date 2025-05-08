<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ langDirection() }}">

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
 
    {{-- alpinejs --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script> --}}
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
            left: 50%;
            transform: translateX(-50%);
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

<body class="h-screen overflow-hidden" x-data="{ mobileMenu: false }">
    <!-- Page wrapper -->
    <x-app.header />
    <main class="flex h-[calc(100vh-128px)]">
        <x-app.sidebar />
        <div class="flex-1 bg-[#f1f2f6] dark:bg-[#202327] h-[calc(100vh-128px)] overflow-y-auto no-scrollbar animate-fade-up">
            {{ $slot }}
        </div>
    </main>
    <x-app.footer />

    @livewireScripts

    <!-- SweetAlert JavaScript -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>


    <link rel="stylesheet" type="text/css" href="{{ asset('css/toastr/toastr.min.css') }}">

    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <link href="{{ asset('css/select2/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>

    <script>
        @if (Session::has('success'))
            toastr.options = {
                "progressBar": true,
                "positionClass": "toast-top-center",

            }
            toastr.success("{{ session('success') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "progressBar": true,
                "positionClass": "toast-top-center"
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.options = {
                "progressBar": true,
                "positionClass": "toast-top-center"
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options = {
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
            <p class="text-sm">We use cookies to enhance your browsing experience and analyze our traffic. By clicking
                "Accept", you consent to our use of cookies.</p>
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
        {{-- Initialize Select2 after jQuery is loaded --}}
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                // Wait for jQuery to be loaded
                if (typeof jQuery !== 'undefined') {
                    $('.select2').select2({
                        width: '100%',
                        dropdownParent: $('body'),
                    });
                }
            });
        </script>

    <style>
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-up {
            animation: fadeUp 0.5s ease-out forwards;
        }
    </style>
</body>

</html>
