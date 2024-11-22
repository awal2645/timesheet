@section('title', 'Add Weekly Holiday')

<x-app-layout>
    <div class="container mx-auto px-5">
        <h2 class="text-xl font-semibold mb-4">Add Weekly Holiday</h2>

        <form action="{{ route('weekly_holidays.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="days_of_week" class="block mb-2">Days of the Week</label>
                <select id="days_of_week" name="days_of_week[]" class="select2 bg-gray-50 border border-gray-300 rounded-lg w-full p-2.5" multiple required>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                </select>
            </div>
            <button type="submit" class="bg-purple-500 text-white px-4 py-2 rounded-lg">Add Holiday</button>
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