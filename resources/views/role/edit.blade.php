@section('title')
    {{ __('Edit Role') }}
@endsection

<x-app-layout>
    <div
        class="m-6 flex flex-col md:flex-row justify-end items-center md:space-y-0 card">
        <a href="{{ route('role.page') }}" class="bg-primary-300 text-white px-4 py-2 rounded-lg">
            <i class="fa-solid fa-plus"></i> {{ __('Back to Role List') }}
        </a>
    </div>
    <div class="m-6 card">
        <h2 class="text-3xl font-semibold mb-6 text-gray-800 dark:text-gray-100">{{ __('Edit Role') }}</h2>

        <form method="POST" action="{{ route('role.update', $role->id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Role Name -->
            <div class="relative z-0 w-full">
                <input type="text" name="role_name" id="role_name"
                    class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-primary-500 focus:outline-none focus:ring-0 focus:border-primary-600 peer"
                    placeholder=" " required value="{{ old('role_name') ?? $role->name }}" />
                <label for="role_name"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-primary-600 peer-focus:dark:text-primary-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    {{ __('Role Name') }}
                </label>
                @error('role_name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Permissions -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
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
                                class="w-11 h-6 bg-gray-300 rounded-full peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-300 dark:peer-focus:ring-primary-800 dark:bg-gray-700 peer-checked:bg-primary-300 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full dark:after:border-gray-600">
                            </div>
                        </label>
                        <span
                            class="text-md font-medium text-gray-900 dark:text-gray-300">{{ $permission->name }}</span>
                    </div>
                @endforeach
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="block w-full text-lg font-semibold text-white bg-primary-300 hover:bg-primary-300 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:focus:ring-primary-800 py-3 rounded-lg shadow-md transition-colors duration-300">
                {{ __('Submit') }}
            </button>
        </form>
    </div>
</x-app-layout>
