@section('title', 'Create Notice')

<x-app-layout>
    <div class="flex justify-between items-center m-6 card">
        <h2 class="text-xl font-medium text-text-light dark:text-text-dark">{{ __('Create Notice') }}</h2>
        <a href="{{ route('notices.index') }}"
            class="btn bg-primary-50 dark:bg-primary-50 text-text-light dark:text-text-dark">{{ __('Go to Notice List') }}</a>
    </div>
    <div class="m-6 card">
        <h2 class="text-xl font-semibold mb-4 text-text-light dark:text-text-dark text-text-light dark:text-text-dark ">{{ __('Create Notice') }}</h2>

        <form action="{{ route('notices.store') }}" method="POST">
            @csrf
            <div class="form-field">
                <input type="text" id="title" name="title" required>
                <label for="title" class="form-label">{{ __('Title') }}</label>
            </div>
            <div class="form-field">
                <textarea id="content" name="content" required></textarea>
                <label for="content">{{ __('Content') }}</label>
            </div>
            <div class="form-field">
                <select multiple id="role" name="role[]" class="form-select">
                    @foreach ($roles as $role)
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="{{ $role->id }}">
                        {{ ucfirst($role->name) }}
                    </option>
                    @endforeach
                </select>
                {{-- <label for="role" class="form-label">{{ __('Role') }}</label> --}}
            </div>
            <button type="submit" class="bg-primary-50 text-text-light dark:text-text-dark px-4 py-2 rounded-lg">
                {{ __('Create Notice') }}
            </button>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $('#role').select2();
        });
    </script>
</x-app-layout>