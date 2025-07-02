@section('title', 'General Settings')

<x-app-layout>
    <!-- Breadcrumb Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 mt-6">
        <x-breadcrumb :items="[
            [
                'label' => __('Application Settings'),
                'icon' => true
            ]
        ]" />
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white dark:bg-slate-800 shadow-2xl rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-purple-50 to-indigo-100 dark:from-slate-700 dark:to-slate-800 px-8 py-8 border-b border-gray-200 dark:border-gray-600">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                            <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            {{ __('Application Settings') }}
                        </h2>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Configure your application settings, branding, and social media links.') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="p-8">
                <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" id="settingsForm">
                    @csrf
                    @method('PUT')

                    <!-- Tab Navigation -->
                    <div class="border-b border-gray-200 dark:border-gray-700 mb-8">
                        <nav class="-mb-px flex space-x-8">
                            <button type="button" onclick="showTab('branding')" id="brandingTab" class="tab-button active border-purple-500 text-purple-600 py-2 px-1 border-b-2 font-medium text-sm">
                                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ __('Branding') }}
                            </button>
                            <button type="button" onclick="showTab('contact')" id="contactTab" class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 py-2 px-1 border-b-2 font-medium text-sm">
                                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                {{ __('Contact Info') }}
                            </button>
                            <button type="button" onclick="showTab('social')" id="socialTab" class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 py-2 px-1 border-b-2 font-medium text-sm">
                                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"/>
                                </svg>
                                {{ __('Social Media') }}
                            </button>
                        </nav>
                    </div>

                    <!-- Branding Tab -->
                    <div id="brandingContent" class="tab-content">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                            <!-- Upload Logo -->
                            <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 p-6 rounded-xl border border-gray-200 dark:border-gray-600" x-data="logoUpload()">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ __('Upload Logo') }}
                                </h3>
                                <div class="text-center">
                                    <div class="mb-4">
                                        <img :src="logoPreview" alt="Logo preview" class="w-full h-48 rounded-lg object-contain bg-white border border-gray-200" x-show="logoPreview">
                                    </div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">{{ __('Upload a high-resolution logo in JPEG or PNG format.') }}</p>
                                    <div class="space-y-3">
                                        <label class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 cursor-pointer transition-colors duration-200">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                            </svg>
                                            {{ __('Replace Logo') }}
                                            <input type="file" name="logo" @change="handleLogoUpload" accept="image/jpeg,image/png" class="hidden">
                                        </label>
                                        <button @click="removeLogo" type="button" class="block w-full px-4 py-2 border border-gray-300 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                            {{ __('Remove Logo') }}
                                        </button>
                                    </div>
                                    <p x-show="logoError" x-text="logoError" class="text-red-500 text-sm mt-2"></p>
                                </div>
                            </div>

                            <!-- Upload Dark Logo -->
                            <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 p-6 rounded-xl border border-gray-200 dark:border-gray-600" x-data="darkLogoUpload()">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                                    </svg>
                                    {{ __('Upload Dark Logo') }}
                                </h3>
                                <div class="text-center">
                                    <div class="mb-4">
                                        <img :src="darkLogoPreview" alt="Dark Logo preview" class="w-full h-48 rounded-lg object-contain bg-gray-900 border border-gray-200" x-show="darkLogoPreview">
                                    </div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">{{ __('Upload a dark mode logo in JPEG or PNG format.') }}</p>
                                    <div class="space-y-3">
                                        <label class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 cursor-pointer transition-colors duration-200">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                            </svg>
                                            {{ __('Replace Dark Logo') }}
                                            <input type="file" name="dark_logo" @change="handleDarkLogoUpload" accept="image/jpeg,image/png" class="hidden">
                                        </label>
                                        <button @click="removeDarkLogo" type="button" class="block w-full px-4 py-2 border border-gray-300 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                            {{ __('Remove Dark Logo') }}
                                        </button>
                                    </div>
                                    <p x-show="darkLogoError" x-text="darkLogoError" class="text-red-500 text-sm mt-2"></p>
                                </div>
                            </div>

                            <!-- Favicon -->
                            <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 p-6 rounded-xl border border-gray-200 dark:border-gray-600" x-data="faviconUpload()">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                    </svg>
                                    {{ __('Upload Favicon') }}
                                </h3>
                                <div class="text-center">
                                    <div class="mb-4 flex justify-center">
                                        <img :src="faviconPreview" alt="Favicon preview" class="w-16 h-16 rounded-lg object-contain bg-white border border-gray-200" x-show="faviconPreview">
                                    </div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">{{ __('Upload a favicon in JPEG or PNG format.') }}</p>
                                    <div class="space-y-3">
                                        <label class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 cursor-pointer transition-colors duration-200">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                            </svg>
                                            {{ __('Replace Favicon') }}
                                            <input name="favicon" type="file" @change="handleFaviconUpload" accept="image/jpeg,image/png" class="hidden">
                                        </label>
                                        <button @click="removeFavicon" type="button" class="block w-full px-4 py-2 border border-gray-300 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                            {{ __('Remove Favicon') }}
                                        </button>
                                    </div>
                                    <p x-show="faviconError" x-text="faviconError" class="text-red-500 text-sm mt-2"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Info Tab -->
                    <div id="contactContent" class="tab-content hidden">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Email') }}</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $settings->email) }}" class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200" required>
                                @error('email')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                            </div>

                            <div class="space-y-2">
                                <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Phone') }}</label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone', $settings->phone) }}" class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200" required>
                                @error('phone')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                            </div>

                            <div class="space-y-2">
                                <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Address') }}</label>
                                <input type="text" name="address" id="address" value="{{ old('address', $settings->address) }}" class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200" required>
                                @error('address')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                            </div>

                            <div class="space-y-2">
                                <label for="copyright" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Copyright') }}</label>
                                <input type="text" name="copyright" id="copyright" value="{{ old('copyright', $settings->copyright) }}" class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200" required>
                                @error('copyright')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <!-- Social Media Tab -->
                    <div id="socialContent" class="tab-content hidden">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="facebook_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                    {{ __('Facebook URL') }}
                                </label>
                                <input type="url" name="facebook_url" id="facebook_url" value="{{ old('facebook_url', $settings->facebook_url) }}" class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200">
                                @error('facebook_url')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                            </div>

                            <div class="space-y-2">
                                <label for="instagram_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-pink-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987s11.987-5.367 11.987-11.987C24.014 5.367 18.648.001 12.017.001zM8.449 16.988c-1.297 0-2.448-.73-3.016-1.804-.568-1.075-.568-2.305 0-3.379.568-1.075 1.719-1.804 3.016-1.804s2.448.729 3.016 1.804c.568 1.074.568 2.304 0 3.379-.568 1.074-1.719 1.804-3.016 1.804zm7.119 0c-1.297 0-2.448-.73-3.016-1.804-.568-1.075-.568-2.305 0-3.379.568-1.075 1.719-1.804 3.016-1.804s2.448.729 3.016 1.804c.568 1.074.568 2.304 0 3.379-.568 1.074-1.719 1.804-3.016 1.804z"/></svg>
                                    {{ __('Instagram URL') }}
                                </label>
                                <input type="url" name="instagram_url" id="instagram_url" value="{{ old('instagram_url', $settings->instagram_url) }}" class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200">
                                @error('instagram_url')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                            </div>

                            <div class="space-y-2">
                                <label for="linkedin_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-blue-700" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                    {{ __('LinkedIn URL') }}
                                </label>
                                <input type="url" name="linkedin_url" id="linkedin_url" value="{{ old('linkedin_url', $settings->linkedin_url) }}" class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200">
                                @error('linkedin_url')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                            </div>

                            <div class="space-y-2">
                                <label for="twitter_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-blue-400" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                                    {{ __('Twitter URL') }}
                                </label>
                                <input type="url" name="twitter_url" id="twitter_url" value="{{ old('twitter_url', $settings->twitter_url) }}" class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200">
                                @error('twitter_url')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                            </div>

                            <div class="space-y-2 md:col-span-2">
                                <label for="youtube_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-red-600" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                                    {{ __('YouTube URL') }}
                                </label>
                                <input type="url" name="youtube_url" id="youtube_url" value="{{ old('youtube_url', $settings->youtube_url) }}" class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200">
                                @error('youtube_url')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end pt-8 border-t border-gray-200 dark:border-gray-600 mt-8">
                        <button type="submit" id="submitBtn" class="group inline-flex items-center justify-center px-10 py-4 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-bold rounded-xl transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-purple-500/50">
                            <div class="flex items-center justify-center w-6 h-6 bg-white/20 rounded-lg mr-3">
                                <svg class="w-4 h-4 transition-transform duration-200 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span class="submit-text">{{ __('Save Settings') }}</span>
                            <div class="loading-spinner hidden ml-3">
                                <svg class="animate-spin w-5 h-5 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </div>
                            <svg class="w-5 h-5 ml-3 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5-5 5M6 12h12"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Enhanced JavaScript -->
    <script>
        // Tab functionality
        function showTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });
            
            // Remove active class from all tab buttons
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('active', 'border-purple-500', 'text-purple-600');
                button.classList.add('border-transparent', 'text-gray-500');
            });
            
            // Show selected tab content
            document.getElementById(tabName + 'Content').classList.remove('hidden');
            
            // Add active class to selected tab button
            const activeTab = document.getElementById(tabName + 'Tab');
            activeTab.classList.add('active', 'border-purple-500', 'text-purple-600');
            activeTab.classList.remove('border-transparent', 'text-gray-500');
        }

        // Alpine.js data functions
        function logoUpload() {
            return {
                logoPreview: '{{ $settings->logo }}',
                logoError: '',
                handleLogoUpload(event) {
                    const file = event.target.files[0];
                    if (!file) return;

                    if (!['image/jpeg', 'image/png'].includes(file.type)) {
                        this.logoError = 'Please upload a JPEG or PNG file.';
                        return;
                    }

                    const img = new Image();
                    img.crossOrigin = 'anonymous';
                    img.onload = () => {
                        if (img.width < 200 || img.height < 200) {
                            this.logoError = 'Image must be at least 200x200 pixels.';
                            return;
                        }
                        this.logoError = '';
                    };

                    const reader = new FileReader();
                    reader.onloadend = () => {
                        this.logoPreview = reader.result;
                    };
                    reader.readAsDataURL(file);
                    img.src = URL.createObjectURL(file);
                },
                removeLogo() {
                    this.logoPreview = '{{ $settings->logo }}';
                    this.logoError = '';
                }
            };
        }

        function darkLogoUpload() {
            return {
                darkLogoPreview: '{{ $settings->dark_logo }}',
                darkLogoError: '',
                handleDarkLogoUpload(event) {
                    const file = event.target.files[0];
                    if (!file) return;

                    if (!['image/jpeg', 'image/png'].includes(file.type)) {
                        this.darkLogoError = 'Please upload a JPEG or PNG file.';
                        return;
                    }

                    const img = new Image();
                    img.crossOrigin = 'anonymous';
                    img.onload = () => {
                        if (img.width < 200 || img.height < 200) {
                            this.darkLogoError = 'Image must be at least 200x200 pixels.';
                            return;
                        }
                        this.darkLogoError = '';
                    };

                    const reader = new FileReader();
                    reader.onloadend = () => {
                        this.darkLogoPreview = reader.result;
                    };
                    reader.readAsDataURL(file);
                    img.src = URL.createObjectURL(file);
                },
                removeDarkLogo() {
                    this.darkLogoPreview = '{{ $settings->dark_logo }}';
                    this.darkLogoError = '';
                }
            };
        }

        function faviconUpload() {
            return {
                faviconPreview: '{{ $settings->favicon }}',
                faviconError: '',
                handleFaviconUpload(event) {
                    const file = event.target.files[0];
                    if (!file) return;

                    if (!['image/jpeg', 'image/png'].includes(file.type)) {
                        this.faviconError = 'Please upload a JPEG or PNG file.';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onloadend = () => {
                        this.faviconPreview = reader.result;
                    };
                    reader.readAsDataURL(file);
                },
                removeFavicon() {
                    this.faviconPreview = '{{ $settings->favicon }}';
                    this.faviconError = '';
                }
            };
        }

        // Form submission enhancement
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById('settingsForm');
            const submitBtn = document.getElementById('submitBtn');
            const submitText = submitBtn.querySelector('.submit-text');
            const loadingSpinner = submitBtn.querySelector('.loading-spinner');

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                submitBtn.disabled = true;
                submitText.textContent = '{{ __('Saving Settings...') }}';
                loadingSpinner.classList.remove('hidden');
                
                setTimeout(() => {
                    form.submit();
                }, 1000);
            });

            // Add smooth entrance animation
            const card = document.querySelector('.bg-white');
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'all 0.6s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100);
        });
    </script>
</x-app-layout>