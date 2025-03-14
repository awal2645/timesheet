@section('title')
    {{ __('Create Leave Application') }}
@endsection

<x-app-layout>
    <div class="flex justify-between items-center m-6 card">
        <h2 class="text-xl font-medium text-text-light dark:text-text-dark">{{ __('Create Leave Application') }}</h2>
        <a href="{{ route('leave.index') }}"
            class="btn bg-primary-50 dark:bg-primary-50 text-text-light dark:text-text-dark">{{ __('Go to Leave List') }}</a>
    </div>
    <div class="m-6 card">
        <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark">{{ __('Create New Leave Application') }}
        </h2>

        <form method="POST" action="{{ route('leave.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @csrf
            @if (Auth::user()->is_employer)
                <div role="group" class="form-field">
                    <select name="employee_id" id="employee_id" class="select2" required>
                        <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="" disabled selected>
                            {{ __('Select Employee') }}
                        </option>
                        @foreach ($employees as $employee)
                            <option class="dark:bg-slate-800 text-text-light dark:text-text-dark"
                                value="{{ old('employee_id', $employee->id) }}">{{ $employee->user->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            @if (auth()->user()->role != 'employer' && auth()->user()->role != 'employee')
                <div class="form-field">
                    <select name="employer_id" id="employer_id" class="select2" required>
                        <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="" disabled selected>
                            {{ __('Select Employer') }}
                        </option>
                        @foreach ($employers as $employer)
                            <option class="dark:bg-slate-800 text-text-light dark:text-text-dark"
                                value="{{ old('employer_id', $employer->id) }}">
                                {{ $employer->employer_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-field">
                    <select name="employee_id" id="employee_select" class="select2" required>
                        <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="" disabled selected>
                            {{ __('Select Employee') }}</option>
                    </select>
                </div>
            @endif
            @if (auth()->user()->role == 'employer')
                <div class="form-field">
                    <select name="employee_id" id="employee_select" class="select2">
                        <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="" disabled selected>
                            {{ __('Select Employee') }}
                        </option>
                        @foreach ($employees as $employee)
                            <option class="dark:bg-slate-800 text-text-light dark:text-text-dark"
                                value="{{ old('employee_id', $employee->id) }}">
                                {{ $employee->employee_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif
            <div class="form-field">
                <select name="leave_type_id" id="leave_type_id" class="select2" required>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="" disabled selected>
                        {{ __('Select Leave Type') }}
                    </option>
                    @foreach ($leaveTypes as $leaveType)
                        <option class="dark:bg-slate-800 text-text-light dark:text-text-dark"
                            value="{{ old('leave_type_id', $leaveType->id) }}">
                            {{ $leaveType->type }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-field">
                <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" required
                    onclick="this.showPicker()" />
                <label for="start_date" class="form-label">{{ __('Start Date') }}</label>
                @error('start_date')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-field">
                <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}"
                    onclick="this.showPicker()" required />
                <label for="end_date" class="form-label">{{ __('End Date') }}</label>
                @error('end_date')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-field">
                <input type="text" name="reason" id="reason" value="{{ old('reason') }}" />
                <label for="reason" class="form-label">{{ __('Reason for Leave') }}</label>
                @error('reason')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-full">
                <button type="submit"
                    class="px-4 py-2 text-text-light dark:text-text-dark bg-primary-50 rounded-md hover:bg-primary-50 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-50 dark:hover:bg-primary-400 dark:focus:ring-primary-600 font-medium text-sm">
                    {{ __('Create Leave Application') }}
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('employer_id').addEventListener('change', function() {
            const employerId = this.value;
            const employeeSelect = document.getElementById('employee_select');

            // Clear previous options
            employeeSelect.innerHTML =
                '<option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="">{{ __('Select Employee') }}</option>';

            if (employerId) {
                fetch(`/employees/${employerId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(employee => {
                            const option = document.createElement('option');
                            option.value = employee.id;
                            option.textContent = employee.employee_name;
                            employeeSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching employees:', error));
            }
        });
    </script>
</x-app-layout>
