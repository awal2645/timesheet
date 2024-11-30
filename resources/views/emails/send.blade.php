@section('title', 'Send Emails')

<x-app-layout>
    <div class="m-6">
        <h2 class="text-2xl font-semibold mb-4">{{ __('Send Emails') }}</h2>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('emails.send') }}" method="POST" class="card">
            @csrf
            <div class="mb-4">
                <label for="subject" class="block text-sm font-medium">{{ __('Subject') }}</label>
                <input type="text" name="subject" id="subject"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="flex items-center gap-5">
                <div class="mb-4">
                    <label for="emails" class="block text-sm font-medium">{{ __('Select User Role') }}</label>
                    <select name="role[]" id="role" class="select2 w-full" multiple="multiple">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="emails" class="block text-sm font-medium">{{ __('Select or Add Emails') }}</label>
                    <select name="emails[]" id="emails" class="select2 w-full" multiple="multiple" required>
                        @foreach ($users as $user)
                            <option value="{{ $user->email }}">{{ $user->email }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label for="body" class="block text-sm font-medium">{{ __('Body') }}</label>
                <textarea name="body" id="body"
                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300 classic-editor"
                    cols="30" rows="10"></textarea>
            </div>

            <button type="submit"
                class="bg-primary-300 text-white px-4 py-2 rounded-lg">{{ __('Send Emails') }}</button>
        </form>
    </div>

    <!-- Select2 JS and CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- CKEditor JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.16.2/ckeditor.js"
        integrity="sha512-bGYUkjDyyOMGm3ASzq3zRaWZ4CONNH1wAYMFch/Z0ASZrsg722SeRsX0FPPRZjTuJrqIMbB9fvY0LEMzyHeyeQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        // Initialize CKEditor for the textarea
        document.addEventListener('DOMContentLoaded', function() {
            const editorElement = document.querySelector('.classic-editor');
            if (editorElement) {
                CKEDITOR.replace(editorElement.id);
            }

            // Initialize Select2 with tagging
            $('.select2').select2({
                placeholder: "{{ __('Select or add emails') }}",
                tags: true, // Enable tagging to add custom entries
                tokenSeparators: [',', ' '], // Allow adding emails separated by commas or spaces
                createTag: function(params) {
                    const term = params.term;

                    // Validate email format
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(term)) {
                        return null; // Ignore invalid email formats
                    }

                    return {
                        id: term,
                        text: term,
                        newOption: true
                    };
                }
            });
        });
    </script>
</x-app-layout>
