@section('title')
    {{ 'Order List' }}
@endsection
<x-app-layout>
    <div class="relative overflow-x-auto">
        <div class="container mx-auto px-5">
            <div class=" mt-10 flex flex-col md:flex-row justify-between items-center md:space-y-0 ">
                <form action="{{ route('order.index') }}" method="GET">
                    <div class="mb-5">
                        <label for="search" class="block mb-2 text-sm font-medium">{{ __('Search')}}</label>
                        <div class="flex">
                            <input type="text" id="search" name="search" value="{{ request('search') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="{{ __('Search')}}" />
                            <button class="bg-teal-500 text-white px-4 py-2 rounded-lg ml-2">{{ __('Search')}}</button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('order.create') }}" class="bg-teal-500 text-white px-4 py-2 rounded-lg"><i
                        class="fa-solid fa-plus"></i>{{ __('Create Order')}}</a>
            </div>
            <div class="flex flex-wrap">
                <div class="w-full ">
                    <div class="dashboard-right pl-0 ">
                        <!-- Invoice Table Section -->
                        <div class="invoices-table ">
                            <h2 class="text-xl font-semibold mb-4">{{ __('Recent Invoice') }}</h2>
                            <div class="overflow-x-auto pb-1">
                                <table class="min-w-full table-auto text-sm">
                                    <thead
                                        class="bg-white shadow-lg rounded-sm border border-slate-200 dark:border-gray-800 dark:text-gray-100 dark:bg-gray-800">
                                        <tr class="text-center">
                                            <th class="p-3 border border-gray-300 dark:border-gray-700">
                                                 {{ __('Invoice Number')}}
                                            </th>
                                            <th class="p-3 border border-gray-300 dark:border-gray-700">
                                                {{ __('Date') }}</th>
                                            <th class="p-3 border border-gray-300 dark:border-gray-700">
                                                {{ __('Plan') }}</th>
                                            <th class="p-3 border border-gray-300 dark:border-gray-700">
                                                {{ __('Employer') }}</th>
                                            <th class="p-3 border border-gray-300 dark:border-gray-700">
                                                {{ __('Amount') }}</th>
                                            <th class="p-3 border border-gray-300 dark:border-gray-700">
                                                {{ __('Payment Gateway') }}</th>
                                            <th class="p-3 border border-gray-300 dark:border-gray-700">
                                                {{ __('Payment Status') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($transactions as $transaction)
                                            <tr
                                                class="border-b text-center border border-gray-300 dark:border-gray-700 mt-5 pt-5">
                                                <td class="p-5 border border-gray-300 dark:border-gray-700">
                                                    #{{ $transaction->order_id }}</td>
                                                <td class="p-5 border border-gray-300 dark:border-gray-700">
                                                    {{ formatTime($transaction->created_at, 'M, d Y') }}</td>
                                                <td class="p-5 border border-gray-300 dark:border-gray-700">
                                                    @if ($transaction->payment_type == 'per_job_based')
                                                        <span
                                                            class="px-2 py-1 text-sm bg-gray-300 rounded">{{ ucfirst(Str::replace('_', ' ', $transaction->payment_type)) }}</span>
                                                    @else
                                                        <span
                                                            class="px-2 py-1 text-sm bg-teal-500 text-white rounded">{{ $transaction->plan->label }}</span>
                                                    @endif
                                                </td>

                                                <td class="p-5 border border-gray-300 dark:border-gray-700">
                                                    {{ ucfirst($transaction->employer->user->username) ?? '' }}</td>

                                                <td class="p-5 border border-gray-300 dark:border-gray-700">
                                                    ${{ $transaction->usd_amount }}</td>
                                                <td class="p-5 border border-gray-300 dark:border-gray-700">
                                                    {{ $transaction->payment_provider == 'offline'
                                                        ? __('offline') .
                                                            (optional($transaction->manualPayment)->name
                                                                ? "
                                                                                                                                                        (<b>{$transaction->manualPayment->name}</b>)"
                                                                : '')
                                                        : ucfirst($transaction->payment_provider) }}
                                                </td>
                                                <td class="p-5">
                                                    <span
                                                        class="px-2 py-1 text-sm {{ $transaction->payment_status == 'paid' ? 'bg-green-500' : 'bg-yellow-500' }} text-white rounded-full">
                                                        {{ $transaction->payment_status == 'paid' ? __('paid') : __('unpaid') }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7"
                                                    class="text-center py-8 border border-gray-300 dark:border-gray-700">
                                                    <img src="{{ asset('images/no-data-found.svg') }}"
                                                        alt="No data found" class="mx-auto max-w-xs">
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
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
