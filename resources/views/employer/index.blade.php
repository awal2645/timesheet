@section('title')
    {{ 'List Employer' }}
@endsection

<x-app-layout>
    <div class="relative m-6">
        <div>
            <div class="my-8 card flex flex-col md:flex-row gap-4 md:justify-between items-start md:items-center">
                <form action="{{ route('employer.index') }}" method="GET" class="w-full">
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
                <a href="{{ route('employer.create') }}"
                    class="bg-primary-50 text-text-light dark:text-text-dark px-5 py-2 rounded-lg hover:bg-primary-50 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                    <i class="fa-solid fa-plus"></i> {{ __('Create Employer') }}
                </a>
            </div>

            <div class="flex flex-wrap">
                <div class="w-full">
                    <div class="dashboard-right ps-0">
                        <div class="invoices-table">
                            <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark ms-1">
                                {{ __('Employer List') }}</h2>
                            <div>
                                <div class="card overflow-x-auto">
                                    <table class="w-full table-auto">
                                        <thead class="table-header">
                                            <tr class="rounded-2xl text-left">
                                                <th class="min-w-[220px] px-4 py-4 font-medium">
                                                    <div class="flex gap-2 items-center text-base">
                                                        <span>{{ __('Employer Name') }}</span>
                                                    </div>
                                                </th>
                                                <th class="min-w-[150px] px-4 py-4 font-medium">
                                                    <div class="flex gap-2 items-center text-base">
                                                        <span>{{ __('Employee') }}</span>
                                                    </div>
                                                </th>
                                                <th class="min-w-[120px] px-4 py-4 font-medium">
                                                    <div class="flex gap-2 items-center text-base">
                                                        <span>{{ __('Website') }}</span>
                                                    </div>
                                                </th>
                                                <th class="min-w-[120px] px-4 py-4 font-medium">
                                                    <div class="flex gap-2 items-center text-base">
                                                        <span>{{ __('Status') }}</span>
                                                    </div>
                                                </th>
                                                <th class="px-4 py-4 font-medium">{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($employers as $employer)
                                                <tr class="hover:bg-gray-100 hover:dark:bg-gray-800">
                                                    <td
                                                        class="border-b border-[#eee] dark:border-slate-700 px-4 py-3 dark:border-strokedark">
                                                        <div class="flex items-center">
                                                            @if ($employer->user->image)
                                                                <img class="w-10 h-10 rounded-full"
                                                                    src="{{ asset($employer->user->image) }}"
                                                                    alt="image">
                                                            @else
                                                                <img class="w-10 h-10 rounded-full"
                                                                    src="https://img.freepik.com/premium-vector/company-icon-simple-element-illustration-company-concept-symbol-design-can-be-used-web-mobile_159242-7784.jpg"
                                                                    alt="image">
                                                            @endif
                                                            <div class="ms-3">
                                                                <div class="text-base font-semibold">
                                                                    {{ $employer->employer_name }}</div>
                                                                <div class="text-sm text-gray-500">
                                                                    {{ $employer->user->email }}</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="border-b border-[#eee] dark:border-slate-700 px-4 py-3 dark:border-strokedark">
                                                        <span class="text-base font-semibold">Employee (
                                                            {{ $employer->employee->count() }} )</span>
                                                    </td>
                                                    <td
                                                        class="border-b border-[#eee] dark:border-slate-700 px-4 py-3 dark:border-strokedark">
                                                        <a href="{{ $employer->website }}" target="_blank"
                                                            class="hover:text-primary-500">
                                                            {{ $employer->website }}
                                                        </a>
                                                    </td>
                                                    <td
                                                        class="border-b border-[#eee] dark:border-slate-700 px-4 py-3 dark:border-strokedark">
                                                        <div class="flex items-center">
                                                            <div class="h-2.5 w-2.5 rounded-full me-2"
                                                                style="background-color: {{ $employer->status === 1 ? 'green' : 'red' }};">
                                                            </div>
                                                            <form id="statusForm{{ $employer->id }}"
                                                                action="{{ route('employer.updateStatus', $employer->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <select name="status"
                                                                    class="border-none bg-transparent focus:outline-none"
                                                                    onchange="document.getElementById('statusForm{{ $employer->id }}').submit()">
                                                                    <option value="1"
                                                                        {{ $employer->status === 1 ? 'selected' : '' }}>
                                                                        {{ __('Active') }}</option>
                                                                    <option value="0"
                                                                        {{ $employer->status === 0 ? 'selected' : '' }}>
                                                                        {{ __('Inactive') }}</option>
                                                                </select>
                                                            </form>
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="border-b border-[#eee] dark:border-slate-700 px-4 py-3 dark:border-stroke">
                                                        <div class="flex items-center gap-3">
                                                            <a href="{{ route('employer.edit', $employer->id) }}"
                                                                class="text-blue-500 hover:underline">
                                                                <x-svgs.edit class="size-[20px]" />
                                                            </a>
                                                            <button onclick="showConfirmation({{ $employer->id }})"
                                                                class="text-red-500 hover:underline">
                                                                <x-svgs.delete class="size-[20px]" />
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center py-8">
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

            @if ($employers->total() > $employers->count())
                <div class="mt-2">
                    <div class="d-flex justify-content-center">
                        {{ $employers->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
    <script>
        function showConfirmation(id) {
            Swal.fire({
                title: 'Want to delete this Employer!',
                text: "{{ __('If you are ready?') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "{{ __('Yes') }}",
                cancelButtonText: "{{ __('Cancel') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/employer/destroy/" + id;
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
