@section('title')
    {{ __('General Setting') }}
@endsection
<x-app-layout>
    <div class="py-12 px-8">
        <h2 class="text-2xl mb-6 text-black/90 dark:text-white/90">Application Settings</h2>
        <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data"
            class="bg-white/10 dark:bg-black/10 p-8 border border-black/10 dark:border-white/10 rounded-xl">
            @csrf
            @method('PUT')

            <div class="flex gap-6">
                <!-- Upload Logo -->
                <div class="flex-1 border border-gray-300 dark:border-gray-600 p-6 rounded-lg" x-data="logoUpload()">
                    <h3 class="text-xl mb-4">Upload Logo</h3>
                    <div class="flex flex-col gap-6 items-center">
                        <div class="preview-container">
                            <img :src="logoPreview" alt="Logo preview"
                                class="w-full h-[300px] rounded object-contain" x-show="logoPreview">
                        </div>
                        <div>
                            <p class="max-w-3xl text-base mb-5">Upload a high-resolution company logo in JPEG or PNG
                                format.</p>
                            <div>
                                <div class="flex gap-3 items-center flex-wrap">
                                    <label
                                        class="flex gap-3 items-center px-6 py-3 rounded-md bg-purple-500 shadow-md text-white dark:text-black">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                                            <path
                                                d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                            <path
                                                d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z" />
                                        </svg>
                                        Replace Logo
                                        <input type="file" name="logo" @change="handleLogoUpload"
                                            accept="image/jpeg,image/png" style="display:none;">
                                    </label>
                                    <button @click="removeLogo" type="button"
                                        class="flex gap-3 items-center px-6 py-3 rounded-md border shadow-md border-purple-500 dark:text-white">
                                        <span>Remove Logo</span>
                                    </button>
                                </div>
                                <p x-show="logoError" x-text="logoError" class="error-message"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upload Dark Logo -->
                <div class="flex-1 border border-gray-300 dark:border-gray-600 p-6 rounded-lg" x-data="darkLogoUpload()">
                    <h3 class="text-xl mb-4">Upload Dark Logo</h3>
                    <div class="flex flex-col gap-6 items-center">
                        <div class="preview-container">
                            <img :src="darkLogoPreview" alt="Dark Logo preview"
                                class="w-full h-[300px] rounded object-contain" x-show="darkLogoPreview">
                        </div>
                        <div>
                            <p class="max-w-3xl text-base mb-5">Upload a high-resolution dark logo in JPEG or PNG
                                format.</p>
                            <div>
                                <div class="flex gap-3 items-center flex-wrap">
                                    <label
                                        class="flex gap-3 items-center px-6 py-3 rounded-md bg-purple-500 shadow-md text-white dark:text-black">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                                            <path
                                                d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                            <path
                                                d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z" />
                                        </svg>
                                        Replace Dark Logo
                                        <input type="file" name="dark_logo" @change="handleDarkLogoUpload"
                                            accept="image/jpeg,image/png" style="display:none;">
                                    </label>
                                    <button @click="removeDarkLogo" type="button"
                                        class="flex gap-3 items-center px-6 py-3 rounded-md border shadow-md border-purple-500 dark:text-white">
                                        <span>Remove Dark Logo</span>
                                    </button>
                                </div>
                                <p x-show="darkLogoError" x-text="darkLogoError" class="error-message"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Favicon -->
                <div class="flex-1 border border-gray-300 dark:border-gray-600 p-6 rounded-lg" x-data="faviconUpload()">
                    <h3 class="text-xl mb-4">Upload Favicon</h3>
                    <div class="flex flex-col gap-6 items-center">
                        <div class="preview-container">
                            <img :src="faviconPreview" alt="Favicon preview"
                                class="w-full h-auto rounded object-contain" x-show="faviconPreview">
                        </div>
                        <div>
                            <p class="max-w-3xl text-base mb-5">Upload a favicon in JPEG or PNG format.</p>
                            <div>
                                <div class="flex gap-3 items-center flex-wrap">
                                    <label
                                        class="flex gap-3 items-center px-6 py-3 rounded-md bg-purple-500 shadow-md text-white dark:text-black">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                                            <path
                                                d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                            <path
                                                d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z" />
                                        </svg>
                                        Replace Favicon
                                        <input name="favicon" type="file" @change="handleFaviconUpload"
                                            accept="image/jpeg,image/png" style="display:none;">
                                    </label>
                                    <button @click="removeFavicon" type="button"
                                        class="flex gap-3 items-center px-6 py-3 rounded-md border shadow-md border-purple-500 dark:text-white">
                                        <span>Remove Favicon</span>
                                    </button>
                                </div>
                                <p x-show="faviconError" x-text="faviconError" class="error-message"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6 mt-8">
                <!-- Email -->
                <div class="relative z-0 w-full mb-5 group">
                    <input type="email" name="email" id="email"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                        placeholder=" " required value="{{ old('email', $settings->email) }}" />
                    <label for="email"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:bg-purple-50 peer-focus:dark:bg-purple-300 peer-focus:rounded peer-focus:border peer-focus:border-purple-600 peer-focus:dark:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                        {{ __('Email') }}
                    </label>
                    @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Phone -->
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="phone" id="phone"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                        placeholder=" " required value="{{ old('phone', $settings->phone) }}" />
                    <label for="phone"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:bg-purple-50 peer-focus:dark:bg-purple-300 peer-focus:rounded peer-focus:border peer-focus:border-purple-600 peer-focus:dark:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                        {{ __('Phone') }}
                    </label>
                    @error('phone')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Address -->
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="address" id="address"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                        placeholder=" " required value="{{ old('address', $settings->address) }}" />
                    <label for="address"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:bg-purple-50 peer-focus:dark:bg-purple-300 peer-focus:rounded peer-focus:border peer-focus:border-purple-600 peer-focus:dark:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                        {{ __('Address') }}
                    </label>
                    @error('address')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Copyright -->
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="copyright" id="copyright"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                        placeholder=" " required value="{{ old('copyright', $settings->copyright) }}" />
                    <label for="copyright"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:bg-purple-50 peer-focus:dark:bg-purple-300 peer-focus:rounded peer-focus:border peer-focus:border-purple-600 peer-focus:dark:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                        {{ __('Copyright') }}
                    </label>
                    @error('copyright')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Social Media URLs -->
                <div class="relative z-0 w-full mb-5 group">
                    <input type="url" name="facebook_url" id="facebook_url"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                        placeholder=" " value="{{ old('facebook_url', $settings->facebook_url) }}" />
                    <label for="facebook_url"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:bg-purple-50 peer-focus:dark:bg-purple-300 peer-focus:rounded peer-focus:border peer-focus:border-purple-600 peer-focus:dark:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                        {{ __('Facebook URL') }}
                    </label>
                    @error('facebook_url')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="relative z-0 w-full mb-5 group">
                    <input type="url" name="instagram_url" id="instagram_url"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                        placeholder=" " value="{{ old('instagram_url', $settings->instagram_url) }}" />
                    <label for="instagram_url"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:bg-purple-50 peer-focus:dark:bg-purple-300 peer-focus:rounded peer-focus:border peer-focus:border-purple-600 peer-focus:dark:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                        {{ __('Instagram URL') }}
                    </label>
                    @error('instagram_url')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="relative z-0 w-full mb-5 group">
                    <input type="url" name="linkedin_url" id="linkedin_url"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                        placeholder=" " value="{{ old('linkedin_url', $settings->linkedin_url) }}" />
                    <label for="linkedin_url"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:bg-purple-50 peer-focus:dark:bg-purple-300 peer-focus:rounded peer-focus:border peer-focus:border-purple-600 peer-focus:dark:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                        {{ __('LinkedIn URL') }}
                    </label>
                    @error('linkedin_url')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="relative z-0 w-full mb-5 group">
                    <input type="url" name="twitter_url" id="twitter_url"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                        placeholder=" " value="{{ old('twitter_url', $settings->twitter_url) }}" />
                    <label for="twitter_url"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:bg-purple-50 peer-focus:dark:bg-purple-300 peer-focus:rounded peer-focus:border peer-focus:border-purple-600 peer-focus:dark:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                        {{ __('Twitter URL') }}
                    </label>
                    @error('twitter_url')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="relative z-0 w-full mb-5 group">
                    <input type="url" name="youtube_url" id="youtube_url"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                        placeholder=" " value="{{ old('youtube_url', $settings->youtube_url) }}" />
                    <label for="youtube_url"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:bg-purple-50 peer-focus:dark:bg-purple-300 peer-focus:rounded peer-focus:border peer-focus:border-purple-600 peer-focus:dark:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                        {{ __('YouTube URL') }}
                    </label>
                    @error('youtube_url')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <button type="submit"
                class="mt-6 text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-purple-500 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
                {{ __('Save Settings') }}
            </button>
        </form>
    </div>
</x-app-layout>

<!-- Add this script for preview functionality -->
<script>
    function logoUpload() {
        return {
            logoPreview: '{{ $settings->logo }}', // Set default logo preview from existing data
            logoError: '',
            handleLogoUpload(event) {
                const file = event.target.files[0];
                if (!file) return;

                // Check file type
                if (!['image/jpeg', 'image/png'].includes(file.type)) {
                    this.logoError = 'Please upload a JPEG or PNG file.';
                    return;
                }

                // Check dimensions
                const img = new Image();
                img.crossOrigin = 'anonymous';
                img.onload = () => {
                    if (img.width < 200 || img.height < 200) {
                        this.logoError = 'Image must be at least 200x200 pixels.';
                        return;
                    }
                    this.logoError = '';
                };

                // Create preview URL
                const reader = new FileReader();
                reader.onloadend = () => {
                    this.logoPreview = reader.result;
                };
                reader.readAsDataURL(file);
                img.src = URL.createObjectURL(file);
            },
            removeLogo() {
                this.logoPreview = '{{ $settings->logo }}'; // Reset to existing logo
                this.logoError = '';
            }
        };
    }

    function darkLogoUpload() {
        return {
            darkLogoPreview: '{{ $settings->dark_logo }}', // Set default dark logo preview from existing data
            darkLogoError: '',
            handleDarkLogoUpload(event) {
                const file = event.target.files[0];
                if (!file) return;

                // Check file type
                if (!['image/jpeg', 'image/png'].includes(file.type)) {
                    this.darkLogoError = 'Please upload a JPEG or PNG file.';
                    return;
                }

                // Check dimensions
                const img = new Image();
                img.crossOrigin = 'anonymous';
                img.onload = () => {
                    if (img.width < 200 || img.height < 200) {
                        this.darkLogoError = 'Image must be at least 200x200 pixels.';
                        return;
                    }
                    this.darkLogoError = '';
                };

                // Create preview URL
                const reader = new FileReader();
                reader.onloadend = () => {
                    this.darkLogoPreview = reader.result;
                };
                reader.readAsDataURL(file);
                img.src = URL.createObjectURL(file);
            },
            removeDarkLogo() {
                this.darkLogoPreview = '{{ $settings->dark_logo }}'; // Reset to existing dark logo
                this.darkLogoError = '';
            }
        };
    }

    function faviconUpload() {
        return {
            faviconPreview: '{{ $settings->favicon }}', // Set default favicon preview from existing data
            faviconError: '',
            handleFaviconUpload(event) {
                const file = event.target.files[0];
                if (!file) return;

                // Check file type
                if (!['image/jpeg', 'image/png'].includes(file.type)) {
                    this.faviconError = 'Please upload a JPEG or PNG file.';
                    return;
                }

                // Create preview URL
                const reader = new FileReader();
                reader.onloadend = () => {
                    this.faviconPreview = reader.result;
                };
                reader.readAsDataURL(file);
            },
            removeFavicon() {
                this.faviconPreview = '{{ $settings->favicon }}'; // Reset to existing favicon
                this.faviconError = '';
            }
        };
    }
</script>
