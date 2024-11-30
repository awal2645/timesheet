@section('title')
    {{ __('Create Employee') }}
@endsection
<x-app-layout>
    <div class="card m-6">
        <h2 class="text-2xl font-bold mb-4"> {{ __('Create Employee') }}</h2>
        <form method="POST" action="{{ route('employee.store') }}" class="card">
            @csrf
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
                <input type="email" id="email" placeholder="" name="email" required
                    value="{{ old('email') }}" />
                <label for="email">
                    {{ __('Employee Email') }}</label>
                @error('email')
                    <span class=" text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Employer Name -->
            @if (auth('web')->user()->role != 'employer')

                <div class="form-field">
                    <select name="employer_id" id="employer_id" class="form-select">
                        @foreach ($employers as $employer)
                            <option class="dark:bg-slate-800" value="{{ $employer->id }}">
                                {{ $employer->employer_name }}
                            </option>
                        @endforeach
                    </select>
                    <label for="employer_id" class="form-label">
                        {{ __('Employer Name') }}</label>
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
            <div class="grid md:grid-cols-2 md:gap-6">
                <!-- Client -->
                <div class="form-field">
                    <select name="client_id" id="client_id"
                        class="form-select">

                        @foreach ($clients as $client)
                            <option class="dark:bg-slate-800" value="{{ $client->id }}">
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
                        <option class="dark:bg-slate-800" value="male">
                            {{ __('Male') }}
                        </option>
                        <option class="dark:bg-slate-800" value="female">
                            {{ __('Female') }}
                        </option>
                        <option class="dark:bg-slate-800" value="other">
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
                        <option class="dark:bg-slate-800" value="monthly"
                            {{ 'monthly' == old('payment_type') ? 'selected' : '' }}>
                            {{ __('Monthly Salary') }}</option>
                        <option class="dark:bg-slate-800" value="project"
                            {{ 'project' == old('payment_type') ? 'selected' : '' }}>
                            {{ __('Project Based') }}</option>
                    </select>
                    <label for="payment_type" class="form-label">
                        {{ __('Payment Type') }}</label>
                </div>

                <!-- Monthly Salary (visible if fixed salary selected) -->
                <div id="monthly_salary_field" class="form-field">
                    <input type="text" name="monthly_salary" id="monthly_salary"
                        value="{{ old('monthly_salary') }}" />
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
                            value="{{ old('employee_share') }}" maxlength="3" max="99" />
                        <label for="employee_share">
                            {{ __('Employee share share (%)') }}</label>
                        @error('employee_share')
                            <span class=" text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Billing Rate -->
                    <div class="form-field">
                        <input type="text" name="billing_rate" id="billing_rate"
                            value="{{ old('billing_rate') }}" />
                        <label for="billing_rate">
                            {{ __('Billing rate Per-hr ($)') }}</label>
                        @error('billing_rate')
                            <span class=" text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit"
                class="text-white bg-primary-300 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-primary-300 dark:hover:bg-primary-300 dark:focus:ring-primary-800">{{ __('Submit') }}</button>

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
