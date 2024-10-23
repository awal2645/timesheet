<x-app-layout>
    <div class="relative overflow-x-auto">
        <div class="container mx-auto px-5">
            <div class="flex flex-wrap">
                <div class="w-full ">
                    <div class="dashboard-right pl-0 ">
                        <div class="flex flex-wrap my-5 justify-center lg:justify-start">
                            <!-- Plan Card Section -->
                            <div class="w-full lg:w-1/3 mb-6 h-20 mr-10">
                                <div class="plan-card bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg text-center"
                                    style="
                                    height: 190px;
                                ">
                                    <h2 class="text-2xl font-extrabold text-blue-600 dark:text-blue-400">
                                        {{ $userplan->plan->label ?? 'N0 Have Plan' }}</h2>
                                    <p class="mt-4 text-gray-600 dark:text-gray-300 text-sm">
                                        {!! optional($userplan->plan->descriptions[0] ?? null)->description !!}
                                    </p>
                                    <div class="mt-6">
                                        <a href="{{ route('plans.index') }}"
                                            class="btn bg-teal-500 text-white py-2 px-6 rounded-full hover:bg-teal-500 dark:bg-blue-700 dark:hover:bg-blue-800 shadow-md transition">
                                            {{ __('Upgrade plan') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- Benefits Section -->
                            <div class="w-full lg:w-1/2 text-center">
                                <div class="benefits-card bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                                    <h4 class="text-xl font-semibold dark:text-gray-300">
                                        {{ __('Your Current plan benefits') }}</h4>
                                    @if ($userplan && $userplan->plan)
                                    <div class="flex justify-center mt-4">
                                        <ul class="space-y-2">
                                            @foreach ([['limit' => $userplan->plan->employee_limit, 'label' =>
                                            __('Employee limit')], ['limit' => $userplan->plan->client_limit, 'label' =>
                                            __('Client limit')], ['limit' => $userplan->plan->project_limit, 'label' =>
                                            __('Project limit')]] as $benefit)
                                            <li class="flex items-center">
                                                <i class="fa-solid fa-check-double text-green-500 text-lg"></i>
                                                <span class="ml-3 text-sm dark:text-gray-300">{{ $benefit['limit'] }}
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
                        <!-- Invoice Table Section -->
                        <div class="invoices-table mt-10">
                            <h2 class="text-xl font-semibold mb-4">{{ __('Latest Plan') }}</h2>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($transactions as $transaction)
                                        <tr class="border-b text-center border-gray-200 dark:border-gray-800 mt-5 pt-5">
                                            <td class="p-5 border border-gray-300 dark:border-gray-700">
                                                #{{ $transaction->order_id }}</td>
                                            <td class="p-5 border border-gray-300 dark:border-gray-700">
                                                {{ formatTime($transaction->created_at, 'M, d Y') }}</td>
                                            <td class="p-5 border border-gray-300 dark:border-gray-700">
                                                @if ($transaction->payment_type == 'per_job_based')
                                                <span class="px-2 py-1 text-sm bg-gray-300 rounded">{{
                                                    ucfirst(Str::replace('_', ' ', $transaction->payment_type))
                                                    }}</span>
                                                @else
                                                <span class="px-2 py-1 text-sm bg-teal-500 text-white rounded">{{
                                                    $transaction->plan->label ?? 'N/A' }}</span>
                                                @endif
                                            </td>
                                            <td class="p-5 border border-gray-300 dark:border-gray-700">
                                                ${{ $transaction->usd_amount }}</td>
                                            <td class="p-5 border border-gray-300 dark:border-gray-700">
                                                {{ $transaction->payment_provider == 'offline' ? __('offline') .
                                                (optional($transaction->manualPayment)->name ? "
                                                (<b>{$transaction->manualPayment->name}</b>)" : '') :
                                                ucfirst($transaction->payment_provider) }}
                                            </td>
                                            <td class="p-5 border border-gray-300 dark:border-gray-700">
                                                <span
                                                    class="px-2 py-1 text-sm {{ $transaction->payment_status == 'paid' ? 'bg-green-500' : 'bg-yellow-500' }} text-white rounded-full">
                                                    {{ $transaction->payment_status == 'paid' ? __('paid') :
                                                    __('unpaid') }}
                                                </span>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-8">
                                                <img src="{{ asset('images/no-data-found.svg') }}" alt="No data found"
                                                    class="mx-auto max-w-xs">
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>