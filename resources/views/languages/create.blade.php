@section('title', __('Create Language'))

<x-app-layout>
    <div class="m-6">
        <div class="flex justify-between card mb-12">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ __('Create Language') }}</h2>
            <a href="{{ route('languages.index') }}"
                class="btn bg-primary-50 dark:bg-primary-50 text-text-light dark:text-text-dark hover:bg-primary-50 rounded-lg px-4 py-2">
                {{ __('Go to Language List') }}
            </a>
        </div>
        @if ($errors->any())
            <span class="text-red-500">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </span>
        @endif
        <div class="card">
            <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-200">{{ __('Create New Language') }}</h2>
            <form method="POST" action="{{ route('languages.store') }}">
                @csrf

                <div class="flex gap-6 items-center">
                    <!-- Language Name -->
                    <div class="sm:w-1/2 w-full">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Language Name') }}
                        </label>
                        <select name="name"
                            class="max-h-[200px] overflow-y-auto w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white focus:ring-primary-500 focus:border-primary-500">
                            @foreach ($translations as $key => $country)
                                <option {{ old('name') == $country['name'] ? 'selected' : '' }}
                                    value="{{ $country['code'] }}">
                                    {{ $country['name'] }}
                                </option>
                            @endforeach
                        </select>
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Language Direction -->
                    <div class="sm:w-1/2 w-full">
                        <label for="direction" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Direction') }}
                        </label>
                        <select name="direction" id="direction"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white focus:ring-primary-500 focus:border-primary-500">
                            <option value="ltr" {{ old('direction') == 'ltr' ? 'selected' : '' }}>
                                {{ __('Left to Right') }}
                            </option>
                            <option value="rtl" {{ old('direction') == 'rtl' ? 'selected' : '' }}>
                                {{ __('Right to Left') }}
                            </option>
                        </select>
                        @error('direction')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Language Icon -->
                <div class="max-w-max my-6">
                    <label for="icon" class="block mb-6 text-sm font-medium text-gray-700 dark:text-gray-300">
                        {{ __('Select Flag Icon') }}
                        <p class="text-xs text-red-500 dark:text-red-400">
                            {{ __('Note: Locate the flag icon to search for the country code, e.g., US.') }}
                        </p>
                    </label>
                    <input type="hidden" name="icon" id="icon" value="{{ old('icon') }}">
                    <div id="target" class="card border max-w-max mx-auto mb-2"></div>
                    @error('icon')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit"
                    class="bg-primary-50 hover:bg-primary-50 dark:bg-primary-50 dark:hover:bg-primary-300 text-text-light dark:text-text-dark rounded-lg px-5 py-2.5">
                    {{ __('Submit') }}
                </button>
            </form>
        </div>

    </div>
</x-app-layout>

<!-- Include CDN Links -->
<link href="https://cdn.jsdelivr.net/npm/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.10.0/css/bootstrap-iconpicker.min.css"
    rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.10.0/js/bootstrap-iconpicker.bundle.min.js">
</script>

<script>
    $(document).ready(function() {
        // Initialize Select2 for country names
        $('.select2').select2({
            theme: 'bootstrap4',
            placeholder: "{{ __('Select a language') }}",
            allowClear: true
        });

        // Initialize Icon Picker
        $('#target').iconpicker({
            iconset: 'flagicon',
            rows: 5,
            cols: 15,
            placement: 'bottom',
            search: true,
            selectedClass: 'btn-success'
        }).on('change', function(e) {
            $('#icon').val(e.icon);
            $('#icon-preview i').attr('class', e.icon);
        });
    });
</script>
