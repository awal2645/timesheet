@section('title', 'Theme Customization')

<x-app-layout>
    <!-- Breadcrumb Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 mt-6">
        <x-breadcrumb :items="[
            [
                'label' => __('Theme Customization'),
                'icon' => true
            ]
        ]" />
    </div>

        <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white dark:bg-slate-800 shadow-2xl rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-cyan-50 to-teal-100 dark:from-slate-700 dark:to-slate-800 px-8 py-8 border-b border-gray-200 dark:border-gray-600">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                            <div class="w-8 h-8 bg-cyan-100 dark:bg-cyan-900/30 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-cyan-600 dark:text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                                </svg>
                            </div>
                            {{ __('Theme Customization') }}
                        </h2>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Customize your application\'s appearance with colors, fonts, and visual elements to match your brand.') }}
            </p>
        </div>
                    
                    <!-- Theme Preview Toggle -->
                    <div class="hidden md:flex items-center space-x-4">
                        <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400">
                            <span>{{ __('Live Preview') }}</span>
                            <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                        </div>
                        
                        <!-- Live Preview Toggle Button -->
                        <button type="button" onclick="toggleLivePreview()" class="inline-flex items-center px-4 py-2 bg-indigo-100 hover:bg-indigo-200 dark:bg-indigo-900/30 dark:hover:bg-indigo-900/50 text-indigo-800 dark:text-indigo-300 rounded-lg transition-all duration-200 text-sm font-medium">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            {{ __('Toggle Preview') }}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="p-8">
                <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                <!-- Form Section -->
                    <div class="xl:col-span-2 space-y-8">
                        <!-- Quick Theme Presets -->
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-gray-200 dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                {{ __('Quick Theme Presets') }}
                            </h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                <button type="button" onclick="applyPreset('default')" class="preset-btn bg-blue-100 text-blue-800 p-3 rounded-lg hover:bg-blue-200 transition-colors duration-200 text-sm font-medium">
                                    <div class="w-full h-4 bg-gradient-to-r from-blue-500 to-indigo-600 rounded mb-2"></div>
                                    {{ __('Default') }}
                                </button>
                                <button type="button" onclick="applyPreset('dark')" class="preset-btn bg-gray-100 text-gray-800 p-3 rounded-lg hover:bg-gray-200 transition-colors duration-200 text-sm font-medium">
                                    <div class="w-full h-4 bg-gradient-to-r from-gray-800 to-black rounded mb-2"></div>
                                    {{ __('Dark Pro') }}
                                </button>
                                <button type="button" onclick="applyPreset('nature')" class="preset-btn bg-green-100 text-green-800 p-3 rounded-lg hover:bg-green-200 transition-colors duration-200 text-sm font-medium">
                                    <div class="w-full h-4 bg-gradient-to-r from-green-500 to-emerald-600 rounded mb-2"></div>
                                    {{ __('Nature') }}
                                </button>
                                <button type="button" onclick="applyPreset('sunset')" class="preset-btn bg-orange-100 text-orange-800 p-3 rounded-lg hover:bg-orange-200 transition-colors duration-200 text-sm font-medium">
                                    <div class="w-full h-4 bg-gradient-to-r from-orange-500 to-red-500 rounded mb-2"></div>
                                    {{ __('Sunset') }}
                                </button>
                            </div>
                        </div>

                        <!-- Main Form -->
                        <form method="POST" action="{{ route('themes.update') }}" id="themeForm" class="space-y-8">
                        @csrf
                        @method('PUT')

                            <!-- Color Customization -->
                            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                                    </svg>
                                    {{ __('Color Palette') }}
                                </h3>
                                
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                                    <!-- Primary Color -->
                                    <div class="space-y-3">
                                        <label for="primary_color" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                            <svg class="w-4 h-4 mr-2 inline text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                                            </svg>
                                            {{ __('Primary Color') }}
                                </label>
                                        <div class="flex items-center space-x-3">
                                            <input type="color" id="primary_color" name="primary_color" value="{{ $theme->primary_color ?? '#3b82f6' }}" class="h-12 w-16 rounded-lg border-2 border-gray-300 dark:border-gray-600 cursor-pointer hover:scale-105 transition-transform duration-200">
                                            <div class="flex-1">
                                                <div class="text-sm font-mono text-gray-600 dark:text-gray-400" id="primary_color_value">{{ $theme->primary_color ?? '#3b82f6' }}</div>
                                                <div class="text-xs text-gray-500">{{ __('Main brand color') }}</div>
                                            </div>
                                </div>
                            </div>

                                    <!-- Card Dark -->
                                    <div class="space-y-3">
                                        <label for="card_dark" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                            <svg class="w-4 h-4 mr-2 inline text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                                    </svg>
                                            {{ __('Card Dark') }}
                                </label>
                                        <div class="flex items-center space-x-3">
                                            <input type="color" id="card_dark" name="card_dark" value="{{ $theme->card_dark ?? '#1f2937' }}" class="h-12 w-16 rounded-lg border-2 border-gray-300 dark:border-gray-600 cursor-pointer hover:scale-105 transition-transform duration-200">
                                            <div class="flex-1">
                                                <div class="text-sm font-mono text-gray-600 dark:text-gray-400" id="card_dark_value">{{ $theme->card_dark ?? '#1f2937' }}</div>
                                                <div class="text-xs text-gray-500">{{ __('Dark mode cards') }}</div>
                                            </div>
                                </div>
                            </div>

                                    <!-- Card Light -->
                                    <div class="space-y-3">
                                        <label for="card_light" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                            <svg class="w-4 h-4 mr-2 inline text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                            {{ __('Card Light') }}
                                </label>
                                        <div class="flex items-center space-x-3">
                                            <input type="color" id="card_light" name="card_light" value="{{ $theme->card_light ?? '#ffffff' }}" class="h-12 w-16 rounded-lg border-2 border-gray-300 dark:border-gray-600 cursor-pointer hover:scale-105 transition-transform duration-200">
                                            <div class="flex-1">
                                                <div class="text-sm font-mono text-gray-600 dark:text-gray-400" id="card_light_value">{{ $theme->card_light ?? '#ffffff' }}</div>
                                                <div class="text-xs text-gray-500">{{ __('Light mode cards') }}</div>
                                            </div>
                                </div>
                            </div>

                            <!-- Sidebar Dark -->
                                    <div class="space-y-3">
                                        <label for="sidebar_dark" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Sidebar Dark') }}</label>
                                        <div class="flex items-center space-x-3">
                                            <input type="color" id="sidebar_dark" name="sidebar_dark" value="{{ $theme->sidebar_dark ?? '#111827' }}" class="h-12 w-16 rounded-lg border-2 border-gray-300 dark:border-gray-600 cursor-pointer hover:scale-105 transition-transform duration-200">
                                            <div class="flex-1">
                                                <div class="text-sm font-mono text-gray-600 dark:text-gray-400" id="sidebar_dark_value">{{ $theme->sidebar_dark ?? '#111827' }}</div>
                                                <div class="text-xs text-gray-500">{{ __('Dark sidebar') }}</div>
                                            </div>
                                </div>
                            </div>

                            <!-- Sidebar Light -->
                                    <div class="space-y-3">
                                        <label for="sidebar_light" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Sidebar Light') }}</label>
                                        <div class="flex items-center space-x-3">
                                            <input type="color" id="sidebar_light" name="sidebar_light" value="{{ $theme->sidebar_light ?? '#f9fafb' }}" class="h-12 w-16 rounded-lg border-2 border-gray-300 dark:border-gray-600 cursor-pointer hover:scale-105 transition-transform duration-200">
                                            <div class="flex-1">
                                                <div class="text-sm font-mono text-gray-600 dark:text-gray-400" id="sidebar_light_value">{{ $theme->sidebar_light ?? '#f9fafb' }}</div>
                                                <div class="text-xs text-gray-500">{{ __('Light sidebar') }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Body Dark -->
                                    <div class="space-y-3">
                                        <label for="body_dark" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Body Dark') }}</label>
                                        <div class="flex items-center space-x-3">
                                            <input type="color" id="body_dark" name="body_dark" value="{{ $theme->body_dark ?? '#0f172a' }}" class="h-12 w-16 rounded-lg border-2 border-gray-300 dark:border-gray-600 cursor-pointer hover:scale-105 transition-transform duration-200">
                                            <div class="flex-1">
                                                <div class="text-sm font-mono text-gray-600 dark:text-gray-400" id="body_dark_value">{{ $theme->body_dark ?? '#0f172a' }}</div>
                                                <div class="text-xs text-gray-500">{{ __('Dark background') }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Body Light -->
                                    <div class="space-y-3">
                                        <label for="body_light" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Body Light') }}</label>
                                        <div class="flex items-center space-x-3">
                                            <input type="color" id="body_light" name="body_light" value="{{ $theme->body_light ?? '#f4f7fa' }}" class="h-12 w-16 rounded-lg border-2 border-gray-300 dark:border-gray-600 cursor-pointer hover:scale-105 transition-transform duration-200">
                                            <div class="flex-1">
                                                <div class="text-sm font-mono text-gray-600 dark:text-gray-400" id="body_light_value">{{ $theme->body_light ?? '#f4f7fa' }}</div>
                                                <div class="text-xs text-gray-500">{{ __('Light background') }}</div>
                                            </div>
                                </div>
                            </div>

                            <!-- Header Dark -->
                                    <div class="space-y-3">
                                        <label for="header_dark" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Header Dark') }}</label>
                                        <div class="flex items-center space-x-3">
                                            <input type="color" id="header_dark" name="header_dark" value="{{ $theme->header_dark ?? '#0f1215' }}" class="h-12 w-16 rounded-lg border-2 border-gray-300 dark:border-gray-600 cursor-pointer hover:scale-105 transition-transform duration-200">
                                            <div class="flex-1">
                                                <div class="text-sm font-mono text-gray-600 dark:text-gray-400" id="header_dark_value">{{ $theme->header_dark ?? '#0f1215' }}</div>
                                                <div class="text-xs text-gray-500">{{ __('Dark header') }}</div>
                                            </div>
                                </div>
                            </div>

                            <!-- Header Light -->
                                    <div class="space-y-3">
                                        <label for="header_light" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Header Light') }}</label>
                                        <div class="flex items-center space-x-3">
                                            <input type="color" id="header_light" name="header_light" value="{{ $theme->header_light ?? '#f8f9fa' }}" class="h-12 w-16 rounded-lg border-2 border-gray-300 dark:border-gray-600 cursor-pointer hover:scale-105 transition-transform duration-200">
                                            <div class="flex-1">
                                                <div class="text-sm font-mono text-gray-600 dark:text-gray-400" id="header_light_value">{{ $theme->header_light ?? '#f8f9fa' }}</div>
                                                <div class="text-xs text-gray-500">{{ __('Light header') }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Text Light -->
                                    <div class="space-y-3">
                                        <label for="text_light" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Text Light') }}</label>
                                        <div class="flex items-center space-x-3">
                                            <input type="color" id="text_light" name="text_light" value="{{ $theme->text_light ?? '#090606' }}" class="h-12 w-16 rounded-lg border-2 border-gray-300 dark:border-gray-600 cursor-pointer hover:scale-105 transition-transform duration-200">
                                            <div class="flex-1">
                                                <div class="text-sm font-mono text-gray-600 dark:text-gray-400" id="text_light_value">{{ $theme->text_light ?? '#090606' }}</div>
                                                <div class="text-xs text-gray-500">{{ __('Light mode text') }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Text Dark -->
                                    <div class="space-y-3">
                                        <label for="text_dark" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Text Dark') }}</label>
                                        <div class="flex items-center space-x-3">
                                            <input type="color" id="text_dark" name="text_dark" value="{{ $theme->text_dark ?? '#cfd3d0' }}" class="h-12 w-16 rounded-lg border-2 border-gray-300 dark:border-gray-600 cursor-pointer hover:scale-105 transition-transform duration-200">
                                            <div class="flex-1">
                                                <div class="text-sm font-mono text-gray-600 dark:text-gray-400" id="text_dark_value">{{ $theme->text_dark ?? '#cfd3d0' }}</div>
                                                <div class="text-xs text-gray-500">{{ __('Dark mode text') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Typography -->
                            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    {{ __('Typography') }}
                                </h3>
                                
                                <div class="space-y-4">
                                    <label for="font_family" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Font Family') }}</label>
                                    <select id="font_family" name="font_family" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all duration-200">
                                        @foreach (App\Models\Theme::AVAILABLE_FONTS as $name => $style)
                                            <option value="{{ $name }}" {{ ($theme->font_family ?? 'Inter') === $name ? 'selected' : '' }} style="font-family: {{ $style }}">
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('Choose a font that matches your brand personality') }}</div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row items-center justify-between pt-6 border-t border-gray-200 dark:border-gray-600 space-y-4 sm:space-y-0 sm:space-x-4">
                                <button type="button" onclick="resetToDefaults()" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl text-sm font-semibold text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-200 hover:scale-105">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                    </svg>
                                    {{ __('Reset to Default') }}
                                </button>
                                
                                <button type="submit" id="submitBtn" class="w-full sm:w-auto group inline-flex items-center justify-center px-10 py-4 bg-gradient-to-r from-cyan-600 to-teal-600 hover:from-cyan-700 hover:to-teal-700 text-white font-bold rounded-xl transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-cyan-500/50">
                                    <div class="flex items-center justify-center w-6 h-6 bg-white/20 rounded-lg mr-3">
                                        <svg class="w-4 h-4 transition-transform duration-200 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    <span class="submit-text">{{ __('Apply Theme') }}</span>
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

                    <!-- Live Preview Section -->
                    <div class="xl:col-span-1">
                        <div class="sticky top-8 space-y-6">
                            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    {{ __('Live Preview') }}
                                </h3>
                                
                                <div id="livePreview" class="space-y-4 p-6 rounded-xl border-2 border-dashed border-gray-200 dark:border-gray-600 transition-all duration-300">
                                    <!-- Mock UI Elements -->
                                    <div class="flex items-center justify-between">
                                        <h4 class="text-xl font-bold preview-text">{{ __('Dashboard') }}</h4>
                                        <div class="w-8 h-8 rounded-full preview-primary"></div>
                                    </div>
                                    
                                    <p class="preview-text text-sm">{{ __('This is how your interface will look with the selected theme. Changes are reflected in real-time.') }}</p>
                                    
                                    <div class="grid grid-cols-2 gap-3">
                                        <div class="preview-card p-4 rounded-lg">
                                            <div class="w-full h-2 preview-primary rounded mb-2"></div>
                                            <div class="text-xs preview-text">{{ __('Primary Card') }}</div>
                                        </div>
                                        <div class="preview-card p-4 rounded-lg">
                                            <div class="w-full h-2 bg-gray-300 rounded mb-2"></div>
                                            <div class="text-xs preview-text">{{ __('Secondary Card') }}</div>
                                </div>
                            </div>

                                    <div class="flex space-x-2">
                                        <button class="preview-button flex-1 py-2 px-4 rounded-lg text-xs font-medium transition-all duration-200">
                                            {{ __('Primary Button') }}
                                        </button>
                                        <button class="flex-1 py-2 px-4 rounded-lg text-xs font-medium border preview-text transition-all duration-200">
                                            {{ __('Secondary') }}
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Color Harmony Guide -->
                                <div class="mt-6 p-4 bg-cyan-50 dark:bg-cyan-900/20 rounded-lg border border-cyan-200 dark:border-cyan-800">
                                    <h4 class="text-sm font-semibold text-cyan-800 dark:text-cyan-300 mb-2">{{ __('Color Harmony Tips') }}</h4>
                                    <div class="text-xs text-cyan-700 dark:text-cyan-400 space-y-1">
                                        <p>• {{ __('Use contrasting colors for better readability') }}</p>
                                        <p>• {{ __('Limit your palette to 3-4 main colors') }}</p>
                                        <p>• {{ __('Test in both light and dark modes') }}</p>
                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        </div>

                <!-- Help Section -->
                <div class="mt-8 bg-cyan-50 dark:bg-cyan-900/20 border border-cyan-200 dark:border-cyan-800 rounded-xl p-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-cyan-600 dark:text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-semibold text-cyan-800 dark:text-cyan-300 mb-2">{{ __('Theme Customization Guide') }}</h3>
                            <div class="text-sm text-cyan-700 dark:text-cyan-400 space-y-2">
                                <p class="flex items-start">
                                    <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ __('Use quick presets as starting points for your custom theme') }}
                                </p>
                                <p class="flex items-start">
                                    <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ __('The live preview shows changes in real-time as you adjust colors') }}
                                </p>
                                <p class="flex items-start">
                                    <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ __('Remember to test your theme in both light and dark modes') }}
                                </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Enhanced JavaScript for Dynamic Theme Changes -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('themeForm');
            const submitBtn = document.getElementById('submitBtn');
            const submitText = submitBtn.querySelector('.submit-text');
            const loadingSpinner = submitBtn.querySelector('.loading-spinner');
            
            // Theme presets
            const presets = {
                default: {
                    primary_color: '#3b82f6',
                    card_dark: '#1f2937',
                    card_light: '#ffffff',
                    sidebar_dark: '#111827',
                    sidebar_light: '#f9fafb',
                    body_dark: '#0f172a',
                    body_light: '#f4f7fa',
                    header_dark: '#0f1215',
                    header_light: '#f8f9fa',
                    text_light: '#090606',
                    text_dark: '#cfd3d0',
                    font_family: 'Inter'
                },
                dark: {
                    primary_color: '#6366f1',
                    card_dark: '#111827',
                    card_light: '#f3f4f6',
                    sidebar_dark: '#000000',
                    sidebar_light: '#e5e7eb',
                    body_dark: '#030712',
                    body_light: '#f1f5f9',
                    header_dark: '#000000',
                    header_light: '#e2e8f0',
                    text_light: '#1e293b',
                    text_dark: '#e2e8f0',
                    font_family: 'Inter'
                },
                nature: {
                    primary_color: '#10b981',
                    card_dark: '#064e3b',
                    card_light: '#f0fdf4',
                    sidebar_dark: '#052e16',
                    sidebar_light: '#dcfce7',
                    body_dark: '#022c22',
                    body_light: '#f0fff4',
                    header_dark: '#052e16',
                    header_light: '#d1fae5',
                    text_light: '#14532d',
                    text_dark: '#a7f3d0',
                    font_family: 'Poppins'
                },
                sunset: {
                    primary_color: '#f97316',
                    card_dark: '#7c2d12',
                    card_light: '#fff7ed',
                    sidebar_dark: '#431407',
                    sidebar_light: '#fed7aa',
                    body_dark: '#2c1810',
                    body_light: '#fffbeb',
                    header_dark: '#431407',
                    header_light: '#fed7aa',
                    text_light: '#9a3412',
                    text_dark: '#fed7aa',
                    font_family: 'Montserrat'
                }
            };

            // Create dynamic CSS variables function
            function createDynamicCSS(colors) {
                let css = ':root {\n';
                
                // Primary color shades
                const primaryRgb = hexToRgb(colors.primary_color);
                for (let shade = 50; shade <= 900; shade += 50) {
                    const opacity = 1 - (shade / 1000);
                    css += `  --primary-${shade}: rgba(${primaryRgb.r}, ${primaryRgb.g}, ${primaryRgb.b}, ${opacity});\n`;
                }
                
                // Main theme colors
                Object.keys(colors).forEach(key => {
                    if (key !== 'font_family') {
                        css += `  --${key.replace('_', '-')}: ${colors[key]};\n`;
                    }
                });
                
                css += '}\n\n';
                
                // Font family
                if (colors.font_family) {
                    css += `body { font-family: "${colors.font_family}", system-ui, sans-serif; }\n`;
                }
                
                return css;
            }

            // Apply theme colors dynamically
            function applyThemeColors(colors) {
                // Remove existing dynamic theme
                let existingStyle = document.getElementById('dynamic-theme');
                if (existingStyle) {
                    existingStyle.remove();
                }
                
                // Create new dynamic theme
                const style = document.createElement('style');
                style.id = 'dynamic-theme';
                style.textContent = createDynamicCSS(colors);
                document.head.appendChild(style);
                
                // Apply real-time changes to the interface
                applyInterfaceChanges(colors);
                
                console.log('Applied dynamic theme:', colors);
            }

            // Apply interface changes in real-time
            function applyInterfaceChanges(colors) {
                const isDark = document.documentElement.classList.contains('dark');
                
                // Update body and main containers
                document.body.style.backgroundColor = isDark ? colors.body_dark : colors.body_light;
                document.body.style.color = isDark ? colors.text_dark : colors.text_light;
                
                // Update sidebar
                const sidebar = document.getElementById('sidebar');
                if (sidebar) {
                    sidebar.style.backgroundColor = isDark ? colors.sidebar_dark : colors.sidebar_light;
                }
                
                // Update header
                const header = document.querySelector('header, .header');
                if (header) {
                    header.style.backgroundColor = isDark ? colors.header_dark : colors.header_light;
                }
                
                // Update cards and panels
                const cards = document.querySelectorAll('.bg-white, .dark\\:bg-slate-800, .dark\\:bg-gray-800, .bg-gray-50');
                cards.forEach(card => {
                    card.style.backgroundColor = isDark ? colors.card_dark : colors.card_light;
                });
                
                // Update primary colored elements
                const primaryElements = document.querySelectorAll('.bg-indigo-500, .bg-blue-500, .bg-primary, [class*="bg-gradient"]');
                primaryElements.forEach(element => {
                    if (element.classList.contains('bg-gradient-to-r') || element.classList.contains('bg-gradient-to-l')) {
                        element.style.background = `linear-gradient(to right, ${colors.primary_color}, ${adjustColorBrightness(colors.primary_color, -20)})`;
                    } else {
                        element.style.backgroundColor = colors.primary_color;
                    }
                });
                
                // Update borders
                const borders = document.querySelectorAll('.border-gray-200, .dark\\:border-gray-700');
                borders.forEach(border => {
                    border.style.borderColor = isDark ? adjustColorBrightness(colors.card_dark, 20) : adjustColorBrightness(colors.card_light, -10);
                });
                
                // Update font family
                if (colors.font_family) {
                    document.body.style.fontFamily = `"${colors.font_family}", system-ui, sans-serif`;
                }
            }
            
            // Helper function to convert hex to RGB
            function hexToRgb(hex) {
                const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
                return result ? {
                    r: parseInt(result[1], 16),
                    g: parseInt(result[2], 16),
                    b: parseInt(result[3], 16)
                } : null;
            }
            
            // Helper function to adjust color brightness
            function adjustColorBrightness(hex, amount) {
                const usePound = hex[0] === "#";
                const col = usePound ? hex.slice(1) : hex;
                const num = parseInt(col, 16);
                let r = (num >> 16) + amount;
                let g = (num >> 8 & 0x00FF) + amount;
                let b = (num & 0x0000FF) + amount;
                r = r > 255 ? 255 : r < 0 ? 0 : r;
                g = g > 255 ? 255 : g < 0 ? 0 : g;
                b = b > 255 ? 255 : b < 0 ? 0 : b;
                return (usePound ? "#" : "") + (r << 16 | g << 8 | b).toString(16).padStart(6, '0');
            }

            // Apply preset function
            window.applyPreset = function(presetName) {
                const preset = presets[presetName];
                if (!preset) return;

                // Update form inputs
                Object.keys(preset).forEach(key => {
                    const input = document.getElementById(key);
                    if (input) {
                        input.value = preset[key];
                        updateColorValue(key, preset[key]);
                    }
                });

                // Apply theme immediately
                applyThemeColors(preset);
                updateLivePreview();
                showNotification(`{{ __('Applied') }} ${presetName} {{ __('preset') }}`, 'success');
            };

            // Reset to defaults
            window.resetToDefaults = function() {
                if (confirm('{{ __('Are you sure you want to reset to default colors?') }}')) {
                    applyPreset('default');
                }
            };

            // Update color value displays
            function updateColorValue(colorId, value) {
                const valueElement = document.getElementById(colorId + '_value');
                if (valueElement) {
                    valueElement.textContent = value;
                }
            }

            // Get current theme values from form
            function getCurrentTheme() {
                const theme = {};
                const inputs = form.querySelectorAll('input, select');
                inputs.forEach(input => {
                    if (input.name && input.value) {
                        theme[input.name] = input.value;
                    }
                });
                return theme;
            }

            // Live preview update
            function updateLivePreview() {
                const preview = document.getElementById('livePreview');
                const primaryColor = document.getElementById('primary_color').value;
                const cardLight = document.getElementById('card_light').value;
                const cardDark = document.getElementById('card_dark').value;
                const fontFamily = document.getElementById('font_family').value;

                // Apply font family
                preview.style.fontFamily = `"${fontFamily}", system-ui, sans-serif`;

                // Update preview elements
                const previewTexts = preview.querySelectorAll('.preview-text');
                const previewCards = preview.querySelectorAll('.preview-card');
                const previewPrimary = preview.querySelectorAll('.preview-primary');
                const previewButton = preview.querySelector('.preview-button');

                previewCards.forEach(card => {
                    card.style.backgroundColor = cardLight;
                    card.style.border = `1px solid ${primaryColor}20`;
                });

                previewPrimary.forEach(element => {
                    element.style.backgroundColor = primaryColor;
                });

                if (previewButton) {
                previewButton.style.backgroundColor = primaryColor;
                previewButton.style.color = getContrastColor(primaryColor);
                previewButton.style.boxShadow = `0 4px 14px ${primaryColor}40`;
                }

                // Update preview container
                preview.style.backgroundColor = cardLight;
                preview.style.borderColor = primaryColor + '40';
            }

            // Get contrast color
            function getContrastColor(hexcolor) {
                const r = parseInt(hexcolor.substr(1, 2), 16);
                const g = parseInt(hexcolor.substr(3, 2), 16);
                const b = parseInt(hexcolor.substr(5, 2), 16);
                const yiq = ((r * 299) + (g * 587) + (b * 114)) / 1000;
                return (yiq >= 128) ? '#000000' : '#ffffff';
            }

            // Show notifications
            function showNotification(message, type = 'info') {
                const colors = {
                    success: 'bg-green-500',
                    info: 'bg-blue-500',
                    warning: 'bg-yellow-500',
                    error: 'bg-red-500'
                };

                const notification = document.createElement('div');
                notification.className = `fixed top-4 right-4 ${colors[type]} text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300`;
                notification.innerHTML = `
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        ${message}
                    </div>
                `;
                document.body.appendChild(notification);

                setTimeout(() => notification.classList.remove('translate-x-full'), 100);
                setTimeout(() => {
                    notification.classList.add('translate-x-full');
                    setTimeout(() => notification.remove(), 300);
                }, 3000);
            }

            // Add event listeners for real-time updates
            const colorInputs = form.querySelectorAll('input[type="color"]');
            const fontSelect = document.getElementById('font_family');

            colorInputs.forEach(input => {
                input.addEventListener('input', function() {
                    updateColorValue(this.id, this.value);
                    
                    // Apply changes in real-time
                    const currentTheme = getCurrentTheme();
                    applyThemeColors(currentTheme);
                    updateLivePreview();
                });
            });

            fontSelect.addEventListener('change', function() {
                const currentTheme = getCurrentTheme();
                applyThemeColors(currentTheme);
                updateLivePreview();
            });

            // Enhanced form submission with persistence
            form.addEventListener('submit', function(e) {
                    e.preventDefault();
                
                submitBtn.disabled = true;
                submitText.textContent = '{{ __('Applying Theme...') }}';
                loadingSpinner.classList.remove('hidden');
                
                // Store theme in localStorage for persistence
                const currentTheme = getCurrentTheme();
                localStorage.setItem('dynamic_theme', JSON.stringify(currentTheme));
                
                setTimeout(() => {
                    form.submit();
                }, 1000);
            });

            // Load saved theme on page load
            function loadSavedTheme() {
                const savedTheme = localStorage.getItem('dynamic_theme');
                if (savedTheme) {
                    try {
                        const theme = JSON.parse(savedTheme);
                        applyThemeColors(theme);
                    } catch (e) {
                        console.log('Failed to load saved theme');
                    }
                }
            }

            // Initialize theme system
            function initializeTheme() {
                // Apply current form values as theme
                const currentTheme = getCurrentTheme();
                applyThemeColors(currentTheme);
                updateLivePreview();
                
                // Load any saved theme preferences
                loadSavedTheme();
            }

            // Run initialization
            initializeTheme();

            // Watch for dark mode changes
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.attributeName === 'class') {
                        const currentTheme = getCurrentTheme();
                        applyThemeColors(currentTheme);
                    }
                });
            });
            
            observer.observe(document.documentElement, {
                attributes: true,
                attributeFilter: ['class']
            });

            // Add smooth entrance animation
            const card = document.querySelector('.bg-white.dark\\:bg-slate-800');
            if (card) {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 100);
            }

            // Add live preview toggle functionality
            window.toggleLivePreview = function() {
                const isEnabled = document.body.classList.toggle('live-preview-disabled');
                showNotification(
                    isEnabled ? '{{ __('Live preview disabled') }}' : '{{ __('Live preview enabled') }}',
                    'info'
                );
            };
        });
    </script>
</x-app-layout>
