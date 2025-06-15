@section('title')
    {{ 'TimeSheet Report' }}
@endsection
<x-app-layout>
    <div class="relative m-6">
        <div>
            <div class="my-8 card">
                <form action="{{ route('salary.show') }}" method="GET">
                    <div class="mb-3">
                        <label for="search" class="block mb-2 text-sm font-medium text-text-light dark:text-text-dark">
                            {{ __('Search') }}
                        </label>
                        <div class="flex gap-3 items-center form-field">
                            @if (auth()->user()->role == 'superadmin')
                                <select name="employer" id="employer" class="select2">
                                    <option value=""
                                        class="dark:bg-slate-800 text-text-light dark:text-text-dark" disabled selected>
                                        {{ __('Select Employer') }}</option>
                                    @foreach ($employer->take(5) as $item)
                                        <option class="dark:bg-slate-800 text-text-light dark:text-text-dark"
                                            value="{{ $item->id }}"
                                            {{ request('employer') == $item->id ? 'selected' : '' }}>
                                            {{ $item->employer_name }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                            <select name="employee" id="employee" class="select2">
                                <option value="" class="dark:bg-slate-800 text-text-light dark:text-text-dark">
                                    {{ __('Select Employee') }}</option>
                            </select>
                            <button type="submit"
                                class="bg-primary-50 text-text-light dark:text-text-dark px-4 py-2 rounded-md ms-2 hover:bg-primary-50 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                                {{ __('Search') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .dropdown:hover .dropdown-menu {
        display: block;
    }
</style>

<script>
    // Wait for document and jQuery to be ready
    $(function() {
        // Initialize select2
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

        $('#employee').select2({
            width: '100%'
        });

        // Bind change event using jQuery
        $('#employer').on('change', function() {
            const employerId = $(this).val();
            const employeeSelect = $('#employee');
            const token = $('meta[name="csrf-token"]').attr('content');

            console.log('Employer ID:', employerId);
            console.log('CSRF Token:', token);

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
                    console.log('Employee data:', data);
                    
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
