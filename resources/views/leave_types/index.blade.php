@section('title')
    {{ 'List Leave Types' }}
@endsection

<x-app-layout>
    <div class="relative m-6">
        <div class="">
            <div class="card flex flex-col md:flex-row gap-3 justify-between items-start md:items-center">
                <form action="{{ route('leave_types.index') }}" method="GET" class="w-full">
                    <div class="mb-3">
                        <label for="search" class="block mb-2 text-sm font-medium text-text-light dark:text-text-dark">
                            {{ __('Search') }}
                        </label>
                        <div class="flex flex-wrap">
                            <input type="text" id="search" name="search" value="{{ request('search') }}"
                                class="border border-gray-300 text-text-light dark:text-text-dark text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-card-dark bg-card-light dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="{{ __('Search') }}" />
                            <button
                                class="bg-primary-50 text-text-light dark:text-text-dark px-4 py-2 rounded-lg ml-2 hover:bg-primary-50 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                                {{ __('Search') }}
                            </button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('leave_types.create') }}"
                    class="bg-primary-50 text-text-light dark:text-text-dark px-5 py-2 rounded-lg hover:bg-primary-50 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                    <i class="fa-solid fa-plus"></i> {{ __('Create Leave Type') }}
                </a>
            </div>

            <div class="mt-12 flex flex-wrap">
                <div class="w-full">
                    <div class="dashboard-right pl-0">
                        <div class="invoices-table">
                            <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark ml-1">
                                {{ __('Leave Type List') }}</h2>
                            <div>
                                <div class="card overflow-x-auto">
                                    <table class="w-full table-auto">
                                        <thead class="table-header">
                                            <tr class="rounded-2xl text-left">
                                                <th class="min-w-[220px] px-4 py-4 font-medium">
                                                    {{ __('Leave Type') }}</th>
                                                <th class="min-w-[150px] px-4 py-4 font-medium">
                                                    {{ __('Description') }}</th>
                                                <th class="px-4 py-4 font-medium">{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($leaveTypes->count() > 0)
                                                @foreach ($leaveTypes as $leaveType)
                                                    <tr
                                                        class="hover:bg-gray-100 hover:dark:bg-gray-800 transition duration-200">
                                                        <td
                                                            class="border-b border-[#eee] dark:border-slate-700 px-4 py-2.5">
                                                            {{ $leaveType->type }}</td>
                                                        <td
                                                            class="border-b border-[#eee] dark:border-slate-700 px-4 py-2.5">
                                                            {{ $leaveType->description }}</td>
                                                        <td
                                                            class="border-b border-[#eee] dark:border-slate-700 px-4 py-2.5">
                                                            <div class="flex ">
                                                                <a href="{{ route('leave_types.edit', $leaveType->id) }}"
                                                                    class="text-primary-50 hover:text-primary-300"><x-svgs.edit /></a>
                                                                <form
                                                                    action="{{ route('leave_types.destroy', $leaveType->id) }}"
                                                                    method="POST"
                                                                    onsubmit="return confirm('Are you sure you want to delete this leave type?');"
                                                                    class="ml-2">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="text-red-500 hover:text-red-700"><x-svgs.delete /></button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="3" class="text-center py-8  ">
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
            @if ($leaveTypes->total() > $leaveTypes->count())
                <div class="mt-2">
                    <div class="d-flex justify-content-center">
                        {{ $leaveTypes->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
