@section('title', 'Edit Weekly Holiday')

<x-app-layout>
    <div class="m-6 bg-card-light dark:bg-card-dark p-6 rounded-lg border border-black/10 dark:border-white/10">
        <h2 class="text-xl font-semibold mb-4 text-text-light dark:text-text-dark text-text-light dark:text-text-dark ">Edit Weekly Holiday</h2>

        <form action="{{ route('weekly_holidays.update', $holiday->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                  @php
                        $selectedDays = is_array($holiday->days_of_week) ? $holiday->days_of_week : json_decode($holiday->days_of_week);
                    @endphp
                <label for="days_of_week" class="block mb-2">Days of the Week</label>
                <select id="days_of_week" name="days_of_week[]"
                    class="select2 bg-gray-50 border border-gray-300 rounded-lg w-full p-2.5" multiple required>
                  
                    <option value="Monday" {{ in_array('monday', $selectedDays) ? 'selected' : '' }}>Monday</option>
                    <option value="Tuesday" {{ in_array('tuesday', $selectedDays) ? 'selected' : '' }}>Tuesday</option>
                    <option value="Wednesday" {{ in_array('wednesday', $selectedDays) ? 'selected' : '' }}>Wednesday</option>
                    <option value="Thursday" {{ in_array('thursday', $selectedDays) ? 'selected' : '' }}>Thursday</option>
                    <option value="Friday" {{ in_array('friday', $selectedDays) ? 'selected' : '' }}>Friday</option>
                    <option value="Saturday" {{ in_array('saturday', $selectedDays) ? 'selected' : '' }}>Saturday</option>
                    <option value="Sunday" {{ in_array('sunday', $selectedDays) ? 'selected' : '' }}>Sunday</option>
                </select>
            </div>
            <button type="submit" class="bg-primary-50 text-text-light dark:text-text-dark px-4 py-2 rounded-lg">Update Holiday</button>
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
