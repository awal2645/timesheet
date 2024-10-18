@section('title')
{{ 'Timesheet Add' }}
@endsection

<x-app-layout>
    <div>

        <div class="container mx-auto px-5 my-8 justify-center  ">

            <div class="">

                <div class="mb-4 flex justify-between">

                    <button id="previousWeek"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900">Previous
                        Week</button>
                    <button id="nextWeek"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900">Next
                        Week</button>
                </div>
            </div>


            <div class="flex justify-center ">
                <form id="timesheetForm" action="{{ route('timesheet.save') }}" method="POST"
                    class="grid lg:grid-cols-7 sm:grid-cols-7 gap-4 justify-center" enctype="multipart/form-data">
                    @csrf
                    @foreach ($days as $day)
                    <div
                        class="mb-4 p-4 sm:p-2 bg-white rounded-md shadow-md text-center dark:bg-gray-800 dark:text-white">
                        <label for="{{ $day }}" class="block text-sm font-medium text-gray-700 dark:text-white">{{ $day
                            }}</label>
                        <div class="flex mt-2">
                            <input type="number" min="1" name="hours[{{ $day }}]" value="{{ $hours[$day] }}"
                                class="input-field hours text-center	 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder="Enter hours">

                        </div>
                        <label class=" block text-sm font-medium text-gray-700 dark:text-white">{{ $dates[$day]
                            }}</label>
                        @error('hours.*')
                        <span class=" text-red-500">{{ $message }}</span>
                        @enderror
                        <div class="flex mt-2">
                            <input type="hidden" name="dates[{{ $day }}]" value="{{ $dates[$day] }}">
                        </div>
                    </div>
                    @endforeach
            </div>


            <div class="bg-white p-6 rounded-md shadow-md dark:bg-gray-800 ">
                @error('start_day')
                <span class=" text-red-500">{{ $message }}</span>
                @enderror
                <h2 class="text-xl font-semibold mb-4">Upload Client/Vendor Approved Timesheet</h2>
                <div class="flex items-center p-4 mb-4 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300 dark:border-yellow-800"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">Warning alert!</span> "Attach a file and include a message only when submitting the timesheet. Otherwise, do not attach a file or include a message."
                    </div>
                </div>
                <!-- File Upload Input -->
                <div class="mb-4">
                    <label for="file" class="block text-gray-400 font-medium">Choose a file:</label>
                    <input @if ($timeReport) disabled @endif type="file" id="file" name="image"
                        class="mt-1 p-2 border rounded-md w-full">
                    @error('image')
                    <span class=" text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Textarea -->
                <div class="mb-4">
                    <label for="message" class="block text-gray-400 font-medium">Your Message:</label>
                    <textarea @if ($timeReport) readonly @endif id="message" name="comment" rows="4"
                        class="mt-1 p-2 border rounded-md dark:text-white w-full dark:bg-gray-800">{{ $timeReport->comment ?? '' }}</textarea>
                </div>
                <input type="hidden" name="start_day" value="{{ $dates['Sunday'] }}">
                <input type="hidden" name="end_day" value="{{ $dates['Saturday'] }}">

                <!-- Submit Button -->
                <button @if ($timeReport) disabled @endif type="button" id="saveButton"
                    class="bg-blue-500 ml-3 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300">
                    Save
                </button>

                @if ($timeReport)
                <button disabled type="button" id="submitButton"
                    class="bg-blue-500 ml-3 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300">
                    Submited
                </button>
                @else
                <button type="button" id="submitButton"
                    class="bg-blue-500 ml-3 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300">
                    Submit
                </button>
                @endif
                </form>
                <button @if ($timeReport) disabled @endif type="submit" id="resetButton"
                    class="bg-blue-500 ml-3 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300">
                    Reset
                </button>
            </div>

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const currentDate = "{{ $startDate->format('m-d-y') }}";

            // Function to update the page with the selected start date
            function updateTimesheet(startDate) {
                window.location.href = `{{ route('timesheet.index') }}/${startDate}`;
            }

            // Event listener for the previous week button
            document.getElementById('previousWeek').addEventListener('click', function() {
                const previousWeekDate = new Date(currentDate);
                previousWeekDate.setDate(previousWeekDate.getDate() - 7);
                updateTimesheet(formatDate(previousWeekDate));
            });

            // Event listener for the next week button
            document.getElementById('nextWeek').addEventListener('click', function() {
                const nextWeekDate = new Date(currentDate);
                nextWeekDate.setDate(nextWeekDate.getDate() + 7);
                updateTimesheet(formatDate(nextWeekDate));
            });

            // Function to format the date as MM-DD-YY
            function formatDate(date) {
                const month = (date.getMonth() + 1).toString().padStart(2, '0');
                const day = date.getDate().toString().padStart(2, '0');
                const year = date.getFullYear().toString().slice(-2);
                return `${month}-${day}-${year}`;
            }
        });
    </script>


    <script>
        document.getElementById('submitButton').addEventListener('click', function() {
            document.getElementById('file').setAttribute('required', 'required');
            document.getElementById('message').setAttribute('required', 'required');
            document.getElementById('timesheetForm').setAttribute('action', '{{ route('timesheet.submit') }}');
            document.getElementById('timesheetForm').submit();
        });

        document.getElementById('saveButton').addEventListener('click', function() {
            document.getElementById('file').removeAttribute('required');
            document.getElementById('message').removeAttribute('required');
            document.getElementById('timesheetForm').setAttribute('action', '{{ route('timesheet.save') }}');
            document.getElementById('timesheetForm').submit();
        });

        document.getElementById('resetButton').addEventListener('click', function() {
            window.location.reload();
        });
    </script>
</x-app-layout>