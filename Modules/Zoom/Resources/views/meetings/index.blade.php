@section('title', 'Zoom Meetings')

<x-app-layout>
    <!-- Breadcrumb Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 mt-6">
        <x-breadcrumb :items="[
            [
                'label' => __('Communication'),
                'url' => '#',
                'icon' => false
            ],
            [
                'label' => __('Zoom Meetings'),
                'icon' => true
            ]
        ]" />
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white dark:bg-slate-800 shadow-2xl rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-slate-700 dark:to-slate-800 px-8 py-8 border-b border-gray-200 dark:border-gray-600">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div class="mb-6 lg:mb-0">
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white flex items-center">
                            <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            {{ __('Zoom Meetings') }}
                        </h2>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Manage your virtual meetings and video conferences efficiently.') }}
                        </p>
                    </div>
                    
                    <!-- Meeting Statistics -->
                    <div class="flex items-center space-x-6">
                        <div class="text-center">
                            <div class="flex items-center justify-center w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-lg mb-2">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('Total Meetings') }}</div>
                            <div class="text-lg font-bold text-green-600 dark:text-green-400">{{ $meetings->total() }}</div>
                        </div>
                        <div class="text-center">
                            <div class="flex items-center justify-center w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg mb-2">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('This Page') }}</div>
                            <div class="text-lg font-bold text-blue-600 dark:text-blue-400">{{ $meetings->count() }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="p-8">
                <!-- Search and Actions Bar -->
                <div class="bg-gradient-to-r from-gray-50 to-blue-50 dark:from-gray-800 dark:to-gray-700 rounded-2xl p-6 mb-8 border border-gray-200 dark:border-gray-600">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                        <!-- Enhanced Search -->
                        <div class="flex-1 max-w-2xl">
                            <form action="{{ route('zoom.meeting.index') }}" method="GET" class="relative">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                        </svg>
                                    </div>
                                    <input type="text" 
                                           id="search" 
                                           name="search" 
                                           class="block w-full pl-10 pr-20 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                           placeholder="{{ __('Search meetings by topic, host email, or meeting ID...') }}"
                                           value="{{ request('search') }}">
                                    <button type="submit" 
                                            class="absolute inset-y-0 right-0 flex items-center px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-r-xl transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        {{ __('Search') }}
                                    </button>
                    </div>
                </form>
                        </div>

                        <!-- Create Meeting Button -->
                @can('Zoom Meeting create')
                        <div class="flex-shrink-0">
                <a href="{{ route('zoom.meeting.create') }}"
                               class="group inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-green-500/50">
                                <div class="flex items-center justify-center w-5 h-5 bg-white/20 rounded-lg mr-3">
                                    <svg class="w-3 h-3 transition-transform duration-200 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                                    </svg>
                                </div>
                                {{ __('Create Meeting') }}
                                <svg class="w-4 h-4 ml-3 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5-5 5M6 12h12"/>
                                </svg>
                            </a>
                        </div>
                @endcan
            </div>

                    <!-- Quick Filters -->
                    <div class="mt-6 flex flex-wrap gap-3">
                        <button type="button" onclick="filterMeetings('all')" class="filter-btn active-filter px-4 py-2 text-sm font-medium rounded-lg bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300 border border-blue-200 dark:border-blue-700 hover:bg-blue-200 dark:hover:bg-blue-800/50 transition-all duration-200">
                            {{ __('All Meetings') }}
                        </button>
                        <button type="button" onclick="filterMeetings('today')" class="filter-btn px-4 py-2 text-sm font-medium rounded-lg bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-600 hover:bg-gray-200 dark:hover:bg-gray-600 transition-all duration-200">
                            {{ __('Today') }}
                        </button>
                        <button type="button" onclick="filterMeetings('upcoming')" class="filter-btn px-4 py-2 text-sm font-medium rounded-lg bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-600 hover:bg-gray-200 dark:hover:bg-gray-600 transition-all duration-200">
                            {{ __('Upcoming') }}
                        </button>
                        <button type="button" onclick="filterMeetings('waiting')" class="filter-btn px-4 py-2 text-sm font-medium rounded-lg bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-600 hover:bg-gray-200 dark:hover:bg-gray-600 transition-all duration-200">
                            {{ __('Waiting') }}
                        </button>
                    </div>
                </div>

                <!-- Meetings Table -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <!-- Table Header -->
                    <div class="bg-gray-50 dark:bg-gray-900 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ __('Meeting Schedule') }}
                        </h3>
                    </div>

                    <!-- Table Content -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 dark:bg-gray-900">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                            </svg>
                                            <span>{{ __('Meeting Details') }}</span>
                                        </div>
                                        </th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Host Information') }}</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Schedule') }}</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Access') }}</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Status') }}</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                            <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($meetings as $meeting)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200 meeting-row" data-meeting-status="{{ strtolower($meeting->status ?? 'waiting') }}">
                                    <!-- Meeting Details -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-12 h-12">
                                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                                                    {{ $meeting->topic ?? __('Untitled Meeting') }}
                                                </div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400 flex items-center mt-1">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                                    </svg>
                                                    #{{ $meeting->meeting_id ?? 'N/A' }}
                                                </div>
                                                </div>
                                            </div>
                                        </td>

                                    <!-- Host Information -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mr-3">
                                                <svg class="w-4 h-4 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                    {{ $meeting->host_email ?? __('No Host') }}
                                                </div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('Meeting Host') }}</div>
                                            </div>
                                        </div>
                                        </td>

                                    <!-- Schedule -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $meeting->start_time ? \Carbon\Carbon::parse($meeting->start_time)->format('M d, Y') : __('Not Scheduled') }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $meeting->start_time ? \Carbon\Carbon::parse($meeting->start_time)->format('g:i A') : '' }}
                                        </div>
                                        </td>

                                    <!-- Access -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="space-y-2">
                                            @if($meeting->join_url)
                                            <a href="{{ $meeting->join_url }}" 
                                               target="_blank"
                                               class="inline-flex items-center px-3 py-1.5 bg-blue-100 hover:bg-blue-200 text-blue-800 text-xs font-medium rounded-lg border border-blue-200 transition-all duration-200 hover:scale-105">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                                </svg>
                                                {{ __('Join Meeting') }}
                                            </a>
                                            @endif
                                            @if($meeting->password)
                                            <div class="text-xs text-gray-500 dark:text-gray-400 flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                                </svg>
                                                {{ __('Password') }}: {{ $meeting->password }}
                                            </div>
                                            @endif
                                        </div>
                                    </td>

                                    <!-- Status -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusClass = match(strtolower($meeting->status ?? 'waiting')) {
                                                'started', 'live' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
                                                'ended', 'finished' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
                                                'waiting' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300',
                                                default => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300'
                                            };
                                            $statusIcon = match(strtolower($meeting->status ?? 'waiting')) {
                                                'started', 'live' => 'bg-green-500',
                                                'ended', 'finished' => 'bg-gray-500',
                                                'waiting' => 'bg-yellow-500',
                                                default => 'bg-blue-500'
                                            };
                                        @endphp
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $statusClass }}">
                                            <div class="w-2 h-2 rounded-full mr-2 {{ $statusIcon }}"></div>
                                            {{ ucfirst($meeting->status ?? 'Waiting') }}
                                        </span>
                                    </td>

                                    <!-- Actions -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-3">
                                                <a href="{{ route('project.edit', $meeting->id) }}"
                                               class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition-colors duration-200"
                                               title="{{ __('Edit Meeting') }}">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
                                                    </svg>
                                                </a>
                                            <button onclick="showDeleteConfirmation('{{ $meeting->id }}')" 
                                                    class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 transition-colors duration-200"
                                                    title="{{ __('Delete Meeting') }}">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                            <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">{{ __('No meetings found') }}</p>
                                            <p class="text-gray-400 dark:text-gray-500 text-sm mt-2">{{ __('Create your first meeting to get started with video conferencing') }}</p>
                                            @can('Zoom Meeting create')
                                            <a href="{{ route('zoom.meeting.create') }}" 
                                               class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                </svg>
                                                {{ __('Create Meeting') }}
                                            </a>
                                            @endcan
                                        </div>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                    </div>

                    <!-- Pagination -->
                    @if ($meetings->total() > $meetings->count())
                    <div class="bg-gray-50 dark:bg-gray-900 px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex items-center justify-center">
                            {{ $meetings->links() }}
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Help Section -->
                <div class="mt-8 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-semibold text-blue-800 dark:text-blue-300 mb-2">{{ __('Meeting Management Tips') }}</h3>
                            <div class="text-sm text-blue-700 dark:text-blue-400 space-y-2">
                                <p class="flex items-start">
                                    <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ __('Use descriptive meeting topics to help participants identify the purpose') }}
                                </p>
                                <p class="flex items-start">
                                    <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ __('Set meeting passwords for security and share them separately with participants') }}
                                </p>
                                <p class="flex items-start">
                                    <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ __('Schedule meetings in advance and send calendar invitations to ensure attendance') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add smooth entrance animation
            const cards = document.querySelectorAll('.bg-white, .bg-gradient-to-r');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });

        // Enhanced filtering system
        function filterMeetings(filter) {
            const rows = document.querySelectorAll('.meeting-row');
            const filterBtns = document.querySelectorAll('.filter-btn');
            
            // Update button styles
            filterBtns.forEach(btn => {
                btn.classList.remove('active-filter', 'bg-blue-100', 'text-blue-800', 'dark:bg-blue-900/30', 'dark:text-blue-300', 'border-blue-200', 'dark:border-blue-700');
                btn.classList.add('bg-gray-100', 'text-gray-800', 'dark:bg-gray-700', 'dark:text-gray-300', 'border-gray-200', 'dark:border-gray-600');
            });
            
            event.target.classList.remove('bg-gray-100', 'text-gray-800', 'dark:bg-gray-700', 'dark:text-gray-300', 'border-gray-200', 'dark:border-gray-600');
            event.target.classList.add('active-filter', 'bg-blue-100', 'text-blue-800', 'dark:bg-blue-900/30', 'dark:text-blue-300', 'border-blue-200', 'dark:border-blue-700');
            
            // Filter rows
            rows.forEach(row => {
                const meetingStatus = row.dataset.meetingStatus;
                let shouldShow = true;
                
                switch(filter) {
                    case 'today':
                        // Implementation would need backend support for date filtering
                        shouldShow = true;
                        break;
                    case 'upcoming':
                        shouldShow = meetingStatus === 'waiting';
                        break;
                    case 'waiting':
                        shouldShow = meetingStatus === 'waiting';
                        break;
                    case 'all':
                    default:
                        shouldShow = true;
                        break;
                }
                
                if (shouldShow) {
                    row.style.display = '';
                    row.style.animation = 'fadeIn 0.3s ease-in';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Enhanced delete confirmation
        function showDeleteConfirmation(meetingId) {
            Swal.fire({
                title: '{{ __("Delete Meeting") }}',
                text: '{{ __("Are you sure you want to delete this meeting? This action cannot be undone.") }}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '{{ __("Yes, Delete") }}',
                cancelButtonText: '{{ __("Cancel") }}',
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                backdrop: true,
                allowOutsideClick: false,
                customClass: {
                    popup: 'rounded-xl',
                    confirmButton: 'rounded-lg',
                    cancelButton: 'rounded-lg'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading state
                    Swal.fire({
                        title: '{{ __("Deleting Meeting...") }}',
                        text: '{{ __("Please wait while we delete the meeting.") }}',
                        icon: 'info',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    
                    // Redirect to delete route
                    window.location.href = `{{ route('project.destroy', '') }}/${meetingId}`;
                }
            });
        }

        // Add CSS for animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
        `;
        document.head.appendChild(style);
    </script>
</x-app-layout>