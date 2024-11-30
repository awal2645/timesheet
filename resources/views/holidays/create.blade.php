@section('title')
    {{ __('Create Holiday') }}
@endsection
<x-app-layout>
    <div class="flex justify-between m-6 card">
        <h2 class="text-xl font-medium">{{ __('Create Holiday') }}</h2>
        <a href="{{ route('holidays.index') }}"
            class="btn bg-primary-300 dark:bg-primary-900 text-white">{{ __('Go to Holiday List') }}</a>
    </div>
    <div class="card m-6">
        <h2 class="text-2xl font-bold mb-4">{{ __('Create New Holiday') }}</h2>
        <form method="POST" action="{{ route('holidays.store') }}">
            @csrf
            <!-- Holiday Name -->
            <div class="form-field">
                <input type="text" name="name" id="name" placeholder=" " required
                    value="{{ old('name') }}" />
                <label for="name" class="">{{ __('Holiday Name') }}</label>
                @error('name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Holiday Date -->
            <div class="form-field">
                <input type="date" name="date" id="date" required value="{{ old('date') }}" onclick="this.showPicker()" />
                <label for="date" class="">{{ __('Holiday Date') }}</label>
                @error('date')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit"
                class="text-white bg-primary-300 dark:bg-primary-900 hover:bg-primary-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">{{ __('Submit') }}</button>
        </form>
    </div>
</x-app-layout>
