@section('title', 'TimeTracker')
<x-app-layout>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 dark:from-gray-900 dark:via-slate-900 dark:to-gray-800">
    <!-- Header Section -->
    <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-10">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
    <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">My TimeTracker</h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400" id="currentDateTime"></p>
                </div>
                
                <!-- Mode Toggle -->
                <div class="flex items-center gap-4">
                    <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-1 flex">
                        <button id="dayModeBtn" class="px-4 py-2 text-sm font-medium rounded-md transition-all duration-200 bg-white dark:bg-gray-600 text-blue-600 dark:text-blue-400 shadow-sm">
                            Day
                        </button>
                        <button id="weekModeBtn" class="px-4 py-2 text-sm font-medium rounded-md transition-all duration-200 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                            Week
                        </button>
                        <button id="monthModeBtn" class="px-4 py-2 text-sm font-medium rounded-md transition-all duration-200 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                            Month
                        </button>
                    </div>
                    
                    <!-- Date Navigation -->
                    <div class="flex items-center gap-2">
                        <button id="prevPeriod" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                            <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <span id="currentPeriod" class="px-4 py-2 text-sm font-medium text-gray-900 dark:text-white min-w-[120px] text-center">
                            Mon, July 7, 2025
                        </span>
                        <button id="nextPeriod" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                            <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-6">
        <!-- Main Dashboard Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-8">
            <!-- Arrival Time Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-medium text-gray-600 dark:text-gray-400">Arrival time</h3>
                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                </div>
                <div class="text-2xl font-bold text-gray-900 dark:text-white mb-2" id="arrivalTime">--:--</div>
                <div class="h-8">
                    <svg class="w-full h-full text-green-200" viewBox="0 0 100 20">
                        <path d="M0,15 Q25,5 50,10 T100,8" stroke="currentColor" stroke-width="2" fill="none"/>
                    </svg>
                </div>
            </div>

            <!-- Status Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-medium text-gray-600 dark:text-gray-400">Status</h3>
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                </div>
                <div class="text-2xl font-bold text-green-600 dark:text-green-400 mb-2" id="currentStatus">ONLINE</div>
                <div class="h-8">
                    <svg class="w-full h-full text-green-200" viewBox="0 0 100 20">
                        <path d="M0,12 Q20,6 40,8 Q60,10 80,6 Q90,5 100,7" stroke="currentColor" stroke-width="2" fill="none"/>
                    </svg>
                </div>
            </div>

            <!-- Productive Time Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-medium text-gray-600 dark:text-gray-400">Productive time</h3>
                    <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                </div>
                <div class="text-2xl font-bold text-gray-900 dark:text-white mb-2" id="productiveTime">0<span class="text-sm">h</span> 00<span class="text-sm">m</span></div>
                <div class="h-8">
                    <svg class="w-full h-full text-blue-200" viewBox="0 0 100 20">
                        <path d="M0,18 Q25,8 50,12 Q75,6 100,10" stroke="currentColor" stroke-width="2" fill="none"/>
                    </svg>
                </div>
            </div>

            <!-- Total Time Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-medium text-gray-600 dark:text-gray-400">Total time</h3>
                    <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                </div>
                <div class="text-2xl font-bold text-gray-900 dark:text-white mb-2" id="totalTime">0<span class="text-sm">h</span> 00<span class="text-sm">m</span></div>
                <div class="h-8">
                    <svg class="w-full h-full text-purple-200" viewBox="0 0 100 20">
                        <path d="M0,16 Q30,4 60,8 Q80,12 100,6" stroke="currentColor" stroke-width="2" fill="none"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Secondary Metrics -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-8">
            <!-- Time at Work -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-medium text-gray-600 dark:text-gray-400">Time at work</h3>
                            </div>
                <div class="text-2xl font-bold text-gray-900 dark:text-white mb-2" id="timeAtWork">0<span class="text-sm">h</span> 00<span class="text-sm">m</span></div>
                <div class="h-8">
                    <svg class="w-full h-full text-gray-200" viewBox="0 0 100 20">
                        <path d="M0,14 Q20,10 40,12 Q60,8 80,14 Q90,16 100,12" stroke="currentColor" stroke-width="2" fill="none"/>
                    </svg>
                            </div>
                        </div>

            <!-- Team Ranking -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-medium text-gray-600 dark:text-gray-400">Place in team</h3>
                </div>
                <div class="text-2xl font-bold text-gray-900 dark:text-white mb-2">1<span class="text-sm">st</span> of 5<span class="text-sm">th</span></div>
                <div class="h-8">
                    <svg class="w-full h-full text-yellow-200" viewBox="0 0 100 20">
                        <path d="M0,10 Q25,14 50,8 Q75,12 100,10" stroke="currentColor" stroke-width="2" fill="none"/>
                    </svg>
                </div>
            </div>

            <!-- Effectiveness -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-medium text-gray-600 dark:text-gray-400">Effectiveness</h3>
                </div>
                <div class="text-2xl font-bold text-orange-500 dark:text-orange-400 mb-2" id="effectiveness">85.54%</div>
                <div class="h-8">
                    <svg class="w-full h-full text-orange-200" viewBox="0 0 100 20">
                        <path d="M0,16 Q30,8 60,10 Q80,6 100,12" stroke="currentColor" stroke-width="2" fill="none"/>
                    </svg>
                </div>
            </div>

            <!-- Productivity Score -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-medium text-gray-600 dark:text-gray-400">Productivity</h3>
                </div>
                <div class="text-2xl font-bold text-green-600 dark:text-green-400 mb-2" id="productivityScore">95.24%</div>
                <div class="h-8">
                    <svg class="w-full h-full text-green-200" viewBox="0 0 100 20">
                        <path d="M0,12 Q25,6 50,8 Q75,4 100,6" stroke="currentColor" stroke-width="2" fill="none"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Activity Data -->
        @if($activityData)
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 mb-8">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Activity Data</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h4 class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-2">Time Statistics</h4>
                    <ul class="list-disc list-inside text-gray-700 dark:text-gray-300">
                        <li>Total Time: {{ $activityData->total_time ?? 0 }} minutes</li>
                        <li>Productive Time: {{ $activityData->productive_time ?? 0 }} minutes</li>
                        <li>Idle Time: {{ $activityData->idle_time ?? 0 }} minutes</li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-2">Performance Metrics</h4>
                    <ul class="list-disc list-inside text-gray-700 dark:text-gray-300">
                        <li>Status: {{ ucfirst($activityData->status ?? 'N/A') }}</li>
                        <li>Productivity Score: {{ number_format($activityData->productivity_score ?? 0, 2) }}%</li>
                        <li>Effectiveness Score: {{ number_format($activityData->effectiveness_score ?? 0, 2) }}%</li>
                    </ul>
                </div>
                @if($activityData->activity_data)
                <div class="md:col-span-2">
                    <h4 class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-2">Application Usage</h4>
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <pre class="text-sm text-gray-700 dark:text-gray-300 whitespace-pre-wrap">{{ json_encode(json_decode($activityData->activity_data), JSON_PRETTY_PRINT) }}</pre>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Productivity Chart -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 mb-8">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Application Usage</h3>
            
            @if(isset($activityData->activity_data))
                @php
                    $appData = json_decode($activityData->activity_data, true);
                    $apps = $appData['apps'] ?? [];
                    
                    // Calculate total time for percentage
                    $totalTime = 0;
                    foreach($apps as $app) {
                        $totalTime += $app['total_time'];
                    }
                @endphp
                
                <div class="space-y-4">
                    @foreach($apps as $appName => $app)
                        @php
                            $percentage = $totalTime > 0 ? ($app['total_time'] / $totalTime) * 100 : 0;
                            $hours = floor($app['total_time'] / 3600);
                            $minutes = floor(($app['total_time'] % 3600) / 60);
                            $seconds = $app['total_time'] % 60;
                            $timeDisplay = $hours > 0 ? "{$hours}h " : "";
                            $timeDisplay .= $minutes > 0 ? "{$minutes}m " : "";
                            $timeDisplay .= "{$seconds}s";
                        @endphp
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3 w-1/2">
                                <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                                    <span class="text-blue-600 dark:text-blue-400 text-lg">📱</span>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900 dark:text-white text-sm">{{ $appName }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $timeDisplay }}</div>
                                </div>
                            </div>
                            <div class="w-1/2">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="text-xs text-gray-500 dark:text-gray-400">Usage</span>
                                    <span class="text-xs font-medium text-gray-900 dark:text-white">{{ number_format($percentage, 1) }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        Total tracking time: 
                        @php
                            $totalHours = floor($totalTime / 3600);
                            $totalMinutes = floor(($totalTime % 3600) / 60);
                            $totalSeconds = $totalTime % 60;
                        @endphp
                        <span class="font-medium text-gray-900 dark:text-white">
                            {{ $totalHours }}h {{ $totalMinutes }}m {{ $totalSeconds }}s
                        </span>
                    </div>
                </div>
            @else
                <div class="text-center text-gray-500 dark:text-gray-400 py-8">
                    <svg class="w-12 h-12 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-sm">No activity data available</p>
                </div>
            @endif
        </div>

        <!-- Projects Timeline -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 mb-8">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Projects</h3>
            <div class="h-32" id="projectsTimeline">
                <div class="flex items-center h-full">
                    <div class="flex-1 h-8 bg-gradient-to-r from-blue-100 to-blue-200 dark:from-blue-900 dark:to-blue-800 rounded-lg relative">
                        <div class="absolute inset-0 flex items-center justify-center text-xs font-medium text-blue-700 dark:text-blue-300">
                            Project Work
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-between text-xs text-gray-500 dark:text-gray-400 mt-2">
                <span>7 AM</span>
                <span>8 AM</span>
                <span>9 AM</span>
                <span>10 AM</span>
                <span>11 AM</span>
                <span>12 PM</span>
                <span>1 PM</span>
                <span>2 PM</span>
                <span>3 PM</span>
                <span>4 PM</span>
                <span>5 PM</span>
                <span>6 PM</span>
            </div>
        </div>

        <!-- App Categories -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Productive Apps -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-green-500 text-white px-6 py-4">
                    <h3 class="text-lg font-semibold">Productive apps - <span id="productiveAppsTime">2h 15m</span></h3>
                </div>
                <div class="p-6 space-y-4" id="productiveAppsList">
                    <!-- Productive apps will be populated by JavaScript -->
                </div>
            </div>

            <!-- Neutral Apps -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-gray-500 text-white px-6 py-4">
                    <h3 class="text-lg font-semibold">Neutral apps - <span id="neutralAppsTime">22m</span></h3>
                </div>
                <div class="p-6 space-y-4" id="neutralAppsList">
                    <!-- Neutral apps will be populated by JavaScript -->
                    </div>
                </div>

            <!-- Unproductive Apps -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-red-500 text-white px-6 py-4">
                    <h3 class="text-lg font-semibold">Unproductive apps</h3>
                            </div>
                <div class="p-6">
                    <div class="text-center text-gray-500 dark:text-gray-400 py-8">
                        <svg class="w-12 h-12 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                        <p class="text-sm">No data collected</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories Bar -->
        <div class="mt-8 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Categories</h3>
            <div class="flex items-center gap-6 mb-4 text-sm">
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                    <span class="text-gray-600 dark:text-gray-400">E-mail</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 bg-pink-500 rounded-full"></div>
                    <span class="text-gray-600 dark:text-gray-400">Social Media</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 bg-cyan-500 rounded-full"></div>
                    <span class="text-gray-600 dark:text-gray-400">Office apps</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
                    <span class="text-gray-600 dark:text-gray-400">Entertainment</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 bg-indigo-500 rounded-full"></div>
                    <span class="text-gray-600 dark:text-gray-400">News</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 bg-gray-500 rounded-full"></div>
                    <span class="text-gray-600 dark:text-gray-400">Undefined</span>
                                        </div>
                                    </div>
            <div class="h-6 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden" id="categoriesBar">
                <div class="h-full flex">
                    <div class="bg-blue-500" style="width: 40%"></div>
                    <div class="bg-pink-500" style="width: 5%"></div>
                    <div class="bg-cyan-500" style="width: 35%"></div>
                    <div class="bg-purple-500" style="width: 10%"></div>
                    <div class="bg-indigo-500" style="width: 5%"></div>
                    <div class="bg-gray-500" style="width: 5%"></div>
                </div>
                                </div>
                            </div>

        <!-- Timesheet Management Form -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 mb-8">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Time Entry & Management</h3>
            
            <!-- Time Entry Form -->
            <form id="timesheetForm" method="POST" action="{{ route('timesheet.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="start_day" value="{{ $startDate->format('Y-m-d') }}" />
                <input type="hidden" name="end_day" value="{{ $startDate->copy()->addDays(6)->format('Y-m-d') }}" />
                
                <!-- Weekly Hours Grid -->
                <div class="grid grid-cols-1 md:grid-cols-7 gap-4 mb-6">
                    @foreach($days as $index => $day)
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                {{ $day }}
                                <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($dates[$day])->format('M d') }}</div>
                            </label>
                            <input type="number" 
                                   name="hours[{{ $day }}]" 
                                   value="{{ $hours[$day] ?? 0 }}" 
                                   min="0" 
                                   max="24" 
                                   step="0.25"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-white"
                                   placeholder="0.00">
                            <input type="hidden" name="dates[{{ $day }}]" value="{{ $dates[$day] }}" />
                        </div>
                    @endforeach
                </div>
                
                <!-- Weekly Summary -->
                <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4 mb-6">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-blue-700 dark:text-blue-300">Weekly Total:</span>
                        <span id="weeklyTotal" class="text-lg font-bold text-blue-900 dark:text-blue-100">{{ array_sum($hours) }} hours</span>
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Comments (Optional)
                    </label>
                    <textarea name="comment" 
                              rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-white"
                              placeholder="Add any notes about your work this week...">{{ $timeReport->comment ?? '' }}</textarea>
                </div>
                
                <!-- Image Upload Section (for submit only) -->
                <div id="imageUploadSection" class="mb-6 hidden">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Upload Work Screenshot <span class="text-red-500">*</span>
                    </label>
                    <input type="file" 
                           name="image" 
                           accept="image/*"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-white">
                    <p class="text-xs text-gray-500 mt-1">Required for final submission. Accepted formats: PNG, JPG, WEBP</p>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex flex-wrap gap-3">
                    <button type="button" 
                            id="saveBtn"
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            Save Draft
                        </div>
                </button>

                    @if(!$timeReport || $timeReport->status == 'pending')
                        <button type="button" 
                                id="submitBtn"
                                class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-medium">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                Submit for Approval
                    </div>
                    </button>
                @endif

                    @if($timeReport)
                        <div class="flex items-center gap-2 px-4 py-2 rounded-lg {{ $timeReport->status == 'approve' ? 'bg-green-100 text-green-800' : ($timeReport->status == 'decline' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                @if($timeReport->status == 'approve')
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                @elseif($timeReport->status == 'decline')
                                    <path d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                @else
                                    <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                @endif
                            </svg>
                            Status: {{ ucfirst($timeReport->status) }}
                        </div>
                    @endif
                </div>
            </form>
        </div>

        <!-- Hidden Form (for JavaScript compatibility) -->
        <form id="hiddenTimesheetForm" method="POST" action="{{ route('timesheet.store') }}" class="hidden">
            @csrf
            <input type="hidden" id="trackingMode" name="tracking_mode" value="daily" />
            <input type="hidden" id="trackingPeriod" name="tracking_period" value="" />
            <input type="hidden" id="timesheetData" name="timesheet_data" value="" />
        </form>
    </div>

    <!-- Activity Data Display -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 mb-8">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Activity Data</h3>
        <ul class="list-disc list-inside text-gray-700 dark:text-gray-300">
            <li>Total Time: {{ $activityData->total_time ?? 'N/A' }} minutes</li>
            <li>Productive Time: {{ $activityData->productive_time ?? 'N/A' }} minutes</li>
            <li>Idle Time: {{ $activityData->idle_time ?? 'N/A' }} minutes</li>
            <li>Status: {{ ucfirst($activityData->status ?? 'N/A') }}</li>
            <li>Productivity Score: {{ $activityData->productivity_score ?? 'N/A' }}%</li>
            <li>Effectiveness Score: {{ $activityData->effectiveness_score ?? 'N/A' }}%</li>
            <li>Applications Used: {{ implode(', ', $activityData->applications ?? []) }}</li>
        </ul>
    </div>

    <!-- Footer -->
    <footer class="border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 mt-12">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex items-center justify-between text-sm text-gray-500 dark:text-gray-400">
                <div class="flex items-center gap-4">
                    <span>Terms</span>
                    <span>Privacy</span>
                    <span>Help Center</span>
                    <span>Contact us</span>
                </div>
                <span>© 2025 TimeTracker</span>
            </div>
        </div>
    </footer>
    </div>

    <script>
// Enhanced timesheet management with professional dashboard
class TimesheetDashboard {
    constructor() {
        this.currentMode = 'day';
        this.currentDate = new Date();
        this.isTracking = false;
        this.startTime = null;
        this.activityData = {};
        this.apps = {
            productive: [
                { name: 'Google Chrome', time: '2h 12m', icon: '🌐', percentage: 31 },
                { name: 'desktime.com', time: '31s', icon: '⏰', percentage: 11 },
                { name: 'app.hubspot.com', time: '1m', icon: '📊', percentage: 10 },
                { name: 'developer.android.com', time: '24s', icon: '📱', percentage: 24 },
                { name: 'mail.google.com', time: '12s', icon: '📧', percentage: 12 },
                { name: 'google.com', time: '7s', icon: '🔍', percentage: 7 },
                { name: 'accounts.google.com', time: '4s', icon: '🔐', percentage: 4 },
                { name: 'DeskTime', time: '3s', icon: '⏱️', percentage: 3 }
            ],
            neutral: [
                { name: 'Studio64', time: '6m', icon: '🎧', percentage: 0 },
                { name: 'Firefox_firefox', time: '6m', icon: '🦊', percentage: 0 },
                { name: 'wappubzizer.com', time: '1m', icon: '🔧', percentage: 0 },
                { name: 'Android studio 2025.1.1.3.wr...', time: '1m', icon: '📱', percentage: 0 },
                { name: 'chatgpt.com', time: '1m', icon: '🤖', percentage: 0 },
                { name: 'chrome://downloads', time: '1m', icon: '⬇️', percentage: 0 },
                { name: 'Cursor', time: '8s', icon: '💻', percentage: 0 },
                { name: 'sa.bovimo.com', time: '12s', icon: '🌐', percentage: 0 },
                { name: 'Taskmgr', time: '9s', icon: '⚙️', percentage: 0 },
                { name: 'Unknown App', time: '4s', icon: '❓', percentage: 0 }
            ]
        };
        
        this.initializeDashboard();
        this.setupEventListeners();
        this.startRealTimeUpdates();
        this.setupTimesheetForm();
    }

    initializeDashboard() {
        this.updateDateTime();
        this.updateCurrentPeriod();
        this.renderProductivityChart();
        this.renderAppLists();
        this.updateMetrics();
        
        // Simulate starting time tracking
        this.startTracking();
    }

    setupTimesheetForm() {
        // Handle hour inputs change
        const hourInputs = document.querySelectorAll('input[name^="hours["]');
        hourInputs.forEach(input => {
            input.addEventListener('input', this.calculateWeeklyTotal.bind(this));
            input.addEventListener('change', this.updateProductiveTime.bind(this));
        });

        // Handle save button
        const saveBtn = document.getElementById('saveBtn');
        if (saveBtn) {
            saveBtn.addEventListener('click', this.saveTimesheet.bind(this));
        }

        // Handle submit button
        const submitBtn = document.getElementById('submitBtn');
        if (submitBtn) {
            submitBtn.addEventListener('click', this.showSubmitForm.bind(this));
        }

        // Initial calculation
        this.calculateWeeklyTotal();
    }

    calculateWeeklyTotal() {
        const hourInputs = document.querySelectorAll('input[name^="hours["]');
        let total = 0;
        
        hourInputs.forEach(input => {
            const value = parseFloat(input.value) || 0;
            total += value;
        });

        const weeklyTotalElement = document.getElementById('weeklyTotal');
        if (weeklyTotalElement) {
            weeklyTotalElement.textContent = `${total.toFixed(2)} hours`;
        }

        return total;
    }

    updateProductiveTime() {
        const total = this.calculateWeeklyTotal();
        const productiveElement = document.getElementById('productiveTime');
        const totalElement = document.getElementById('totalTime');
        const timeAtWorkElement = document.getElementById('timeAtWork');
        
        if (productiveElement) {
            const hours = Math.floor(total);
            const minutes = Math.floor((total % 1) * 60);
            productiveElement.innerHTML = `${hours}<span class="text-sm">h</span> ${minutes.toString().padStart(2, '0')}<span class="text-sm">m</span>`;
        }
        
        if (totalElement) {
            const hours = Math.floor(total);
            const minutes = Math.floor((total % 1) * 60);
            totalElement.innerHTML = `${hours}<span class="text-sm">h</span> ${minutes.toString().padStart(2, '0')}<span class="text-sm">m</span>`;
        }

        if (timeAtWorkElement) {
            const hours = Math.floor(total);
            const minutes = Math.floor((total % 1) * 60);
            timeAtWorkElement.innerHTML = `${hours}<span class="text-sm">h</span> ${minutes.toString().padStart(2, '0')}<span class="text-sm">m</span>`;
        }
    }

    saveTimesheet() {
        const form = document.getElementById('timesheetForm');
        if (form) {
            // Change form action to save route
            form.action = '{{ route('timesheet.save') }}';
            form.submit();
        }
    }

    showSubmitForm() {
        const imageSection = document.getElementById('imageUploadSection');
        const submitBtn = document.getElementById('submitBtn');
        
        if (imageSection) {
            imageSection.classList.remove('hidden');
            imageSection.scrollIntoView({ behavior: 'smooth' });
        }
        
        if (submitBtn) {
            submitBtn.textContent = 'Submit with Screenshot';
            submitBtn.onclick = this.submitTimesheet.bind(this);
        }
    }

    submitTimesheet() {
        const form = document.getElementById('timesheetForm');
        const imageInput = document.querySelector('input[name="image"]');
        
        if (!imageInput || !imageInput.files.length) {
            alert('Please upload a work screenshot before submitting.');
            return;
        }
        
        if (form) {
            // Change form action to submit route
            form.action = '{{ route('timesheet.submit') }}';
            form.submit();
        }
    }

    updateDateTime() {
        const now = new Date();
        const dateTimeStr = now.toLocaleDateString('en-US', { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
        const dateTimeElement = document.getElementById('currentDateTime');
        if (dateTimeElement) {
            dateTimeElement.textContent = dateTimeStr;
        }
    }

    updateCurrentPeriod() {
        const options = { weekday: 'short', month: 'long', day: 'numeric', year: 'numeric' };
        const periodElement = document.getElementById('currentPeriod');
        if (periodElement) {
            periodElement.textContent = this.currentDate.toLocaleDateString('en-US', options);
        }
    }

    startTracking() {
        this.isTracking = true;
        this.startTime = new Date();
        
        // Set arrival time
        const arrivalElement = document.getElementById('arrivalTime');
        if (arrivalElement) {
            arrivalElement.textContent = this.startTime.toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            });
        }
        
        // Update status
        const statusElement = document.getElementById('currentStatus');
        if (statusElement) {
            statusElement.textContent = 'ONLINE';
            statusElement.className = 'text-2xl font-bold text-green-600 dark:text-green-400 mb-2';
        }
    }

    updateMetrics() {
        if (!this.isTracking || !this.startTime) return;
        
        const now = new Date();
        const elapsed = Math.floor((now - this.startTime) / 1000);
        const hours = Math.floor(elapsed / 3600);
        const minutes = Math.floor((elapsed % 3600) / 60);
        
        // Calculate productive time (85% of total time as example)
        const productiveSeconds = Math.floor(elapsed * 0.85);
        const productiveHours = Math.floor(productiveSeconds / 3600);
        const productiveMinutes = Math.floor((productiveSeconds % 3600) / 60);
        
        // Update displays - only if elements exist
        const productiveElement = document.getElementById('productiveTime');
        if (productiveElement && !document.querySelector('input[name^="hours["]')) {
            productiveElement.innerHTML = 
                `${productiveHours}<span class="text-sm">h</span> ${productiveMinutes.toString().padStart(2, '0')}<span class="text-sm">m</span>`;
        }
        
        const totalElement = document.getElementById('totalTime');
        if (totalElement && !document.querySelector('input[name^="hours["]')) {
            totalElement.innerHTML = 
                `${hours}<span class="text-sm">h</span> ${minutes.toString().padStart(2, '0')}<span class="text-sm">m</span>`;
        }
        
        const timeAtWorkElement = document.getElementById('timeAtWork');
        if (timeAtWorkElement && !document.querySelector('input[name^="hours["]')) {
            timeAtWorkElement.innerHTML = 
                `${hours}<span class="text-sm">h</span> ${minutes.toString().padStart(2, '0')}<span class="text-sm">m</span>`;
        }
        
        // Update effectiveness and productivity scores
        const effectiveness = Math.min(100, 30 + (elapsed / 3600) * 15);
        const productivity = Math.min(100, 80 + Math.random() * 15);
        
        const effectivenessElement = document.getElementById('effectiveness');
        if (effectivenessElement) {
            effectivenessElement.textContent = `${effectiveness.toFixed(2)}%`;
        }
        
        const productivityScoreElement = document.getElementById('productivityScore');
        if (productivityScoreElement) {
            productivityScoreElement.textContent = `${productivity.toFixed(2)}%`;
        }
    }

    renderProductivityChart() {
        const chart = document.getElementById('productivityChart');
        if (!chart) return;
        
        const hours = [];
        
        // Generate hourly data
        for (let i = 7; i <= 18; i++) {
            const hour = i <= 12 ? `${i} AM` : `${i - 12} PM`;
            if (i === 12) hour = '12 PM';
            
            const productive = Math.random() * 60 + 20;
            const neutral = Math.random() * 20 + 5;
            const unproductive = Math.random() * 15 + 2;
            const total = productive + neutral + unproductive;
            
            hours.push({
                hour: i,
                productive: (productive / total) * 100,
                neutral: (neutral / total) * 100,
                unproductive: (unproductive / total) * 100
            });
        }
        
        chart.innerHTML = `
            <div class="flex items-end h-full gap-1 px-2">
                ${hours.map(data => `
                    <div class="flex-1 flex flex-col justify-end h-full">
                        <div class="w-full bg-gradient-to-t from-green-400 to-green-500 rounded-t-sm transition-all duration-300 hover:opacity-80" 
                             style="height: ${data.productive}%"
                             title="Productive: ${data.productive.toFixed(1)}%"></div>
                        <div class="w-full bg-gradient-to-t from-blue-400 to-blue-500 transition-all duration-300 hover:opacity-80" 
                             style="height: ${data.neutral}%"
                             title="Neutral: ${data.neutral.toFixed(1)}%"></div>
                        <div class="w-full bg-gradient-to-t from-red-400 to-red-500 rounded-b-sm transition-all duration-300 hover:opacity-80" 
                             style="height: ${data.unproductive}%"
                             title="Unproductive: ${data.unproductive.toFixed(1)}%"></div>
                    </div>
                `).join('')}
            </div>
        `;
    }

    renderAppLists() {
        // Render productive apps
        const productiveList = document.getElementById('productiveAppsList');
        if (productiveList) {
            productiveList.innerHTML = this.apps.productive.map(app => `
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="text-lg">${app.icon}</span>
                        <div>
                            <div class="font-medium text-gray-900 dark:text-white text-sm">${app.name}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">${app.time}</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-semibold text-gray-900 dark:text-white">${app.percentage}%</div>
                        <div class="w-16 bg-gray-200 dark:bg-gray-600 rounded-full h-1.5 mt-1">
                            <div class="bg-green-500 h-1.5 rounded-full transition-all duration-300" style="width: ${app.percentage}%"></div>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        // Render neutral apps
        const neutralList = document.getElementById('neutralAppsList');
        if (neutralList) {
            neutralList.innerHTML = this.apps.neutral.map(app => `
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="text-lg">${app.icon}</span>
                        <div>
                            <div class="font-medium text-gray-900 dark:text-white text-sm">${app.name}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">${app.time}</div>
                        </div>
                    </div>
                </div>
            `).join('');
        }
    }

    setupEventListeners() {
        // Mode buttons
        const dayBtn = document.getElementById('dayModeBtn');
        const weekBtn = document.getElementById('weekModeBtn');
        const monthBtn = document.getElementById('monthModeBtn');
        
        if (dayBtn) dayBtn.addEventListener('click', () => this.switchMode('day'));
        if (weekBtn) weekBtn.addEventListener('click', () => this.switchMode('week'));
        if (monthBtn) monthBtn.addEventListener('click', () => this.switchMode('month'));
        
        // Period navigation
        const prevBtn = document.getElementById('prevPeriod');
        const nextBtn = document.getElementById('nextPeriod');
        
        if (prevBtn) prevBtn.addEventListener('click', () => this.navigatePeriod(-1));
        if (nextBtn) nextBtn.addEventListener('click', () => this.navigatePeriod(1));
    }

    switchMode(mode) {
        this.currentMode = mode;
        
        // Update button states
        document.querySelectorAll('[id$="ModeBtn"]').forEach(btn => {
            btn.className = 'px-4 py-2 text-sm font-medium rounded-md transition-all duration-200 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white';
        });
        
        const activeBtn = document.getElementById(`${mode}ModeBtn`);
        if (activeBtn) {
            activeBtn.className = 
                'px-4 py-2 text-sm font-medium rounded-md transition-all duration-200 bg-white dark:bg-gray-600 text-blue-600 dark:text-blue-400 shadow-sm';
        }
        
        this.updateCurrentPeriod();
        this.renderProductivityChart();
    }

    navigatePeriod(direction) {
        const multiplier = this.currentMode === 'day' ? 1 : this.currentMode === 'week' ? 7 : 30;
        this.currentDate.setDate(this.currentDate.getDate() + (direction * multiplier));
        this.updateCurrentPeriod();
        this.renderProductivityChart();
    }

    startRealTimeUpdates() {
        // Update every minute
        setInterval(() => {
            this.updateDateTime();
            this.updateMetrics();
        }, 60000);
        
        // Update every 10 seconds for more responsive metrics
        setInterval(() => {
            this.updateMetrics();
        }, 10000);
    }
}

// Initialize dashboard when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    new TimesheetDashboard();
});

// Desktop integration (if available)
if (window.timesheetAPI) {
    console.log('Desktop app integration active');
    
    // Enhanced desktop integration
    window.timesheetAPI.mode.get().then(modeInfo => {
        console.log('Desktop app mode:', modeInfo);
    });
    
    // Listen for desktop app events
    window.timesheetAPI.mode.onChange((modeInfo) => {
        console.log('Desktop app mode changed:', modeInfo);
    });
}
    </script>

<style>
/* Custom scrollbar for app lists */
#productiveAppsList::-webkit-scrollbar,
#neutralAppsList::-webkit-scrollbar {
    width: 4px;
}

#productiveAppsList::-webkit-scrollbar-track,
#neutralAppsList::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 2px;
}

#productiveAppsList::-webkit-scrollbar-thumb,
#neutralAppsList::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 2px;
}

#productiveAppsList::-webkit-scrollbar-thumb:hover,
#neutralAppsList::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

/* Chart hover effects */
#productivityChart .flex-1:hover {
    transform: scale(1.05);
    transition: transform 0.2s ease;
}

/* Smooth animations */
.transition-all {
    transition: all 0.3s ease;
}

/* Card hover effects */
.bg-white:hover,
.dark .dark\:bg-gray-800:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}
</style>
</x-app-layout>