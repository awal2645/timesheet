@section('title')
    {{ __('Edit Employee') }}
@endsection
<x-app-layout>
    <div class="m-6 card">
        <h2 class="text-2xl font-bold mb-4">
            @if (Request::path() == 'my/account')
                {{ __('Update Account info') }}
            @else
                {{ __('Edit Employee') }}
            @endif
        </h2>
        <form method="POST" action="{{ route('employee.update', ['id' => $employee->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- Employee Name -->
            <div class="form-field">
                <input type="text" id="employee_name" placeholder=" " required name="employee_name"
                    value="{{ old('employee_name') ?? $employee->employee_name }}" />
                <label for="employee_name">
                    {{ __('Employee Name') }}</label>
                @error('employee_name')
                    <span class=" text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Employee Email -->
            <div class="form-field">
                <input type="email" id="email" placeholder="" name="email" required
                    value="{{ old('email') ?? $employee->user->email }}" />
                <label for="email">
                    {{ __('Employee Email') }}
                </label>
                @error('email')
                    <span class=" text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Employer Name -->
            @if (auth('web')->user()->role != 'employer')
                <div class="form-field">
                    <select name="employer_id" id="employer_id" class="form-select">

                        @foreach ($employers as $employer)
                            <option class="dark:bg-slate-800   text-text-light  
 dark:text-text-dark  " value="{{ $employer->id }}"
                                {{ $employee->employer_id == $employer->id ? 'selected' : '' }}>
                                {{ $employer->employer_name }}
                            </option>
                        @endforeach

                    </select>
                    <label for="employer_id" class="form-label">
                        {{ __('Employee Name') }}
                    </label>
                </div>
            @endif
            @if (auth('web')->user()->role == 'employer')
                <input type="hidden" name="employer_id" value="{{ auth('web')->user()->employer->id }}">
            @endif
            <!-- Phone -->
            <div class="form-field">
                <input type="text" name="phone" id="phone" value="{{ $employee->phone }}" />
                <label for="phone">
                    {{ __('Phone') }}</label>
                @error('phone')
                    <span class=" text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- profile  pic -->
            @if (auth('web')->user()->role == 'employee')
                <div class="form-field">
                    <label for="file" class="block text-gray-600 font-medium"> {{ __('Choose a file') }}:</label>
                    <input type="file" id="file" name="image" class="mt-1 p-2 border rounded-md w-full">
                </div>
            @endif
            <div class="grid md:grid-cols-2 md:gap-6">
                <!-- Client -->
                <div class="form-field">
                    <select name="client_id" id="client_id"
                        class="form-select">
                        @foreach ($clients as $client)
                            <option class="dark:bg-slate-800   text-text-light  
 dark:text-text-dark  " value="{{ $client->id }}"
                                {{ $client->id == $employee->client_id ? 'selected' : '' }}>
                                {{ $client->client_name }}
                            </option>
                        @endforeach
                    </select>
                    <label for="client_id" class="form-label">
                        {{ __('Client Name') }}
                    </label>
                </div>
                <!-- Gender -->
                <div class="form-field">
                    <select name="gender" id="project_id" class="form-select">
                        <option class="dark:bg-slate-800   text-text-light  
 dark:text-text-dark  " value="male"
                            {{ 'male' == $employee->gender ? 'selected' : '' }}>
                            {{ __('Male') }}
                        </option>
                        <option class="dark:bg-slate-800   text-text-light  
 dark:text-text-dark  " value="female"
                            {{ 'female' == $employee->gender ? 'selected' : '' }}>
                            {{ __('Female') }}
                        </option>
                        <option class="dark:bg-slate-800   text-text-light  
 dark:text-text-dark  " value="other"
                            {{ 'other' == $employee->gender ? 'selected' : '' }}>
                            {{ __('Other') }}
                        </option>
                    </select>
                    <label for="project_id" class="form-label">
                        {{ __('Gender') }}</label>
                </div>
                <!-- Payment Type -->
                <div class="form-field">
                    <select name="payment_type" id="payment_type" class="form-select">
                        <option class="dark:bg-slate-800   text-text-light  
 dark:text-text-dark  " value="monthly"
                            {{ 'monthly' == $employee->payment_type ? 'selected' : '' }}>
                            {{ __('Monthly Salary') }}</option>
                        <option class="dark:bg-slate-800   text-text-light  
 dark:text-text-dark  " value="project"
                            {{ 'project' == $employee->payment_type ? 'selected' : '' }}>
                            {{ __('Project Based') }}</option>
                    </select>
                    <label for="payment_type" class="form-label">
                        {{ __('Payment Type') }}</label>
                </div>

                <!-- Monthly Salary (visible if fixed salary selected) -->
                <div id="monthly_salary_field" class="form-field">
                    <input type="text" name="monthly_salary" id="monthly_salary"
                        value="{{ old('monthly_salary') ?? $employee->monthly_salary }}" />
                    <label for="monthly_salary">
                        {{ __('Monthly Salary Per-month ($)') }}</label>
                    @error('monthly_salary')
                        <span class=" text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Project Details (visible if project based selected) -->
                <div id="project_details_field" style="display: none;">
                    <!-- Employee Share -->
                    <div class="form-field">
                        <input type="text" name="employee_share" id="employee_share"
                            value="{{ old('employee_share') ?? $employee->employee_share }}" maxlength="3"
                            max="99" />
                        <label for="employee_share">
                            {{ __('Employee Share (%)') }}</label>
                        @error('employee_share')
                            <span class=" text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Billing Rate -->
                    <div class="form-field">
                        <input type="text" name="billing_rate" id="billing_rate"
                            value="{{ old('billing_rate') ?? $employee->billing_rate }}" />
                        <label for="billing_rate">
                            {{ __('Billing rate Per-hr ($)') }} </label>
                        @error('billing_rate')
                            <span class=" text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit"
                class="text-white bg-primary-300 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-primary-300 dark:hover:bg-primary-300 dark:focus:ring-primary-800">
                {{ __('Submit') }}</button>
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
