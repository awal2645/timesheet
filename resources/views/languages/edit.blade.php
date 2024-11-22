@section('title', __('Edit Language'))

<x-app-layout>
    <div class="flex justify-between m-8 bg-white/10 px-8 py-4 rounded-lg border border-gray-200 dark:border-gray-800 dark:bg-gray-900 shadow-md">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ __('Edit Language') }}</h2>
        <a href="{{ route('languages.index') }}" class="bg-purple-500 dark:bg-purple-900 text-white hover:bg-purple-600 rounded-lg px-4 py-2">
            {{ __('Go to Language List') }}
        </a>
    </div>
    <div class="m-8 p-6 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-200">{{ __('Edit Language Details') }}</h2>
        <form method="POST" action="{{ route('languages.update', $language->id) }}">
            @csrf
            @method('PUT')

            <!-- Language Name -->
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Language Name') }}
                </label>
                <select name="name" id="name" class="select2 w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                    @foreach ($translations as $key => $country)
                        <option {{ old('name', $language->name) == $country['name'] ? 'selected' : '' }} value="{{ $country['name'] }}">
                            {{ $country['name'] }}
                        </option>
                    @endforeach
                </select>
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Language Direction -->
            <div class="mb-5">
                <label for="direction" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Direction') }}
                </label>
                <select name="direction" id="direction" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                    <option value="ltr" {{ old('direction', $language->direction) == 'ltr' ? 'selected' : '' }}>{{ __('Left to Right') }}</option>
                    <option value="rtl" {{ old('direction', $language->direction) == 'rtl' ? 'selected' : '' }}>{{ __('Right to Left') }}</option>
                </select>
                @error('direction')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Language Icon -->
            <div class="mb-5">
                <label for="icon" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Select Flag Icon') }}
                </label>
                <input type="hidden" name="icon" id="icon" value="{{ old('icon', $language->icon) }}">
                <div id="target" class="mb-2"></div>
                @error('icon')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="bg-purple-500 hover:bg-purple-600 dark:bg-purple-900 dark:hover:bg-purple-800 text-white rounded-lg px-5 py-2.5">
                {{ __('Update') }}
            </button>
        </form>
    </div>
</x-app-layout>

<!-- Include CDN Links -->
<link href="https://cdn.jsdelivr.net/npm/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.10.0/css/bootstrap-iconpicker.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.10.0/js/bootstrap-iconpicker.bundle.min.js"></script>

<script>
    $(document).ready(function () {
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
            value: '{{ old('icon', $language->icon) }}',
            selectedClass: 'btn-success'
        }).on('change', function (e) {
            $('#icon').val(e.icon);
        });
    });
</script>