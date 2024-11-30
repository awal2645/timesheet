@section('title')
    {{ 'List Client' }}
@endsection
<x-app-layout>
    <div class="relative m-6">
        <div>
            <div class="my-8 card flex justify-between items-center">
                <form action="{{ route('client.index') }}" method="GET" class="w-full">
                    <div class="mb-5">
                        <label for="search" class="block mb-2 text-sm font-medium text-text-light dark:text-text-dark">
                            {{ __('Search') }}
                        </label>
                        <div class="flex">
                            <input type="text" id="search" name="search" value="{{ request('search') }}"
                                class="border border-gray-300 text-text-light dark:text-text-dark text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-header-dark bg-header-light dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="{{ __('Search') }}" />
                            <button
                                class="bg-primary-300 text-text-light dark:text-text-dark px-4 py-2 rounded-lg ml-2 hover:bg-primary-600 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                                {{ __('Search') }}
                            </button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('client.create') }}"
                    class="bg-primary-300 text-text-light dark:text-text-dark px-5 py-2 rounded-lg hover:bg-primary-600 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                    <i class="fa-solid fa-plus"></i> {{ __('Create Client') }}
                </a>
            </div>

            <!-- Start heading here -->
            <div class="flex flex-wrap">
                <div class="w-full ">
                    <div class="dashboard-right pl-0 ">
                        <div class="invoices-table ">
                            <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark ">
                                {{ __('Client
                                                                                                                                                                                                                                List') }}
                            </h2>
                            <div>
                                <div class="card">
                                    <div class="max-w-full">
                                        <table class="w-full table-auto">
                                            <thead class="table-header">
                                                <tr class="rounded-2xl text-left ">
                                                    <th class="min-w-[220px] px-4 py-4 font-medium">
                                                        <div class="flex gap-2 items-center text-base">
                                                            <span>{{ __('Client Name') }}</span>
                                                        </div>
                                                    </th>
                                                    <th class="min-w-[150px] px-4 py-4 font-medium">
                                                        <div class="flex gap-2 items-center text-base">
                                                            <span>{{ __('Contact Person Name') }}</span>
                                                        </div>
                                                    </th>
                                                    <th class="min-w-[120px] px-4 py-4 font-medium">
                                                        <div class="flex gap-2 items-center text-base">
                                                            <span>{{ __('Status') }}</span>
                                                        </div>
                                                    </th>
                                                    <th class="px-4 py-4 font-medium">
                                                        <div class="flex gap-2 items-center text-base">
                                                            <span>{{ __('Total Project') }}</span>
                                                        </div>
                                                    </th>
                                                    <th class="px-4 py-4 font-medium">
                                                        <div class="flex gap-2 items-center text-base">
                                                            <span>{{ __('Total Task') }}</span>
                                                        </div>
                                                    </th>
                                                    <th class="px-4 py-4 font-medium"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($clients->count() > 0)
                                                    @foreach ($clients as $key => $client)
                                                        <tr
                                                            class="hover:bg-gray-100 hover:dark:bg-gray-800 transition duration-200">
                                                            <td
                                                                class="border-b border-[#eee] dark:border-slate-700 px-4 py-3 pl-9 dark:border-stroke dark xl:pl-11">
                                                                <div class="text-sm font-semibold">
                                                                    {{ $client->client_name }}
                                                                </div>
                                                                <div class="text-xs font-normal text-gray-500">
                                                                    {{ $client->client_email }}
                                                                </div>
                                                            </td>
                                                            <td
                                                                class="text-sm border-b border-[#eee] dark:border-slate-700 px-4 py-3 dark:border-stroke dark">
                                                                {{ $client->contact_name }}
                                                            </td>
                                                            <td
                                                                class="border-b border-[#eee] dark:border-slate-700 px-4 py-2.5 dark:border-stroke dark">
                                                                <form
                                                                    action="{{ route('client.updateStatus', $client->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <label
                                                                        class="inline-flex items-center cursor-pointer">
                                                                        <input type="checkbox" name="status"
                                                                            id="status"
                                                                            {{ $client->status == '1' ? 'checked' : '' }}
                                                                            class="sr-only peer"
                                                                            onchange="this.form.submit()">
                                                                        <div
                                                                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary-300 dark:peer-focus:ring-primary-300 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary-500">
                                                                        </div>
                                                                    </label>
                                                                </form>
                                                            </td>


                                                            <td
                                                                class="text-sm border-b border-[#eee] dark:border-slate-700 px-4 py-3 dark:border-strokedark">
                                                                {{ $client->totalProject() }}
                                                            </td>
                                                            <td
                                                                class="text-sm border-b border-[#eee] dark:border-slate-700 px-4 py-3 dark:border-strokedark">
                                                                {{ $client->totalTask() }}
                                                            </td>
                                                            <td
                                                                class="border-b border-[#eee] dark:border-slate-700 px-4 py-3 dark:border-strokedark">
                                                                <div class="flex justify-end">
                                                                    <span x-data="{ openDropdown: false }" class="relative">
                                                                        <button @click="openDropdown = !openDropdown"
                                                                            class="focus:outline-none border border-black/30 dark:border-white/30 px-2 py-1.5 rounded">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="16" height="16"
                                                                                fill="currentColor"
                                                                                class="bi bi-three-dots"
                                                                                viewBox="0 0 16 16">
                                                                                <path
                                                                                    d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3" />
                                                                            </svg>
                                                                        </button>

                                                                        <div x-show="openDropdown"
                                                                            @click.away="openDropdown = false"
                                                                            class="absolute mt-2 right-0 w-32 bg-white dark:bg-black/80 py-2 rounded-md shadow-lg z-10">
                                                                            <div class="flex flex-col items-start">
                                                                                <a href="{{ route('client.edit', $client->id) }}"
                                                                                    class="hover:text-primary-500 w-full text-left px-4 py-2 flex gap-3 items-center transition-all duration-300 hover:bg-black/10 hover:dark:bg-white/10">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                        fill="currentColor"
                                                                                        class="bi bi-pencil-square size-4"
                                                                                        viewBox="0 0 16 16">
                                                                                        <path
                                                                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                                                        <path fill-rule="evenodd"
                                                                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                                                    </svg>
                                                                                    {{ __('Edit') }}
                                                                                </a>
                                                                                <button
                                                                                    onclick="showConfirmation({{ $client->id }})"
                                                                                    class="hover:text-primary-500 w-full text-left px-4 py-2 flex gap-3 items-center transition-all duration-300 hover:bg-black/10 hover:dark:bg-white/10">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                        fill="currentColor"
                                                                                        class="bi bi-trash size-4"
                                                                                        viewBox="0 0 16 16">
                                                                                        <path
                                                                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                                                        <path
                                                                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                                                                    </svg>
                                                                                    {{ __('Delete') }}
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="5" class="text-center py-8  ">
                                                            <img src="{{ asset('images/no-data-found.svg') }}"
                                                                alt="No data found" class="mx-auto max-w-xs">
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
            </div>
            @if ($clients->total() > $clients->count())
                <div class="mt-2">
                    <div class="d-flex justify-content-center">
                        {{ $clients->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
    <script>
        function showConfirmation(id) {
            Swal.fire({
                title: 'Want to delete this Client!',
                text: "{{ __('If you are ready?') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "{{ __('Yes') }}",
                cancelButtonText: "{{ __('Cancel') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/client/destroy/" + id;
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
