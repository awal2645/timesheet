@section('title', 'Add Weekly Holiday')

<x-app-layout>
    <div class="flex justify-between items-center m-6 card">
        <h2 class="text-xl font-medium text-text-light dark:text-text-dark">{{ __('Add Weekly Holiday') }}</h2>
        <a href="{{ route('weekly_holidays.index') }}"
            class="btn bg-primary-50 dark:bg-primary-50 text-text-light dark:text-text-dark">{{ __('Go to Weekly Holiday List') }}</a>
    </div>
    <div class="m-6 card">
        <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark">{{ __('Add Weekly Holiday') }}</h2>

        <form action="{{ route('weekly_holidays.store') }}" method="POST">
            @csrf
            <div class="mb-4">
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
            <button type="submit" class="bg-primary-50 text-text-light dark:text-text-dark px-4 py-2 rounded-lg">{{ __('Add Holiday') }}</button>
        </form>
    </div>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            // Wait for jQuery to be loaded
            if (typeof jQuery !== 'undefined') {
                $('.select2').select2({
                    width: '100%',
                    dropdownParent: $('body'),
                    placeholder: "{{ __('Select Days') }}"
                });
            }
        });
    </script>
</x-app-layout>
