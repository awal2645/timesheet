@section('title')
    {{ 'List Client' }}
@endsection
<x-app-layout>
    <div class="relative overflow-x-auto">
        <div class="container mx-8">
            <div
                class="my-8 px-5 py-3 rounded-2xl dark:bg-black/10 bg-white/10 backdrop-blur border border-black/10 dark:border-white/10 flex flex-col md:flex-row justify-between items-center md:space-y-0 ">
                <form action="{{ route('client.index') }}" method="GET">
                    <div class="mb-5">
                        <label for="search" class="block mb-2 text-sm font-medium">{{ __('Search') }}</label>
                        <div class="flex">
                            <input type="text" id="search" name="search" value="{{ request('search') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                                placeholder="{{ __('Search') }}" />
                            <button
                                class="bg-purple-500 text-white px-4 py-2 rounded-lg ml-2">{{ __('Search') }}</button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('client.create') }}" class="bg-purple-500 text-white px-4 py-2 rounded-lg"><i
                        class="fa-solid fa-plus"></i> {{ __('Create Client') }}</a>
            </div>
            <!-- Start heading  here -->
            <div class="flex flex-wrap">
                <div class="w-full ">
                    <div class="dashboard-right pl-0 ">
                        <div class="invoices-table ">
                            <h2 class="text-xl font-semibold mb-4">{{ __('Client List') }}</h2>
                            <div class="overflow-x-auto">
                                <div
                                    class="rounded-lg border border-black/10 dark:border-white/10 shadow-lg bg-white/10 backdrop-blur dark:bg-black/10  px-5 pb-2.5 pt-6 shadow-default sm:px-7.5 xl:pb-1">
                                    <div class="max-w-full overflow-x-auto">
                                        <table class="w-full table-auto">
                                            <thead>
                                                <tr class="bg-gray-200  rounded-2xl text-left dark:bg-gray-700">
                                                    <th
                                                        class="min-w-[220px] px-4 py-4 font-medium text-black dark:text-white xl:pl-11 ">
                                                        <div class="flex gap-2 items-center text-base">
                                                            <span>{{ __('Client Name') }}</span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                                class="bi bi-arrow-down size-3" viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd"
                                                                    d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1" />
                                                            </svg>
                                                        </div>
                                                    </th>
                                                    <th
                                                        class="min-w-[150px] px-4 py-4 font-medium text-black dark:text-white">
                                                        <div class="flex gap-2 items-center text-base">
                                                            <span>
                                                                {{ __('Contact Person Name') }}
                                                            </span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                                class="bi bi-arrow-down size-3" viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd"
                                                                    d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1" />
                                                            </svg>
                                                        </div>
                                                    </th>
                                                    <th
                                                        class="min-w-[120px] px-4 py-4 font-medium text-black dark:text-white">
                                                        <div class="flex gap-2 items-center text-base">
                                                            <span>
                                                                {{ __('Status') }}
                                                            </span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                                class="bi bi-arrow-down size-3" viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd"
                                                                    d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1" />
                                                            </svg>
                                                        </div>
                                                    </th>
                                                    <th class="px-4 py-4 font-medium text-black dark:text-white">
                                                        <div class="flex gap-2 items-center text-base">
                                                            <span>
                                                                {{ __('Change Status') }}
                                                            </span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                                class="bi bi-arrow-down size-3" viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd"
                                                                    d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1" />
                                                            </svg>
                                                        </div>
                                                    </th>
                                                    <th class="px-4 py-4 font-medium text-black dark:text-white">
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($clients->count() > 0)
                                                    @foreach ($clients as $key => $client)
                                                        <tr class="hover:bg-gray-100 hover:dark:bg-gray-800">
                                                            <td
                                                                class="border-b border-[#eee] dark:border-slate-700  px-4 py-2.5 pl-9 dark:border-strokedark xl:pl-11">
                                                                <div class="text-sm font-semibold">
                                                                    {{ $client->client_name }}
                                                                </div>
                                                                <div class="text-xs font-normal text-gray-500">
                                                                    {{ $client->client_email }}
                                                                </div>
                                                            </td>
                                                            <td
                                                                class="text-sm border-b border-[#eee] dark:border-slate-700 px-4 py-2.5 dark:border-strokedark">
                                                                {{ $client->contact_name }}
                                                            </td>
                                                            <td
                                                                class="text-sm border-b border-[#eee] dark:border-slate-700 px-4 py-2.5 dark:border-strokedark">
                                                                <div
                                                                    class="flex items-center space-x-2 {{ $client->status ? 'text-green-500' : 'text-rose-500' }}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        width="16" height="16"
                                                                        fill="currentColor" class="bi bi-check2-circle"
                                                                        viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0" />
                                                                        <path
                                                                            d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z" />
                                                                    </svg>
                                                                    <span>{{ __('Active') }}</span>
                                                                </div>
                                                            </td>
                                                            <td
                                                                class="border-b border-[#eee] dark:border-slate-700 px-4 py-2.5 dark:border-strokedark">
                                                                <label class="inline-flex items-center cursor-pointer">
                                                                    <input type="checkbox" value=""
                                                                        class="sr-only peer">
                                                                    <div
                                                                        class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-purple-300 dark:peer-focus:ring-purple-300 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-500">
                                                                    </div>
                                                                </label>

                                                            </td>
                                                            <td
                                                                class=" border-b border-[#eee] dark:border-slate-700 px-4 py-2.5 dark:border-strokedark">
                                                                <div class="flex justify-end">
                                                                    <span x-data="{ openDropdown: false }" class="relative">
                                                                        <!-- Three-dot icon -->
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

                                                                        <!-- Dropdown actions -->
                                                                        <div x-show="openDropdown"
                                                                            @click.away="openDropdown = false"
                                                                            class="absolute mt-2 right-0 w-32 bg-white dark:bg-black/80 py-2 rounded-md shadow-lg z-10">
                                                                            <div class="flex flex-col items-start">
                                                                                <!-- Eye Icon Button -->
                                                                                <button
                                                                                    class="hover:text-purple-500 w-full text-left px-4 py-2 flex gap-3 items-center transition-all duration-300 hover:bg-black/10 hover:dark:bg-white/10">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                        fill="currentColor"
                                                                                        class="bi bi-eye size-4"
                                                                                        viewBox="0 0 16 16">
                                                                                        <path
                                                                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                                                                        <path
                                                                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                                                                    </svg>
                                                                                    View
                                                                                </button>
                                                                                <!-- Edit Icon Button -->
                                                                                <button
                                                                                    class="hover:text-purple-500 w-full text-left px-4 py-2 flex gap-3 items-center transition-all duration-300 hover:bg-black/10 hover:dark:bg-white/10">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                        fill="currentColor"
                                                                                        class="bi bi-pencil-square size-4"
                                                                                        viewBox="0 0 16 16">
                                                                                        <path
                                                                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                                                        <path fill-rule="evenodd"
                                                                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                                                    </svg>
                                                                                    Edit
                                                                                </button>
                                                                                <!-- Delete Icon Button -->
                                                                                <button
                                                                                    class="hover:text-purple-500 w-full text-left px-4 py-2 flex gap-3 items-center transition-all duration-300 hover:bg-black/10 hover:dark:bg-white/10">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                        fill="currentColor"
                                                                                        class="bi bi-trash size-4"
                                                                                        viewBox="0 0 16 16">
                                                                                        <path
                                                                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                                                        <path
                                                                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                                                                    </svg>
                                                                                    Delete
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
                                                        <td colspan="5"
                                                            class="text-center py-8 border border-gray-300 dark:border-gray-700">
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
                <div class=" mt-2">
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
</x-app-layout>
<style>
    .dropdown:hover .dropdown-menu {
        display: block;
    }
</style>
