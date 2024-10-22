@section('title')
    {{ 'Dashboard' }}
@endsection
<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Welcome banner -->
        <div class="relative bg-white/10 rounded-lg backdrop-blur border border-black/10 dark:bg-black/10 dark:border-white/10 p-4 sm:p-6 overflow-hidden mb-8">

            <!-- Background illustration -->
            <div class="absolute right-0 top-0 -mt-4 mr-16 pointer-events-none hidden xl:block" aria-hidden="true">
                <svg width="319" height="198" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <defs>
                        <path id="welcome-a" d="M64 0l64 128-64-20-64 20z" />
                        <path id="welcome-e" d="M40 0l40 80-40-12.5L0 80z" />
                        <path id="welcome-g" d="M40 0l40 80-40-12.5L0 80z" />
                        <linearGradient x1="50%" y1="0%" x2="50%" y2="100%" id="welcome-b">
                            <stop stop-color="#A5B4FC" offset="0%" />
                            <stop stop-color="#818CF8" offset="100%" />
                        </linearGradient>
                        <linearGradient x1="50%" y1="24.537%" x2="50%" y2="100%" id="welcome-c">
                            <stop stop-color="#4338CA" offset="0%" />
                            <stop stop-color="#6366F1" stop-opacity="0" offset="100%" />
                        </linearGradient>
                    </defs>
                    <g fill="none" fill-rule="evenodd">
                        <g transform="rotate(64 36.592 105.604)">
                            <mask id="welcome-d" fill="#fff">
                                <use xlink:href="#welcome-a" />
                            </mask>
                            <use fill="url(#welcome-b)" xlink:href="#welcome-a" />
                            <path fill="url(#welcome-c)" mask="url(#welcome-d)" d="M64-24h80v152H64z" />
                        </g>
                        <g transform="rotate(-51 91.324 -105.372)">
                            <mask id="welcome-f" fill="#fff">
                                <use xlink:href="#welcome-e" />
                            </mask>
                            <use fill="url(#welcome-b)" xlink:href="#welcome-e" />
                            <path fill="url(#welcome-c)" mask="url(#welcome-f)" d="M40.333-15.147h50v95h-50z" />
                        </g>
                        <g transform="rotate(44 61.546 392.623)">
                            <mask id="welcome-h" fill="#fff">
                                <use xlink:href="#welcome-g" />
                            </mask>
                            <use fill="url(#welcome-b)" xlink:href="#welcome-g" />
                            <path fill="url(#welcome-c)" mask="url(#welcome-h)" d="M40.333-15.147h50v95h-50z" />
                        </g>
                    </g>
                </svg>
            </div>

            <!-- Content -->
            <div class="relative">
                <h1 id="greeting"
                    class="text-2xl md:text-3xl text-slate-900 dark:text-slate-300 font-bold mb-1 capitalize">
                    Good , <span id="usernamePlaceholder"></span> </h1>
                @if (auth('web')->user()->role == 'employee')
                    <p class="dark:text-indigo-200">Here is what's happening with your projects today</p>
                    <p class="dark:text-indigo-200">Employer name:
                        {{ auth('web')->user()->employee->employer->employer_name }}</p>
                    <p class="dark:text-indigo-200">Employer Email:
                        {{ auth('web')->user()->employee->employer->user->email }}
                    </p>
                @endif
            </div>

            <script>
                // Get the current hour
                const currentHour = new Date().getHours();

                // Select the greeting element
                const greetingElement = document.getElementById('greeting');

                // Function to determine the time of day
                function getTimeOfDay(hour) {
                    if (hour >= 5 && hour < 12) {
                        return 'morning';
                    } else if (hour >= 12 && hour < 18) {
                        return 'afternoon';
                    } else {
                        return 'evening';
                    }
                }

                // Function to update the greeting message
                function updateGreeting() {
                    const timeOfDay = getTimeOfDay(currentHour);
                    switch (timeOfDay) {
                        case 'morning':
                            greetingElement.innerText = `Good morning, {{ auth('web')->user()->username }}👋`;
                            break;
                        case 'afternoon':
                            greetingElement.innerText = `Good afternoon, {{ auth('web')->user()->username }}👋`;
                            break;
                        case 'evening':
                            greetingElement.innerText = `Good evening, {{ auth('web')->user()->username }} 👋`;
                            break;
                        default:
                            greetingElement.innerText = `Hello, {{ auth('web')->user()->username }}👋 `;
                    }
                }

                // Call the updateGreeting function when the page loads
                updateGreeting();
            </script>


        </div>

        <!-- Cards -->
        <div class="grid grid-cols-12 gap-6">

            <!-- Line chart (Acme Plus) -->
            <x-dashboard.dashboard-card-01 />

            <!-- Line chart (Acme Advanced) -->
            <x-dashboard.dashboard-card-02 />

            <!-- Line chart (Acme Professional) -->
            <x-dashboard.dashboard-card-03 />

        </div>
        <div class="mt-5 container mx-auto">
            <div class="flex flex-wrap">
                <div class="w-full">
                    <div class="dashboard-right pl-0 ">
                        <!-- Invoice Table Section -->
                        <div class="invoices-table ">
                            <div class="overflow-x-auto pb-1">
                                @if (auth()->user()->role != 'employee')
                                    <h2 class="text-xl font-semibold mb-4">{{ __('Recent Invoice') }}</h2>

                                    <table class="min-w-full table-auto text-sm">
                                        <thead
                                            class="bg-white/10 backdrop-blur shadow-lg rounded-lg border border-slate-200 dark:border-gray-800 text-slate-900 dark:text-gray-300 dark:bg-black/10">
                                            <tr class="text-center">
                                                <th class="p-3 border border-gray-300 dark:border-gray-700">Invoice
                                                    Number</th>
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
                                                <tr class="text-center  mt-5 pt-5">
                                                    <td class="py-3 border border-gray-300 dark:border-gray-700">
                                                        #{{ $transaction->order_id }}</td>
                                                    <td class="py-3 border border-gray-300 dark:border-gray-700">
                                                        {{ formatTime($transaction->created_at, 'M, d Y') }}</td>
                                                    <td class="py-3 border border-gray-300 dark:border-gray-700">
                                                        @if ($transaction->payment_type == 'per_job_based')
                                                            <span
                                                                class="px-2 py-1 text-sm bg-gray-300 rounded">{{ ucfirst(Str::replace('_', ' ', $transaction->payment_type)) }}</span>
                                                        @else
                                                            <span
                                                                class="px-2 py-1 text-sm bg-teal-500 text-white rounded">{{ $transaction->plan->label }}</span>
                                                        @endif
                                                    </td>

                                                    <td class="py-3 border border-gray-300 dark:border-gray-700">
                                                        {{ ucfirst($transaction->employer->user->username) }}</td>

                                                    <td class="py-3 border border-gray-300 dark:border-gray-700">
                                                        ${{ $transaction->usd_amount }}</td>
                                                    <td class="py-3 border border-gray-300 dark:border-gray-700">
                                                        {{ $transaction->payment_provider == 'offline'
                                                            ? __('offline') .
                                                                (optional($transaction->manualPayment)->name
                                                                    ? "
                                                                                                        (<b>{$transaction->manualPayment->name}</b>)"
                                                                    : '')
                                                            : ucfirst($transaction->payment_provider) }}
                                                    </td>
                                                    <td class="py-3 border border-gray-300 dark:border-gray-700">
                                                        <span
                                                            class="px-2 py-1 text-sm {{ $transaction->payment_status == 'paid' ? 'bg-green-500' : 'bg-yellow-500' }} text-white rounded-full">
                                                            {{ $transaction->payment_status == 'paid' ? __('paid') : __('unpaid') }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7"
                                                        class="text-center py-8 border border-gray-300 dark:border-gray-700 dark:text-gray-100">
                                                        <img src="{{ asset('images/no-data-found.svg') }}"
                                                            alt="No data found" class="mx-auto max-w-xs">
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                @endif
                                @if (auth()->user()->role === 'employee')
                                    <h2 class="text-xl font-semibold mb-4">{{ __('Latest Report Status') }}</h2>

                                    <table
                                        class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        <thead
                                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>

                                                <th scope="col"
                                                    class="px-6 py-3 border border-gray-300 dark:border-gray-700">
                                                    Name
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 border border-gray-300 dark:border-gray-700">
                                                    Date
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 border border-gray-300 dark:border-gray-700">
                                                    Status
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($timeReports->count() > 0)
                                                @foreach ($timeReports as $key => $timeReport)
                                                    <tr
                                                        class="bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                                        <th scope="row"
                                                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                                            <div class="">
                                                                <div class="text-base font-semibold">
                                                                    {{ $timeReport->user->username }}</div>
                                                                <div class="font-normal text-gray-500">
                                                                    {{ $timeReport->user->email }}</div>
                                                            </div>
                                                        </th>
                                                        <td
                                                            class="px-6 py-4 border border-gray-300 dark:border-gray-700">
                                                            <div class="">
                                                                <div class="text-base font-semibold">
                                                                    {{ $timeReport->start_day . ' to ' . $timeReport->end_day }}
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td
                                                            class="px-6 py-4 border border-gray-300 dark:border-gray-700">
                                                            <div class="flex items-center space-x-2">
                                                                <div class="h-2.5 w-2.5 rounded-full"
                                                                    id="statusIndicator"
                                                                    style="background-color: {{ $timeReport->status === 'approve' ? 'green' : ($timeReport->status === 'pending' ? 'yellow' : 'red') }};">
                                                                </div>
                                                                <form id="statusForm{{ $timeReport->id }}"
                                                                    action="{{ route('timesheet.updateStatus', $timeReport->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @if (auth('web')->user()->role == 'employee')
                                                                        <div class="dark:bg-slate-800"
                                                                            {{ $timeReport->status === 'approve' ? '' : 'hidden' }}>
                                                                            Approve</div>
                                                                        <div class="dark:bg-slate-800"
                                                                            {{ $timeReport->status === 'decline' ? '' : 'hidden' }}>
                                                                            Decline</div>
                                                                        <div class="dark:bg-slate-800"
                                                                            {{ $timeReport->status === 'pending' ? '' : 'hidden' }}>
                                                                            Pending</div>
                                                                    @else
                                                                        <select name="status" id="status"
                                                                            data-project-id="{{ $timeReport->id ?? '' }}"
                                                                            class="border-none bg-transparent text-gray-900 dark:text-white focus:outline-none"
                                                                            onchange="document.getElementById('statusForm{{ $timeReport->id }}').submit()">
                                                                            <!-- Replace data-project-id with the actual project ID -->
                                                                            <option class="dark:bg-slate-800"
                                                                                value="approve"
                                                                                {{ $timeReport->status === 'approve' ? 'selected' : '' }}>
                                                                                Approve
                                                                            </option>
                                                                            <option class="dark:bg-slate-800"
                                                                                value="decline"
                                                                                {{ $timeReport->status === 'decline' ? 'selected' : '' }}>
                                                                                Decline
                                                                            </option>
                                                                            <option class="dark:bg-slate-800"
                                                                                value="pending"
                                                                                {{ $timeReport->status === 'pending' ? 'selected' : '' }}>
                                                                                Pending
                                                                            </option>
                                                                        </select>
                                                                    @endif
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="5" class="text-center py-8">
                                                        <img src="{{ asset('images/no-data-found.svg') }}"
                                                            alt="No data found" class="mx-auto max-w-xs">
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</x-app-layout>
