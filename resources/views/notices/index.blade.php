@section('title', 'Notices List')

<x-app-layout>
    <div class="relative m-3">
        <div class="container mx-auto px-4">
            <div
                class="my-8 px-5 py-3 rounded-2xl dark:bg-header-dark bg-header-light backdrop-blur border border-black/10 dark:border-white/10 flex flex-col md:flex-row justify-between items-center md:space-y-0">
                <form action="{{ route('notices.index') }}" method="GET" class="w-full">
                    <div class="mb-5">
                        <label for="search" class="block mb-2 text-sm font-medium text-text-light dark:text-text-dark">
                            {{ __('Search') }}
                        </label>
                        <div class="flex">
                            <input type="text" id="search" name="search" value="{{ request('search') }}"
                                class="border border-gray-300 text-text-light dark:text-text-dark text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-header-dark bg-header-light dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="{{ __('Search') }}" />
                            <button
                                class="bg-primary-300 text-text-light dark:text-text-dark px-4 py-2 rounded-lg ml-2 hover:bg-primary-600 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                                {{ __('Search') }}
                            </button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('notices.create') }}"
                    class="bg-primary-300 text-text-light dark:text-text-dark px-5 py-2 rounded-lg hover:bg-primary-600 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                    <i class="fa-solid fa-plus"></i> {{ __('Create Notice') }}
                </a>
            </div>

            <div class="flex flex-wrap">
                <div class="w-full">
                    <div class="dashboard-right pl-0">
                        <div class="invoices-table">
                            <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark">{{ __('Notices') }}</h2>
                            <div class="overflow-hidden">
                                <div
                                    class="rounded-lg border border-black/10 dark:border-white/10 shadow-lg bg-body-light backdrop-blur dark:bg-body-dark px-5 pb-2.5 pt-6 shadow-default sm:px-7.5">
                                    <table class="w-full table-auto">
                                        <thead class="bg-primary-300 text-text-light dark:text-text-dark">
                                            <tr class="rounded-2xl text-left">
                                                <th class="px-4 py-4 font-medium">
                                                    {{ __('Title') }}
                                                </th>
                                                <th class="px-4 py-4 font-medium">
                                                    {{ __('Roll Name') }}
                                                </th>
                                                <th class="px-4 py-4 font-medium">
                                                    {{ __('Actions') }}
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($notices->count() > 0)
                                                @foreach ($notices as $notice)
                                                    <tr class="hover:bg-gray-100 hover:dark:bg-gray-800 transition duration-200">
                                                        <td class="border-b border-[#eee] dark:border-slate-700 px-4 py-3">
                                                            {{ $notice->title }}
                                                        </td>
                                                        <td class="border-b border-[#eee] dark:border-slate-700 px-4 py-3">
                                                            @php
                                                                $noticeRoles = explode(',', $notice->role);
                                                            @endphp
                                                            @foreach ($roles as $role)
                                                                @if (in_array($role->id, $noticeRoles))
                                                                    {{ ucfirst($role->name) }}
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td class="border-b border-[#eee] dark:border-slate-700 px-4 py-3">
                                                            <div class="flex justify-end">
                                                                <a href="{{ route('notices.edit', $notice->id) }}"
                                                                    class="text-primary-600 hover:underline">{{ __('Edit') }}</a>
                                                                <form action="{{ route('notices.destroy', $notice->id) }}" method="POST" style="display:inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="text-red-600 hover:underline">{{ __('Delete') }}</button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="3" class="text-center py-8  ">
                                                        <img src="{{ asset('images/no-data-found.svg') }}" alt="No data found" class="mx-auto max-w-xs">
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

            @if ($notices->total() > $notices->count())
                <div class="mt-2">
                    <div class="d-flex justify-content-center">
                        {{ $notices->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>