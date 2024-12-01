@section('title')
    {{ 'Update Account info' }}
@endsection
<x-app-layout>
    <div class="max-w-lg mx-auto mt-6 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">
            Update Account info
        </h2>
        <form method="POST" action="{{ route('employee.info.update') }}" enctype="multipart/form-data"
            class="max-w-md mx-auto">
            @csrf
            @method('PUT')
            <!-- Employee Name -->
            <div class="form-field">
                <input type="text" id="employee_name" placeholder=" " required name="employee_name"
                    value="{{ old('employee_name') ?? $employee->employee_name }}" />
                <label for="employee_name">
                    Employee Name</label>
                @error('employee_name')
                    <span class=" text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Employee Email -->
            <div class="form-field">
                <input type="email" id="email" placeholder="" name="email" required
                    value="{{ old('email') ?? $employee->user->email }}" />
                <label for="email">Employee
                    Email</label>
                @error('email')
                    <span class=" text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Employer Name -->
            <div class="form-field">
                <select disabled name="employer_id" id="employer_id">
                    <option class="dark:bg-slate-800   text-text-light  
 dark:text-text-dark  " value="{{ $employee->employer->id }}">
                        {{ $employee->employer->employer_name }}
                    </option>
                </select>
                <label for="employer_id">Employee
                    Name</label>
            </div>
            <!-- Phone -->
            <div class="form-field">
                <input type="number" name="phone" id="phone" value="{{ $employee->phone }}" />
                <label for="phone">
                    Phone</label>
                @error('phone')
                    <span class=" text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- profile  pic -->
            <div class="form-field">
                <label for="file" class="block text-gray-600 font-medium">Choose a file:</label>
                <input type="file" id="file" name="image" class="mt-1 p-2 border rounded-md w-full">
            </div>
            <div class="grid md:grid-cols-2 md:gap-6">
                <!-- Client -->
                <div class="form-field">
                    <select disabled name="client_id" id="client_id"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900  bg-transparent 	 border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:bg-color-gray-600 dark:border-gray-600 dark:focus:border-primary-500 focus:outline-none focus:ring-0 focus:border-primary-600 peer">
                        <option class="dark:bg-slate-800   text-text-light  
 dark:text-text-dark  " value="{{ $employee->client->id ?? ' ' }}">
                            {{ $employee->client->client_name ?? '' }}
                        </option>
                    </select>
                    <label for="client_id">Client
                        Name</label>
                </div>
                <!-- Gender -->
                <div class="form-field">
                    <select name="gender" id="project_id">
                        <option class="dark:bg-slate-800   text-text-light  
 dark:text-text-dark  " value="male"
                            {{ 'male' == $employee->gender ? 'selected' : '' }}>
                            Male
                        </option>
                        <option class="dark:bg-slate-800   text-text-light  
 dark:text-text-dark  " value="female"
                            {{ 'female' == $employee->gender ? 'selected' : '' }}>
                            Female
                        </option>
                        <option class="dark:bg-slate-800   text-text-light  
 dark:text-text-dark  " value="other"
                            {{ 'other' == $employee->gender ? 'selected' : '' }}>
                            Other
                        </option>
                    </select>
                    <label for="project_id">
                        Gender</label>
                </div>
                <!-- Payment Type -->
                <div class="form-field">
                    <select disabled name="payment_type" id="payment_type">
                        <option value="monthly" {{ 'monthly' == $employee->payment_type ? 'selected' : '' }}>Monthly
                            Salary</option>
                        <option value="project" {{ 'project' == $employee->payment_type ? 'selected' : '' }}>Project
                            Based</option>
                    </select>
                    <label for="payment_type">
                        Payment Type</label>
                </div>

                <!-- Monthly Salary (visible if fixed salary selected) -->
                <div id="monthly_salary_field" class="form-field">
                    <input disabled readonly type="text" name="monthly_salary" id="monthly_salary"
                        value="{{ old('monthly_salary') ?? $employee->monthly_salary }}" />
                    <label for="monthly_salary">
                        Monthly Salary Per-month ($)</label>
                    @error('monthly_salary')
                        <span class=" text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Project Details (visible if project based selected) -->
                <div id="project_details_field" style="display: none;">
                    <!-- Employee Share -->
                    <div class="form-field">
                        <input disabled readonly type="text" name="employee_share" id="employee_share"
                            value="{{ old('employee_share') ?? $employee->employee_share }}" maxlength="3"
                            max="99" />
                        <label for="employee_share">
                            Employee share (%)</label>
                        @error('employee_share')
                            <span class=" text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Billing Rate -->
                    <div class="form-field">
                        <input disabled readonly type="text" name="billing_rate" id="billing_rate"
                            value="{{ old('billing_rate') ?? $employee->billing_rate }}" />
                        <label for="billing_rate">
                            Blilling rate Per-hr ($) </label>
                        @error('billing_rate')
                            <span class=" text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit"
                class="text-white bg-primary-300 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-primary-300 dark:hover:bg-primary-300 dark:focus:ring-primary-800">
                Submit</button>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paymentTypeSelect = document.getElementById('payment_type');
            const monthlySalaryField = document.getElementById('monthly_salary_field');
            const projectDetailsField = document.getElementById('project_details_field');

            // Function to show/hide fields based on payment type
            function toggleFields() {
                if (paymentTypeSelect.value === 'monthly') {
                    monthlySalaryField.style.display = 'block';
                    projectDetailsField.style.display = 'none';
                } else if (paymentTypeSelect.value === 'project') {
                    monthlySalaryField.style.display = 'none';
                    projectDetailsField.style.display = 'block';
                }
            }

            // Initially toggle fields based on selected payment type
            toggleFields();

            // Listen for change events on the payment type select
            paymentTypeSelect.addEventListener('change', toggleFields);
        });
    </script>
</x-app-layout>
