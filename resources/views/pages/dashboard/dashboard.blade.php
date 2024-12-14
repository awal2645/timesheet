@section('title')
    {{ 'Dashboard' }}
@endsection
<x-app-layout>
    <head>
        <!-- Add Slick Carousel CSS -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    </head>
    <div class="m-6">

        <!-- Welcome banner -->
        <div
            class="relative bg-card-light rounded-lg backdrop-blur border border-black/10 dark:bg-card-dark dark:border-white/10 p-4 sm:p-6 overflow-hidden mb-8">

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
                    const username = "{{ auth('web')->user()->username }}";
                    switch (timeOfDay) {
                        case 'morning':
                            greetingElement.innerText = `{{ __('Good morning') }}, ${username} 👋`;
                            break;
                        case 'afternoon':
                            greetingElement.innerText = `{{ __('Good afternoon') }}, ${username} 👋`;
                            break;
                        case 'evening':
                            greetingElement.innerText = `{{ __('Good evening') }}, ${username} 👋`;
                            break;
                        default:
                            greetingElement.innerText = `{{ __('Hello') }}, ${username} 👋`;
                    }
                }

                // Call the updateGreeting function when the page loads
                updateGreeting();
            </script>


        </div>

        <!-- Cards -->
        <div class="grid grid-cols-12 gap-6 mx-auto">

            <!-- Line chart (Acme Plus) -->
            <x-dashboard.dashboard-card-01 />

            <!-- Line chart (Acme Advanced) -->
            <x-dashboard.dashboard-card-02 />

            <!-- Line chart (Acme Professional) -->
            <x-dashboard.dashboard-card-03 />

            <!-- New Chart Cards -->
            @if (auth()->user()->role != 'client' && auth()->user()->role != 'employee')
            <div class="col-span-12 xl:col-span-6">
                <div
                    class="bg-card-light rounded-lg backdrop-blur border border-black/10 dark:bg-card-dark dark:border-white/10 p-4">
                    <h3 class="text-lg font-semibold mb-4 dark:text-white">{{ __('Monthly Earnings') }}</h3>
                    <div style="height: 300px;">
                        <canvas id="monthlyChart"></canvas>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-span-12 xl:col-span-6">
                <div
                    class="bg-card-light rounded-lg backdrop-blur border border-black/10 dark:bg-card-dark dark:border-white/10 p-4">
                    <h3 class="text-lg font-semibold mb-4 dark:text-white">{{ __('Task Distribution') }}</h3>
                    <div style="height: 300px;">
                        <canvas id="taskChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Notice Board -->
            @canany('Notice view')
            <div class="col-span-12">
                <div
                    class="bg-card-light rounded-lg backdrop-blur border border-black/10 dark:bg-card-dark dark:border-white/10 p-4">
                    <h3 class="text-lg font-semibold mb-4 dark:text-white">{{ __('Notice Board') }}</h3>

                    <!-- News Ticker/Scroller -->
                    <div class="relative overflow-hidden group">
                        <!-- Scrolling Content -->
                        <div class="notice-carosel">
                            @forelse (notice() as $notice)
                                <div
                                    class="mx-3 p-4 bg-white/5 backdrop-blur border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-card-light dark:hover:bg-gray-700/50 transition-all duration-300">
                                    <div class="flex justify-between items-start">
                                        <h4 class="font-semibold text-gray-900 dark:text-white">
                                            {{ $notice->title }}
                                        </h4>
                                        <span
                                            class="text-sm text-gray-500">{{ $notice->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="mt-2 text-gray-600 dark:text-gray-300 !whitespace-normal">
                                        {{ $notice->content }}
                                    </p>
                                    <div class="mt-2">
                                        <span
                                            class="text-xs px-2 py-1 bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200 rounded-full">
                                            @php
                                                // Split the role string into an array
                                                $noticeRoles = explode(',', $notice->role);
                                            @endphp

                                            @foreach (roles() as $role)
                                                @if (in_array($role->id, $noticeRoles))
                                                    {{ ucfirst($role->name) }}{{ !$loop->last ? ',' : '' }}
                                                @endif
                                            @endforeach

                                        </span>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center text-gray-500 dark:text-gray-300">{{ __('No notices found') }}
                                </p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            @endcanany
        </div>
        @if (auth()->user()->role != 'employee' && auth()->user()->role != 'client')
            <div class="mt-5">
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
        @endif

    </div>

</x-app-layout>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
    // Wait for DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Check if elements exist before initializing charts
        const monthlyChartElement = document.getElementById('monthlyChart');
        const taskChartElement = document.getElementById('taskChart');

        if (monthlyChartElement) {
            const monthlyCtx = monthlyChartElement.getContext('2d');
            new Chart(monthlyCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct',
                        'Nov', 'Dec'
                    ],
                    datasets: [{
                        label: 'Earnings',
                        data: [
                            {{ earnings()->get(1) ?? 0 }},
                            {{ earnings()->get(2) ?? 0 }},
                            {{ earnings()->get(3) ?? 0 }},
                            {{ earnings()->get(4) ?? 0 }},
                            {{ earnings()->get(5) ?? 0 }},
                            {{ earnings()->get(6) ?? 0 }},
                            {{ earnings()->get(7) ?? 0 }},
                            {{ earnings()->get(8) ?? 0 }},
                            {{ earnings()->get(9) ?? 0 }},
                            {{ earnings()->get(10) ?? 0 }},
                            {{ earnings()->get(11) ?? 0 }},
                            {{ earnings()->get(12) ?? 0 }}
                        ],
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1,
                        fill: false
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            labels: {
                                color: document.documentElement.classList.contains('dark') ? 'white' :
                                    'black'
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: document.documentElement.classList.contains('dark') ?
                                    'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)'
                            },
                            ticks: {
                                color: document.documentElement.classList.contains('dark') ? 'white' :
                                    'black'
                            }
                        },
                        x: {
                            grid: {
                                color: document.documentElement.classList.contains('dark') ?
                                    'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)'
                            },
                            ticks: {
                                color: document.documentElement.classList.contains('dark') ? 'white' :
                                    'black'
                            }
                        }
                    }
                }
            });
        }

        if (taskChartElement) {
            const taskCtx = taskChartElement.getContext('2d');
            new Chart(taskCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Completed', 'In Progress', 'Pending'],
                    datasets: [{
                        data: [
                            {{ auth()->user()->role == 'client' ? taskCount('completed') : tasks()->where('status', 'completed')->count() }},
                            {{ auth()->user()->role == 'client' ? taskCount('inprogress') : tasks()->where('status', 'inprogress')->count() }},
                            {{ auth()->user()->role == 'client' ? taskCount('pending') : tasks()->where('status', 'pending')->count() }}
                        ],
                        backgroundColor: [
                            'rgb(75, 192, 192)',
                            'rgb(255, 205, 86)',
                            'rgb(255, 99, 132)'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: document.documentElement.classList.contains('dark') ? 'white' :
                                    'black',
                                padding: 20
                            }
                        }
                    }
                }
            });
        }
        
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.notice-carosel').slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            responsive: [
                {
                  breakpoint: 1024,
                  settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                  }
                },
                {
                  breakpoint: 767,
                  settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                  }
                },
                {
                  breakpoint: 480,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                  }
                }
              ]
        });
    });
</script>
