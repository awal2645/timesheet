@section('title', 'Create Testimonial')

<x-app-layout>
    <!-- Breadcrumb Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 mt-6">
        <x-breadcrumb :items="[
            [
                'label' => __('Testimonials'),
                'url' => route('testimonial.index'),
                'icon' => false
            ],
            [
                'label' => __('Create New Testimonial'),
                'icon' => true
            ]
        ]" />
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white dark:bg-slate-800 shadow-2xl rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-green-50 to-emerald-100 dark:from-slate-700 dark:to-slate-800 px-8 py-8 border-b border-gray-200 dark:border-gray-600">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                            <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                            </div>
                            {{ __('Create New Testimonial') }}
                        </h2>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Add a new customer testimonial to showcase client satisfaction and build trust with potential customers.') }}
                        </p>
                    </div>
                    
                    <!-- Live Preview Toggle -->
                    <div class="hidden md:flex items-center space-x-4">
                        <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400">
                            <span>{{ __('Auto Preview') }}</span>
                            <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="p-8">
                <form action="{{ route('testimonial.store') }}" method="POST" enctype="multipart/form-data" id="testimonialForm" x-data="testimonialManager()" class="space-y-8">
            @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Form Fields -->
                        <div class="lg:col-span-2 space-y-6">
                            <!-- Personal Information Section -->
                            <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-gray-200 dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    {{ __('Personal Information') }}
                                </h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Name Field -->
                                    <div class="space-y-2">
                                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                            <svg class="w-4 h-4 mr-1 inline text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            {{ __('Full Name') }} <span class="text-red-500">*</span>
                                        </label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                               x-model="formData.name"
                                               class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200"
                                               placeholder="{{ __('Enter client\'s full name') }}">
                @error('name')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

                                    <!-- Designation Field -->
                                    <div class="space-y-2">
                                        <label for="designation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                            <svg class="w-4 h-4 mr-1 inline text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2v0"/>
                                            </svg>
                                            {{ __('Job Title') }} <span class="text-red-500">*</span>
                                        </label>
                <input type="text" name="designation" id="designation" value="{{ old('designation') }}" required
                                               x-model="formData.designation"
                                               class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200"
                                               placeholder="{{ __('e.g., CEO, Manager, Developer') }}">
                @error('designation')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                                    </div>
            </div>

                                <!-- Company Field -->
                                <div class="mt-6 space-y-2">
                                    <label for="company" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        <svg class="w-4 h-4 mr-1 inline text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                        {{ __('Company Name') }} <span class="text-red-500">*</span>
                                    </label>
                <input type="text" name="company" id="company" value="{{ old('company') }}" required
                                           x-model="formData.company"
                                           class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200"
                                           placeholder="{{ __('Enter company or organization name') }}">
                @error('company')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
                            </div>

                            <!-- Testimonial Content Section -->
                            <div class="bg-gradient-to-r from-green-50 to-emerald-100 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-green-200 dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    {{ __('Testimonial Content') }}
                                </h3>
                                
                                <!-- Description Field -->
                                <div class="space-y-2">
                                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        {{ __('Testimonial Message') }} <span class="text-red-500">*</span>
                                    </label>
                                    <textarea name="description" id="description" rows="6" required
                                              x-model="formData.description"
                                              @input="updateCharCount"
                                              class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 resize-none"
                                              placeholder="{{ __('Share what the client said about your service or product. Make it authentic and detailed...') }}">{{ old('description') }}</textarea>
                                    <div class="flex justify-between items-center text-sm text-gray-500">
                                        <span>{{ __('Write a compelling testimonial that highlights key benefits') }}</span>
                                        <span x-text="characterCount + '/500'"></span>
                                    </div>
                @error('description')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                                </div>
                            </div>

                            <!-- Rating and Image Section -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Rating Section -->
                                <div class="bg-gradient-to-r from-yellow-50 to-orange-100 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-yellow-200 dark:border-gray-600">
                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        {{ __('Rating') }}
                                    </h4>
                                    
                                    <div class="space-y-4">
                                        <!-- Star Rating -->
                                        <div class="flex items-center space-x-2">
                                            <template x-for="star in 5" :key="star">
                                                <button type="button" @click="setRating(star)" 
                                                        class="text-3xl transition-colors duration-200 hover:scale-110 transform"
                                                        :class="star <= formData.rating ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600'">
                                                    ★
                                                </button>
                                            </template>
                                        </div>
                                        
                                        <input type="hidden" name="rating" :value="formData.rating">
                                        
                                        <div class="text-sm text-gray-600 dark:text-gray-400">
                                            <span x-show="formData.rating === 0">{{ __('Click stars to rate') }}</span>
                                            <span x-show="formData.rating === 1">{{ __('Poor - Needs significant improvement') }}</span>
                                            <span x-show="formData.rating === 2">{{ __('Fair - Below expectations') }}</span>
                                            <span x-show="formData.rating === 3">{{ __('Good - Meets expectations') }}</span>
                                            <span x-show="formData.rating === 4">{{ __('Very Good - Exceeds expectations') }}</span>
                                            <span x-show="formData.rating === 5">{{ __('Excellent - Outstanding service') }}</span>
            </div>

                @error('rating')
                                            <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
                                    </div>
                                </div>

                                <!-- Image Upload Section -->
                                <div class="bg-gradient-to-r from-cyan-50 to-blue-100 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-cyan-200 dark:border-gray-600" x-data="{ isDragging: false }">
                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ __('Profile Photo') }}
                                    </h4>
                                    
                                    <div class="space-y-4">
                                        <!-- Image Preview -->
                                        <div class="flex justify-center">
                                            <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-gray-200 dark:border-gray-600 bg-gray-100 dark:bg-gray-700">
                                                <img x-show="imagePreview" :src="imagePreview" alt="Preview" class="w-full h-full object-cover">
                                                <div x-show="!imagePreview" class="w-full h-full flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Upload Button -->
                                        <div class="text-center">
                                            <label class="inline-flex items-center px-4 py-3 bg-gradient-to-r from-cyan-600 to-blue-600 hover:from-cyan-700 hover:to-blue-700 text-white rounded-lg cursor-pointer transition-all duration-200 transform hover:scale-105 shadow-md">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                                </svg>
                                                {{ __('Choose Photo') }}
                                                <input type="file" name="image" id="image" @change="handleImageUpload" accept="image/*" required class="hidden">
                                            </label>
                                            <p class="text-xs text-gray-500 mt-2">{{ __('PNG, JPG up to 5MB') }}</p>
            </div>

                @error('image')
                                            <p class="text-red-500 text-sm text-center">{{ $message }}</p>
                @enderror
            </div>
                                </div>
                            </div>
                        </div>

                        <!-- Live Preview Section -->
                        <div class="lg:col-span-1">
                            <div class="sticky top-8 bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-lg">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    {{ __('Live Preview') }}
                                </h3>
                                
                                <!-- Testimonial Card Preview -->
                                <div class="bg-gradient-to-br from-green-50 to-emerald-100 dark:from-gray-700 dark:to-gray-600 rounded-xl p-6 border border-green-200 dark:border-gray-500">
                                    <!-- Quote Icon -->
                                    <div class="flex justify-center mb-4">
                                        <svg class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-10zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h4v10h-10z"/>
                                        </svg>
                                    </div>
                                    
                                    <!-- Testimonial Text -->
                                    <p class="text-gray-700 dark:text-gray-300 text-center italic mb-6 min-h-[80px]" x-text="formData.description || '{{ __('Your testimonial message will appear here...') }}'"></p>
                                    
                                    <!-- Rating Stars -->
                                    <div class="flex justify-center mb-4">
                                        <template x-for="star in 5" :key="star">
                                            <span class="text-xl" :class="star <= formData.rating ? 'text-yellow-400' : 'text-gray-300'">★</span>
                                        </template>
                                    </div>
                                    
                                    <!-- Profile Info -->
                                    <div class="flex items-center justify-center space-x-4">
                                        <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-white shadow-md bg-gray-200 dark:bg-gray-600">
                                            <img x-show="imagePreview" :src="imagePreview" alt="Profile" class="w-full h-full object-cover">
                                            <div x-show="!imagePreview" class="w-full h-full flex items-center justify-center">
                                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <p class="font-semibold text-gray-900 dark:text-white" x-text="formData.name || '{{ __('Client Name') }}'"></p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400" x-text="formData.designation || '{{ __('Job Title') }}'"></p>
                                            <p class="text-sm text-gray-500 dark:text-gray-500" x-text="formData.company || '{{ __('Company') }}'"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Section -->
                    <div class="flex flex-col sm:flex-row items-center justify-between pt-8 border-t border-gray-200 dark:border-gray-600 space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="{{ route('testimonial.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl text-sm font-semibold text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-200 hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                    {{ __('Cancel') }}
                </a>
                        
                        <button type="submit" id="submitBtn" class="w-full sm:w-auto group inline-flex items-center justify-center px-10 py-4 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-green-500/50">
                            <div class="flex items-center justify-center w-6 h-6 bg-white/20 rounded-lg mr-3">
                                <svg class="w-4 h-4 transition-transform duration-200 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span class="submit-text">{{ __('Create Testimonial') }}</span>
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
                <div class="mt-8 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl p-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-semibold text-green-800 dark:text-green-300 mb-2">{{ __('Testimonial Best Practices') }}</h3>
                            <div class="text-sm text-green-700 dark:text-green-400 space-y-2">
                                <p class="flex items-start">
                                    <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ __('Include specific details about the service or product experience') }}
                                </p>
                                <p class="flex items-start">
                                    <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ __('Use professional profile photos with clear, high-quality images') }}
                                </p>
                                <p class="flex items-start">
                                    <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ __('Ensure ratings accurately reflect the client\'s satisfaction level') }}
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
        function testimonialManager() {
            return {
                formData: {
                    name: '{{ old('name') }}',
                    designation: '{{ old('designation') }}',
                    company: '{{ old('company') }}',
                    description: '{{ old('description') }}',
                    rating: {{ old('rating', 0) }}
                },
                imagePreview: null,
                characterCount: 0,

                init() {
                    this.characterCount = this.formData.description.length;
                },

                setRating(rating) {
                    this.formData.rating = rating;
                    this.showNotification(`{{ __('Rating set to') }} ${rating} {{ __('stars') }}`, 'success');
                },

                updateCharCount() {
                    this.characterCount = this.formData.description.length;
                    if (this.characterCount > 500) {
                        this.formData.description = this.formData.description.substring(0, 500);
                        this.characterCount = 500;
                        this.showNotification('{{ __('Maximum character limit reached') }}', 'warning');
                    }
                },

                handleImageUpload(event) {
                    const file = event.target.files[0];
                    if (!file) return;

                    // Validate file type
                    if (!file.type.startsWith('image/')) {
                        this.showNotification('{{ __('Please select a valid image file') }}', 'error');
                        event.target.value = '';
                        return;
                    }

                    // Validate file size (5MB max)
                    if (file.size > 5 * 1024 * 1024) {
                        this.showNotification('{{ __('Image size must be less than 5MB') }}', 'error');
                        event.target.value = '';
                        return;
                    }

                    // Create preview
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.imagePreview = e.target.result;
                        this.showNotification('{{ __('Image uploaded successfully') }}', 'success');
                    };
                    reader.readAsDataURL(file);
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
            const form = document.getElementById('testimonialForm');
            const submitBtn = document.getElementById('submitBtn');
            const submitText = submitBtn.querySelector('.submit-text');
            const loadingSpinner = submitBtn.querySelector('.loading-spinner');

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Validate required fields
                const name = document.getElementById('name').value.trim();
                const designation = document.getElementById('designation').value.trim();
                const company = document.getElementById('company').value.trim();
                const description = document.getElementById('description').value.trim();
                const image = document.getElementById('image').files[0];
                
                if (!name || !designation || !company || !description || !image) {
                    alert('{{ __('Please fill in all required fields') }}');
                    return;
                }
                
                submitBtn.disabled = true;
                submitText.textContent = '{{ __('Creating Testimonial...') }}';
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

            // Auto-focus first field
            document.getElementById('name').focus();
        });
    </script>
</x-app-layout>