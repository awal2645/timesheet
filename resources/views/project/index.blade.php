@section('title')
    {{ 'List Project' }}
@endsection


<x-app-layout>
    <div class="relative m-6">
        <div class="card mb-4 flex flex-col md:flex-row justify-between items-start md:items-center md:space-y-0">
            <form action="{{ route('project.index') }}" method="GET" class="w-full">
                <div class="mb-3">
                    <label for="search"
                        class="block mb-2 text-sm font-medium text-text-light dark:text-text-dark">{{ __('Search') }}</label>
                    <div class="flex flex-wrap">
                        <input type="text" id="search" name="search" value="{{ request('search') }}"
                            class="border border-gray-300 text-text-light dark:text-text-dark text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-card-dark bg-card-light dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="{{ __('Search') }}" />
                        <button
                            class="bg-primary-50 text-text-light dark:text-text-dark px-4 py-2 rounded-lg ms-2 hover:bg-primary-50 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">{{ __('Search') }}</button>
                    </div>
                </div>
            </form>
            @canany('Project create')
                <a href="{{ route('project.create') }}"
                    class="bg-primary-50 text-text-light dark:text-text-dark px-5 py-2 rounded-lg hover:bg-primary-50 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                    <i class="fa-solid fa-plus"></i> {{ __('Create Project') }}
                </a>
            @endcanany
        </div>

        <!-- Start heading here -->
        <div class="flex flex-wrap">
            <div class="w-full ">
                <div class="dashboard-right ps-0 ">
                    <div class="invoices-table ">
                        <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark ms-1">
                            {{ __('Latest Project') }}</h2>
                        <div class="card overflow-x-auto !p-0 !rounded-md">
                            <div class="max-w-full">
                                <table class="w-full table-auto">
                                    <thead class="table-header">
                                        <tr class="rounded-2xl text-left ">
                                            <th class="min-w-[220px] px-4 py-4 font-medium">{{ __('Project Name') }}
                                            </th>
                                            <th class="min-w-[150px] px-4 py-4 font-medium">{{ __('Client Name') }}
                                            </th>
                                            <th class="min-w-[120px] px-4 py-4 font-medium">
                                                {{ __('Billing Type') }}</th>
                                            <th class="px-4 py-4 font-medium">{{ __('Total Time') }}</th>
                                            <th class="px-4 py-4 font-medium">{{ __('Total Cost') }}</th>
                                            <th class="px-4 py-4 font-medium">{{ __('Total Paid Client') }}</th>
                                            @canany('Project view')
                                                <th class="px-4 py-4 font-medium">{{ __('Status') }}</th>
                                            @endcanany
                                            @canany('Project create')
                                                <th class="px-4 py-4 font-medium">{{ __('Action') }}</th>
                                            @endcanany
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($projects->count() > 0)
                                            @foreach ($projects as $key => $project)
                                                @php
                                                    $totalMinutes = 0;

                                                    // Loop through each task to sum the time in minutes
                                                    foreach ($project->tasks as $task) {
                                                        if (!empty($task->time) && strpos($task->time, ':') !== false) {
                                                            $timeParts = explode(':', $task->time);

                                                            // Convert hours and minutes to integers for calculation
                                                            $hours = isset($timeParts[0]) ? (int) $timeParts[0] : 0;
                                                            $minutes = isset($timeParts[1]) ? (int) $timeParts[1] : 0;

                                                            // Convert hours to minutes and add minutes
                                                            $taskMinutes = $hours * 60 + $minutes;
                                                            $totalMinutes += $taskMinutes;
                                                        }
                                                    }

                                                    // Convert total minutes to hours
                                                    $totalHours = $totalMinutes / 60;

                                                    // Ensure hr_budget is numeric before calculation
                                                    $hrBudget = is_numeric($project->hr_budget)
                                                        ? $project->hr_budget
                                                        : 0;

                                                    // Calculate total cost based on hours
                                                    $totalCost = $totalHours * $hrBudget;
                                                @endphp
                                                <tr
                                                    class="hover:bg-gray-100 hover:dark:bg-gray-800 transition duration-200">
                                                    <td class="border-b border-[#eee] dark:border-slate-700 px-4 py-3">
                                                        {{ $project->project_name ?? '' }}</td>
                                                    <td class="border-b border-[#eee] dark:border-slate-700 px-4 py-3">
                                                        {{ $project->client->client_name ?? '' }}</td>
                                                    <td class="border-b border-[#eee] dark:border-slate-700 px-4 py-3">
                                                        {{ $project->payment_type ?? '' }}</td>
                                                    <td class="border-b border-[#eee] dark:border-slate-700 px-4 py-3">
                                                        {{ number_format($totalHours, 2) ?? '' }}</td>
                                                    <td class="border-b border-[#eee] dark:border-slate-700 px-4 py-3">
                                                        ${{ number_format($totalCost, 2) ?? '' }}</td>
                                                    <td class="border-b border-[#eee] dark:border-slate-700 px-4 py-3">
                                                        ${{ number_format($project->total_paid_client, 2) ?? '' }}</td>
                                                    @canany('Project view')
                                                        <td
                                                            class="border-b border-[#eee] dark:border-slate-700 px-4 py-2.5 dark:border-strokedark">
                                                            <form
                                                                action="{{ route('project.updateStatus', $project->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <label class="inline-flex items-center cursor-pointer">
                                                                    <input type="checkbox" name="status" id="status"
                                                                        {{ $project->status == '1' ? 'checked' : '' }}
                                                                        class="sr-only peer" onchange="this.form.submit()">
                                                                    <div
                                                                        class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary-300 dark:peer-focus:ring-primary-300 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary-50">
                                                                    </div>
                                                                </label>
                                                            </form>
                                                        </td>
                                                    @endcanany
                                                    @canany('Project create')
                                                        <td
                                                            class="border-b border-[#eee] dark:border-slate-700 px-4 py-3 dark:border-stroke">
                                                            <div class="flex items-center gap-3">
                                                                <a href="{{ route('project.edit', $project->id) }}"
                                                                    class="text-blue-500 hover:underline"><x-svgs.edit
                                                                        class="size-[20px]" /></a>
                                                                <button onclick="showConfirmation({{ $project->id }})"
                                                                    class="text-red-500 hover:underline"><x-svgs.delete
                                                                        class="size-[20px]" /></button>
                                                            </div>
                                                        </td>
                                                    @endcanany
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="8" class="text-center py-8  ">
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
        @if ($projects->total() > $projects->count())
            <div class="mt-2">
                <div class="d-flex justify-content-center">
                    {{ $projects->links() }}
                </div>
            </div>
        @endif
    </div>
    <script>
        function showConfirmation() {
            Swal.fire({
                title: 'Want to delete this Project!',
                text: "{{ __('If you are ready?') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "{{ __('Yes') }}",
                cancelButtonText: "{{ __('Cancel') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('project.destroy', $project->id ?? '') }}";
                }
            });
        }
    </script>
</x-app-layout>
