<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <link rel="canonical" href="https://preline.co/">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="Discover the difference that a professionally crafted website can make for your business.">

    <meta name="twitter:site" content="@preline">
    <meta name="twitter:creator" content="@preline">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Agency Demo Template Tailwind CSS | Timesheet UI, crafted with Tailwind CSS">
    <meta name="twitter:description"
        content="Discover the difference that a professionally crafted website can make for your business.">
    <meta name="twitter:image" content="https://preline.co/assets/img/og-image.png">

    <meta property="og:url" content="https://preline.co/">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Timesheet">
    <meta property="og:title" content="Agency Demo Template Tailwind CSS | Timesheet UI, crafted with Tailwind CSS">
    <meta property="og:description"
        content="Discover the difference that a professionally crafted website can make for your business.">
    <meta property="og:image" content="https://preline.co/assets/img/og-image.png">

    <!-- Title -->
    <title>TimeSheet | Tracking time for clients</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="https://preline.co/favicon.ico">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Theme Check and Update -->
    <script>
        const html = document.querySelector('html');
        const isLightOrAuto = localStorage.getItem('hs_theme') === 'light' || (localStorage.getItem('hs_theme') ===
            'auto' && !window.matchMedia('(prefers-color-scheme: dark)').matches);
        const isDarkOrAuto = localStorage.getItem('hs_theme') === 'dark' || (localStorage.getItem('hs_theme') === 'auto' &&
            window.matchMedia('(prefers-color-scheme: dark)').matches);

        if (isLightOrAuto && html.classList.contains('dark')) html.classList.remove('dark');
        else if (isDarkOrAuto && html.classList.contains('light')) html.classList.remove('light');
        else if (isDarkOrAuto && !html.classList.contains('dark')) html.classList.add('dark');
        else if (isLightOrAuto && !html.classList.contains('light')) html.classList.add('light');
    </script>

    <!-- CSS Timesheet -->
    <link rel="stylesheet" href="https://preline.co/assets/css/main.min.css">
</head>

<body class="bg-neutral-900">
    <!-- ========== HEADER ========== -->
    <header class="sticky top-4 inset-x-0 flex flex-wrap md:justify-start md:flex-nowrap z-50 w-full">
        <nav class="relative container mx-auto w-full bg-white/10 border border-white/30 backdrop-blur rounded-lg py-4 px-6 md:flex md:items-center md:justify-between"
            aria-label="Global">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <a class="flex-none rounded-md text-2xl text-white inline-block font-semibold focus:outline-none focus:opacity-80"
                    href="../../templates/agency/index.html" aria-label="Timesheet">
                    Timesheet
                </a>
                <!-- End Logo -->

                <div class="md:hidden">
                    <button type="button"
                        class="hs-collapse-toggle size-8 flex justify-center items-center text-sm font-semibold rounded-full bg-neutral-800 text-white disabled:opacity-50 disabled:pointer-events-none"
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
                    <a class="text-sm text-white hover:text-neutral-300 md:py-4 focus:outline-none focus:text-neutral-300"
                        href="../../templates/agency/index.html" aria-current="page">Home</a>

                    <div>
                        <a class="group inline-flex items-center gap-x-2 py-2 bg-primary-500 font-medium text-sm text-white rounded-md focus:outline-none px-5"
                            href="{{ route('login') }}">
                            Login
                        </a>
                    </div>
                </div>
            </div>
            <!-- End Collapse -->
        </nav>
    </header>
    <!-- ========== END HEADER ========== -->

    <!-- ========== MAIN CONTENT ========== -->
    <main id="content">
        <!-- Hero -->
        <div class="bg-neutral-900">
            <div class="container mx-auto">
                <div class="flex flex-col md:flex-row gap-8 justify-between items-center pt-24 lg:pt-32 pb-24">
                    <div class="max-w-2xl px-4 xl:px-0">
                        <h1 class="font-semibold text-white text-5xl md:text-6xl">
                            <span class="text-primary-500">{{ __('Timesheet App:') }}</span> {{ __('A Time Tracking Tool') }}
                        </h1>
                        <div class="max-w-4xl">
                            <p class="mt-5 text-neutral-400 text-lg">
                                {{ __('It is a creative hub where imagination meets craftsmanship to transform ideas into tangible realities. At Timesheet Agency, we specialize in turning conceptual visions into concrete forms, whether it be through design, artistry, or technological innovation.') }}
                            </p>
                        </div>
                    </div>
                    <div class="max-w-3xl w-full">
                        <img class="rounded-md" src="{{ asset(cms()->banner_image) }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <!-- End Hero -->

        <!-- Clients -->
        <div class="relative overflow-hidden pt-4 bg-neutral-900">
            <svg class="absolute -bottom-20 start-1/2 w-[1900px] transform -translate-x-1/2" width="2745"
                height="488" viewBox="0 0 2745 488" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M0.5 330.864C232.505 403.801 853.749 527.683 1482.69 439.719C2111.63 351.756 2585.54 434.588 2743.87 487"
                    class="stroke-neutral-700/50" stroke="currentColor" />
                <path
                    d="M0.5 308.873C232.505 381.81 853.749 505.692 1482.69 417.728C2111.63 329.765 2585.54 412.597 2743.87 465.009"
                    class="stroke-neutral-700/50" stroke="currentColor" />
                <path
                    d="M0.5 286.882C232.505 359.819 853.749 483.701 1482.69 395.738C2111.63 307.774 2585.54 390.606 2743.87 443.018"
                    class="stroke-neutral-700/50" stroke="currentColor" />
                <path
                    d="M0.5 264.891C232.505 337.828 853.749 461.71 1482.69 373.747C2111.63 285.783 2585.54 368.615 2743.87 421.027"
                    class="stroke-neutral-700/50" stroke="currentColor" />
                <path
                    d="M0.5 242.9C232.505 315.837 853.749 439.719 1482.69 351.756C2111.63 263.792 2585.54 346.624 2743.87 399.036"
                    class="stroke-neutral-700/50" stroke="currentColor" />
                <path
                    d="M0.5 220.909C232.505 293.846 853.749 417.728 1482.69 329.765C2111.63 241.801 2585.54 324.633 2743.87 377.045"
                    class="stroke-neutral-700/50" stroke="currentColor" />
                <path
                    d="M0.5 198.918C232.505 271.855 853.749 395.737 1482.69 307.774C2111.63 219.81 2585.54 302.642 2743.87 355.054"
                    class="stroke-neutral-700/50" stroke="currentColor" />
                <path
                    d="M0.5 176.927C232.505 249.864 853.749 373.746 1482.69 285.783C2111.63 197.819 2585.54 280.651 2743.87 333.063"
                    class="stroke-neutral-700/50" stroke="currentColor" />
                <path
                    d="M0.5 154.937C232.505 227.873 853.749 351.756 1482.69 263.792C2111.63 175.828 2585.54 258.661 2743.87 311.072"
                    class="stroke-neutral-700/50" stroke="currentColor" />
                <path
                    d="M0.5 132.946C232.505 205.882 853.749 329.765 1482.69 241.801C2111.63 153.837 2585.54 236.67 2743.87 289.082"
                    class="stroke-neutral-700/50" stroke="currentColor" />
                <path
                    d="M0.5 110.955C232.505 183.891 853.749 307.774 1482.69 219.81C2111.63 131.846 2585.54 214.679 2743.87 267.091"
                    class="stroke-neutral-700/50" stroke="currentColor" />
                <path
                    d="M0.5 88.9639C232.505 161.901 853.749 285.783 1482.69 197.819C2111.63 109.855 2585.54 192.688 2743.87 245.1"
                    class="stroke-neutral-700/50" stroke="currentColor" />
                <path
                    d="M0.5 66.9729C232.505 139.91 853.749 263.792 1482.69 175.828C2111.63 87.8643 2585.54 170.697 2743.87 223.109"
                    class="stroke-neutral-700/50" stroke="currentColor" />
                <path
                    d="M0.5 44.9819C232.505 117.919 853.749 241.801 1482.69 153.837C2111.63 65.8733 2585.54 148.706 2743.87 201.118"
                    class="stroke-neutral-700/50" stroke="currentColor" />
                <path
                    d="M0.5 22.991C232.505 95.9276 853.749 219.81 1482.69 131.846C2111.63 43.8824 2585.54 126.715 2743.87 179.127"
                    class="stroke-neutral-700/50" stroke="currentColor" />
                <path
                    d="M0.5 1C232.505 73.9367 853.749 197.819 1482.69 109.855C2111.63 21.8914 2585.54 104.724 2743.87 157.136"
                    class="stroke-neutral-700/50" stroke="currentColor" />
            </svg>

            <div class="relative z-10">
                <div class="container px-4 xl:px-0 mx-auto">
                    <div class="mb-4">
                        <h2 class="text-neutral-400">
                            {{ __('Trusted by Open Source, enterprise, and more than 99,000 of you') }}
                        </h2>
                    </div>

                    <div class="flex justify-between gap-6 mt-5">
                        <img class="w-20" src="{{ asset(cms()->client_image1) }}" alt="">
                        <img class="w-20" src="{{ asset(cms()->client_image2) }}" alt="">
                        <img class="w-20" src="{{ asset(cms()->client_image3) }}" alt="">
                        <img class="w-20" src="{{ asset(cms()->client_image4) }}" alt="">
                        <img class="w-20" src="{{ asset(cms()->client_image5) }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <!-- End Clients -->

        <!-- Case Stories -->
        <div class="bg-neutral-900 bg-gradient-to-t from-black to-transparent">
            <div class="container px-4 xl:px-0 py-24 mx-auto">
                <!-- Title -->
                <div class="max-w-3xl mb-10 lg:mb-14">
                    <h2 class="text-white/80 font-semibold text-xl md:text-2xl md:leading-tight">{{ __('Features') }}
                    </h2>
                    <h2 class="text-white font-semibold text-3xl md:text-5xl md:leading-tight">
                        {{ __('All In One Place CRM System') }}</h2>
                    <p class="mt-1 text-neutral-400">
                        {{ __('Use these awesome forms to login or create new account in your project for free. Use these awesome forms to login or create new account in your project for free.') }}
                    </p>
                </div>
                <!-- End Title -->

                <!-- Card Grid -->
                <div
                    class="grid grid-cols-1 lg:grid-cols-3 items-center border border-neutral-700 divide-y lg:divide-y-0 lg:divide-x divide-neutral-700 rounded-xl">
                    <!-- Card -->
                    <a class="group relative z-10 p-4 md:p-6 h-full flex flex-col bg-neutral-900 first:rounded-t-xl last:rounded-b-xl lg:first:rounded-l-xl lg:first:rounded-tr-none lg:last:rounded-r-xl lg:last:rounded-bl-none before:absolute before:inset-0 before:bg-gradient-to-b before:hover:from-transparent before:hover:via-transparent before:hover:to-[#ff0]/10 before:via-80% before:-z-[1] before:last:rounded-b-xl lg:before:first:rounded-s-xl lg:before:last:rounded-e-xl lg:before:last:rounded-bl-none before:opacity-0 before:hover:opacity-100"
                        href="#">
                        <div>
                            <span
                                class="inline-flex justify-center items-center p-2 rounded-full overflow-hidden bg-white/50 border border-primary-500 backdrop-blur">
                                <img src="{{ asset('/images/feature.png') }}" alt="">
                            </span>

                            <div class="mt-5">
                                <p class="font-semibold text-5xl text-white">{{ __('Feature') }}</p>
                                <h3 class="mt-5 font-medium text-lg text-white/70">
                                    {{ __('Use these awesome forms to login or create new account in your project for free.Use these awesome forms to login or create new account in your project for free.') }}
                                </h3>
                            </div>
                        </div>
                    </a>
                    <!-- End Card -->
                    <!-- Card -->
                    <a class="group relative z-10 p-4 md:p-6 h-full flex flex-col bg-neutral-900 first:rounded-t-xl last:rounded-b-xl lg:first:rounded-l-xl lg:first:rounded-tr-none lg:last:rounded-r-xl lg:last:rounded-bl-none before:absolute before:inset-0 before:bg-gradient-to-b before:hover:from-transparent before:hover:via-transparent before:hover:to-[#ff0]/10 before:via-80% before:-z-[1] before:last:rounded-b-xl lg:before:first:rounded-s-xl lg:before:last:rounded-e-xl lg:before:last:rounded-bl-none before:opacity-0 before:hover:opacity-100"
                        href="#">
                        <div>
                            <span
                                class="inline-flex justify-center items-center p-2 rounded-full overflow-hidden bg-white/50 border border-primary-500 backdrop-blur">
                                <img src="{{ asset('/images/support.png') }}" alt="">
                            </span>
                            <div class="mt-5">
                                <p class="font-semibold text-5xl text-white">{{ __('Support') }}</p>
                                <h3 class="mt-5 font-medium text-lg text-white/70">
                                    {{ __('Use these awesome forms to login or create new account in your project for free.Use these awesome forms to login or create new account in your project for free.') }}
                                </h3>
                            </div>
                        </div>
                    </a>
                    <!-- End Card -->
                    <!-- Card -->
                    <a class="group relative z-10 p-4 md:p-6 h-full flex flex-col bg-neutral-900 first:rounded-t-xl last:rounded-b-xl lg:first:rounded-l-xl lg:first:rounded-tr-none lg:last:rounded-r-xl lg:last:rounded-bl-none before:absolute before:inset-0 before:bg-gradient-to-b before:hover:from-transparent before:hover:via-transparent before:hover:to-[#ff0]/10 before:via-80% before:-z-[1] before:last:rounded-b-xl lg:before:first:rounded-s-xl lg:before:last:rounded-e-xl lg:before:last:rounded-bl-none before:opacity-0 before:hover:opacity-100"
                        href="#">
                        <div>
                            <span
                                class="inline-flex justify-center items-center p-2 rounded-full overflow-hidden bg-white/50 border border-primary-500 backdrop-blur">
                                <img src="{{ asset('/images/integration.png') }}" alt="">
                            </span>

                            <div class="mt-5">
                                <p class="font-semibold text-5xl text-white">{{ __('Integration') }}</p>
                                <h3 class="mt-5 font-medium text-lg text-white/70">
                                    {{ __('Use these awesome forms to login or create new account in your project for free.Use these awesome forms to login or create new account in your project for free.') }}
                                </h3>
                            </div>
                        </div>
                    </a>
                    <!-- End Card -->
                </div>
                <!-- End Card Grid -->

            </div>
        </div>
        <!-- End Case Stories -->

        <!-- Features Section -->
        <div class="bg-neutral-900">
            <div class="container px-4 xl:px-0 py-10 lg:py-20 mx-auto">
                <!-- Title -->
                <div class="max-w-3xl mb-10 lg:mb-14">
                    <h4
                        class="text-white inline-flex rounded px-4 py-2 font-semibold text-xl md:text-2xl md:leading-tight backdrop-blur bg-white/10 border border-primary-500">
                        {{ __('Features') }}</h4>
                    <h2 class="mt-8 text-2xl md:text-4xl text-gray-100">{{ __('ClockGo SaaS - Time Tracking Tool') }}
                    </h2>
                    <p class="mt-4 text-base md:text-xl text-white/90">
                        {{ __('Use these awesome forms to login or create new account in your project for free.') }}
                    </p>
                </div>
                <!-- End Title -->

                <!-- Grid -->
                <div class="md:grid md:grid-cols-2 md:gap-10 lg:gap-16 md:items-center">
                    <div>
                        <!-- Feature Card-->
                        <div>
                            <div class="mb-6">
                                <div class="flex items-center">
                                    <div class="ms-4 md:ms-0">
                                        <div class="text-base font-semibold text-white">{{ __('Nicole Grazioso') }}</div>
                                        <div class="text-xs text-neutral-400">{{ __('Director Payments & Risk | Airbnb') }}</div>
                                    </div>
                                </div>
                            </div>
                            <p
                                class="font-medium text-xl text-white md:text-2xl md:leading-normal xl:text-3xl xl:leading-normal">
                                {{ __('To say that switching to Timesheet has been life-changing is an understatement. My business has tripled since then.') }}
                            </p>
                            <div class="md:hidden flex-shrink-0">
                                <img class="size-12 rounded-full"
                                    src="https://images.unsplash.com/photo-1671725501928-b7d85698ccd8?q=80&w=320&h=320&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    alt="Image Description">
                            </div>
                        </div>
                        <!-- End Blockquote -->
                    </div>
                    <!-- End Col -->

                    <div class="hidden md:block mb-24 md:mb-0">
                        <img class="rounded-xl"
                            src="https://images.unsplash.com/photo-1671725501928-b7d85698ccd8?q=80&w=3540&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Image Description">
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Grid -->
            </div>
        </div>
        <!-- End Testimonials -->

        <!-- Stats -->
        <div class="bg-neutral-900">
            <div class="container px-4 xl:px-0 py-10 mx-auto">
                <div class="border border-neutral-800 rounded-xl">
                    <div
                        class="p-4 lg:p-8 bg-gradient-to-bl from-neutral-800 via-neutral-900 to-neutral-950 rounded-xl">
                        <div class="grid grid-cols-1 sm:grid-cols-3 items-center gap-y-20 gap-x-12">
                            <!-- Stats -->
                            <div
                                class="relative text-center first:before:hidden before:absolute before:-top-full sm:before:top-1/2 before:start-1/2 sm:before:-start-6 before:w-px before:h-20 before:bg-neutral-800 before:rotate-[60deg] sm:before:rotate-12 before:transform sm:before:-translate-y-1/2 before:-translate-x-1/2 sm:before:-translate-x-0 before:mt-3.5 sm:before:mt-0">
                                <svg class="flex-shrink-0 size-6 sm:size-8 text-primary-500 mx-auto"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m11 17 2 2a1 1 0 1 0 3-3" />
                                    <path
                                        d="m14 14 2.5 2.5a1 1 0 1 0 3-3l-3.88-3.88a3 3 0 0 0-4.24 0l-.88.88a1 1 0 1 1-3-3l2.81-2.81a5.79 5.79 0 0 1 7.06-.87l.47.28a2 2 0 0 0 1.42.25L21 4" />
                                    <path d="m21 3 1 11h-2" />
                                    <path d="M3 3 2 14l6.5 6.5a1 1 0 1 0 3-3" />
                                    <path d="M3 4h8" />
                                </svg>
                                <div class="mt-3 sm:mt-5">
                                    <h3 class="text-lg sm:text-3xl font-semibold text-white">{{ __('2,000+') }}</h3>
                                    <p class="mt-1 text-sm sm:text-base text-neutral-400">{{ __('Timesheet partners') }}</p>
                                </div>
                            </div>
                            <!-- End Stats -->

                            <!-- Stats -->
                            <div
                                class="relative text-center first:before:hidden before:absolute before:-top-full sm:before:top-1/2 before:start-1/2 sm:before:-start-6 before:w-px before:h-20 before:bg-neutral-800 before:rotate-[60deg] sm:before:rotate-12 before:transform sm:before:-translate-y-1/2 before:-translate-x-1/2 sm:before:-translate-x-0 before:mt-3.5 sm:before:mt-0">
                                <div class="flex justify-center items-center -space-x-5">
                                    <img class="relative z-[2] flex-shrink-0 size-8 rounded-full border-[3px] border-neutral-800"
                                        src="https://images.unsplash.com/photo-1601935111741-ae98b2b230b0?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80"
                                        alt="Image Description">
                                    <img class="relative z-[1] flex-shrink-0 size-8 rounded-full border-[3px] border-neutral-800 -mt-7"
                                        src="https://images.unsplash.com/photo-1570654639102-bdd95efeca7a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80"
                                        alt="Image Description">
                                    <img class="relative flex-shrink-0 size-8 rounded-full border-[3px] border-neutral-800"
                                        src="https://images.unsplash.com/photo-1679412330254-90cb240038c5?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=facearea&amp;facepad=2.5&amp;w=320&amp;h=320&amp;q=80"
                                        alt="Image Description">
                                </div>
                                <div class="mt-3 sm:mt-5">
                                    <h3 class="text-lg sm:text-3xl font-semibold text-white">{{ __('85%') }}</h3>
                                    <p class="mt-1 text-sm sm:text-base text-neutral-400">{{ __('Happy customers') }}</p>
                                </div>
                            </div>
                            <!-- End Stats -->

                            <!-- Stats -->
                            <div
                                class="relative text-center first:before:hidden before:absolute before:-top-full sm:before:top-1/2 before:start-1/2 sm:before:-start-6 before:w-px before:h-20 before:bg-neutral-800 before:rotate-[60deg] sm:before:rotate-12 before:transform sm:before:-translate-y-1/2 before:-translate-x-1/2 sm:before:-translate-x-0 before:mt-3.5 sm:before:mt-0">
                                <svg class="flex-shrink-0 size-6 sm:size-8 text-primary-500 mx-auto"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 15h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 17" />
                                    <path
                                        d="m7 21 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a2 2 0 0 0-2.75-2.91l-4.2 3.9" />
                                    <path d="m2 16 6 6" />
                                    <circle cx="16" cy="9" r="2.9" />
                                    <circle cx="6" cy="5" r="3" />
                                </svg>
                                <div class="mt-3 sm:mt-5">
                                    <h3 class="text-lg sm:text-3xl font-semibold text-white">{{ __('$55M+') }}</h3>
                                    <p class="mt-1 text-sm sm:text-base text-neutral-400">{{ __('Ads managed yearly') }}</p>
                                </div>
                            </div>
                            <!-- End Stats -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Stats -->

        <!-- Approach -->
        <div class="bg-neutral-900">
            <!-- Approach -->
            <div class="container px-4 xl:px-0 py-10 lg:pt-20  mx-auto">
                <!-- Title -->
                <div class="max-w-3xl mb-10 lg:mb-14">
                    <h2 class="text-white font-semibold text-2xl md:text-4xl md:leading-tight">
                        {{ __('Our approach') }}
                    </h2>
                    <p class="mt-1 text-neutral-400">
                        {{ __('This profound insight guides our comprehensive strategy — from meticulous research and strategic planning to the seamless execution of brand development and website or product deployment.') }}
                        </p>
                    </p>
                </div>
                <!-- End Title -->

                <!-- Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 lg:items-center">
                    <div class="aspect-w-16 aspect-h-9 lg:aspect-none">
                        <img class="w-full object-cover rounded-xl" src="{{ asset(cms()->approach_image) }}"
                            alt="Image Description">
                    </div>
                    <!-- End Col -->

                    <!-- Timeline -->
                    <div>
                        <!-- Heading -->
                        <div class="mb-4">
                            <h3 class="text-xs font-medium uppercase text-primary-500">
                                {{ __('Steps') }}
                            </h3>
                        </div>
                        <!-- End Heading -->

                        <!-- Item -->
                        <div class="flex gap-x-5 ms-1">
                            <!-- Icon -->
                            <div
                                class="relative last:after:hidden after:absolute after:top-8 after:bottom-0 after:start-4 after:w-px after:-translate-x-[0.5px] after:bg-neutral-800">
                                <div class="relative z-10 size-8 flex justify-center items-center">
                                    <span
                                        class="flex flex-shrink-0 justify-center items-center size-8 border border-neutral-800 text-primary-500 font-semibold text-xs uppercase rounded-full">
                                        1
                                    </span>
                                </div>
                            </div>
                            <!-- End Icon -->

                            <!-- Right Content -->
                            <div class="grow pt-0.5 pb-8 sm:pb-12">
                                <p class="text-sm lg:text-base text-neutral-400">
                                    <span class="text-white">{{ __('Market Research and Analysis:') }}</span>
                                    {{ __('Identify your target audience and understand their needs, preferences, and behaviors.') }}
                                </p>
                            </div>
                            <!-- End Right Content -->
                        </div>
                        <!-- End Item -->

                        <!-- Item -->
                        <div class="flex gap-x-5 ms-1">
                            <!-- Icon -->
                            <div
                                class="relative last:after:hidden after:absolute after:top-8 after:bottom-0 after:start-4 after:w-px after:-translate-x-[0.5px] after:bg-neutral-800">
                                <div class="relative z-10 size-8 flex justify-center items-center">
                                    <span
                                        class="flex flex-shrink-0 justify-center items-center size-8 border border-neutral-800 text-primary-500 font-semibold text-xs uppercase rounded-full">
                                        2
                                    </span>
                                </div>
                            </div>
                            <!-- End Icon -->

                            <!-- Right Content -->
                            <div class="grow pt-0.5 pb-8 sm:pb-12">
                                <p class="text-sm lg:text-base text-neutral-400">
                                    <span class="text-white">{{ __('Product Development and Testing:') }}</span>
                                    {{ __('Develop digital products or services that address the needs and preferences of your target audience.') }}
                                </p>
                            </div>
                            <!-- End Right Content -->
                        </div>
                        <!-- End Item -->

                        <!-- Item -->
                        <div class="flex gap-x-5 ms-1">
                            <!-- Icon -->
                            <div
                                class="relative last:after:hidden after:absolute after:top-8 after:bottom-0 after:start-4 after:w-px after:-translate-x-[0.5px] after:bg-neutral-800">
                                <div class="relative z-10 size-8 flex justify-center items-center">
                                    <span
                                        class="flex flex-shrink-0 justify-center items-center size-8 border border-neutral-800 text-primary-500 font-semibold text-xs uppercase rounded-full">
                                        3
                                    </span>
                                </div>
                            </div>
                            <!-- End Icon -->

                            <!-- Right Content -->
                            <div class="grow pt-0.5 pb-8 sm:pb-12">
                                <p class="text-sm md:text-base text-neutral-400">
                                    <span class="text-white">{{ __('Marketing and Promotion:') }}   </span>
                                    {{ __('Develop a comprehensive marketing strategy to promote your digital products or services.') }}
                                </p>
                            </div>
                            <!-- End Right Content -->
                        </div>
                        <!-- End Item -->

                        <!-- Item -->
                        <div class="flex gap-x-5 ms-1">
                            <!-- Icon -->
                            <div
                                class="relative last:after:hidden after:absolute after:top-8 after:bottom-0 after:start-4 after:w-px after:-translate-x-[0.5px] after:bg-neutral-800">
                                <div class="relative z-10 size-8 flex justify-center items-center">
                                    <span
                                        class="flex flex-shrink-0 justify-center items-center size-8 border border-neutral-800 text-primary-500 font-semibold text-xs uppercase rounded-full">
                                        4
                                    </span>
                                </div>
                            </div>
                            <!-- End Icon -->

                            <!-- Right Content -->
                            <div class="grow pt-0.5 pb-8 sm:pb-12">
                                <p class="text-sm md:text-base text-neutral-400">
                                    <span class="text-white">{{ __('Launch and Optimization:') }}</span>
                                    {{ __('Launch your digital products or services to the market, closely monitoring their performance and user feedback.') }}
                                </p>
                            </div>
                            <!-- End Right Content -->
                        </div>
                        <!-- End Item -->

                        <a class="group inline-flex items-center gap-x-2 py-2 px-3 bg-primary-500 font-medium text-sm text-neutral-800 rounded-full focus:outline-none"
                            href="#">
                            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                </path>
                                <path
                                    class="opacity-0 group-hover:opacity-100 group-focus:opacity-100 group-hover:delay-100 transition"
                                    d="M14.05 2a9 9 0 0 1 8 7.94"></path>
                                <path class="opacity-0 group-hover:opacity-100 group-focus:opacity-100 transition"
                                    d="M14.05 6A5 5 0 0 1 18 10"></path>
                            </svg>
                            {{ __('Schedule a call') }}
                        </a>
                    </div>
                    <!-- End Timeline -->
                </div>
                <!-- End Grid -->
            </div>
        </div>
        <!-- End Approach -->

        <!-- Contact -->
        <section>
            <div class="container px-4 xl:px-0 py-10 lg:py-20 mx-auto">
                <!-- Title -->
                <div class="max-w-3xl mb-10 lg:mb-14">
                    <h2 class="text-white font-semibold text-2xl md:text-4xl md:leading-tight">
                        {{ __('Contact us') }}
                    </h2>
                    <p class="mt-1 text-neutral-400">
                        {{ __('Whatever your goal - we will get you there.') }}
                    </p>
                </div>
                <!-- End Title -->

                <!-- Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 lg:gap-x-16">
                    <div class="md:order-2 bg-white/10 p-8 rounded-lg border border-white/30 mb-10">
                        <form>
                            <div class="space-y-4">
                                <!-- Input -->
                                <div class="relative">
                                    <input type="text" id="hs-tac-input-name"
                                        class="peer p-4 block w-full bg-neutral-800 border-transparent rounded-lg text-sm text-white placeholder:text-transparent focus:outline-none focus:ring-0 focus:border-transparent disabled:opacity-50 disabled:pointer-events-none
                  focus:pt-6
                  focus:pb-2
                  [&:not(:placeholder-shown)]:pt-6
                  [&:not(:placeholder-shown)]:pb-2
                  autofill:pt-6
                  autofill:pb-2"
                                        placeholder="Name">
                                    <label for="hs-tac-input-name"
                                        class="absolute top-0 start-0 p-4 h-full text-neutral-400 text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent peer-disabled:opacity-50 peer-disabled:pointer-events-none
                    peer-focus:text-xs
                    peer-focus:-translate-y-1.5
                    peer-focus:text-neutral-400
                    peer-[:not(:placeholder-shown)]:text-xs
                    peer-[:not(:placeholder-shown)]:-translate-y-1.5
                    peer-[:not(:placeholder-shown)]:text-neutral-400">
                                        {{ __('Name') }}
                                    </label>
                                </div>
                                <!-- End Input -->

                                <!-- Input -->
                                <div class="relative">
                                    <input type="email" id="hs-tac-input-email"
                                        class="peer p-4 block w-full bg-neutral-800 border-transparent rounded-lg text-sm text-white placeholder:text-transparent focus:outline-none focus:ring-0 focus:border-transparent disabled:opacity-50 disabled:pointer-events-none
                  focus:pt-6
                  focus:pb-2
                  [&:not(:placeholder-shown)]:pt-6
                  [&:not(:placeholder-shown)]:pb-2
                  autofill:pt-6
                  autofill:pb-2"
                                        placeholder="Email">
                                    <label for="hs-tac-input-email"
                                        class="absolute top-0 start-0 p-4 h-full text-neutral-400 text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent peer-disabled:opacity-50 peer-disabled:pointer-events-none
                    peer-focus:text-xs
                    peer-focus:-translate-y-1.5
                    peer-focus:text-neutral-400
                    peer-[:not(:placeholder-shown)]:text-xs
                    peer-[:not(:placeholder-shown)]:-translate-y-1.5
                    peer-[:not(:placeholder-shown)]:text-neutral-400">
                                        {{ __('Email') }}
                                    </label>
                                </div>
                                <!-- End Input -->

                                <!-- Input -->
                                <div class="relative">
                                    <input type="text" id="hs-tac-input-company"
                                        class="peer p-4 block w-full bg-neutral-800 border-transparent rounded-lg text-sm text-white placeholder:text-transparent focus:outline-none focus:ring-0 focus:border-transparent disabled:opacity-50 disabled:pointer-events-none
                  focus:pt-6
                  focus:pb-2
                  [&:not(:placeholder-shown)]:pt-6
                  [&:not(:placeholder-shown)]:pb-2
                  autofill:pt-6
                  autofill:pb-2"
                                        placeholder="Company">
                                    <label for="hs-tac-input-company"
                                        class="absolute top-0 start-0 p-4 h-full text-neutral-400 text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent peer-disabled:opacity-50 peer-disabled:pointer-events-none
                    peer-focus:text-xs
                    peer-focus:-translate-y-1.5
                    peer-focus:text-neutral-400
                    peer-[:not(:placeholder-shown)]:text-xs
                    peer-[:not(:placeholder-shown)]:-translate-y-1.5
                    peer-[:not(:placeholder-shown)]:text-neutral-400">
                                        {{ __('Company') }}
                                    </label>
                                </div>
                                <!-- End Input -->

                                <!-- Input -->
                                <div class="relative">
                                    <input type="text" id="hs-tac-input-phone"
                                        class="peer p-4 block w-full bg-neutral-800 border-transparent rounded-lg text-sm text-white placeholder:text-transparent focus:outline-none focus:ring-0 focus:border-transparent disabled:opacity-50 disabled:pointer-events-none
                  focus:pt-6
                  focus:pb-2
                  [&:not(:placeholder-shown)]:pt-6
                  [&:not(:placeholder-shown)]:pb-2
                  autofill:pt-6
                  autofill:pb-2"
                                        placeholder="Phone">
                                    <label for="hs-tac-input-phone"
                                        class="absolute top-0 start-0 p-4 h-full text-neutral-400 text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent peer-disabled:opacity-50 peer-disabled:pointer-events-none
                    peer-focus:text-xs
                    peer-focus:-translate-y-1.5
                    peer-focus:text-neutral-400
                    peer-[:not(:placeholder-shown)]:text-xs
                    peer-[:not(:placeholder-shown)]:-translate-y-1.5
                    peer-[:not(:placeholder-shown)]:text-neutral-400">
                                        {{ __('Phone') }}
                                    </label>
                                </div>
                                <!-- End Input -->

                                <!-- Textarea -->
                                <div class="relative">
                                    <textarea id="hs-tac-message"
                                        class="peer p-4 block w-full bg-neutral-800 border-transparent rounded-lg text-sm text-white placeholder:text-transparent focus:outline-none focus:ring-0 focus:border-transparent disabled:opacity-50 disabled:pointer-events-none
                  focus:pt-6
                  focus:pb-2
                  [&:not(:placeholder-shown)]:pt-6
                  [&:not(:placeholder-shown)]:pb-2
                  autofill:pt-6
                  autofill:pb-2"
                                        placeholder="This is a textarea placeholder"></textarea>
                                    <label for="hs-tac-message"
                                        class="absolute top-0 start-0 p-4 h-full text-neutral-400 text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent peer-disabled:opacity-50 peer-disabled:pointer-events-none
                    peer-focus:text-xs
                    peer-focus:-translate-y-1.5
                    peer-focus:text-neutral-400
                    peer-[:not(:placeholder-shown)]:text-xs
                    peer-[:not(:placeholder-shown)]:-translate-y-1.5
                    peer-[:not(:placeholder-shown)]:text-neutral-400">
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
                                    <a class="group inline-flex items-center gap-x-2 py-2 px-3 bg-primary-500 font-medium text-sm text-neutral-800 rounded-full focus:outline-none"
                                        href="#">
                                        {{ __('Submit') }}
                                        <svg class="flex-shrink-0 size-4 transition group-hover:translate-x-0.5 group-hover:translate-x-0 group-focus:translate-x-0.5 group-focus:translate-x-0"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M5 12h14" />
                                            <path d="m12 5 7 7-7 7" />
                                        </svg>
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                    <!-- End Col -->

                    <div class="space-y-14">
                        <!-- Item -->
                        <div class="flex gap-x-5">
                            <svg class="flex-shrink-0 size-6 text-neutral-500" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                            <div class="grow">
                                <h4 class="text-white font-semibold">
                                    {{ __('Our address:') }}
                                </h4>

                                <address class="mt-1 text-neutral-400 text-sm not-italic">
                                    {{ __('300 Bath Street, Tay House') }}<br>
                                    {{ __('Glasgow G2 4JR, United Kingdom') }}
                                </address>
                            </div>
                        </div>
                        <!-- End Item -->

                        <!-- Item -->
                        <div class="flex gap-x-5">
                            <svg class="flex-shrink-0 size-6 text-neutral-500" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M21.2 8.4c.5.38.8.97.8 1.6v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V10a2 2 0 0 1 .8-1.6l8-6a2 2 0 0 1 2.4 0l8 6Z" />
                                <path d="m22 10-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 10" />
                            </svg>
                            <div class="grow">
                                <h4 class="text-white font-semibold">
                                    {{ __('Email us:') }}
                                </h4>

                                <a class="mt-1 text-neutral-400 text-sm" href="#mailto:example@site.co"
                                    target="_blank">
                                    hello@example.so
                                </a>
                            </div>
                        </div>
                        <!-- End Item -->

                        <!-- Item -->
                        <div class="flex gap-x-5">
                            <svg class="flex-shrink-0 size-6 text-neutral-500" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="m3 11 18-5v12L3 14v-3z" />
                                <path d="M11.6 16.8a3 3 0 1 1-5.8-1.6" />
                            </svg>
                            <div class="grow">
                                <h4 class="text-white font-semibold">
                                    {{ __('We\'re hiring') }}
                                </h4>
                                <p class="mt-1 text-neutral-400">
                                    {{ __('We\'re thrilled to announce that we\'re expanding our team and looking for talented individuals like you to join us.') }}
                                </p>
                                <p class="mt-2">
                                    <a class="group inline-flex items-center gap-x-2 font-medium text-sm text-primary-500 decoration-2 hover:underline focus:outline-none focus:underline"
                                        href="#">
                                        {{ __('Job openings') }}
                                        <svg class="flex-shrink-0 size-4 transition group-hover:translate-x-0.5 group-hover:translate-x-0 group-focus:translate-x-0.5 group-focus:translate-x-0"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
        <!-- End Contact -->
        <section>
            <div class="container mx-auto py-24">
                <h2 class="text-4xl text-white my-8 text-center">
                    {{ __('Our Pricing') }}
                </h2>
                <div class="px-8 py-6 border border-white/30 rounded-xl bg-white/10 backdrop-blur max-w-6xl mx-auto">
                    <div class="space-y-2 mb-8">
                        <h1 class="text-2xl md:text-3xl font-semibold text-white">
                            {{ __('The biggest ever Black Friday sale!') }}
                        </h1>
                        <p class="text-white/90">
                            {{ __('You\'ll love these great deals that were handpicked just for you.') }}
                        </p>
                    </div>

                    <div class="grid md:grid-cols-3 gap-6">
                        <!-- Pricing Plan -->
                        <div class="bg-black rounded-lg p-6">
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
                                class="w-full py-2 px-4 bg-primary-500 bg-opacity-10 rounded-md hover:bg-opacity-20 transition-colors">
                                Get deal
                            </button>
                        </div>
                        <!-- Pricing Plan -->
                        <div class="bg-black rounded-lg p-6">
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
                                class="w-full py-2 px-4 bg-primary-500 bg-opacity-10 rounded-md hover:bg-opacity-20 transition-colors">
                                Get deal
                            </button>
                        </div>
                        <!-- Pricing Plan -->
                        <div class="bg-black rounded-lg p-6">
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
                                class="w-full py-2 px-4 bg-primary-500 bg-opacity-10 rounded-md hover:bg-opacity-20 transition-colors">
                                Get deal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- ========== END MAIN CONTENT ========== -->

    <!-- ========== FOOTER ========== -->
    <footer class="relative overflow-hidden bg-neutral-900">
        <svg class="absolute -bottom-20 start-1/2 w-[1900px] transform -translate-x-1/2" width="2745"
            height="488" viewBox="0 0 2745 488" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M0.5 330.864C232.505 403.801 853.749 527.683 1482.69 439.719C2111.63 351.756 2585.54 434.588 2743.87 487"
                class="stroke-neutral-700/50" stroke="currentColor" />
            <path
                d="M0.5 308.873C232.505 381.81 853.749 505.692 1482.69 417.728C2111.63 329.765 2585.54 412.597 2743.87 465.009"
                class="stroke-neutral-700/50" stroke="currentColor" />
            <path
                d="M0.5 286.882C232.505 359.819 853.749 483.701 1482.69 395.738C2111.63 307.774 2585.54 390.606 2743.87 443.018"
                class="stroke-neutral-700/50" stroke="currentColor" />
            <path
                d="M0.5 264.891C232.505 337.828 853.749 461.71 1482.69 373.747C2111.63 285.783 2585.54 368.615 2743.87 421.027"
                class="stroke-neutral-700/50" stroke="currentColor" />
            <path
                d="M0.5 242.9C232.505 315.837 853.749 439.719 1482.69 351.756C2111.63 263.792 2585.54 346.624 2743.87 399.036"
                class="stroke-neutral-700/50" stroke="currentColor" />
            <path
                d="M0.5 220.909C232.505 293.846 853.749 417.728 1482.69 329.765C2111.63 241.801 2585.54 324.633 2743.87 377.045"
                class="stroke-neutral-700/50" stroke="currentColor" />
            <path
                d="M0.5 198.918C232.505 271.855 853.749 395.737 1482.69 307.774C2111.63 219.81 2585.54 302.642 2743.87 355.054"
                class="stroke-neutral-700/50" stroke="currentColor" />
            <path
                d="M0.5 176.927C232.505 249.864 853.749 373.746 1482.69 285.783C2111.63 197.819 2585.54 280.651 2743.87 333.063"
                class="stroke-neutral-700/50" stroke="currentColor" />
            <path
                d="M0.5 154.937C232.505 227.873 853.749 351.756 1482.69 263.792C2111.63 175.828 2585.54 258.661 2743.87 311.072"
                class="stroke-neutral-700/50" stroke="currentColor" />
            <path
                d="M0.5 132.946C232.505 205.882 853.749 329.765 1482.69 241.801C2111.63 153.837 2585.54 236.67 2743.87 289.082"
                class="stroke-neutral-700/50" stroke="currentColor" />
            <path
                d="M0.5 110.955C232.505 183.891 853.749 307.774 1482.69 219.81C2111.63 131.846 2585.54 214.679 2743.87 267.091"
                class="stroke-neutral-700/50" stroke="currentColor" />
            <path
                d="M0.5 88.9639C232.505 161.901 853.749 285.783 1482.69 197.819C2111.63 109.855 2585.54 192.688 2743.87 245.1"
                class="stroke-neutral-700/50" stroke="currentColor" />
            <path
                d="M0.5 66.9729C232.505 139.91 853.749 263.792 1482.69 175.828C2111.63 87.8643 2585.54 170.697 2743.87 223.109"
                class="stroke-neutral-700/50" stroke="currentColor" />
            <path
                d="M0.5 44.9819C232.505 117.919 853.749 241.801 1482.69 153.837C2111.63 65.8733 2585.54 148.706 2743.87 201.118"
                class="stroke-neutral-700/50" stroke="currentColor" />
            <path
                d="M0.5 22.991C232.505 95.9276 853.749 219.81 1482.69 131.846C2111.63 43.8824 2585.54 126.715 2743.87 179.127"
                class="stroke-neutral-700/50" stroke="currentColor" />
            <path
                d="M0.5 1C232.505 73.9367 853.749 197.819 1482.69 109.855C2111.63 21.8914 2585.54 104.724 2743.87 157.136"
                class="stroke-neutral-700/50" stroke="currentColor" />
        </svg>

        <div class="relative z-10">
            <div class="w-full container px-4 xl:px-0 py-10 lg:pt-16 mx-auto">
                <div class="inline-flex items-center">
                    <!-- Logo -->
                    <svg class="w-24 h-auto" width="116" height="32" viewBox="0 0 116 32" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M33.5696 30.8182V11.3182H37.4474V13.7003H37.6229C37.7952 13.3187 38.0445 12.9309 38.3707 12.5369C38.7031 12.1368 39.134 11.8045 39.6634 11.5398C40.1989 11.2689 40.8636 11.1335 41.6577 11.1335C42.6918 11.1335 43.6458 11.4044 44.5199 11.946C45.3939 12.4815 46.0926 13.291 46.6158 14.3743C47.139 15.4515 47.4006 16.8026 47.4006 18.4276C47.4006 20.0095 47.1451 21.3452 46.6342 22.4347C46.1295 23.518 45.4401 24.3397 44.5661 24.8999C43.6982 25.4538 42.7256 25.7308 41.6484 25.7308C40.8852 25.7308 40.2358 25.6046 39.7003 25.3523C39.1709 25.0999 38.737 24.7829 38.3984 24.4013C38.0599 24.0135 37.8014 23.6226 37.6229 23.2287H37.5028V30.8182H33.5696ZM37.4197 18.4091C37.4197 19.2524 37.5367 19.9879 37.7706 20.6158C38.0045 21.2436 38.343 21.733 38.7862 22.0838C39.2294 22.4285 39.768 22.6009 40.402 22.6009C41.0421 22.6009 41.5838 22.4254 42.027 22.0746C42.4702 21.7176 42.8056 21.2251 43.0334 20.5973C43.2673 19.9633 43.3842 19.2339 43.3842 18.4091C43.3842 17.5904 43.2704 16.8703 43.0426 16.2486C42.8149 15.6269 42.4794 15.1406 42.0362 14.7898C41.593 14.4389 41.0483 14.2635 40.402 14.2635C39.7618 14.2635 39.2202 14.4328 38.777 14.7713C38.34 15.1098 38.0045 15.59 37.7706 16.2116C37.5367 16.8333 37.4197 17.5658 37.4197 18.4091ZM49.2427 25.5V11.3182H53.0559V13.7926H53.2037C53.4622 12.9124 53.8961 12.2476 54.5055 11.7983C55.1149 11.3428 55.8166 11.1151 56.6106 11.1151C56.8076 11.1151 57.02 11.1274 57.2477 11.152C57.4754 11.1766 57.6755 11.2105 57.8478 11.2536V14.7436C57.6632 14.6882 57.4077 14.639 57.0815 14.5959C56.7553 14.5528 56.4567 14.5312 56.1859 14.5312C55.6073 14.5312 55.0903 14.6574 54.6348 14.9098C54.1854 15.156 53.8284 15.5007 53.5638 15.9439C53.3052 16.3871 53.176 16.898 53.176 17.4766V25.5H49.2427ZM64.9043 25.777C63.4455 25.777 62.1898 25.4815 61.1373 24.8906C60.0909 24.2936 59.2845 23.4503 58.7182 22.3608C58.1519 21.2652 57.8688 19.9695 57.8688 18.4737C57.8688 17.0149 58.1519 15.7346 58.7182 14.6328C59.2845 13.531 60.0816 12.6723 61.1096 12.0568C62.1437 11.4413 63.3563 11.1335 64.7474 11.1335C65.683 11.1335 66.5539 11.2843 67.3603 11.5859C68.1728 11.8814 68.8806 12.3277 69.4839 12.9247C70.0932 13.5218 70.5672 14.2727 70.9057 15.1776C71.2443 16.0762 71.4135 17.1288 71.4135 18.3352V19.4155H59.4384V16.978H67.7111C67.7111 16.4117 67.588 15.91 67.3418 15.473C67.0956 15.036 66.754 14.6944 66.317 14.4482C65.8861 14.1958 65.3844 14.0696 64.812 14.0696C64.2149 14.0696 63.6856 14.2081 63.2239 14.4851C62.7684 14.7559 62.4114 15.1222 62.1529 15.5838C61.8944 16.0393 61.762 16.5471 61.7559 17.1072V19.4247C61.7559 20.1264 61.8851 20.7327 62.1437 21.2436C62.4083 21.7545 62.7807 22.1484 63.2608 22.4254C63.741 22.7024 64.3103 22.8409 64.9689 22.8409C65.406 22.8409 65.8061 22.7794 66.1692 22.6562C66.5324 22.5331 66.8432 22.3485 67.1018 22.1023C67.3603 21.8561 67.5572 21.5545 67.6927 21.1974L71.3304 21.4375C71.1458 22.3116 70.7672 23.0748 70.1948 23.7273C69.6285 24.3736 68.896 24.8783 67.9974 25.2415C67.1048 25.5985 66.0738 25.777 64.9043 25.777ZM77.1335 6.59091V25.5H73.2003V6.59091H77.1335ZM79.5043 25.5V11.3182H83.4375V25.5H79.5043ZM81.4801 9.49006C80.8954 9.49006 80.3937 9.29616 79.9752 8.90838C79.5628 8.51444 79.3566 8.04356 79.3566 7.49574C79.3566 6.95407 79.5628 6.48935 79.9752 6.10156C80.3937 5.70762 80.8954 5.51065 81.4801 5.51065C82.0649 5.51065 82.5635 5.70762 82.9759 6.10156C83.3944 6.48935 83.6037 6.95407 83.6037 7.49574C83.6037 8.04356 83.3944 8.51444 82.9759 8.90838C82.5635 9.29616 82.0649 9.49006 81.4801 9.49006ZM89.7415 17.3011V25.5H85.8083V11.3182H89.5569V13.8203H89.723C90.037 12.9955 90.5632 12.343 91.3019 11.8629C92.0405 11.3767 92.9361 11.1335 93.9887 11.1335C94.9735 11.1335 95.8322 11.349 96.5647 11.7798C97.2971 12.2107 97.8665 12.8262 98.2728 13.6264C98.679 14.4205 98.8821 15.3684 98.8821 16.4702V25.5H94.9489V17.1719C94.9551 16.304 94.7335 15.6269 94.2841 15.1406C93.8348 14.6482 93.2162 14.402 92.4283 14.402C91.8989 14.402 91.4311 14.5159 91.0249 14.7436C90.6248 14.9714 90.3109 15.3037 90.0831 15.7408C89.8615 16.1716 89.7477 16.6918 89.7415 17.3011ZM107.665 25.777C106.206 25.777 104.951 25.4815 103.898 24.8906C102.852 24.2936 102.045 23.4503 101.479 22.3608C100.913 21.2652 100.63 19.9695 100.63 18.4737C100.63 17.0149 100.913 15.7346 101.479 14.6328C102.045 13.531 102.842 12.6723 103.87 12.0568C104.905 11.4413 106.117 11.1335 107.508 11.1335C108.444 11.1335 109.315 11.2843 110.121 11.5859C110.934 11.8814 111.641 12.3277 112.245 12.9247C112.854 13.5218 113.328 14.2727 113.667 15.1776C114.005 16.0762 114.174 17.1288 114.174 18.3352V19.4155H102.199V16.978H110.472C110.472 16.4117 110.349 15.91 110.103 15.473C109.856 15.036 109.515 14.6944 109.078 14.4482C108.647 14.1958 108.145 14.0696 107.573 14.0696C106.976 14.0696 106.446 14.2081 105.985 14.4851C105.529 14.7559 105.172 15.1222 104.914 15.5838C104.655 16.0393 104.523 16.5471 104.517 17.1072V19.4247C104.517 20.1264 104.646 20.7327 104.905 21.2436C105.169 21.7545 105.542 22.1484 106.022 22.4254C106.502 22.7024 107.071 22.8409 107.73 22.8409C108.167 22.8409 108.567 22.7794 108.93 22.6562C109.293 22.5331 109.604 22.3485 109.863 22.1023C110.121 21.8561 110.318 21.5545 110.454 21.1974L114.091 21.4375C113.907 22.3116 113.528 23.0748 112.956 23.7273C112.389 24.3736 111.657 24.8783 110.758 25.2415C109.866 25.5985 108.835 25.777 107.665 25.777Z"
                            class="fill-white" fill="currentColor" />
                        <path
                            d="M1 29.5V16.5C1 9.87258 6.37258 4.5 13 4.5C19.6274 4.5 25 9.87258 25 16.5C25 23.1274 19.6274 28.5 13 28.5H12"
                            class="stroke-white" stroke="currentColor" stroke-width="2" />
                        <path
                            d="M5 29.5V16.66C5 12.1534 8.58172 8.5 13 8.5C17.4183 8.5 21 12.1534 21 16.66C21 21.1666 17.4183 24.82 13 24.82H12"
                            class="stroke-white" stroke="currentColor" stroke-width="2" />
                        <circle cx="13" cy="16.5214" r="5" class="fill-white" fill="currentColor" />
                    </svg>
                    <!-- End Logo -->

                    <div class="border-s border-neutral-700 ps-5 ms-5">
                        <p class="text-sm text-neutral-400">
                            {{ date('Y') }} {{ __('Timesheet Co.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ========== END FOOTER ========== -->

    <!-- JS Implementing Plugins -->

    <!-- JS PLUGINS -->
    <!-- Required plugins -->
    <script src="https://cdn.jsdelivr.net/npm/preline/dist/preline.min.js"></script>

    <!-- JS INITIALIZATIONS -->
    <script>
        (function() {
            function textareaAutoHeight(el, offsetTop = 0) {
                el.style.height = 'auto';
                el.style.height = `${el.scrollHeight + offsetTop}px`;
            }

            (function() {
                const textareas = [
                    '#hs-tac-message'
                ];

                textareas.forEach((el) => {
                    const textarea = document.querySelector(el);
                    const overlay = textarea.closest('.hs-overlay');

                    if (overlay) {
                        const {
                            element
                        } = HSOverlay.getInstance(overlay, true);

                        element.on('open', () => textareaAutoHeight(textarea, 3));
                    } else textareaAutoHeight(textarea, 3);

                    textarea.addEventListener('input', () => {
                        textareaAutoHeight(textarea, 3);
                    });
                });
            })();
        })()
    </script>
</body>

</html>
