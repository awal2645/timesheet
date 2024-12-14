<x-app-layout>
    <div class="relative overflow-x-auto">
        <div class="container mx-auto px-5">
            <div class="flex flex-wrap">
                <div class="w-full ">
                    <div class="dashboard-right pl-0 ">
                        <div class="flex flex-wrap my-5 justify-center lg:justify-start">
                            <!-- Plan Card Section -->
                            <div class="w-full lg:w-1/3 mb-6 mr-10">
                                <div class="plan-card bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg text-center transition-transform transform hover:scale-105">
                                    <h2 class="text-2xl font-extrabold text-primary-600 dark:text-primary-400 mb-2 flex items-center justify-center">
                                        <x-svgs.check class="text-green-500 mr-2" /> <!-- Icon added here -->
                                        {{ $userplan->plan->label ?? 'No Have Plan' }}
                                    </h2>
                                    <p class="mt-2 text-gray-600 dark:text-gray-300 text-sm">
                                        {!! optional($userplan->plan->descriptions[0] ?? null)->description !!}
                                    </p>
                                    <div class="mt-4">
                                        <a href="{{ route('plans.index') }}"
                                            class="btn bg-primary-50 text-text-light dark:text-text-dark py-2 px-6 rounded-full hover:bg-primary-100 dark:bg-primary-50 dark:hover:bg-primary-300 shadow-md transition">
                                            {{ __('Upgrade plan') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- Benefits Section -->
                            <div class="w-full lg:w-1/2 text-center">
                                <div class="benefits-card bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md transition-transform transform hover:scale-105">
                                    <h4 class="text-xl font-semibold dark:text-gray-300">
                                        {{ __('Your Current plan benefits') }}</h4>
                                    @if ($userplan && $userplan->plan)
                                        <div class="flex justify-center mt-4">
                                            <ul class="space-y-2">
                                                @foreach ([['limit' => $userplan->plan->employee_limit, 'label' => __('Employee limit')], ['limit' => $userplan->plan->client_limit, 'label' => __('Client limit')], ['limit' => $userplan->plan->project_limit, 'label' => __('Project limit')]] as $benefit)
                                                    <li class="flex items-center">
                                                        <x-svgs.check class="text-green-500 text-lg" />
                                                        <span
                                                            class="ml-3 text-sm dark:text-gray-300">{{ $benefit['limit'] }}
                                                            {{ $benefit['label'] }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @else
                                        <p class="text-center text-gray-500">{{ __('No benefits found') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap">
                            <div class="w-full">
                                <div class="dashboard-right pl-0">
                                    <div class="invoices-table">
                                        <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark ml-1">
                                            {{ __('Recent Invoice') }}</h2>
                                        <div>
                                            <div class="card overflow-x-auto">
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
            </div>
        </div>
    </div>
</x-app-layout>
