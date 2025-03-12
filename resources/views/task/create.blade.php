@section('title')
    {{ __('Create Task') }}
@endsection
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
{{-- <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css"> --}}

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<x-app-layout>
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">{{ __('Oops! Something went wrong.') }}</strong>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="flex justify-between items-center m-6 card">
        <h2 class="text-xl font-medium text-text-light dark:text-text-dark">{{ __('Create Task') }}</h2>
        <a href="{{ route('task.index') }}"
            class="btn bg-primary-50 dark:bg-primary-50 text-text-light dark:text-text-dark">{{ __('Go to Task List') }}</a>
    </div>
    <div class="m-6 card">
        <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark">{{ __('Create New Task') }}</h2>

        <form method="POST" action="{{ route('task.store') }}">
            @csrf

            {{-- Select Employer --}}
            @if (auth()->user()->role != 'employee' && auth()->user()->role != 'client')
                <div class="form-field">
                    <select name="employer_id" id="employer_id" class="form-select">
                        <option class="dark:bg-slate-800 text-text-light dark:text-text-dark  " value="">
                            {{ __('Select Employer') }}</option>
                        @foreach ($employers as $employer)
                            <option class="dark:bg-slate-800 text-text-light dark:text-text-dark  "
                                value="{{ $employer->id }}">{{ $employer->employer_name }}
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
                    value="{{ auth()->user()->employee->employer_id ?? auth()->user()->client->employer_id }}">
            @endif
            {{-- Select Employee --}}
            @if (auth()->user()->role != 'employee')
                <div class="form-field">
                    <select name="employee_id" id="employee_id" class="form-select" required>
                        <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="">
                            {{ __('Select Employee') }}</option>
                        @foreach ($employees as $employee)
                            <option class="dark:bg-slate-800 text-text-light dark:text-text-dark"
                                value="{{ $employee->id }}">{{ $employee->employee_name }}
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
                <select name="project_id" id="project_id" class="form-select" required>
                    <option class="dark:bg-card-light dark:text-text-dark" value="">{{ __('Select Project') }}
                    </option>
                    @foreach ($projects as $project)
                        <option class="dark:bg-card-light dark:text-text-dark" value="{{ $project->id }}">
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
                <input type="text" name="task_name" id="task_name" placeholder=" " required />
                <label for="task_name" class="form-label">{{ __('Task Name') }}</label>
                @error('task_name')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            {{-- Task Time --}}
            {{-- Task Time --}}
            <div class="form-field">
                <input type="text" name="time" value="00:00"
                    class="block py-2.5 px-0 w-full text-sm text-text-light dark:text-text-dark bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-primary-500 focus:outline-none focus:ring-0 focus:border-primary-600"
                    oninput="this.value = this.value.replace(/[^0-9]/g, ''); if(this.value.length > 2) this.value = this.value.slice(0, 2) + ':' + this.value.slice(2, 4);"
                    required />
                <label for="time" class="form-label">{{ __('Task Time') }} </label>
                @error('time')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            {{-- Priority --}}
            <div class="form-field">
                <select name="priority" id="priority" class="form-select" required>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="low">
                        {{ __('Low Priority') }}</option>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="medium">
                        {{ __('Medium Priority') }}</option>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="high">
                        {{ __('High Priority') }}</option>
                </select>
                <label for="priority" class="form-label">{{ __('Priority') }}</label>
                @error('priority')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            {{-- Due Date --}}
            <div class="form-field">
                <input type="date" name="due_date" id="due_date" placeholder="" onclick="this.showPicker()"
                    required />
                <label for="due_date" class="form-label">{{ __('Due Date') }}</label>
                @error('due_date')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            {{-- Task Status --}}
            <div class="form-field">
                <select name="status" id="status" class="form-select" required>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="pending">
                        {{ __('Pending') }}</option>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="inprogress">
                        {{ __('In Progress') }}</option>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="completed">
                        {{ __('Completed') }}</option>
                </select>
                <label for="status" class="form-label">{{ __('Status') }}</label>
                @error('status')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            {{-- Submit Button --}}
            <div class="col-span-full">
                <button type="submit"
                    class="px-4 py-2 text-text-light dark:text-text-dark bg-primary-50 rounded-md hover:bg-primary-50 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-50 dark:hover:bg-primary-400 dark:focus:ring-primary-600 font-medium text-sm">
                    {{ __('Create Task') }}
                </button>
            </div>
        </form>
    </div>


</x-app-layout>
