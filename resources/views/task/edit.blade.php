@section('title')
    {{ __('Edit Task') }}
@endsection
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<x-app-layout>
    <div class="flex justify-between items-center m-6 card">
        <h2 class="text-xl font-medium text-text-light dark:text-text-dark">{{ __('Edit Task') }}</h2>
        <a href="{{ route('task.index') }}"
            class="btn bg-primary-50 dark:bg-primary-50 text-text-light dark:text-text-dark">{{ __('Go to Task List') }}</a>
    </div>
    <div class="m-6 card">
        <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark">{{ __('Edit Task') }}</h2>

        <form method="POST" action="{{ route('task.update', $task->id) }}">
            @csrf
            @method('PUT')

            {{-- Select Employer --}}
            @if (auth('web')->user()->role != 'employer' &&
                    auth('web')->user()->role != 'employee' &&
                    auth('web')->user()->role != 'client')
                <div class="form-field">
                    <select name="employer_id" id="employer_id" required class="form-select">
                        <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="">
                            {{ __('Select Employer') }}</option>
                        @foreach ($employers as $employer)
                            <option class="dark:bg-slate-800 text-text-light dark:text-text-dark"
                                value="{{ $employer->id }}" {{ $task->employer_id == $employer->id ? 'selected' : '' }}>
                                {{ $employer->employer_name }}
                            </option>
                        @endforeach
                    </select>
                    <label for="employer_id" class="form-label">{{ __('Employer Name') }}</label>
                    @error('employer_id')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            @else
                <input type="hidden" name="employer_id"
                    value="{{ auth()->user()->employer->id ?? (auth()->user()->client->employer_id ?? auth()->user()->employee->employer_id) }}">
            @endif

            {{-- Select Employee --}}
            @if (auth()->user()->role != 'employee')
                <div class="form-field">
                    <select name="employee_id" id="employee_id" required class="form-select">
                        <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="">
                            {{ __('Select Employee') }}</option>
                        @foreach ($employees as $employee)
                            <option class="dark:bg-slate-800 text-text-light dark:text-text-dark"
                                value="{{ $employee->id }}"
                                {{ $task->employee_id == $employee->id ? 'selected' : '' }}>
                                {{ $employee->employee_name }}
                            </option>
                        @endforeach
                    </select>
                    <label for="employee_id" class="form-label">{{ __('Employee Name') }}</label>
                    @error('employee_id')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            @endif

            {{-- Select Project --}}
            <div class="form-field">
                <select name="project_id" id="project_id" required class="form-select">
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="">
                        {{ __('Select Project') }}</option>
                    @foreach ($projects as $project)
                        <option class="dark:bg-slate-800 text-text-light dark:text-text-dark"
                            value="{{ $project->id }}" {{ $task->project_id == $project->id ? 'selected' : '' }}>
                            {{ $project->project_name }}
                        </option>
                    @endforeach
                </select>
                <label for="project_id" class="form-label">{{ __('Project Name') }}</label>
                @error('project_id')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            {{-- Task Name --}}
            <div class="form-field">
                <input type="text" id="task_name" placeholder="" name="task_name" value="{{ $task->task_name }}"
                    class="block py-2.5 px-0 w-full text-sm text-text-light dark:text-text-dark bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-primary-500 focus:outline-none focus:ring-0 focus:border-primary-600" />
                <label for="task_name" class="form-label">{{ __('Task Name') }}</label>
                @error('task_name')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            {{-- Task Time --}}
            <div class="form-field">
                <input type="text" placeholder="" name="time" id="time-picker" value="{{ $task->time }}"
                    required />
                <label for="time" class="form-label">{{ __('Task Time') }} </label>
                @error('time')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            {{-- Priority --}}
            <div class="form-field">
                <select name="priority" id="priority" class="form-select">
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="low"
                        {{ $task->priority == 'low' ? 'selected' : '' }}>{{ __('Low Priority') }}</option>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="medium"
                        {{ $task->priority == 'medium' ? 'selected' : '' }}>{{ __('Medium Priority') }}</option>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="high"
                        {{ $task->priority == 'high' ? 'selected' : '' }}>{{ __('High Priority') }}</option>
                </select>
                <label for="priority" class="form-label">{{ __('Priority') }}</label>
                @error('priority')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            {{-- Due Date --}}
            <div class="form-field">
                <input type="date" name="due_date" id="due_date" onclick="this.showPicker()"
                    value="{{ $task->due_date }}" placeholder=" " required />
                <label for="due_date" class="form-label">{{ __('Due Date') }}</label>
                @error('due_date')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            {{-- Task Status --}}
            <div class="form-field">
                <select name="status" id="status" class="form-select">
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="pending"
                        {{ $task->status == 'pending' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="inprogress"
                        {{ $task->status == 'inprogress' ? 'selected' : '' }}>{{ __('In Progress') }}</option>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="completed"
                        {{ $task->status == 'completed' ? 'selected' : '' }}>{{ __('Completed') }}</option>
                </select>
                <label for="status" class="form-label">{{ __('Status') }}</label>
                @error('status')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            {{-- Submit Button --}}
            <div class="col-span-full">
                <button type="submit"
                    class="px-4 py-2 text-text-light dark:text-text-dark bg-primary-50 rounded-lg hover:bg-primary-50 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-50 dark:hover:bg-primary-400 dark:focus:ring-primary-600 font-medium text-sm">
                    {{ __('Update Task') }}
                </button>
            </div>
        </form>
    </div>

    <script>
        flatpickr("#time-picker", {
            enableTime: true,
            noCalendar: true,
            time_24hr: true, // Ensures 24-hour format
            dateFormat: "H:i" // Sets format as HH:MM
        });

        // flatpickr("#due_date", {
        //     dateFormat: "Y-m-d", 
        //     allowInput: true 
        // });
    </script>

</x-app-layout>
