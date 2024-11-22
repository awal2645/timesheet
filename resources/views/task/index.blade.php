@section('title')
    {{ 'List Task' }}
@endsection
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
</style>
<x-app-layout>
    <div class="relative overflow-x-auto">
        <div class="container mx-auto px-5">
            <div class=" mt-10 mb-5 flex flex-col md:flex-row justify-between items-center md:space-y-0 ">
                <form action="{{ route('task.index') }}" method="GET">
                    <div class="mb-5">
                        <label for="search" class="block mb-2 text-sm font-medium">{{ __('Search Task') }}</label>
                        <div class="flex">
                            <input type="text" id="search" name="search" value="{{ request('search') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                                placeholder="{{ __('Search Task') }}" />
                            <button
                                class="bg-teal-500 text-white px-4 py-2 rounded-lg  ml-2">{{ __('Search') }}</button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('task.create') }}" class="bg-teal-500 text-white px-4 py-2 rounded-lg"><i
                        class="fa-solid fa-plus"></i> {{ __('Create Task') }}</a>
            </div>
            <!-- Start heading here -->
            <div class="flex flex-wrap">
                <div class="w-full ">
                    <div class="dashboard-right pl-0 ">
                        <div class="tasks-table ">
                            <h2 class="text-xl font-semibold mb-4">{{ __('Latest Tasks') }}</h2>
                            <div class="overflow-x-auto pb-1">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 border border-gray-300 dark:border-gray-700">
                                                {{ __('Task Name') }}
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 border border-gray-300 dark:border-gray-700">
                                                {{ __('Client Name') }}
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 border border-gray-300 dark:border-gray-700">
                                                {{ __('Employer Name') }}
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 border border-gray-300 dark:border-gray-700">
                                                {{ __('Employee Name') }}
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 border border-gray-300 dark:border-gray-700">
                                                {{ __('Time') }}
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 border border-gray-300 dark:border-gray-700">
                                                {{ __('Status') }}
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 border border-gray-300 dark:border-gray-700">
                                                {{ __('Action') }}
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if ($tasks->count() > 0)
                                            @foreach ($tasks as $key => $task)
                                                <tr
                                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                                    <th scope="row"
                                                        class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                                        <div class="">
                                                            <div class="text-base font-semibold">
                                                                {{ $task->task_name ?? '' }}</div>
                                                        </div>
                                                    </th>
                                                    <td class="px-6 py-4 border border-gray-300 dark:border-gray-700">
                                                        <a rel="noopener noreferrer">
                                                            {{ $task->client->client_name ?? '' }}
                                                        </a>
                                                    </td>
                                                    <td class="px-6 py-4 border border-gray-300 dark:border-gray-700">
                                                        <a rel="noopener noreferrer">
                                                            {{ $task->employer->employer_name ?? '' }}
                                                        </a>
                                                    </td>
                                                    <td class="px-6 py-4 border border-gray-300 dark:border-gray-700">
                                                        <a rel="noopener noreferrer">
                                                            {{ $task->employee->employee_name ?? '' }}
                                                        </a>
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 d-flex border border-gray-300 dark:border-gray-700">
                                                        <div id="timer-{{ $task->id }}">
                                                            {{ $task->time ?? '00:00' }}
                                                        </div>
                                                        <button onclick="startTimer({{ $task->id }})"
                                                            id="start-btn-{{ $task->id }}"
                                                            class="bg-green-500 text-white px-2 py-1 rounded-lg">
                                                            Start
                                                        </button>
                                                        <button onclick="stopTimer({{ $task->id }})"
                                                            id="stop-btn-{{ $task->id }}"
                                                            class="bg-red-400 text-white px-2 py-1 rounded-lg hidden">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                height="20" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                aria-hidden="true">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <!-- Minute hand -->
                                                                <polyline points="12 6 12 12" class="clock-minute-hand">
                                                                </polyline>
                                                                <!-- Hour hand -->
                                                                <polyline points="12 12 16 14" class="clock-hour-hand">
                                                                </polyline>
                                                            </svg>
                                                            Stop
                                                        </button>
                                                    </td>
                                                    <td class="px-6 py-4 border border-gray-300 dark:border-gray-700">
                                                        <div class="flex items-center space-x-2">
                                                            <div class="h-2.5 w-2.5 rounded-full" id="statusIndicator"
                                                                style="background-color: {{ $task->status === 'complete' ? 'green' : ($task->status === 'inprogress' ? 'blue' : 'red') }};">
                                                            </div>
                                                            <form id="statusForm{{ $task->id }}"
                                                                action="{{ route('task.updateStatus', $task->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <select name="status" id="status"
                                                                    class="border-none bg-transparent text-gray-900 dark:text-white focus:outline-none"
                                                                    onchange="document.getElementById('statusForm{{ $task->id }}').submit()">
                                                                    <option class="dark:bg-slate-800" value="pending"
                                                                        {{ $task->status === 'pending' ? 'selected' : '' }}>
                                                                        {{ __('Pending') }}
                                                                    <option class="dark:bg-slate-800" value="inprogress"
                                                                        {{ $task->status === 'inprogress' ? 'selected' : '' }}>
                                                                        {{ __('In Progress') }}
                                                                    <option class="dark:bg-slate-800" value="complete"
                                                                        {{ $task->status === 'complete' ? 'selected' : '' }}>
                                                                        {{ __('Complete') }}
                                                                </select>
                                                            </form>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 border border-gray-300 dark:border-gray-700">
                                                        <div class="flex space-x-2">
                                                            <a href="{{ route('task.edit', $task->id) }}"
                                                                class="font-medium text-purple-600 dark:text-purple-500 hover:underline">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class="w-6 h-6">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                                </svg>
                                                            </a>
                                                            <a onclick="showConfirmation({{ $task->id }})"
                                                                class="font-medium cursor-pointer text-red-600 dark:text-red-500 hover:underline">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class="w-6 h-6">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0A48.108 48.108 0 0 1 7.25 5.392m9.5-.397-.44 9M9.26 9l.442 9m0-9a48.108 48.108 0 0 0-3.478-.397m4.966 0a48.108 48.108 0 0 1 3.478-.397" />
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" class="text-center">{{ __('No Tasks Found') }}
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-6">
                                {{-- {{ $tasks->links() }} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Start content here -->
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
