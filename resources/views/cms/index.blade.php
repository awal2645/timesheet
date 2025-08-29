@section('title', 'CMS Management')

<x-app-layout>
    <!-- Breadcrumb Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 mt-6">
        <x-breadcrumb :items="[
            [
                'label' => __('CMS Management'),
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            {{ __('CMS Management') }}
                        </h2>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Manage your website content and images. Upload high-quality images for banners, features, and client sections.') }}
                        </p>
                    </div>
                    
                    <!-- Upload Progress -->
                    <div class="hidden md:flex items-center space-x-4">
                        <div id="uploadProgress" class="hidden flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400">
                            <div class="w-4 h-4 border-2 border-cyan-500 border-t-transparent rounded-full animate-spin"></div>
                            <span>{{ __('Uploading...') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="p-8">
                <form action="{{ route('cms.update') }}" method="POST" enctype="multipart/form-data" id="cmsForm" x-data="imageUploadManager()" class="space-y-8">
            @csrf
            @method('PUT')

                    <!-- Hero Section Images -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-100 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-blue-200 dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            {{ __('Hero & Main Sections') }}
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach(['banner_image', 'approach_image'] as $image)
                            <div class="image-upload-container" x-data="{ isDragging: false }">
                                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border-2 border-dashed transition-all duration-300"
                                     :class="isDragging ? 'border-cyan-500 bg-cyan-50 dark:bg-cyan-900/20' : 'border-gray-300 dark:border-gray-600'"
                                     @dragover.prevent="isDragging = true"
                                     @dragleave.prevent="isDragging = false"
                                     @drop.prevent="handleDrop(event, '{{ $image }}'); isDragging = false">
                                    
                                    <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">{{ ucfirst(str_replace('_', ' ', $image)) }}</h4>
                                    
                                    <!-- Image Preview -->
                                    <div class="preview-container mb-6">
                                        @if($cms->$image)
                                            <div class="relative group">
                                                <img src="{{ asset($cms->$image) }}" alt="{{ ucfirst(str_replace('_', ' ', $image)) }}" 
                                                     class="w-full h-48 rounded-lg object-cover shadow-md">
                                                <div class="absolute inset-0 bg-black bg-opacity-50 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                                    </svg>
                                                </div>
                                            </div>
                                        @else
                                            <div class="w-full h-48 bg-gray-100 dark:bg-gray-700 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600 flex items-center justify-center">
                                                <div class="text-center">
                                                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                    <p class="text-sm text-gray-500">{{ __('No image uploaded') }}</p>
                                                </div>
                                            </div>
                                        @endif
                                        
                                        <!-- Dynamic Preview -->
                                        <img :src="imagePreviews['{{ $image }}']" alt="Preview" 
                                             class="w-full h-48 rounded-lg object-cover shadow-md mt-4" 
                                             x-show="imagePreviews['{{ $image }}']" 
                                             style="display: none;">
                                    </div>

                                    <!-- Upload Button -->
                                    <label class="flex items-center justify-center px-6 py-3 bg-gradient-to-r from-cyan-600 to-teal-600 hover:from-cyan-700 hover:to-teal-700 text-white rounded-lg cursor-pointer transition-all duration-200 transform hover:scale-105 shadow-md">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                        </svg>
                                        {{ __('Choose Image') }}
                                        <input type="file" id="{{ $image }}" name="{{ $image }}" 
                                               @change="handleImageUpload(event, '{{ $image }}')" 
                                               accept="image/jpeg,image/png,image/webp" 
                                               class="hidden">
                                    </label>
                                    
                                    <p class="text-xs text-gray-500 mt-2 text-center">{{ __('Drag & drop or click to upload') }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Features Section Images -->
                    <div class="bg-gradient-to-r from-green-50 to-emerald-100 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-green-200 dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                            {{ __('Features Section') }}
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach(['features_image1', 'features_image2'] as $image)
                            <div class="image-upload-container" x-data="{ isDragging: false }">
                                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border-2 border-dashed transition-all duration-300"
                                     :class="isDragging ? 'border-green-500 bg-green-50 dark:bg-green-900/20' : 'border-gray-300 dark:border-gray-600'"
                                     @dragover.prevent="isDragging = true"
                                     @dragleave.prevent="isDragging = false"
                                     @drop.prevent="handleDrop(event, '{{ $image }}'); isDragging = false">
                                    
                                    <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">{{ ucfirst(str_replace('_', ' ', $image)) }}</h4>
                                    
                                    <!-- Image Preview -->
                                    <div class="preview-container mb-6">
                                        @if($cms->$image)
                                            <div class="relative group">
                                                <img src="{{ asset($cms->$image) }}" alt="{{ ucfirst(str_replace('_', ' ', $image)) }}" 
                                                     class="w-full h-48 rounded-lg object-cover shadow-md">
                                                <div class="absolute inset-0 bg-black bg-opacity-50 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                                    </svg>
                                                </div>
                                            </div>
                        @else
                                            <div class="w-full h-48 bg-gray-100 dark:bg-gray-700 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600 flex items-center justify-center">
                                                <div class="text-center">
                                                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                    <p class="text-sm text-gray-500">{{ __('No image uploaded') }}</p>
                                                </div>
                                            </div>
                        @endif
                                        
                                        <!-- Dynamic Preview -->
                                        <img :src="imagePreviews['{{ $image }}']" alt="Preview" 
                                             class="w-full h-48 rounded-lg object-cover shadow-md mt-4" 
                                             x-show="imagePreviews['{{ $image }}']" 
                                             style="display: none;">
                                    </div>

                                    <!-- Upload Button -->
                                    <label class="flex items-center justify-center px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white rounded-lg cursor-pointer transition-all duration-200 transform hover:scale-105 shadow-md">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                        </svg>
                                        {{ __('Choose Image') }}
                                        <input type="file" id="{{ $image }}" name="{{ $image }}" 
                                               @change="handleImageUpload(event, '{{ $image }}')" 
                                               accept="image/jpeg,image/png,image/webp" 
                                               class="hidden">
                                    </label>
                                    
                                    <p class="text-xs text-gray-500 mt-2 text-center">{{ __('Drag & drop or click to upload') }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Client Section Images -->
                    <div class="bg-gradient-to-r from-purple-50 to-pink-100 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-purple-200 dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            {{ __('Client Logos') }}
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                            @foreach(['client_image1', 'client_image2', 'client_image3', 'client_image4', 'client_image5', 'client_image6', 'client_image7'] as $image)
                            <div class="image-upload-container" x-data="{ isDragging: false }">
                                <div class="bg-white dark:bg-gray-800 rounded-xl p-4 border-2 border-dashed transition-all duration-300"
                                     :class="isDragging ? 'border-purple-500 bg-purple-50 dark:bg-purple-900/20' : 'border-gray-300 dark:border-gray-600'"
                                     @dragover.prevent="isDragging = true"
                                     @dragleave.prevent="isDragging = false"
                                     @drop.prevent="handleDrop(event, '{{ $image }}'); isDragging = false">
                                    
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-3">{{ ucfirst(str_replace('_', ' ', $image)) }}</h4>
                                    
                                    <!-- Image Preview -->
                                    <div class="preview-container mb-4">
                                        @if($cms->$image)
                                            <div class="relative group">
                                                <img src="{{ asset($cms->$image) }}" alt="{{ ucfirst(str_replace('_', ' ', $image)) }}" 
                                                     class="w-full h-24 rounded-lg object-contain bg-gray-50 dark:bg-gray-700 shadow-sm">
                                                <div class="absolute inset-0 bg-black bg-opacity-50 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                                    </svg>
                                                </div>
                                            </div>
                                        @else
                                            <div class="w-full h-24 bg-gray-100 dark:bg-gray-700 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600 flex items-center justify-center">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                        @endif
                                        
                                        <!-- Dynamic Preview -->
                                        <img :src="imagePreviews['{{ $image }}']" alt="Preview" 
                                             class="w-full h-24 rounded-lg object-contain bg-gray-50 dark:bg-gray-700 shadow-sm mt-2" 
                                             x-show="imagePreviews['{{ $image }}']" 
                                             style="display: none;">
                                    </div>

                                    <!-- Upload Button -->
                                    <label class="flex items-center justify-center px-3 py-2 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white rounded-lg cursor-pointer transition-all duration-200 transform hover:scale-105 shadow-sm text-sm">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        {{ __('Upload') }}
                                        <input type="file" id="{{ $image }}" name="{{ $image }}" 
                                               @change="handleImageUpload(event, '{{ $image }}')" 
                                               accept="image/jpeg,image/png,image/webp" 
                                               class="hidden">
                    </label>
                                </div>
                </div>
                @endforeach
                        </div>
            </div>
            
                    <!-- Submit Button -->
                    <div class="flex justify-end pt-8 border-t border-gray-200 dark:border-gray-600">
                        <button type="submit" id="submitBtn" class="group inline-flex items-center justify-center px-10 py-4 bg-gradient-to-r from-cyan-600 to-teal-600 hover:from-cyan-700 hover:to-teal-700 text-white font-bold rounded-xl transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-cyan-500/50">
                            <div class="flex items-center justify-center w-6 h-6 bg-white/20 rounded-lg mr-3">
                                <svg class="w-4 h-4 transition-transform duration-200 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span class="submit-text">{{ __('Update CMS Content') }}</span>
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

                <!-- Help Section -->
                <div class="mt-8 bg-cyan-50 dark:bg-cyan-900/20 border border-cyan-200 dark:border-cyan-800 rounded-xl p-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-cyan-600 dark:text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-semibold text-cyan-800 dark:text-cyan-300 mb-2">{{ __('CMS Image Guidelines') }}</h3>
                            <div class="text-sm text-cyan-700 dark:text-cyan-400 space-y-2">
                                <p class="flex items-start">
                                    <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ __('Banner images work best at 1920x1080 pixels for optimal display') }}
                                </p>
                                <p class="flex items-start">
                                    <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ __('Client logos should be high-resolution with transparent backgrounds') }}
                                </p>
                                <p class="flex items-start">
                                    <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ __('Supported formats: JPEG, PNG, WebP (max 10MB per image)') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced JavaScript -->
    <script>
        function imageUploadManager() {
            return {
                imagePreviews: {},
                uploadProgress: false,

                handleImageUpload(event, imageKey) {
                    const file = event.target.files[0];
                    if (!file) return;
    
                    // Validate file type
                    if (!['image/jpeg', 'image/png', 'image/webp'].includes(file.type)) {
                        this.showNotification('{{ __('Please upload a JPEG, PNG, or WebP file.') }}', 'error');
                        event.target.value = '';
                        return;
                    }

                    // Validate file size (10MB max)
                    if (file.size > 10 * 1024 * 1024) {
                        this.showNotification('{{ __('File size must be less than 10MB.') }}', 'error');
                        event.target.value = '';
                        return;
                    }

                    // Show upload progress
                    this.uploadProgress = true;
                    document.getElementById('uploadProgress').classList.remove('hidden');
    
                    // Read and preview the file
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.imagePreviews[imageKey] = e.target.result;
                        this.uploadProgress = false;
                        document.getElementById('uploadProgress').classList.add('hidden');
                        this.showNotification('{{ __('Image uploaded successfully!') }}', 'success');
                    };
                    reader.readAsDataURL(file);
                },

                handleDrop(event, imageKey) {
                    const files = event.dataTransfer.files;
                    if (files.length > 0) {
                        const file = files[0];
                        const fakeEvent = { target: { files: [file] } };
                        this.handleImageUpload(fakeEvent, imageKey);
                    }
                },

                showNotification(message, type = 'info') {
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
            };
        }

        // Enhanced form submission
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('cmsForm');
            const submitBtn = document.getElementById('submitBtn');
            const submitText = submitBtn.querySelector('.submit-text');
            const loadingSpinner = submitBtn.querySelector('.loading-spinner');

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                submitBtn.disabled = true;
                submitText.textContent = '{{ __('Updating Content...') }}';
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

