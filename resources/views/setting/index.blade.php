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
        <div x-data="{ activeTab: 'basic-info' }">

            <div class="mb-4 border-b-2 border-purple-500">
                <ul class="flex flex-wrap -mb-px" role="tablist">
                    <li class="mr-2" role="presentation">
                        <button class="inline-block px-5 py-2 rounded-t-lg border-2 border-transparent"
                            :class="activeTab === 'basic-info' ?
                                'text-purple-500 bg-black/50 backdrop-blur border-2 !border-purple-500' :
                                'hover:text-purple-500 hover:border-purple-500'"
                            @click="activeTab = 'basic-info'">Basic Info</button>
                    </li>
                    <li class="mr-2" role="presentation">
                        <button class="inline-block px-5 py-2 rounded-t-lg border-2 border-transparent"
                            :class="activeTab === 'social-media' ?
                                'text-purple-500 bg-black/50 backdrop-blur !border-purple-500' :
                                'hover:text-purple-500 hover:border-purple-500'"
                            @click="activeTab = 'social-media'">Social Media</button>
                    </li>
                    <li class="mr-2" role="presentation">
                        <button class="inline-block px-5 py-2 rounded-t-lg border-2 border-transparent"
                            :class="activeTab === 'contact-info' ?
                                'text-purple-500 bg-black/50 backdrop-blur !border-purple-500' :
                                'hover:text-purple-500 hover:border-purple-500'"
                            @click="activeTab = 'contact-info'">Contact Info</button>
                    </li>
                </ul>
            </div>

            <div class="tab-content">
                <template x-if="activeTab === 'basic-info'">
                    <form action="" class="bg-black/50 p-8 border border-white/30 rounded-xl">
                        <div x-data="imageUpload()">
                            <h3 class="text-xl mb-4">Basic info</h1>

                                <div class="flex gap-6 items-center">
                                    <div class="preview-container">
                                        <img :src="imagePreview" alt="Profile preview"
                                            class="w-[200px] h-[200px] rounded object-cover">
                                    </div>
                                    <div>
                                        <h2 class="text-2xl text-white mb-3">Upload profile picture</h2>
                                        <p class="max-w-3xl text-base mb-5">Upload a square, high-resolution company
                                            logo (minimum
                                            200x200 pixels) in JPEG or PNG format,
                                            with a professional and clean design.</p>
                                        <div>
                                            <div class="flex gap-3 items-center flex-wrap">
                                                <label
                                                    class="flex gap-3 items-center px-6 py-3 rounded-md bg-purple-500 shadow-md text-black">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor" class="bi bi-upload"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                                        <path
                                                            d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z" />
                                                    </svg>
                                                    Replace image
                                                    <input type="file" @change="handleImageUpload"
                                                        accept="image/jpeg,image/png" style="display:none;">
                                                </label>
                                                <button @click="removeImage"
                                                    class="flex gap-3 items-center px-6 py-3 rounded-md border shadow-md border-purple-500 text-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor" class="bi bi-x-circle"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
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
                                <div class="grid grid-cols-2 gap-6 mt-8">
                                    <!-- Client Name -->
                                    <div class="relative z-0 w-full mb-5 group">
                                        <input type="text" name="client_name" id="client_name"
                                            class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                            placeholder=" " required value="{{ old('client_name') }}" />
                                        <label for="client_name"
                                            class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:bg-blue-50 peer-focus:dark:bg-blue-300 peer-focus:rounded peer-focus:border peer-focus:border-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                                            {{ __('Client Name') }}
                                        </label>
                                        @error('client_name')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- Client Email -->
                                    <div class="relative z-0 w-full mb-5 group">
                                        <input type="email" name="client_email" id="client_email"
                                            class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                            placeholder=" " required value="{{ old('client_email') }}" />
                                        <label for="client_email"
                                            class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:bg-blue-50 peer-focus:dark:bg-blue-300 peer-focus:rounded peer-focus:border peer-focus:border-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                                            {{ __('Client Email') }}
                                        </label>
                                        @error('client_email')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- Client Phone -->
                                    <div class="relative z-0 w-full mb-5 group">
                                        <input type="text" name="client_phone" id="client_phone"
                                            class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                            placeholder=" " required value="{{ old('client_phone') }}" />
                                        <label for="client_phone"
                                            class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:bg-blue-50 peer-focus:dark:bg-blue-300 peer-focus:rounded peer-focus:border peer-focus:border-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                                            {{ __('Client Phone') }}
                                        </label>
                                        @error('client_phone')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- Contact Name -->
                                    <div class="relative z-0 w-full mb-5 group">
                                        <input type="text" name="contact_name" id="contact_name"
                                            class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                            placeholder=" " required value="{{ old('contact_name') }}" />
                                        <label for="contact_name"
                                            class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:bg-blue-50 peer-focus:dark:bg-blue-300 peer-focus:rounded peer-focus:border peer-focus:border-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                                            {{ __('Contact Name') }}
                                        </label>
                                        @error('contact_name')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-5">
                                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-400">{{
                                            __('Meeting Description') }}</label>
                                        <textarea name="description" id="description" rows="4"
                                            class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-400"
                                            placeholder="{{ __('Enter Description') }}">{{ old('description') }}</textarea>
                                        @error('description')
                                        <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-5">
                                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-400">{{
                                            __('Meeting Description') }}</label>
                                        <textarea name="description" id="description" rows="4"
                                            class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-400"
                                            placeholder="{{ __('Enter Description') }}">{{ old('description') }}</textarea>
                                        @error('description')
                                        <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                        </div>
                    </form>
                </template>
                <template x-if="activeTab === 'social-media'">
                    <form x-data="socialMedia" class="bg-black/50 p-8 border border-white/30 rounded-xl">
                        <h1 class="text-2xl font-bold mb-6">Social media</h1>

                        <div class="space-y-4">
                            <template x-for="(social, index) in socials" :key="index">
                                <div class="flex items-center space-x-4">
                                    <select x-model="social.platform"
                                        class="w-1/3 p-2 bg-black/50 border border-white/30 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                        <option value="Facebook">Facebook</option>
                                        <option value="Twitter">Twitter</option>
                                        <option value="Youtube">Youtube</option>
                                        <option value="LinkedIn">LinkedIn</option>
                                        <option value="Pinterest">Pinterest</option>
                                        <option value="Github">Github</option>
                                    </select>
                                    <input type="url" x-model="social.url"
                                        :placeholder="'http://www.' + social.platform.toLowerCase() + '.com/templatecookie'"
                                        class="w-2/3 p-2 bg-black/50 border border-white/30 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <button @click="removeSocial(index)"
                                        class="py-2.5 px-3 bg-black/50 border border-white/30 rounded text-gray-400 hover:text-red-500 focus:outline-none"
                                        title="Remove">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </template>
                        </div>

                        <div class="mt-6 flex space-x-4">
                            <button @click="addSocial"
                                class="flex-1 bg-purple-500 hover:bg-purple-700 text-white font-semibold py-2 px-4 rounded-md flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Add more
                            </button>
                            <button @click="saveSocials"
                                class="flex-1 bg-gray-800 hover:bg-gray-900 text-white font-semibold py-2 px-4 rounded-md flex items-center justify-center">
                                Save
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </template>
                <template x-if="activeTab === 'contact-info'">
                    <form class="bg-black/50 p-8 border border-white/30 rounded-xl">
                        <div class="grid grid-cols-2 gap-6">
                            <!-- Client Name -->
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="client_name" id="client_name"
                                    class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required value="{{ old('client_name') }}" />
                                <label for="client_name"
                                    class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:bg-blue-50 peer-focus:dark:bg-blue-300 peer-focus:rounded peer-focus:border peer-focus:border-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                                    {{ __('Client Name') }}
                                </label>
                                @error('client_name')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Client Email -->
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="email" name="client_email" id="client_email"
                                    class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required value="{{ old('client_email') }}" />
                                <label for="client_email"
                                    class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:bg-blue-50 peer-focus:dark:bg-blue-300 peer-focus:rounded peer-focus:border peer-focus:border-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                                    {{ __('Client Email') }}
                                </label>
                                @error('client_email')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Client Phone -->
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="client_phone" id="client_phone"
                                    class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required value="{{ old('client_phone') }}" />
                                <label for="client_phone"
                                    class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:bg-blue-50 peer-focus:dark:bg-blue-300 peer-focus:rounded peer-focus:border peer-focus:border-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                                    {{ __('Client Phone') }}
                                </label>
                                @error('client_phone')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Contact Name -->
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="contact_name" id="contact_name"
                                    class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required value="{{ old('contact_name') }}" />
                                <label for="contact_name"
                                    class="peer-focus:font-medium absolute text-sm text-gray-500 px-5 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:bg-blue-50 peer-focus:dark:bg-blue-300 peer-focus:rounded peer-focus:border peer-focus:border-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:z-50 peer-focus:px-3 peer-focus:-translate-y-6">
                                    {{ __('Contact Name') }}
                                </label>
                                @error('contact_name')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </form>
                </template>
            </div>
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

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('socialMedia', () => ({
            socials: [{
                    platform: 'Facebook',
                    url: ''
                },
                {
                    platform: 'Twitter',
                    url: ''
                },
                {
                    platform: 'Youtube',
                    url: ''
                },
                {
                    platform: 'LinkedIn',
                    url: ''
                },
                {
                    platform: 'Pinterest',
                    url: ''
                },
                {
                    platform: 'Github',
                    url: ''
                }
            ],

            addSocial() {
                this.socials.push({
                    platform: 'Facebook',
                    url: ''
                });
            },

            removeSocial(index) {
                this.socials.splice(index, 1);
            },

            saveSocials() {
                // Here you would typically send the data to your backend
                console.log('Saving social media links:', this.socials);
                alert('Social media links saved!');
            }
        }));
    });
</script>
