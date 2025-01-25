<x-authentication-layout>
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif
    <!-- Form -->
    <h2 class="text-2xl font-bold mb-6  text-text-light dark:text-text-dark">{{ __('Login') }}</h2>
    <form method="POST" action="{{ route('login') }}" class="text-text-light dark:text-text-dark" >
        @csrf
        <div class="space-y-4">
            <div>
                <x-label for="email" value="{{ __('Email/Username') }}" />
                <x-input id="email" type="text" name="username" :value="old('email')" required autofocus />
            </div>
            <div>
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password1" type="password" name="password" required autocomplete="current-password" />
            </div>
        </div>
        <div class="flex flex-col gap-3 mt-6">
            @if (Route::has('password.request'))
                <a class="text-base font-medium text-text-light dark:text-text-dark hover:text-text-light dark:hover:text-text-dark no-underline hover:underline"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot Password?') }}
                </a>
            @endif
            <button type="submit" class="btn bg-primary-50  text-text-light dark:text-text-dark">
                {{ __('Sign in') }}
            </button>
        </div>
    </form>
    @if (env('APP_MODE') === 'demo')
        <form id="login-form" action="{{ route('login') }}" method="POST" class="hidden">
            @csrf
            <input type="hidden" id="username" name="username">
            <input type="hidden" id="password" name="password" value="123456">
        </form>

        <div class="mt-6 grid grid-cols-2 gap-4">
            <button onclick="submitLoginForm('superadmin')"
                class="w-full text-text-light dark:text-text-dark bg-primary-500 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-50 dark:hover:bg-primary-50 dark:focus:ring-primary-800">
                {{ __('Super Admin Login') }}</button>
            <button onclick="submitLoginForm('employer')"
                class="w-full full text-text-light dark:text-text-dark bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800">
                {{ __('Employer Login') }}
            </button>
            <button onclick="submitLoginForm('employee')"
                class="w-full text-text-light dark:text-text-dark bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-purple-600 dark:hover:bg-purple-500 dark:focus:ring-purple-800">
                {{ __('Employee Login') }}
            </button>
            <button onclick="submitLoginForm('client')"
                class="w-full text-text-light dark:text-text-dark bg-amber-600 hover:bg-amber-700 focus:ring-4 focus:outline-none focus:ring-amber-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-amber-500 dark:hover:bg-amber-600 dark:focus:ring-amber-800">
                {{ __('Client Login') }}

            </button>
    @endif


    </div>
    <x-validation-errors class="mt-4" />
</x-authentication-layout>
