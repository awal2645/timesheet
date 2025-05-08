@section('title')
{{ __('Edit Employee') }}
@endsection
<x-app-layout>
    <div class="flex justify-between items-center m-6 card">
        <h2 class="text-xl font-medium text-text-light dark:text-text-dark">{{ __('Edit Employee') }}</h2>
        <a href="{{ route('employee.index') }}"
            class="btn bg-primary-50 dark:bg-primary-50 text-text-light dark:text-text-dark">{{ __('Go to Employee List') }}</a>
    </div>
    <div class="m-6 card">
        <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark">
            @if (Request::path() == 'my/account')
            {{ __('Update Account info') }}
            @else
            {{ __('Edit Employee') }}
            @endif
        </h2>
        <form method="POST" action="{{ route('employee.update', ['id' => $employee->id]) }}"
            enctype="multipart/form-data" class="grid md:grid-cols-2 md:gap-6">
            @csrf
            @method('PUT')

            <!-- Employee Name -->
            <div class="form-field">
                <input type="text" id="employee_name" placeholder=" " required name="employee_name"
                    value="{{ old('employee_name') ?? $employee->employee_name }}" />
                <label for="employee_name">{{ __('Employee Name') }}</label>
                @error('employee_name')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Employee Email -->
            <div class="form-field">
                <input type="email" id="email" placeholder="" name="email" required
                    value="{{ old('email') ?? $employee->user->email }}" />
                <label for="email">{{ __('Employee Email') }}</label>
                @error('email')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Employer Name -->
            @if (auth('web')->user()->role != 'employer')
            <div class="form-field">
                <select name="employer_id" id="employer_id" class="select2">
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="" disabled selected>
                        {{ __('Select Employer') }}
                    </option>
                    @foreach ($employers as $employer)
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" 
                        value="{{ $employer->id }}" 
                        {{ $employee->employer_id == $employer->id ? 'selected' : '' }}>
                        {{ $employer->employer_name }}
                    </option>
                    @endforeach
                </select>
                @error('employer_id')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            @endif
            @if (auth('web')->user()->role == 'employer')
            <input type="hidden" name="employer_id" value="{{ auth('web')->user()->employer->id }}">
            @endif

            <!-- Phone -->
            <div class="form-field">
                <input type="text" name="phone" id="phone" value="{{ old('phone') ?? $employee->phone }}" />
                <label for="phone">{{ __('Phone') }}</label>
                @error('phone')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Total Leave -->
            <div class="form-field">
                <input type="number" name="total_leave" id="total_leave" value="{{ old('total_leave') ?? $employee->total_leave }}" />
                <label for="total_leave">{{ __('Total Leave') }}</label>
                @error('total_leave')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Client -->
            <div class="form-field">
                <select name="client_id" id="client_id" class="select2">
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="" disabled selected>
                        {{ __('Select Client') }}
                    </option>
                    @if (auth('web')->user()->role == 'employer')
                        @foreach ($clients as $client)
                        <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" 
                            value="{{ $client->id }}" 
                            {{ $client->id == $employee->client_id ? 'selected' : '' }}>
                            {{ $client->client_name }}
                        </option>
                        @endforeach
                    @endif
                </select>
                @error('client_id')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Gender -->
            <div class="form-field">
                <select name="gender" id="gender_id" class="select2">
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="male" {{ $employee->gender == 'male' ? 'selected' : '' }}>
                        {{ __('Male') }}
                    </option>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="female" {{ $employee->gender == 'female' ? 'selected' : '' }}>
                        {{ __('Female') }}
                    </option>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="other" {{ $employee->gender == 'other' ? 'selected' : '' }}>
                        {{ __('Other') }}
                    </option>
                </select>
                @error('gender')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Payment Type -->
            <div class="form-field">
                <select name="payment_type" id="payment_type" class="select2">
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="" disabled selected>
                        {{ __('Select Payment Type') }}
                    </option>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" 
                        value="monthly" 
                        {{ $employee->payment_type == 'monthly' ? 'selected' : '' }}>
                        {{ __('Monthly Salary') }}
                    </option>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" 
                        value="project" 
                        {{ $employee->payment_type == 'project' ? 'selected' : '' }}>
                        {{ __('Project Based') }}
                    </option>
                </select>
                @error('payment_type')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Monthly Salary -->
            <div id="monthly_salary_field" class="form-field">
                <input type="number" step="0.01" name="monthly_salary" id="monthly_salary"
                    value="{{ old('monthly_salary') ?? $employee->monthly_salary }}" />
                <label for="monthly_salary">{{ __('Monthly Salary Per-month ($)') }}</label>
                @error('monthly_salary')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Project Details -->
            <div id="project_details_field" style="display: none;">
                <!-- Employee Share -->
                <div class="form-field">
                    <input type="number" name="employee_share" id="employee_share"
                        value="{{ old('employee_share') ?? $employee->employee_share }}"
                        min="0" max="100" step="0.01" />
                    <label for="employee_share">{{ __('Employee Share (%)') }}</label>
                    @error('employee_share')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Billing Rate -->
                <div class="form-field">
                    <input type="number" step="0.01" name="billing_rate" id="billing_rate"
                        value="{{ old('billing_rate') ?? $employee->billing_rate }}" />
                    <label for="billing_rate">{{ __('Billing Rate Per-hr ($)') }}</label>
                    @error('billing_rate')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Profile Picture -->
            @if (auth('web')->user()->role == 'employee')
            <div class="form-field">
                <label for="file" class="block text-gray-600 font-medium">{{ __('Choose a file') }}:</label>
                <input type="file" id="file" name="image" class="mt-1 p-2 border rounded-md w-full">
            </div>
            @endif

            <div class="col-span-full">
                <button type="submit"
                    class="text-text-light dark:text-text-dark bg-primary-50 dark:bg-primary-50 hover:bg-primary-50 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                    {{ __('Update Employee') }}
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM Content Loaded');
            
            let employerSelect = document.getElementById('employer_id');
            let clientSelect = document.getElementById('client_id');
            let paymentTypeSelect = document.getElementById('payment_type');
            let monthlySalaryField = document.getElementById('monthly_salary_field');
            let projectDetailsField = document.getElementById('project_details_field');

            console.log('Elements found:', {
                employerSelect: !!employerSelect,
                clientSelect: !!clientSelect,
                paymentTypeSelect: !!paymentTypeSelect,
                monthlySalaryField: !!monthlySalaryField,
                projectDetailsField: !!projectDetailsField
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
            if (clientSelect) {
                $(clientSelect).select2({
                    theme: 'classic',
                    width: '100%'
                });
            }
            if (paymentTypeSelect) {
                $(paymentTypeSelect).select2({
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
                    if (clientSelect) {
                        $(clientSelect).empty().append('<option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="" disabled selected>{{ __('Select Client') }}</option>');
                    }

                    if (employerId) {
                        // Fetch clients
                        fetch(`/get/client/${employerId}`, {
                            headers: {
                                'X-CSRF-TOKEN': token,
                                'Accept': 'application/json'
                            },
                            credentials: 'same-origin'
                        })
                            .then(response => {
                                if (!response.ok) {
                                    if (response.status === 401) {
                                        throw new Error('Unauthorized - Please log in');
                                    }
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                if (clientSelect) {
                                    data.forEach(client => {
                                        const option = new Option(client.client_name, client.id, false, false);
                                        option.className = 'dark:bg-slate-800 text-text-light dark:text-text-dark';
                                        $(clientSelect).append(option);
                                    });
                                    $(clientSelect).trigger('change');
                                }
                            })
                            .catch(error => {
                                console.error('Error fetching clients:', error);
                                alert('Error loading clients. Please try again.');
                            });
                    }
                });
            }

            // Function to show/hide fields based on payment type
            function toggleFields() {
                if (paymentTypeSelect.value === 'monthly') {
                    monthlySalaryField.style.display = 'block';
                    projectDetailsField.style.display = 'none';
                } else if (paymentTypeSelect.value === 'project') {
                    monthlySalaryField.style.display = 'none';
                    projectDetailsField.style.display = 'block';
                } else {
                    monthlySalaryField.style.display = 'none';
                    projectDetailsField.style.display = 'none';
                }
            }

            // Initially toggle fields based on selected payment type
            toggleFields();

            // Listen for change events on the payment type select
            if (paymentTypeSelect) {
                $(paymentTypeSelect).on('select2:select', function(e) {
                    toggleFields();
                });
            }
        });
    </script>
</x-app-layout>