@section('title', 'Add Weekly Holiday')

<x-app-layout>
    <div class="flex justify-between items-center m-6 card">
        <h2 class="text-xl font-medium text-text-light dark:text-text-dark">{{ __('Add Weekly Holiday') }}</h2>
        <a href="{{ route('holidays.index') }}"
            class="btn bg-primary-50 dark:bg-primary-50 text-text-light dark:text-text-dark">{{ __('Go to Holiday List') }}</a>
    </div>
    <div class="card m-6">
        <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark">{{ __('Add Weekly Holiday') }}</h2>
        <form action="{{ route('weekly_holidays.store') }}" method="POST">
            @csrf
            <div class=" mb-4">
                <label for="days_of_week" class="block mb-2">{{ __('Days of the Week') }}</label>
                <select id="days_of_week" name="days_of_week[]"
                    class="select2 bg-gray-50 border border-gray-300 rounded-lg w-full p-2.5" multiple required>
                    <option value="Monday">{{ __('Monday') }}</option>
                    <option value="Tuesday">{{ __('Tuesday') }}</option>
                    <option value="Wednesday">{{ __('Wednesday') }}</option>
                    <option value="Thursday">{{ __('Thursday') }}</option>
                    <option value="Friday">{{ __('Friday') }}</option>
                    <option value="Saturday">{{ __('Saturday') }}</option>
                    <option value="Sunday">{{ __('Sunday') }}</option>
                </select>
            </div>
            <button type="submit" class="text-text-light dark:text-text-dark bg-primary-50 dark:bg-primary-50 hover:bg-primary-300 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">{{ __('Add Holiday') }}</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select Days",
                allowClear: true
            });
        });
    </script>
</x-app-layout>