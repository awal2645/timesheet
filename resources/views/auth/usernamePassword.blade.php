<x-authentication-layout>
    <h1 class="text-3xl text-slate-800 dark:text-slate-100 font-bold mb-6">{{ __('Create your Account') }} ✨</h1>
    <!-- Form -->
    <form method="POST" action="{{ route('update.info') }}">
        @csrf
        @method('PUT')
        <div class="space-y-4">
            <div>
                <input type="hidden" name="token" value="{{request('token')}}">
                <x-label for="name">{{ __('User Name') }} <span class="text-rose-500">*</span></x-label>
                <x-input id="name" type="text" name="username" value="{{old('username')}}" required autofocus autocomplete="name" />
            </div>
            <div>
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div>
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>
        </div>
        <div class="flex items-center justify-between mt-6">
            <x-button>
                {{ __('Sign Up') }}
            </x-button>                
        </div>     
    </form>
    <x-validation-errors class="mt-4" />  
</x-authentication-layout>
