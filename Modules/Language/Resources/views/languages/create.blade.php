@section('title', 'Add Language')

<x-app-layout>
    <!-- Breadcrumb Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 mt-6">
        <x-breadcrumb :items="[
            [
                'label' => __('Language Management'),
                'url' => route('languages.index'),
                'icon' => true
            ],
            [
                'label' => __('Add Language'),
                'icon' => true
            ]
        ]" />
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white dark:bg-slate-800 shadow-2xl rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-teal-50 to-cyan-100 dark:from-slate-700 dark:to-slate-800 px-8 py-8 border-b border-gray-200 dark:border-gray-600">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                            <div class="w-8 h-8 bg-teal-100 dark:bg-teal-900/30 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                                </svg>
                            </div>
                            {{ __('Add New Language') }}
                        </h2>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Configure a new language for your application with localization settings and display preferences.') }}
                        </p>
                    </div>
                    
                    <!-- Quick Stats -->
                    <div class="hidden md:flex flex-col items-end space-y-2">
                        <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400">
                            <span>{{ __('Available Languages') }}</span>
                            <div class="bg-teal-100 dark:bg-teal-900/30 text-teal-800 dark:text-teal-300 px-3 py-1 rounded-full font-semibold">
                                {{ count($translations) }}
                            </div>
                        </div>
                        <div class="text-xs text-gray-400 dark:text-gray-500">
                            {{ __('Language Configuration') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <div class="p-8">
                <!-- Error Display -->
                @if($errors->any())
                    <div class="mb-8 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <h3 class="text-sm font-medium text-red-800 dark:text-red-300">{{ __('Error') }}</h3>
                                <div class="text-sm text-red-700 dark:text-red-400 mt-1">{{ $errors->first() }}</div>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('languages.store') }}" method="POST" class="space-y-8" id="languageForm">
                    @csrf

                    <!-- Language Configuration Section -->
                    <div class="space-y-6">
                        <div class="border-b border-gray-200 dark:border-gray-600 pb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                                <svg class="w-5 h-5 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ __('Language Configuration') }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ __('Select the language and configure its display settings') }}</p>
                        </div>

                        <!-- Form Fields -->
                        <div class="space-y-6">
                            <!-- Language Selection -->
                            <div class="space-y-2">
                                <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                                        </svg>
                                        {{ __('Language') }} 
                                        <span class="text-red-500 ml-1">*</span>
                                    </span>
                                </label>
                                <div class="relative group">
                                    <select name="name" id="name" required
                                            class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md">
                                        <option value="" disabled selected>{{ __('Select a language...') }}</option>
                                        @foreach($translations as $code => $translation)
                                            <option value="{{ $code }}" {{ old('name') == $code ? 'selected' : '' }}>
                                                {{ $translation['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('name')
                                    <div class="flex items-center mt-2 p-3 text-red-700 bg-red-50 dark:bg-red-900/20 dark:text-red-400 rounded-lg border border-red-200 dark:border-red-800">
                                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-sm font-medium">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            <!-- Flag Selection -->
                            <div class="space-y-2">
                                <label for="icon" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/>
                                        </svg>
                                        {{ __('Flag') }} 
                                        <span class="text-red-500 ml-1">*</span>
                                    </span>
                                </label>
                                <div class="relative group">
                                    <select name="icon" id="icon" required
                                            class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md">
                                        <option value="" disabled selected>{{ __('Select a flag...') }}</option>
                                        @foreach($translations as $code => $translation)
                                            <option value="flag-icon-{{ $code }}" {{ old('icon') == "flag-icon-{$code}" ? 'selected' : '' }}>
                                                {{ $translation['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('icon')
                                    <div class="flex items-center mt-2 p-3 text-red-700 bg-red-50 dark:bg-red-900/20 dark:text-red-400 rounded-lg border border-red-200 dark:border-red-800">
                                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-sm font-medium">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            <!-- Text Direction -->
                            <div class="space-y-2">
                                <label for="direction" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18M13 8l4-4m0 0l-4-4m4 4H3"/>
                                        </svg>
                                        {{ __('Text Direction') }} 
                                        <span class="text-red-500 ml-1">*</span>
                                    </span>
                                </label>
                                <div class="relative group">
                                    <select name="direction" id="direction" required
                                            class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md">
                                        <option value="" disabled selected>{{ __('Select direction...') }}</option>
                                        <option value="ltr" {{ old('direction') == 'ltr' ? 'selected' : '' }}>{{ __('Left to Right (LTR)') }}</option>
                                        <option value="rtl" {{ old('direction') == 'rtl' ? 'selected' : '' }}>{{ __('Right to Left (RTL)') }}</option>
                                    </select>
                                </div>
                                @error('direction')
                                    <div class="flex items-center mt-2 p-3 text-red-700 bg-red-50 dark:bg-red-900/20 dark:text-red-400 rounded-lg border border-red-200 dark:border-red-800">
                                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-sm font-medium">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Language Preview -->
                    <div id="languagePreview" class="hidden bg-gradient-to-r from-blue-50 to-indigo-100 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-xl p-6 border border-blue-200 dark:border-blue-800">
                        <h4 class="text-sm font-semibold text-blue-800 dark:text-blue-300 mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            {{ __('Language Preview') }}
                        </h4>
                        <div id="previewContent" class="text-sm text-blue-700 dark:text-blue-400">
                            <!-- Preview details will be populated via JavaScript -->
                        </div>
                    </div>

                    <!-- Quick Language Templates -->
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-gray-200 dark:border-gray-600">
                        <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            {{ __('Quick Language Selection') }}
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                            <button type="button" onclick="selectLanguage('en')" 
                                    class="px-4 py-3 bg-teal-100 text-teal-700 rounded-lg hover:bg-teal-200 transition-colors text-sm font-medium text-left">
                                <div class="font-semibold">{{ __('English') }}</div>
                                <div class="text-xs text-teal-600">LTR • Standard</div>
                            </button>
                            <button type="button" onclick="selectLanguage('es')" 
                                    class="px-4 py-3 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors text-sm font-medium text-left">
                                <div class="font-semibold">{{ __('Spanish') }}</div>
                                <div class="text-xs text-blue-600">LTR • Popular</div>
                            </button>
                            <button type="button" onclick="selectLanguage('fr')" 
                                    class="px-4 py-3 bg-purple-100 text-purple-700 rounded-lg hover:bg-purple-200 transition-colors text-sm font-medium text-left">
                                <div class="font-semibold">{{ __('French') }}</div>
                                <div class="text-xs text-purple-600">LTR • European</div>
                            </button>
                            <button type="button" onclick="selectLanguage('de')" 
                                    class="px-4 py-3 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-colors text-sm font-medium text-left">
                                <div class="font-semibold">{{ __('German') }}</div>
                                <div class="text-xs text-green-600">LTR • European</div>
                            </button>
                            <button type="button" onclick="selectLanguage('ar')" 
                                    class="px-4 py-3 bg-orange-100 text-orange-700 rounded-lg hover:bg-orange-200 transition-colors text-sm font-medium text-left">
                                <div class="font-semibold">{{ __('Arabic') }}</div>
                                <div class="text-xs text-orange-600">RTL • Middle East</div>
                            </button>
                            <button type="button" onclick="selectLanguage('zh')" 
                                    class="px-4 py-3 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors text-sm font-medium text-left">
                                <div class="font-semibold">{{ __('Chinese') }}</div>
                                <div class="text-xs text-red-600">LTR • Asian</div>
                            </button>
                        </div>
                    </div>

                    <!-- Help Section -->
                    <div class="bg-teal-50 dark:bg-teal-900/20 border border-teal-200 dark:border-teal-800 rounded-xl p-6 mt-8">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-semibold text-teal-800 dark:text-teal-300 mb-2">
                                    {{ __('Language Configuration Guidelines') }}
                                </h3>
                                <div class="text-sm text-teal-700 dark:text-teal-400 space-y-2">
                                    <p class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ __('Choose the appropriate language from the dropdown list') }}
                                    </p>
                                    <p class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ __('Flag selection will automatically match the selected language') }}
                                    </p>
                                    <p class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ __('Text direction affects how content is displayed (LTR for most languages, RTL for Arabic/Hebrew)') }}
                                    </p>
                                    <p class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ __('Use quick templates for common languages or configure manually') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-between pt-8 border-t border-gray-200 dark:border-gray-600 space-y-4 sm:space-y-0">
                        <a href="{{ route('languages.index') }}" 
                           class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl text-sm font-semibold text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-200 hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            {{ __('Back to Languages') }}
                        </a>
                        
                        <button type="submit" id="submitBtn"
                                class="w-full sm:w-auto group inline-flex items-center justify-center px-10 py-4 bg-gradient-to-r from-teal-600 to-cyan-600 hover:from-teal-700 hover:to-cyan-700 text-white font-bold rounded-xl transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-teal-500/50 backdrop-blur-sm disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                            <div class="flex items-center justify-center w-6 h-6 bg-white/20 rounded-lg mr-3">
                                <svg class="w-4 h-4 transition-transform duration-200 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </div>
                            <span class="submit-text">{{ __('Add Language') }}</span>
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
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById('languageForm');
            const submitBtn = document.getElementById('submitBtn');
            const submitText = submitBtn.querySelector('.submit-text');
            const loadingSpinner = submitBtn.querySelector('.loading-spinner');
            const nameSelect = document.getElementById('name');
            const iconSelect = document.getElementById('icon');
            const directionSelect = document.getElementById('direction');
            const languagePreview = document.getElementById('languagePreview');
            const previewContent = document.getElementById('previewContent');

            // Auto-focus first field
            setTimeout(() => nameSelect.focus(), 100);

            // Language data for quick setup
            const languageConfig = {
                'en': { direction: 'ltr', name: 'English' },
                'es': { direction: 'ltr', name: 'Spanish' },
                'fr': { direction: 'ltr', name: 'French' },
                'de': { direction: 'ltr', name: 'German' },
                'ar': { direction: 'rtl', name: 'Arabic' },
                'zh': { direction: 'ltr', name: 'Chinese' },
                'ja': { direction: 'ltr', name: 'Japanese' },
                'ko': { direction: 'ltr', name: 'Korean' },
                'ru': { direction: 'ltr', name: 'Russian' },
                'pt': { direction: 'ltr', name: 'Portuguese' },
                'it': { direction: 'ltr', name: 'Italian' },
                'nl': { direction: 'ltr', name: 'Dutch' },
                'hi': { direction: 'ltr', name: 'Hindi' },
                'he': { direction: 'rtl', name: 'Hebrew' },
                'tr': { direction: 'ltr', name: 'Turkish' }
            };

            // Auto-sync language selection
            nameSelect.addEventListener('change', function() {
                const selectedCode = this.value;
                if (selectedCode && languageConfig[selectedCode]) {
                    // Auto-select matching flag
                    iconSelect.value = `flag-icon-${selectedCode}`;
                    
                    // Auto-select direction
                    directionSelect.value = languageConfig[selectedCode].direction;
                    
                    // Show preview
                    updatePreview(selectedCode);
                    
                    showNotification(`{{ __('Auto-configured') }}: ${languageConfig[selectedCode].name}`, 'success');
                }
            });

            // Quick language selection function
            window.selectLanguage = function(code) {
                if (languageConfig[code]) {
                    nameSelect.value = code;
                    iconSelect.value = `flag-icon-${code}`;
                    directionSelect.value = languageConfig[code].direction;
                    
                    // Trigger change events
                    nameSelect.dispatchEvent(new Event('change'));
                    
                    updatePreview(code);
                    showNotification(`{{ __('Quick template applied') }}: ${languageConfig[code].name}`, 'success');
                }
            };

            // Update language preview
            function updatePreview(code) {
                if (languageConfig[code]) {
                    const config = languageConfig[code];
                    previewContent.innerHTML = `
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <div class="font-semibold text-blue-800 dark:text-blue-300">{{ __('Language') }}</div>
                                <div class="text-blue-700 dark:text-blue-400">${config.name}</div>
                            </div>
                            <div>
                                <div class="font-semibold text-blue-800 dark:text-blue-300">{{ __('Code') }}</div>
                                <div class="text-blue-700 dark:text-blue-400 font-mono">${code}</div>
                            </div>
                            <div>
                                <div class="font-semibold text-blue-800 dark:text-blue-300">{{ __('Direction') }}</div>
                                <div class="text-blue-700 dark:text-blue-400 uppercase">${config.direction}</div>
                            </div>
                        </div>
                        <div class="mt-3 p-3 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                            <div class="text-xs text-blue-600 dark:text-blue-400">
                                {{ __('Preview text will appear') }} ${config.direction === 'rtl' ? '← هكذا' : 'like this →'}
                            </div>
                        </div>
                    `;
                    languagePreview.classList.remove('hidden');
                } else {
                    languagePreview.classList.add('hidden');
                }
            }

            function showNotification(message, type = 'info') {
                const colors = {
                    success: 'bg-green-500',
                    info: 'bg-blue-500',
                    warning: 'bg-yellow-500',
                    error: 'bg-red-500'
                };

                const notification = document.createElement('div');
                notification.className = `fixed top-4 right-4 ${colors[type]} text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full`;
                notification.textContent = message;
                document.body.appendChild(notification);

                // Slide in animation
                setTimeout(() => {
                    notification.classList.remove('translate-x-full');
                }, 100);

                // Remove after 3 seconds
                setTimeout(() => {
                    notification.classList.add('translate-x-full');
                    setTimeout(() => {
                        notification.remove();
                    }, 300);
                }, 3000);
            }

            // Form validation
            function validateForm() {
                let isValid = true;
                
                // Check language selection
                if (!nameSelect.value) {
                    nameSelect.classList.add('border-red-500', 'bg-red-50', 'dark:bg-red-900/20');
                    isValid = false;
                } else {
                    nameSelect.classList.remove('border-red-500', 'bg-red-50', 'dark:bg-red-900/20');
                    nameSelect.classList.add('border-green-400');
                }

                // Check flag selection
                if (!iconSelect.value) {
                    iconSelect.classList.add('border-red-500', 'bg-red-50', 'dark:bg-red-900/20');
                    isValid = false;
                } else {
                    iconSelect.classList.remove('border-red-500', 'bg-red-50', 'dark:bg-red-900/20');
                    iconSelect.classList.add('border-green-400');
                }

                // Check direction selection
                if (!directionSelect.value) {
                    directionSelect.classList.add('border-red-500', 'bg-red-50', 'dark:bg-red-900/20');
                    isValid = false;
                } else {
                    directionSelect.classList.remove('border-red-500', 'bg-red-50', 'dark:bg-red-900/20');
                    directionSelect.classList.add('border-green-400');
                }
                
                return isValid;
            }

            // Enhanced form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                if (!validateForm()) {
                    showNotification('{{ __('Please fill in all required fields') }}', 'error');
                    return;
                }
                
                // Show loading state
                submitBtn.disabled = true;
                submitText.textContent = '{{ __('Adding Language...') }}';
                loadingSpinner.classList.remove('hidden');
                
                // Submit form after brief delay
                setTimeout(() => {
                    form.submit();
                }, 1000);
            });

            // Enhanced visual feedback
            const formInputs = form.querySelectorAll('select');
            formInputs.forEach(input => {
                input.addEventListener('focus', function() {
                    if (this.parentElement) {
                        this.parentElement.classList.add('ring-2', 'ring-teal-500/20');
                    }
                });
                
                input.addEventListener('blur', function() {
                    if (this.parentElement) {
                        this.parentElement.classList.remove('ring-2', 'ring-teal-500/20');
                    }
                });

                input.addEventListener('change', function() {
                    if (this.value) {
                        this.classList.add('border-green-400');
                        this.classList.remove('border-red-500', 'bg-red-50', 'dark:bg-red-900/20');
                    }
                });
            });

            // Keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                // Ctrl/Cmd + S to save
                if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                    e.preventDefault();
                    if (validateForm()) {
                        form.dispatchEvent(new Event('submit'));
                    }
                }
                
                // Escape to go back
                if (e.key === 'Escape') {
                    window.location.href = '{{ route('languages.index') }}';
                }

                // Quick shortcuts for common languages
                if (e.ctrlKey || e.metaKey) {
                    switch(e.key) {
                        case '1':
                            e.preventDefault();
                            selectLanguage('en');
                            break;
                        case '2':
                            e.preventDefault();
                            selectLanguage('es');
                            break;
                        case '3':
                            e.preventDefault();
                            selectLanguage('fr');
                            break;
                        case '4':
                            e.preventDefault();
                            selectLanguage('de');
                            break;
                    }
                }
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