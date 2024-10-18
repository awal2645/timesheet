@section('title')
{{ 'General Setting' }}
@endsection
<x-app-layout>
    <div class="max-w-lg mx-auto mt-6 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Application Settings</h2>
        <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data"
            class="max-w-md mx-auto">
            @csrf
            @method('PUT')

            <!-- Application Name -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" id="app_name" name="app_name"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder="" required value="{{ config('app.name') }}" />
                <label for="app_name"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Application Name
                </label>
                @error('app_name')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Current Logo -->
            <div class="mb-6 text-center">
                <label for="current_logo"
                    class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Current Logo:</label>
                <img id="logo-preview" src="{{ asset('images/logo-inv.png') }}" alt="Current Logo"
                    class="h-32 w-60 object-contain mx-auto ">
            </div>

            <!-- Logo Upload -->
            <div class="relative z-0 w-full mb-6 group">
                <input type="file" id="logo" name="logo" accept="image/png"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    onchange="previewImage('logo', 'logo-preview')" />
                <label for="logo" class="block text-sm text-gray-500 dark:text-gray-400 mt-2">
                    Upload Logo (PNG format)
                </label>
                @error('logo')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Current Favicon -->
            <div class="mb-6 text-center">
                <label for="current_favicon"
                    class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Current Favicon:</label>
                <img id="favicon-preview" src="{{ asset('images/logo_symbol.png') }}" alt="Current Favicon"
                    class="h-16  w-24e mx-auto">
            </div>


            <!-- Favicon Upload -->
            <div class="relative z-0 w-full mb-6 group">
                <input type="file" id="favicon" name="favicon"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    onchange="previewImage('favicon', 'favicon-preview')" />
                <label for="favicon" class="block text-sm text-gray-500 dark:text-gray-400 mt-2">
                    Upload Favicon
                </label>
                @error('favicon')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Save Settings
            </button>
        </form>
    </div>
</x-app-layout>

<!-- Add this script for preview functionality -->
<script>
    function previewImage(inputId, previewId) {
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);

        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }
</script>