<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timesheet - Time Tracking Tool</title>
    @vite(['resources/css/app.css'])
    <link href="{{ asset('css/theme.css') }}?v={{ filemtime(public_path('css/theme.css')) }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    
</head>

<body>
    <header class="py-4 bg-primary-50 inset-x-0 flex flex-wrap md:justify-start md:flex-nowrap z-50 w-full">
        <nav class="relative container px-4 xl:px-0 mx-auto w-full md:flex md:items-center md:justify-between"
            aria-label="Global">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <a class="flex-none rounded-md text-2xl text-white inline-block font-semibold focus:outline-none focus:opacity-80"
                    href="/" aria-label="Timesheet">
                    <img src="{{ asset('images/logo-inv.png') }}" alt="Logo" class="w-48 h-auto">
                </a>
                <!-- End Logo -->

                <div class="md:hidden">
                    <button type="button"
                        class="hs-collapse-toggle size-8 flex justify-center items-center text-sm font-semibold rounded-full bg-transparent text-white disabled:opacity-50 disabled:pointer-events-none"
                        data-hs-collapse="#navbar-collapse" aria-controls="navbar-collapse"
                        aria-label="Toggle navigation">
                        <svg class="hs-collapse-open:hidden flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" x2="21" y1="6" y2="6" />
                            <line x1="3" x2="21" y1="12" y2="12" />
                            <line x1="3" x2="21" y1="18" y2="18" />
                        </svg>
                        <svg class="hs-collapse-open:block hidden flex-shrink-0 size-4"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M18 6 6 18" />
                            <path d="m6 6 12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Collapse -->
            <div id="navbar-collapse"
                class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow md:block">
                <div
                    class="flex flex-col gap-y-4 gap-x-0 mt-5 md:flex-row md:items-center md:justify-end md:gap-y-0 md:gap-x-7 md:mt-0 md:ps-7">

                    <div>
                        <a class="group inline-flex items-center gap-x-2 py-2 bg-gray-900 font-medium text-sm text-white rounded-md focus:outline-none px-5"
                            href="{{ route('login') }}" data-aos="fade-up">
                            Login
                        </a>
                    </div>
                </div>
            </div>
            <!-- End Collapse -->
        </nav>
    </header>
    
    <!-- Hero Section -->
    <section class="bg-primary-50">
        <div class="container px-4 xl:px-0 py-10 lg:py-20 mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-8">
                    <div class="inline-block" data-aos="fade-in">
                        <span
                            class="inline-flex items-center rounded-full bg-black px-4 py-1 text-sm font-medium text-white">
                            70% Special Offer
                        </span>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900" data-aos="fade-up">
                        Timesheet - Time Tracking Tool
                    </h1>
                    <p class="text-lg text-gray-900/90" data-aos="fade-up" data-aos-delay="100">
                        Use these awesome forms to login or create new account in your project for free.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="#" class="px-6 py-3 bg-gray-900 text-white rounded-md hover:bg-gray-900" data-aos="fade-up" data-aos-delay="200">
                            Live Demo <span class="ml-2">▶</span>
                        </a>
                        <a href="#"
                            class="px-6 py-3 bg-transparent text-gray-900 border border-black rounded-md hover:bg-gray-900/10" data-aos="fade-up" data-aos-delay="300">
                            Buy Now <span class="ml-2">↓</span>
                        </a>
                    </div>
                </div>
                <div class="relative" data-aos="fade-up" data-aos-delay="400">
                    <div class="rounded-lg overflow-hidden shadow-xl">
                        <img src="https://placehold.co/800x600" alt="Timesheet Dashboard" class="w-full h-auto">
                    </div>
                </div>
            </div>
        </div>

        <!-- Trust Badge -->
        <div class="bg-primary-50 py-8 border-t border-black/10 shadow-xl">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <p class="text-center text-gray-900 mb-6">Trusted by 1000+ Customer</p>
                <div class="flex justify-between items-center gap-8 overflow-hidden">
                    <div class="flex-shrink-0" data-aos="fade-up" data-aos-delay="200">
                        <img src="https://placehold.co/120x50" alt="Timesheet Logo 1"
                            class="h-8 w-auto object-contain brightness-0 invert opacity-75">
                    </div>
                    <div class="flex-shrink-0" data-aos="fade-up" data-aos-delay="300">
                        <img src="https://placehold.co/120x50" alt="Timesheet Logo 2"
                            class="h-8 w-auto object-contain brightness-0 invert opacity-75">
                    </div>
                    <div class="flex-shrink-0" data-aos="fade-up" data-aos-delay="400">
                        <img src="https://placehold.co/120x50" alt="Timesheet Logo 3"
                            class="h-8 w-auto object-contain brightness-0 invert opacity-75">
                    </div>
                    <div class="flex-shrink-0" data-aos="fade-up" data-aos-delay="500">
                        <img src="https://placehold.co/120x50" alt="Timesheet Logo 4"
                            class="h-8 w-auto object-contain brightness-0 invert opacity-75">
                    </div>
                    <div class="flex-shrink-0" data-aos="fade-up" data-aos-delay="600">
                        <img src="https://placehold.co/120x50" alt="Timesheet Logo 5"
                            class="h-8 w-auto object-contain brightness-0 invert opacity-75">
                    </div>
                    <div class="flex-shrink-0" data-aos="fade-up" data-aos-delay="700">
                        <img src="https://placehold.co/120x50" alt="Timesheet Logo 6"
                            class="h-8 w-auto object-contain brightness-0 invert opacity-75">
                    </div>
                    <div class="flex-shrink-0" data-aos="fade-up" data-aos-delay="800">
                        <img src="https://placehold.co/120x50" alt="Timesheet Logo 7"
                            class="h-8 w-auto object-contain brightness-0 invert opacity-75">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-white text-white py-20">
        <div class="container px-4 xl:px-0 py-10 lg:py-20 mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-16">
                <div class="space-y-6">
                    <p class="text-sm font-semibold text-primary-50">FEATURES</p>
                    <h2 class="text-3xl md:text-4xl text-gray-900 font-bold" data-aos="fade-up">
                        All In One Place CRM System
                    </h2>
                    <p class="text-gray-700" data-aos="fade-up" data-aos-delay="100">
                        Use these awesome forms to login or create new account in your project for free.
                    </p>
                    <a href="#"
                        class="inline-flex items-center px-6 py-3 bg-primary-50 text-white rounded-md hover:bg-green-600" data-aos="fade-up" data-aos-delay="200">
                        Buy Now <span class="ml-2">↓</span>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature Card -->
                <div class="bg-primary-50 rounded-lg p-8" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-4xl mb-4">⚡</div>
                    <h3 class="text-xl font-semibold mb-4">Feature</h3>
                    <p class="text-white/90">
                        Use these awesome forms to login or create new account in your project for free.
                    </p>
                </div>

                <!-- Support Card -->
                <div class="bg-card-dark hover:bg-primary-50 transition-color duration-300 rounded-lg p-8" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-4xl mb-4">⭕</div>
                    <h3 class="text-xl font-semibold mb-4">Support</h3>
                    <p class="text-white/90">
                        Use these awesome forms to login or create new account in your project for free.
                    </p>
                </div>

                <!-- Integration Card -->
                <div class="bg-card-dark hover:bg-primary-50 transition-color duration-300 rounded-lg p-8" data-aos="fade-up" data-aos-delay="400">
                    <div class="text-4xl mb-4">⚡</div>
                    <h3 class="text-xl font-semibold mb-4">Integration</h3>
                    <p class="text-white/90">
                        Use these awesome forms to login or create new account in your project for free.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Time Tracking Tool Section -->
    <section class="bg-primary-50 text-white pb-20">
        <div class="container px-4 xl:px-0 py-10 lg:py-20 mx-auto">
            <div class="text-center space-y-4 mb-12">
                <p class="text-sm font-semibold text-primary-500">FEATURES</p>
                <h2 class="text-3xl md:text-4xl font-bold">Timesheet - Time Tracking Tool</h2>
                <p class="text-gray-800 max-w-2xl mx-auto">
                    Use these awesome forms to login or create new account in your project for free.
                </p>
            </div>

            <div class="rounded-lg overflow-hidden shadow-2xl" data-aos="fade-up" data-aos-delay="100">
                <img src="https://placehold.co/1200x600" alt="Time Tracking Dashboard" class="w-full h-auto">
            </div>
        </div>
    </section>

    <!-- Product Screenshots Section -->
    <section class="bg-white py-20">
        <div class="container px-4 xl:px-0 py-10 lg:py-20 mx-auto">
            <!-- First Screenshot -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-20">
                <div class="space-y-6">
                    <p class="text-sm font-semibold text-Timesheet-green">FEATURES</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Timesheet - Time Tracking Tool</h2>
                    <p class="text-gray-600" data-aos="fade-up" data-aos-delay="100">
                        Use these awesome forms to login or create new account in your project for free.
                    </p>
                    <a href="#"
                        class="inline-flex items-center px-6 py-3 bg-Timesheet-green text-white rounded-md hover:bg-green-600" data-aos="fade-up" data-aos-delay="200">
                        Buy Now <span class="ml-2">↓</span>
                    </a>
                </div>
                <div class="rounded-xl overflow-hidden shadow-2xl border border-gray-200" data-aos="fade-up" data-aos-delay="300">
                    <img src="https://placehold.co/800x500" alt="Timesheet View" class="w-full h-auto">
                </div>
            </div>

            <!-- Second Screenshot -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="rounded-xl overflow-hidden shadow-2xl border border-gray-200 order-2 lg:order-1" data-aos="fade-up" data-aos-delay="200">
                    <img src="https://placehold.co/800x500" alt="Project Templates View" class="w-full h-auto">
                </div>
                <div class="space-y-6 order-1 lg:order-2" data-aos="fade-up" data-aos-delay="100">
                    <p class="text-sm font-semibold text-Timesheet-green">FEATURES</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Timesheet - Time Tracking Tool</h2>
                    <p class="text-gray-600">
                        Use these awesome forms to login or create new account in your project for free.
                    </p>
                    <a href="#"
                        class="inline-flex items-center px-6 py-3 bg-Timesheet-green text-white rounded-md hover:bg-green-600" data-aos="fade-up" data-aos-delay="200">
                        Buy Now <span class="ml-2">↓</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing -->
    <section class="bg-gray-50">
        <div class="container px-4 xl:px-0 py-10 lg:py-20 mx-auto">
            <h2 class="text-4xl text-primary-50 mb-16 text-center" data-aos="fade-up">
                {{ __('Our Pricing') }}
            </h2>
            <div class="px-8 py-6 border border-white/30 rounded-xl bg-primary-50 shadow-xl backdrop-blur" data-aos="fade-up" data-aos-delay="100">
                <div class="space-y-2 mb-8">
                    <h1 class="text-2xl md:text-3xl font-semibold text-white" data-aos="fade-up">
                        {{ __('The biggest ever Black Friday sale!') }}
                    </h1>
                    <p class="text-white/90" data-aos="fade-up" data-aos-delay="100">
                        {{ __('You\'ll love these great deals that were handpicked just for you.') }}
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-6">
                    <!-- Pricing Plan -->
                    <div class="bg-gray-900 rounded-lg p-6" data-aos="fade-up" data-aos-delay="200">
                        <h2 class="text-xl font-semibold text-white">Get a new hosting plan</h2>
                        <p class="text-white/90 mb-12">
                            Everything you need to create a website
                        </p>
                        <div class="relative inline-block">
                            <div class="text-white/90 line-through text-sm">$9.99</div>
                            <div class="absolute start-full -top-2 rotate-60">
                                <span
                                    class="inline-block whitespace-nowrap bg-rose-500 text-white text-sm px-3 py-1 rounded-full">
                                    80% OFF
                                </span>
                            </div>
                        </div>
                        <div>
                            <div class="text-sm text-white/90 mt-6 mb-2">From</div>
                            <div class="flex items-baseline gap-1">
                                <span class="text-3xl text-white font-bold">$1.99</span>
                                <span class="text-white/90">/mo</span>
                            </div>
                            <div class="text-sm text-white/90 my-8">
                                when getting a 4-year subscription
                            </div>
                        </div>
                        <button
                            class="w-full py-2 px-4 bg-primary-50 bg-opacity-10 rounded-md hover:bg-opacity-20 transition-colors" data-aos="fade-up" data-aos-delay="300">
                            Get deal
                        </button>
                    </div>
                    <!-- Pricing Plan -->
                    <div class="bg-gray-900 rounded-lg p-6" data-aos="fade-up" data-aos-delay="200">
                        <h2 class="text-xl font-semibold text-white">Get a new hosting plan</h2>
                        <p class="text-white/90 mb-12">
                            Everything you need to create a website
                        </p>
                        <div class="relative inline-block">
                            <div class="text-white/90 line-through text-sm">$9.99</div>
                            <div class="absolute start-full -top-2 rotate-60">
                                <span
                                    class="inline-block whitespace-nowrap bg-rose-500 text-white text-sm px-3 py-1 rounded-full">
                                    80% OFF
                                </span>
                            </div>
                        </div>
                        <div>
                            <div class="text-sm text-white/90 mt-6 mb-2">From</div>
                            <div class="flex items-baseline gap-1">
                                <span class="text-3xl text-white font-bold">$1.99</span>
                                <span class="text-white/90">/mo</span>
                            </div>
                            <div class="text-sm text-white/90 my-8">
                                when getting a 4-year subscription
                            </div>
                        </div>
                        <button
                            class="w-full py-2 px-4 bg-primary-50 bg-opacity-10 rounded-md hover:bg-opacity-20 transition-colors" data-aos="fade-up" data-aos-delay="300">
                            Get deal
                        </button>
                    </div>
                    <!-- Pricing Plan -->
                    <div class="bg-gray-900 rounded-lg p-6" data-aos="fade-up" data-aos-delay="200">
                        <h2 class="text-xl font-semibold text-white">Get a new hosting plan</h2>
                        <p class="text-white/90 mb-12">
                            Everything you need to create a website
                        </p>
                        <div class="relative inline-block">
                            <div class="text-white/90 line-through text-sm">$9.99</div>
                            <div class="absolute start-full -top-2 rotate-60">
                                <span
                                    class="inline-block whitespace-nowrap bg-rose-500 text-white text-sm px-3 py-1 rounded-full">
                                    80% OFF
                                </span>
                            </div>
                        </div>
                        <div>
                            <div class="text-sm text-white/90 mt-6 mb-2">From</div>
                            <div class="flex items-baseline gap-1">
                                <span class="text-3xl text-white font-bold">$1.99</span>
                                <span class="text-white/90">/mo</span>
                            </div>
                            <div class="text-sm text-white/90 my-8">
                                when getting a 4-year subscription
                            </div>
                        </div>
                        <button
                            class="w-full py-2 px-4 bg-primary-50 bg-opacity-10 rounded-md hover:bg-opacity-20 transition-colors" data-aos="fade-up" data-aos-delay="300">
                            Get deal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Testimonial -->
    <section class="bg-white py-20">
        <div class="container px-4 xl:px-0 py-10 lg:py-20 mx-auto">
            <div class="space-y-4 max-w-3xl mb-12">
                <p class="text-sm font-semibold text-gray-900">TESTIMONIALS</p>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">From our Clients</h2>
                <p class="text-gray-900">
                    Use these awesome forms to login or create new account in your project for free.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <!-- Testimonial Card 1 -->
                <div class="bg-primary-50 rounded-lg p-8 space-y-4 shadow-xl" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex justify-between items-start">
                        <div class="w-8 h-8 bg-gray-900 flex items-center justify-center rounded">
                            <span class="text-white">"</span>
                        </div>
                        <div class="flex">
                            ★★★★★
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-white">Tbistone</h3>
                    <p class="text-gray-800 italic" data-aos="fade-up" data-aos-delay="200">
                        Very quick customer support, installing this application on my machine locally, within 5 minutes
                        of creating a ticket, the developer was able to fix the issue I had within 10 minutes.
                        EXCELLENT! Thank you very much
                    </p>
                    <div class="flex items-center gap-3 pt-4">
                        <img src="https://placehold.co/40x40" alt="" class="w-10 h-10 rounded-full">
                        <div class="text-sm">
                            <p class="text-white font-medium">Chordsnstrings</p>
                            <p class="text-gray-800">from codecanyon</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial Card 2 -->
                <div class="bg-primary-50 rounded-lg p-8 space-y-4 shadow-xl" data-aos="fade-up" data-aos-delay="300">
                    <div class="flex justify-between items-start">
                        <div class="w-8 h-8 bg-white/10 flex items-center justify-center rounded">
                            <span class="text-white">"</span>
                        </div>
                        <div class="flex">
                            ★★★★★
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-white">Tbistone</h3>
                    <p class="text-gray-800 italic">
                        Very quick customer support, installing this application on my machine locally, within 5 minutes
                        of creating a ticket, the developer was able to fix the issue I had within 10 minutes.
                        EXCELLENT! Thank you very much
                    </p>
                    <div class="flex items-center gap-3 pt-4">
                        <img src="https://placehold.co/40x40" alt="" class="w-10 h-10 rounded-full">
                        <div class="text-sm">
                            <p class="text-white font-medium">Chordsnstrings</p>
                            <p class="text-gray-800">from codecanyon</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial Card 3 -->
                <div class="bg-primary-50 rounded-lg p-8 space-y-4 shadow-xl" data-aos="fade-up" data-aos-delay="500">
                    <div class="flex justify-between items-start">
                        <div class="w-8 h-8 bg-white/10 flex items-center justify-center rounded">
                            <span class="text-white">"</span>
                        </div>
                        <div class="flex">
                            ★★★★★
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-white">Tbistone</h3>
                    <p class="text-gray-800 italic">
                        Very quick customer support, installing this application on my machine locally, within 5 minutes
                        of creating a ticket, the developer was able to fix the issue I had within 10 minutes.
                        EXCELLENT! Thank you very much
                    </p>
                    <div class="flex items-center gap-3 pt-4">
                        <img src="https://placehold.co/40x40" alt="" class="w-10 h-10 rounded-full">
                        <div class="text-sm">
                            <p class="text-white font-medium">Chordsnstrings</p>
                            <p class="text-gray-800">from codecanyon</p>
                        </div>
                    </div>
                </div>
            </div>

            <p class="text-gray-600 max-w-6xl mx-auto text-center" data-aos="fade-up" data-aos-delay="600">
                WorkDo seCommerce package offers you a "sales-ready," secure online store. The package puts all the key
                pieces together, from design to payment processing. This gives you a headstart in your eCommerce
                venture. Every store is built using a reliable PHP framework -laravel. This speeds up the development
                process while increasing the store's security and performance. Additionally, thanks to the accompanying
                mobile app, you and your team can manage the store on the go. What's more, because the app works both
                for you and your customers, you can use it to reach a wider audience. And, unlike popular eCommerce
                platforms, it doesn't bind you to any terms and conditions or recurring fees. You get to choose where
                you host it or which payment gateway you use. Lastly, you get complete control over the looks of the
                store. And if it lacks any functionalities that you need, just reach out, and let's discuss
                customization possibilities
            </p>
        </div>
    </section>

    <!-- Contact -->
    <section class="bg-primary-50">
        <div class="container px-4 xl:px-0 py-10 lg:py-20 mx-auto">
            <!-- Title -->
            <div class="max-w-3xl mb-10 lg:mb-14">
                <h2 class="text-white font-semibold text-2xl md:text-4xl md:leading-tight" data-aos="fade-up">
                    {{ __('Contact us') }}
                </h2>
                <p class="mt-1 text-gray-800" data-aos="fade-up" data-aos-delay="100">
                    {{ __('Whatever your goal - we will get you there.') }}
                </p>
            </div>
            <!-- End Title -->

            <!-- Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 lg:gap-x-16">
                <div class="md:order-2 bg-primary-500 p-8 rounded-lg border border-white/30 mb-10" data-aos="fade-up" data-aos-delay="200">
                    <form>
                        <div class="space-y-4">
                            <!-- Input -->
                            <div class="relative">
                                <input type="text" id="hs-tac-input-name"
                                    class="peer p-4 block w-full bg-black/10 border-transparent rounded-lg text-sm text-white placeholder:text-transparent focus:outline-none focus:ring-0 focus:border-transparent disabled:opacity-50 disabled:pointer-events-none
              focus:pt-6
              focus:pb-2
              [&:not(:placeholder-shown)]:pt-6
              [&:not(:placeholder-shown)]:pb-2
              autofill:pt-6
              autofill:pb-2"
                                    placeholder="Name">
                                <label for="hs-tac-input-name"
                                    class="absolute top-0 start-0 p-4 h-full text-gray-800 text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent peer-disabled:opacity-50 peer-disabled:pointer-events-none
                peer-focus:text-xs
                peer-focus:-translate-y-1.5
                peer-focus:text-gray-800
                peer-[:not(:placeholder-shown)]:text-xs
                peer-[:not(:placeholder-shown)]:-translate-y-1.5
                peer-[:not(:placeholder-shown)]:text-gray-800">
                                    {{ __('Name') }}
                                </label>
                            </div>
                            <!-- End Input -->

                            <!-- Input -->
                            <div class="relative">
                                <input type="email" id="hs-tac-input-email"
                                    class="peer p-4 block w-full bg-black/10 border-transparent rounded-lg text-sm text-white placeholder:text-transparent focus:outline-none focus:ring-0 focus:border-transparent disabled:opacity-50 disabled:pointer-events-none
              focus:pt-6
              focus:pb-2
              [&:not(:placeholder-shown)]:pt-6
              [&:not(:placeholder-shown)]:pb-2
              autofill:pt-6
              autofill:pb-2"
                                    placeholder="Email">
                                <label for="hs-tac-input-email"
                                    class="absolute top-0 start-0 p-4 h-full text-gray-800 text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent peer-disabled:opacity-50 peer-disabled:pointer-events-none
                peer-focus:text-xs
                peer-focus:-translate-y-1.5
                peer-focus:text-gray-800
                peer-[:not(:placeholder-shown)]:text-xs
                peer-[:not(:placeholder-shown)]:-translate-y-1.5
                peer-[:not(:placeholder-shown)]:text-gray-800">
                                    {{ __('Email') }}
                                </label>
                            </div>
                            <!-- End Input -->

                            <!-- Input -->
                            <div class="relative">
                                <input type="text" id="hs-tac-input-company"
                                    class="peer p-4 block w-full bg-black/10 border-transparent rounded-lg text-sm text-white placeholder:text-transparent focus:outline-none focus:ring-0 focus:border-transparent disabled:opacity-50 disabled:pointer-events-none
              focus:pt-6
              focus:pb-2
              [&:not(:placeholder-shown)]:pt-6
              [&:not(:placeholder-shown)]:pb-2
              autofill:pt-6
              autofill:pb-2"
                                    placeholder="Company">
                                <label for="hs-tac-input-company"
                                    class="absolute top-0 start-0 p-4 h-full text-gray-800 text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent peer-disabled:opacity-50 peer-disabled:pointer-events-none
                peer-focus:text-xs
                peer-focus:-translate-y-1.5
                peer-focus:text-gray-800
                peer-[:not(:placeholder-shown)]:text-xs
                peer-[:not(:placeholder-shown)]:-translate-y-1.5
                peer-[:not(:placeholder-shown)]:text-gray-800">
                                    {{ __('Company') }}
                                </label>
                            </div>
                            <!-- End Input -->

                            <!-- Input -->
                            <div class="relative">
                                <input type="text" id="hs-tac-input-phone"
                                    class="peer p-4 block w-full bg-black/10 border-transparent rounded-lg text-sm text-white placeholder:text-transparent focus:outline-none focus:ring-0 focus:border-transparent disabled:opacity-50 disabled:pointer-events-none
              focus:pt-6
              focus:pb-2
              [&:not(:placeholder-shown)]:pt-6
              [&:not(:placeholder-shown)]:pb-2
              autofill:pt-6
              autofill:pb-2"
                                    placeholder="Phone">
                                <label for="hs-tac-input-phone"
                                    class="absolute top-0 start-0 p-4 h-full text-gray-800 text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent peer-disabled:opacity-50 peer-disabled:pointer-events-none
                peer-focus:text-xs
                peer-focus:-translate-y-1.5
                peer-focus:text-gray-800
                peer-[:not(:placeholder-shown)]:text-xs
                peer-[:not(:placeholder-shown)]:-translate-y-1.5
                peer-[:not(:placeholder-shown)]:text-gray-800">
                                    {{ __('Phone') }}
                                </label>
                            </div>
                            <!-- End Input -->

                            <!-- Textarea -->
                            <div class="relative">
                                <textarea id="hs-tac-message"
                                    class="peer p-4 block w-full bg-black/10 border-transparent rounded-lg text-sm text-white placeholder:text-transparent focus:outline-none focus:ring-0 focus:border-transparent disabled:opacity-50 disabled:pointer-events-none
              focus:pt-6
              focus:pb-2
              [&:not(:placeholder-shown)]:pt-6
              [&:not(:placeholder-shown)]:pb-2
              autofill:pt-6
              autofill:pb-2"
                                    placeholder="This is a textarea placeholder"></textarea>
                                <label for="hs-tac-message"
                                    class="absolute top-0 start-0 p-4 h-full text-gray-800 text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent peer-disabled:opacity-50 peer-disabled:pointer-events-none
                peer-focus:text-xs
                peer-focus:-translate-y-1.5
                peer-focus:text-gray-800
                peer-[:not(:placeholder-shown)]:text-xs
                peer-[:not(:placeholder-shown)]:-translate-y-1.5
                peer-[:not(:placeholder-shown)]:text-gray-800">
                                    {{ __('Tell us about your project') }}
                                </label>
                            </div>
                            <!-- End Textarea -->
                        </div>

                        <div class="mt-2">
                            <p class="text-xs text-neutral-500">
                                {{ __('All fields are required') }}
                            </p>

                            <p class="mt-5">
                                <a class="group inline-flex items-center gap-x-2 py-2 px-3 bg-gray-900 font-medium text-sm text-white rounded-full focus:outline-none"
                                    href="#">
                                    {{ __('Submit') }}
                                    <svg class="flex-shrink-0 size-4 transition group-hover:translate-x-0.5 group-hover:translate-x-0 group-focus:translate-x-0.5 group-focus:translate-x-0"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14" />
                                        <path d="m12 5 7 7-7 7" />
                                    </svg>
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
                <!-- End Col -->

                <div class="space-y-14" data-aos="fade-up" data-aos-delay="300">
                    <!-- Item -->
                    <div class="flex gap-x-5">
                        <svg class="flex-shrink-0 size-6 text-neutral-500" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                        <div class="grow">
                            <h4 class="text-white font-semibold" data-aos="fade-up">
                                {{ __('Our address:') }}
                            </h4>

                            <address class="mt-1 text-gray-800 text-sm not-italic" data-aos="fade-up" data-aos-delay="100">
                                {{ __('300 Bath Street, Tay House') }}<br>
                                {{ __('Glasgow G2 4JR, United Kingdom') }}
                            </address>
                        </div>
                    </div>
                    <!-- End Item -->

                    <!-- Item -->
                    <div class="flex gap-x-5">
                        <svg class="flex-shrink-0 size-6 text-neutral-500" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M21.2 8.4c.5.38.8.97.8 1.6v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V10a2 2 0 0 1 .8-1.6l8-6a2 2 0 0 1 2.4 0l8 6Z" />
                            <path d="m22 10-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 10" />
                        </svg>
                        <div class="grow">
                            <h4 class="text-white font-semibold" data-aos="fade-up">
                                {{ __('Email us:') }}
                            </h4>

                            <a class="mt-1 text-gray-800 text-sm" href="#mailto:example@site.co" target="_blank">
                                hello@example.so
                            </a>
                        </div>
                    </div>
                    <!-- End Item -->

                    <!-- Item -->
                    <div class="flex gap-x-5">
                        <svg class="flex-shrink-0 size-6 text-neutral-500" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m3 11 18-5v12L3 14v-3z" />
                            <path d="M11.6 16.8a3 3 0 1 1-5.8-1.6" />
                        </svg>
                        <div class="grow">
                            <h4 class="text-white font-semibold" data-aos="fade-up">
                                {{ __('We\'re hiring') }}
                            </h4>
                            <p class="mt-1 text-gray-800" data-aos="fade-up" data-aos-delay="100">
                                {{ __('We\'re thrilled to announce that we\'re expanding our team and looking for talented individuals like you to join us.') }}
                            </p>
                            <p class="mt-2">
                                <a class="group inline-flex items-center gap-x-2 font-medium text-sm text-primary-500 decoration-2 hover:underline focus:outline-none focus:underline"
                                    href="#">
                                    {{ __('Job openings') }}
                                    <svg class="flex-shrink-0 size-4 transition group-hover:translate-x-0.5 group-hover:translate-x-0 group-focus:translate-x-0.5 group-focus:translate-x-0"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14" />
                                        <path d="m12 5 7 7-7 7" />
                                    </svg>
                                </a>
                            </p>
                        </div>
                    </div>
                    <!-- End Item -->
                </div>
                <!-- End Col -->
            </div>
            <!-- End Grid -->
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-primary-50 border-t">
        <div class="container px-4 xl:px-0 py-10 lg:py-20 mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Logo and Description -->
                <div class="space-y-4" data-aos="fade-up">
                    <img src="{{ asset('images/logo-inv.png') }}" alt="Logo" class="w-48 h-auto">
                    <p class="text-gray-600">
                        We build modern web tools to help you jump-start your daily business work.
                    </p>
                </div>

                <!-- Links -->
                <div data-aos="fade-up">
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-600 hover:text-gray-900">About Us</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-gray-900">Terms and Conditions</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-gray-900">Privacy Policy</a></li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div class="space-y-4" data-aos="fade-up">
                    <h3 class="text-xl font-bold">Join Our Community</h3>
                    <p class="text-gray-600">
                        We build modern web tools to help you jump-start your daily business work.
                    </p>
                    <form class="flex gap-2">
                        <input type="email" placeholder="Type your email address..."
                            class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-Timesheet-green">
                        <button type="submit" class="px-6 py-2 bg-gray-900 text-white rounded-md hover:bg-gray-800">
                            Join Us!
                        </button>
                    </form>
                </div>
            </div>

            <div class="border-t mt-12 pt-8 text-center text-gray-600">
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
</body>

</html>
