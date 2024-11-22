@section('title', 'Edit Weekly Holiday')

<x-app-layout>
    <div class="container mx-auto px-5">
        <h2 class="text-xl font-semibold mb-4">Edit Weekly Holiday</h2>

        <form action="{{ route('weekly_holidays.update', $holiday->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="days_of_week" class="block mb-2">Days of the Week</label>
                <select id="days_of_week" name="days_of_week[]" class="select2 bg-gray-50 border border-gray-300 rounded-lg w-full p-2.5" multiple required>
                    <option value="Monday" {{ in_array('Monday', json_decode($holiday->days_of_week)) ? 'selected' : '' }}>Monday</option>
                    <option value="Tuesday" {{ in_array('Tuesday', json_decode($holiday->days_of_week)) ? 'selected' : '' }}>Tuesday</option>
                    <option value="Wednesday" {{ in_array('Wednesday', json_decode($holiday->days_of_week)) ? 'selected' : '' }}>Wednesday</option>
                    <option value="Thursday" {{ in_array('Thursday', json_decode($holiday->days_of_week)) ? 'selected' : '' }}>Thursday</option>
                    <option value="Friday" {{ in_array('Friday', json_decode($holiday->days_of_week)) ? 'selected' : '' }}>Friday</option>
                    <option value="Saturday" {{ in_array('Saturday', json_decode($holiday->days_of_week)) ? 'selected' : '' }}>Saturday</option>
                    <option value="Sunday" {{ in_array('Sunday', json_decode($holiday->days_of_week)) ? 'selected' : '' }}>Sunday</option>
                </select>
            </div>
            <button type="submit" class="bg-purple-500 text-white px-4 py-2 rounded-lg">Update Holiday</button>
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