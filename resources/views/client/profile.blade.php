@section('title')
    {{ __('General Setting') }}
@endsection
<x-app-layout>
    <div class="py-12 px-8">
        <h2 class="text-2xl mb-6 text-black/90 dark:text-white/90">{{ __('Client Settings') }}</h2>
        <form action="{{ route('client.info.update', $client->id) }}" method="Post" enctype="multipart/form-data"
            class="bg-card-light dark:bg-card-dark p-8 border border-black/10 dark:border-white/10 rounded-xl">
            @csrf
            <div class="flex flex-wrap gap-6">
                <!-- Upload Logo -->
                <div class="flex-1 border border-gray-300 dark:border-gray-600 p-6 rounded-lg" x-data="logoUpload()">
                    <h3 class="text-xl mb-4 text-text-light dark:text-text-dark">{{ __('Upload Logo') }}</h3>
                    <div class="flex flex-col gap-6 items-center">
                        <div class="preview-container">
                            <img :src="logoPreview" alt="Logo preview"
                                class="w-full h-[300px] rounded object-contain" x-show="logoPreview">
                        </div>
                        <div>
                            <p class="max-w-3xl text-base mb-5">{{ __('Upload a high-resolution company logo in JPEG or PNG format.') }}</p>
                            <div>
                                <div class="flex gap-3 items-center flex-wrap">
                                    <label
                                        class="flex gap-3 items-center px-6 py-3 rounded-md bg-primary-50 shadow-md text-white dark:text-black">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                                            <path
                                                d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                            <path
                                                d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z" />
                                        </svg>
                                        {{ __('Replace Logo') }}
                                        <input type="file" name="image" @change="handleLogoUpload"
                                            accept="image/jpeg,image/png" style="display:none;">
                                    </label>
                                    <button @click="removeLogo" type="button"
                                        class="flex gap-3 items-center px-6 py-3 rounded-md border shadow-md border-primary-500 dark:text-white">
                                        <span>{{ __('Remove Logo') }}</span>
                                    </button>
                                </div>
                                <p x-show="logoError" x-text="logoError" class="error-message"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6 mt-8">
                <!-- Employer Name -->
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="client_name" id="client_name"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-primary-500 focus:outline-none focus:ring-0 focus:border-primary-600 peer"
                        placeholder=" " required value="{{ old('client_name', $client->client_name) }}" />
                    <label for="client_name"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-text-dark peer-focus:bg-primary-50 peer-focus:dark:bg-primary-50 peer-focus:rounded peer-focus:border peer-focus:border-primary-600 peer-focus:dark:text-text-dark  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                        {{ __('Client Name') }}
                    </label>
                    @error('client_name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                 <!-- Employer Phone -->
                    <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="client_phone" id="client_phone"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-primary-500 focus:outline-none focus:ring-0 focus:border-primary-600 peer"
                        placeholder=" " required value="{{ old('phone', $client->client_phone) }}" />
                    <label for="client_phone"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-text-dark peer-focus:bg-primary-50 peer-focus:dark:bg-primary-50 peer-focus:rounded peer-focus:border peer-focus:border-primary-600 peer-focus:dark:text-text-dark  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                        {{ __('Client Phone') }}
                    </label>
                    @error('client_phone')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6 mt-8">
                <!-- Employer Email -->
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="email" id="email"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-primary-500 focus:outline-none focus:ring-0 focus:border-primary-600 peer"
                        placeholder=" " required value="{{ old('email', $client->user->email) }}" />
                    <label for="email"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-text-dark peer-focus:bg-primary-50 peer-focus:dark:bg-primary-50 peer-focus:rounded peer-focus:border peer-focus:border-primary-600 peer-focus:dark:text-text-dark  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                        {{ __('Email') }}
                    </label>
                    @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                 <!-- Employer username -->
                 <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="username" id="username"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-primary-500 focus:outline-none focus:ring-0 focus:border-primary-600 peer"
                        placeholder=" " required value="{{ old('username', $client->user->username) }}" />
                    <label for="username"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-text-dark peer-focus:bg-primary-50 peer-focus:dark:bg-primary-50 peer-focus:rounded peer-focus:border peer-focus:border-primary-600 peer-focus:dark:text-text-dark  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                        {{ __('Username') }}
                    </label>
                    @error('username')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            
            <button type="submit"
                class="mt-6 text-text-light dark:text-text-dark bg-primary-50 hover:bg-primary-300 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-md text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-primary-50 dark:hover:bg-primary-50 dark:focus:ring-primary-800">
                {{ __('Save Settings') }}
            </button>
        </form>
    </div>
</x-app-layout>

<!-- Add this script for preview functionality -->
<script>
    function logoUpload() {
        return {
            logoPreview: '{{ asset($client->user->image ?? 'reports_images/dummy_image.png') }}', // Set default logo preview from existing data
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
                this.logoPreview = '{{ $client->user->image }}'; // Reset to existing logo
                this.logoError = '';
            }
        };
    }

</script>