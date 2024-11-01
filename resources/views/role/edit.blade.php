@section('title')
    {{ __('Edit Role') }}
@endsection

<x-app-layout>
    <div class="max-w-lg mx-auto mt-6 p-8 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
        <h2 class="text-3xl font-semibold mb-6 text-gray-800 dark:text-gray-100">{{ __('Edit Role') }}</h2>

        <form method="POST" action="{{ route('role.update', $role->id) }}" class="max-w-lg mx-auto space-y-6">
            @csrf
            @method('PUT')

            <!-- Role Name -->
            <div class="relative z-0 w-full">
                <input type="text" name="role_name" id="role_name"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required value="{{ old('role_name') ?? $role->name }}" />
                <label for="role_name"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    {{ __('Role Name') }}
                </label>
                @error('role_name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Permissions -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                @foreach ($permissions as $permission)
                    @if (auth()->user()->role != 'superadmin' &&
                            in_array($permission->name, [
                                'Employer view',
                                'Employer create',
                                'Role view',
                                'Role create',
                                'Role edit',
                                'Role update',
                                'Role destroy',
                                'Invite employer',
                                'Employer update',
                                'Employer destroy',
                            ]))
                        @continue
                    @endif
                    <div class="flex items-center space-x-3">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="permissions[]" id="permission_{{ $permission->id }}"
                                value="{{ $permission->id }}" class="sr-only peer"
                                {{ in_array($permission->id, old('permissions', $role->permissions->pluck('id')->toArray())) ? 'checked' : '' }}>
                            <div
                                class="w-11 h-6 bg-gray-300 rounded-full peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:bg-purple-500 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full dark:after:border-gray-600">
                            </div>
                        </label>
                        <span
                            class="text-md font-medium text-gray-900 dark:text-gray-300">{{ $permission->name }}</span>
                    </div>
                @endforeach
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="block w-full text-lg font-semibold text-white bg-purple-500 hover:bg-purple-500 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 py-3 rounded-lg shadow-md transition-colors duration-300">
                {{ __('Submit') }}
            </button>
        </form>
    </div>
</x-app-layout>
