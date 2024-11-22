<!-- email-template-repeater file content -->
<div class="{{ !empty($active) || !empty($is_new) ? 'block' : 'hidden' }}" id="{{ $type ?? 'new' }}">
    <form class="space-y-6" action="{{ route('email_templates.save') }}" method="POST">
        @csrf
        @isset($id)
            <input type="hidden" name="id" value="{{ $id }}">
        @endisset
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg px-6  pb-6">
            <div class="grid grid-cols-1 gap-6">
                <div class="col-span-1">
                    <!-- Name Input -->
                    <div class="mb-4">
                        <label
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Name') }}</label>
                        <input type="text" name="name" id="name"
                            class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300"
                            value="{{ $name ?? '' }}" @if (empty($is_new)) disabled @endif>
                        <x-forms.error name="name" />
                    </div>

                    <!-- Type Input (only for new templates) -->
                    @if (!empty($is_new))
                        <div class="mb-4">
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Type') }}</label>
                            <input type="text" name="type" id="type"
                                class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300"
                                value="{{ $type ?? '' }}">
                            <x-forms.error name="type" />
                        </div>
                    @endif

                    <!-- Subject Input -->
                    <div class="mb-4">
                        <label
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Subject') }}</label>
                        <input type="text" name="subject" id="subject"
                            class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300"
                            value="{{ $subject ?? '' }}">
                        <x-forms.error name="subject" />
                    </div>

                    <!-- Message Textarea -->
                    <div class="mb-4">
                        <label
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Message') }}</label>
                        <textarea name="message" id="message"
                            class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300 classic-editor"
                            cols="30" rows="10">{{ $message ?? '' }}</textarea>
                        <x-forms.error name="message" />
                    </div>

                    <!-- Available Flags -->
                    @if (!empty($flags['search']))
                        <small class="block text-sm text-gray-500 dark:text-gray-400">
                            {{ __('Available flags:') }}
                            @foreach ($flags['search'] as $flag)
                                <code
                                    class="bg-gray-100 dark:bg-gray-600 dark:text-gray-100 p-1 rounded">{{ $flag }}</code>
                                @if (!$loop->last)
                                ,@else.
                                @endif
                            @endforeach
                        </small>
                    @endif
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center mt-6">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <i class="fas fa-sync mr-2"></i>{{ __('update') }}
                </button>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.16.2/ckeditor.js"
            integrity="sha512-bGYUkjDyyOMGm3ASzq3zRaWZ4CONNH1wAYMFch/Z0ASZrsg722SeRsX0FPPRZjTuJrqIMbB9fvY0LEMzyHeyeQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            CKEDITOR.replace('message');
        </script>
    </form>
</div>

<!-- Dark mode styles to support both themes -->
