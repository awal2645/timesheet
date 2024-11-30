@section('title', 'Create Notice')

<x-app-layout>
    <div class="m-6 card">
        <h2 class="text-xl font-semibold mb-4 text-text-light dark:text-text-dark ">Create Notice</h2>

        <form action="{{ route('notices.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="title" class="block mb-2">Title</label>
                <input type="text" id="title" name="title"
                    class="bg-gray-50 dark:bg-gray-900   rounded-lg w-full p-2.5" required>
            </div>
            <div class="mb-4">
                <label for="content" class="block mb-2">Content</label>
                <textarea id="content" name="content" class="bg-gray-50 dark:bg-gray-900   rounded-lg w-full p-2.5" required></textarea>
            </div>
            <div class="mb-4">
                <label for="role" class="block mb-2">Role</label>
                <select multiple id="role" name="role[]"
                    class="bg-gray-50 dark:!bg-gray-900   rounded-lg w-full p-2.5">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-primary-300 text-white px-4 py-2 rounded-lg">Create Notice</button>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $('#role').select2();
        });
    </script>
</x-app-layout>
