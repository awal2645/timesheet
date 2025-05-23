@section('title')
    {{ 'TimeSheet Report' }}
@endsection
<x-app-layout>
    <div class="relative m-6" x-data="{ openModal: null, openMessageModal: null }">
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
                                <select name="status" class="select2">
                                    <option value=""
                                        class="dark:bg-slate-800 text-text-light dark:text-text-dark">
                                        {{ __('Select Status') }}</option>
                                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark"
                                        value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                        {{ __('Pending') }}
                                    </option>
                                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark"
                                        value="approve" {{ request('status') == 'approve' ? 'selected' : '' }}>
                                        {{ __('Approved') }}
                                    </option>
                                    <option class="dark:bg-slate-800 text-text-light dark:text-text-dark"
                                        value="decline" {{ request('status') == 'decline' ? 'selected' : '' }}>
                                        {{ __('Declined') }}
                                    </option>
                                </select>
                            </div>
                            <button type="submit"
                                class="bg-primary-50 text-text-light dark:text-text-dark px-4 py-2 rounded-md ms-2 hover:bg-primary-50 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                                {{ __('Search') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="flex flex-wrap">
                <div class="w-full">
                    <div class="dashboard-right ps-0">
                        <div class="card overflow-x-auto !p-0 !rounded-md">
                            <h2 class="text-2xl font-bold p-4 text-text-light dark:text-text-dark">
                                {{ __('Latest Report') }}</h2>
                            <table class="w-full table-auto">
                                        <thead class="table-header">
                                            <tr class="rounded-none text-left">
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
                                                        </td>
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
                                                                    class="px-2 py-1 text-text-light dark:text-text-dark flex items-center justify-center text-sm w-[100px] truncate <?php echo e($timeReport->status == 'approve' ? 'bg-green-500' : ($timeReport->status == 'decline' ? 'bg-red-500' : 'bg-yellow-500')); ?>">
                                                                    {{ ucfirst($timeReport->status) }}
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td
                                                            class="border-b border-[#eee] dark:border-slate-700 px-4 py-3">
                                                            <div class="flex flex-wrap gap-3 items-center">
                                                                <span
                                                                    @click="openModal = 'modal-{{ $timeReport->id }}'"
                                                                    title="Check your employee's timesheet report"
                                                                    class="cursor-pointer font-medium text-blue-600 dark:text-blue-500 hover:underline">
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
                                                                </span>
                                                                {{-- <span
                                                            @click="openMessageModal = 'message-modal-{{ $timeReport->id }}'"
                                                            class="cursor-pointer font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="w-6 h-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                                                            </svg>
                                                        </span> --}}
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
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- Modal Structure -->
                                                    <div x-show="openModal === 'modal-{{ $timeReport->id }}'"
                                                        class="modal fixed top-0 left-0 w-full h-full bg-black bg-opacity-70 flex items-center justify-center z-50 overflow-auto p-4">
                                                        <div @click.outside="openModal = null"
                                                            class="modal-content bg-white dark:bg-gray-800 px-6 pt-12 pb-6 rounded-lg shadow-xl w-full max-w-4xl h-34 overflow-auto relative flex flex-col gap-6">
                                                            <div class="absolute top-2 right-2">
                                                                <button @click="openModal = null"
                                                                    class="close-btn bg-primary-50 p-1 rounded-full text-text-light dark:text-text-dark cursor-pointer">
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
                                                            <div class="grid grid-cols-3 items-start gap-8">
                                                                <div class="flex justify-center mb-4 col-span-2">
                                                                    <img id="modalImage"
                                                                        src="{{ asset($timeReport->image) }}"
                                                                        alt="Modal Image"
                                                                        class="w-full h-auto rounded-lg shadow-md">
                                                                </div>
                                                                <div class="flex flex-col col-span-1">
                                                                    <span>Description:</span>
                                                                    <p id="modalComment"
                                                                        class="text-text-light dark:text-text-dark mb-4 text-lg">
                                                                        {{ $timeReport->comment }}</p>

                                                                </div>
                                                                <div class="col-span-full">
                                                                    <div
                                                                        class="bg-card -light dark:bg-card-dark border-b">
                                                                        <div
                                                                            class="grid grid-cols-3 bg-card-light dark:bg-card-dark text-left">
                                                                            <div class="px-4 py-2 font-bold">Day</div>
                                                                            <div class="px-4 py-2 font-bold">Date</div>
                                                                            <div class="px-4 py-2 font-bold">Hours
                                                                            </div>
                                                                        </div>
                                                                        <div class="timesheet-list">
                                                                            @foreach ($timeReport->timesheets as $timesheet)
                                                                                <div
                                                                                    class="grid grid-cols-3 border-b hover:bg-gray-100 dark:hover:bg-gray-600">
                                                                                    <div class="px-4 py-2">
                                                                                        {{ $timesheet->day }}
                                                                                    </div>
                                                                                    <div class="px-4 py-2">
                                                                                        {{ $timesheet->date }}
                                                                                    </div>
                                                                                    <div class="px-4 py-2">
                                                                                        {{ $timesheet->hours }}
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-span-full">
                                                                    <form id="messageForm"
                                                                        action="{{ route('timesheet.feedback', $timeReport->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <div class="flex flex-col gap-2">
                                                                            <label for="message"
                                                                                class="block mb-2 text-sm font-medium text-text-light dark:text-text-dark">{{ __('Message') }}</label>
                                                                            <textarea @if (auth()->user()->role != 'employee') readonly @endif
                                                                                class="mb-2 bg-transparent border border-gray-300 dark:border-gray-700 rounded-md p-2" id="message"
                                                                                name="feedback" rows="6">{{ $timeReport->feedback }}</textarea>
                                                                        </div>
                                                                        @if (auth()->user()->role != 'employee')
                                                                            <button type="submit"
                                                                                class="bg-primary-50 text-text-light dark:text-text-dark px-4 py-2 rounded-lg mt-4 hover:bg-primary-50 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                                                                                {{ __('Send') }}
                                                                            </button>
                                                                        @endif
                                                                    </form>
                                                                </div>
                                                                <div class="col-span-full">
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
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="7" class="text-center py-8">
                                                        <x-svgs.no-data-found
                                                            class="mx-auto md:size-[360px] size-[220px]" />
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
