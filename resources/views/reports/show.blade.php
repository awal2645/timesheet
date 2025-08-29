@section('title')
    {{ 'TimeSheet Report Details - ' . ($timeReport->user?->username ?? 'Unknown User') }}
@endsection

<x-app-layout>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Breadcrumb Navigation -->
            <nav class="mb-8">
                <ol class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400">
                    <li>
                        <a href="{{ route('dashboard') }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                            {{ __('Dashboard') }}
                        </a>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        <a href="{{ route('reports.index') }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                            {{ __('Reports') }}
                        </a>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        <span class="text-gray-900 dark:text-gray-100 font-medium">{{ __('Report Details') }}</span>
                    </li>
                </ol>
            </nav>

            <!-- Header Section -->
            <div class="mb-8">
                <div class="bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 rounded-2xl p-8 text-white">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-6">
                            <!-- Employee Avatar -->
                            <div class="w-20 h-20 bg-white/20 rounded-2xl flex items-center justify-center border-2 border-white/30">
                                <span class="text-2xl font-bold">{{ substr($timeReport->user?->username ?? 'U', 0, 1) }}</span>
                            </div>
                            
                            <!-- Report Info -->
                            <div>
                                <h1 class="text-3xl font-bold mb-2">{{ __('TimeSheet Report') }}</h1>
                                <div class="space-y-1">
                                    <div class="flex items-center space-x-2 text-blue-100">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span class="font-medium">{{ $timeReport->user?->username ?? __('Unknown User') }}</span>
                                    </div>
                                    <div class="flex items-center space-x-2 text-blue-100">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span>{{ $timeReport->start_day }} to {{ $timeReport->end_day }}</span>
                                    </div>
                                    <div class="flex items-center space-x-2 text-blue-100">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 7.89a2 2 0 002.83 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <span>{{ $timeReport->user?->email ?? __('No email') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Back Button -->
                        <a href="{{ route('reports.index') }}" 
                           class="inline-flex items-center px-6 py-3 bg-white/20 hover:bg-white/30 text-white rounded-xl transition-all duration-200 backdrop-blur-sm border border-white/30">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            {{ __('Back to Reports') }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Total Hours Card -->
                <div class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl p-6 text-white shadow-lg">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-white/20 rounded-xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold">{{ $timeReport->timesheets->sum('hours') ?? 0 }}</div>
                            <div class="text-emerald-100 text-sm font-medium">{{ __('Total Hours') }}</div>
                        </div>
                    </div>
                    <div class="w-full bg-white/20 rounded-full h-2">
                        <div class="bg-white h-2 rounded-full" style="width: {{ min(($timeReport->timesheets->sum('hours') / 40) * 100, 100) }}%"></div>
                    </div>
                </div>
                
                <!-- Working Days Card -->
                <div class="bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl p-6 text-white shadow-lg">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-white/20 rounded-xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold">{{ $timeReport->timesheets->count() }}</div>
                            <div class="text-blue-100 text-sm font-medium">{{ __('Working Days') }}</div>
                        </div>
                    </div>
                    <div class="flex space-x-1">
                        @for($i = 1; $i <= 7; $i++)
                            <div class="w-4 h-4 rounded {{ $i <= $timeReport->timesheets->count() ? 'bg-white' : 'bg-white/30' }}"></div>
                        @endfor
                    </div>
                </div>
                
                <!-- Status Card -->
                <div class="bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl p-6 text-white shadow-lg">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-white/20 rounded-xl">
                            @php
                                $statusIcons = [
                                    'pending' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                                    'approve' => 'M5 13l4 4L19 7',
                                    'decline' => 'M6 18L18 6M6 6l12 12'
                                ];
                            @endphp
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $statusIcons[$timeReport->status] ?? $statusIcons['pending'] }}"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="text-xl font-bold">{{ ucfirst($timeReport->status) }}</div>
                            <div class="text-amber-100 text-sm font-medium">{{ __('Status') }}</div>
                        </div>
                    </div>
                </div>
                
                <!-- Average Hours Card -->
                <div class="bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl p-6 text-white shadow-lg">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-white/20 rounded-xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold">{{ $timeReport->timesheets->count() > 0 ? number_format($timeReport->timesheets->sum('hours') / $timeReport->timesheets->count(), 1) : 0 }}</div>
                            <div class="text-purple-100 text-sm font-medium">{{ __('Avg/Day') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Left Column - Image & Description -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Report Image -->
                    <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                        <div class="flex items-center mb-6">
                            <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-xl mr-3">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('Report Attachment') }}</h3>
                        </div>
                        <div class="relative group overflow-hidden rounded-xl">
                            <img src="{{ asset($timeReport->image) }}"
                                 alt="TimeSheet Report"
                                 class="w-full h-auto max-h-96 object-cover transition-transform duration-300 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                    </div>
                    
                    <!-- Description -->
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-2xl p-6 border border-blue-200 dark:border-blue-800">
                        <div class="flex items-center mb-4">
                            <div class="p-2 bg-blue-500 rounded-xl mr-3">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-blue-900 dark:text-blue-100">{{ __('Description') }}</h3>
                        </div>
                        <p class="text-blue-800 dark:text-blue-200 leading-relaxed text-lg">
                            {{ $timeReport->comment ?: __('No description provided for this timesheet report.') }}
                        </p>
                    </div>

                    <!-- Feedback Section -->
                    <div class="bg-white dark:bg-gray-900 rounded-2xl p-8 shadow-sm border border-gray-200 dark:border-gray-700">
                        <form action="{{ route('timesheet.feedback', $timeReport->id) }}" method="POST">
                            @csrf
                            <div class="flex items-center mb-6">
                                <div class="p-3 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl mr-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('Feedback & Communication') }}</h3>
                                    <p class="text-gray-500 dark:text-gray-400">{{ __('Provide detailed feedback for this timesheet submission') }}</p>
                                </div>
                            </div>
                            
                            <div class="relative">
                                <textarea 
                                    name="feedback" 
                                    rows="6"
                                    @if (auth()->user()->role == 'employee') readonly @endif
                                    class="w-full px-6 py-4 text-base border-2 border-gray-200 dark:border-gray-600 rounded-2xl bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 resize-none"
                                    placeholder="{{ auth()->user()->role == 'employee' ? __('Manager feedback will appear here...') : __('Write your detailed feedback here. Be specific about what worked well and areas for improvement...') }}"
                                >{{ $timeReport->feedback }}</textarea>
                                @if (auth()->user()->role == 'employee')
                                    <div class="absolute top-4 right-4 p-2 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg">
                                        <svg class="w-4 h-4 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            
                            @if (auth()->user()->role != 'employee')
                                <div class="flex justify-end mt-6">
                                    <button type="submit"
                                            class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-lg font-semibold rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                        <svg class="w-5 h-5 mr-3 group-hover:rotate-12 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                        </svg>
                                        {{ __('Send Feedback') }}
                                    </button>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
                
                <!-- Right Column - Timesheet Table -->
                <div class="space-y-6">
                    <div class="bg-white dark:bg-gray-900 rounded-2xl overflow-hidden shadow-sm border border-gray-200 dark:border-gray-700">
                        <div class="p-6 bg-gradient-to-r from-gray-50 to-blue-50 dark:from-gray-800 dark:to-blue-900/20 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white flex items-center">
                                <div class="p-2 bg-indigo-500 rounded-xl mr-3">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                {{ __('Daily Breakdown') }}
                            </h3>
                        </div>
                        <div class="max-h-96 overflow-y-auto">
                            @foreach ($timeReport->timesheets as $index => $timesheet)
                                <div class="flex items-center justify-between p-4 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors {{ $index < count($timeReport->timesheets) - 1 ? 'border-b border-gray-100 dark:border-gray-700' : '' }}">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center text-white font-bold text-sm">
                                            {{ substr($timesheet->day, 0, 3) }}
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900 dark:text-white">{{ $timesheet->day }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ formatTime($timesheet->date, 'M d, Y') }}</div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white text-sm font-bold rounded-xl">
                                            {{ $timesheet->hours }}h
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                            {{ round(($timesheet->hours / 8) * 100) }}% of day
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Action Footer -->
            @if (auth()->user()->role != 'employee')
                <div class="mt-8 bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="bg-gradient-to-r from-slate-50 to-blue-50 dark:from-gray-800 dark:to-blue-900/20 p-8">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-xl font-bold text-gray-900 dark:text-white">{{ __('Review Complete') }}</h4>
                                    <p class="text-gray-500 dark:text-gray-400">{{ __('Take action on this timesheet report') }}</p>
                                </div>
                            </div>
                            
                            <form action="{{ route('timesheet.updateStatus', $timeReport->id) }}" method="POST" class="flex space-x-4">
                                @csrf
                                <input type="hidden" name="time_report_id" value="{{ $timeReport->id }}">
                                
                                @if ($timeReport->status === 'approve')
                                    <button type="button" disabled
                                            class="inline-flex items-center px-8 py-4 bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 text-lg font-semibold rounded-2xl cursor-not-allowed">
                                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        {{ __('Already Approved') }}
                                    </button>
                                @else
                                    <button type="submit" name="status" value="approve"
                                            class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700 text-white text-lg font-semibold rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl">
                                        <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        {{ __('Approve Report') }}
                                    </button>
                                @endif
                                
                                @if ($timeReport->status === 'decline')
                                    <button type="button" disabled
                                            class="inline-flex items-center px-8 py-4 bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 text-lg font-semibold rounded-2xl cursor-not-allowed">
                                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        {{ __('Already Declined') }}
                                    </button>
                                @else
                                    <button type="submit" name="status" value="decline"
                                            class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white text-lg font-semibold rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl">
                                        <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        {{ __('Decline Report') }}
                                    </button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout> 