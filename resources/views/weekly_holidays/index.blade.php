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
                                class="bg-primary-50 text-text-light dark:text-text-dark px-4 py-2 rounded-lg ml-2 hover:bg-primary-50 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
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

            <div class="mt-12 flex flex-wrap">
                <div class="w-full">
                    <div class="dashboard-right pl-0">
                        <div class="invoices-table">
                            <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark ml-1">
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
                                                            <div class="text-sm font-semibold">
                                                                @php
                                                                    $daysOfWeek = json_decode($holiday->days_of_week);
                                                                @endphp
                                                                @php
                                                                    $daysOfWeekFormatted = is_array($daysOfWeek)
                                                                        ? implode(
                                                                            ', ',
                                                                            array_map(function ($day) {
                                                                                return ucfirst($day);
                                                                            }, $daysOfWeek),
                                                                        )
                                                                        : ucfirst($daysOfWeek);

                                                                    $daysOfWeekFormatted = str_replace(
                                                                        [
                                                                            'Saturday',
                                                                            'Sunday',
                                                                            'Monday',
                                                                            'Tuesday',
                                                                            'Wednesday',
                                                                            'Thursday',
                                                                            'Friday',
                                                                        ],
                                                                        [
                                                                            '<span class="text-red-50 bg-red-500 rounded  p-2">Saturday</span>',
                                                                            '<span class="text-blue-50 bg-blue-500 rounded p-2">Sunday</span>',
                                                                            '<span class="text-green-50 bg-green-500 rounded p-2">Monday</span>',
                                                                            '<span class="text-yellow-50 bg-yellow-500 rounded p-2">Tuesday</span>',
                                                                            '<span class="text-purple-50 bg-purple-500 rounded p-2">Wednesday</span>',
                                                                            '<span class="text-pink-50 bg-pink-500 rounded p-2">Thursday</span>',
                                                                            '<span class="text-orange-50 bg-orange-500 rounded p-2">Friday</span>',
                                                                        ],
                                                                        $daysOfWeekFormatted,
                                                                    );
                                                                @endphp

                                                                {!! $daysOfWeekFormatted !!}

                                                            </div>
                                                        </td>
                                                        <td
                                                            class="border-b border-[#eee] dark:border-slate-700 px-4 py-3">
                                                            <div class="flex space-x-4 justify-end">
                                                                <a href="{{ route('weekly_holidays.edit', $holiday->id) }}"
                                                                    class="text-primary-50 hover:underline"><x-svgs.edit /></a>
                                                                <form
                                                                    action="{{ route('weekly_holidays.destroy', $holiday->id) }}"
                                                                    method="POST" style="display:inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="text-red-600 hover:underline"><x-svgs.delete /></button>
                                                                </form>
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
                    window.location.href = "/weekly_holidays/destroy/" + id;
                }
            });
        }
    </script>
</x-app-layout>
