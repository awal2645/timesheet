@section('title')
    {{ 'TimeSheet Report' }}
@endsection
<x-app-layout>
    <div class="relative m-6">
        <div>
            <div class="my-8 card">
                <form action="{{ route('reports.index') }}" method="GET">
                    <div class="mb-3">
                        <label for="search" class="block mb-2 text-sm font-medium text-text-light dark:text-text-dark">
                            {{ __('Search') }}
                        </label>
                        <div class="flex gap-3 items-center">
                            <div class="form-field !mb-0">
                                <input type="text" id="search" name="search" value="{{ request('search') }}"
                                    placeholder="{{ __('Search') }}" />
                            </div>
                            <div class="form-field !mb-0">
                                <select name="status" class="form-select">
                                    <option value=""
                                        class="dark:bg-slate-800 text-text-light dark:text-text-dark">
                                        {{ __('Select Status') }}</option>
                                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark"
                                        value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                        {{ __('Pending') }}
                                    </option>
                                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark"value="approve"
                                        {{ request('status') == 'approve' ? 'selected' : '' }}>
                                        {{ __('Approved') }}
                                    </option>
                                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark"
                                        value="decline" {{ request('status') == 'decline' ? 'selected' : '' }}>
                                        {{ __('Declined') }}
                                    </option>
                                </select>
                            </div>
                            <button type="submit"
                                class="bg-primary-50 text-text-light dark:text-text-dark px-4 py-2 rounded-lg ml-2 hover:bg-primary-50 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                                {{ __('Search') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="flex flex-wrap">
                <div class="w-full">
                    <div class="dashboard-right pl-0">
                        <div class="invoices-table">
                            <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark ml-1">
                                {{ __('Latest Report') }}</h2>
                            <div>
                                <div class="card overflow-x-auto">
                                    <table class="w-full table-auto">
                                        <thead class="table-header">
                                            <tr class="rounded-2xl text-left">
                                                <th class="min-w-[220px] px-4 py-4 font-medium">{{ __('Name') }}
                                                </th>
                                                <th class="min-w-[150px] px-4 py-4 font-medium">{{ __('Date') }}
                                                </th>
                                                <th class="min-w-[120px] px-4 py-4 font-medium">{{ __('Status') }}
                                                </th>
                                                <th class="px-4 py-4 font-medium">{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($timeReports->count() > 0)
                                                @foreach ($timeReports as $timeReport)
                                                    <tr
                                                        class="hover:bg-gray-100 hover:dark:bg-gray-800 transition duration-200">
                                                        <td
                                                            class="border-b border-[#eee] dark:border-slate-700 px-4 py-3">
                                                            <div class="text-sm font-semibold">
                                                                <div class="text-base font-semibold">
                                                                    {{ $timeReport->user?->username }}</div>
                                                                <div class="font-normal text-gray-500">
                                                                    {{ $timeReport->user?->email }}</div>
                                                            </div>
                                                            </th>
                                                        <td
                                                            class="border-b border-[#eee] dark:border-slate-700 px-4 py-3">
                                                            <div class="text-sm font-semibold">
                                                                {{ $timeReport->start_day . ' to ' . $timeReport->end_day }}
                                                            </div>
                                                        </td>
                                                        <td
                                                            class="border-b border-[#eee] dark:border-slate-700 px-4 py-3">
                                                            <div class="flex items-center space-x-2">
                                                                <span
                                                                    class="px-2 py-1 flex items-center justify-center text-sm   w-[100px] truncate {{ $timeReport->status == 'approve' ? 'bg-green-500' : 'bg-yellow-500' }} text-white rounded">
                                                                    {{ ucfirst($timeReport->status) }}
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td
                                                            class="border-b border-[#eee] dark:border-slate-700 px-4 py-3">
                                                            <div class="flex flex-wrap">

                                                                <span class="flex flex-wrap">
                                                                    <a href="#"
                                                                        id="openTimesheetModal{{ $timeReport->id }}"
                                                                        title="Check your employee's timesheet report"
                                                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            fill="none" viewBox="0 0 24 24"
                                                                            stroke-width="1.5" stroke="currentColor"
                                                                            class="w-6 h-6">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                                        </svg>
                                                                    </a>
                                                                    <a href="#"
                                                                        title="Give feedback based on your employee’s timesheet report"
                                                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                                                        id="addFeedbackButton{{ $timeReport->id }}">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            fill="none" viewBox="0 0 24 24"
                                                                            stroke-width="1.5" stroke="currentColor"
                                                                            class="w-6 h-6">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                                                                        </svg>
                                                                    </a>
                                                                    @if (auth('web')->user()->role == 'employee')
                                                                        <a href="{{ route('timesheet.index', $timeReport->start_day) }}"
                                                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                fill="none" viewBox="0 0 24 24"
                                                                                stroke-width="1.5" stroke="currentColor"
                                                                                class="w-6 h-6">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                                            </svg>
                                                                        </a>
                                                                    @endif
                                                                </span>
                                                        </td>
                                                    </tr>
                                                    <!-- Modal -->
                                                    <div id="feedbackModal{{ $timeReport->id }}"
                                                        class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 hidden"
                                                        style="z-index: 100;">
                                                        <div
                                                            class="relative bg-white shadow-lg max-w-md w-full p-8 rounded-lg">
                                                            <form id="feedbackForm{{ $timeReport->id }}"
                                                                action="{{ route('timesheet.feedback', $timeReport->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <button id="closeModalButton{{ $timeReport->id }}"
                                                                    class="absolute top-0 right-0 m-4 text-gray-600 hover:text-gray-800"
                                                                    type="button">&times;</button>
                                                                <label for="feedback"
                                                                    class="block text-gray-700 text-sm font-bold mb-2">Feedback:</label>
                                                                @if (auth('web')->user()->role != 'employee')
                                                                    <textarea id="feedback" name="feedback" required
                                                                        class="w-full h-30 px-3 py-5 text-gray-700 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">{{ $timeReport->feedback ?? '' }}</textarea>
                                                                    <div class="text-center py-4">
                                                                        <button id="submitFeedbackButton"
                                                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                                                                    </div>
                                                                @else
                                                                    <div class="py-3 text-center">
                                                                        <p class="mb-2">
                                                                            {{ $timeReport->feedback ?? 'No feedback available' }}
                                                                        </p>
                                                                    </div>
                                                                @endif
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- Modal Structure -->
                                                    <div id="timesheetModal{{ $timeReport->id }}"
                                                        class="modal hidden fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 overflow-auto p-4">
                                                        <div
                                                            class="modal-content bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl w-full max-w-6xl h-34 overflow-auto relative flex flex-col gap-6">
                                                            <div class="absolute top-4 right-4">
                                                                <button
                                                                    class="close-btn text-gray-600 dark:text-gray-400 cursor-pointer"
                                                                    id="closeTimesheetModalButton{{ $timeReport->id }}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        fill="none" viewBox="0 0 24 24"
                                                                        stroke-width="1.5" stroke="currentColor"
                                                                        class="w-6 h-6">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            d="M6 18L18 6M6 6l12 12" />
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                                                <div class="flex justify-center mb-4">
                                                                    <img id="modalImage"
                                                                        src="{{ asset($timeReport->image) }}"
                                                                        alt="Modal Image"
                                                                        class="w-full h-auto rounded-lg shadow-md">
                                                                </div>
                                                                <div class="col-span-1">
                                                                    <div class="bg-gray-50 dark:bg-gray-700 border-b">
                                                                        <div
                                                                            class="grid grid-cols-3 bg-gray-200 dark:bg-gray-600 text-left">
                                                                            <div class="px-4 py-2 font-bold">Day</div>
                                                                            <div class="px-4 py-2 font-bold">Date</div>
                                                                            <div class="px-4 py-2 font-bold">Hours
                                                                            </div>
                                                                        </div>
                                                                        <div class="timesheet-list">
                                                                            @foreach ($timeReport->timesheets as $timesheet)
                                                                                <div
                                                                                    class="grid grid-cols-3 border-b hover:bg-gray-100 dark:hover:bg-gray-600">
                                                                                    <div class="px-4 py-2 text-center">
                                                                                        {{ $timesheet->day }}</div>
                                                                                    <div class="px-4 py-2 text-center">
                                                                                        {{ $timesheet->date }}</div>
                                                                                    <div class="px-4 py-2 text-center">
                                                                                        {{ $timesheet->hours }}</div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="flex flex-col col-span-1">
                                                                    <span>Description:</span>
                                                                    <p id="modalComment"
                                                                        class="text-gray-800 dark:text-gray-200 mb-4 text-lg">
                                                                        {{ $timeReport->comment }}</p>
                                                                    @if (auth()->user()->role != 'employee')
                                                                        <form id="statusForm{{ $timeReport->id }}"
                                                                            action="{{ route('timesheet.updateStatus', $timeReport->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <input type="hidden"
                                                                                name="time_report_id"
                                                                                value="{{ $timeReport->id }}">
                                                                            <div class="flex flex-col gap-4 mt-4">
                                                                                <div class="flex justify-between">
                                                                                    @if ($timeReport->status === 'approve')
                                                                                        <button type="submit" disabled
                                                                                            name="status"
                                                                                            value="approve"
                                                                                            class="bg-gray-500 text-text-light dark:text-text-dark px-6 py-2 rounded-md shadow hover:bg-gray-600 focus:outline-none transition duration-150">
                                                                                            Approved
                                                                                        </button>
                                                                                    @else
                                                                                        <button type="submit"
                                                                                            name="status"
                                                                                            value="approve"
                                                                                            class="bg-green-500 text-text-light dark:text-text-dark px-6 py-2 rounded-md shadow hover:bg-green-600 focus:outline-none transition duration-150">
                                                                                            Approve
                                                                                        </button>
                                                                                    @endif
                                                                                    @if ($timeReport->status === 'decline')
                                                                                        <button type="submit" disabled
                                                                                            name="status"
                                                                                            value="decline"
                                                                                            class="bg-gray-500 text-text-light dark:text-text-dark px-6 py-2 rounded-md shadow hover:bg-gray-600 focus:outline-none transition duration-150">
                                                                                            Declined
                                                                                        </button>
                                                                                    @else
                                                                                        <button type="submit"
                                                                                            name="status"
                                                                                            value="decline"
                                                                                            class="bg-red-500 text-text-light dark:text-text-dark px-6 py-2 rounded-md shadow hover:bg-red-600 focus:outline-none transition duration-150">
                                                                                            Decline
                                                                                        </button>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <script>
                                                        // Open Timesheet Modal
                                                        document.getElementById('openTimesheetModal{{ $timeReport->id }}').addEventListener('click', function() {
                                                            const modal = document.getElementById('timesheetModal{{ $timeReport->id }}');
                                                            const modalImage = document.getElementById('modalImage');
                                                            const modalComment = document.getElementById('modalComment');
                                                            modalImage.src = "{{ asset($timeReport->image) }}"; // Set the image
                                                            modalComment.textContent = "{{ $timeReport->comment }}"; // Set the comment
                                                            modal.classList.remove('hidden');
                                                        });

                                                        // Close Timesheet Modal
                                                        document.getElementById('closeTimesheetModalButton{{ $timeReport->id }}').addEventListener('click', function() {
                                                            document.getElementById('timesheetModal{{ $timeReport->id }}').classList.add('hidden');
                                                        });
                                                    </script>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="4"
                                                        class="text-center py-8 border border-gray-300 dark:border-gray-700">
                                                        <img src="{{ asset('images/no-data-found.svg') }}"
                                                            alt="No data found" class="mx-auto max-w-xs">
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($timeReports->total() > $timeReports->count())
            <div class="mt-2">
                <div class="d-flex justify-content-center">
                    {{ $timeReports->links() }}
                </div>
            </div>
        @endif
        <script>
            function showConfirmation() {
                Swal.fire({
                    title: 'Want to delete this Report!',
                    text: 'If you are ready?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        console.log(result.isConfirmed);
                        window.location.href = "{{ route('employer.destroy', $employer->id ?? '') }}";
                    }
                });
            }
        </script>
    </div>
</x-app-layout>

<style>
    .dropdown:hover .dropdown-menu {
        display: block;
    }
</style>
