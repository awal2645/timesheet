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
                    <a class="group inline-flex items-center gap-x-2 py-2 bg-primary-50 font-medium text-sm text-text-light dark:text-text-dark rounded-md focus:outline-none px-5"
                        href="{{ route('login') }}" data-aos="fade-up">
                        {{ __('Login') }}
                    </a>
                </div>
            </div>
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
                            {{ __('Special Offer') }}
                        </span>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900" data-aos="fade-up">
                        {{ __('Timesheet - Time Tracking Tool') }}
                    </h1>
                    <p class="text-lg text-gray-900/90" data-aos="fade-up" data-aos-delay="100">
                        {{ __('Use these awesome forms to login or create new account in your project for free.') }}
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="#" class="px-6 py-3 bg-gray-900 text-white rounded-md hover:bg-gray-900"
                            data-aos="fade-up" data-aos-delay="200">
                            {{ __('Live Demo') }} <span class="ml-2">▶</span>
                        </a>
                        <a href="#"
                            class="px-6 py-3 bg-transparent text-gray-900 border border-black rounded-md hover:bg-gray-900/10"
                            data-aos="fade-up" data-aos-delay="300">
                            {{ __('Buy Now') }} <span class="ml-2">↓</span>
                        </a>
                    </div>
                </div>
                <div class="relative" data-aos="fade-up" data-aos-delay="400">
                    <div class="rounded-lg overflow-hidden shadow-xl">
                        <img src="{{ asset(cms()->banner_image) }}" alt="Timesheet Dashboard" class="w-full h-auto">
                    </div>
                </div>
            </div>
        </div>

        <!-- Trust Badge -->
        <div class="bg-white py-8 border-t border-black/10 shadow-xl">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <p class="text-center text-gray-900 mb-6">{{ __('Trusted by 1000+ Customer') }}</p>
                <div class="flex justify-between  items-center  p-4 gap-8 overflow-hidden">
                    <div class="flex-shrink-0  shadow-xl" data-aos="fade-up" data-aos-delay="200">
                        <img src="{{ asset(cms()->client_image1) }}" alt="Timesheet Logo 1"
                            class="h-8 w-auto object-contain ">
                    </div>
                    <div class="flex-shrink-0" data-aos="fade-up" data-aos-delay="300">
                        <img src="{{ asset(cms()->client_image2) }}" alt="Timesheet Logo 2"
                            class="h-8 w-auto object-contain ">
                    </div>
                    <div class="flex-shrink-0" data-aos="fade-up" data-aos-delay="400">
                        <img src="{{ asset(cms()->client_image3) }}" alt="Timesheet Logo 3"
                            class="h-8 w-auto object-contain ">
                    </div>
                    <div class="flex-shrink-0" data-aos="fade-up" data-aos-delay="500">
                        <img src="{{ asset(cms()->client_image4) }}" alt="Timesheet Logo 4"
                            class="h-8 w-auto object-contain ">
                    </div>
                    <div class="flex-shrink-0" data-aos="fade-up" data-aos-delay="600">
                        <img src="{{ asset(cms()->client_image5) }}" alt="Timesheet Logo 5"
                            class="h-8 w-auto object-contain ">
                    </div>
                    <div class="flex-shrink-0" data-aos="fade-up" data-aos-delay="700">
                        <img src="{{ asset(cms()->client_image6) }}" alt="Timesheet Logo 6"
                            class="h-8 w-auto object-contain ">
                    </div>
                    <div class="flex-shrink-0" data-aos="fade-up" data-aos-delay="800">
                        <img src="{{ asset(cms()->client_image7) }}" alt="Timesheet Logo 7"
                            class="h-8 w-auto object-contain ">

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
                    <p class="text-sm font-semibold text-primary-50">{{ __('FEATURES') }}</p>
                    <h2 class="text-3xl md:text-4xl text-gray-900 font-bold" data-aos="fade-up">
                        {{ __('All In One Place CRM System') }}
                    </h2>
                    <p class="text-gray-700" data-aos="fade-up" data-aos-delay="100">
                        {{ __('Use these awesome forms to login or create new account in your project for free.') }}
                    </p>
                    <a href="#"
                        class="inline-flex items-center px-6 py-3 bg-primary-50 text-white rounded-md hover:bg-green-600"
                        data-aos="fade-up" data-aos-delay="200">
                        {{ __('Buy Now') }} <span class="ml-2">↓</span>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature Card -->
                <div class="bg-primary-50 rounded-lg p-8" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-4xl mb-4">⚡</div>
                    <h3 class="text-xl font-semibold mb-4">{{ __('Feature') }}</h3>
                    <p class="text-text-light dark:text-text-dark">
                        {{ __('Use these awesome forms to login or create new account in your project for free.') }}
                    </p>
                </div>

                <!-- Support Card -->
                <div class="bg-primary-50 hover:bg-primary-300 transition-color duration-300 rounded-lg p-8"
                    data-aos="fade-up" data-aos-delay="300">
                    <div class="text-4xl mb-4">⭕</div>
                    <h3 class="text-xl font-semibold mb-4">{{ __('Support') }} <span class="text-white">{{ __('100%
                            Free') }}</span></h3>
                    <p class="text-text-light dark:text-text-dark">
                        {{ __('Use these awesome forms to login or create new account in your project for free.') }}
                    </p>
                </div>

                <!-- Integration Card -->
                <div class="bg-primary-50 hover:bg-primary-300 transition-color duration-300 rounded-lg p-8"
                    data-aos="fade-up" data-aos-delay="400">
                    <div class="text-4xl mb-4">⚡</div>
                    <h3 class="text-xl font-semibold mb-4">{{ __('Integration') }}</h3>
                    <p class="text-text-light dark:text-text-dark">
                        {{ __('Use these awesome forms to login or create new account in your project for free.') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Time Tracking Tool Section -->
    <section class="bg-primary-50 text-white pb-20">
        <div class="container px-4 xl:px-0 py-10 lg:py-20 mx-auto">
            <div class="text-center space-y-4 mb-12">
                <p class="text-sm font-semibold text-primary-50">{{ __('FEATURES') }}</p>
                <h2 class="text-3xl md:text-4xl font-bold">{{ __('Timesheet - Time Tracking Tool') }}</h2>
                <p class="text-gray-800 max-w-2xl mx-auto">
                    {{ __('Use these awesome forms to login or create new account in your project for free.') }}
                </p>
            </div>

            <div class="rounded-lg overflow-hidden shadow-2xl" data-aos="fade-up" data-aos-delay="100">
                <img src="{{ asset(cms()->approach_image) }}" alt="Time Tracking Dashboard" class="w-full h-auto">
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
                        class="inline-flex items-center px-6 py-3 bg-Timesheet-green text-white rounded-md hover:bg-green-600"
                        data-aos="fade-up" data-aos-delay="200">
                        {{ __('Buy Now') }} <span class="ml-2">↓</span>
                    </a>
                </div>
                <div class="rounded-xl overflow-hidden shadow-2xl border border-gray-200" data-aos="fade-up"
                    data-aos-delay="300">
                    <img src="{{ asset(cms()->features_image1) }}" alt="Timesheet View" class="w-full h-auto">
                </div>
            </div>

            <!-- Second Screenshot -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="rounded-xl overflow-hidden shadow-2xl border border-gray-200 order-2 lg:order-1"
                    data-aos="fade-up" data-aos-delay="200">
                    <img src="{{ asset(cms()->features_image2) }}" alt="Project Templates View" class="w-full h-auto">
                </div>
                <div class="space-y-6 order-1 lg:order-2" data-aos="fade-up" data-aos-delay="100">
                    <p class="text-sm font-semibold text-Timesheet-green">{{ __('FEATURES') }}</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">{{ __('Timesheet') }} - {{ __('Time Tracking Tool') }}</h2>
                    <p class="text-gray-600">
                        {{ __('Use these awesome forms to login or create new account in your project for free.') }}
                    </p>
                    <a href="#"
                        class="inline-flex items-center px-6 py-3 bg-Timesheet-green text-white rounded-md hover:bg-green-600"
                        data-aos="fade-up" data-aos-delay="200">
                        {{ __('Buy Now') }} <span class="ml-2">↓</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing -->
    <section class="bg-gray-50">
        <div class="container px-4 xl:px-0 py-10 lg:py-20 mx-auto">
            <h2 class="text-4xl text-3xl md:text-4xl font-bold text-gray-900  mb-16 text-center" data-aos="fade-up">
                {{ __('Our Pricing') }}
            </h2>
            <div class="px-8 py-6 border border-white/30 rounded-xl bg-primary-50 shadow-xl backdrop-blur"
                data-aos="fade-up" data-aos-delay="100">
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
                    <div class="bg-white rounded-lg p-6" data-aos="fade-up" data-aos-delay="200">
                        <h2 class="text-xl font-semibold text-text-white">Get a new hosting plan</h2>
                        <p class="text-text-white/90 mb-12">
                            Everything you need to create a website
                        </p>
                        <div class="relative inline-block">
                            <div class="text-text-white/90 line-through text-sm">$9.99</div>
                            <div class="absolute start-full -top-2 rotate-60">
                                <span
                                    class="inline-block whitespace-nowrap bg-rose-500 text-text-white text-sm px-3 py-1 rounded-full">
                                    80% OFF
                                </span>
                            </div>
                        </div>
                        <div>
                            <div class="text-sm text-text-white/90 mt-6 mb-2">From</div>
                            <div class="flex items-baseline gap-1">
                                <span class="text-3xl text-text-white font-bold">$1.99</span>
                                <span class="text-text-white/90">/mo</span>
                            </div>
                            <div class="text-sm text-text-white/90 my-8">
                                when getting a 4-year subscription
                            </div>
                        </div>
                        <button
                            class="w-full py-2 px-4 bg-primary-50 bg-opacity-10 rounded-md hover:bg-opacity-20 transition-colors"
                            data-aos="fade-up" data-aos-delay="300">
                            Get deal
                        </button>
                    </div>
                    <!-- Pricing Plan -->
                    <div class="bg-white rounded-lg p-6" data-aos="fade-up" data-aos-delay="200">
                        <h2 class="text-xl font-semibold text-text-white">Get a new hosting plan</h2>
                        <p class="text-text-white/90 mb-12">
                            Everything you need to create a website
                        </p>
                        <div class="relative inline-block">
                            <div class="text-text-white/90 line-through text-sm">$9.99</div>
                            <div class="absolute start-full -top-2 rotate-60">
                                <span
                                    class="inline-block whitespace-nowrap bg-rose-500 text-text-white text-sm px-3 py-1 rounded-full">
                                    80% OFF
                                </span>
                            </div>
                        </div>
                        <div>
                            <div class="text-sm text-text-white/90 mt-6 mb-2">From</div>
                            <div class="flex items-baseline gap-1">
                                <span class="text-3xl text-text-white font-bold">$1.99</span>
                                <span class="text-text-white/90">/mo</span>
                            </div>
                            <div class="text-sm text-text-white/90 my-8">
                                when getting a 4-year subscription
                            </div>
                        </div>
                        <button
                            class="w-full py-2 px-4 bg-primary-50 bg-opacity-10 rounded-md hover:bg-opacity-20 transition-colors"
                            data-aos="fade-up" data-aos-delay="300">
                            Get deal
                        </button>
                    </div>
                    <!-- Pricing Plan -->
                    <div class="bg-white rounded-lg p-6" data-aos="fade-up" data-aos-delay="200">
                        <h2 class="text-xl font-semibold text-text-white">Get a new hosting plan</h2>
                        <p class="text-text-white/90 mb-12">
                            Everything you need to create a website
                        </p>
                        <div class="relative inline-block">
                            <div class="text-text-white/90 line-through text-sm">$9.99</div>
                            <div class="absolute start-full -top-2 rotate-60">
                                <span
                                    class="inline-block whitespace-nowrap bg-rose-500 text-text-white text-sm px-3 py-1 rounded-full">
                                    80% OFF
                                </span>
                            </div>
                        </div>
                        <div>
                            <div class="text-sm text-text-white/90 mt-6 mb-2">From</div>
                            <div class="flex items-baseline gap-1">
                                <span class="text-3xl text-text-white font-bold">$1.99</span>
                                <span class="text-text-white/90">/mo</span>
                            </div>
                            <div class="text-sm text-text-white/90 my-8">
                                when getting a 4-year subscription
                            </div>
                        </div>
                        <button
                            class="w-full py-2 px-4 bg-primary-50 bg-opacity-10 rounded-md hover:bg-opacity-20 transition-colors"
                            data-aos="fade-up" data-aos-delay="300">
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
                @foreach(testimonials() as $testimonial)
                <div class="bg-primary-50 rounded-lg p-8 space-y-4 shadow-xl" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex justify-between items-start">
                        <div class="w-8 h-8 bg-gray-900 flex items-center justify-center rounded">
                            <span class="text-white">"</span>
                        </div>
                        <div class="flex">
                            @for($i = 0; $i < $testimonial->rating; $i++)
                                <span class="text-yellow-500">★</span>
                            @endfor
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-white">{{ $testimonial->name }}</h3>
                    <p class="text-gray-800 italic" data-aos="fade-up" data-aos-delay="200">
                        {{ $testimonial->description }}
                    </p>
                    <div class="flex items-center gap-3 pt-4">
                        <img src="{{ asset($testimonial->image) }}" alt="" class="w-10 h-10 rounded-full">
                        <div class="text-sm">
                            <p class="text-white font-medium">{{ $testimonial->company }}</p>
                            <p class="text-gray-800">{{ $testimonial->designation }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
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
                <!-- Form Section -->
                <div class="md:order-2 bg-card-500 p-8 rounded-lg bg-white card border border-white/30 mb-10" data-aos="fade-up" data-aos-delay="200">
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <!-- Input -->
                            <div class="relative">
                                <input type="text" required id="hs-tac-input-name" name="name" class="peer p-4 block w-full bg-black/5 border-transparent rounded-lg text-sm text-text-light placeholder:text-transparent focus:outline-none focus:ring-0 focus:border-transparent disabled:opacity-50 disabled:pointer-events-none focus:pt-6 focus:pb-2 [&:not(:placeholder-shown)]:pt-6 [&:not(:placeholder-shown)]:pb-2 autofill:pt-6 autofill:pb-2" placeholder="Name">
                                <label for="hs-tac-input-name" class="absolute top-0 start-0 p-4 h-full text-gray-800 text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent peer-disabled:opacity-50 peer-disabled:pointer-events-none peer-focus:text-xs peer-focus:-translate-y-1.5 peer-focus:text-gray-800 peer-[:not(:placeholder-shown)]:text-xs peer-[:not(:placeholder-shown)]:-translate-y-1.5 peer-[:not(:placeholder-shown)]:text-gray-800">
                                    {{ __('Name') }}
                                </label>
                                @error('name')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- End Input -->
    
                            <!-- Input -->
                            <div class="relative">
                                <input type="email" required name="email" id="hs-tac-input-email" class="peer p-4 block w-full bg-black/5 border-transparent rounded-lg text-sm text-text-light placeholder:text-transparent focus:outline-none focus:ring-0 focus:border-transparent disabled:opacity-50 disabled:pointer-events-none focus:pt-6 focus:pb-2 [&:not(:placeholder-shown)]:pt-6 [&:not(:placeholder-shown)]:pb-2 autofill:pt-6 autofill:pb-2" placeholder="Email">
                                <label for="hs-tac-input-email" class="absolute top-0 start-0 p-4 h-full text-gray-800 text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent peer-disabled:opacity-50 peer-disabled:pointer-events-none peer-focus:text-xs peer-focus:-translate-y-1.5 peer-focus:text-gray-800 peer-[:not(:placeholder-shown)]:text-xs peer-[:not(:placeholder-shown)]:-translate-y-1.5 peer-[:not(:placeholder-shown)]:text-gray-800">
                                    {{ __('Email') }}
                                </label>
                                @error('email')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- End Input -->
    
                            <!-- Input -->
                            <div class="relative">
                                <input type="text" required name="company" id="hs-tac-input-company" class="peer p-4 block w-full bg-black/5 border-transparent rounded-lg text-sm text-text-light placeholder:text-transparent focus:outline-none focus:ring-0 focus:border-transparent disabled:opacity-50 disabled:pointer-events-none focus:pt-6 focus:pb-2 [&:not(:placeholder-shown)]:pt-6 [&:not(:placeholder-shown)]:pb-2 autofill:pt-6 autofill:pb-2" placeholder="Company">
                                <label for="hs-tac-input-company" class="absolute top-0 start-0 p-4 h-full text-gray-800 text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent peer-disabled:opacity-50 peer-disabled:pointer-events-none peer-focus:text-xs peer-focus:-translate-y-1.5 peer-focus:text-gray-800 peer-[:not(:placeholder-shown)]:text-xs peer-[:not(:placeholder-shown)]:-translate-y-1.5 peer-[:not(:placeholder-shown)]:text-gray-800">
                                    {{ __('Company') }}
                                </label>
                                @error('company')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- End Input -->
    
                            <!-- Input -->
                            <div class="relative">
                                <input type="text" name="phone" id="hs-tac-input-phone" class="peer p-4 block w-full bg-black/5 border-transparent rounded-lg text-sm text-text-light placeholder:text-transparent focus:outline-none focus:ring-0 focus:border-transparent disabled:opacity-50 disabled:pointer-events-none focus:pt-6 focus:pb-2 [&:not(:placeholder-shown)]:pt-6 [&:not(:placeholder-shown)]:pb-2 autofill:pt-6 autofill:pb-2" placeholder="Phone">
                                <label for="hs-tac-input-phone" class="absolute top-0 start-0 p-4 h-full text-gray-800 text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent peer-disabled:opacity-50 peer-disabled:pointer-events-none peer-focus:text-xs peer-focus:-translate-y-1.5 peer-focus:text-gray-800 peer-[:not(:placeholder-shown)]:text-xs peer-[:not(:placeholder-shown)]:-translate-y-1.5 peer-[:not(:placeholder-shown)]:text-gray-800">
                                    {{ __('Phone') }}
                                </label>
                                @error('phone')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- End Input -->
    
                            <!-- Textarea -->
                            <div class="relative">
                                <textarea name="message" required id="hs-tac-message"  class="peer p-4 block w-full bg-black/5 border-transparent rounded-lg text-sm text-text-light placeholder:text-transparent focus:outline-none focus:ring-0 focus:border-transparent disabled:opacity-50 disabled:pointer-events-none focus:pt-6 focus:pb-2 [&:not(:placeholder-shown)]:pt-6 [&:not(:placeholder-shown)]:pb-2 autofill:pt-6 autofill:pb-2" placeholder="This is a textarea placeholder"></textarea>
                                <label for="hs-tac-message" class="absolute top-0 start-0 p-4 h-full text-gray-800 text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent peer-disabled:opacity-50 peer-disabled:pointer-events-none peer-focus:text-xs peer-focus:-translate-y-1.5 peer-focus:text-gray-800 peer-[:not(:placeholder-shown)]:text-xs peer-[:not(:placeholder-shown)]:-translate-y-1.5 peer-[:not(:placeholder-shown)]:text-gray-800">
                                    {{ __('Tell us about your project') }}
                                </label>
                                @error('message')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- End Textarea -->
                        </div>
    
                        <div class="mt-2">
                            <p class="text-xs text-white">
                                {{ __('All fields are required') }}
                            </p>
    
                            <p class="mt-5">
                                <button type="submit"    class="group inline-flex items-center gap-x-2 py-2 px-3 bg-gray-900 font-medium text-sm text-white rounded focus:outline-none" href="#">
                                    {{ __('Submit') }}
                                    <svg class="flex-shrink-0  shadow-xlsize-4 transition group-hover:translate-x-0.5 group-hover:translate-x-0 group-focus:translate-x-0.5 group-focus:translate-x-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14" />
                                        <path d="m12 5 7 7-7 7" />
                                    </svg>
                                </button>
                            </p>
                        </div>
                    </form>
                </div>
                <!-- End Form Section -->
    
                <!-- Details Section -->
                <div class="space-y-14" data-aos="fade-up" data-aos-delay="300">
                    <!-- Item -->
                    <div class="flex gap-x-5">
                        <svg class="flex-shrink-0  shadow-xlsize-6 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
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
                        <svg class="flex-shrink-0  shadow-xlsize-6 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21.2 8.4c.5.38.8.97.8 1.6v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V10a2 2 0 0 1 .8-1.6l8-6a2 2 0 0 1 2.4 0l8 6Z" />
                            <path d="m22 10-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 10" />
                        </svg>
                        <div class="grow">
                            <h4 class="text-white font-semibold" data-aos="fade-up">
                                {{ __('Email us:') }}
                            </h4>
    
                            <a class="mt-1 text-gray-800 text-sm" href="mailto:example@site.co" target="_blank">
                                hello@example.so
                            </a>
                        </div>
                    </div>
                    <!-- End Item -->
    
                    <!-- Item -->
                    <div class="flex gap-x-5">
                        <svg class="flex-shrink-0  shadow-xlsize-6 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
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
                                <a class="group inline-flex items-center gap-x-2 font-medium text-sm text-primary-500 decoration-2 hover:underline focus:outline-none focus:underline" href="#">
                                    {{ __('Job openings') }}
                                    <svg class="flex-shrink-0  shadow-xlsize-4 transition group-hover:translate-x-0.5 group-hover:translate-x-0 group-focus:translate-x-0.5 group-focus:translate-x-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14" />
                                        <path d="m12 5 7 7-7 7" />
                                    </svg>
                                </a>
                            </p>
                        </div>
                    </div>
                    <!-- End Item -->
                </div>
                <!-- End Details Section -->
            </div>
            <!-- End Grid -->
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
                </div>

                <!-- Links -->
                <div data-aos="fade-up">
                    <ul class="space-y-3">
                        <li><a href="#" class="text-white hover:text-primary-500">{{ __('About Us') }}</a></li>
                        <li><a href="#" class="text-white hover:text-primary-500">{{ __('Terms and Conditions') }}</a></li>
                        <li><a href="#" class="text-white hover:text-primary-500">{{ __('Privacy Policy') }}</a></li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div class="space-y-4" data-aos="fade-up">
                    <h3 class="text-xl font-bold text-white">Join Our Community</h3>
                    <p class="text-white">
                        We build modern web tools to help you jump-start your daily business work.
                    </p>
                    <form class="flex gap-2">
                        <input type="email" placeholder="Type your email address..."
                            class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <button type="submit" class="px-6 py-2 bg-primary-50 text-white rounded-md hover:bg-gray-800">
                            Join Us!
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