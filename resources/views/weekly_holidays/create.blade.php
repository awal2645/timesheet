@section('title')
    {{ __('Create Weekly Holiday') }}
@endsection

<x-app-layout>
    <!-- Breadcrumb Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 mt-6">
        <x-breadcrumb :items="[
            [
                'label' => __('Weekly Holidays'),
                'url' => route('weekly_holidays.index'),
                'icon' => true
            ],
            [
                'label' => __('Create Weekly Holiday'),
                'icon' => true
            ]
        ]" />
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white dark:bg-slate-800 shadow-2xl rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-purple-50 to-blue-100 dark:from-slate-700 dark:to-slate-800 px-8 py-8 border-b border-gray-200 dark:border-gray-600">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                            <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            {{ __('Add Weekly Holiday') }}
                        </h2>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Set up recurring weekly holidays for your organization. These will automatically apply every week on the selected days.') }}
                        </p>
                    </div>
                    
                    <!-- Quick Info -->
                    <div class="hidden md:flex items-center space-x-2">
                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('Recurring Setup') }}</div>
                        <div class="w-2 h-2 bg-purple-400 rounded-full animate-bounce"></div>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <div class="p-8">
                <form action="{{ route('weekly_holidays.store') }}" method="POST" class="space-y-8" id="weeklyHolidayForm">
            @csrf

                    <!-- Weekly Holiday Section -->
                    <div class="space-y-6">
                        <div class="border-b border-gray-200 dark:border-gray-600 pb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                                <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ __('Weekly Recurring Days') }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ __('Choose which days of the week should be considered holidays on a recurring basis') }}</p>
                        </div>

                        <!-- Days Selection -->
                        <div class="space-y-4">
                            <label for="days_of_week" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                    </svg>
                                    {{ __('Days of the Week') }} 
                                    <span class="text-red-500 ml-1">*</span>
                                </span>
                            </label>
                            
                            <div class="relative group">
                <select id="days_of_week" name="days_of_week[]"
                                        class="select2 w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md"
                                        multiple required>
                    <option value="Monday">{{ __('Monday') }}</option>
                    <option value="Tuesday">{{ __('Tuesday') }}</option>
                    <option value="Wednesday">{{ __('Wednesday') }}</option>
                    <option value="Thursday">{{ __('Thursday') }}</option>
                    <option value="Friday">{{ __('Friday') }}</option>
                    <option value="Saturday">{{ __('Saturday') }}</option>
                    <option value="Sunday">{{ __('Sunday') }}</option>
                </select>
            </div>
                            
                            @error('days_of_week')
                            <div class="flex items-center mt-2 p-3 text-red-700 bg-red-50 dark:bg-red-900/20 dark:text-red-400 rounded-lg border border-red-200 dark:border-red-800">
                                <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm font-medium">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Common Presets -->
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-gray-200 dark:border-gray-600">
                        <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            {{ __('Quick Presets') }}
                        </h4>
                        <div class="flex flex-wrap gap-3">
                            <button type="button" onclick="selectWeekend()" 
                                    class="px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors text-sm font-medium">
                                {{ __('Weekend (Sat + Sun)') }}
                            </button>
                            <button type="button" onclick="selectFriday()" 
                                    class="px-4 py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-colors text-sm font-medium">
                                {{ __('Friday Only') }}
                            </button>
                            <button type="button" onclick="clearSelection()" 
                                    class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors text-sm font-medium">
                                {{ __('Clear All') }}
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
                                    {{ __('Weekly Holiday Guidelines') }}
                                </h3>
                                <div class="text-sm text-purple-700 dark:text-purple-400 space-y-2">
                                    <p class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ __('These holidays will automatically repeat every week') }}
                                    </p>
                                    <p class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ __('Use quick presets for common holiday patterns') }}
                                    </p>
                                    <p class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ __('Employees cannot work or log hours on weekly holiday days') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-between pt-8 border-t border-gray-200 dark:border-gray-600 space-y-4 sm:space-y-0">
                        <a href="{{ route('weekly_holidays.index') }}" 
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </div>
                            <span class="submit-text">{{ __('Add Holiday') }}</span>
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
        const form = document.getElementById('weeklyHolidayForm');
        const submitBtn = document.getElementById('submitBtn');
        const submitText = submitBtn.querySelector('.submit-text');
        const loadingSpinner = submitBtn.querySelector('.loading-spinner');

        // Initialize Select2 with enhanced styling
            if (typeof jQuery !== 'undefined') {
                $('.select2').select2({
                    width: '100%',
                    dropdownParent: $('body'),
                placeholder: "{{ __('Select Days of the Week') }}",
                allowClear: true,
                closeOnSelect: false,
                templateResult: function(option) {
                    if (!option.id) return option.text;
                    
                    const dayIcons = {
                        'Monday': '🌅',
                        'Tuesday': '🌄',
                        'Wednesday': '🌞',
                        'Thursday': '🌇',
                        'Friday': '🌆',
                        'Saturday': '🏖️',
                        'Sunday': '☀️'
                    };
                    
                    return $(`
                        <div class="flex items-center p-2">
                            <span class="mr-3 text-lg">${dayIcons[option.text] || '📅'}</span>
                            <span class="text-gray-900 dark:text-gray-100">${option.text}</span>
                        </div>
                    `);
                },
                templateSelection: function(option) {
                    if (!option.id) return option.text;
                    
                    return $(`
                        <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300">
                            ${option.text}
                        </span>
                    `);
                }
            }).on('select2:select select2:unselect', function() {
                // Add visual feedback when selection changes
                const container = $(this).next('.select2-container');
                container.addClass('ring-2 ring-purple-500/20');
                setTimeout(() => {
                    container.removeClass('ring-2 ring-purple-500/20');
                }, 300);
            });
        }

        // Auto-focus the select element
        setTimeout(() => {
            if (typeof jQuery !== 'undefined') {
                $('.select2-selection').focus();
            }
        }, 100);

        // Quick preset functions
        window.selectWeekend = function() {
            $('#days_of_week').val(['Saturday', 'Sunday']).trigger('change');
            showNotification('{{ __('Weekend selected') }}', 'success');
        };

        window.selectFriday = function() {
            $('#days_of_week').val(['Friday']).trigger('change');
            showNotification('{{ __('Friday selected') }}', 'success');
        };

        window.clearSelection = function() {
            $('#days_of_week').val(null).trigger('change');
            showNotification('{{ __('Selection cleared') }}', 'info');
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
            const selectedDays = $('#days_of_week').val();
            const selectContainer = $('#days_of_week').next('.select2-container');
            
            if (!selectedDays || selectedDays.length === 0) {
                selectContainer.addClass('border-red-500 bg-red-50 dark:bg-red-900/20');
                return false;
            } else {
                selectContainer.removeClass('border-red-500 bg-red-50 dark:bg-red-900/20');
                return true;
            }
        }

        // Enhanced form submission
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!validateForm()) {
                showNotification('{{ __('Please select at least one day') }}', 'error');
                return;
            }
            
            // Show loading state
            submitBtn.disabled = true;
            submitText.textContent = '{{ __('Adding...') }}';
            loadingSpinner.classList.remove('hidden');
            
            // Submit form after brief delay
            setTimeout(() => {
                form.submit();
            }, 1000);
        });

        // Enhanced visual feedback
        const formInputs = form.querySelectorAll('input, textarea, select');
        formInputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('ring-2', 'ring-purple-500/20');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('ring-2', 'ring-purple-500/20');
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
            
            // Escape to cancel
            if (e.key === 'Escape') {
                window.location.href = '{{ route('weekly_holidays.index') }}';
            }

            // Quick shortcuts for presets
            if (e.ctrlKey || e.metaKey) {
                switch(e.key) {
                    case 'w':
                        e.preventDefault();
                        selectWeekend();
                        break;
                    case 'f':
                        e.preventDefault();
                        selectFriday();
                        break;
                    case 'c':
                        e.preventDefault();
                        clearSelection();
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
