@section('title')
    {{ __('List Role') }}
@endsection
<x-app-layout>
    <div class="relative m-6">
        <div class="flex flex-col md:flex-row justify-end items-center card mb-12">

            <a href="{{ route('role.create') }}"
                class="bg-primary-50 text-text-light dark:text-text-dark px-4 py-2 rounded-lg">
                <i class="fa-solid fa-plus"></i> {{ __('Create Role') }}
            </a>
        </div>
        <!-- Start heading here -->
        <div class="card">
            <div class="w-full ">
                <div class="dashboard-right pl-0 ">
                    <div class="invoices-table ">
                        <h2
                            class="text-xl font-semibold mb-4 text-text-light dark:text-text-dark text-text-light dark:text-text-dark ">
                            {{ __('Role List') }}
                        </h2>
                        <div class="overflow-x-auto pb-1">
                            <table class="w-full table-auto">
                                <thead class="table-header">
                                    <tr>
                                        <th scope="col" class="px-6 py-3  ">
                                            {{ __('Role Name') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3  ">
                                            {{ __('Permission') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3  ">
                                            {{ __('Action') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($roles->count() > 0)
                                        @foreach ($roles as $key => $role)
                                            @if (auth()->user()->role != 'superadmin')
                                                @if ($role->name != 'superadmin' && $role->name != 'employer')
                                                    <tr
                                                        class="hover:bg-gray-100 bg-body-light hover:dark:bg-body-dark transition duration-200">
                                                        <th scope="row"
                                                            class="flex items-center px-4 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                                            <div class="">
                                                                <div class="text-base font-semibold capitalize">
                                                                    {{ $role->name ?? '' }}</div>
                                                            </div>
                                                        </th>
                                                        <td
                                                            class="border-b border-[#eee] dark:border-slate-700 px-4 py-3 dark:border-stroke">
                                                            @foreach ($role->permissions as $permission)
                                                                <span
                                                                    class="inline-flex items-center justify-center px-2 py-1 mr-2 mb-2 text-xs font-bold leading-none text-white bg-primary-50 rounded-full">{{ $permission->name }}</span>
                                                            @endforeach
                                                        </td>
                                                        <td
                                                            class="border-b border-[#eee] dark:border-slate-700 px-4 py-3 dark:border-stroke">
                                                            <div class="flex space-x-2">
                                                                <a href="{{ route('role.edit', $role->id) }}"
                                                                    class="font-medium text-primary-600 dark:text-primary-500 hover:underline">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        fill="none" viewBox="0 0 24 24"
                                                                        stroke-width="1.5" stroke="currentColor"
                                                                        class="w-6 h-6">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                                    </svg>
                                                                </a>
                                                                <a onclick="showConfirmation({{ $role->id }})"
                                                                    class="font-medium cursor-pointer text-red-600 dark:text-red-500 hover:underline">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        fill="none" viewBox="0 0 24 24"
                                                                        stroke-width="1.5" stroke="currentColor"
                                                                        class="w-6 h-6">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @else
                                                <tr
                                                    class="bg-body-light dark:bg-body-dark hover:bg-gray-50 dark:hover:bg-gray-600">
                                                    <th scope="row"
                                                        class="flex items-center px-4 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                                        <div class="">
                                                            <div class="text-base font-semibold text-sm capitalize">
                                                                {{ $role->name ?? '' }}</div>
                                                        </div>
                                                    </th>
                                                    <td class="px-6 py-4  ">
                                                        @foreach ($role->permissions as $permission)
                                                            <span
                                                                class="inline-flex items-center justify-center px-2 py-1 mr-2 mb-2 text-xs font-bold leading-none text-white bg-primary-50 rounded-full">{{ $permission->name }}</span>
                                                        @endforeach
                                                    </td>
                                                    <td class="px-6 py-4  ">
                                                        <div class="flex space-x-2">
                                                            <a href="{{ route('role.edit', $role->id) }}"
                                                                class="font-medium text-primary-600 dark:text-primary-500 hover:underline">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class="w-6 h-6">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                                </svg>
                                                            </a>
                                                            <a onclick="showConfirmation({{ $role->id }})"
                                                                class="font-medium cursor-pointer text-red-600 dark:text-red-500 hover:underline">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class="w-6 h-6">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3" class="text-center py-4">
                                                <p class="text-gray-500">{{ __('No data found') }}</p>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function showConfirmation(roleId) {
            const confirmDelete = confirm("{{ __('Want to delete this Role') }} \n {{ __('If you are ready?') }}");
            if (confirmDelete) {
                // Proceed with the deletion
                document.getElementById('delete-role-form-' + roleId).submit();
            }
        }
    </script>
</x-app-layout>
