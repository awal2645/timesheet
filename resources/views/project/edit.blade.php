@section('title')
    {{ __('Edit Project') }}
@endsection
<x-app-layout>
    <div class="flex justify-between items-center m-6 card">
        <h2 class="text-xl font-medium text-text-light dark:text-text-dark">{{ __('Edit Project') }}</h2>
        <a href="{{ route('project.index') }}"
            class="btn bg-primary-50 dark:bg-primary-50 text-text-light dark:text-text-dark">{{ __('Go to Project List') }}</a>
    </div>
    <div class="m-6 card">
        <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark">{{ __('Edit Project') }}</h2>
        <form method="POST" action="{{ route('project.update', $project->id) }}"
            class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @csrf
            @method('PUT')

            @if (auth('web')->user()->role != 'employer')
                <div class="form-field">
                    <select name="employer_id" id="employer_id" class="select2">
                        <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="" disabled selected>
                            {{ __('Select Employer') }}
                        </option>
                        @foreach ($employers as $employer)
                            <option class="dark:bg-slate-800 text-text-light dark:text-text-dark"
                                value="{{ $employer->id }}"
                                {{ $project->employer_id == $employer->id ? 'selected' : '' }}>
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
                        @foreach ($clients as $client)
                            <option class="dark:bg-slate-800 text-text-light dark:text-text-dark"
                                value="{{ $client->id }}" {{ $project->client_id == $client->id ? 'selected' : '' }}>
                                {{ $client->client_name }}
                            </option>
                        @endforeach
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
                        @foreach ($employees as $employee)
                            <option class="dark:bg-slate-800 text-text-light dark:text-text-dark"
                                value="{{ $employee->id }}"
                                {{ $project->employee_id == $employee->id ? 'selected' : '' }}>
                                {{ $employee->employee_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('employee_id')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            @elseif (auth('web')->user()->role == 'employer')
                <input type="hidden" name="employer_id" value="{{ auth('web')->user()->employer->id }}">
                
                <div class="form-field">
                    <select name="client_id" id="client_id" class="select2">
                        <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="" disabled selected>
                            {{ __('Select Client') }}
                        </option>
                        @foreach ($clients as $client)
                            <option class="dark:bg-slate-800 text-text-light dark:text-text-dark"
                                value="{{ $client->id }}" {{ $project->client_id == $client->id ? 'selected' : '' }}>
                                {{ $client->client_name }}
                            </option>
                        @endforeach
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
                        @foreach ($employees as $employee)
                            <option class="dark:bg-slate-800 text-text-light dark:text-text-dark"
                                value="{{ $employee->id }}"
                                {{ $project->employee_id == $employee->id ? 'selected' : '' }}>
                                {{ $employee->employee_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('employee_id')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            @endif

            <div class="form-field">
                <input type="text" name="project_name" id="project_name" placeholder=" " required
                    value="{{ $project->project_name }}" />
                <label for="project_name">{{ __('Project Name') }}</label>
                @error('project_name')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-field">
                <select name="payment_type" id="payment_type" class="select2">
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="hourly"
                        {{ $project->payment_type == 'hourly' ? 'selected' : '' }}>
                        {{ __('Hourly Based') }}
                    </option>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="fixed"
                        {{ $project->payment_type == 'fixed' ? 'selected' : '' }}>
                        {{ __('Fixed Price') }}
                    </option>
                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="non"
                        {{ $project->payment_type == 'non' ? 'selected' : '' }}>
                        {{ __('Non Billable') }}
                    </option>
                </select>
            </div>

            <!-- Hourly Budget -->
            <div id="hourly" class="form-field">
                <input type="number" step="0.01" name="hr_budget" id="hr_budget"
                    value="{{ old('hr_budget') ?? $project->hr_budget }}" />
                <label for="hr_budget">{{ __('Per-Hour ($)') }}</label>
                @error('hr_budget')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Fixed Budget -->
            <div id="fixed" class="form-field hidden">
                <input type="number" step="0.01" name="fixed_budget" id="fixed_budget"
                    value="{{ old('fixed_budget') ?? $project->fixed_budget }}" />
                <label for="fixed_budget">{{ __('Total Project Budget ($)') }}</label>
                @error('fixed_budget')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-field">
                <input type="number" step="0.01" name="total_cost" id="total_cost"
                    value="{{ old('total_cost') ?? $project->total_cost }}" />
                <label for="total_cost">{{ __('Total Cost ($)') }}</label>
            </div>

            <div class="form-field">
                <input type="number" step="0.01" name="total_paid_client" id="total_paid_client"
                    value="{{ old('total_paid_client') ?? $project->total_paid_client }}" />
                <label for="total_paid_client">{{ __('Total Paid Client ($)') }}</label>
            </div>

            <div class="col-span-full">
                <button type="submit"
                    class="px-4 py-2 text-text-light dark:text-text-dark bg-primary-50 rounded-md hover:bg-primary-50 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-50 dark:hover:bg-primary-400 dark:focus:ring-primary-600 font-medium text-sm">
                    {{ __('Update Project') }}
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
        let fixedBudgetDiv = document.getElementById('fixed');

        console.log('Elements found:', {
            employerSelect: !!employerSelect,
            clientSelect: !!clientSelect,
            employeeSelect: !!employeeSelect,
            paymentTypeSelect: !!paymentTypeSelect,
            hourlyBudgetDiv: !!hourlyBudgetDiv,
            fixedBudgetDiv: !!fixedBudgetDiv
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
        if (employeeSelect) {
            $(employeeSelect).select2({
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
                if (employeeSelect) {
                    $(employeeSelect).empty().append('<option class="dark:bg-slate-800 text-text-light dark:text-text-dark" value="" disabled selected>{{ __('Select Employee') }}</option>');
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

                    // Fetch employees
                    fetch(`/get/employee/${employerId}`, {
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
                if (hourlyBudgetDiv) hourlyBudgetDiv.classList.remove('hidden');
                if (fixedBudgetDiv) fixedBudgetDiv.classList.add('hidden');
            } else if (paymentType === 'fixed') {
                if (hourlyBudgetDiv) hourlyBudgetDiv.classList.add('hidden');
                if (fixedBudgetDiv) fixedBudgetDiv.classList.remove('hidden');
            } else {
                if (hourlyBudgetDiv) hourlyBudgetDiv.classList.add('hidden');
                if (fixedBudgetDiv) fixedBudgetDiv.classList.add('hidden');
            }
        }
    });
</script>
