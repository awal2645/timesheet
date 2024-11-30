@section('title')
    {{ 'List Leave Applications' }}
@endsection

<x-app-layout>
    <div class="relative m-6">
        <div class="card flex justify-between items-center">
            <form action="{{ route('leave.index') }}" method="GET" class="w-full">
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
            <a href="{{ route('leave.create') }}"
                class="bg-primary-300 text-text-light dark:text-text-dark px-5 py-2 rounded-lg hover:bg-primary-600 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                <i class="fa-solid fa-plus"></i> {{ __('Create Leave Application') }}
            </a>
        </div>

        <div class="mt-12 flex flex-wrap">
            <div class="w-full">
                <div class="dashboard-right pl-0">
                    <div class="invoices-table">
                        <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark">
                            {{ __('Latest Leave Applications') }}</h2>
                        <div>
                            <div class="card">
                                <table class="w-full table-auto">
                                    <thead class="bg-primary-300 text-text-light dark:text-text-dark">
                                        <tr class="rounded-2xl text-left">
                                            <th class="min-w-[220px] px-4 py-4 font-medium">
                                                {{ __('Employee Name') }}
                                            </th>
                                            <th class="min-w-[150px] px-4 py-4 font-medium">
                                                {{ __('Start Date') }}
                                            </th>
                                            <th class="min-w-[150px] px-4 py-4 font-medium">
                                                {{ __('End Date') }}
                                            </th>
                                            <th class="min-w-[150px] px-4 py-4 font-medium">
                                                {{ __('Reason') }}
                                            </th>
                                            <th class="min-w-[120px] px-4 py-4 font-medium">
                                                {{ __('Status') }}
                                            </th>
                                            @if (auth()->user()->role === 'superadmin' || auth()->user()->role === 'employer')
                                                <th class="px-4 py-4 font-medium"></th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($applications->count() > 0)
                                            @foreach ($applications as $application)
                                                <tr
                                                    class="hover:bg-gray-100 hover:dark:bg-gray-800 transition duration-200">
                                                    <td class="border-b border-[#eee] dark:border-slate-700 px-4 py-3">
                                                        <div class="text-sm font-semibold">
                                                            {{ $application->employee->employee_name ?? '' }}
                                                        </div>
                                                    </td>
                                                    <td class="border-b border-[#eee] dark:border-slate-700 px-4 py-3">
                                                        {{ $application->start_date }}
                                                    </td>
                                                    <td class="border-b border-[#eee] dark:border-slate-700 px-4 py-3">
                                                        {{ $application->end_date }}
                                                    </td>
                                                    <td class="border-b border-[#eee] dark:border-slate-700 px-4 py-3">
                                                        {{ $application->reason }}
                                                    </td>
                                                    <td class="border-b border-[#eee] dark:border-slate-700 px-4 py-3">
                                                        <div class="flex items-center space-x-2">
                                                            <div class="h-2.5 w-2.5 rounded-full"
                                                                style="background-color: {{ $application->status === 'approved' ? 'green' : ($application->status === 'denied' ? 'red' : 'yellow') }};">
                                                            </div>
                                                            {{ ucfirst($application->status) }}
                                                        </div>
                                                    </td>
                                                    @if (auth()->user()->role === 'superadmin' || auth()->user()->role === 'employer')
                                                        <td
                                                            class="border-b border-[#eee] dark:border-slate-700 px-4 py-3">
                                                            <div class="flex space-x-2">
                                                                @if ($application->status === 'pending')
                                                                    <form
                                                                        action="{{ route('leave.approve', $application->id) }}"
                                                                        method="POST" style="display:inline;">
                                                                        @csrf
                                                                        <button type="submit"
                                                                            class="font-medium text-green-600 dark:text-green-500 hover:underline">{{ __('Approve') }}</button>
                                                                    </form>
                                                                    <form
                                                                        action="{{ route('leave.deny', $application->id) }}"
                                                                        method="POST" style="display:inline;">
                                                                        @csrf
                                                                        <button type="submit"
                                                                            class="font-medium text-red-600 dark:text-red-500 hover:underline">{{ __('Deny') }}</button>
                                                                    </form>
                                                                @else
                                                                    <span
                                                                        class="font-medium text-gray-600 dark:text-gray-500">{{ __('Action Taken') }}</span>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" class="text-center py-8  ">
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
        @if ($applications->total() > $applications->count())
            <div class="mt-2">
                <div class="d-flex justify-content-center">
                    {{ $applications->links() }}
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
