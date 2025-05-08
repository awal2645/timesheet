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

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">{{ __('Oops! Something went wrong.') }}</strong>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('task.update', $task->id) }}" class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @csrf
            @method('PUT')

            {{-- Select Employer --}}
            @if (auth()->user()->role != 'employee' && auth()->user()->role != 'client')
                <div class="form-field">
                    <select name="employer_id" id="employer_id" class="select2">
                        <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="" disabled selected>
                            {{ __('Select Employer') }}
                        </option>
                        @foreach ($employers as $employer)
                            <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" 
                                value="{{ $employer->id }}" {{ $task->employer_id == $employer->id ? 'selected' : '' }}>
                                {{ $employer->employer_name }}
                            </option>
                        @endforeach
                    </select>
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
                    <select name="employee_id" id="employee_id" class="select2" required>
                        <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="" disabled selected>
                            {{ __('Select Employee') }}
                        </option>
                        @foreach ($employees as $employee)
                            <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" 
                                value="{{ $employee->id }}" {{ $task->employee_id == $employee->id ? 'selected' : '' }}>
                                {{ $employee->employee_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('employee_id')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            @endif

            {{-- Select Project --}}
            <div class="form-field">
                <select name="project_id" id="project_id" class="select2" required>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="" disabled selected>
                        {{ __('Select Project') }}
                    </option>
                    @foreach ($projects as $project)
                        <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" 
                            value="{{ $project->id }}" {{ $task->project_id == $project->id ? 'selected' : '' }}>
                            {{ $project->project_name }}
                        </option>
                    @endforeach
                </select>
                @error('project_id')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            {{-- Task Name --}}
            <div class="form-field">
                <input type="text" name="task_name" id="task_name" placeholder=" " required value="{{ old('task_name', $task->task_name) }}" />
                <label for="task_name">{{ __('Task Name') }}</label>
                @error('task_name')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            {{-- Task Time --}}
            <div class="form-field">
                <input type="text" name="time" id="time" value="{{ old('time', $task->time) }}"
                    class="block py-2.5 px-0 w-full text-sm text-text-light dark:text-text-dark bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-primary-500 focus:outline-none focus:ring-0 focus:border-primary-600"
                    oninput="this.value = this.value.replace(/[^0-9]/g, ''); if(this.value.length > 2) this.value = this.value.slice(0, 2) + ':' + this.value.slice(2, 4);"
                    required />
                <label for="time">{{ __('Task Time') }}</label>
                @error('time')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            {{-- Priority --}}
            <div class="form-field">
                <select name="priority" id="priority" class="select2" required>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="" disabled selected>
                        {{ __('Select Priority') }}
                    </option>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>
                        {{ __('Low Priority') }}
                    </option>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>
                        {{ __('Medium Priority') }}
                    </option>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>
                        {{ __('High Priority') }}
                    </option>
                </select>
                @error('priority')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            {{-- Due Date --}}
            <div class="form-field">
                <input type="text" name="due_date" id="due_date" value="{{ old('due_date', $task->due_date) }}" required />
                <label for="due_date">{{ __('Due Date') }}</label>
                @error('due_date')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            {{-- Task Status --}}
            <div class="form-field">
                <select name="status" id="status" class="select2" required>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="" disabled selected>
                        {{ __('Select Status') }}
                    </option>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>
                        {{ __('Pending') }}
                    </option>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="inprogress" {{ old('status', $task->status) == 'inprogress' ? 'selected' : '' }}>
                        {{ __('In Progress') }}
                    </option>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>
                        {{ __('Completed') }}
                    </option>
                </select>
                @error('status')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            {{-- Submit Button --}}
            <div class="col-span-full">
                <button type="submit"
                    class="px-4 py-2 text-text-light dark:text-text-dark bg-primary-50 rounded-md hover:bg-primary-50 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-50 dark:hover:bg-primary-400 dark:focus:ring-primary-600 font-medium text-sm">
                    {{ __('Update Task') }}
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM Content Loaded');
            
            let employerSelect = document.getElementById('employer_id');
            let employeeSelect = document.getElementById('employee_id');
            let projectSelect = document.getElementById('project_id');
            let prioritySelect = document.getElementById('priority');
            let statusSelect = document.getElementById('status');

            console.log('Elements found:', {
                employerSelect: !!employerSelect,
                employeeSelect: !!employeeSelect,
                projectSelect: !!projectSelect,
                prioritySelect: !!prioritySelect,
                statusSelect: !!statusSelect
            });

            // Get CSRF token from meta tag
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Initialize Select2 on all select elements
            if (employerSelect) {
                $(employerSelect).select2({
                    theme: 'classic',
                    width: '100%'
                });
            }
            if (employeeSelect) {
                $(employeeSelect).select2({
                    theme: 'classic',
                    width: '100%'
                });
            }
            if (projectSelect) {
                $(projectSelect).select2({
                    theme: 'classic',
                    width: '100%'
                });
            }
            if (prioritySelect) {
                $(prioritySelect).select2({
                    theme: 'classic',
                    width: '100%'
                });
            }
            if (statusSelect) {
                $(statusSelect).select2({
                    theme: 'classic',
                    width: '100%'
                });
            }

            // Only add employer change listener if employer select exists
            if (employerSelect) {
                console.log('Adding employer change listener');
                $(employerSelect).on('select2:select', function(e) {
                    const employerId = e.params.data.id;
                    console.log('Employer selected:', employerId);

                    // Clear previous options
                    if (employeeSelect) {
                        $(employeeSelect).empty().append('<option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="" disabled selected>{{ __("Select Employee") }}</option>');
                    }
                    if (projectSelect) {
                        $(projectSelect).empty().append('<option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="" disabled selected>{{ __("Select Project") }}</option>');
                    }

                    if (employerId) {
                        console.log('Fetching employees for employer:', employerId);
                        // Fetch employees
                        fetch(`/get/employee/${employerId}`, {
                            headers: {
                                'X-CSRF-TOKEN': token,
                                'Accept': 'application/json'
                            },
                            credentials: 'same-origin'
                        })
                            .then(response => {
                                console.log('Employee API Response:', response);
                                if (!response.ok) {
                                    if (response.status === 401) {
                                        throw new Error('Unauthorized - Please log in');
                                    }
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                console.log('Employee data received:', data);
                                if (employeeSelect) {
                                    data.forEach(employee => {
                                        const option = new Option(employee.employee_name, employee.id, false, false);
                                        option.className = 'dark:bg-slate-800 text-text-light dark:text-text-dark';
                                        $(employeeSelect).append(option);
                                    });
                                    $(employeeSelect).trigger('change');
                                }
                            })
                            .catch(error => {
                                console.error('Error fetching employees:', error);
                                alert('Error loading employees. Please try again.');
                            });

                        console.log('Fetching projects for employer:', employerId);
                        // Fetch projects
                        fetch(`/get/project/${employerId}`, {
                            headers: {
                                'X-CSRF-TOKEN': token,
                                'Accept': 'application/json'
                            },
                            credentials: 'same-origin'
                        })
                            .then(response => {
                                console.log('Project API Response:', response);
                                if (!response.ok) {
                                    if (response.status === 401) {
                                        throw new Error('Unauthorized - Please log in');
                                    }
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                console.log('Project data received:', data);
                                if (projectSelect) {
                                    data.forEach(project => {
                                        const option = new Option(project.project_name, project.id, false, false);
                                        option.className = 'dark:bg-slate-800 text-text-light dark:text-text-dark';
                                        $(projectSelect).append(option);
                                    });
                                    $(projectSelect).trigger('change');
                                }
                            })
                            .catch(error => {
                                console.error('Error fetching projects:', error);
                                alert('Error loading projects. Please try again.');
                            });
                    }
                });
            }

            // Initialize flatpickr for date input
            const dueDateInput = document.getElementById('due_date');
            if (dueDateInput) {
                flatpickr(dueDateInput, {
                    dateFormat: "Y-m-d",
                    minDate: "today",
                    theme: "dark",
                    allowInput: true
                });
            }

            // Handle time input formatting
            const timeInput = document.getElementById('time');
            if (timeInput) {
                timeInput.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/[^0-9]/g, '');
                    if (value.length > 2) {
                        value = value.slice(0, 2) + ':' + value.slice(2, 4);
                    }
                    e.target.value = value;
                });
            }
        });
    </script>
</x-app-layout>
