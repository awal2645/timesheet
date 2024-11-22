@section('title')
    {{ __('Create Leave Application') }}
@endsection

<x-app-layout>
    <div class="m-6 p-6 bg-white/10 dark:bg-black/10 rounded-lg shadow-md border border-black/10 dark:border-white/10">
        <h2 class="text-2xl font-bold mb-4">{{ __('Create New Leave Application') }}</h2>

        <form method="POST" action="{{ route('leave.store') }}" class="">
            @csrf
            @if (Auth::user()->is_employer)
                <div role="group" class="relative z-0 w-full mb-5 group">
                    <select name="employee_id" id="employee_id"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                        required>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->user->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            @if (auth()->user()->role != 'employer' && auth()->user()->role != 'employee')
                <div class="relative z-0 w-full mb-5 group">
                    <select name="employer_id" id="employer_id"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                        required>
                        <option value="">Select Employer</option>
                        @foreach ($employers as $employer)
                            <option value="{{ $employer->id }}">{{ $employer->employer_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <select name="employee_id" id="employee_select"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                        required>
                        <option value="">Select Employee</option>
                    </select>
                </div>
            @endif
            @if (auth()->user()->role == 'employer')
                <div class="relative z-0 w-full mb-5 group">
                    <select name="employee_id" id="employee_select"
                        class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer">
                        <option class="dark:bg-slate-800" value="">Select Employee</option>
                        @foreach ($employees as $employee)
                            <option class="dark:bg-slate-800" value="{{ $employee->id }}">{{ $employee->employee_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif
            <div class="relative z-0 w-full mb-5 group">
                <select name="leave_type_id" id="leave_type_id"
                    class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                    required>
                    @foreach ($leaveTypes as $leaveType)
                        <option value="{{ $leaveType->id }}">{{ $leaveType->type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="date" name="start_date" id="start_date"
                    class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                    required />
                <label for="start_date"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:dark:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    {{ __('Start Date') }}</label>

                @error('start_date')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <input type="date" name="end_date" id="end_date"
                    class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                    required />
                <label for="end_date"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:dark:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    {{ __('End Date') }}</label>

                @error('end_date')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <textarea name="reason" id="reason" rows="4"
                    class="block py-2.5 px-5 rounded-md w-full text-sm text-gray-900 bg-transparent border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-purple-500 focus:outline-none focus:ring-0 focus:border-purple-600 peer"
                    required></textarea>
                <label for="reason"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:dark:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    {{ __('Reason for Leave') }}</label>

                @error('reason')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="w-full px-4 py-2 text-white bg-purple-500 rounded-lg hover:bg-purple-500 focus:ring-4 focus:outline-none focus:ring-purple-300 dark:bg-purple-500 dark:hover:bg-purple-400 dark:focus:ring-purple-600 font-medium text-sm">
                {{ __('Create Leave Application') }}
            </button>
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
