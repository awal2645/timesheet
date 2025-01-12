<x-app-layout>
    <div class="m-6">
        <div class="relative overflow-x-auto">
            <div class="flex flex-wrap">
                <div class="w-full ">
                    <div class="dashboard-right ps-0 ">
                        <div class=" mx-auto px-4 py-8">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6  mx-auto">
                                <!-- Current Plan Card -->
                                <div class="h-full">
                                    <div
                                        class="relative h-full overflow-hidden bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700">
                                        <!-- Decorative Background Pattern -->
                                        <div class="absolute inset-0 opacity-5 dark:opacity-10">
                                            <div
                                                class="absolute -right-10 -top-10 w-40 h-40 bg-primary-500 rounded-full">
                                            </div>
                                            <div
                                                class="absolute -left-10 -bottom-10 w-40 h-40 bg-primary-500 rounded-full">
                                            </div>
                                        </div>

                                        <div class="relative p-8 h-full flex flex-col">
                                            <!-- Plan Header -->
                                            <div class="text-center flex-grow">
                                                <div
                                                    class="inline-flex items-center justify-center w-16 h-16 rounded-full  mb-4">
                                                    <x-svgs.check
                                                        class="w-8 h-8 text-primary-500 dark:text-primary-400" />
                                                </div>
                                                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                                                    {{ $userplan->plan->label ?? 'No Active Plan' }}
                                                </h2>
                                                <p
                                                    class="mt-3 text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                                                    {!! optional($userplan->plan->descriptions[0] ?? null)->description !!}
                                                </p>
                                            </div>

                                            <!-- Upgrade Button -->
                                            <div class="mt-8">
                                                <a href="{{ route('plans.index') }}"
                                                    class="block w-full text-center py-3 px-6 rounded-xl bg-primary-50 hover:bg-primary-300 text-white font-semibold transition-all duration-200 transform hover:translate-y-[-2px] hover:shadow-lg">
                                                    {{ __('Upgrade Plan') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Benefits Card -->
                                <div class="h-full">
                                    <div
                                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-8 h-full">
                                        <div class="flex items-center justify-between mb-8">
                                            <h4 class="text-xl font-bold text-gray-900 dark:text-white">
                                                {{ __('Current Plan Benefits') }}
                                            </h4>
                                            <div class="w-12 h-12 rounded-full flex items-center justify-center">
                                                <x-svgs.check class="w-6 h-6 text-primary-500 dark:text-primary-400" />
                                            </div>
                                        </div>

                                        @if ($userplan && $userplan->plan)
                                            <div class="space-y-4">
                                                @foreach ([['limit' => $userplan->plan->employee_limit, 'label' => __('Employee limit'), 'icon' => 'users'], ['limit' => $userplan->plan->client_limit, 'label' => __('Client limit'), 'icon' => 'briefcase'], ['limit' => $userplan->plan->project_limit, 'label' => __('Project limit'), 'icon' => 'folder']] as $benefit)
                                                    <div
                                                        class="flex items-center p-4 rounded-xl bg-gray-50 dark:bg-gray-700/50 transition-all duration-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                        <div
                                                            class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center">
                                                            <x-svgs.check
                                                                class="w-5 h-5 text-primary-500 dark:text-primary-400" />
                                                        </div>
                                                        <div class="ms-4">
                                                            <span
                                                                class="block text-sm font-medium text-gray-900 dark:text-white">
                                                                {{ $benefit['limit'] }} {{ $benefit['label'] }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="text-center py-8">
                                                <div
                                                    class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-700 mb-4">
                                                    <svg class="w-8 h-8 text-gray-400"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </div>
                                                <p class="text-gray-500 dark:text-gray-400">
                                                    {{ __('No benefits found') }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-wrap">
                            <div class="w-full">
                                <div class="dashboard-right ps-0">
                                    <div class="invoices-table">
                                        <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark ms-1">
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
                                                            <th class="p-4 font-medium">{{ __('Payment Gateway') }}
                                                            </th>
                                                            <th class="p-4 font-medium">{{ __('Payment Status') }}</th>
                                                            <th class="p-4 font-medium"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($transactions as $transaction)
                                                            <tr class="hover:bg-gray-100 hover:dark:bg-gray-800">
                                                                <td class="p-4">#{{ $transaction->order_id }}</td>
                                                                <td class="p-4">
                                                                    {{ formatTime($transaction->created_at, 'M, d Y') }}
                                                                </td>
                                                                <td class="p-4">
                                                                    @if ($transaction->payment_type == 'per_job_based')
                                                                        <span
                                                                            class="flex items-center justify-center px-2 py-1 w-[170px] text-sm bg-gray-300 rounded truncate">
                                                                            {{ ucfirst(Str::replace('_', ' ', $transaction->payment_type)) }}
                                                                        </span>
                                                                    @else
                                                                        <span
                                                                            class="flex items-center justify-center px-2 py-1 w-[100px] text-sm bg-primary-50 text-white rounded truncate">
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
                                                                    <x-svgs.no-data-found
                                                                        class="mx-auto md:size-[360px] size-[220px]" />
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
</x-app-layout>
