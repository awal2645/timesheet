@section('title')
    {{ 'List Employer' }}
@endsection

<x-app-layout>
    <div class="relative m-6">
        <div>
            <div class="my-8 card flex flex-col md:flex-row gap-4 md:justify-between items-start md:items-center">
                <form action="{{ route('employer.index') }}" method="GET" class="w-full">
                    <div class="mb-3">
                        <label for="search" class="block mb-2 text-sm font-medium text-text-light dark:text-text-dark">
                            {{ __('Search') }}
                        </label>
                        <div class="flex flex-wrap">
                            <input type="text" id="search" name="search" value="{{ request('search') }}"
                                class="border border-gray-300 text-text-light dark:text-text-dark text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-card-dark bg-card-light dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="{{ __('Search') }}" />
                            <button
                                class="bg-primary-50 text-text-light dark:text-text-dark px-4 py-2 rounded-lg ml-2 hover:bg-primary-50 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                                {{ __('Search') }}
                            </button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('employer.create') }}"
                    class="bg-primary-50 text-text-light dark:text-text-dark px-5 py-2 rounded-lg hover:bg-primary-50 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                    <i class="fa-solid fa-plus"></i> {{ __('Create Employer') }}
                </a>
            </div>

            <div class="flex flex-wrap">
                <div class="w-full">
                    <div class="dashboard-right pl-0">
                        <div class="invoices-table">
                            <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark ml-1">
                                {{ __('Employer List') }}</h2>
                            <div>
                                <div class="card overflow-x-auto">
                                    <table class="w-full table-auto">
                                        <thead class="table-header">
                                            <tr class="rounded-2xl text-left">
                                                <th class="min-w-[220px] px-4 py-4 font-medium">
                                                    <div class="flex gap-2 items-center text-base">
                                                        <span>{{ __('Employer Name') }}</span>
                                                    </div>
                                                </th>
                                                <th class="min-w-[150px] px-4 py-4 font-medium">
                                                    <div class="flex gap-2 items-center text-base">
                                                        <span>{{ __('Employee') }}</span>
                                                    </div>
                                                </th>
                                                <th class="min-w-[120px] px-4 py-4 font-medium">
                                                    <div class="flex gap-2 items-center text-base">
                                                        <span>{{ __('Website') }}</span>
                                                    </div>
                                                </th>
                                                <th class="min-w-[120px] px-4 py-4 font-medium">
                                                    <div class="flex gap-2 items-center text-base">
                                                        <span>{{ __('Status') }}</span>
                                                    </div>
                                                </th>
                                                <th class="px-4 py-4 font-medium"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($employers as $employer)
                                                <tr class="hover:bg-gray-100 hover:dark:bg-gray-800">
                                                    <td class="p-4">
                                                        <div class="flex items-center">
                                                            @if ($employer->user->image)
                                                                <img class="w-10 h-10 rounded-full"
                                                                    src="{{ asset($employer->user->image) }}"
                                                                    alt="image">
                                                            @else
                                                                <img class="w-10 h-10 rounded-full"
                                                                    src="https://img.freepik.com/premium-vector/company-icon-simple-element-illustration-company-concept-symbol-design-can-be-used-web-mobile_159242-7784.jpg"
                                                                    alt="image">
                                                            @endif
                                                            <div class="ml-3">
                                                                <div class="text-base font-semibold">
                                                                    {{ $employer->employer_name }}</div>
                                                                <div class="text-sm text-gray-500">
                                                                    {{ $employer->user->email }}</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="p-4">
                                                        <span class="text-base font-semibold">Employee (
                                                            {{ $employer->employee->count() }} )</span>
                                                    </td>
                                                    <td class="p-4">
                                                        <a href="{{ $employer->website }}" target="_blank"
                                                            class="hover:text-primary-500">
                                                            {{ $employer->website }}
                                                        </a>
                                                    </td>
                                                    <td class="p-4">
                                                        <div class="flex items-center">
                                                            <div class="h-2.5 w-2.5 rounded-full mr-2"
                                                                style="background-color: {{ $employer->status === 1 ? 'green' : 'red' }};">
                                                            </div>
                                                            <form id="statusForm{{ $employer->id }}"
                                                                action="{{ route('employer.updateStatus', $employer->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <select name="status"
                                                                    class="border-none bg-transparent focus:outline-none"
                                                                    onchange="document.getElementById('statusForm{{ $employer->id }}').submit()">
                                                                    <option value="1"
                                                                        {{ $employer->status === 1 ? 'selected' : '' }}>
                                                                        {{ __('Active') }}</option>
                                                                    <option value="0"
                                                                        {{ $employer->status === 0 ? 'selected' : '' }}>
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
                                                                    <a href="{{ route('employer.edit', $employer->id) }}"
                                                                        class="hover:text-primary-500 w-full text-left px-4 py-2 flex gap-3 items-center transition-all duration-300 ">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            fill="none" viewBox="0 0 24 24"
                                                                            stroke-width="1.5" stroke="currentColor"
                                                                            class="w-4 h-4">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                                        </svg>
                                                                        {{ __('Edit') }}
                                                                    </a>
                                                                    <button
                                                                        onclick="showConfirmation({{ $employer->id }})"
                                                                        class="hover:text-primary-500 w-full text-left px-4 py-2 flex gap-3 items-center transition-all duration-300 ">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            fill="none" viewBox="0 0 24 24"
                                                                            stroke-width="1.5" stroke="currentColor"
                                                                            class="w-4 h-4">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                                        </svg>
                                                                        {{ __('Delete') }}
                                                                    </button>
                                                                </div>
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center py-8">
                                                        <x-svgs.no-data-found
                                                            class="mx-auto md:size-[360px] size-[220px]" />
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

            @if ($employers->total() > $employers->count())
                <div class="mt-2">
                    <div class="d-flex justify-content-center">
                        {{ $employers->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
    <script>
        function showConfirmation(id) {
            Swal.fire({
                title: 'Want to delete this Employer!',
                text: "{{ __('If you are ready?') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "{{ __('Yes') }}",
                cancelButtonText: "{{ __('Cancel') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/employer/destroy/" + id;
                }
            });
        }
    </script>
    <style>
        .dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
</x-app-layout>
