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
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" id="employee_name"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required name="employee_name"
                    value="{{ old('employee_name') ?? $employee->employee_name }}" />
                <label for="employee_name"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Employee Name</label>
                @error('employee_name')
                    <span class=" text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Employee Email -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="email" id="email"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder="" name="email" required value="{{ old('email') ?? $employee->user->email }}" />
                <label for="email"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Employee
                    Email</label>
                @error('email')
                    <span class=" text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Employer Name -->
            <div class="relative z-0 w-full mb-5 group">
                <select disabled name="employer_id" id="employer_id"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                    <option class="dark:bg-slate-800" value="{{ $employee->employer->id }}">
                        {{ $employee->employer->employer_name }}
                    </option>
                </select>
                <label for="employer_id"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Employee
                    Name</label>
            </div>
            <!-- Phone -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="number" name="phone" id="phone"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    value="{{ $employee->phone }}" />
                <label for="phone"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Phone</label>
                @error('phone')
                    <span class=" text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- profile  pic -->
            <div class="relative z-0 w-full mb-5 group">
                <label for="file" class="block text-gray-600 font-medium">Choose a file:</label>
                <input type="file" id="file" name="image" class="mt-1 p-2 border rounded-md w-full">
            </div>
            <div class="grid md:grid-cols-2 md:gap-6">
                <!-- Client -->
                <div class="relative z-0 w-full mb-5 group">
                    <select disabled name="client_id" id="client_id"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900  bg-transparent 	 border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:bg-color-gray-600 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                        <option class="dark:bg-slate-800" value="{{ $employee->client->id ?? ' ' }}">
                            {{ $employee->client->client_name ?? '' }}
                        </option>
                    </select>
                    <label for="client_id"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Client
                        Name</label>
                </div>
                <!-- Gender -->
                <div class="relative z-0 w-full mb-5 group">
                    <select name="gender" id="project_id"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                        <option class="dark:bg-slate-800" value="male"
                            {{ 'male' == $employee->gender ? 'selected' : '' }}>
                            Male
                        </option>
                        <option class="dark:bg-slate-800" value="female"
                            {{ 'female' == $employee->gender ? 'selected' : '' }}>
                            Female
                        </option>
                        <option class="dark:bg-slate-800" value="other"
                            {{ 'other' == $employee->gender ? 'selected' : '' }}>
                            Other
                        </option>
                    </select>
                    <label for="project_id"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Gender</label>
                </div>
                <!-- Payment Type -->
                <div class="relative z-0 w-full mb-5 group">
                    <select disabled name="payment_type" id="payment_type"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                        <option value="monthly" {{ 'monthly' == $employee->payment_type ? 'selected' : '' }}>Monthly
                            Salary</option>
                        <option value="project" {{ 'project' == $employee->payment_type ? 'selected' : '' }}>Project
                            Based</option>
                    </select>
                    <label for="payment_type"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Payment Type</label>
                </div>

                <!-- Monthly Salary (visible if fixed salary selected) -->
                <div id="monthly_salary_field" class="relative z-0 w-full mb-5 group">
                    <input disabled readonly type="text" name="monthly_salary" id="monthly_salary"
                        value="{{ old('monthly_salary') ?? $employee->monthly_salary }}"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
                    <label for="monthly_salary"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Monthly Salary Per-month ($)</label>
                    @error('monthly_salary')
                        <span class=" text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Project Details (visible if project based selected) -->
                <div id="project_details_field" style="display: none;">
                    <!-- Employee Share -->
                    <div class="relative z-0 w-full mb-5 group">
                        <input disabled readonly type="text" name="employee_share" id="employee_share"
                            value="{{ old('employee_share') ?? $employee->employee_share }}" maxlength="3"
                            max="99"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
                        <label for="employee_share"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Employee share (%)</label>
                        @error('employee_share')
                            <span class=" text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Billing Rate -->
                    <div class="relative z-0 w-full mb-5 group">
                        <input disabled readonly type="text" name="billing_rate" id="billing_rate"
                            value="{{ old('billing_rate') ?? $employee->billing_rate }}"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
                        <label for="billing_rate"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Blilling rate Per-hr ($) </label>
                        @error('billing_rate')
                            <span class=" text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-teal-500 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
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
