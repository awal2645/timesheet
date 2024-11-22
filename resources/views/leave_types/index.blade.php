@section('title')
    {{ 'List Leave Types' }}
@endsection
<x-app-layout>
    <div class="relative overflow-x-auto">
        <div class="container mx-8">
            <div
                class="my-8 px-5 py-3 rounded-2xl dark:bg-black/10 bg-white/10 backdrop-blur border border-black/10 dark:border-white/10 flex flex-col md:flex-row justify-between items-center md:space-y-0 ">
                <form action="{{ route('leave_types.index') }}" method="GET">
                    <div class="mb-5">
                        <label for="search" class="block mb-2 text-sm font-medium">{{ __('Search') }}</label>
                        <div class="flex">
                            <input type="text" id="search" name="search" value="{{ request('search') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                                placeholder="{{ __('Search') }}" />
                            <button
                                class="bg-purple-500 text-white px-4 py-2 rounded-lg ml-2">{{ __('Search') }}</button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('leave_types.create') }}" class="bg-purple-500 text-white px-4 py-2 rounded-lg"><i
                        class="fa-solid fa-plus"></i> {{ __('Create Leave Type') }}</a>
            </div>
            <div class="flex flex-wrap">
                <div class="w-full ">
                    <div class="dashboard-right pl-0 ">
                        <div class="invoices-table ">
                            <h2 class="text-xl font-semibold mb-4">{{ __('Leave Type List') }}</h2>
                            <div class="overflow-x-auto">
                                <div
                                    class="rounded-lg border border-black/10 dark:border-white/10 shadow-lg bg-white/10 backdrop-blur dark:bg-black/10  px-5 pb-2.5 pt-6 shadow-default sm:px-7.5 xl:pb-1">
                                    <div class="max-w-full overflow-x-auto">
                                        <table class="w-full table-auto">
                                            <thead>
                                                <tr class="bg-gray-200 rounded-2xl text-left dark:bg-gray-700">
                                                    <th
                                                        class="min-w-[220px] px-4 py-4 font-medium text-black dark:text-white xl:pl-11">
                                                        {{ __('Leave Type') }}</th>
                                                    <th
                                                        class="min-w-[150px] px-4 py-4 font-medium text-black dark:text-white">
                                                        {{ __('Description') }}</th>
                                                    <th class="px-4 py-4 font-medium text-black dark:text-white"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($leaveTypes->count() > 0)
                                                    @foreach ($leaveTypes as $leaveType)
                                                        <tr class="hover:bg-gray-100 hover:dark:bg-gray-800">
                                                            <td
                                                                class="border-b border-[#eee] dark:border-slate-700 px-4 py-2.5">
                                                                {{ $leaveType->type }}</td>
                                                            <td
                                                                class="border-b border-[#eee] dark:border-slate-700 px-4 py-2.5">
                                                                {{ $leaveType->description }}</td>
                                                            <td
                                                                class="border-b border-[#eee] dark:border-slate-700 px-4 py-2.5">
                                                                <div class="flex justify-end">
                                                                    <a href="{{ route('leave_types.edit', $leaveType->id) }}"
                                                                        class="text-purple-500 hover:text-purple-700">{{ __('Edit') }}</a>
                                                                    <form
                                                                        action="{{ route('leave_types.destroy', $leaveType->id) }}"
                                                                        method="POST"
                                                                        onsubmit="return confirm('Are you sure you want to delete this leave type?');"
                                                                        class="ml-2">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="text-red-500 hover:text-red-700">{{ __('Delete') }}</button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="3"
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
