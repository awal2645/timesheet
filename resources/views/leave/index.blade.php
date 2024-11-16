@section('title')
    {{ 'List Leave Applications' }}
@endsection

<x-app-layout>
    <div class="relative overflow-x-auto">
        <div class="container mx-auto px-5">
            <div class="mt-10 mb-5 flex flex-col md:flex-row justify-between items-center md:space-y-0">
                <form action="{{ route('leave.index') }}" method="GET">
                    <div class="mb-5">
                        <label for="search" class="block mb-2 text-sm font-medium">{{ __('Search') }}</label>
                        <div class="flex">
                            <input type="text" id="search" name="search" value="{{ request('search') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="{{ __('Search') }}" />
                            <button
                                class="bg-purple-500 text-white px-4 py-2 rounded-lg ml-2">{{ __('Search') }}</button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('leave.create') }}" class="bg-purple-500 text-white px-4 py-2 rounded-lg"><i
                        class="fa-solid fa-plus"></i> {{ __('Create Leave Application') }}</a>
            </div>
            <!-- Start heading here -->
            <div class="flex flex-wrap">
                <div class="w-full">
                    <div class="dashboard-right pl-0">
                        <div class="invoices-table">
                            <h2 class="text-xl font-semibold mb-4">{{ __('Latest Leave Applications') }}</h2>
                            <div class="overflow-x-auto pb-1">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 border border-gray-300 dark:border-gray-700">
                                                {{ __('Employee Name') }}
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 border border-gray-300 dark:border-gray-700">
                                                {{ __('Start Date') }}
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 border border-gray-300 dark:border-gray-700">
                                                {{ __('End Date') }}
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 border border-gray-300 dark:border-gray-700">
                                                {{ __('Reason') }}
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 border border-gray-300 dark:border-gray-700">
                                                {{ __('Status') }}
                                            </th>
                                            @if (auth()->user()->role === 'superadmin' || auth()->user()->role === 'employer')
                                            <th scope="col"
                                                class="px-6 py-3 border border-gray-300 dark:border-gray-700">
                                                {{ __('Action') }}
                                            </th>
                                            @endif
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if ($applications->count() > 0)
                                            @foreach ($applications as $application)
                                                <tr
                                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                                    <th scope="row"
                                                        class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                                        <div class="">
                                                            <div class="text-base font-semibold">
                                                                {{ $application->employee->employee_name ?? '' }}</div>
                                                        </div>
                                                    </th>
                                                    <td class="px-6 py-4 border border-gray-300 dark:border-gray-700">
                                                        {{ $application->start_date }}
                                                    </td>
                                                    <td class="px-6 py-4 border border-gray-300 dark:border-gray-700">
                                                        {{ $application->end_date }}
                                                    </td>
                                                    <td class="px-6 py-4 border border-gray-300 dark:border-gray-700">
                                                        {{ $application->reason }}
                                                    </td>
                                                    <td class="px-6 py-4 border border-gray-300 dark:border-gray-700">
                                                        <div class="flex items-center space-x-2">
                                                            <div class="h-2.5 w-2.5 rounded-full" id="statusIndicator"
                                                                style="background-color: {{ $application->status === 'approved' ? 'green' : ($application->status === 'denied' ? 'red' : 'yellow') }};">
                                                            </div>
                                                            {{ ucfirst($application->status) }}
                                                        </div>
                                                    </td>
                                                    @if (auth()->user()->role === 'superadmin' || auth()->user()->role === 'employer')
                                                    <td class="px-6 py-4 border border-gray-300 dark:border-gray-700">
                                                        <div class="flex space-x-2">
                                                                <form action="{{ route('leave.approve', $application->id) }}" method="POST" style="display:inline;">
                                                                    @csrf
                                                                    <button type="submit" class="font-medium text-green-600 dark:text-green-500 hover:underline">{{ __('Approve') }}</button>
                                                                </form>
                                                                <form action="{{ route('leave.deny', $application->id) }}" method="POST" style="display:inline;">
                                                                    @csrf
                                                                    <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">{{ __('Deny') }}</button>
                                                                </form>
                                                        </div>
                                                    </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6"
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
            @if ($applications->total() > $applications->count())
                <div class="mt-2">
                    <div class="d-flex justify-content-center">
                        {{ $applications->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>