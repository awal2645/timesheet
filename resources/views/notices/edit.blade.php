@section('title', 'Edit Notice')

<x-app-layout>
    <div class="flex justify-between items-center m-6 card">
        <h2 class="text-xl font-medium text-text-light dark:text-text-dark">{{ __('Edit Notice') }}</h2>
        <a href="{{ route('notices.index') }}"
            class="btn bg-primary-50 dark:bg-primary-50 text-text-light dark:text-text-dark">{{ __('Go to Notice List') }}</a>
    </div>
    <div class="m-6 card">
        <h2 class="text-xl font-semibold mb-4 text-text-light dark:text-text-dark text-text-light dark:text-text-dark ">Edit Notice</h2>

        <form action="{{ route('notices.update', $notice->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-field">
                <input type="text" id="title" name="title" value="{{ $notice->title }}" required>
                <label for="title">Title</label>
            </div>
            <div class="form-field">
                <textarea id="content" name="content" required>{{ $notice->content }}</textarea>
                <label for="content">Content</label>
            </div>
            <div class="form-field">
                <input type="text" id="role" name="role" value="{{ $notice->role }}">
                <label for="role">Roll Number (Optional)</label>
            </div>
            <button type="submit" class="bg-primary-50 text-text-light dark:text-text-dark px-4 py-2 rounded-lg">Update Notice</button>
        </form>
    </div>
</x-app-layout>
