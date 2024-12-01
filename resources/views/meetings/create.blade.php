@section('title')
    {{ __('Create Meeting') }}
@endsection
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>

<x-app-layout>

    <div class="m-6 p-6 shadow-md card">
        <h2 class="text-2xl font-bold mb-4">{{ __('Create New Meeting') }}</h2>
        <form method="POST" action="{{ route('meeting.store') }}">
            @csrf

            <!-- Collapsible Section for Zoom Credentials -->
            <div class="mb-5">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="toggleZoomCredentialsCheckbox" class="sr-only peer" />
                    <div
                        class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-primary-300 dark:peer-focus:ring-primary-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary-300">
                    </div>
                    <span
                        class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Toggle Zoom Credentials') }}</span>
                </label>
                <div id="zoomCredentials" class="hidden">
                    <!-- Zoom Account ID -->
                    <div class="mb-5">
                        <label for="zoom_account_id"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-400">{{ __('Zoom Account ID') }}</label>
                        <input type="text" name="zoom_account_id" id="zoom_account_id"
                            class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-400"
                            placeholder="{{ __('Enter Zoom Account ID') }}"
                            value="{{ old('zoom_account_id', auth()->user()->zoom_account_id) }}" required>
                        @error('zoom_account_id')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Zoom Client ID -->
                    <div class="mb-5">
                        <label for="zoom_client_id"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-400">{{ __('Zoom Client ID') }}</label>
                        <input type="text" name="zoom_client_id" id="zoom_client_id"
                            class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-400"
                            placeholder="{{ __('Enter Zoom Client ID') }}"
                            value="{{ old('zoom_client_id', auth()->user()->zoom_client_id) }}" required>
                        @error('zoom_client_id')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Zoom Client Secret -->
                    <div class="mb-5">
                        <label for="zoom_client_secret"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-400">{{ __('Zoom Client Secret') }}</label>
                        <input type="password" name="zoom_client_secret" id="zoom_client_secret"
                            class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-400"
                            placeholder="{{ __('Enter Zoom Client Secret') }}"
                            value="{{ old('zoom_client_secret', auth()->user()->zoom_client_secret) }}" required>
                        @error('zoom_client_secret')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    $('#toggleZoomCredentialsCheckbox').change(function() {
                        $('#zoomCredentials').toggleClass('hidden', !this.checked);
                    });
                });
            </script>
            <!-- Topic -->
            <div class="mb-5">
                <label for="topic"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-400">{{ __('Topic') }}</label>
                <input type="text" name="topic" id="topic"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-400"
                    placeholder="{{ __('Enter Topic') }}" value="{{ old('topic') }}" required>
                @error('topic')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Start Date -->
            <div class="mb-5">
                <label for="start_date"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-400">{{ __('Start
                                                                                                                        Date') }}</label>
                <input type="datetime-local" name="start_date" id="start_date"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-400"
                    value="{{ old('start_date') }}" required>
                @error('start_date')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Meeting Password -->
            <div class="mb-5">
                <label for="password"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-400">{{ __('Meeting
                                                                                                                        Password') }}</label>
                <input type="password" name="password" id="password"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-400"
                    placeholder="{{ __('Enter password') }}" value="{{ old('password') }}" required>
                @error('password')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Participants Role -->
            <div class="mb-5">
                <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                    {{ __('Select
                                                                                                                        Participants Role') }}
                </label>
                <div class="flex items-center space-x-4">
                    @foreach ($roles as $role)
                        <div>
                            <input type="radio" id="role_{{ $role->id }}" name="selected_role"
                                value="{{ $role->name }}"
                                class="text-primary-600 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600"
                                {{ old('selected_role') == $role->name ? 'checked' : '' }} required>
                            <label for="role_{{ $role->id }}" class="ml-2 text-sm font-medium dark:text-gray-400">
                                {{ $role->name }}
                            </label>

                        </div>
                    @endforeach
                </div>
                @error('selected_role')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Participants -->
            <div class="mb-5">
                <label for="participants" class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                    {{ __('Participants') }}
                </label>
                <select name="participants[]" id="participants" multiple
                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-400">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            {{ collect(old('participants'))->contains($user->id) ? 'selected' : '' }}>
                            {{ $user->username }}
                        </option>
                    @endforeach
                </select>
                @error('participants')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Meeting Description -->
            <div class="mb-5">
                <label for="description"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-400">{{ __('Meeting Description') }}</label>
                <textarea name="description" id="description" rows="4"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-400"
                    placeholder="{{ __('Enter Description') }}">{{ old('description') }}</textarea>
                @error('description')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>


            <!-- Submit Button -->
            <div class="flex ">
                <button type="submit"
                    class="bg-primary-300 text-white px-4 py-2 rounded shadow hover:bg-primary-300 dark:bg-primary-300 dark:hover:bg-primary-300">
                    {{ __('Save') }}
                </button>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $('#participants').select2({
                placeholder: "Select participants",
                allowClear: true,
                width: '100%', // Full-width dropdown
            });
        });
    </script>

</x-app-layout>
