@section('title')
{{ __('Create Employee') }}
@endsection
<x-app-layout>
    <div class="flex justify-between items-center m-6 card">
        <h2 class="text-xl font-medium text-text-light dark:text-text-dark">{{ __('Create Employee') }}</h2>
        <a href="{{ route('employee.index') }}"
            class="btn bg-primary-50 dark:bg-primary-50 text-text-light dark:text-text-dark">{{ __('Go to Employee List') }}</a>
    </div>
    
    <div class="card m-6">
        <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark"> {{ __('Create Employee') }}</h2>
        <form method="POST" action="{{ route('employee.store') }}" class="card">
            @csrf
            <div class="grid md:grid-cols-2 md:gap-6">
                <!-- Employee Name -->
                <div class="form-field">
                    <input type="text" id="employee_name" placeholder="" required name="employee_name"
                        value="{{ old('employee_name') }}" />
                    <label for="employee_name">
                        {{ __('Employee Name') }}
                    </label>
                    @error('employee_name')
                    <span class=" text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Employee Email -->
                <div class="form-field">
                    <input type="email" id="email" placeholder="" name="email" required value="{{ old('email') }}" />
                    <label for="email" class="form-label">
                        {{ __('Employee Email') }}</label>
                    @error('email')
                    <span class=" text-red-500">{{ $message }}</span>
                    @enderror
                </div>
    
                <!-- Employer Name -->
                @if (auth('web')->user()->role != 'employer')
    
                <div class="form-field">
                    <select name="employer_id" id="employer_id" class="form-select">
                        <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="" disabled>{{ __('Select Employer') }}</option>
                        @foreach ($employers as $employer)
                        <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="{{ $employer->id }}">
                            {{ $employer->employer_name }}
                        </option>
                        @endforeach
                    </select>
                    <label for="employer_id" class="form-label">
                        {{ __('Employer Name') }}
                    </label>
                    @error('employer_id')
                    <span class=" text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                @endif
                @if (auth('web')->user()->role == 'employer')
                <input type="hidden" name="employer_id" value="{{ auth('web')->user()->employer->id }}">
                @endif

                <!-- Phone -->
                <div class="form-field">
                    <input type="text" name="phone" id="phone" placeholder=" " value="{{ old('phone') }}" />
                    <label for="phone">
                        {{ __('Phone') }}</label>
                    @error('phone')
                    <span class=" text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Total Leave -->
                <div class="form-field">
                    <input type="number" name="total_leave" id="total_leave" placeholder=" " value="{{ old('total_leave') }}" />
                    <label for="total_leave" class="form-label">
                        {{ __('Total Leave') }}</label>
                </div>
                <!-- Client -->
                <div class="form-field">
                    <select name="client_id" id="client_id" class="form-select">

                        @foreach ($clients as $client)
                        <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="{{ $client->id }}">
                            {{ $client->client_name }}
                        </option>
                        @endforeach

                    </select>
                    <label for="client_id" class="form-label">
                        {{ __('Client Name') }}</label>
                    @error('client_id')
                    <span class=" text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Gender -->
                <div class="form-field">
                    <select name="gender" id="gender_id" class="form-select">
                        <option class="dark:bg-slate-800   text-text-light  
 dark:text-text-dark  " value="male">
                            {{ __('Male') }}
                        </option>
                        <option class="dark:bg-slate-800   text-text-light  
 dark:text-text-dark  " value="female">
                            {{ __('Female') }}
                        </option>
                        <option class="dark:bg-slate-800   text-text-light  
 dark:text-text-dark  " value="other">
                            {{ __('Other') }}
                        </option>
                    </select>
                    <label for="project_id" class="form-label">
                        {{ __('Gender') }}</label>
                    @error('gender')
                    <span class=" text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Payment Type -->
                <div class="form-field">
                    <select name="payment_type" id="payment_type" class="form-select">
                        <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="monthly"
                            {{ 'monthly' == old('payment_type') ? 'selected' : '' }}>
                            {{ __('Monthly Salary') }}</option>
                        <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="project"
                            {{ 'project' == old('payment_type') ? 'selected' : '' }}>
                            {{ __('Project Based') }}</option>
                            
                        @error('payment_type')
                        <span class=" text-red-500">{{ $message }}</span>
                        @enderror
                    </select>
                    <label for="payment_type" class="form-label">
                        {{ __('Payment Type') }}</label>
                </div>

                <!-- Monthly Salary (visible if fixed salary selected) -->
                <div id="monthly_salary_field" class="form-field">
                    <input type="text" name="monthly_salary" id="monthly_salary" value="{{ old('monthly_salary') }}" />
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
                        <input type="text" name="employee_share" id="employee_share" value="{{ old('employee_share') }}"
                            maxlength="3" max="99" />
                        <label for="employee_share">
                            {{ __('Employee share share (%)') }}</label>
                        @error('employee_share')
                        <span class=" text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Billing Rate -->
                    <div class="form-field">
                        <input type="text" name="billing_rate" id="billing_rate" value="{{ old('billing_rate') }}" />
                        <label for="billing_rate">
                            {{ __('Billing rate Per-hr ($)') }}</label>
                        @error('billing_rate')
                        <span class=" text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit"
                class="text-text-light dark:text-text-dark bg-primary-50 dark:bg-primary-50 hover:bg-primary-50 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">{{
                __('Submit') }}</button>

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