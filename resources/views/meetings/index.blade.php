@section('title')
    {{ 'List Meeting' }}
@endsection
<x-app-layout>
    <div class="relative overflow-x-auto">
        <div class="m-6">
            <div
                class="flex flex-col md:flex-row justify-end items-center md:space-y-0 p-6 bg-white/10 dark:bg-black/10 rounded-lg border border-black/10 dark:border-white/10">
                <a href="{{ route('meeting.create') }}" class="bg-purple-500 text-white px-4 py-2 rounded-lg"><i
                        class="fa-solid fa-plus"></i> {{ __('Create Project') }}</a>
            </div>
            <!-- Start heading  here -->
            <div
                class="flex flex-wrap mt-12 p-6 bg-white/10 dark:bg-black/10 rounded-lg border border-black/10 dark:border-white/10">
                <div class="w-full ">
                    <div class="dashboard-right pl-0 ">
                        <div class="invoices-table ">
                            <h2 class="text-xl font-semibold mb-4">{{ __('Latest Meeting') }}</h2>
                            <div class="overflow-x-auto pb-1">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 border border-gray-300 dark:border-gray-700">
                                                {{ __('Meeting Topic') }}
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 border border-gray-300 dark:border-gray-700">
                                                {{ __('Host Mail') }}
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 border border-gray-300 dark:border-gray-700">
                                                {{ __('Start Date') }}
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 border border-gray-300 dark:border-gray-700">
                                                {{ __('Password') }}
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
                                        @if ($meetings->count() > 0)
                                            @foreach ($meetings as $key => $meeting)
                                                <tr
                                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                                    <th scope="row"
                                                        class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                                        <div class="">
                                                            <div class="text-base font-semibold">
                                                                {{ $meeting->topic ?? '' }}</div>
                                                            <div class="font-normal text-gray-500">
                                                                #{{ $meeting->meeting_id ?? '' }}
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <td class="px-6 py-4 border border-gray-300 dark:border-gray-700">

                                                        <div class="">
                                                            <div class="text-base font-semibold">
                                                                <a rel="noopener noreferrer">
                                                                    {{ $meeting->host_email ?? '' }}
                                                                </a>
                                                            </div>
                                                            <div class="font-normal text-gray-500 mt-5">
                                                                <a target="__blank"
                                                                    class="text-white bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 dark:bg-purple-500 dark:hover:bg-purple-700 dark:focus:ring-purple-900"
                                                                    href=" {{ $meeting->meeting_join_url ?? '#' }}">
                                                                    {{ __('Join Zoom') }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 border border-gray-300 dark:border-gray-700">
                                                        <a rel="noopener noreferrer">
                                                            {{ $meeting->start_time ?? '' }}
                                                        </a>
                                                    </td>
                                                    <td class="px-6 py-4 border border-gray-300 dark:border-gray-700">
                                                        <a rel="noopener noreferrer">
                                                            {{ $meeting->password ?? '' }}
                                                        </a>
                                                    </td>
                                                    <td class="px-6 py-4 border border-gray-300 dark:border-gray-700">
                                                        <a
                                                            rel="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">
                                                            {{ $meeting->status ?? '' }}
                                                        </a>
                                                    </td>
                                                    {{-- <td class="px-6 py-4 border border-gray-300 dark:border-gray-700">
                                                <div class="flex items-center space-x-2">
                                                    <div class="h-2.5 w-2.5 rounded-full" id="statusIndicator"
                                                        style="background-color: {{ $project->status === 1 ? 'green' : 'red' }};">
                                                    </div>
                                                    <form id="statusForm{{ $project->id }}"
                                                        action="{{ route('project.updateStatus', $project->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <select name="status" id="status"
                                                            class="border-none bg-transparent text-gray-900 dark:text-white focus:outline-none"
                                                            onchange="document.getElementById('statusForm{{ $project->id }}').submit()">
                                                            <!-- Replace data-project-id with the actual project ID -->
                                                            <option class="dark:bg-slate-800" value="1" {{ $project->
                                                                status === 1 ? 'selected' : '' }}>
                                                                {{__('Active')}}
                                                            <option class="dark:bg-slate-800" value="0" {{ $project->
                                                                status === 0 ? 'selected' : '' }}>
                                                                {{__('Inactive')}}
                                                        </select>
                                                    </form>

                                                </div>
                                            </td> --}}
                                                    <td class="px-6 py-4 border border-gray-300 dark:border-gray-700">
                                                        <div class="flex space-x-2">
                                                            <a href="{{ route('project.edit', $meeting->id) }}"
                                                                class="font-medium text-purple-600 dark:text-purple-500 hover:underline">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class="w-6 h-6">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                                </svg>
                                                            </a>
                                                            <a onclick="showConfirmation()"
                                                                class="font-medium cursor-pointer text-red-600 dark:text-red-500 hover:underline">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class="w-6 h-6">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6"
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
            @if ($meetings->total() > $meetings->count())
                <div class=" mt-2">
                    <div class="d-flex justify-content-center">
                        {{ $meetings->links() }}
                    </div>
                </div>
            @endif
        </div>
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
                    window.location.href = "{{ route('project.destroy', $meeting->id ?? '') }}";
                }
            });
        }
    </script>
</x-app-layout>
