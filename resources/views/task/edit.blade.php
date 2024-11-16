@section('title')
    {{ __('Edit Task') }}
@endsection

<x-app-layout>
    <div class="max-w-lg mx-auto mt-6 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">{{ __('Edit Task') }}</h2>

        <form method="POST" action="{{ route('task.update', $task->id) }}" class="max-w-md mx-auto">
            @csrf
            @method('PUT')

            {{-- Select Employer --}}
            <div class="relative z-0 w-full mb-5 group">
                <select name="employer_id" id="employer_id" required>
                    <option value="" disabled>{{ __('Select Employer') }}</option>
                    @foreach ($employers as $employer)
                        <option value="{{ $employer->id }}" {{ $task->employer_id == $employer->id ? 'selected' : '' }}>
                            {{ $employer->employer_name }}
                        </option>
                    @endforeach
                </select>
                @error('employer_id')
                <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            {{-- Select Employee --}}
            <div class="relative z-0 w-full mb-5 group">
                <select name="employee_id" id="employee_id" required>
                    <option value="" disabled>{{ __('Select Employee') }}</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}" {{ $task->employee_id == $employee->id ? 'selected' : '' }}>
                            {{ $employee->employee_name }}
                        </option>
                    @endforeach
                </select>
                @error('employee_id')
                <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            {{-- Select Project --}}
            <div class="relative z-0 w-full mb-5 group">
                <select name="project_id" id="project_id" required>
                    <option value="" disabled>{{ __('Select Project') }}</option>
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}" {{ $task->project_id == $project->id ? 'selected' : '' }}>
                            {{ $project->project_name }}
                        </option>
                    @endforeach
                </select>
                @error('project_id')
                <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            {{-- Task Name --}}
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="task_name" id="task_name" value="{{ $task->task_name }}" required />
                @error('task_name')
                <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            {{-- Task Time --}}
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="time" id="time" value="{{ $task->time }}" />
                @error('time')
                <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            {{-- Priority --}}
            <div class="relative z-0 w-full mb-5 group">
                <select name="priority" id="priority">
                    <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>{{ __('Low Priority') }}</option>
                    <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>{{ __('Medium Priority') }}</option>
                    <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>{{ __('High Priority') }}</option>
                </select>
                @error('priority')
                <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            {{-- Due Date --}}
            <div class="relative z-0 w-full mb-5 group">
                <input type="date" name="due_date" id="due_date" value="{{ $task->due_date }}" required />
                @error('due_date')
                <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            {{-- Task Status --}}
            <div class="relative z-0 w-full mb-5 group">
                <select name="status" id="status">
                    <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                    <option value="inprogress" {{ $task->status == 'inprogress' ? 'selected' : '' }}>{{ __('In Progress') }}</option>
                    <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>{{ __('Completed') }}</option>
                </select>
                @error('status')
                <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <div class="relative z-0 w-full mb-5 group">
                <button type="submit" class="w-full text-white bg-blue-500 hover:bg-blue-600">
                    {{ __('Update Task') }}
                </button>
            </div>
        </form>
    </div>
</x-app-layout>