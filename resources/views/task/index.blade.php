@section('title')
    {{ 'List Task' }}
@endsection
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
        <div class="m-6">
            <div class=" mt-10 mb-5 flex flex-col md:flex-row justify-between items-center md:space-y-0 card">
                <form action="{{ route('task.index') }}" method="GET">
                    <div class="mb-5">
                        <label for="search" class="block mb-2 text-sm font-medium text-text-light dark:text-text-dark">
                            {{ __('Search') }}</label>
                        <div class="flex form-field">
                            <input type="text" id="search" name="search" placeholder="{{ __('Search') }}" value="{{ request('search') }}" />
                            <button
                                class="bg-primary-50 text-text-light dark:text-text-dark px-4 py-2 rounded-lg  ml-2">{{ __('Search') }}</button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('task.create') }}" class="bg-primary-50 text-text-light dark:text-text-dark px-4 py-2 rounded-lg"><i
                        class="fa-solid fa-plus"></i> {{ __('Create Task') }}</a>
            </div>
            <!-- Start heading here -->
            <div class="flex flex-wrap">
                <div class="w-full ">
                    <div class="dashboard-right pl-0 ">
                        <div class="tasks-table ">
                            <h2 class="text-xl font-semibold mb-4 text-text-light dark:text-text-dark text-text-light dark:text-text-dark">{{ __('Latest Tasks') }}</h2>
                            <div class="card">
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
                                                    {{ __('Time') }}
                                                </th>
                                                <th scope="col" class="">
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
                                                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
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
                                                        <td class="px-6 py-4 flex gap-2 items-center">
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
                                                                Stop
                                                            </button>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <div class="flex items-center gap-2">
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
                                                                        <option class="dark:bg-slate-800   text-text-light  
 dark:text-text-dark  "
                                                                            value="pending"
                                                                            {{ $task->status === 'pending' ? 'selected' : '' }}>
                                                                            {{ __('Pending') }}
                                                                        <option class="dark:bg-slate-800   text-text-light  
 dark:text-text-dark  "
                                                                            value="inprogress"
                                                                            {{ $task->status === 'inprogress' ? 'selected' : '' }}>
                                                                            {{ __('In Progress') }}
                                                                        <option class="dark:bg-slate-800   text-text-light  
 dark:text-text-dark  "
                                                                            value="completed"
                                                                            {{ $task->status === 'completed' ? 'selected' : '' }}>
                                                                            {{ __('Complete') }}
                                                                    </select>
                                                                </form>
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <div class="flex space-x-2">
                                                                <a href="{{ route('task.edit', $task->id) }}"
                                                                    class="text-primary-500 hover:text-primary-300">
                                                                    <i class="fa-solid fa-pen-to-square"></i>                                                                </a>
                                                                <a onclick="showConfirmation({{ $task->id }})"
                                                                    class=" cursor-pointer text-red-600 dark:text-red-500 hover:underline">
                                                                    <i class="fa-solid fa-trash"></i>                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                            <tr>
                                                <td colspan="8" class="text-center py-8">
                                                    <img src="{{ asset('images/no-data-found.svg') }}"
                                                        alt="No data found" class="mx-auto max-w-xs">
                                                </td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="mt-6">
                                {{ $tasks->links() }}
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
