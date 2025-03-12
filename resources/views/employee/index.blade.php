@section('title')
    {{ 'List Employee' }}
@endsection
<x-app-layout>
    <div class="relative m-6">
        <div>
            <div class="my-8 card flex flex-col md:flex-row gap-4 md:justify-between items-start md:items-center">
                <form action="{{ route('employee.index') }}" method="GET" class="w-full">
                    <div class="mb-3">
                        <label for="search" class="block mb-2 text-sm font-medium text-text-light dark:text-text-dark">
                            {{ __('Search') }}
                        </label>
                        <div class="flex flex-wrap">
                            <input type="text" id="search" name="search" value="{{ request('search') }}"
                                class="border border-gray-300 text-text-light dark:text-text-dark text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-card-dark bg-card-light dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="{{ __('Search') }}" />
                            <button
                                class="bg-primary-50 text-text-light dark:text-text-dark px-4 py-2 rounded-lg ms-2 hover:bg-primary-50 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                                {{ __('Search') }}
                            </button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('employee.create') }}"
                    class="bg-primary-50 text-text-light dark:text-text-dark px-5 py-2 rounded-lg hover:bg-primary-50 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                    <i class="fa-solid fa-plus"></i> {{ __('Create Employee') }}
                </a>
            </div>

            <div class="flex flex-wrap">
                <div class="w-full">
                    <div class="dashboard-right ps-0">
                        <div class="invoices-table">
                            <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark ms-1">
                                {{ __('Employee List') }}</h2>
                            <div>
                                <div class="card overflow-x-auto !p-0 !rounded-md">
                                    <div class="max-w-full">
                                        <table class="w-full table-auto">
                                            <thead class="table-header">
                                                <tr class="rounded-none text-left">
                                                    <th class="min-w-[220px] px-4 py-4 font-medium">
                                                        <div class="flex gap-2 items-center text-base">
                                                            <span>{{ __('Employee Name') }}</span>
                                                        </div>
                                                    </th>
                                                    <th class="min-w-[150px] px-4 py-4 font-medium">
                                                        <div class="flex gap-2 items-center text-base">
                                                            <span>{{ __('Employer Name') }}</span>
                                                        </div>
                                                    </th>
                                                    <!-- Total Leave can be used -->
                                                    <th class="min-w-[120px] px-4 py-4 font-medium">
                                                        <div class="flex gap-2 items-center text-base">
                                                            <span>{{ __('Leave Limit') }}</span>
                                                        </div>
                                                    </th>
                                                    <!-- Total Leave -->
                                                    <th class="min-w-[120px] px-4 py-4 font-medium">
                                                        <div class="flex gap-2 items-center text-base">
                                                            <span>{{ __('Total Used Leave') }}</span>
                                                        </div>
                                                    </th>
                                                    <th class="px-4 py-4 font-medium">
                                                        <div class="flex gap-2 items-center text-base">
                                                            <span>{{ __('Status') }}</span>
                                                        </div>
                                                    </th>
                                                    <th class="px-4 py-4 font-medium">{{ __('Action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($employees as $employee)
                                                    <tr
                                                        class="hover:bg-gray-100 hover:dark:bg-gray-800 transition duration-200">
                                                        <td
                                                            class="border-b border-[#eee] dark:border-slate-700 px-4 py-3 dark:border-strokedark">
                                                            <div class="text-sm font-semibold">
                                                                {{ $employee->employee_name }}
                                                            </div>
                                                            <div class="text-xs font-normal text-gray-500">
                                                                {{ $employee->user->email }}
                                                            </div>
                                                        </td>
                                                        <td
                                                            class="text-sm border-b border-[#eee] dark:border-slate-700 px-4 py-3 dark:border-strokedark">
                                                            {{ $employee->employer->employer_name }}
                                                        </td>
                                                        <!-- Total Leave can be used -->
                                                        <td
                                                            class="text-sm border-b border-[#eee] dark:border-slate-700 px-4 py-3 dark:border-strokedark">
                                                            {{ $employee->total_leave ?? 0 }}
                                                        </td>
                                                        <td
                                                            class="text-sm border-b border-[#eee] dark:border-slate-700 px-4 py-3 dark:border-strokedark">
                                                            {{ $employee->approvedLeaveCount() ?? 0 }}
                                                        </td>
                                                        <!-- Total Leave -->
                                                        <td
                                                            class="border-b border-[#eee] dark:border-slate-700 px-4 py-2.5 dark:border-strokedark">
                                                            <div class="flex items-center">
                                                                <div class="h-2.5 w-2.5 rounded-full me-2"
                                                                    style="background-color: {{ $employee->status === 1 ? 'green' : 'red' }};">
                                                                </div>
                                                                <form id="statusForm{{ $employee->id }}"
                                                                    action="{{ route('employee.updateStatus', $employee->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <select name="status"
                                                                        class="border-none bg-transparent focus:outline-none"
                                                                        onchange="document.getElementById('statusForm{{ $employee->id }}').submit()">
                                                                        <option value="1"
                                                                            {{ $employee->status === 1 ? 'selected' : '' }}>
                                                                            {{ __('Active') }}</option>
                                                                        <option value="0"
                                                                            {{ $employee->status === 0 ? 'selected' : '' }}>
                                                                            {{ __('Inactive') }}</option>
                                                                    </select>
                                                                </form>
                                                            </div>
                                                        </td>
                                                        <td
                                                            class="border-b border-[#eee] dark:border-slate-700 px-4 py-3 dark:border-stroke">
                                                            <div class="flex items-center gap-3">
                                                                <a href="{{ route('employee.edit', $employee->id) }}"
                                                                    class="text-blue-500 hover:underline">
                                                                    <x-svgs.edit class="size-[20px]" />
                                                                </a>
                                                                <button onclick="showConfirmation({{ $employee->id }})"
                                                                    class="text-red-500 hover:underline">
                                                                    <x-svgs.delete class="size-[20px]" />
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center py-8  ">
                                                            <x-svgs.no-data-found
                                                                class="mx-auto md:size-[360px] size-[220px]" />
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($employees->total() > $employees->count())
                <div class="mt-2">
                    <div class="d-flex justify-content-center">
                        {{ $employees->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
    <script>
        function showConfirmation(id) {
            Swal.fire({
                title: 'Want to delete this Employee!',
                text: "{{ __('If you are ready?') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "{{ __('Yes') }}",
                cancelButtonText: "{{ __('Cancel') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/employee/destroy/" + id;
                }
            });
        }
    </script>
    <style>
        .dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
</x-app-layout>
