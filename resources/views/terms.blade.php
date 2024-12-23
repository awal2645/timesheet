<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Timesheet') }} - {{ __('Time Tracking Tool') }}</title>
    @vite(['resources/css/app.css'])
    <link href="{{ asset('css/theme.css') }}?v={{ filemtime(public_path('css/theme.css')) }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo_symbol.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <header
        class="py-4 bg-card-dark dark:bg-card-dark inset-x-0 flex flex-wrap md:justify-start md:flex-nowrap z-50 w-full">
        <nav class="relative container px-4 xl:px-0 mx-auto w-full md:flex md:items-center md:justify-between"
            aria-label="Global">
            <div class="w-full flex items-center justify-between">
                <!-- Logo -->
                <a class="flex-none rounded-md text-2xl text-white inline-block font-semibold focus:outline-none focus:opacity-80"
                    href="/" aria-label="Timesheet">
                    <img src="{{ asset('images/logo-inv.png') }}" alt="Logo" class="w-48 h-auto">
                </a>
                <!-- End Logo -->
                <div>
                    <nav class="hidden lg:flex items-center gap-4">
                        <a href="{{ route('terms') }}"
                            class="inline-flex font-semibold text-base text-text-dark hover:text-text-light/80 dark:hover:text-text-dark/80">Terms
                            and
                            Conditions</a>
                        <a href="{{ route('privacy') }}"
                            class="inline-flex font-semibold text-base text-text-dark hover:text-text-light/80 dark:hover:text-text-dark/80">Privacy
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
                </div>
            </div>
        </nav>
    </header>
    <section class="py-8 px-4 bg-gray-100 text-gray-800">
        <div class="container mx-auto">
            <h2 class="text-2xl font-bold mb-4">{{ __('Terms and Conditions') }}</h2>
            <p>{{ __('Please read these terms and conditions carefully before using our service.') }}</p>
            <p>{{ __('Your access to and use of the service is conditioned on your acceptance of and compliance with these terms.') }}</p>
            
            <h3 class="text-xl font-semibold mt-6">{{ __('Payment Methods') }}</h3>
            <p>{{ __('We accept various payment methods including credit cards, debit cards, and PayPal. All transactions are processed securely using industry-standard encryption to protect your information.') }}</p>
            
            <h3 class="text-xl font-semibold mt-6">{{ __('Refund Policy') }}</h3>
            <p>{{ __('If you are not satisfied with your purchase, you may request a refund within 30 days of the transaction. To initiate a refund, please contact our support team with your order details. Refunds will be processed within 7-10 business days.') }}</p>
            
            <h3 class="text-xl font-semibold mt-6">{{ __('User Responsibilities') }}</h3>
            <p>{{ __('Users are responsible for maintaining the confidentiality of their account information and for all activities that occur under their account. Please notify us immediately of any unauthorized use of your account. You agree to provide accurate and complete information during the registration process and to update such information to keep it accurate and complete.') }}</p>
            
            <h3 class="text-xl font-semibold mt-6">{{ __('Service Usage') }}</h3>
            <p>{{ __('You agree to use our services only for lawful purposes and in accordance with these terms. You must not use our services in any way that violates any applicable federal, state, local, or international law or regulation. You are prohibited from using our services in any manner that could disable, overburden, or impair the site or interfere with any other party’s use of the services.') }}</p>
            
            <h3 class="text-xl font-semibold mt-6">{{ __('Limitations of Liability') }}</h3>
            <p>{{ __('In no event shall we, our affiliates, or our licensors be liable for any indirect, incidental, special, consequential, or punitive damages, including without limitation loss of profits, data, use, goodwill, or other intangible losses, resulting from your use of or inability to use our services.') }}</p>
            
            <h3 class="text-xl font-semibold mt-6">{{ __('Dispute Resolution') }}</h3>
            <p>{{ __('Any disputes arising out of or related to these terms and conditions shall be resolved through binding arbitration in accordance with the rules of the American Arbitration Association. The arbitration shall take place in the state where our company is located, and the decision of the arbitrator shall be final and binding.') }}</p>
            
            <h3 class="text-xl font-semibold mt-6">{{ __('Changes to Terms') }}</h3>
            <p>{{ __('We reserve the right to modify these terms at any time. We will notify you of any changes by posting the new terms on this page. You are advised to review these terms periodically for any changes. Changes to these terms are effective when they are posted on this page.') }}</p>
            
            <!-- Add more content as needed -->
        </div>
    </section>
   
    <!-- Footer -->
    <footer class="bg-card-dark  border-t">
        <div class="container px-4 xl:px-0 py-10 lg:py-20 mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Logo and Description -->
                <div class="space-y-4" data-aos="fade-up">
                    <img src="{{ asset('images/logo-inv.png') }}" alt="Logo" class="w-48 h-auto">
                    <p class="text-text-light text-white">
                        {{ __('We build modern web tools to help you jump-start your daily business work.') }}
                    </p>
                    <div class="flex space-x-4">
                        <a href="{{ getSocialLinks()->facebook_url }}" target="_blank" class="text-white hover:text-primary-500">
                            <i class="fa-brands fa-facebook" style="font-size: 30px;"></i>
                        </a>
                        <a href="{{ getSocialLinks()->twitter_url }}" target="_blank" class="text-white hover:text-primary-500">
                            <i class="fa-brands fa-twitter" style="font-size: 30px;"></i>
                        </a>
                        <a href="{{ getSocialLinks()->linkedin_url }}" target="_blank" class="text-white hover:text-primary-500">
                            <i class="fa-brands fa-linkedin" style="font-size: 30px;"></i>
                        </a>
                        <a href="{{ getSocialLinks()->instagram_url }}" target="_blank" class="text-white hover:text-primary-500">
                            <i class="fa-brands fa-instagram" style="font-size: 30px;"></i>
                        </a>
                        <a href="{{ getSocialLinks()->youtube_url }}" target="_blank" class="text-white hover:text-primary-500">
                            <i class="fa-brands fa-youtube" style="font-size: 30px;"></i>
                        </a>
                    </div>
                </div>
                <!-- Links -->
                <div data-aos="fade-up">
                    <ul class="space-y-3">
                        <li><a href="{{ route('terms') }}"
                                class="text-white hover:text-primary-500">{{ __('Terms and Conditions') }}</a></li>
                        <li><a href="{{ route('privacy') }}"
                                class="text-white hover:text-primary-500">{{ __('Privacy Policy') }}</a></li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div class="space-y-4" data-aos="fade-up">
                    <h3 class="text-xl font-bold text-white">
                        {{ __('Join Our Community') }}
                    </h3>
                    <p class="text-white">
                        {{ __('We build modern web tools to help you jump-start your daily business work.') }}
                    </p>
                    <form class="flex gap-2" action="{{ route('newsletter.store') }}" method="POST">
                        @csrf
                        <input type="email" name="email" placeholder="Type your email address..."
                            class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <button type="submit"
                            class="px-6 py-2 bg-primary-50 text-white rounded-md hover:bg-gray-800">
                            {{ __('Join Us!') }}
                        </button>
                    </form>
                </div>
            </div>

            <div class="border-t mt-12 pt-8 text-center text-white">
                © 2024 Timesheet
            </div>
        </div>
    </footer>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            once: false,
        });
    </script>

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

</body>

</html>
