@section('title')
{{ __('Create Meeting') }}
@endsection
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>

<x-app-layout>

    <div class="max-w-lg mx-auto mt-6 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">{{ __('Create New Meeting') }}</h2>
        <form method="POST" action="{{ route('meeting.store') }}">
            @csrf

            <!-- Topic -->
            <div class="mb-5">
                <label for="topic" class="block text-sm font-medium text-gray-700 dark:text-gray-400">{{ __('Topic')
                    }}</label>
                <input type="text" name="topic" id="topic"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-400"
                    placeholder="{{ __('Enter Topic') }}" value="{{ old('topic') }}" required>
                @error('topic')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Start Date -->
            <div class="mb-5">
                <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-400">{{ __('Start
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
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-400">{{ __('Meeting
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
                <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-400"> {{ __('Select
                    Participants Role') }} </label>
                <div class="flex items-center space-x-4">
                    @foreach ($roles as $role)
                    <div>
                        <input type="radio" id="role_{{ $role->id }}" name="selected_role" value="{{ $role->name }}"
                            class="text-blue-600 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600" {{
                            old('selected_role')==$role->name ? 'checked' : '' }} required>
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
                    <option value="{{ $user->id }}" {{ collect(old('participants'))->contains($user->id) ? 'selected' :
                        '' }}>
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
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-400">{{
                    __('Meeting Description') }}</label>
                <textarea name="description" id="description" rows="4"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-400"
                    placeholder="{{ __('Enter Description') }}">{{ old('description') }}</textarea>
                @error('description')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600">
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