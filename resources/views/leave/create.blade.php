@section('title')
    {{ __('Create Leave Application') }}
@endsection

<x-app-layout>
    <div class="m-6 card">
        <h2 class="text-2xl font-bold mb-4">{{ __('Create New Leave Application') }}</h2>

        <form method="POST" action="{{ route('leave.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @csrf
            @if (Auth::user()->is_employer)
                <div role="group" class="form-field">
                    <select name="employee_id" id="employee_id" class="form-select" required>
                        @foreach ($employees as $employee)
                            <option value="{{ old('employee_id', $employee->id) }}">{{ $employee->user->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            @if (auth()->user()->role != 'employer' && auth()->user()->role != 'employee')
                <div class="form-field">
                    <select name="employer_id" id="employer_id" class="form-select" required>
                        <option value="">Select Employer</option>
                        @foreach ($employers as $employer)
                            <option value="{{ old('employer_id', $employer->id) }}">{{ $employer->employer_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-field">
                    <select name="employee_id" id="employee_select" class="form-select" required>
                        <option value="">Select Employee</option>
                    </select>
                </div>
            @endif
            @if (auth()->user()->role == 'employer')
                <div class="form-field">
                    <select name="employee_id" id="employee_select" class="form-select">
                        <option class="dark:bg-slate-800" value="">Select Employee</option>
                        @foreach ($employees as $employee)
                            <option class="dark:bg-slate-800" value="{{ old('employee_id', $employee->id) }}">
                                {{ $employee->employee_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif
            <div class="form-field">
                <select name="leave_type_id" id="leave_type_id" class="form-select" required>
                    <option value="">Select Leave Type</option>
                    @foreach ($leaveTypes as $leaveType)
                        <option value="{{ old('leave_type_id', $leaveType->id) }}">{{ $leaveType->type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-field">
                <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" required />
                <label for="start_date">
                    {{ __('Start Date') }}</label>

                @error('start_date')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-field">
                <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" required />
                <label for="end_date">
                    {{ __('End Date') }}</label>

                @error('end_date')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-field">
                <textarea name="reason" id="reason" rows="4" value="{{ old('reason') }}" required></textarea>
                <label for="reason">
                    {{ __('Reason for Leave') }}</label>

                @error('reason')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-span-full">
                <button type="submit"
                    class="px-4 py-2 text-white bg-primary-300 rounded-lg hover:bg-primary-300 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-300 dark:hover:bg-primary-400 dark:focus:ring-primary-600 font-medium text-sm">
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
            employeeSelect.innerHTML = '<option value="">Select Employee</option>';

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
