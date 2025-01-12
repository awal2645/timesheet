@section('title', 'Weekly Holidays')

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
                                class="border border-gray-300 text-text-light  text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-card-dark bg-card-light dark:border-gray-600 dark:placeholder-gray-400 dark:text-text-dark dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="{{ __('Search') }}" />
                            <button
                                class="bg-primary-50 text-text-light dark:text-text-dark px-4 py-2 rounded-lg ms-2 hover:bg-primary-50 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                                {{ __('Search') }}
                            </button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('weekly_holidays.create') }}"
                    class="bg-primary-50 text-text-light dark:text-text-dark px-5 py-2 rounded-lg hover:bg-primary-50 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                    <i class="fa-solid fa-plus"></i> {{ __('Add Weekly Holiday') }}
                </a>
            </div>

            <div class="mt-6 flex flex-wrap">
                <div class="w-full">
                    <div class="dashboard-right ps-0">
                        <div class="invoices-table">
                            <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark ms-1">
                                {{ __('Weekly Holidays List') }}</h2>
                            <div>
                                <div class="card overflow-x-auto">
                                    <table class="w-full table-auto">
                                        <thead class="table-header">
                                            <tr class="rounded-2xl text-left">
                                                <th class="min-w-[220px] px-4 py-4 font-medium">
                                                    {{ __('Days of the Week') }}
                                                </th>
                                                <th class="min-w-[220px] px-4 py-4 font-medium text-end">
                                                    {{ __('Actions') }}
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if ($holidays->count() > 0)
                                                @foreach ($holidays as $holiday)
                                                    <tr
                                                        class="hover:bg-gray-100 hover:dark:bg-gray-800 transition duration-200">
                                                        <td
                                                            class="border-b border-[#eee] dark:border-slate-700 px-4 py-3">
                                                            <div class="px-4 py-3 ">
                                                                <div class="flex flex-col">
                                                                    @php
                                                                        $daysOfWeek = json_decode(
                                                                            $holiday->days_of_week,
                                                                        );
                                                                        $daysOfWeekFormatted = is_array($daysOfWeek)
                                                                            ? collect($daysOfWeek)
                                                                                ->map(fn($day) => ucfirst($day))
                                                                                ->join(', ')
                                                                            : ucfirst($daysOfWeek);
                                                                    @endphp

                                                                    <div class="text-sm">
                                                                        <span
                                                                            class="font-medium text-slate-700 dark:text-slate-300">
                                                                            {{ $daysOfWeekFormatted }}
                                                                        </span>
                                                                    </div>

                                                                    {{-- Visual indicator for multiple days --}}
                                                                    @if (is_array($daysOfWeek) && count($daysOfWeek) > 1)
                                                                        <div class="mt-1">
                                                                            <span
                                                                                class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                                                {{ count($daysOfWeek) }} days
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td
                                                            class="border-b border-[#eee] dark:border-slate-700 px-4 py-3">
                                                            <div class="flex space-x-4 justify-end">
                                                                <a href="{{ route('weekly_holidays.edit', $holiday->id) }}"
                                                                    class="text-primary-50 hover:underline"><x-svgs.edit /></a>
                                                                <a href="#"
                                                                    class="text-red-600 hover:underline" onclick="showConfirmation({{ $holiday->id }})"><x-svgs.delete /></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="2" class="text-center py-8  ">
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
                    window.location.href = "/weekly_holiday/destroy/" + id;
                }
            });
        }
    </script>
</x-app-layout>
