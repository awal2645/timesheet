@section('title')
    {{ 'Order List' }}
@endsection
<x-app-layout>
    <div class="relative m-6">
        <div>
            <div class="my-8 card flex justify-between items-center">
                <form action="{{ route('order.index') }}" method="GET" class="w-full">
                    <div class="mb-3">
                        <label for="search"
                            class="block mb-2 text-sm font-medium text-text-light dark:text-text-dark">{{ __('Search') }}</label>
                        <div class="flex">
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
                <a href="{{ route('order.create') }}"
                    class="bg-primary-50 text-text-light dark:text-text-dark px-5 py-2 rounded-lg hover:bg-primary-50 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                    <i class="fa-solid fa-plus"></i> {{ __('Create Order') }}
                </a>
            </div>

            <div class="flex flex-wrap">
                <div class="w-full">
                    <div class="dashboard-right pl-0">
                        <div class="invoices-table">
                            <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark ml-1">
                                {{ __('Recent Invoice') }}</h2>
                            <div>
                                <div class="card">
                                    <table class="w-full table-auto">
                                        <thead class="table-header">
                                            <tr class="rounded-2xl text-left">
                                                <th class="p-4 font-medium">{{ __('Invoice Number') }}</th>
                                                <th class="p-4 font-medium">{{ __('Date') }}</th>
                                                <th class="p-4 font-medium">{{ __('Plan Name') }}</th>
                                                <th class="p-4 font-medium">{{ __('Employer Name') }}</th>
                                                <th class="p-4 font-medium">{{ __('Amount') }}</th>
                                                <th class="p-4 font-medium">{{ __('Payment Gateway') }}</th>
                                                <th class="p-4 font-medium">{{ __('Payment Status') }}</th>
                                                <th class="p-4 font-medium"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($transactions as $transaction)
                                                <tr class="hover:bg-gray-100 hover:dark:bg-gray-800">
                                                    <td class="p-4">#{{ $transaction->order_id }}</td>
                                                    <td class="p-4">
                                                        {{ formatTime($transaction->created_at, 'M, d Y') }}</td>
                                                        <td class="p-4">
                                                            @if ($transaction->payment_type == 'per_job_based')
                                                                <span class="flex items-center justify-center px-2 py-1 w-[170px] text-sm bg-gray-300 rounded truncate">
                                                                    {{ ucfirst(Str::replace('_', ' ', $transaction->payment_type)) }}
                                                                </span>
                                                            @else
                                                                <span class="flex items-center justify-center px-2 py-1 w-[100px] text-sm bg-primary-50 text-white rounded truncate">
                                                                    {{ $transaction->plan->label }}
                                                                </span>
                                                            @endif
                                                        </td>
                                                    <td class="p-4">
                                                        {{ ucfirst($transaction->employer->employer_name) ?? '' }}
                                                    </td>
                                                    <td class="p-4">${{ $transaction->usd_amount }}</td>
                                                    <td class="p-4">
                                                        {{ $transaction->payment_provider == 'offline' ? __('offline') . (optional($transaction->manualPayment)->name ? " (<b>{$transaction->manualPayment->name}</b>)" : '') : ucfirst($transaction->payment_provider) }}
                                                    </td>
                                                    <td class="p-4">
                                                        <span
                                                            class="px-2 py-1 flex items-center justify-center text-sm   w-[100px] truncate {{ $transaction->payment_status == 'paid' ? 'bg-green-500' : 'bg-yellow-500' }} text-white rounded">
                                                            {{ $transaction->payment_status == 'paid' ? __('paid') : __('unpaid') }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center py-8">
                                                        <x-svgs.no-data-found class="mx-auto md:size-[360px] size-[220px]" />
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @if ($transactions->total() > $transactions->count())
                            <div class="mt-2">
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
