@section('title')
    {{ 'List Leave Applications' }}
@endsection

<x-app-layout>
    <div class="relative m-6">
        <div class="card flex flex-col gap-3 md:flex-row justify-between items-start md:items-center">
            <form action="{{ route('leave.index') }}" method="GET" class="w-full">
                <div class="mb-3">
                    <label for="search" class="block mb-2 text-sm font-medium text-text-light dark:text-text-dark">
                        {{ __('Search') }}
                    </label>
                    <div class="flex flex-wrap">
                        <input type="text" id="search" name="search" value="{{ request('search') }}"
                            class="border border-gray-300 text-text-light dark:text-text-dark text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-card-dark bg-card-light dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="{{ __('Search') }}" />
                        <button
                            class="bg-primary-50 text-text-light dark:text-text-dark px-4 py-2 rounded-lg ml-2 hover:bg-primary-50 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                            {{ __('Search') }}
                        </button>
                    </div>
                </div>
            </form>
            <a href="{{ route('leave.create') }}"
                class="bg-primary-50 text-text-light dark:text-text-dark px-5 py-2 rounded-lg hover:bg-primary-50 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                <i class="fa-solid fa-plus"></i> {{ __('Create Leave Application') }}
            </a>
        </div>

        <div class="mt-6 flex flex-wrap">
            <div class="w-full">
                <div class="dashboard-right pl-0">
                    <div class="invoices-table">
                        <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark ml-1">
                            {{ __('Latest Leave Applications') }}</h2>
                        <div>
                            <div class="card overflow-x-auto">
                                <table class="w-full table-auto">
                                    <thead class="table-header">
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
                                                <th class="px-4 py-4 font-medium"> {{ __('Action') }} </th>
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
                                                        <div class="flex items-center space-x-3">
                                                            <!-- Status Indicator -->
                                                            {{-- <div class="h-3 w-3 rounded-full" :class="{
                                                                    'bg-green-500': '{{ $application->status }}' === 'approved',
                                                                    'bg-red-500': '{{ $application->status }}' === 'denied',
                                                                    'bg-yellow-500': '{{ $application->status }}' === 'pending'
                                                                }">
                                                    </div> --}}

                                                            <!-- Status Badge -->
                                                            <span
                                                                class="px-2 flex items-center justify-center w-[100px] py-1 text-xs font-semibold rounded"
                                                                :class="{
                                                                    'bg-green-100 text-green-600': '{{ $application->status }}'
                                                                    === 'approved',
                                                                    'bg-red-100 text-red-600': '{{ $application->status }}'
                                                                    === 'denied',
                                                                    'bg-yellow-100 text-yellow-600': '{{ $application->status }}'
                                                                    === 'pending'
                                                                }">
                                                                {{ ucfirst($application->status) }}
                                                            </span>
                                                        </div>
                                                    </td>

                                                    @if (auth()->user()->role === 'superadmin' || auth()->user()->role === 'employer')
                                                        <td
                                                            class="border-b border-[#eee] dark:border-slate-700 px-4 py-3">
                                                            <div class="flex space-x-4">
                                                                @if ($application->status === 'pending')
                                                                    <!-- Approve Button -->
                                                                    <form
                                                                        action="{{ route('leave.approve', $application->id) }}"
                                                                        method="POST" style="display:inline;">
                                                                        @csrf
                                                                        <button type="submit"
                                                                            class="px-4 py-2 text-sm font-semibold text-text-light dark:text-text-dark bg-green-500 rounded-lg shadow-md hover:bg-green-600 focus:outline-none focus:ring focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                                            {{ __('Approve') }}
                                                                        </button>
                                                                    </form>

                                                                    <!-- Deny Button -->
                                                                    <form
                                                                        action="{{ route('leave.deny', $application->id) }}"
                                                                        method="POST" style="display:inline;">
                                                                        @csrf
                                                                        <button type="submit"
                                                                            class="px-4 py-2 text-sm font-semibold text-text-light dark:text-text-dark bg-red-500 rounded-lg shadow-md hover:bg-red-600 focus:outline-none focus:ring focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                                            {{ __('Deny') }}
                                                                        </button>
                                                                    </form>
                                                                @else
                                                                    <!-- Action Taken Message -->
                                                                    <span
                                                                        class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-200 rounded-lg dark:text-gray-400 dark:bg-gray-700">
                                                                        {{ __('Action Taken') }}
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    @endif

                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" class="text-center py-8  ">
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
        @if ($applications->total() > $applications->count())
            <div class="mt-2">
                <div class="d-flex justify-content-center">
                    {{ $applications->links() }}
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
