@section('title')
{{ __('Send Invite') }}
@endsection

<x-app-layout>
    <!-- Breadcrumb Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 mt-6">
        <x-breadcrumb :items="[
            [
                'label' => __('User Management'),
                'url' => '#',
                'icon' => true
            ],
            [
                'label' => __('Send Invite'),
                'icon' => true
            ]
        ]" />
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white dark:bg-slate-800 shadow-2xl rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-purple-50 to-indigo-100 dark:from-slate-700 dark:to-slate-800 px-8 py-8 border-b border-gray-200 dark:border-gray-600">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                            <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                </svg>
                            </div>
                            {{ __('Send Employer Invite') }}
                        </h2>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Invite a new employer to join your organization. They will receive an email with instructions to set up their account.') }}
                        </p>
                    </div>
                    
                    <!-- User Role Info -->
                    <div class="hidden md:flex flex-col items-end space-y-2">
                        <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400">
                            <span>{{ __('Your Role') }}</span>
                            <div class="bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-300 px-3 py-1 rounded-full font-semibold capitalize">
                                {{ auth('web')->user()->role }}
                            </div>
                        </div>
                        <div class="text-xs text-gray-400 dark:text-gray-500">
                            {{ __('Invitation Management') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <div class="p-8">
                <form method="POST" action="{{ route('invite.send.employer') }}" class="space-y-8" id="inviteForm">
                    @csrf

                    <!-- Invitation Information Section -->
                    <div class="space-y-6">
                        <div class="border-b border-gray-200 dark:border-gray-600 pb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                                <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                </svg>
                                {{ __('Invitation Details') }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ __('Specify the role and email address for the new employer') }}</p>
                        </div>

                        <!-- Form Fields -->
                        <div class="space-y-6">
                            <!-- Role Selection -->
                            <div class="space-y-2">
                                <label for="role_name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                        </svg>
                                        {{ __('Role') }} 
                                        <span class="text-red-500 ml-1">*</span>
                                    </span>
                                </label>
                                <div class="relative group">
                                    <select name="role_name" id="role_name" required
                                            class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md">
                                        <option value="" disabled selected>{{ __('Choose a role...') }}</option>
                                        @foreach ($roles as $role)
                                        <option value="{{ $role->name }}" {{ old('role_name') == $role->name ? 'selected' : '' }}>
                                            {{ ucfirst($role->name) }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('role_name')
                                <div class="flex items-center mt-2 p-3 text-red-700 bg-red-50 dark:bg-red-900/20 dark:text-red-400 rounded-lg border border-red-200 dark:border-red-800">
                                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm font-medium">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>

                            <!-- Email Address -->
                            <div class="space-y-2">
                                <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                        </svg>
                                        {{ __('Email Address') }} 
                                        <span class="text-red-500 ml-1">*</span>
                                    </span>
                                </label>
                                <div class="relative group">
                                    <input type="email" name="email" id="email" required
                                           value="{{ old('email') }}"
                                           class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md"
                                           placeholder="Enter employer's email address..." />
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                </div>
                                @error('email')
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

                    <!-- Role Information -->
                    <div id="roleInfo" class="hidden bg-gradient-to-r from-blue-50 to-indigo-100 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-xl p-6 border border-blue-200 dark:border-blue-800">
                        <h4 class="text-sm font-semibold text-blue-800 dark:text-blue-300 mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ __('Selected Role Information') }}
                        </h4>
                        <div id="roleDetails" class="text-sm text-blue-700 dark:text-blue-400">
                            <!-- Role details will be populated via JavaScript -->
                        </div>
                    </div>

                    <!-- Quick Role Selection -->
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-gray-200 dark:border-gray-600">
                        <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            {{ __('Quick Role Selection') }}
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                            @foreach($roles as $role)
                            <button type="button" onclick="selectRole('{{ $role->name }}')" 
                                    class="px-4 py-3 bg-purple-100 text-purple-700 rounded-lg hover:bg-purple-200 transition-colors text-sm font-medium text-left">
                                <div class="font-semibold capitalize">{{ $role->name }}</div>
                                <div class="text-xs text-purple-600">{{ __('Select Role') }}</div>
                            </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Email Templates -->
                    <div class="bg-gradient-to-r from-emerald-50 to-green-100 dark:from-emerald-900/20 dark:to-green-900/20 rounded-xl p-6 border border-emerald-200 dark:border-emerald-800">
                        <h4 class="text-sm font-semibold text-emerald-800 dark:text-emerald-300 mb-4 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-1.586l-4 4z"/>
                            </svg>
                            {{ __('Email Templates') }}
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <button type="button" onclick="setEmailTemplate('company')" 
                                    class="px-4 py-3 bg-emerald-100 text-emerald-700 rounded-lg hover:bg-emerald-200 transition-colors text-sm font-medium text-left">
                                <div class="font-semibold">{{ __('Company Email') }}</div>
                                <div class="text-xs text-emerald-600">name@company.com</div>
                            </button>
                            <button type="button" onclick="setEmailTemplate('personal')" 
                                    class="px-4 py-3 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors text-sm font-medium text-left">
                                <div class="font-semibold">{{ __('Personal Email') }}</div>
                                <div class="text-xs text-blue-600">name@gmail.com</div>
                            </button>
                        </div>
                    </div>

                    <!-- Help Section -->
                    <div class="bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800 rounded-xl p-6 mt-8">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-semibold text-purple-800 dark:text-purple-300 mb-2">
                                    {{ __('Invitation Guidelines') }}
                                </h3>
                                <div class="text-sm text-purple-700 dark:text-purple-400 space-y-2">
                                    <p class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ __('Select the appropriate role based on the employer\'s responsibilities') }}
                                    </p>
                                    <p class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ __('Ensure the email address is correct - invitation links cannot be resent') }}
                                    </p>
                                    <p class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ __('The invited user will receive setup instructions via email') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-between pt-8 border-t border-gray-200 dark:border-gray-600 space-y-4 sm:space-y-0">
                        <a href="{{ url()->previous() }}" 
                           class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl text-sm font-semibold text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-200 hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            {{ __('Cancel') }}
                        </a>
                        
                        <button type="submit" id="submitBtn"
                                class="w-full sm:w-auto group inline-flex items-center justify-center px-10 py-4 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-bold rounded-xl transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-purple-500/50 backdrop-blur-sm disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                            <div class="flex items-center justify-center w-6 h-6 bg-white/20 rounded-lg mr-3">
                                <svg class="w-4 h-4 transition-transform duration-200 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                            </div>
                            <span class="submit-text">{{ __('Send Invitation') }}</span>
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
        const form = document.getElementById('inviteForm');
        const submitBtn = document.getElementById('submitBtn');
        const submitText = submitBtn.querySelector('.submit-text');
        const loadingSpinner = submitBtn.querySelector('.loading-spinner');
        const roleSelect = document.getElementById('role_name');
        const emailInput = document.getElementById('email');
        const roleInfo = document.getElementById('roleInfo');
        const roleDetails = document.getElementById('roleDetails');

        // Auto-focus first field
        setTimeout(() => roleSelect.focus(), 100);

        // Initialize Select2 for role selection
        $(document).ready(function() {
            $('#role_name').select2({
                placeholder: '{{ __('Choose a role...') }}',
                allowClear: true,
                width: '100%',
                theme: 'default',
                templateResult: function(option) {
                    if (!option.id) return option.text;
                    
                    return $(`
                        <div class="flex items-center p-2">
                            <div class="w-3 h-3 bg-purple-400 rounded-full mr-3"></div>
                            <span class="font-medium capitalize">${option.text}</span>
                        </div>
                    `);
                },
                templateSelection: function(option) {
                    if (!option.id) return option.text;
                    
                    return $(`
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-purple-400 rounded-full mr-2"></div>
                            <span class="capitalize">${option.text}</span>
                        </div>
                    `);
                }
            });

            // Apply custom styling to Select2
            $('.select2-container').addClass('w-full');
            $('.select2-selection').addClass('!border-2 !border-gray-300 dark:!border-gray-600 !rounded-xl !bg-white dark:!bg-slate-700 !text-gray-900 dark:!text-white !min-h-[56px] hover:!border-gray-400 dark:hover:!border-gray-500');
            $('.select2-selection__rendered').addClass('!p-4');
        });

        // Role information handler
        $('#role_name').on('change', function() {
            const selectedValue = $(this).val();
            if (selectedValue) {
                const selectedText = $(this).find('option:selected').text();
                
                // Show role info
                roleDetails.innerHTML = `
                    <p><strong>{{ __('Selected Role') }}:</strong> ${selectedText}</p>
                    <p><strong>{{ __('Permissions') }}:</strong> {{ __('Role-based access to system features') }}</p>
                    <p class="text-xs mt-2 text-blue-600 dark:text-blue-400">
                        {{ __('User will be assigned this role upon account activation') }}
                    </p>
                `;
                roleInfo.classList.remove('hidden');
                
                showNotification(`{{ __('Role selected') }}: ${selectedText}`, 'success');
            } else {
                roleInfo.classList.add('hidden');
            }
        });

        // Quick role selection function
        window.selectRole = function(roleName) {
            $('#role_name').val(roleName).trigger('change');
            showNotification(`{{ __('Role selected') }}: ${roleName}`, 'success');
        };

        // Email template functions
        window.setEmailTemplate = function(type) {
            let template = '';
            switch(type) {
                case 'company':
                    template = 'name@company.com';
                    break;
                case 'personal':
                    template = 'name@gmail.com';
                    break;
            }
            
            emailInput.value = template;
            emailInput.focus();
            // Select the template text for easy replacement
            setTimeout(() => {
                emailInput.setSelectionRange(0, template.indexOf('@'));
            }, 10);
            
            showNotification(`{{ __('Email template applied') }}: ${template}`, 'success');
        };

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
            
            // Check role selection
            const selectedRole = $('#role_name').val();
            if (!selectedRole) {
                $('.select2-selection').addClass('!border-red-500 !bg-red-50 dark:!bg-red-900/20');
                isValid = false;
            } else {
                $('.select2-selection').removeClass('!border-red-500 !bg-red-50 dark:!bg-red-900/20');
            }

            // Check email
            if (!emailInput.value.trim()) {
                emailInput.classList.add('border-red-500', 'bg-red-50', 'dark:bg-red-900/20');
                isValid = false;
            } else if (!isValidEmail(emailInput.value)) {
                emailInput.classList.add('border-red-500', 'bg-red-50', 'dark:bg-red-900/20');
                isValid = false;
            } else {
                emailInput.classList.remove('border-red-500', 'bg-red-50', 'dark:bg-red-900/20');
                emailInput.classList.add('border-green-400');
            }
            
            return isValid;
        }

        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Enhanced form submission
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!validateForm()) {
                showNotification('{{ __('Please fill in all required fields correctly') }}', 'error');
                return;
            }
            
            // Show loading state
            submitBtn.disabled = true;
            submitText.textContent = '{{ __('Sending...') }}';
            loadingSpinner.classList.remove('hidden');
            
            // Submit form after brief delay
            setTimeout(() => {
                form.submit();
            }, 1000);
        });

        // Enhanced visual feedback
        const formInputs = form.querySelectorAll('input, select');
        formInputs.forEach(input => {
            input.addEventListener('focus', function() {
                if (this.parentElement) {
                    this.parentElement.classList.add('ring-2', 'ring-purple-500/20');
                }
            });
            
            input.addEventListener('blur', function() {
                if (this.parentElement) {
                    this.parentElement.classList.remove('ring-2', 'ring-purple-500/20');
                }
            });
        });

        // Email validation on input
        emailInput.addEventListener('input', function() {
            const value = this.value.trim();
            if (value) {
                if (isValidEmail(value)) {
                    this.classList.add('border-green-400');
                    this.classList.remove('border-yellow-400', 'border-red-500');
                } else {
                    this.classList.add('border-yellow-400');
                    this.classList.remove('border-green-400', 'border-red-500');
                }
            } else {
                this.classList.remove('border-green-400', 'border-yellow-400');
            }
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
            
            // Escape to cancel
            if (e.key === 'Escape') {
                window.history.back();
            }

            // Quick shortcuts for role selection
            if (e.ctrlKey || e.metaKey) {
                switch(e.key) {
                    case '1':
                        e.preventDefault();
                        const firstRole = $('#role_name option').eq(1).val();
                        if (firstRole) selectRole(firstRole);
                        break;
                    case '2':
                        e.preventDefault();
                        const secondRole = $('#role_name option').eq(2).val();
                        if (secondRole) selectRole(secondRole);
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