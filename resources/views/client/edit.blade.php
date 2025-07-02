@section('title')
    {{ __('Edit Client') }}
@endsection

<x-app-layout>
    <!-- Breadcrumb Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 mt-6">
        <x-breadcrumb :items="[
            [
                'label' => __('Clients'),
                'url' => route('client.index'),
                'icon' => true
            ],
            [
                'label' => __('Edit Client') . ' #' . $client->id,
                'icon' => true
            ]
        ]" />
    </div>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white dark:bg-slate-800 shadow-2xl rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-slate-700 dark:to-slate-800 px-8 py-8 border-b border-gray-200 dark:border-gray-600">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                            <div class="w-8 h-8 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </div>
                            {{ __('Edit Client Information') }}
                        </h2>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Update client details. Fields marked with * are mandatory.') }}
                        </p>
                    </div>
                    
                    <!-- Client Status Badge -->
                    <div class="hidden md:flex items-center space-x-4">
                        <div class="bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300 px-4 py-2 rounded-full text-sm font-semibold">
                            {{ __('Client ID: #:id', ['id' => $client->id]) }}
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('Modified fields') }}</div>
                        <div class="w-2 h-2 bg-red-400 rounded-full"></div>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <div class="p-8">
                <form method="POST" action="{{ route('client.update', $client->id) }}" class="space-y-8" id="clientEditForm">
                    @csrf
                    @method('PUT')
                    
                    <!-- Basic Information Section -->
                    <div class="space-y-6">
                        <div class="border-b border-gray-200 dark:border-gray-600 pb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                                <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ __('Client Information') }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ __('Update client details and contact information') }}</p>
                        </div>

                        <!-- Form Grid - Basic Info -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Employer Selection -->
                            @if (auth('web')->user()->role != 'employer')
                            <div class="space-y-2">
                                <label for="employer_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                        {{ __('Employer') }} 
                                        <span class="text-red-500 ml-1">*</span>
                                    </span>
                                </label>
                                <div class="relative group">
                                    <select name="employer_id" id="employer_id" required
                                            class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 appearance-none hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md change-highlight">
                                        @foreach ($employers as $employer)
                                        <option value="{{ $employer->id }}" {{ $client->employer_id == $employer->id ? 'selected' : '' }}>
                                            {{ $employer->employer_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400 transition-colors duration-200 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                </div>
                                @error('employer_id')
                                <div class="flex items-center mt-2 p-3 text-red-700 bg-red-50 dark:bg-red-900/20 dark:text-red-400 rounded-lg border border-red-200 dark:border-red-800">
                                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm font-medium">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                            @endif
                            @if (auth('web')->user()->role == 'employer')
                            <input type="hidden" name="employer_id" value="{{ auth('web')->user()->employer->id }}">
                            @endif

                            <!-- Client Name -->
                            <div class="space-y-2">
                                <label for="client_name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                        {{ __('Client Name') }} 
                                        <span class="text-red-500 ml-1">*</span>
                                    </span>
                                </label>
                                <div class="relative group">
                                    <input type="text" name="client_name" id="client_name" required
                                           value="{{ old('client_name') ?? $client->client_name }}"
                                           data-original="{{ $client->client_name }}"
                                           class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md change-highlight"
                                           placeholder="Enter client company name..." />
                                </div>
                                @error('client_name')
                                <div class="flex items-center mt-2 p-3 text-red-700 bg-red-50 dark:bg-red-900/20 dark:text-red-400 rounded-lg border border-red-200 dark:border-red-800">
                                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm font-medium">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>

                            <!-- Client Email -->
                            <div class="space-y-2">
                                <label for="client_email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                        {{ __('Client Email') }} 
                                        <span class="text-red-500 ml-1">*</span>
                                    </span>
                                </label>
                                <div class="relative group">
                                    <input type="email" name="client_email" id="client_email" required
                                           value="{{ old('client_email') ?? $client->client_email }}"
                                           data-original="{{ $client->client_email }}"
                                           class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md change-highlight"
                                           placeholder="client@company.com" />
                                </div>
                                @error('client_email')
                                <div class="flex items-center mt-2 p-3 text-red-700 bg-red-50 dark:bg-red-900/20 dark:text-red-400 rounded-lg border border-red-200 dark:border-red-800">
                                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm font-medium">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>

                            <!-- Client Phone -->
                            <div class="space-y-2">
                                <label for="client_phone" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                        {{ __('Client Phone') }} 
                                        <span class="text-red-500 ml-1">*</span>
                                    </span>
                                </label>
                                <div class="relative group">
                                    <input type="text" name="client_phone" id="client_phone" required
                                           value="{{ old('client_phone') ?? $client->client_phone }}"
                                           data-original="{{ $client->client_phone }}"
                                           class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md change-highlight"
                                           placeholder="+1 (555) 123-4567" />
                                </div>
                                @error('client_phone')
                                <div class="flex items-center mt-2 p-3 text-red-700 bg-red-50 dark:bg-red-900/20 dark:text-red-400 rounded-lg border border-red-200 dark:border-red-800">
                                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm font-medium">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>

                            <!-- Contact Name -->
                            <div class="space-y-2">
                                <label for="contact_name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        {{ __('Contact Person') }} 
                                        <span class="text-red-500 ml-1">*</span>
                                    </span>
                                </label>
                                <div class="relative group">
                                    <input type="text" name="contact_name" id="contact_name" required
                                           value="{{ old('contact_name') ?? $client->contact_name }}"
                                           data-original="{{ $client->contact_name }}"
                                           class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md change-highlight"
                                           placeholder="Contact person name..." />
                                </div>
                                @error('contact_name')
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

                    <!-- Help Text Section -->
                    <div class="bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-xl p-6 mt-8">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-semibold text-emerald-800 dark:text-emerald-300 mb-2">
                                    {{ __('Update Information') }}
                                </h3>
                                <p class="text-sm text-emerald-700 dark:text-emerald-400">
                                    {{ __('Modify any client information as needed. Changed fields will be highlighted. Make sure all contact information is up to date for effective communication.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-between pt-8 border-t border-gray-200 dark:border-gray-600 space-y-4 sm:space-y-0">
                        <a href="{{ route('client.index') }}" 
                           class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl text-sm font-semibold text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-200 hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            {{ __('Cancel') }}
                        </a>
                        
                        <button type="submit" id="submitBtn"
                                class="w-full sm:w-auto group inline-flex items-center justify-center px-10 py-4 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold rounded-xl transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-green-500/50 backdrop-blur-sm disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                            <div class="flex items-center justify-center w-6 h-6 bg-white/20 rounded-lg mr-3">
                                <svg class="w-4 h-4 transition-transform duration-200 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="submit-text">{{ __('Update Client') }}</span>
                            <div class="loading-spinner hidden ml-3">
                                <svg class="animate-spin w-5 h-5 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </div>
                            <svg class="w-5 h-5 ml-3 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5-5 5M6 12h12"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript for Enhanced UX -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('clientEditForm');
            const submitBtn = document.getElementById('submitBtn');
            const submitText = submitBtn.querySelector('.submit-text');
            const loadingSpinner = submitBtn.querySelector('.loading-spinner');

            // Form submission with loading state
            form.addEventListener('submit', function() {
                submitBtn.disabled = true;
                submitText.textContent = '{{ __("Updating Client...") }}';
                loadingSpinner.classList.remove('hidden');
                submitBtn.classList.add('opacity-75');
            });

            // Track changes and highlight modified fields
            const changeTrackingFields = document.querySelectorAll('.change-highlight');
            changeTrackingFields.forEach(field => {
                const originalValue = field.dataset.original || field.value;
                
                function checkForChanges() {
                    const currentValue = field.type === 'select-one' ? field.options[field.selectedIndex].text : field.value;
                    const isChanged = currentValue !== originalValue;
                    
                    if (isChanged) {
                        field.classList.add('border-emerald-400', 'bg-emerald-50', 'dark:bg-emerald-900/20');
                        field.classList.remove('border-gray-300', 'border-green-300');
                    } else {
                        field.classList.remove('border-emerald-400', 'bg-emerald-50', 'dark:bg-emerald-900/20');
                        field.classList.add('border-gray-300');
                    }
                }

                field.addEventListener('input', checkForChanges);
                field.addEventListener('change', checkForChanges);
                
                // Initial check
                checkForChanges();
            });

            // Real-time form validation feedback
            const requiredFields = ['client_name', 'client_email', 'client_phone', 'contact_name'];
            const allFields = ['employer_id', 'client_name', 'client_email', 'client_phone', 'contact_name'];
            
            allFields.forEach(fieldName => {
                const field = document.getElementById(fieldName);
                if (field) {
                    field.addEventListener('input', function() {
                        if (this.value) {
                            this.classList.remove('border-red-300');
                            if (!this.classList.contains('border-emerald-400')) {
                                this.classList.add('border-green-300');
                            }
                        } else {
                            this.classList.remove('border-green-300');
                            if (!this.classList.contains('border-emerald-400')) {
                                this.classList.add('border-gray-300');
                            }
                        }
                    });
                }
            });

            // Format phone number input
            const phoneField = document.getElementById('client_phone');
            if (phoneField) {
                phoneField.addEventListener('input', function() {
                    let value = this.value.replace(/\D/g, '');
                    if (value.length >= 6) {
                        value = value.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
                    } else if (value.length >= 3) {
                        value = value.replace(/(\d{3})(\d{0,3})/, '($1) $2');
                    }
                    this.value = value;
                });
            }

            // Add validation hints
            const requiredInputs = document.querySelectorAll('input[required], select[required]');
            requiredInputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (!this.value) {
                        this.classList.add('border-red-300');
                        this.classList.remove('border-green-300', 'border-emerald-400');
                    }
                });
            });
        });
    </script>
</x-app-layout>
