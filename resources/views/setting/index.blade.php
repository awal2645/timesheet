@section('title')
    {{ __('General Setting') }}
@endsection
<x-app-layout>
    {{-- <div class="max-w-lg mx-auto mt-6 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">{{ __('Application Settings') }}</h2>
        <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data" class="max-w-md mx-auto">
            @csrf
            @method('PUT')

            <!-- Application Name -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" id="app_name" name="app_name"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder="" required value="{{ config('app.name') }}" />
                <label for="app_name"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    {{ __('Application Name') }}
                </label>
                @error('app_name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Current Logo -->
            <div class="mb-6 text-center">
                <label for="current_logo"
                    class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">{{ __('Current Logo') }}</label>
                <img id="logo-preview" src="{{ asset('images/logo-inv.png') }}" alt="{{ __('Current Logo') }}"
                    class="h-32 w-60 object-contain mx-auto ">
            </div>

            <!-- Logo Upload -->
            <div class="relative z-0 w-full mb-6 group">
                <input type="file" id="logo" name="logo" accept="image/png"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    onchange="previewImage('logo', 'logo-preview')" />
                <label for="logo" class="block text-sm text-gray-500 dark:text-gray-400 mt-2">
                    {{ __('Upload Logo (PNG format)') }}
                </label>
                @error('logo')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Current Favicon -->
            <div class="mb-6 text-center">
                <label for="current_favicon"
                    class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">{{ __('Current Favicon') }}</label>
                <img id="favicon-preview" src="{{ asset('images/logo_symbol.png') }}"
                    alt="{{ __('Current Favicon') }}" class="h-16 w-24 mx-auto">
            </div>

            <!-- Favicon Upload -->
            <div class="relative z-0 w-full mb-6 group">
                <input type="file" id="favicon" name="favicon"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    onchange="previewImage('favicon', 'favicon-preview')" />
                <label for="favicon" class="block text-sm text-gray-500 dark:text-gray-400 mt-2">
                    {{ __('Upload Favicon') }}
                </label>
                @error('favicon')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-purple-500 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                {{ __('Save Settings') }}
            </button>
        </form>
    </div> --}}
    <div class="py-12 px-8">
        <h2 class="text-2xl mb-6 text-white/90">Application Settings</h2>
        <nav>
            <ul class="flex gap-5 items-center border-b-2 border-purple-500 mb-6">
                <li>
                    <a href=""
                        class="py-3 px-6 flex gap-2 items-center border border-purple-500 bg-transparent hover:bg-purple-500 transition-all duration-300 rounded-t-xl text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-info-circle size-5"
                            viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                            <path
                                d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                        </svg>
                        Basic Info
                    </a>
                </li>
                <li>
                    <a href=""
                        class="py-3 px-6 flex gap-2 items-center border border-purple-500 bg-transparent hover:bg-purple-500 transition-all duration-300 rounded-t-xl text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-microsoft-teams size-5"
                            viewBox="0 0 16 16">
                            <path
                                d="M9.186 4.797a2.42 2.42 0 1 0-2.86-2.448h1.178c.929 0 1.682.753 1.682 1.682zm-4.295 7.738h2.613c.929 0 1.682-.753 1.682-1.682V5.58h2.783a.7.7 0 0 1 .682.716v4.294a4.197 4.197 0 0 1-4.093 4.293c-1.618-.04-3-.99-3.667-2.35Zm10.737-9.372a1.674 1.674 0 1 1-3.349 0 1.674 1.674 0 0 1 3.349 0m-2.238 9.488-.12-.002a5.2 5.2 0 0 0 .381-2.07V6.306a1.7 1.7 0 0 0-.15-.725h1.792c.39 0 .707.317.707.707v3.765a2.6 2.6 0 0 1-2.598 2.598z" />
                            <path
                                d="M.682 3.349h6.822c.377 0 .682.305.682.682v6.822a.68.68 0 0 1-.682.682H.682A.68.68 0 0 1 0 10.853V4.03c0-.377.305-.682.682-.682Zm5.206 2.596v-.72h-3.59v.72h1.357V9.66h.87V5.945z" />
                        </svg>
                        Social Media
                    </a>
                </li>
                <li>
                    <a href=""
                        class="py-3 px-6 flex gap-2 items-center border border-purple-500 bg-transparent hover:bg-purple-500 transition-all duration-300 rounded-t-xl text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-telephone-outbound" viewBox="0 0 16 16">
                            <path
                                d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877zM11 .5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-4.146 4.147a.5.5 0 0 1-.708-.708L14.293 1H11.5a.5.5 0 0 1-.5-.5" />
                        </svg>
                        Contact Info
                    </a>
                </li>
            </ul>
        </nav>
        <form action="" class="bg-black/50 p-8 border border-white/30 rounded-xl">
            <div x-data="imageUpload()">
                <h3 class="text-xl mb-4">Basic info</h1>

                <div class="flex gap-6 items-center">
                    <div class="preview-container">
                        <img :src="imagePreview" alt="Profile preview" class="w-[200px] h-[200px] rounded object-cover">

                    </div>
                    <div>
                        <h2 class="text-2xl text-white mb-3">Upload profile picture</h2>
                        <p class="max-w-3xl text-base mb-5">Upload a square, high-resolution company logo (minimum 200x200 pixels) in JPEG or PNG format,
                            with a professional and clean design.</p>
                        <div>
                            <div class="flex gap-3 items-center flex-wrap">
                                <label
                                    class="flex gap-3 items-center px-6 py-3 rounded-md bg-purple-500 shadow-md text-black">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                                        <path
                                            d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                        <path
                                            d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z" />
                                    </svg>
                                    Replace image
                                    <input type="file" @change="handleImageUpload" accept="image/jpeg,image/png"
                                        style="display:none;">
                                </label>
                                <button @click="removeImage"
                                    class="flex gap-3 items-center px-6 py-3 rounded-md border shadow-md border-purple-500 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                        <path
                                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                                    </svg>
                                    <span>Remove image</span>
                                </button>
                            </div>
                            <p x-show="error" x-text="error" class="error-message"></p>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</x-app-layout>

<!-- Add this script for preview functionality -->
<script>
    function imageUpload() {
        return {
            imagePreview: '/images/user-36-01.jpg',
            error: '',
            handleImageUpload(event) {
                const file = event.target.files[0];
                if (!file) return;

                // Check file type
                if (!['image/jpeg', 'image/png'].includes(file.type)) {
                    this.error = 'Please upload a JPEG or PNG file.';
                    return;
                }

                // Check dimensions
                const img = new Image();
                img.crossOrigin = 'anonymous';
                img.onload = () => {
                    if (img.width < 200 || img.height < 200) {
                        this.error = 'Image must be at least 200x200 pixels.';
                        return;
                    }
                    this.error = '';
                };

                // Create preview URL
                const reader = new FileReader();
                reader.onloadend = () => {
                    this.imagePreview = reader.result;
                };
                reader.readAsDataURL(file);
                img.src = URL.createObjectURL(file);
            },
            removeImage() {
                this.imagePreview = '/images/user-36-01.jpg';
                this.error = '';
            }
        };
    }
</script>
