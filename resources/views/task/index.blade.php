@section('title')
    {{ 'List Task' }}
@endsection

<!-- Add Select2 CSS and JS in the head section -->
<style>
    @keyframes rotateMinuteHand {
        0% {
            transform: rotate(0deg);
            transform-origin: center;
        }

        100% {
            transform: rotate(360deg);
            transform-origin: center;
        }
    }

    @keyframes rotateHourHand {
        0% {
            transform: rotate(0deg);
            transform-origin: center;
        }

        100% {
            transform: rotate(360deg);
            transform-origin: center;
        }
    }

    /* Apply the animation to the minute hand */
    .clock-minute-hand {
        animation: rotateMinuteHand 5s linear infinite;
        transform-origin: 12px 12px;
        /* Center the rotation */
    }

    /* Apply the animation to the hour hand */
    .clock-hour-hand {
        animation: rotateHourHand 43200s linear infinite;
        /* 12 hours in seconds */
        transform-origin: 12px 12px;
        /* Center the rotation */
    }

    .select2-container--classic .select2-selection--single {
        height: 38px !important;
        border: 1px solid #d1d5db !important;
        border-radius: 0.375rem !important;
    }
    .select2-container--classic .select2-selection--single .select2-selection__rendered {
        line-height: 38px !important;
        padding-left: 12px !important;
    }
    .select2-container--classic .select2-selection--single .select2-selection__arrow {
        height: 36px !important;
    }
    .select2-container--classic .select2-results__option {
        padding: 8px 12px !important;
    }
    .select2-container--classic .select2-results__option--highlighted[aria-selected] {
        background-color: #4f46e5 !important;
    }
    .select2-container--classic .select2-search--dropdown .select2-search__field {
        border: 1px solid #d1d5db !important;
        border-radius: 0.375rem !important;
        padding: 6px !important;
    }
    .select2-container--classic .select2-results__option[aria-selected=true] {
        background-color: #e5e7eb !important;
    }
    .select2-container--classic .select2-results__option--highlighted[aria-selected] {
        background-color: #4f46e5 !important;
        color: white !important;
    }
    .select2-container--classic .select2-results__option {
        color: #374151 !important;
    }
    .dark .select2-container--classic .select2-selection--single {
        background-color: #1f2937 !important;
        border-color: #4b5563 !important;
    }
    .dark .select2-container--classic .select2-selection--single .select2-selection__rendered {
        color: #e5e7eb !important;
    }
    .dark .select2-container--classic .select2-results__option {
        background-color: #1f2937 !important;
        color: #e5e7eb !important;
    }
    .dark .select2-container--classic .select2-search--dropdown .select2-search__field {
        background-color: #1f2937 !important;
        color: #e5e7eb !important;
        border-color: #4b5563 !important;
    }
</style>


<x-app-layout>
    <div class="relative m-6">
        <div>
            <div class="my-8 card flex flex-col md:flex-row gap-4 md:justify-between items-start md:items-center">
                <div class="flex items-center gap-4 w-full">
                    <!-- Search Input -->
                    <div class="flex-1 mt-4">
                        <form action="{{ route('task.index') }}" method="GET" class="flex gap-2">
                            <input type="text" id="search" name="search" 
                                class="border border-gray-300 text-text-light dark:text-text-dark text-sm rounded-md focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-card-dark bg-card-light dark:border-gray-600 dark:placeholder-gray-400 dark:text-text-dark dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                placeholder="{{ __('Search by task, client, employer or employee') }}"
                                value="{{ request('search') }}" />
                            <button type="submit" class="bg-primary-50 text-text-light dark:text-text-dark px-4 py-2 rounded-lg">
                                <i class="fa-solid fa-search"></i>
                            </button>
                        </form>
                    </div>

                    <!-- Filter Button -->
                    <button type="button" onclick="openFilterModal()" class="bg-primary-50 text-text-light dark:text-text-dark px-4 py-2 rounded-lg flex items-center gap-2">
                        <i class="fa-solid fa-filter"></i> {{ __('Filters') }}
                        @if(request('status') || request('client_id') || request('employer_id') || request('employee_id') || request('start_date') || request('end_date'))
                            <span class="bg-primary-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
                                {{ (request('status') ? 1 : 0) + (request('client_id') ? 1 : 0) + (request('employer_id') ? 1 : 0) + (request('employee_id') ? 1 : 0) + (request('start_date') ? 1 : 0) + (request('end_date') ? 1 : 0) }}
                            </span>
                        @endif
                    </button>

                    <!-- Create Task Button -->
                    <a href="{{ route('task.create') }}" class="bg-primary-50 text-text-light dark:text-text-dark px-4 py-2 rounded-lg">
                        <i class="fa-solid fa-plus"></i> {{ __('Create Task') }}
                    </a>
                </div>
            </div>
            <!-- Start heading here -->
            <div class="flex flex-wrap">
                <div class="w-full ">
                    <div class="dashboard-right ps-0 ">
                        <div class="card overflow-x-auto !p-0 !rounded-md">
                            <h2 class="text-2xl font-bold p-4 text-text-light dark:text-text-dark">
                                {{ __('Latest Tasks') }}</h2>
                                <div class="max-w-full">
                                    <table
                                        class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        <thead class="table-header">
                                            <tr>
                                                <th scope="col" class="">
                                                    {{ __('Task Name') }}
                                                </th>
                                                <th scope="col" class="">
                                                    {{ __('Client Name') }}
                                                </th>
                                                <th scope="col" class="">
                                                    {{ __('Employer Name') }}
                                                </th>
                                                <th scope="col" class="">
                                                    {{ __('Employee Name') }}
                                                </th>
                                                <th scope="col" class="">
                                                    {{ __('Time Spent') }}
                                                </th>
                                                <th scope="col" class="text-center">
                                                    {{ __('Status') }}
                                                </th>
                                                <th scope="col" class="">
                                                    {{ __('Action') }}
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if ($tasks->count() > 0)
                                                @foreach ($tasks as $key => $task)
                                                    <tr
                                                        class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                                        <th scope="row"
                                                            class="flex items-center px-4 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                                            <div class="">
                                                                <div class="text-base font-semibold">
                                                                    {{ $task->task_name ?? '' }}</div>
                                                            </div>
                                                        </th>
                                                        <td class="px-6 py-4">
                                                            <a rel="noopener noreferrer">
                                                                {{ $task->project->client->client_name ?? '' }}
                                                            </a>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <a rel="noopener noreferrer">
                                                                {{ $task->employer->employer_name ?? '' }}
                                                            </a>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <a rel="noopener noreferrer">
                                                                {{ $task->employee->employee_name ?? '' }}
                                                            </a>
                                                        </td>
                                                        <td class="px-6 py-4 flex items-center  gap-2">
                                                            <!-- Centered alignment -->
                                                            <div id="timer-{{ $task->id }}"
                                                                class="text-center font-bold w-10">
                                                                <!-- Added font-bold for emphasis -->
                                                                {{ $task->time ?? '00:00' }}
                                                            </div>
                                                            <div class="flex gap-2">
                                                                <button onclick="startTimer({{ $task->id }})"
                                                                    id="start-btn-{{ $task->id }}"
                                                                    class="bg-green-500 text-white px-3 py-2 rounded-lg flex items-center justify-center">
                                                                    <!-- Consistent padding -->
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 16 16" fill="currentColor"
                                                                        class="size-4">
                                                                        <path
                                                                            d="M1 4.804a1 1 0 0 1 1.53-.848l5.113 3.196a1 1 0 0 1 0 1.696L2.53 12.044A1 1 0 0 1 1 11.196V4.804ZM13.5 4.5A.5.5 0 0 1 14 4h.5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5H14a.5.5 0 0 1-.5-.5v-7ZM10.5 4a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .5.5h.5a.5.5 0 0 0 .5-.5v-7A.5.5 0 0 0 11 4h-.5Z" />
                                                                    </svg>

                                                                </button>
                                                                <button onclick="stopTimer({{ $task->id }})"
                                                                    id="stop-btn-{{ $task->id }}"
                                                                    class="bg-red-400 text-text-light dark:text-text-dark px-3 py-2 rounded-lg hidden flex items-center justify-center gap-2">
                                                                    <!-- Added gap -->
                                                                    <!-- First SVG icon -->
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        width="20" height="20"
                                                                        viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        aria-hidden="true">
                                                                        <circle cx="12" cy="12" r="10">
                                                                        </circle>
                                                                        <!-- Minute hand -->
                                                                        <polyline points="12 6 12 12"
                                                                            class="clock-minute-hand">
                                                                        </polyline>
                                                                        <!-- Hour hand -->
                                                                        <polyline points="12 12 16 14"
                                                                            class="clock-hour-hand">
                                                                        </polyline>
                                                                    </svg>
                                                                    <!-- Second SVG icon -->
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 16 16" fill="currentColor"
                                                                        class="size-4">
                                                                        <path fill-rule="evenodd"
                                                                            d="M15 8A7 7 0 1 1 1 8a7 7 0 0 1 14 0ZM5.5 5.5A.5.5 0 0 1 6 5h.5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-.5.5H6a.5.5 0 0 1-.5-.5v-5Zm4-.5a.5.5 0 0 0-.5.5v5a.5.5 0 0 0 .5.5h.5a.5.5 0 0 0 .5-.5v-5A.5.5 0 0 0 10 5h-.5Z"
                                                                            clip-rule="evenodd" />
                                                                    </svg>
                                                                </button>

                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <div class="flex items-center gap-2 justify-center">
                                                                <div class="h-2.5 w-2.5 rounded-full"
                                                                    id="statusIndicator"
                                                                    style="background-color: {{ $task->status === 'completed' ? 'green' : ($task->status === 'inprogress' ? 'blue' : 'red') }};">
                                                                </div>
                                                                <form id="statusForm{{ $task->id }}"
                                                                    action="{{ route('task.updateStatus', $task->id) }}"
                                                                    method="post" class="mb-0">
                                                                    @csrf
                                                                    <select name="status" id="status"
                                                                        class="border-none bg-transparent text-gray-900 dark:text-white focus:outline-none"
                                                                        onchange="document.getElementById('statusForm{{ $task->id }}').submit()">
                                                                        <option
                                                                            class="dark:bg-slate-800   text-text-light dark:text-text-dark  "
                                                                            value="pending"
                                                                            {{ $task->status === 'pending' ? 'selected' : '' }}>
                                                                            {{ __('Pending') }}
                                                                        </option>
                                                                        <option
                                                                            class="dark:bg-slate-800   text-text-light  dark:text-text-dark  "
                                                                            value="inprogress"
                                                                            {{ $task->status === 'inprogress' ? 'selected' : '' }}>
                                                                            {{ __('In Progress') }}
                                                                        </option>
                                                                        <option
                                                                            class="dark:bg-slate-800   text-text-light  dark:text-text-dark  "
                                                                            value="completed"
                                                                            {{ $task->status === 'completed' ? 'selected' : '' }}>
                                                                            {{ __('Complete') }}
                                                                        </option>
                                                                    </select>
                                                                </form>
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <div class="flex space-x-2">
                                                                <a href="{{ route('task.edit', $task->id) }}"
                                                                    class="text-primary-50 hover:text-primary-300">
                                                                    <x-svgs.edit />
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="8" class="text-center py-8">
                                                        <x-svgs.no-data-found
                                                            class="mx-auto md:size-[360px] size-[220px]" />
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="d-flex justify-content-center">
                                    {{ $tasks->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Start content here -->
        </div>
    </div>

    <!-- Filter Modal -->
    <div id="filterModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto z-50"  width="10%">
        <div class="relative top-20 mx-auto p-4 border !w-[500px] shadow-lg rounded-md bg-white dark:bg-card-dark" style="width: 500px;">
            <div class="flex items-center justify-between mb-3 pb-2 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-base font-medium text-text-light dark:text-text-dark">
                    {{ __('Advanced Filters') }}
                </h3>
                <button onclick="closeFilterModal()" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form action="{{ route('task.index') }}" method="GET" class="space-y-3">
                <!-- Preserve search parameter -->
                <input type="hidden" name="search" value="{{ request('search') }}">

                <!-- Status Filter -->
                <div>
                    <label for="status" class="block text-xs font-medium text-text-light dark:text-text-dark mb-1">
                        {{ __('Status') }}
                    </label>
                    <select id="status" name="status" 
                        class="text-sm w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-card-dark dark:border-gray-600 dark:text-text-dark">
                        <option value="">{{ __('All Status') }}</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                        <option value="inprogress" {{ request('status') == 'inprogress' ? 'selected' : '' }}>{{ __('In Progress') }}</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>{{ __('Completed') }}</option>
                    </select>
                </div>

                <!-- Client Filter -->
                <div>
                    <label for="client_id" class="block text-xs font-medium text-text-light dark:text-text-dark mb-1">
                        {{ __('Client') }}
                    </label>
                    <select id="client_id" name="client_id" 
                        class="text-sm w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-card-dark dark:border-gray-600 dark:text-text-dark select2-ajax">
                        <option value="">{{ __('All Clients') }}</option>
                        @if(request('client_id') && isset($selectedClient))
                            <option value="{{ request('client_id') }}" selected>
                                {{ $selectedClient->client_name }}
                            </option>
                        @endif
                    </select>
                </div>

                <!-- Employer Filter -->
                <div>
                    <label for="employer_id" class="block text-xs font-medium text-text-light dark:text-text-dark mb-1">
                        {{ __('Employer') }}
                    </label>
                    <select id="employer_id" name="employer_id" 
                        class="text-sm w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-card-dark dark:border-gray-600 dark:text-text-dark select2-ajax">
                        <option value="">{{ __('All Employers') }}</option>
                        @if(request('employer_id') && isset($selectedEmployer))
                            <option value="{{ request('employer_id') }}" selected>
                                {{ $selectedEmployer->employer_name }}
                            </option>
                        @endif
                    </select>
                </div>

                <!-- Employee Filter -->
                <div>
                    <label for="employee_id" class="block text-xs font-medium text-text-light dark:text-text-dark mb-1">
                        {{ __('Employee') }}
                    </label>
                    <select id="employee_id" name="employee_id" 
                        class="text-sm w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-card-dark dark:border-gray-600 dark:text-text-dark select2-ajax">
                        <option value="">{{ __('All Employees') }}</option>
                        @if(request('employee_id') && isset($selectedEmployee))
                            <option value="{{ request('employee_id') }}" selected>
                                {{ $selectedEmployee->employee_name }}
                            </option>
                        @endif
                    </select>
                </div>

                <!-- Date Range Filters -->
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label for="start_date" class="block text-xs font-medium text-text-light dark:text-text-dark mb-1">
                            {{ __('Start Date') }}
                        </label>
                        <input type="date" id="start_date" name="start_date" 
                            class="text-sm w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-card-dark dark:border-gray-600 dark:text-text-dark"
                            value="{{ request('start_date') }}" />
                    </div>
                    <div>
                        <label for="end_date" class="block text-xs font-medium text-text-light dark:text-text-dark mb-1">
                            {{ __('End Date') }}
                        </label>
                        <input type="date" id="end_date" name="end_date" 
                            class="text-sm w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-card-dark dark:border-gray-600 dark:text-text-dark"
                            value="{{ request('end_date') }}" />
                    </div>
                </div>

                <!-- Filter Buttons -->
                <div class="flex justify-end gap-2 pt-2 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('task.index') }}" 
                        class="text-sm px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md transition duration-200">
                        {{ __('Reset') }}
                    </a>
                    <button type="submit" 
                        class="text-sm px-3 py-1.5 bg-primary-50 hover:bg-primary-50 text-white rounded-md transition duration-200">
                        {{ __('Apply') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    let timers = {}; // Store intervals for each task timer

    // Load saved timer states when the page loads
    window.addEventListener('load', () => {
        // Get all saved timer states from localStorage
        const savedTimers = JSON.parse(localStorage.getItem('timerStates') || '{}');

        // Restore each active timer
        Object.keys(savedTimers).forEach(taskId => {
            const timerState = savedTimers[taskId];
            if (timerState.isRunning) {
                // Calculate elapsed time since last save
                const lastUpdate = new Date(timerState.lastUpdate);
                const currentTime = new Date();
                const elapsedMinutes = Math.floor((currentTime - lastUpdate) / 60000);

                // Update the display with accumulated time
                const [hours, minutes] = timerState.time.split(':').map(Number);
                const totalMinutes = hours * 60 + minutes + elapsedMinutes;
                const newHours = Math.floor(totalMinutes / 60);
                const newMinutes = totalMinutes % 60;

                // Update display
                const timerDisplay = document.getElementById(`timer-${taskId}`);
                if (timerDisplay) {
                    timerDisplay.innerText =
                        `${String(newHours).padStart(2, '0')}:${String(newMinutes).padStart(2, '0')}`;

                    // Restart the timer
                    startTimer(taskId, true);

                    // Update button states
                    const startBtn = document.getElementById(`start-btn-${taskId}`);
                    const stopBtn = document.getElementById(`stop-btn-${taskId}`);
                    if (startBtn && stopBtn) {
                        startBtn.classList.add('hidden');
                        stopBtn.classList.remove('hidden');
                    }
                }
            }
        });
    });

    function startTimer(taskId, isRestore = false) {
        const timerDisplay = document.getElementById(`timer-${taskId}`);
        const startBtn = document.getElementById(`start-btn-${taskId}`);
        const stopBtn = document.getElementById(`stop-btn-${taskId}`);

        let [hours, minutes] = timerDisplay.innerText.split(':').map(Number);

        // Save initial state
        saveTimerState(taskId, {
            isRunning: true,
            time: timerDisplay.innerText,
            lastUpdate: new Date().toISOString()
        });

        timers[taskId] = setInterval(() => {
            minutes++;
            if (minutes === 60) {
                minutes = 0;
                hours++;
            }
            const newTime = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}`;
            timerDisplay.innerText = newTime;

            // Save updated state
            saveTimerState(taskId, {
                isRunning: true,
                time: newTime,
                lastUpdate: new Date().toISOString()
            });

            // Update the time in the database
            updateTimeInDatabase(taskId, newTime);
        }, 60000); // Update every 1 minute

        startBtn.classList.add('hidden');
        stopBtn.classList.remove('hidden');
    }

    function stopTimer(taskId) {
        const stopBtn = document.getElementById(`stop-btn-${taskId}`);
        const startBtn = document.getElementById(`start-btn-${taskId}`);
        const timerDisplay = document.getElementById(`timer-${taskId}`);

        clearInterval(timers[taskId]);

        // Save stopped state
        saveTimerState(taskId, {
            isRunning: false,
            time: timerDisplay.innerText,
            lastUpdate: new Date().toISOString()
        });

        stopBtn.classList.add('hidden');
        startBtn.classList.remove('hidden');
    }

    function saveTimerState(taskId, state) {
        const savedTimers = JSON.parse(localStorage.getItem('timerStates') || '{}');
        savedTimers[taskId] = state;
        localStorage.setItem('timerStates', JSON.stringify(savedTimers));
    }

    function updateTimeInDatabase(taskId, time) {
        fetch(`/tasks/${taskId}/update-time`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                time: time
            })
        });
    }
</script>

<script>
    function showConfirmation(id) {
        Swal.fire({
            title: 'Want to delete this Task!',
            text: "{{ __('If you are ready?') }}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: "{{ __('Yes') }}",
            cancelButtonText: "{{ __('Cancel') }}",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/task/destroy/" + id;
            }
        });
    }
</script>

<script>
    function openFilterModal() {
        document.getElementById('filterModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }

    function closeFilterModal() {
        document.getElementById('filterModal').classList.add('hidden');
        document.body.style.overflow = ''; // Restore scrolling
    }

    // Close modal when clicking outside
    document.getElementById('filterModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeFilterModal();
        }
    });

    // Close modal when pressing Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeFilterModal();
        }
    });
</script>

<!-- Make sure jQuery is loaded first -->

<script>
    $(document).ready(function() {
        // Initialize Select2 for all select elements with select2-ajax class
        $('.select2-ajax').each(function() {
            const $select = $(this);
            const id = $select.attr('id');
            let url = '';
            let currentRequest = null;
            
            // Set the appropriate URL based on the select element's ID
            switch(id) {
                case 'client_id':
                    url = '{{ route("ajax.clients") }}';
                    break;
                case 'employer_id':
                    url = '{{ route("ajax.employers") }}';
                    break;
                case 'employee_id':
                    url = '{{ route("ajax.employees") }}';
                    break;
            }

            // For employer dropdown, load initial data
            if (id === 'employer_id') {
                $.ajax({
                    url: url,
                    dataType: 'json',
                    data: {
                        page: 1,
                        per_page: 5,
                        status: '1',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response && response.results) {
                            // Add options to select
                            response.results.forEach(function(item) {
                                $select.append(new Option(item.text, item.id, false, false));
                            });
                        }
                    }
                });
            }

            $select.select2({
                theme: 'classic',
                width: '100%',
                ajax: {
                    url: url,
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term || '',
                            page: params.page || 1,
                            per_page: 5,
                            status: '1',
                            _token: '{{ csrf_token() }}'
                        };
                    },
                    beforeSend: function(xhr) {
                        if (currentRequest) {
                            currentRequest.abort();
                        }
                        currentRequest = xhr;
                    },
                    processResults: function(response, params) {
                        params.page = params.page || 1;
                        currentRequest = null;
                        
                        if (!response || !response.results) {
                            return {
                                results: [],
                                pagination: {
                                    more: false
                                }
                            };
                        }

                        return {
                            results: response.results,
                            pagination: {
                                more: response.pagination?.more || false
                            }
                        };
                    },
                    error: function(xhr, status, error) {
                        currentRequest = null;
                        if (status !== 'abort') {
                            console.error('Select2 AJAX Error:', {
                                status: status,
                                error: error,
                                response: xhr.responseText
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Failed to load results. Please try again.'
                            });
                        }
                    },
                    cache: true
                },
                placeholder: function() {
                    switch(id) {
                        case 'client_id':
                            return '{{ __("Search for a client...") }}';
                        case 'employer_id':
                            return '{{ __("Search for an employer...") }}';
                        case 'employee_id':
                            return '{{ __("Search for an employee...") }}';
                        default:
                            return '{{ __("Search...") }}';
                    }
                },
                minimumInputLength: 0,
                language: {
                    inputTooShort: function() {
                        return '{{ __("Please enter 2 or more characters") }}';
                    },
                    searching: function() {
                        return '{{ __("Searching...") }}';
                    },
                    noResults: function() {
                        return '{{ __("No results found") }}';
                    },
                    errorLoading: function() {
                        return '{{ __("Error loading results") }}';
                    }
                },
                templateResult: function(data) {
                    if (data.loading) {
                        return data.text;
                    }
                    return data.text;
                },
                templateSelection: function(data) {
                    return data.text;
                }
            });

            // If there's a selected value, trigger change to update the display
            if ($select.val()) {
                $select.trigger('change');
            }
        });
    });
</script>
