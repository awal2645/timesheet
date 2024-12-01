@section('title')
    {{ __('Create Project') }}
@endsection



@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<x-app-layout>
    <div class="m-6 card">
        <h2 class="text-2xl font-bold mb-4">{{ __('Create New Project') }}</h2>

        <form method="POST" action="{{ route('project.store') }}" class=" grid grid-cols-1 md:grid-cols-2 gap-8">
            @csrf

            @if (auth('web')->user()->role != 'employer')
                <div class="form-field">
                    <select name="employer_id" id="employer_id" class="form-select">
                        <option class="dark:bg-slate-800   text-text-light  
 dark:text-text-dark  " value="" selected>
                            {{ __('Select Employer') }}
                        </option>
                        @foreach ($employers as $employer)
                            <option class="dark:bg-slate-800   text-text-light  
 dark:text-text-dark  " value="{{ $employer->id }}">
                                {{ $employer->employer_name }}
                            </option>
                        @endforeach
                    </select>
                    <label for="employer_id" class="form-label">
                        {{ __('Select Employer') }}</label>

                    @error('employer_id')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>
            @endif

            @if (auth('web')->user()->role == 'employer')
                <input type="hidden" name="employer_id" value="{{ auth('web')->user()->employer->id }}">
            @endif

            <div class="form-field">
                <select name="client_id" id="client_id" class="form-select">
                    <option class="dark:bg-slate-800   text-text-light  
 dark:text-text-dark  " value="" selected>
                        {{ __('Select Client') }}
                    </option>
                    @foreach ($clients as $client)
                        <option class="dark:bg-slate-800   text-text-light  
 dark:text-text-dark  " value="{{ $client->id }}">
                            {{ $client->client_name }}
                        </option>
                    @endforeach
                </select>
                @error('client_id')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
                <label for="client_id" class="form-label">
                    {{ __('Select Client') }}</label>
            </div>

            <div class="form-field">
                <select name="employee_id" id="employee_id" class="form-select">
                    <option class="dark:bg-slate-800   text-text-light  
 dark:text-text-dark  " value="" selected>
                        {{ __('Select Employee') }}
                    </option>
                    @foreach ($employees as $employee)
                        <option class="dark:bg-slate-800   text-text-light  
 dark:text-text-dark  " value="{{ $employee->id }}">
                            {{ $employee->employee_name }}
                        </option>
                    @endforeach
                </select>
                <label for="employee_id" class="form-label">
                    {{ __('Select Employee') }}</label>

                @error('employee_id')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-field">
                <input type="text" name="project_name" id="project_name" placeholder=" " required />
                <label for="project_name">
                    {{ __('Project Name') }}</label>

                @error('project_name')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-field">
                <select name="payment_type" id="payment_type" class="form-select">
                    <option class="dark:bg-slate-800   text-text-light  
 dark:text-text-dark  " value="hourly"
                        {{ old('payment_type') == 'hourly' ? 'selected' : '' }}>
                        {{ __('Hourly Based') }}
                    </option>
                    <option class="dark:bg-slate-800   text-text-light  
 dark:text-text-dark  " value="fixed"
                        {{ old('payment_type') == 'fixed' ? 'selected' : '' }}>
                        {{ __('Fixed Price') }}
                    </option>
                    <option class="dark:bg-slate-800   text-text-light  
 dark:text-text-dark  " value="non"
                        {{ old('payment_type') == 'non' ? 'selected' : '' }}>
                        {{ __('Non Billable') }}
                    </option>
                </select>
                <label for="payment_type" class="form-label">
                    {{ __('Billing Type') }}</label>
            </div>

            <!-- Hourly Budget -->
            <div id="hourly" class="form-field">
                <input type="text" name="hr_budget" id="hr_budget" value="{{ old('hr_budget') }}" />
                <label for="hr_budget">
                    {{ __('Per-Hour ($)') }}</label>
                @error('hr_budget')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Fixed Budget -->
            <div id="fixed" class="relative z-0 w-full mb-5 group hidden">
                <input type="text" name="fixed_budget" id="fixed_budget" value="{{ old('fixed_budget') }}" />
                <label for="fixed_budget">
                    {{ __('Total Project Budget ($)') }}</label>
                @error('fixed_budget')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-field">
                <input type="text" name="total_paid" id="total_paid" value="{{ old('total_paid') }}" />
                <label for="total_paid">
                    {{ __('Total Paid ($)') }}</label>
            </div>

            <div class="col-span-full">
                <button type="submit"
                    class="px-4 py-2 text-white bg-primary-500 rounded-lg hover:bg-primary-300 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-300 dark:hover:bg-primary-400 dark:focus:ring-primary-600 font-medium text-sm">
                    {{ __('Create Project') }}
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let paymentTypeSelect = document.getElementById('payment_type');
        let hourlyBudgetDiv = document.getElementById('hourly');
        let fixedBudgetDiv = document.getElementById('fixed');

        paymentTypeSelect.addEventListener('change', function() {
            togglePaymentFields(this.value);
        });

        // Initial load
        togglePaymentFields(paymentTypeSelect.value);

        function togglePaymentFields(paymentType) {
            if (paymentType === 'hourly') {
                hourlyBudgetDiv.classList.remove('hidden');
                fixedBudgetDiv.classList.add('hidden');
            } else if (paymentType === 'project') {
                hourlyBudgetDiv.classList.add('hidden');
                fixedBudgetDiv.classList.remove('hidden');
            } else {
                hourlyBudgetDiv.classList.add('hidden');
                fixedBudgetDiv.classList.add('hidden');
            }
        }
    });
</script>
