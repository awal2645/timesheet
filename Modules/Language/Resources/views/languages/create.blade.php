@section('title', 'Add Language')

<x-app-layout>
    <div class="flex justify-between items-center m-6 card">
        <h2 class="text-xl font-medium text-text-light dark:text-text-dark">{{ __('Add Language') }}</h2>
        <a href="{{ route('languages.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            {{ __('Back') }}
        </a>
    </div>

    <div class="m-6 card">
        @if($errors->any())
            <div class="mb-4">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ $errors->first() }}</span>
                </div>
            </div>
        @endif

        <form action="{{ route('languages.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Language') }}</label>
                    <select name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="">{{ __('Select Language') }}</option>
                        @foreach($translations as $code => $translation)
                            <option value="{{ $code }}" {{ old('name') == $code ? 'selected' : '' }}>
                                {{ $translation['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="icon" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Flag') }}</label>
                    <select name="icon" id="icon" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="">{{ __('Select Flag') }}</option>
                        @foreach($translations as $code => $translation)
                            <option value="flag-icon-{{ $code }}" {{ old('icon') == "flag-icon-{$code}" ? 'selected' : '' }}>
                                {{ $translation['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="direction" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Direction') }}</label>
                    <select name="direction" id="direction" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="">{{ __('Select Direction') }}</option>
                        <option value="ltr" {{ old('direction') == 'ltr' ? 'selected' : '' }}>{{ __('Left to Right') }}</option>
                        <option value="rtl" {{ old('direction') == 'rtl' ? 'selected' : '' }}>{{ __('Right to Left') }}</option>
                    </select>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        {{ __('Add Language') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout> 