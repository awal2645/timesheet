@section('title')
    {{ __('List Employee') }}
@endsection
<x-app-layout>
    <div class="relative overflow-x-auto">
        <div class="container mx-auto px-5">
            <div class=" mt-10 mb-5 flex flex-col md:flex-row justify-between items-center md:space-y-0 ">
                <form action="{{ route('employee.index') }}" method="GET">
                    <div class="mb-5">
                        <label for="search" class="block mb-2 text-sm font-medium">{{ __('Search')}}</label>
                        <div class="flex">
                            <input type="text" id="search" name="search" value="{{ request('search') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="{{ __('Search')}}" />
                            <button class="bg-teal-500 text-white px-4 py-2 rounded-lg ml-2">{{ __('Search')}}</button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('employee.create') }}" class="bg-teal-500 text-white px-4 py-2 rounded-lg"><i
                        class="fa-solid fa-plus"></i>  {{ __('Create Employee') }}</a>
            </div>
            <!-- Start heading  here -->
            <div class="flex flex-wrap">
                <div class="w-full ">
                    <div class="dashboard-right pl-0 ">
                        <div class="invoices-table ">
                            <h2 class="text-xl font-semibold mb-4">{{ __('Employee List') }}</h2>
                            <div class="overflow-x-auto pb-1">
                                <!-- Start heading  here -->
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 border border-gray-300 dark:border-gray-700">
                                                 {{ __('Employee Name') }}
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 border border-gray-300 dark:border-gray-700">
                                                 {{ __('Employer Name') }}
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 border border-gray-300 dark:border-gray-700">
                                                {{ __('Status') }}
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 border border-gray-300 dark:border-gray-700">
                                                {{ __('Action') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($employees->count() > 0)
                                            @foreach ($employees as $key => $employee)
                                                <tr
                                                    class="bg-white border border-gray-300 dark:border-gray-700 dark:bg-gray-800  hover:bg-gray-50 dark:hover:bg-gray-600">

                                                    <th scope="row"
                                                        class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white ">
                                                        @if ($employee->user->image)
                                                            <img class="w-10 h-10 rounded-full"
                                                                src="{{ asset($employee->user->image) }}"
                                                                alt="image">
                                                        @else
                                                            <img class="w-10 h-10 rounded-full"
                                                                src="https://img.freepik.com/premium-vector/company-icon-simple-element-illustration-company-concept-symbol-design-can-be-used-web-mobile_159242-7784.jpg"
                                                                alt="image">
                                                        @endif
                                                        <div class="">
                                                            <div class="text-base font-semibold">
                                                                {{ $employee->employee_name }}
                                                            </div>
                                                            <div class="font-normal text-gray-500">
                                                                {{ $employee->user->email }}
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <td class="px-6 py-4 border border-gray-300 dark:border-gray-700">
                                                        <a href="#" rel="noopener noreferrer">
                                                            {{ $employee->employer->employer_name }}
                                                        </a>
                                                    </td>
                                                    <td class="px-6 py-4 border border-gray-300 dark:border-gray-700">
                                                        <div class="flex items-center space-x-2">
                                                            <div class="h-2.5 w-2.5 rounded-full" id="statusIndicator"
                                                                style="background-color: {{ $employee->status === 1 ? 'green' : 'red' }};">
                                                            </div>
                                                            <form id="statusForm{{ $employee->id }}"
                                                                action="{{ route('employee.updateStatus', $employee->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <select name="status" id="status"
                                                                    class="border-none bg-transparent text-gray-900 dark:text-white focus:outline-none"
                                                                    onchange="document.getElementById('statusForm{{ $employee->id }}').submit()">
                                                                    <!-- Replace data-project-id with the actual project ID -->
                                                                    <option class="dark:bg-slate-800" value="1"
                                                                        {{ $employee->status === 1 ? 'selected' : '' }}>
                                                                        {{__('Active')}}
                                                                    <option class="dark:bg-slate-800" value="0"
                                                                        {{ $employee->status === 0 ? 'selected' : '' }}>
                                                                        {{__('Inactive')}}
                                                                </select>
                                                            </form>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 flex  space-x-2">
                                                        <a href="{{ route('employee.edit', $employee->id) }}"
                                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="w-6 h-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                            </svg>
                                                        </a>
                                                        <a onclick="showConfirmation({{ $employee->id }})"
                                                            class="font-medium cursor-pointer text-red-600 dark:text-red-500 hover:underline">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="w-6 h-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                            </svg>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5"
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

    @if ($employees->total() > $employees->count())
        <div class=" mt-2">
            <div class="d-flex justify-content-center">
                {{ $employees->links() }}
            </div>
        </div>
    @endif
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
                    console.log(result.isConfirmed);
                    window.location.href = "/employee/destroy/" + id;
                }
            });
        }
    </script>
</x-app-layout>
<style>
    .dropdown:hover .dropdown-menu {
        display: block;
    }

    #searchInput {
        width: 160px;
        /* Adjust the width as needed */
    }
</style>
