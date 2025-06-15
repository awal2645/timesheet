@section('title')
    {{ 'Salary Report' }}
@endsection

<x-app-layout>
    <div class="relative m-6">
        <!-- Hero Section -->
        <div class="mb-12 bg-gradient-to-r from-primary-500 to-primary-600 dark:from-primary-600 dark:to-primary-700 rounded-2xl shadow-xl p-8 text-white">
            <h2 class="text-3xl font-bold mb-4">Salary Report System</h2>
            <p class="text-lg opacity-90">Generate comprehensive salary reports with real-time data and analytics.</p>
        </div>

        <!-- Search Form Section -->
        <div class="my-8 bg-white dark:bg-slate-800 rounded-2xl shadow-xl overflow-hidden">
            <div class="p-8">
                <h3 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-white flex items-center">
                    <svg class="w-6 h-6 mr-2 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Generate Salary Report
                </h3>
                <form action="{{ route('salary.show') }}" method="GET">
                    <div class="mb-3">
                        <div class="flex flex-col md:flex-row gap-6 items-start md:items-center">
                            @if (auth()->user()->role == 'superadmin')
                                <div class="w-full md:w-1/3">
                                    <select name="employer" id="employer" class="select2 w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-slate-700">
                                        <option value="" class="dark:bg-slate-800 text-text-light dark:text-text-dark" disabled selected>
                                            {{ __('Select Employer') }}</option>
                                        @foreach ($employer->take(5) as $item)
                                            <option class="dark:bg-slate-800 text-text-light dark:text-text-dark"
                                                value="{{ $item->id }}"
                                                {{ request('employer') == $item->id ? 'selected' : '' }}>
                                                {{ $item->employer_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            <div class="w-full md:w-1/3">
                                <select name="employee" id="employee" class="select2 w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-slate-700">
                                    <option value="" class="dark:bg-slate-800 text-text-light dark:text-text-dark">
                                        {{ __('Select Employee') }}</option>
                                </select>
                            </div>
                            <div class="w-full md:w-1/3 flex items-end">
                                <button type="submit"
                                    class="w-full bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white px-8 py-3 rounded-xl transition duration-200 shadow-lg hover:shadow-xl flex items-center justify-center transform hover:-translate-y-0.5">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    {{ __('Generate Report') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Features Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl p-8 transform hover:-translate-y-1 transition duration-200">
                <div class="flex items-center mb-6">
                    <div class="p-4  from-primary-100 to-primary-200 dark:from-primary-900 dark:to-primary-800 rounded-2xl">
                        <svg class="w-8 h-8 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="ml-4 text-xl font-semibold text-gray-800 dark:text-white">Real-time Search</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-300 leading-relaxed">Dynamic search functionality for both employers and employees with instant results and smart suggestions.</p>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl p-8 transform hover:-translate-y-1 transition duration-200">
                <div class="flex items-center mb-6">
                    <div class="p-4  from-primary-100 to-primary-200 dark:from-primary-900 dark:to-primary-800 rounded-2xl">
                        <svg class="w-8 h-8 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="ml-4 text-xl font-semibold text-gray-800 dark:text-white">Detailed Reports</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-300 leading-relaxed">Generate comprehensive salary reports including timesheet data, payment calculations, and visual analytics.</p>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl p-8 transform hover:-translate-y-1 transition duration-200">
                <div class="flex items-center mb-6">
                    <div class="p-4  from-primary-100 to-primary-200 dark:from-primary-900 dark:to-primary-800 rounded-2xl">
                        <svg class="w-8 h-8 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h3 class="ml-4 text-xl font-semibold text-gray-800 dark:text-white">Secure Access</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-300 leading-relaxed">Role-based access control ensures data security and privacy for all users with advanced encryption.</p>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    /* Custom Select2 Styles */
    .select2-container--default .select2-selection--single {
        height: 48px;
        border-color: #e2e8f0;
        background-color: white;
        border-radius: 0.75rem;
    }
    
    .dark .select2-container--default .select2-selection--single {
        background-color: #1e293b;
        border-color: #475569;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 48px;
        padding-left: 1rem;
        font-size: 0.95rem;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 46px;
        right: 0.75rem;
    }
    
    .select2-dropdown {
        border-color: #e2e8f0;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    
    .dark .select2-dropdown {
        background-color: #1e293b;
        border-color: #475569;
    }
    
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #3b82f6;
    }
    
    .select2-container--default .select2-results__option {
        padding: 0.75rem 1rem;
    }
</style>

<script>
    // Wait for document and jQuery to be ready
    $(function() {
        // Initialize select2 for employer with AJAX
        $('#employer').select2({
            width: '100%',
            ajax: {
                url: '/ajax/employers',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term,
                        page: params.page || 1
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.results
                    };
                },
                cache: true
            },
            placeholder: '{{ __("Select Employer") }}',
            minimumInputLength: 0
        });

        // Initialize select2 for employee
        $('#employee').select2({
            width: '100%'
        });

        // Bind change event using jQuery
        $('#employer').on('change', function() {
            const employerId = $(this).val();
            const employeeSelect = $('#employee');
            const token = $('meta[name="csrf-token"]').attr('content');

            // Clear previous employee options
            employeeSelect.empty().append(
                $('<option></option>')
                    .val('')
                    .text('{{ __("Select Employee") }}')
                    .addClass('dark:bg-slate-800 text-text-light dark:text-text-dark')
            );

            if (employerId) {
                // Show loading state
                employeeSelect.prop('disabled', true);

                fetch(`/get/employee/${employerId}`, {
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    credentials: 'same-origin'
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Add new options
                    data.forEach(employee => {
                        employeeSelect.append(
                            $('<option></option>')
                                .val(employee.id)
                                .text(employee.employee_name)
                                .addClass('dark:bg-slate-800 text-text-light dark:text-text-dark')
                        );
                    });

                    // Update select2
                    employeeSelect.trigger('change');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to load employees. Please try again.');
                })
                .finally(() => {
                    // Re-enable select
                    employeeSelect.prop('disabled', false);
                });
            }
        });

        // Handle form submission
        $('form').on('submit', function(e) {
            const employeeId = $('#employee').val();
            if (!employeeId) {
                e.preventDefault();
                alert('Please select an employee first.');
                return false;
            }
        });
    });
</script>
