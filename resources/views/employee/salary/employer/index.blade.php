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
                            <select name="employee" id="employee" class="form-select">
                                <option value="" class="dark:bg-slate-800 text-text-light dark:text-text-dark">
                                    {{ __('Select Employee') }}</option>
                                @foreach ($employees as $employee)
                                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark"
                                        value="{{ $employee->id }}"
                                        {{ request('employee') == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->employee_name }}
                                    </option>
                                @endforeach
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
