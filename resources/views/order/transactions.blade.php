@section('title')
    {{ 'Order List' }}
@endsection
<x-app-layout>
    <div class="relative overflow-x-auto">
        <div class="container mx-8">
            <div
                class="my-8 px-5 py-3 rounded-2xl dark:bg-black/10 bg-white/10 backdrop-blur border border-black/10 dark:border-white/10 flex flex-col md:flex-row justify-between items-center md:space-y-0">
                <form action="{{ route('order.index') }}" method="GET">
                    <div class="mb-5">
                        <label for="search" class="block mb-2 text-sm font-medium">{{ __('Search') }}</label>
                        <div class="flex">
                            <input type="text" id="search" name="search" value="{{ request('search') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="{{ __('Search') }}" />
                            <button
                                class="bg-primary-500 text-white px-4 py-2 rounded-lg ml-2">{{ __('Search') }}</button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('order.create') }}" class="bg-primary-500 text-white px-4 py-2 rounded-lg">
                    <i class="fa-solid fa-plus"></i> {{ __('Create Order') }}
                </a>
            </div>

            <div class="flex flex-wrap">
                <div class="w-full">
                    <div class="dashboard-right pl-0">
                        <div class="invoices-table">
                            <h2 class="text-xl font-semibold mb-4">{{ __('Recent Invoice') }}</h2>
                            <div class="overflow-x-auto">
                                <div
                                    class="rounded-lg border border-black/10 dark:border-white/10 shadow-lg bg-white/10 backdrop-blur dark:bg-black/10 px-5 pb-20 pt-6 shadow-default sm:px-7.5">
                                    <table class="w-full table-auto">
                                        <thead>
                                            <tr class="bg-gray-200 rounded-2xl text-left dark:bg-gray-700">
                                                <th class="p-4 font-medium text-black dark:text-white">
                                                    <div class="flex gap-2 items-center text-base">
                                                        <span>{{ __('Invoice Number') }}</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                            class="bi bi-arrow-down size-3" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd"
                                                                d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1" />
                                                        </svg>
                                                    </div>
                                                </th>
                                                <th class="p-4 font-medium text-black dark:text-white">
                                                    <div class="flex gap-2 items-center text-base">
                                                        <span>{{ __('Date') }}</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                            class="bi bi-arrow-down size-3" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd"
                                                                d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1" />
                                                        </svg>
                                                    </div>
                                                </th>
                                                <th class="p-4 font-medium text-black dark:text-white">
                                                    <div class="flex gap-2 items-center text-base">
                                                        <span>{{ __('Plan') }}</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                            class="bi bi-arrow-down size-3" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd"
                                                                d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1" />
                                                        </svg>
                                                    </div>
                                                </th>
                                                <th class="p-4 font-medium text-black dark:text-white">
                                                    <div class="flex gap-2 items-center text-base">
                                                        <span>{{ __('Employer') }}</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                            class="bi bi-arrow-down size-3" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd"
                                                                d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1" />
                                                        </svg>
                                                    </div>
                                                </th>
                                                <th class="p-4 font-medium text-black dark:text-white">
                                                    <div class="flex gap-2 items-center text-base">
                                                        <span>{{ __('Amount') }}</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                            class="bi bi-arrow-down size-3" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd"
                                                                d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1" />
                                                        </svg>
                                                    </div>
                                                </th>
                                                <th class="p-4 font-medium text-black dark:text-white">
                                                    <div class="flex gap-2 items-center text-base">
                                                        <span>{{ __('Payment Gateway') }}</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                            class="bi bi-arrow-down size-3" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd"
                                                                d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1" />
                                                        </svg>
                                                    </div>
                                                </th>
                                                <th class="p-4 font-medium text-black dark:text-white">
                                                    <div class="flex gap-2 items-center text-base">
                                                        <span>{{ __('Payment Status') }}</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                            class="bi bi-arrow-down size-3" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd"
                                                                d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1" />
                                                        </svg>
                                                    </div>
                                                </th>
                                                <th class="p-4 font-medium text-black dark:text-white">

                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($transactions as $transaction)
                                                <tr class="hover:bg-gray-100 hover:dark:bg-gray-800">
                                                    <td class="p-4">
                                                        #{{ $transaction->order_id }}
                                                    </td>
                                                    <td class="p-4">
                                                        {{ formatTime($transaction->created_at, 'M, d Y') }}
                                                    </td>
                                                    <td class="p-4">
                                                        @if ($transaction->payment_type == 'per_job_based')
                                                            <span
                                                                class="px-2 py-1 text-sm bg-gray-300 rounded">{{ ucfirst(Str::replace('_', ' ', $transaction->payment_type)) }}</span>
                                                        @else
                                                            <span
                                                                class="px-2 py-1 text-sm bg-primary-500 text-white rounded">{{ $transaction->plan->label }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="p-4">
                                                        {{ ucfirst($transaction->employer->user->username) ?? '' }}
                                                    </td>
                                                    <td class="p-4">
                                                        ${{ $transaction->usd_amount }}
                                                    </td>
                                                    <td class="p-4">
                                                        {{ $transaction->payment_provider == 'offline'
                                                            ? __('offline') .
                                                                (optional($transaction->manualPayment)->name
                                                                    ? "
                                                                                                                                                                                                                                                                                                                                                                                                                                    (<b>{$transaction->manualPayment->name}</b>)"
                                                                    : '')
                                                            : ucfirst($transaction->payment_provider) }}
                                                    </td>
                                                    <td class="p-4">
                                                        <span
                                                            class="px-2 py-1 text-sm {{ $transaction->payment_status == 'paid' ? 'bg-green-500' : 'bg-yellow-500' }} text-white rounded-full">
                                                            {{ $transaction->payment_status == 'paid' ? __('paid') : __('unpaid') }}
                                                        </span>
                                                    </td>
                                                    <td class="p-4">
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
                                                                    <!-- ... action buttons ... -->
                                                                </div>
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center py-8">
                                                        <img src="{{ asset('images/no-data-found.svg') }}"
                                                            alt="No data found" class="mx-auto max-w-xs">
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @if ($transactions->total() > $transactions->count())
                            <div class=" mt-2">
                                <div class="d-flex justify-content-center">
                                    {{ $transactions->links() }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
