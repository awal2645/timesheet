@section('title')
    {{ __('Create Invoice') }}
@endsection

<x-app-layout>
    <!-- Breadcrumb Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 mt-6">
        <x-breadcrumb :items="[
            [
                'label' => __('Invoices'),
                'url' => route('invoice.index'),
                'icon' => true
            ],
            [
                'label' => __('Create Invoice'),
                'icon' => true
            ]
        ]" />
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white dark:bg-slate-800 shadow-2xl rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-emerald-50 to-green-100 dark:from-slate-700 dark:to-slate-800 px-8 py-8 border-b border-gray-200 dark:border-gray-600">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                            <div class="w-8 h-8 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            {{ __('Create New Invoice') }}
                        </h2>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Generate a new invoice for your project. Select the project and provide an invoice number to get started.') }}
                        </p>
                    </div>
                    
                    <!-- Quick Info -->
                    <div class="hidden md:flex items-center space-x-2">
                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('New Invoice') }}</div>
                        <div class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></div>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <div class="p-8">
                <form method="POST" action="{{ route('invoice.store') }}" class="space-y-8" id="invoiceForm">
                    @csrf

                    <!-- Invoice Information Section -->
                    <div class="space-y-6">
                        <div class="border-b border-gray-200 dark:border-gray-600 pb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                                <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                {{ __('Invoice Information') }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ __('Provide the basic details for your invoice') }}</p>
                        </div>

                        <!-- Form Fields -->
                        <div class="space-y-6">
                            <!-- Project Selection -->
                            <div class="space-y-2">
                                <label for="project_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                        {{ __('Select Project') }} 
                                        <span class="text-red-500 ml-1">*</span>
                                    </span>
                                </label>
                                <div class="relative group">
                                    <select name="project_id" id="project_id" required
                                            class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md">
                                        <option value="" disabled selected>{{ __('Choose a project...') }}</option>
                                        @foreach ($projects as $project)
                                        <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                            {{ $project->project_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('project_id')
                                <div class="flex items-center mt-2 p-3 text-red-700 bg-red-50 dark:bg-red-900/20 dark:text-red-400 rounded-lg border border-red-200 dark:border-red-800">
                                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm font-medium">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>

                            <!-- Invoice Number -->
                            <div class="space-y-2">
                                <label for="invoice_number" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                        </svg>
                                        {{ __('Invoice Number') }} 
                                        <span class="text-red-500 ml-1">*</span>
                                    </span>
                                </label>
                                <div class="relative group">
                                    <input type="text" name="invoice_number" id="invoice_number" required
                                           value="{{ old('invoice_number') }}"
                                           class="w-full px-4 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500 group-hover:shadow-md"
                                           placeholder="Enter invoice number (e.g., INV-2024-001)..." />
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                        <button type="button" onclick="generateInvoiceNumber()" 
                                                class="text-emerald-500 hover:text-emerald-700 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                @error('invoice_number')
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

                    <!-- Quick Project Info -->
                    <div id="projectInfo" class="hidden bg-gradient-to-r from-blue-50 to-indigo-100 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-xl p-6 border border-blue-200 dark:border-blue-800">
                        <h4 class="text-sm font-semibold text-blue-800 dark:text-blue-300 mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ __('Selected Project Information') }}
                        </h4>
                        <div id="projectDetails" class="text-sm text-blue-700 dark:text-blue-400">
                            <!-- Project details will be populated via JavaScript -->
                        </div>
                    </div>

                    <!-- Invoice Number Patterns -->
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-gray-200 dark:border-gray-600">
                        <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            {{ __('Invoice Number Patterns') }}
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <button type="button" onclick="setInvoicePattern('INV-{{ date('Y') }}-')" 
                                    class="px-4 py-3 bg-emerald-100 text-emerald-700 rounded-lg hover:bg-emerald-200 transition-colors text-sm font-medium text-left">
                                <div class="font-semibold">{{ __('Annual Pattern') }}</div>
                                <div class="text-xs text-emerald-600">INV-{{ date('Y') }}-001</div>
                            </button>
                            <button type="button" onclick="setInvoicePattern('INV-{{ date('Y-m') }}-')" 
                                    class="px-4 py-3 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors text-sm font-medium text-left">
                                <div class="font-semibold">{{ __('Monthly Pattern') }}</div>
                                <div class="text-xs text-blue-600">INV-{{ date('Y-m') }}-001</div>
                            </button>
                            <button type="button" onclick="setInvoicePattern('{{ date('Ymd') }}-')" 
                                    class="px-4 py-3 bg-purple-100 text-purple-700 rounded-lg hover:bg-purple-200 transition-colors text-sm font-medium text-left">
                                <div class="font-semibold">{{ __('Daily Pattern') }}</div>
                                <div class="text-xs text-purple-600">{{ date('Ymd') }}-001</div>
                            </button>
                            <button type="button" onclick="generateCustomNumber()" 
                                    class="px-4 py-3 bg-orange-100 text-orange-700 rounded-lg hover:bg-orange-200 transition-colors text-sm font-medium text-left">
                                <div class="font-semibold">{{ __('Auto Generate') }}</div>
                                <div class="text-xs text-orange-600">{{ __('Smart numbering') }}</div>
                            </button>
                        </div>
                    </div>

                    <!-- Help Section -->
                    <div class="bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-xl p-6 mt-8">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-semibold text-emerald-800 dark:text-emerald-300 mb-2">
                                    {{ __('Invoice Guidelines') }}
                                </h3>
                                <div class="text-sm text-emerald-700 dark:text-emerald-400 space-y-2">
                                    <p class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ __('Select the correct project to ensure accurate billing and tracking') }}
                                    </p>
                                    <p class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ __('Use consistent invoice numbering for better organization and tracking') }}
                                    </p>
                                    <p class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ __('Invoice numbers should be unique and follow a logical sequence') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-between pt-8 border-t border-gray-200 dark:border-gray-600 space-y-4 sm:space-y-0">
                        <a href="{{ route('invoice.index') }}" 
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <span class="submit-text">{{ __('Create Invoice') }}</span>
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
        const form = document.getElementById('invoiceForm');
        const submitBtn = document.getElementById('submitBtn');
        const submitText = submitBtn.querySelector('.submit-text');
        const loadingSpinner = submitBtn.querySelector('.loading-spinner');
        const projectSelect = document.getElementById('project_id');
        const invoiceNumberInput = document.getElementById('invoice_number');
        const projectInfo = document.getElementById('projectInfo');
        const projectDetails = document.getElementById('projectDetails');

        // Auto-focus first field
        setTimeout(() => projectSelect.focus(), 100);

        // Initialize Select2 for project selection
        $(document).ready(function() {
            $('#project_id').select2({
                placeholder: '{{ __('Choose a project...') }}',
                allowClear: true,
                width: '100%',
                theme: 'default',
                templateResult: function(option) {
                    if (!option.id) return option.text;
                    
                    return $(`
                        <div class="flex items-center p-2">
                            <div class="w-3 h-3 bg-emerald-400 rounded-full mr-3"></div>
                            <span class="font-medium">${option.text}</span>
                        </div>
                    `);
                },
                templateSelection: function(option) {
                    if (!option.id) return option.text;
                    
                    return $(`
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-emerald-400 rounded-full mr-2"></div>
                            <span>${option.text}</span>
                        </div>
                    `);
                }
            });

            // Apply custom styling to Select2
            $('.select2-container').addClass('w-full');
            $('.select2-selection').addClass('!border-2 !border-gray-300 dark:!border-gray-600 !rounded-xl !bg-white dark:!bg-slate-700 !text-gray-900 dark:!text-white !min-h-[56px] hover:!border-gray-400 dark:hover:!border-gray-500');
            $('.select2-selection__rendered').addClass('!p-4');
        });

        // Project information handler
        $('#project_id').on('change', function() {
            const selectedValue = $(this).val();
            if (selectedValue) {
                const selectedText = $(this).find('option:selected').text();
                
                // Show project info
                projectDetails.innerHTML = `
                    <p><strong>{{ __('Project Name') }}:</strong> ${selectedText}</p>
                    <p><strong>{{ __('Project ID') }}:</strong> ${selectedValue}</p>
                    <p class="text-xs mt-2 text-blue-600 dark:text-blue-400">
                        {{ __('Invoice will be generated for this project') }}
                    </p>
                `;
                projectInfo.classList.remove('hidden');
                
                showNotification(`{{ __('Project selected') }}: ${selectedText}`, 'success');
            } else {
                projectInfo.classList.add('hidden');
            }
        });

        // Invoice number pattern functions
        window.setInvoicePattern = function(pattern) {
            invoiceNumberInput.value = pattern;
            invoiceNumberInput.focus();
            // Position cursor at the end
            setTimeout(() => {
                invoiceNumberInput.setSelectionRange(invoiceNumberInput.value.length, invoiceNumberInput.value.length);
            }, 10);
            
            showNotification(`{{ __('Pattern applied') }}: ${pattern}`, 'success');
        };

        window.generateInvoiceNumber = function() {
            const currentDate = new Date();
            const year = currentDate.getFullYear();
            const month = String(currentDate.getMonth() + 1).padStart(2, '0');
            const day = String(currentDate.getDate()).padStart(2, '0');
            const timestamp = Date.now().toString().slice(-4);
            
            const generatedNumber = `INV-${year}${month}${day}-${timestamp}`;
            invoiceNumberInput.value = generatedNumber;
            
            showNotification(`{{ __('Invoice number generated') }}: ${generatedNumber}`, 'success');
        };

        window.generateCustomNumber = function() {
            // Smart numbering based on current date and time
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            
            const smartNumber = `INV-${year}-${month}${day}${hours}${minutes}`;
            invoiceNumberInput.value = smartNumber;
            
            showNotification(`{{ __('Smart number generated') }}: ${smartNumber}`, 'success');
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
            
            // Check project selection
            const selectedProject = $('#project_id').val();
            if (!selectedProject) {
                $('.select2-selection').addClass('!border-red-500 !bg-red-50 dark:!bg-red-900/20');
                isValid = false;
            } else {
                $('.select2-selection').removeClass('!border-red-500 !bg-red-50 dark:!bg-red-900/20');
            }

            // Check invoice number
            if (!invoiceNumberInput.value.trim()) {
                invoiceNumberInput.classList.add('border-red-500', 'bg-red-50', 'dark:bg-red-900/20');
                isValid = false;
            } else {
                invoiceNumberInput.classList.remove('border-red-500', 'bg-red-50', 'dark:bg-red-900/20');
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
            submitText.textContent = '{{ __('Creating...') }}';
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
                    this.parentElement.classList.add('ring-2', 'ring-emerald-500/20');
                }
            });
            
            input.addEventListener('blur', function() {
                if (this.parentElement) {
                    this.parentElement.classList.remove('ring-2', 'ring-emerald-500/20');
                }
            });
        });

        // Invoice number validation
        invoiceNumberInput.addEventListener('input', function() {
            const value = this.value.trim();
            if (value) {
                // Check for basic invoice number pattern
                if (value.length < 3) {
                    this.classList.add('border-yellow-400');
                    this.classList.remove('border-green-400', 'border-red-500');
                } else {
                    this.classList.add('border-green-400');
                    this.classList.remove('border-yellow-400', 'border-red-500');
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
                window.location.href = '{{ route('invoice.index') }}';
            }

            // Quick shortcuts for invoice patterns
            if (e.ctrlKey || e.metaKey) {
                switch(e.key) {
                    case '1':
                        e.preventDefault();
                        setInvoicePattern('INV-{{ date('Y') }}-');
                        break;
                    case '2':
                        e.preventDefault();
                        setInvoicePattern('INV-{{ date('Y-m') }}-');
                        break;
                    case '3':
                        e.preventDefault();
                        setInvoicePattern('{{ date('Ymd') }}-');
                        break;
                    case 'g':
                        e.preventDefault();
                        generateCustomNumber();
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
