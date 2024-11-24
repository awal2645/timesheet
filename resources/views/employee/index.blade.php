@section('title')
    {{ __('List Employee') }}
@endsection
<x-app-layout>
    <div class="relative overflow-x-auto">
        <div class="container mx-8">
            <div
                class="my-8 px-5 py-3 rounded-2xl dark:bg-black/10 bg-white/10 backdrop-blur border border-black/10 dark:border-white/10 flex flex-col md:flex-row justify-between items-center md:space-y-0">
                <form action="{{ route('employee.index') }}" method="GET">
                    <div class="mb-5">
                        <label for="search" class="block mb-2 text-sm font-medium">{{ __('Search') }}</label>
                        <div class="flex">
                            <input type="text" id="search" name="search" value="{{ request('search') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="{{ __('Search') }}" />
                            <button
                                class="bg-primary-500 text-white px-4 py-2 rounded-lg ml-2">{{ __('Search') }}</button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('employee.create') }}" class="bg-primary-500 text-white px-4 py-2 rounded-lg">
                    <i class="fa-solid fa-plus"></i> {{ __('Create Employee') }}
                </a>
            </div>

            <div class="flex flex-wrap">
                <div class="w-full">
                    <div class="dashboard-right pl-0">
                        <div class="invoices-table">
                            <h2 class="text-xl font-semibold mb-4">{{ __('Employee List') }}</h2>
                            <div class="overflow-x-auto">
                                <div
                                    class="rounded-lg border border-black/10 dark:border-white/10 shadow-lg bg-white/10 backdrop-blur dark:bg-black/10 px-5 pb-20 pt-6 shadow-default sm:px-7.5">
                                    <table class="w-full table-auto">
                                        <thead>
                                            <tr class="bg-gray-200 rounded-2xl text-left dark:bg-gray-700">
                                                <th class="p-4 font-medium text-black dark:text-white">
                                                    <div class="flex gap-2 items-center text-base">
                                                        <span>{{ __('Employee Name') }}</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                            class="bi bi-arrow-down size-3" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd"
                                                                d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1" />
                                                        </svg>
                                                    </div>
                                                </th>
                                                <th class="p-4 font-medium text-black dark:text-white">
                                                    <div class="flex gap-2 items-center text-base">
                                                        <span>{{ __('Employer Name') }}</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                            class="bi bi-arrow-down size-3" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd"
                                                                d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1" />
                                                        </svg>
                                                    </div>
                                                </th>
                                                <th class="p-4 font-medium text-black dark:text-white">
                                                    <div class="flex gap-2 items-center text-base">
                                                        <span>{{ __('Total Leave') }}</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                            class="bi bi-arrow-down size-3" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd"
                                                                d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1" />
                                                        </svg>
                                                    </div>
                                                </th>
                                                <th class="p-4 font-medium text-black dark:text-white">
                                                    <div class="flex gap-2 items-center text-base">
                                                        <span>{{ __('Status') }}</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                            class="bi bi-arrow-down size-3" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd"
                                                                d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1" />
                                                        </svg>
                                                    </div>
                                                </th>
                                                <th class="p-4 font-medium text-black dark:text-white">
                                                    {{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($employees as $employee)
                                                <tr class="hover:bg-gray-100 hover:dark:bg-gray-800">
                                                    <td class="p-4">
                                                        <div class="flex items-center">
                                                            @if ($employee->user->image)
                                                                <img class="w-10 h-10 rounded-full"
                                                                    src="{{ asset($employee->user->image) }}"
                                                                    alt="image">
                                                            @else
                                                                <img class="w-10 h-10 rounded-full"
                                                                    src="https://img.freepik.com/premium-vector/company-icon-simple-element-illustration-company-concept-symbol-design-can-be-used-web-mobile_159242-7784.jpg"
                                                                    alt="image">
                                                            @endif
                                                            <div class="ml-3">
                                                                <div class="text-base font-semibold">
                                                                    {{ $employee->employee_name }}</div>
                                                                <div class="text-sm text-gray-500">
                                                                    {{ $employee->user->email }}</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="p-4">{{ $employee->employer->employer_name }}</td>
                                                    <td class="p-4">{{ $employee->approvedLeaveCount() ?? 0 }}</td>
                                                    <td class="p-4">
                                                        <div class="flex items-center">
                                                            <div class="h-2.5 w-2.5 rounded-full mr-2"
                                                                style="background-color: {{ $employee->status === 1 ? 'green' : 'red' }};">
                                                            </div>
                                                            <form id="statusForm{{ $employee->id }}"
                                                                action="{{ route('employee.updateStatus', $employee->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <select name="status"
                                                                    class="border-none bg-transparent focus:outline-none"
                                                                    onchange="document.getElementById('statusForm{{ $employee->id }}').submit()">
                                                                    <option value="1"
                                                                        {{ $employee->status === 1 ? 'selected' : '' }}>
                                                                        {{ __('Active') }}</option>
                                                                    <option value="0"
                                                                        {{ $employee->status === 0 ? 'selected' : '' }}>
                                                                        {{ __('Inactive') }}</option>
                                                                </select>
                                                            </form>
                                                        </div>
                                                    </td>
                                                    <td class="p-4">
                                                        <div class="flex justify-end">
                                                            <span x-data="{ openDropdown: false }" class="relative">
                                                                <button @click="openDropdown = !openDropdown"
                                                                    class="focus:outline-none border border-black/30 dark:border-white/30 px-2 py-1.5 rounded">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        width="16" height="16"
                                                                        fill="currentColor" class="bi bi-three-dots"
                                                                        viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3" />
                                                                    </svg>
                                                                </button>
                                                                <div x-show="openDropdown"
                                                                    @click.away="openDropdown = false"
                                                                    class="absolute mt-2 right-0 w-32 bg-white dark:bg-black/80 py-2 rounded-md shadow-lg z-10">
                                                                    <a href="{{ route('employee.edit', $employee->id) }}"
                                                                        class="hover:text-primary-500 w-full text-left px-4 py-2 flex gap-3 items-center transition-all duration-300 hover:bg-black/10 hover:dark:bg-white/10">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            fill="none" viewBox="0 0 24 24"
                                                                            stroke-width="1.5" stroke="currentColor"
                                                                            class="w-4 h-4">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                                        </svg>
                                                                        Edit
                                                                    </a>
                                                                    <button
                                                                        onclick="showConfirmation({{ $employee->id }})"
                                                                        class="hover:text-primary-500 w-full text-left px-4 py-2 flex gap-3 items-center transition-all duration-300 hover:bg-black/10 hover:dark:bg-white/10">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            fill="none" viewBox="0 0 24 24"
                                                                            stroke-width="1.5" stroke="currentColor"
                                                                            class="w-4 h-4">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                                        </svg>
                                                                        Delete
                                                                    </button>
                                                                </div>
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center py-8">
                                                        <img src="{{ asset('images/no-data-found.svg') }}"
                                                            alt="No data found" class="mx-auto max-w-xs">
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($employees->total() > $employees->count())
                <div class=" mt-2">
                    <div class="d-flex justify-content-center">
                        {{ $employees->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
<style>
    .dropdown:hover .dropdown-menu {
        display: block;
    }

    #searchInput {
        width: 160px;
        /* Adjust the width as needed */
    }
</style>
