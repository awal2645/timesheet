@section('title', 'Email Templates')

<x-app-layout>
    <!-- Breadcrumb Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 mt-6">
        <x-breadcrumb :items="[
            [
                'label' => __('System Settings'),
                'url' => '#',
                'icon' => false
            ],
            [
                'label' => __('Email Configuration'),
                'url' => '#',
                'icon' => false
            ],
            [
                'label' => __('Email Templates'),
                'icon' => true
            ]
        ]" />
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white dark:bg-slate-800 shadow-2xl rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-purple-50 to-indigo-50 dark:from-slate-700 dark:to-slate-800 px-8 py-8 border-b border-gray-200 dark:border-gray-600">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div class="mb-6 lg:mb-0">
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white flex items-center">
                            <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            {{ __('Email Templates') }}
                        </h2>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Customize email templates for system notifications and automated messages.') }}
                        </p>
                    </div>
                    
                    <!-- Template Stats -->
                    <div class="flex items-center space-x-4">
                        <div class="text-center">
                            <div class="flex items-center justify-center w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-lg mb-2">
                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14-4H3m16 8H1"/>
                                </svg>
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">{{ __('Templates') }}</div>
                            <div class="text-sm font-bold text-purple-600 dark:text-purple-400">
                                {{ $email_templates->count() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="p-8" x-data="{
                activeTab: '{{ $email_templates->first()->type ?? 'new' }}',
                initEditor() {
                    const editorElements = document.querySelectorAll('.classic-editor');
                    editorElements.forEach((editor) => {
                        if (!editor.classList.contains('ckeditor-initialized')) {
                            CKEDITOR.replace(editor.id, {
                                skin: 'moono',
                                height: 400,
                                toolbar: [
                                    { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
                                    { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'] },
                                    { name: 'links', items: ['Link', 'Unlink'] },
                                    { name: 'colors', items: ['TextColor', 'BGColor'] },
                                    { name: 'styles', items: ['Format'] },
                                    { name: 'tools', items: ['Maximize'] }
                                ],
                                on: {
                                    instanceReady: function(evt) {
                                        this.document.on('change', function() {
                                            this.dataProcessor.htmlFilter.addRules({
                                                elements: {
                                                    $: {
                                                        styles: {
                                                            'background-color': '#2E2E2E',
                                                            'color': '#FFFFFF'
                                                        }
                                                    }
                                                }
                                            });
                                        });
                                    }
                                }
                            });
                            editor.classList.add('ckeditor-initialized');
                        }
                    });
                }
            }" x-init="initEditor()">
                
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                    <!-- Template Navigation Sidebar -->
                    <div class="lg:col-span-1">
                        <div class="bg-gradient-to-r from-gray-50 to-purple-50 dark:from-gray-800 dark:to-gray-700 rounded-2xl border border-gray-200 dark:border-gray-600 p-6">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14-4H3m16 8H1"/>
                                </svg>
                                {{ __('Templates') }}
                            </h3>
                            
                            <nav class="space-y-2">
                                @foreach ($email_templates as $email_template)
                                    @php $type = $email_template->type ?? 'new'; @endphp
                                    <button type="button" 
                                            class="w-full text-left px-4 py-3 rounded-xl border transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-purple-500"
                                            :class="{
                                                'bg-purple-600 text-white border-purple-600 shadow-lg': activeTab === '{{ $type }}',
                                                'bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-600 hover:bg-purple-50 dark:hover:bg-purple-900/20': activeTab !== '{{ $type }}'
                                            }"
                                            @click="activeTab = '{{ $type }}'; setTimeout(() => initEditor(), 100);">
                                        <div class="flex items-center">
                                            <div class="w-2 h-2 rounded-full mr-3"
                                                 :class="{
                                                     'bg-white': activeTab === '{{ $type }}',
                                                     'bg-purple-600': activeTab !== '{{ $type }}'
                                                 }"></div>
                                            <span class="font-medium">{{ __($email_template->name) }}</span>
                                        </div>
                                    </button>
                                @endforeach
                            </nav>
                        </div>
                    </div>

                    <!-- Template Editor Area -->
                    <div class="lg:col-span-3">
                        @foreach ($email_templates as $email_template)
                            @php $type = $email_template->type ?? 'new'; @endphp
                            <div x-show="activeTab === '{{ $type }}'" x-cloak 
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 transform translate-y-4"
                                 x-transition:enter-end="opacity-100 transform translate-y-0">
                                
                                <form class="space-y-6" action="{{ route('emailtemplate.save') }}" method="POST" id="templateForm_{{ $type }}">
                                    @csrf
                                    @isset($email_template->id)
                                        <input type="hidden" name="id" value="{{ $email_template->id }}">
                                    @endisset

                                    <!-- Template Information Section -->
                                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-800 dark:to-gray-700 rounded-2xl border border-blue-200 dark:border-gray-600 p-6">
                                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                                            <svg class="w-5 h-5 mr-3 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            {{ __('Template Information') }}
                                        </h3>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <!-- Template Name -->
                                            <div class="space-y-2">
                                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 flex items-center">
                                                    <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                                    </svg>
                                                    {{ __('Template Name') }}
                                                </label>
                                                <input type="text" readonly
                                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-600 text-gray-900 dark:text-white transition-all duration-200"
                                                       value="{{ __($email_template->name) ?? '' }}">
                                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ __('Template name is system-defined and cannot be changed.') }}
                                                </div>
                                            </div>

                                            <!-- Email Subject -->
                                            <div class="space-y-2">
                                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 flex items-center">
                                                    <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                    </svg>
                                                    {{ __('Email Subject') }} <span class="text-red-500">*</span>
                                                </label>
                                                <input type="text" name="subject" required
                                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                                       value="{{ $email_template->subject ?? '' }}"
                                                       placeholder="{{ __('Enter email subject line') }}">
                                                <x-forms.error name="subject" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Email Content Section -->
                                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-gray-800 dark:to-gray-700 rounded-2xl border border-green-200 dark:border-gray-600 p-6">
                                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                                            <svg class="w-5 h-5 mr-3 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            {{ __('Email Content') }}
                                        </h3>

                                        <!-- Message Editor -->
                                        <div class="space-y-2">
                                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                                                </svg>
                                                {{ __('Email Message') }} <span class="text-red-500">*</span>
                                            </label>
                                            <div class="bg-white dark:bg-gray-700 rounded-lg border border-gray-300 dark:border-gray-600 overflow-hidden">
                                                <textarea name="message" id="message_{{ $email_template->id }}" 
                                                          class="classic-editor w-full border-0 focus:ring-0"
                                                          cols="30" rows="15">{{ $email_template->message ?? '' }}</textarea>
                                            </div>
                                            <x-forms.error name="message" />
                                        </div>

                                        <!-- Important Notice -->
                                        <div class="mt-6 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-xl p-4">
                                            <div class="flex items-start">
                                                <div class="flex-shrink-0">
                                                    <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.96-.833-2.73 0L4.084 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                                    </svg>
                                                </div>
                                                <div class="ml-3">
                                                    <h3 class="text-sm font-semibold text-amber-800 dark:text-amber-300">
                                                        {{ __('Important Notice') }}
                                                    </h3>
                                                    <p class="text-sm text-amber-700 dark:text-amber-400 mt-1">
                                                        {{ __('Do not modify or remove text within {curly brackets}. These are system variables that will be automatically replaced with actual values when emails are sent.') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="flex justify-end space-x-4">
                                        <button type="button" onclick="previewTemplate('{{ $type }}')" 
                                                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-gray-500 to-slate-500 hover:from-gray-600 hover:to-slate-600 text-white font-medium rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            {{ __('Preview') }}
                                        </button>
                                        <button type="submit" 
                                                class="group inline-flex items-center px-8 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-bold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-purple-500/50"
                                                onclick="updateTemplate(this, '{{ $type }}')">
                                            <div class="flex items-center justify-center w-5 h-5 bg-white/20 rounded-lg mr-3">
                                                <svg class="w-3 h-3 transition-transform duration-200 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </div>
                                            {{ __('Update Template') }}
                                            <svg class="w-4 h-4 ml-3 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5-5 5M6 12h12"/>
                                            </svg>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Help Section -->
        <div class="mt-8 bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800 rounded-xl p-6">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-semibold text-purple-800 dark:text-purple-300 mb-2">{{ __('Email Template Guidelines') }}</h3>
                    <div class="text-sm text-purple-700 dark:text-purple-400 space-y-2">
                        <p class="flex items-start">
                            <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            {{ __('Variables in {curly brackets} are automatically replaced with real data when emails are sent') }}
                        </p>
                        <p class="flex items-start">
                            <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            {{ __('Use the rich text editor to format your email content with styles, links, and lists') }}
                        </p>
                        <p class="flex items-start">
                            <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            {{ __('Always test your templates by sending test emails before deploying to production') }}
                        </p>
                        <p class="flex items-start">
                            <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            {{ __('Keep email content clear, concise, and professional for better user experience') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add smooth entrance animations
            const sections = document.querySelectorAll('.bg-gradient-to-r');
            sections.forEach((section, index) => {
                section.style.opacity = '0';
                section.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    section.style.transition = 'all 0.6s ease';
                    section.style.opacity = '1';
                    section.style.transform = 'translateY(0)';
                }, index * 200);
            });
        });

        // Update template function
        function updateTemplate(button, type) {
            const originalText = button.innerHTML;
            button.disabled = true;
            button.innerHTML = `
                <div class="flex items-center">
                    <svg class="animate-spin w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    {{ __('Updating Template...') }}
                </div>
            `;
            
            // Reset button after form submission
            setTimeout(() => {
                button.disabled = false;
                button.innerHTML = originalText;
            }, 3000);
        }

        // Preview template function
        function previewTemplate(type) {
            const form = document.getElementById(`templateForm_${type}`);
            const formData = new FormData(form);
            
            // Get editor content
            const editorId = form.querySelector('.classic-editor').id;
            if (CKEDITOR.instances[editorId]) {
                formData.set('message', CKEDITOR.instances[editorId].getData());
            }
            
            // Create preview window
            const previewWindow = window.open('', '_blank', 'width=800,height=600,scrollbars=yes');
            previewWindow.document.write(`
                <html>
                    <head>
                        <title>{{ __('Email Template Preview') }}</title>
                        <style>
                            body { font-family: Arial, sans-serif; padding: 20px; }
                            .preview-header { background: #f3f4f6; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
                            .preview-content { border: 1px solid #e5e7eb; padding: 20px; border-radius: 8px; }
                        </style>
                    </head>
                    <body>
                        <div class="preview-header">
                            <h2>{{ __('Email Template Preview') }}</h2>
                            <strong>{{ __('Subject') }}:</strong> ${formData.get('subject')}<br>
                            <strong>{{ __('Template') }}:</strong> ${type}
                        </div>
                        <div class="preview-content">
                            ${formData.get('message')}
                        </div>
                    </body>
                </html>
            `);
        }

        // Toast notification function
        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg text-white font-medium transform transition-all duration-300 translate-x-full ${
                type === 'success' ? 'bg-green-500' : 
                type === 'error' ? 'bg-red-500' : 
                'bg-purple-500'
            }`;
            toast.textContent = message;
            
            document.body.appendChild(toast);
            
            // Slide in
            setTimeout(() => {
                toast.style.transform = 'translateX(0)';
            }, 100);
            
            // Slide out and remove
            setTimeout(() => {
                toast.style.transform = 'translateX(full)';
                setTimeout(() => {
                    if (document.body.contains(toast)) {
                        document.body.removeChild(toast);
                    }
                }, 300);
            }, 3000);
        }
    </script>
</x-app-layout>

<!-- CKEditor JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.16.2/ckeditor.js"></script>
