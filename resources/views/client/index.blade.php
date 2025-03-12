@section('title')
    {{ 'List Client' }}
@endsection
<x-app-layout>
    <div class="relative m-6">
        <div>
            <div class="my-8 card flex flex-col md:flex-row gap-4 md:justify-between items-start md:items-center">
                <form action="{{ route('client.index') }}" method="GET" class="w-full">
                    <div class="mb-3">
                        <label for="search" class="block mb-2 text-sm font-medium text-text-light dark:text-text-dark">
                            {{ __('Search') }}
                        </label>
                        <div class="flex flex-wrap">
                            <input type="text" id="search" name="search" value="{{ request('search') }}"
                                class="border border-gray-300 text-text-light dark:text-text-dark text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-card-dark bg-card-light dark:border-gray-600 dark:placeholder-gray-400 dark:text-text-dark dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="{{ __('Search') }}" />
                            <button
                                class="bg-primary-50 text-text-light dark:text-text-dark px-4 py-2 rounded-lg ms-2 hover:bg-primary-50 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                                {{ __('Search') }}
                            </button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('client.create') }}"
                    class="bg-primary-50 text-text-light dark:text-text-dark px-5 py-2 rounded-lg hover:bg-primary-50 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                    <i class="fa-solid fa-plus"></i> {{ __('Create Client') }}
                </a>
            </div>

            <!-- Start heading here -->
            <div class="flex flex-wrap">
                <div class="w-full ">
                    <div class="dashboard-right ps-0 ">
                        <div class="invoices-table ">
                            <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark ms-1">
                                {{ __('Client List') }}
                            </h2>
                            <div>
                                <div class="card overflow-x-auto !p-0">
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
                                                    <th class="px-4 py-4 font-medium">{{ __('Action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($clients->count() > 0)
                                                    @foreach ($clients as $key => $client)
                                                        <tr
                                                            class="hover:bg-gray-100 hover:dark:bg-gray-800 transition duration-200">
                                                            <td
                                                                class="border-b border-[#eee] dark:border-slate-700 px-4 py-3 dark:border-stroke">
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
                                                                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary-300 dark:peer-focus:ring-primary-300 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary-50">
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
                                                                class="border-b border-[#eee] dark:border-slate-700 px-4 py-3 dark:border-stroke">
                                                                <div class="flex items-center gap-3">
                                                                    <a href="{{ route('client.edit', $client->id) }}"
                                                                        class="text-blue-500 hover:underline">
                                                                        <x-svgs.edit class="size-[20px]" />
                                                                    </a>
                                                                    <button
                                                                        onclick="showConfirmation({{ $client->id }})"
                                                                        class="text-red-500 hover:underline">
                                                                        <x-svgs.delete class="size-[20px]" />
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="5" class="text-center py-8  ">
                                                            <x-svgs.no-data-found
                                                                class="mx-auto md:size-[360px] size-[220px]" />
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
