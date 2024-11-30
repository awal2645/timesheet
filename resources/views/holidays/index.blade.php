@section('title')
    {{ 'List Holidays' }}
@endsection

<x-app-layout>
    <div class="relative m-6">
        <div class="">
            <div class="card flex justify-between items-center">
                <form action="{{ route('holidays.index') }}" method="GET" class="w-full">
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
                <a href="{{ route('holidays.create') }}"
                    class="bg-primary-300 text-text-light dark:text-text-dark px-5 py-2 rounded-lg hover:bg-primary-600 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                    <i class="fa-solid fa-plus"></i> {{ __('Create Holiday') }}
                </a>
            </div>

            <div class="mt-12 flex flex-wrap">
                <div class="w-full">
                    <div class="dashboard-right pl-0">
                        <div class="invoices-table">
                            <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark">
                                {{ __('Holiday List') }}</h2>
                            <div>
                                <div class="card">
                                    <table class="w-full table-auto">
                                        <thead class="bg-primary-300 text-text-light dark:text-text-dark">
                                            <tr class="rounded-2xl text-left">
                                                <th class="min-w-[220px] px-4 py-4 font-medium">
                                                    {{ __('Holiday Name') }}</th>
                                                <th class="min-w-[150px] px-4 py-4 font-medium">
                                                    {{ __('Holiday Date') }}</th>
                                                <th class="px-4 py-4 font-medium"></th>
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
                                                            <div class="flex justify-end">
                                                                <a href="{{ route('holidays.edit', $holiday->id) }}"
                                                                    class="text-primary-500 hover:text-primary-300">{{ __('Edit') }}</a>
                                                                <form
                                                                    action="{{ route('holidays.destroy', $holiday->id) }}"
                                                                    method="POST"
                                                                    onsubmit="return confirm('Are you sure you want to delete this holiday?');"
                                                                    class="ml-2">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="text-red-500 hover:text-red-700">{{ __('Delete') }}</button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="3" class="text-center py-8  ">
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
            @if ($holidays->total() > $holidays->count())
                <div class="mt-2">
                    <div class="d-flex justify-content-center">
                        {{ $holidays->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
