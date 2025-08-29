<div class="flex items-center justify-between">
    <div class="flex items-center space-x-2">
        <i class="fa-solid fa-clock text-gray-400 text-sm"></i>
        <div class="flex items-center space-x-1 text-sm">
            <span class="font-mono font-medium text-gray-900 dark:text-white" id="timer-{{ $task->id }}">
                {{ $task->time ?? '00:00' }}
            </span>
            @if($task->estimated_hours)
                <span class="text-gray-400">/</span>
                <span class="text-gray-500 dark:text-gray-400">
                    {{ $task->estimated_hours }}h
                </span>
            @endif
        </div>
    </div>

    @if($showControls)
        <div class="flex items-center space-x-1">
            <!-- Start Button -->
            <button onclick="startTimer({{ $task->id }})"
                    id="start-btn-{{ $task->id }}"
                    class="inline-flex items-center justify-center w-7 h-7 text-xs bg-green-100 text-green-700 rounded hover:bg-green-200 dark:bg-green-900 dark:text-green-300 dark:hover:bg-green-800 transition-colors">
                <i class="fa-solid fa-play"></i>
            </button>

            <!-- Stop Button -->
            <button onclick="stopTimer({{ $task->id }})"
                    id="stop-btn-{{ $task->id }}"
                    class="inline-flex items-center justify-center w-7 h-7 text-xs bg-red-100 text-red-700 rounded hover:bg-red-200 dark:bg-red-900 dark:text-red-300 dark:hover:bg-red-800 transition-colors hidden">
                <i class="fa-solid fa-stop"></i>
            </button>
        </div>
    @endif
</div>

@if($showControls)
<script>
    // Timer functionality specific to this task
    window.taskTimers = window.taskTimers || {};
    
    function startTimer(taskId) {
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

        window.taskTimers[taskId] = setInterval(() => {
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

        clearInterval(window.taskTimers[taskId]);

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
@endif