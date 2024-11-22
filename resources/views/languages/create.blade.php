@section('title', __('Create Language'))

<x-app-layout>
    <div class="flex justify-between m-8 bg-white/10 px-8 py-4 rounded-lg border border-gray-200 dark:border-gray-800 dark:bg-gray-900 shadow-md">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ __('Create Language') }}</h2>
        <a href="{{ route('languages.index') }}" class="btn bg-purple-500 dark:bg-purple-900 text-white hover:bg-purple-600 rounded-lg px-4 py-2">
            {{ __('Go to Language List') }}
        </a>
    </div>
    <div class="m-8 p-6 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-200">{{ __('Create New Language') }}</h2>
        <form method="POST" action="{{ route('languages.store') }}">
            @csrf

            <!-- Language Name -->
            <div class="mb-5">
                <label for="name" 
                class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:bg-blue-50 peer-focus:dark:bg-blue-300 peer-focus:rounded peer-focus:border peer-focus:border-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                {{ __('Language Name') }}
                </label>
                <select name="name"  class="max-h-[200px] overflow-y-auto w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                    @foreach ($translations as $key => $country)
                        <option {{ old('name') == $country['name'] ? 'selected' : '' }} value="{{ $country['name'] }}">
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
                    <option value="ltr" {{ old('direction') == 'ltr' ? 'selected' : '' }}>{{ __('Left to Right') }}</option>
                    <option value="rtl" {{ old('direction') == 'rtl' ? 'selected' : '' }}>{{ __('Right to Left') }}</option>
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
                <input type="hidden" name="icon" id="icon" value="{{ old('icon') }}">
                <div id="target" class="mb-2"></div>
                @error('icon')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="bg-purple-500 hover:bg-purple-600 dark:bg-purple-900 dark:hover:bg-purple-800 text-white rounded-lg px-5 py-2.5">
                {{ __('Submit') }}
            </button>
        </form>
    </div>
</x-app-layout>

<!-- Include CDN Links -->
<link href="https://cdn.jsdelivr.net/npm/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
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
            selectedClass: 'btn-success'
        }).on('change', function (e) {
            $('#icon').val(e.icon);
            $('#icon-preview i').attr('class', e.icon);
        });
    });
</script>