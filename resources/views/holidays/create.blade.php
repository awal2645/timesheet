@section('title')
    {{ __('Create Holiday') }}
@endsection
<x-app-layout>
    <div
        class="flex justify-between m-8 bg-white/10 px-8 py-4 rounded-lg border border-black/10 dark:border-white/10 dark:bg-black/10 backdrop-blur">
        <h2 class="text-xl font-medium">{{ __('Create Holiday') }}</h2>
        <a href="{{ route('holidays.index') }}"
            class="btn bg-purple-500 dark:bg-purple-900 text-white">{{ __('Go to Holiday List') }}</a>
    </div>
    <div
        class="m-8 p-6 bg-white/10 backdrop-blur border border-black/10 dark:bg-black/10 dark:border-white/10 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">{{ __('Create New Holiday') }}</h2>
        <form method="POST" action="{{ route('holidays.store') }}">
            @csrf
            <!-- Holiday Name -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="name" id="name"
                    class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                    placeholder=" " required value="{{ old('name') }}" />
                <label for="name"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-purple-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('Holiday Name') }}</label>
                @error('name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Holiday Date -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="date" name="date" id="date"
                    class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                    required value="{{ old('date') }}" />
                <label for="date"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-purple-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('Holiday Date') }}</label>
                @error('date')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit"
                class="text-white bg-purple-500 dark:bg-purple-900 hover:bg-purple-600 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">{{ __('Submit') }}</button>
        </form>
    </div>
</x-app-layout>
