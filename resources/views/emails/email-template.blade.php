@section('title')
    {{ 'Email Templates' }}
@endsection

<x-app-layout>
    <!-- Page Header -->
    <header>
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-center">
            <h1 class="text-3xl font-bold leading-tight text-gray-900 dark:text-white text-center">
                {{ __('Email Templates') }}
            </h1>
        </div>
    </header>
    <div x-data="{
        activeTab: '{{ __($email_templates->first()->type ?? 'new') }}',
        initEditor() {
            const editorElements = document.querySelectorAll('.classic-editor');
            editorElements.forEach((editor) => {
                if (!editor.classList.contains('ckeditor-initialized')) {
                    CKEDITOR.replace(editor.id, {
                        // Custom configuration for CKEditor
                        skin: 'moono', // Change the skin to your preferred one
                        // Custom styles for dark mode
                        on: {
                            instanceReady: function(evt) {
                                this.document.on('change', function() {
                                    this.dataProcessor.htmlFilter.addRules({
                                        elements: {
                                            $: {
                                                styles: {
                                                    'background-color': '#2E2E2E', // Set your desired background color
                                                    'color': '#FFFFFF' // Set text color for better visibility
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
    }" x-init="initEditor()" @click="initEditor()" class="m-6">

        <div
            class="flex flex-col md:flex-row md:justify-start gap-8 bg-card-light dark:bg-card-dark border border-black/10 dark:border-white/10 p-5">
            <!-- Sidebar with Tab Links -->
            <ul
                class="flex flex-col md:w-1/3 space-y-2 p-5 bg-white/30 dark:bg-black/30 rounded-lg border dark:border-white/10">
                @foreach ($email_templates as $email_template)
                    @php $type = $email_template->type ?? 'new'; @endphp
                    <li>
                        <a href="#"
                            class="block py-2 px-4 rounded-lg cursor-pointer border dark:border-gray-600 dark:bg-gray-800 hover:bg-primary-50 hover:text-white dark:hover:bg-primary-50"
                            :class="{
                                'bg-primary-50 dark:bg-primary-50 text-white': activeTab === '{{ $type }}',
                                'text-gray-700 dark:text-gray-300': activeTab !== '{{ $type }}'
                            }"
                            @click.prevent="activeTab = '{{ $type }}'; initEditor();">
                            {{ __($email_template->name) }}
                        </a>
                    </li>
                @endforeach
            </ul>
            <!-- Tab Content -->
            <div
                class=" card md:w-2/3 p-4 bg-card-light dark:bg-card-dark border border-black/10 dark:border-white/10 rounded-lg">
                @foreach ($email_templates as $email_template)
                    @php $type = $email_template->type ?? 'new'; @endphp
                    <div x-show="activeTab === '{{ $type }}'" x-cloak>
                        <form class="space-y-6" action="{{ route('email_templates.save') }}" method="POST">
                            @csrf
                            @isset($email_template->id)
                                <input type="hidden" name="id" value="{{ $email_template->id }}">
                            @endisset

                            <div class="card shadow-md rounded-lg px-6 pb-6 mt-3">
                                <div class="grid grid-cols-1 gap-6">
                                    <!-- Name Input -->
                                    <div class="mb-4">
                                        <label
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Name') }}</label>
                                        <input readonly type="text" id="name"
                                            class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300"
                                            value="{{ __($email_template->name) ?? '' }}">
                                        <x-forms.error name="name" />
                                    </div>

                                    <!-- Subject Input -->
                                    <div class="mb-4">
                                        <label
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Subject') }}</label>
                                        <input type="text" name="subject" id="subject"
                                            class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300"
                                            value="{{ $email_template->subject ?? '' }}">
                                        <x-forms.error name="subject" />
                                    </div>

                                    <!-- Message Textarea -->
                                    <div class="mb-4">
                                        <label
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Message') }}</label>
                                        <textarea name="message" id="message_{{ $email_template->id }}"
                                            class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300 classic-editor"
                                            cols="30" rows="10">{{ $email_template->message ?? '' }}</textarea>
                                        <x-forms.error name="message" />
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-red-700 dark:text-red-300">
                                        <i class="fa-solid fa-circle-info"></i>
                                        {{ __('Note: Do not modify the text within
                                                                                                                    {brackets}.') }}
                                    </label>
                                </div>

                                <!-- Submit Button -->
                                <div class="flex  mt-6">
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-text-light dark:text-text-dark bg-primary-50 hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        <i class="fas fa-sync mr-2"></i>{{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- CKEditor JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.16.2/ckeditor.js"
        integrity="sha512-bGYUkjDyyOMGm3ASzq3zRaWZ4CONNH1wAYMFch/Z0ASZrsg722SeRsX0FPPRZjTuJrqIMbB9fvY0LEMzyHeyeQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</x-app-layout>
