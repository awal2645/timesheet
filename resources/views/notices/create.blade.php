@section('title', 'Create Notice')

<x-app-layout>
    <div class="m-6 card">
        <h2 class="text-xl font-semibold mb-4 text-text-light dark:text-text-dark ">Create Notice</h2>

        <form action="{{ route('notices.store') }}" method="POST">
            @csrf
            <div class="form-field">
                <input type="text" id="title" name="title"required>
                <label for="title">Title</label>
            </div>
            <div class="form-field">
                <textarea id="content" name="content" required></textarea>
                <label for="content">Content</label>
            </div>
            <div class="form-field">
                <select multiple id="role" name="role[]"
                class="form-select">
                @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        <label for="role" class="block mb-2">Role</label>
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
