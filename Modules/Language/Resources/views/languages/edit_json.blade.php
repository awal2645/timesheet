@section('title', 'Edit Translations')

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
                'label' => __('Edit Translations'),
                'icon' => true
            ]
        ]" />
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white dark:bg-slate-800 shadow-2xl rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-orange-50 to-amber-100 dark:from-slate-700 dark:to-slate-800 px-8 py-8 border-b border-gray-200 dark:border-gray-600">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                            <div class="w-8 h-8 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                                </svg>
                            </div>
                            {{ __('Edit Translations') }}
                        </h2>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Manage translations for') }} <span class="font-semibold capitalize">{{ $language->name }}</span> {{ __('language pack') }}
                        </p>
                    </div>
                    
                    <!-- Language Info & Progress -->
                    <div class="hidden md:flex flex-col items-end space-y-2">
                        <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400">
                            <span>{{ __('Language') }}</span>
                            <div class="bg-orange-100 dark:bg-orange-900/30 text-orange-800 dark:text-orange-300 px-3 py-1 rounded-full font-semibold capitalize">
                                {{ $language->name }}
                            </div>
                        </div>
                        <div class="text-xs text-gray-400 dark:text-gray-500">
                            {{ __('Translation Management') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="p-8">
                <!-- Success Message -->
        @if(session('success'))
                    <div class="mb-8 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <h3 class="text-sm font-medium text-green-800 dark:text-green-300">{{ __('Success') }}</h3>
                                <div class="text-sm text-green-700 dark:text-green-400 mt-1">{{ session('success') }}</div>
                            </div>
                </div>
            </div>
        @endif

                <form action="{{ route('languages.trans.update') }}" method="POST" id="translationForm">
            @csrf
            <input type="hidden" name="lang_id" value="{{ $language->id }}">

                    <!-- Enhanced Search and Filters -->
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-gray-200 dark:border-gray-600 mb-8">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 lg:mb-0 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                {{ __('Search & Filter Translations') }}
                            </h3>
                            
                            <!-- Translation Progress -->
                            <div class="flex items-center space-x-4">
                                <div class="text-sm text-gray-600 dark:text-gray-400">
                                    <span class="font-medium">{{ count($translations) }}</span> {{ __('translations') }}
                                </div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">
                                    <span id="modifiedCount" class="font-medium text-orange-600">0</span> {{ __('modified') }}
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">
                            <!-- Search Input -->
                            <div class="lg:col-span-8">
                                <label for="keyword" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('Search') }}
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                        </svg>
                                    </div>
                                    <input type="text" 
                                           id="keyword"
                                           name="keyword" 
                                           value="{{ $keyword }}" 
                                           class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200"
                                           placeholder="{{ __('Search translation keys or values...') }}" />
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="lg:col-span-4 flex items-end space-x-3">
                                <button type="submit" name="action" value="search" class="group flex-1 inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                        {{ __('Search') }}
                    </button>
                </div>
            </div>

                        <!-- Quick Filters -->
                        <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex flex-wrap gap-2">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300 mr-4 flex items-center">{{ __('Quick Filters:') }}</span>
                                <button type="button" onclick="filterTranslations('empty')" class="quick-filter px-3 py-1.5 text-xs bg-orange-100 text-orange-700 rounded-full hover:bg-orange-200 transition-colors duration-200">
                                    {{ __('Empty Translations') }}
                                </button>
                                <button type="button" onclick="filterTranslations('modified')" class="quick-filter px-3 py-1.5 text-xs bg-green-100 text-green-700 rounded-full hover:bg-green-200 transition-colors duration-200">
                                    {{ __('Modified') }}
                                </button>
                                <button type="button" onclick="filterTranslations('long')" class="quick-filter px-3 py-1.5 text-xs bg-purple-100 text-purple-700 rounded-full hover:bg-purple-200 transition-colors duration-200">
                                    {{ __('Long Text') }}
                                </button>
                                <button type="button" onclick="filterTranslations('all')" class="quick-filter px-3 py-1.5 text-xs bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200 transition-colors duration-200">
                                    {{ __('Show All') }}
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Translation Progress Bar -->
                    <div class="mb-8 bg-gradient-to-r from-blue-50 to-indigo-100 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-xl p-6 border border-blue-200 dark:border-blue-800">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="text-sm font-semibold text-blue-800 dark:text-blue-300 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                                {{ __('Translation Progress') }}
                            </h4>
                            <span class="text-sm text-blue-600 dark:text-blue-400" id="progressText">
                                {{ __('Calculating...') }}
                            </span>
                        </div>
                        <div class="w-full bg-blue-200 dark:bg-blue-800 rounded-full h-3">
                            <div id="progressBar" class="bg-gradient-to-r from-blue-500 to-indigo-600 h-3 rounded-full transition-all duration-500" style="width: 0%"></div>
                        </div>
                    </div>

                    <!-- Translations Table -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                        <!-- Table Header -->
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                                    <svg class="w-5 h-5 mr-3 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    {{ __('Translation Entries') }}
                                    <span class="ml-3 px-3 py-1 text-sm bg-orange-100 dark:bg-orange-900/30 text-orange-800 dark:text-orange-300 rounded-full">
                                        {{ count($translations) }} {{ __('items') }}
                                    </span>
                                </h3>
                                
                                <!-- Bulk Actions -->
                                <div class="flex items-center space-x-3">
                                    <button type="button" onclick="clearAllTranslations()" class="inline-flex items-center px-4 py-2 text-sm font-medium text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-all duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        {{ __('Clear Modified') }}
                                    </button>
                                    <button type="button" onclick="autoTranslate()" class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-lg transition-all duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                        </svg>
                                        {{ __('Auto Complete') }}
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Table Content -->
            <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50 dark:bg-gray-900/50">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider w-1/3">
                                            {{ __('Translation Key') }}
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            {{ __('Translation Value') }}
                            </th>
                                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider w-24">
                                            {{ __('Status') }}
                            </th>
                        </tr>
                    </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700" id="translationsTable">
                        @foreach($translations as $key => $value)
                                        <tr class="translation-row hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-150" data-key="{{ $key }}">
                                            <td class="px-6 py-4">
                                                <div class="flex items-start">
                                                    <div class="flex-1">
                                                        <div class="text-sm font-medium text-gray-900 dark:text-white mb-1 font-mono">
                                    {{ $key }}
                                                        </div>
                                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                                            {{ __('Key Path') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="relative">
                                                    <textarea name="{{ $key }}" 
                                                              class="translation-input w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 resize-none"
                                                              placeholder="{{ __('Enter translation...') }}"
                                                              rows="2"
                                                              data-original="{{ $value }}"
                                                              oninput="trackChanges(this)">{{ $value }}</textarea>
                                                    <div class="absolute bottom-2 right-2 text-xs text-gray-400 dark:text-gray-500">
                                                        <span class="char-count">{{ strlen($value) }}</span> {{ __('chars') }}
                                                    </div>
                                                </div>
                                </td>
                                <td class="px-6 py-4">
                                                <div class="flex flex-col items-center space-y-1">
                                                    <div class="status-indicator w-3 h-3 rounded-full {{ empty($value) ? 'bg-red-400' : 'bg-green-400' }}"></div>
                                                    <span class="status-text text-xs text-gray-500 dark:text-gray-400">
                                                        {{ empty($value) ? __('Empty') : __('OK') }}
                                                    </span>
                                                </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

                        <!-- Pagination -->
                        @if(method_exists($translations, 'links'))
                            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                {{ $translations->links() }}
            </div>
                        @endif
                    </div>

                    <!-- Help Section -->
                    <div class="mt-8 bg-orange-50 dark:bg-orange-900/20 border border-orange-200 dark:border-orange-800 rounded-xl p-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-semibold text-orange-800 dark:text-orange-300 mb-2">
                                    {{ __('Translation Management Tips') }}
                                </h3>
                                <div class="text-sm text-orange-700 dark:text-orange-400 space-y-2">
                                    <p class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ __('Use search to quickly find specific translation keys') }}
                                    </p>
                                    <p class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ __('Empty translations will show as red status indicators') }}
                                    </p>
                                    <p class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ __('Changes are tracked in real-time before saving') }}
                                    </p>
                                    <p class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ __('Use bulk actions for efficient translation management') }}
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
                        
                        <button type="submit" id="saveBtn" name="action" value="save"
                                class="w-full sm:w-auto group inline-flex items-center justify-center px-10 py-4 bg-gradient-to-r from-orange-600 to-amber-600 hover:from-orange-700 hover:to-amber-700 text-white font-bold rounded-xl transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-orange-500/50 backdrop-blur-sm disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                            <div class="flex items-center justify-center w-6 h-6 bg-white/20 rounded-lg mr-3">
                                <svg class="w-4 h-4 transition-transform duration-200 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span class="save-text">{{ __('Save Translations') }}</span>
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
            const form = document.getElementById('translationForm');
            const saveBtn = document.getElementById('saveBtn');
            const saveText = saveBtn.querySelector('.save-text');
            const loadingSpinner = saveBtn.querySelector('.loading-spinner');
            const modifiedCount = document.getElementById('modifiedCount');
            const progressBar = document.getElementById('progressBar');
            const progressText = document.getElementById('progressText');
            
            let modifiedTranslations = new Set();

            // Track changes in real-time
            window.trackChanges = function(textarea) {
                const originalValue = textarea.dataset.original;
                const currentValue = textarea.value;
                const row = textarea.closest('.translation-row');
                const key = row.dataset.key;
                const statusIndicator = row.querySelector('.status-indicator');
                const statusText = row.querySelector('.status-text');
                const charCount = row.querySelector('.char-count');

                // Update character count
                charCount.textContent = currentValue.length;

                // Update status
                if (currentValue.trim() === '') {
                    statusIndicator.className = 'status-indicator w-3 h-3 rounded-full bg-red-400';
                    statusText.textContent = '{{ __('Empty') }}';
                } else {
                    statusIndicator.className = 'status-indicator w-3 h-3 rounded-full bg-green-400';
                    statusText.textContent = '{{ __('OK') }}';
                }

                // Track modifications
                if (currentValue !== originalValue) {
                    modifiedTranslations.add(key);
                    row.classList.add('bg-yellow-50', 'dark:bg-yellow-900/20', 'border-l-4', 'border-yellow-400');
                } else {
                    modifiedTranslations.delete(key);
                    row.classList.remove('bg-yellow-50', 'dark:bg-yellow-900/20', 'border-l-4', 'border-yellow-400');
                }

                updateModifiedCount();
                updateProgress();
            };

            // Update modified count
            function updateModifiedCount() {
                modifiedCount.textContent = modifiedTranslations.size;
                
                if (modifiedTranslations.size > 0) {
                    saveBtn.classList.add('ring-4', 'ring-orange-300', 'dark:ring-orange-700');
                    saveText.textContent = `{{ __('Save') }} ${modifiedTranslations.size} {{ __('Changes') }}`;
                } else {
                    saveBtn.classList.remove('ring-4', 'ring-orange-300', 'dark:ring-orange-700');
                    saveText.textContent = '{{ __('Save Translations') }}';
                }
            }

            // Update progress bar
            function updateProgress() {
                const totalTranslations = document.querySelectorAll('.translation-input').length;
                const completedTranslations = Array.from(document.querySelectorAll('.translation-input')).filter(input => input.value.trim() !== '').length;
                const percentage = totalTranslations > 0 ? (completedTranslations / totalTranslations) * 100 : 0;
                
                progressBar.style.width = percentage + '%';
                progressText.textContent = `${completedTranslations}/${totalTranslations} (${Math.round(percentage)}%)`;
            }

            // Filter translations
            window.filterTranslations = function(type) {
                const rows = document.querySelectorAll('.translation-row');
                
                rows.forEach(row => {
                    const input = row.querySelector('.translation-input');
                    const value = input.value.trim();
                    const isModified = modifiedTranslations.has(row.dataset.key);
                    let show = false;

                    switch(type) {
                        case 'empty':
                            show = value === '';
                            break;
                        case 'modified':
                            show = isModified;
                            break;
                        case 'long':
                            show = value.length > 100;
                            break;
                        case 'all':
                        default:
                            show = true;
                            break;
                    }

                    row.style.display = show ? '' : 'none';
                });
            };

            // Clear all modified translations
            window.clearAllTranslations = function() {
                if (modifiedTranslations.size === 0) {
                    showNotification('{{ __('No modified translations to clear') }}', 'warning');
                    return;
                }

                if (confirm('{{ __('Are you sure you want to clear all modifications?') }}')) {
                    modifiedTranslations.forEach(key => {
                        const row = document.querySelector(`[data-key="${key}"]`);
                        const input = row.querySelector('.translation-input');
                        input.value = input.dataset.original;
                        trackChanges(input);
                    });
                    showNotification('{{ __('All modifications cleared') }}', 'success');
                }
            };

            // Auto-complete empty translations
            window.autoTranslate = function() {
                const emptyInputs = Array.from(document.querySelectorAll('.translation-input')).filter(input => input.value.trim() === '');
                
                if (emptyInputs.length === 0) {
                    showNotification('{{ __('No empty translations found') }}', 'info');
                    return;
                }

                emptyInputs.forEach(input => {
                    const key = input.closest('.translation-row').dataset.key;
                    // Simple auto-completion: use key as value (you can enhance this)
                    input.value = key.split('.').pop().replace(/[_-]/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
                    trackChanges(input);
                });

                showNotification(`{{ __('Auto-completed') }} ${emptyInputs.length} {{ __('translations') }}`, 'success');
            };

            // Show notifications
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

                setTimeout(() => notification.classList.remove('translate-x-full'), 100);
                setTimeout(() => {
                    notification.classList.add('translate-x-full');
                    setTimeout(() => notification.remove(), 300);
                }, 3000);
            }

            // Enhanced form submission
            form.addEventListener('submit', function(e) {
                if (e.submitter?.value === 'save') {
                    e.preventDefault();
                    
                    // Show loading state
                    saveBtn.disabled = true;
                    saveText.textContent = '{{ __('Saving Translations...') }}';
                    loadingSpinner.classList.remove('hidden');
                    
                    // Submit form after brief delay
                    setTimeout(() => {
                        form.submit();
                    }, 1000);
                }
            });

            // Auto-resize textareas
            document.querySelectorAll('.translation-input').forEach(textarea => {
                textarea.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = Math.max(48, this.scrollHeight) + 'px';
                });
                
                // Initial resize
                textarea.style.height = Math.max(48, textarea.scrollHeight) + 'px';
            });

            // Keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                    e.preventDefault();
                    if (modifiedTranslations.size > 0) {
                        form.dispatchEvent(new Event('submit'));
                    }
                }
                
                if (e.key === 'Escape') {
                    window.location.href = '{{ route('languages.index') }}';
                }
            });

            // Initialize progress
            updateProgress();

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