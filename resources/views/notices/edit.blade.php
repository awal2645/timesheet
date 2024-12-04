@section('title', 'Edit Notice')

<x-app-layout>
    <div class="flex justify-between m-6 card">
        <h2 class="text-xl font-medium text-text-light dark:text-text-dark">{{ __('Edit Notice') }}</h2>
        <a href="{{ route('notices.index') }}"
            class="btn bg-primary-50 dark:bg-primary-50 text-text-light dark:text-text-dark">{{ __('Go to Notice List') }}</a>
    </div>
    <div class="m-6 card">
        <h2 class="text-xl font-semibold mb-4 text-text-light dark:text-text-dark text-text-light dark:text-text-dark ">Edit Notice</h2>

        <form action="{{ route('notices.update', $notice->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block mb-2">Title</label>
                <input type="text" id="title" name="title" value="{{ $notice->title }}"
                    class="bg-gray-50 dark:bg-gray-900   rounded-lg w-full p-2.5" required>
            </div>
            <div class="mb-4">
                <label for="content" class="block mb-2">Content</label>
                <textarea id="content" name="content" class="bg-gray-50 dark:bg-gray-900   rounded-lg w-full p-2.5" required>{{ $notice->content }}</textarea>
            </div>
            <div class="mb-4">
                <label for="role" class="block mb-2">Roll Number (Optional)</label>
                <input type="text" id="role" name="role" value="{{ $notice->role }}"
                    class="bg-gray-50 dark:bg-gray-900   rounded-lg w-full p-2.5">
            </div>
            <button type="submit" class="bg-primary-50 text-text-light dark:text-text-dark px-4 py-2 rounded-lg">Update Notice</button>
        </form>
    </div>
</x-app-layout>
