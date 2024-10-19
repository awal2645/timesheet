<x-authentication-layout>
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif
    <!-- Form -->
    <h2 class="text-2xl font-bold mb-6 text-white">Login</h2>
    <form method="POST" action="{{ route('login') }}" class="text-white">
        @csrf
        <div class="space-y-4">
            <div>
                <x-label for="email" value="{{ __('Email/Username') }}" />
                <x-input id="email" type="text" name="username" :value="old('email')" required autofocus />
            </div>
            <div>
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" type="password" name="password" required autocomplete="current-password" />
            </div>
        </div>
        <div class="flex flex-col gap-3 mt-6">
            @if (Route::has('password.request'))
                <a class="text-base font-medium text-white/90 hover:text-white no-underline hover:underline" href="{{ route('password.request') }}">
                    {{ __('Forgot Password?') }}
                </a>
            @endif
            <x-button class="bg-violet-600 hover:bg-violet-700">
                {{ __('Sign in') }}
            </x-button>
        </div>
    </form>
    <div class="mt-6 grid grid-cols-2 gap-4">
        <button
            class="w-full border border-teal-900 text-white font-bold py-2 px-4 rounded bg-teal-800 hover:bg-teal-900">Super
            Admin Login</button>
        <button
            class="w-full border border-teal-900 text-white font-bold py-2 px-4 rounded bg-teal-800 hover:bg-teal-900">Company
            Login</button>
        <button
            class="w-full border border-teal-900 text-white font-bold py-2 px-4 rounded bg-teal-800 hover:bg-teal-900">User
            Login</button>
        <button
            class="w-full border border-teal-900 text-white font-bold py-2 px-4 rounded bg-teal-800 hover:bg-teal-900">Client
            Login</button>
    </div>
    <x-validation-errors class="mt-4" />
    <!-- Footer -->
    <!-- <div class="pt-5 mt-6 border-t border-slate-200 dark:border-slate-700">
        <div class="text-sm">
            {{ __('Don\'t you have an account?') }} <a class="font-medium text-[#0b4dc4] hover:text-[#1da8f7]" href="{{ route('register') }}">{{ __('Sign Up') }}</a>
        </div>

    </div> -->
</x-authentication-layout>
