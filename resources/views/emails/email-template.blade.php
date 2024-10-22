@section('title')
{{ 'Email Templates' }}
@endsection

<x-app-layout>
    <!-- Page Header -->
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-center">
            <h1 class="text-3xl font-bold leading-tight text-gray-900 dark:text-white text-center">
                {{ __('Email Templates') }}
            </h1>
        </div>
    </header>
    <div x-data="{
        activeTab: '{{ __($email_templates->first()->type) ?? 'new' }}',
        initEditor() {
            const editorElements = document.querySelectorAll('.classic-editor');
            editorElements.forEach((editor) => {
                if (!editor.classList.contains('ckeditor-initialized')) {
                    CKEDITOR.replace(editor.id);
                    editor.classList.add('ckeditor-initialized');
                }
            });
        }
    }" x-init="initEditor()" @click="initEditor()" class="">

        <div class="flex flex-col md:flex-row bg-white dark:bg-gray-800">
            <!-- Sidebar with Tab Links -->
            <ul class="flex flex-col md:w-1/3 space-y-2 mt-5 p-5">
                @foreach ($email_templates as $email_template)
                @php $type = $email_template->type ?? 'new'; @endphp
                <li>
                    <a href="#"
                        class="block py-2 px-4 rounded-lg cursor-pointer border dark:border-gray-600 dark:bg-gray-800 hover:bg-blue-700 hover:text-white dark:hover:bg-blue-700"
                        :class="{
                                'bg-teal-500 text-white': activeTab === '{{ $type }}',
                                'text-gray-700 dark:text-gray-300': activeTab !== '{{ $type }}'
                            }" @click.prevent="activeTab = '{{ $type }}'; initEditor();">
                        {{ __($email_template->name) }}
                    </a>
                </li>
                @endforeach
            </ul>
            <!-- Tab Content -->
            <div class="md:w-2/3 p-4">
                @foreach ($email_templates as $email_template)
                @php $type = $email_template->type ?? 'new'; @endphp
                <div x-show="activeTab === '{{ $type }}'" x-cloak>
                    <form class="space-y-6" action="{{ route('email_templates.save') }}" method="POST">
                        @csrf
                        @isset($email_template->id)
                        <input type="hidden" name="id" value="{{ $email_template->id }}">
                        @endisset

                        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg px-6 pb-6">
                            <div class="grid grid-cols-1 gap-6">
                                <!-- Name Input -->
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{
                                        __('Name') }}</label>
                                    <input readonly type="text" id="name"
                                        class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300"
                                        value="{{ __($email_template->name) ?? '' }}">
                                    <x-forms.error name="name" />
                                </div>

                                <!-- Subject Input -->
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{
                                        __('Subject') }}</label>
                                    <input type="text" name="subject" id="subject"
                                        class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300"
                                        value="{{ $email_template->subject ?? '' }}">
                                    <x-forms.error name="subject" />
                                </div>

                                <!-- Message Textarea -->
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{
                                        __('Message') }}</label>
                                    <textarea name="message" id="message_{{ $email_template->id }}"
                                        class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300 classic-editor"
                                        cols="30" rows="10">{{ $email_template->message ?? '' }}</textarea>
                                    <x-forms.error name="message" />
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-red-700 dark:text-red-300">
                                    <i class="fa-solid fa-circle-info"></i> {{ __('Note: Do not modify the text within
                                    {brackets}.') }} </label>
                            </div>

                            <!-- Submit Button -->
                            <div class="flex justify-center mt-6">
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
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

    <!-- Dark Mode Styles -->
    <style>
        .dark .bg-white {
            background-color: #1f2937 !important;
        }

        .dark .text-gray-700 {
            color: #d1d5db !important;
        }

        .dark .border-gray-300 {
            border-color: #4b5563 !important;
        }
    </style>

    <!-- CKEditor JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.16.2/ckeditor.js"
        integrity="sha512-bGYUkjDyyOMGm3ASzq3zRaWZ4CONNH1wAYMFch/Z0ASZrsg722SeRsX0FPPRZjTuJrqIMbB9fvY0LEMzyHeyeQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</x-app-layout>