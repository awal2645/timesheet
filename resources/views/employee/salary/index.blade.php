@section('title')
    {{ 'TimeSheet Report' }}
@endsection
<x-app-layout>
    <div class="relative m-6">
        <div>
            <div class="my-8 card">
                <form action="{{ route('salary.show') }}" method="GET">
                    <div class="mb-3">
                        <label for="search" class="block mb-2 text-sm font-medium text-text-light dark:text-text-dark">
                            {{ __('Search') }}
                        </label>
                        <div class="flex gap-3 items-center form-field">
                            @if (auth()->user()->role == 'admin')
                            <select name="employer" class="form-select">
                                <option value="" class="dark:bg-slate-800 text-text-light dark:text-text-dark">{{ __('Select Employer') }}</option>
                                @foreach ($employer as $item)
                                <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="{{ $item->id }}" {{ request('employer') == $item->id ? 'selected' : '' }}>
                                    {{ $item->employer_name }}
                                </option>
                                    @endforeach
                                </select>
                            @endif
                            <select name="employee" class="form-select">
                                <option value="" class="dark:bg-slate-800 text-text-light dark:text-text-dark">{{ __('Select Employee') }}</option>
                                @foreach ($employees as $item)
                                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="{{ $item->id }}" {{ request('employee') == $item->id ? 'selected' : '' }}>
                                    {{ $item->employee_name }}
                                </option>
                                @endforeach
                            </select>
                            <button type="submit"
                                class="bg-primary-50 text-text-light dark:text-text-dark px-4 py-2 rounded-lg ml-2 hover:bg-primary-50 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                                {{ __('Search') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
{{-- 
            <div class="flex flex-wrap">
                <div class="w-full">
                    <div class="dashboard-right pl-0">
                        <div class="invoices-table">
                            <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark ml-1">
                                {{ __('Latest Report') }}</h2>
                            <div>
                                <div class="card">
                                    <table class="w-full table-auto">
                                        <thead class="table-header">
                                            <tr class="rounded-2xl text-left">
                                                <th class="min-w-[220px] px-4 py-4 font-medium">{{ __('Name') }}
                                                </th>
                                                <th class="min-w-[150px] px-4 py-4 font-medium">{{ __('Date') }}
                                                </th>
                                                <th class="min-w-[120px] px-4 py-4 font-medium">{{ __('Status') }}
                                                </th>
                                                <th class="px-4 py-4 font-medium">{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($timeReports->count() > 0)
                                                @foreach ($timeReports as $timeReport)
                                                    <tr
                                                        class="hover:bg-gray-100 hover:dark:bg-gray-800 transition duration-200">
                                                        <td
                                                            class="border-b border-[#eee] dark:border-slate-700 px-4 py-3">
                                                            <div class="text-sm font-semibold">
                                                                {{ $timeReport->user?->username }}</div>
                                                            <div class="text-xs font-normal text-gray-500">
                                                                {{ $timeReport->user?->email }}</div>
                                                        </td>
                                                        <td
                                                            class="border-b border-[#eee] dark:border-slate-700 px-4 py-3">
                                                            <div class="text-sm font-semibold">
                                                                {{ $timeReport->start_day . ' to ' . $timeReport->end_day }}
                                                            </div>
                                                        </td>
                                                        <td
                                                            class="border-b border-[#eee] dark:border-slate-700 px-4 py-3">
                                                            <div class="flex items-center">
                                                                <div class="h-2.5 w-2.5 rounded-full"
                                                                    style="background-color: {{ $timeReport->status === 'approve' ? 'green' : ($timeReport->status === 'pending' ? 'yellow' : 'red') }};">
                                                                </div>
                                                                <span
                                                                    class="ml-2">{{ ucfirst($timeReport->status) }}</span>
                                                            </div>
                                                        </td>
                                                        <td
                                                            class="border-b border-[#eee] dark:border-slate-700 px-4 py-3">
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
                                                                        <div class="flex flex-col items-start">
                                                                            <a href="#"
                                                                                class="hover:text-primary-500 w-full text-left px-4 py-2 flex gap-3 items-center transition-all duration-300 ">
                                                                                {{ __('View') }}
                                                                            </a>
                                                                            <a href="#"
                                                                                class="hover:text-primary-500 w-full text-left px-4 py-2 flex gap-3 items-center transition-all duration-300 ">
                                                                                {{ __('Feedback') }}
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="4" class="text-center py-8  ">
                                                        <x-svgs.no-data-found class="mx-auto md:size-[360px] size-[220px]" />
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

            @if ($timeReports->total() > $timeReports->count())
                <div class="mt-2">
                    <div class="d-flex justify-content-center">
                        {{ $timeReports->links() }}
                    </div>
                </div>
            @endif --}}
        </div>
    </div>
</x-app-layout>

<style>
    .dropdown:hover .dropdown-menu {
        display: block;
    }
</style>
