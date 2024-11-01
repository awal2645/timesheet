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
                                                        class="min-w-[220px] px-4 py-4 font-medium text-black dark:text-white xl:pl-11">
                                                        {{ __('Client Name') }}
                                                    </th>
                                                    <th
                                                        class="min-w-[150px] px-4 py-4 font-medium text-black dark:text-white">
                                                        {{ __('Contact Person Name') }}
                                                    </th>
                                                    <th
                                                        class="min-w-[120px] px-4 py-4 font-medium text-black dark:text-white">
                                                        {{ __('Date') }}
                                                    </th>
                                                    <th>

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
                                                                <div class="flex items-center space-x-2">
                                                                    <div class="h-2.5 w-2.5 rounded-full"
                                                                        id="statusIndicator"
                                                                        style="background-color: {{ $client->status === 1 ? 'green' : 'red' }};">
                                                                    </div>
                                                                    <form id="statusForm{{ $client->id }}"
                                                                        action="{{ route('client.updateStatus', $client->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        <select name="status" id="status"
                                                                            class="border-none text-sm bg-transparent text-gray-900 dark:text-white focus:outline-none"
                                                                            onchange="document.getElementById('statusForm{{ $client->id }}').submit()">
                                                                            <!-- Replace data-project-id with the actual project ID -->
                                                                            <option class="dark:bg-slate-800"
                                                                                value="1"
                                                                                {{ $client->status === 1 ? 'selected' : '' }}>
                                                                                {{ __('Active') }}
                                                                            <option class="dark:bg-slate-800"
                                                                                value="0"
                                                                                {{ $client->status === 0 ? 'selected' : '' }}>
                                                                                {{ __('Inactive') }}
                                                                        </select>
                                                                    </form>

                                                                </div>
                                                            </td>
                                                            <td class="border-b border-[#eee] dark:border-slate-700 px-4 py-2.5 dark:border-strokedark">
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
                                                                            class="focus:outline-none">
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
                                                                            class="absolute mt-2 right-0 w-32 bg-white dark:bg-slate-800 rounded-md shadow-lg z-10">
                                                                            <div class="flex flex-col items-start">
                                                                                <!-- Eye Icon Button -->
                                                                                <button
                                                                                    class="hover:text-primary w-full text-left px-4 py-2">
                                                                                    <svg class="fill-current inline mr-2"
                                                                                        width="18" height="18"
                                                                                        viewBox="0 0 18 18"
                                                                                        fill="none"
                                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                                        <path
                                                                                            d="M8.99981 14.8219C3.43106 14.8219 0.674805 9.50624 0.562305 9.28124C0.47793 9.11249 0.47793 8.88749 0.562305 8.71874C0.674805 8.49374 3.43106 3.20624 8.99981 3.20624C14.5686 3.20624 17.3248 8.49374 17.4373 8.71874C17.5217 8.88749 17.5217 9.11249 17.4373 9.28124C17.3248 9.50624 14.5686 14.8219 8.99981 14.8219ZM1.85605 8.99999C2.4748 10.0406 4.89356 13.5562 8.99981 13.5562C13.1061 13.5562 15.5248 10.0406 16.1436 8.99999C15.5248 7.95936 13.1061 4.44374 8.99981 4.44374C4.89356 4.44374 2.4748 7.95936 1.85605 8.99999Z" />
                                                                                        <path
                                                                                            d="M9 11.3906C7.67812 11.3906 6.60938 10.3219 6.60938 9C6.60938 7.67813 7.67812 6.60938 9 6.60938C10.3219 6.60938 11.3906 7.67813 11.3906 9C11.3906 10.3219 10.3219 11.3906 9 11.3906ZM9 7.875C8.38125 7.875 7.875 8.38125 7.875 9C7.875 9.61875 8.38125 10.125 9 10.125C9.61875 10.125 10.125 9.61875 10.125 9C10.125 8.38125 9.61875 7.875 9 7.875Z" />
                                                                                    </svg>
                                                                                    View
                                                                                </button>
                                                                                <!-- Edit Icon Button -->
                                                                                <button
                                                                                    class="hover:text-primary w-full text-left px-4 py-2">
                                                                                    <svg class="fill-current inline mr-2"
                                                                                        width="18" height="18"
                                                                                        viewBox="0 0 18 18"
                                                                                        fill="none"
                                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                                        <path
                                                                                            d="M13.7535 2.47502H11.5879V1.9969C11.5879 1.15315 10.9129 0.478149 10.0691 0.478149H7.90352C7.05977 0.478149 6.38477 1.15315 6.38477 1.9969V2.47502H4.21914C3.40352 2.47502 2.72852 3.15002 2.72852 3.96565V4.8094C2.72852 5.42815 3.09414 5.9344 3.62852 6.1594L4.07852 15.4688C4.13477 16.6219 5.09102 17.5219 6.24414 17.5219H11.7004C12.8535 17.5219 13.8098 16.6219 13.866 15.4688L14.3441 6.13127C14.8785 5.90627 15.2441 5.3719 15.2441 4.78127V3.93752C15.2441 3.15002 14.5691 2.47502 13.7535 2.47502Z" />
                                                                                        <path
                                                                                            d="M9.00039 9.11255C8.66289 9.11255 8.35352 9.3938 8.35352 9.75942V13.3313C8.35352 13.6688 8.63477 13.9782 9.00039 13.9782C9.33789 13.9782 9.64727 13.6969 9.64727 13.3313V9.75942C9.64727 9.3938 9.33789 9.11255 9.00039 9.11255Z" />
                                                                                    </svg>
                                                                                    Edit
                                                                                </button>
                                                                                <!-- Delete Icon Button -->
                                                                                <button
                                                                                    class="hover:text-primary w-full text-left px-4 py-2">
                                                                                    <svg class="fill-current inline mr-2"
                                                                                        width="18" height="18"
                                                                                        viewBox="0 0 18 18"
                                                                                        fill="none"
                                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                                        <path
                                                                                            d="M16.8754 11.6719C16.5379 11.6719 16.2285 11.9531 16.2285 12.3187V14.8219C16.2285 15.075 16.0316 15.2719 15.7785 15.2719H2.22227C1.96914 15.2719 1.77227 15.075 1.77227 14.8219V12.3187C1.77227 11.9812 1.49102 11.6719 1.12539 11.6719C0.759766 11.6719 0.478516 11.9531 0.478516 12.3187V14.8219C0.478516 15.7781 1.23789 16.5375 2.19414 16.5375H15.7785C16.7348 16.5375 17.4941 15.7781 17.4941 14.8219V12.3187C17.5223 11.9531 17.2129 11.6719 16.8754 11.6719Z" />
                                                                                        <path
                                                                                            d="M8.55074 12.3469C8.66324 12.4594 8.83199 12.5156 9.00074 12.5156C9.16949 12.5156 9.31012 12.4594 9.45074 12.3469L13.4726 8.43752C13.7257 8.1844 13.7257 7.79065 13.5007 7.53752C13.2476 7.2844 12.8539 7.2844 12.6007 7.5094L9.00074 11.1094L5.40074 7.5094C5.14762 7.2844 4.75387 7.2844 4.50074 7.53752C4.27574 7.79065 4.27574 8.1844 4.52887 8.43752L8.55074 12.3469Z" />
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
