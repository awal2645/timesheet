@section('title')
    {{ __('Create Project') }}
@endsection
<x-app-layout>
    <div class="flex justify-between items-center m-6 card">
        <h2 class="text-xl font-medium text-text-light dark:text-text-dark">{{ __('Create Project') }}</h2>
        <a href="{{ route('project.index') }}"
            class="btn bg-primary-50 dark:bg-primary-50 text-text-light dark:text-text-dark">{{ __('Go to Project List') }}</a>
    </div>
    <div class="m-6 card">
        <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark">{{ __('Create New Project') }}</h2>

        <form method="POST" action="{{ route('project.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @csrf

            @if (auth('web')->user()->role != 'employer')
                <div class="form-field">
                    <select name="employer_id" id="employer_id" class="select2">
                        <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="" disabled selected>
                            {{ __('Select Employer') }}
                        </option>
                        @foreach ($employers as $employer)
                            <option class="dark:bg-slate-800 text-text-light dark:text-text-dark"
                                value="{{ $employer->id }}">
                                {{ $employer->employer_name }}
                            </option>
                        @endforeach
                    </select>

                    @error('employer_id')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-field">
                    <select name="client_id" id="client_id" class="select2">
                        <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="" disabled selected>
                            {{ __('Select Client') }}
                        </option>
                        <!-- Clients will be populated here based on employer selection -->
                    </select>
                    @error('client_id')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>


                <div class="form-field">
                    <select name="employee_id" id="employee_id" class="select2">
                        <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="" disabled selected>
                            {{ __('Select Employee') }}
                        </option>
                        <!-- Employees will be populated here based on employer selection -->
                    </select>

                    @error('employee_id')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            @elseif (auth('web')->user()->role == 'employer')
                <div class="form-field">
                    <select name="client_id" id="client_id" class="select2">
                        @foreach ($clients as $client)
                            <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value=""
                                selected>
                                {{ __('Select Client') }}
                            </option>
                            <option class="dark:bg-slate-800 text-text-light dark:text-text-dark"
                                value="{{ $client->id }}">
                                {{ $client->client_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('client_id')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                    <label for="client_id" class="form-label">{{ __('Select Client') }}</label>
                </div>


                <div class="form-field">
                    <select name="employee_id" id="employee_id" class="select2">
                        <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="" selected>
                            {{ __('Select Employee') }}
                        </option>
                        @foreach ($employees as $employee)
                            <option class="dark:bg-slate-800 text-text-light dark:text-text-dark"
                                value="{{ $employee->id }}">
                                {{ $employee->employee_name }}
                            </option>
                        @endforeach
                    </select>
                    <label for="employee_id" class="form-label">{{ __('Select Employee') }}</label>

                    @error('employee_id')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>


            @endif

            @if (auth('web')->user()->role == 'employer')
                <input type="hidden" name="employer_id" value="{{ auth('web')->user()->employer->id }}">
            @endif



            <div class="form-field">
                <input type="text" name="project_name" id="project_name" placeholder=" " required />
                <label for="project_name">{{ __('Project Name') }}</label>

                @error('project_name')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-field">
                <select name="payment_type" id="payment_type" class="select2">
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="hourly"
                        {{ old('payment_type') == 'hourly' ? 'selected' : '' }}>
                        {{ __('Hourly Based') }}
                    </option>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="fixed"
                        {{ old('payment_type') == 'fixed' ? 'selected' : '' }}>
                        {{ __('Fixed Price') }}
                    </option>
                </select>
            </div>

            <!-- Hourly Budget -->
            <div id="hourly" class="form-field">
                <input type="text" name="hr_budget" id="hr_budget" value="{{ old('hr_budget') }}" />
                <label for="hr_budget">{{ __('Per-Hour ($)') }}</label>
                @error('hr_budget')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Total Cost -->
            <div id="total_cost" class="form-field">
                <input type="text" name="total_cost" id="total_cost" value="{{ old('total_cost') }}" />
                <label for="total_cost">{{ __('Total Cost ($)') }}</label>
            </div>

            <!-- Total Paid Client -->
            <div class="form-field">
                <input type="text" name="total_paid_client" id="total_paid_client"
                    value="{{ old('total_paid_client') }}" />
                <label for="total_paid_client">{{ __('Total Paid Client ($)') }}</label>
            </div>

            <div class="col-span-full">
                <button type="submit"
                    class="px-4 py-2 text-text-light dark:text-text-dark bg-primary-50 rounded-md hover:bg-primary-50 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-50 dark:hover:bg-primary-400 dark:focus:ring-primary-600 font-medium text-sm">
                    {{ __('Create Project') }}
                </button>
            </div>
        </form>
    </div>
</x-app-layout>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        console.log('DOM Content Loaded');
        
        let employerSelect = document.getElementById('employer_id');
        let clientSelect = document.getElementById('client_id');
        let employeeSelect = document.getElementById('employee_id');
        let paymentTypeSelect = document.getElementById('payment_type');
        let hourlyBudgetDiv = document.getElementById('hourly');
        let totalCostDiv = document.getElementById('total_cost');

        console.log('Elements found:', {
            employerSelect: !!employerSelect,
            clientSelect: !!clientSelect,
            employeeSelect: !!employeeSelect,
            paymentTypeSelect: !!paymentTypeSelect,
            hourlyBudgetDiv: !!hourlyBudgetDiv,
            totalCostDiv: !!totalCostDiv
        });

        if (!totalCostDiv) {
            console.error('Element with id "total_cost" not found.');
            return;
        }

        // Get CSRF token from meta tag
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // // Initialize Select2 on all select elements
        // if (employerSelect) {
        //     $(employerSelect).select2({
        //         theme: 'classic',
        //         width: '100%'
        //     });
        // }
        // if (clientSelect) {
        //     $(clientSelect).select2({
        //         theme: 'classic',
        //         width: '100%'
        //     });
        // }
        // if (employeeSelect) {
        //     $(employeeSelect).select2({
        //         theme: 'classic',
        //         width: '100%'
        //     });
        // }
        // if (paymentTypeSelect) {
        //     $(paymentTypeSelect).select2({
        //         theme: 'classic',
        //         width: '100%'
        //     });
        // }

        // Only add employer change listener if employer select exists
        if (employerSelect) {
            console.log('Adding employer change listener');
            $(employerSelect).on('select2:select', function(e) {
                const employerId = e.params.data.id;
                console.log('Employer selected:', employerId);

                // Clear previous options
                if (clientSelect) {
                    $(clientSelect).empty().append('<option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="" selected>{{ __('Select Client') }}</option>');
                }
                if (employeeSelect) {
                    $(employeeSelect).empty().append('<option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="" selected>{{ __('Select Employee') }}</option>');
                }

                if (employerId) {
                    console.log('Fetching clients for employer:', employerId);
                    // Fetch clients
                    fetch(`/get/client/${employerId}`, {
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json'
                        },
                        credentials: 'same-origin'
                    })
                        .then(response => {
                            console.log('Client API Response:', response);
                            if (!response.ok) {
                                if (response.status === 401) {
                                    throw new Error('Unauthorized - Please log in');
                                }
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Client data received:', data);
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

                    console.log('Fetching employees for employer:', employerId);
                    // Fetch employees
                    fetch(`/get/employee/${employerId}`, {
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json'
                        },
                        credentials: 'same-origin'
                    })
                        .then(response => {
                            console.log('Employee API Response:', response);
                            if (!response.ok) {
                                if (response.status === 401) {
                                    throw new Error('Unauthorized - Please log in');
                                }
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Employee data received:', data);
                            if (employeeSelect) {
                                data.forEach(employee => {
                                    const option = new Option(employee.employee_name, employee.id, false, false);
                                    option.className = 'dark:bg-slate-800 text-text-light dark:text-text-dark';
                                    $(employeeSelect).append(option);
                                });
                                $(employeeSelect).trigger('change');
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching employees:', error);
                            alert('Error loading employees. Please try again.');
                        });
                }
            });
        } else {
            console.log('Employer select element not found');
        }

        if (paymentTypeSelect) {
            $(paymentTypeSelect).on('select2:select', function(e) {
                togglePaymentFields(e.params.data.id);
            });

            // Initial load
            togglePaymentFields($(paymentTypeSelect).val());
        }

        function togglePaymentFields(paymentType) {
            if (paymentType === 'hourly') {
                if (hourlyBudgetDiv) hourlyBudgetDiv.style.display = 'block';
                if (totalCostDiv) totalCostDiv.style.display = 'none';
            } else {
                if (hourlyBudgetDiv) hourlyBudgetDiv.style.display = 'none';
                if (totalCostDiv) totalCostDiv.style.display = 'block';
            }
        }
    });
</script>
