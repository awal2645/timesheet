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
                                <select name="employer" id="employer" class="form-select">
                                    <option value=""
                                        class="dark:bg-slate-800 text-text-light dark:text-text-dark">
                                        {{ __('Select Employer') }}</option>
                                    @foreach ($employer as $item)
                                        <option class="dark:bg-slate-800 text-text-light dark:text-text-dark"
                                            value="{{ $item->id }}"
                                            {{ request('employer') == $item->id ? 'selected' : '' }}>
                                            {{ $item->employer_name }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                            <select name="employee" id="employee" class="form-select">
                                <option value="" class="dark:bg-slate-800 text-text-light dark:text-text-dark">
                                    {{ __('Select Employee') }}</option>
                            </select>
                            <button type="submit"
                                class="bg-primary-50 text-text-light dark:text-text-dark px-4 py-2 rounded-lg ms-2 hover:bg-primary-50 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
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
    document.getElementById('employer').addEventListener('change', function() {
        const employerId = this.value;
        const employeeSelect = document.getElementById('employee');

        // Clear previous employee options
        employeeSelect.innerHTML =
            '<option value="" class="dark:bg-slate-800 text-text-light dark:text-text-dark">{{ __('Select Employee') }}</option>';

        if (employerId) {
            fetch(`/get/employee/${employerId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(employee => {
                        const option = document.createElement('option');
                        option.value = employee.id;
                        option.textContent = employee.employee_name;
                        option.className = 'dark:bg-slate-800 text-text-light dark:text-text-dark';
                        employeeSelect.appendChild(option);
                    });
                });
        }
    });
</script>
