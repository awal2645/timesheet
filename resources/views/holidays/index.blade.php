@section('title')
    {{ 'List Holidays' }}
@endsection

<x-app-layout>
    <div class="relative m-6">
        <div class="">
            <div class="card flex flex-col md:flex-row gap-3 justify-between items-start md:items-center">
                <form action="{{ route('holidays.index') }}" method="GET" class="w-full">
                    <div class="mb-3">
                        <label for="search" class="block mb-2 text-sm font-medium text-text-light dark:text-text-dark">
                            {{ __('Search') }}
                        </label>
                        <div class="flex flex-wrap">
                            <input type="text" id="search" name="search" value="{{ request('search') }}"
                                class="border border-gray-300 text-text-light dark:text-text-dark text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-card-dark bg-card-light dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="{{ __('Search') }}" />
                            <button
                                class="bg-primary-50 text-text-light dark:text-text-dark px-4 py-2 rounded-md ms-2 hover:bg-primary-50 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                                {{ __('Search') }}
                            </button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('holidays.create') }}"
                    class="bg-primary-50 text-text-light dark:text-text-dark px-5 py-2 rounded-md hover:bg-primary-50 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                    <i class="fa-solid fa-plus"></i> {{ __('Create Holiday') }}
                </a>
            </div>

            <div class="mt-6 flex flex-wrap">
                <div class="w-full">
                    <div class="dashboard-right ps-0">
                            <div class="card overflow-x-auto !p-0 !rounded-md">                           <h2 class="text-2xl font-bold p-4 text-text-light dark:text-text-dark">
                                {{ __('Holiday List') }}</h2>
                                    <table class="w-full table-auto">
                                        <thead class="table-header">
                                            <tr class="rounded-none text-left">
                                                <th class="min-w-[220px] px-4 py-4 font-medium">
                                                    {{ __('Holiday Name') }}</th>
                                                <th class="min-w-[150px] px-4 py-4 font-medium">
                                                    {{ __('Holiday Date') }}</th>
                                                <th class="px-4 py-4 font-medium">{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($holidays->count() > 0)
                                                @foreach ($holidays as $holiday)
                                                    <tr
                                                        class="hover:bg-gray-100 hover:dark:bg-gray-800 transition duration-200">
                                                        <td
                                                            class="border-b border-[#eee] dark:border-slate-700 px-4 py-2.5">
                                                            {{ $holiday->name }}</td>
                                                        <td
                                                            class="border-b border-[#eee] dark:border-slate-700 px-4 py-2.5">
                                                            {{ $holiday->date }}</td>
                                                        <td
                                                            class="border-b border-[#eee] dark:border-slate-700 px-4 py-2.5">
                                                            <div class="flex ">
                                                                <a href="{{ route('holidays.edit', $holiday->id) }}"
                                                                    class="text-primary-50 hover:text-primary-300"><x-svgs.edit /></a>
                                                                    <a href="#"
                                                                        class="text-red-500 hover:text-red-700" onclick="showConfirmation({{ $holiday->id }})"><x-svgs.delete /></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="3" class="text-center py-8 ">
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
            @if ($holidays->total() > $holidays->count())
                <div class="mt-2">
                    <div class="d-flex justify-content-center">
                        {{ $holidays->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
    <script>
        function showConfirmation(id) {
            Swal.fire({
                title: 'Want to delete this Holiday!',
                text: "{{ __('If you are ready?') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "{{ __('Yes') }}",
                cancelButtonText: "{{ __('Cancel') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/holiday/destroy/" + id;
                }
            });
        }
    </script>
</x-app-layout>
