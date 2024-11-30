@section('title')
    {{ __('Create Task') }}
@endsection

<x-app-layout>
    <div class="m-6 card">
        <h2 class="text-2xl font-bold mb-4">{{ __('Create New Task') }}</h2>

        <form method="POST" action="{{ route('task.store') }}" >
            @csrf

            {{-- Select Employer --}}
            <div class="form-field">
                <select name="employer_id" id="employer_id" class="form-select" required>
                    <option class="dark:bg-slate-800" value="" disabled>{{ __('Select Employer') }}</option>
                    @foreach ($employers as $employer)
                        <option class="dark:bg-slate-800" value="{{ $employer->id }}">{{ $employer->employer_name }}
                        </option>
                    @endforeach
                </select>
                @error('employer_id')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            {{-- Select Employee --}}
            <div class="form-field">
                <select name="employee_id" id="employee_id" class="form-select" required>
                    <option class="dark:bg-slate-800" value="" disabled>{{ __('Select Employee') }}</option>
                    @foreach ($employees as $employee)
                        <option class="dark:bg-slate-800" value="{{ $employee->id }}">{{ $employee->employee_name }}
                        </option>
                    @endforeach
                </select>
                @error('employee_id')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            {{-- Select Project --}}
            <div class="form-field">
                <select name="project_id" id="project_id" class="form-select" required>
                    <option class="dark:bg-slate-800" value="" disabled>{{ __('Select Project') }}</option>
                    @foreach ($projects as $project)
                        <option class="dark:bg-slate-800" value="{{ $project->id }}">{{ $project->project_name }}
                        </option>
                    @endforeach
                </select>
                @error('project_id')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            {{-- Task Name --}}
            <div class="form-field">
                <input type="text" name="task_name" id="task_name" placeholder=" " required />
                <label for="task_name"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-primary-600 peer-focus:dark:text-primary-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    {{ __('Task Name') }}</label>
                @error('task_name')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            {{-- Task Time --}}
            <div class="form-field">
                <input type="text" name="time" id="time"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-primary-500 focus:outline-none focus:ring-0 focus:border-primary-600"
                    placeholder="0:00" />
                <label for="time"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-primary-600 peer-focus:dark:text-primary-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    {{ __('Task Time') }} <span class="text-red-500">( {{ __('Example:') }} 0:00)</span></label>
                @error('time')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            {{-- Priority --}}
            <div class="form-field">
                <select name="priority" id="priority" class="form-select" required>
                    <option class="dark:bg-slate-800" value="low">{{ __('Low Priority') }}</option>
                    <option class="dark:bg-slate-800" value="medium">{{ __('Medium Priority') }}</option>
                    <option class="dark:bg-slate-800" value="high">{{ __('High Priority') }}</option>
                </select>
                @error('priority')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            {{-- Due Date --}}
            <div class="form-field">
                <input type="date" name="due_date" id="due_date" placeholder=" " required />
                <label for="due_date"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-primary-600 peer-focus:dark:text-primary-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    {{ __('Due Date') }}</label>
                @error('due_date')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            {{-- Task Status --}}
            <div class="form-field">
                <select name="status" id="status" class="form-select" required>
                    <option class="dark:bg-slate-800" value="pending">{{ __('Pending') }}</option>
                    <option class="dark:bg-slate-800" value="inprogress">{{ __('In Progress') }}</option>
                    <option class="dark:bg-slate-800" value="completed">{{ __('Completed') }}</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <div class="form-field">
                <button type="submit"
                    class="w-full text-white bg-primary-300 hover:bg-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-300 dark:hover:bg-primary-300">
                    {{ __('Create Task') }}
                </button>
            </div>
        </form>
    </div>

</x-app-layout>
