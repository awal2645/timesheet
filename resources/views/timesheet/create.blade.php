@section('title')
    {{ 'Timesheet Add' }}
@endsection

<x-app-layout>
    <div>

        <div class="m-6 card">
            <div class="">
                <div class="mb-4 flex justify-between">
                    <button id="previousWeek"
                        class="text-text-light dark:text-text-dark bg-primary-50 hover:bg-primary-30  0 focus:outline-none focus:ring-4 focus:ring-primary-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 dark:bg-primary-50 dark:hover:bg-primary-50 dark:focus:ring-primary-900">Previous
                        Week</button>
                    <button id="nextWeek"
                        class="text-text-light dark:text-text-dark bg-primary-50 hover:bg-primary-300 focus:outline-none focus:ring-4 focus:ring-primary-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 dark:bg-primary-50 dark:hover:bg-primary-50 dark:focus:ring-primary-900">Next
                        Week</button>
                </div>
            </div>

            <div class="flex justify-center ">
                <form id="timesheetForm" action="{{ route('timesheet.save') }}" method="POST"
                    class="grid lg:grid-cols-7 sm:grid-cols-7 gap-4 justify-center" enctype="multipart/form-data">
                    @csrf
                    @foreach ($days as $day)
                        <div
                            class="mb-4 p-4 sm:p-2 bg-card-light dark:bg-card-dark   rounded-md shadow-md text-center dark:text-text-dark">
                            <label for="{{ $day }}"
                                class="block text-sm font-medium text-text-light dark:text-text-dark">{{ $day }}</label>
                            <div class="flex mt-2 form-field">
                                <input type="number" min="1" name="hours[{{ $day }}]"
                                    value="{{ $hours[$day] }}"
                                    class="input-field hours text-center	 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-text-dark dark:border-gray-600 dark:focus:border-primary-500 focus:outline-none focus:ring-0 focus:border-primary-600 peer"
                                    placeholder="Enter hours">

                            </div>
                            <label
                                class=" block text-sm font-medium text-text-light dark:text-text-dark">{{ $dates[$day] }}</label>
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
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
                <h2
                    class="text-xl font-semibold mb-4 text-text-light dark:text-text-dark text-text-light dark:text-text-dark ">
                    {{ __('Upload Client/Vendor Approved Timesheet') }}</h2>

                <div class="flex items-center p-4 mb-4 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300 dark:border-yellow-800"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">{{ __('Info') }}</span>
                    <div>
                        <span class="font-medium">{{ __('Warning alert!') }}</span>
                        {{ __('Attach a file and include a message only when submitting the timesheet. Otherwise, do not attach a file or include a message.') }}
                    </div>
                </div>

                <div class="flex flex-col md:flex-row gap-6 items-start mb-4">
                    <!-- File Upload Input -->
                    <label for="file"
                        class="w-fullmd:w-1/2 cursor-pointer flex-1 border border-dashed border-gray-300 dark:border-gray-600 p-6 rounded-lg"
                        x-data="fileUpload()">
                        <div class="flex flex-col justify-center gap-6 items-center">
                            <div class="preview-container">
                                <img :src="filePreview" alt="File preview"
                                    class="w-full h-[200px] rounded object-contain" x-show="filePreview">
                            </div>
                            <div class="flex flex-col justify-center gap-6 items-center" x-show="!filePreview">
                                <p class="max-w-3xl text-base">
                                    {{ __('Upload a high-resolution file in JPEG or PNG format.') }}</p>
                                <div>
                                    <div class="flex gap-3 items-center flex-wrap">
                                        <div class="flex gap-3 items-center shadow-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                                                <path
                                                    d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                                <path
                                                    d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z" />
                                            </svg>
                                            {{ __('Upload File') }}
                                            <input type="file" id="file" name="image"
                                                @change="handleFileUpload" accept="image/jpeg,image/png"
                                                style="display:none;">
                                        </div>
                                    </div>
                                    <p x-show="fileError" x-text="fileError" class="error-message"></p>
                                </div>
                            </div>
                        </div>
                    </label>

                    <!-- Textarea -->
                    <div class="w-full md:w-1/2 form-field">
                        <textarea rows="5" 
                            @if (isset($timeReport) && ($timeReport->status == 'approve' || $timeReport->status == 'decline')) 
                                readonly 
                            @endif 
                            id="message" name="comment"
                            placeholder="{{ __('Your Message:') }}">{{ $timeReport->comment ?? '' }}</textarea>
                    </div>
                </div>

                <input type="hidden" name="start_day" value="{{ $dates['Sunday'] }}">
                <input type="hidden" name="end_day" value="{{ $dates['Saturday'] }}">
                <!-- Submit Button -->
                <button 
                    @if (isset($timeReport) && ($timeReport->status == 'approve' || $timeReport->status == 'decline')) 
                        style="display: none;"
                    @endif 
                    type="button" id="saveButton" 
                    class="bg-primary-50 text-text-light dark:text-text-dark px-4 py-2 rounded-md hover:bg-primary-50 focus:outline-none focus:ring focus:border-primary-300">
                    {{ __('Save') }}
                </button>

                @if (isset($timeReport) )
                    <div  style="display: ruby;"
                        class=" ml-3 text-text-light dark:text-text-dark px-4 py-2 rounded-md focus:outline-none focus:ring focus:border-primary-300">
                        Status : 
                        @php
                        $styles = [
                            'approve' => 'bg-green-100 text-green-800 border border-green-200 dark:bg-green-900/30 dark:text-green-300 dark:border-green-800',
                            'decline' => 'bg-red-100 text-red-800 border border-red-200 dark:bg-red-900/30 dark:text-red-300 dark:border-red-800',
                            'pending' => 'bg-yellow-100 text-yellow-800 border border-yellow-200 dark:bg-yellow-900/30 dark:text-yellow-300 dark:border-yellow-800'
                        ];
                    
                        $baseClasses = 'inline-flex items-center px-2.5 py-1.5 rounded-full text-sm font-medium transition-colors';
                    @endphp
                    
                    @if ($timeReport->status == 'approve')
                        <span class="{{ $baseClasses }} {{ $styles['approve'] }}">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('Approved') }}
                        </span>
                    @elseif ($timeReport->status == 'decline')
                        <span class="{{ $baseClasses }} {{ $styles['decline'] }}">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            {{ __('Declined') }}
                        </span>
                    @else
                        <span class="{{ $baseClasses }} {{ $styles['pending'] }}">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ __('Pending') }}
                        </span>
                    @endif
                    
                    </div>
                @else
                    <button type="button" id="submitButton"     @if (isset($timeReport) && ($timeReport->status == 'approve' || $timeReport->status == 'decline')) 
                        disabled
                    @endif 
                        class="bg-primary-50 ml-3 text-text-light dark:text-text-dark px-4 py-2 rounded-md hover:bg-primary-50 focus:outline-none focus:ring focus:border-primary-300">
                        {{ __('Submit') }}
                    </button>
                @endif

                <button 
                    @if (isset($timeReport) && ($timeReport->status == 'approve' || $timeReport->status == 'decline' || $timeReport->status == 'pending')) 
                        style="display: none;" 
                    @endif 
                    type="button" id="resetButton"
                    class="bg-primary-50 ml-3 text-text-light dark:text-text-dark px-4 py-2 rounded-md hover:bg-primary-50 focus:outline-none focus:ring focus:border-primary-300">
                    {{ __('Reset') }}
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

    <script>
        function fileUpload() {
            return {
                filePreview: '{{ asset( $timeReport->image ?? 'reports_images/dummy_image.png') }}', // Initialize file preview
                fileError: '',
                handleFileUpload(event) {
                    const file = event.target.files[0];
                    if (!file) return;

                    // Check file type
                    if (!['image/jpeg', 'image/png'].includes(file.type)) {
                        this.fileError = 'Please upload a JPEG or PNG file.';
                        return;
                    }

                    // Create preview URL
                    const reader = new FileReader();
                    reader.onloadend = () => {
                        this.filePreview = reader.result;
                        this.fileError = ''; // Clear any previous errors
                    };
                    reader.readAsDataURL(file);
                }
            };
        }
    </script>
</x-app-layout>
