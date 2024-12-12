@section('title', 'Notices List')

<x-app-layout>
    <div class="m-6">
        <div class="my-8 card flex flex-col md:flex-row gap-4 md:justify-between items-start md:items-center">
            <form action="{{ route('notices.index') }}" method="GET" class="w-full">
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
            <a href="{{ route('notices.create') }}"
                class="bg-primary-50 text-text-light dark:text-text-dark px-5 py-2 rounded-lg hover:bg-primary-50 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                <i class="fa-solid fa-plus"></i> {{ __('Create Notice') }}
            </a>
        </div>

        <div class="flex flex-wrap">
            <div class="w-full">
                <div class="dashboard-right pl-0">
                    <div class="invoices-table">
                        <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark ml-1">{{ __('Notices') }}
                        </h2>
                        <div>
                            <div class="card overflow-x-auto">
                                <table class="w-full table-auto">
                                    <thead class="table-header">
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
                                                <tr
                                                    class="hover:bg-gray-100 hover:dark:bg-gray-800 transition duration-200">
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
                                                        <div class="flex flex-wrap">
                                                            <a href="{{ route('notices.edit', $notice->id) }}"
                                                                class="text-primary-50 hover:underline mr-2"><x-svgs.edit /></a>
                                                            <form action="{{ route('notices.destroy', $notice->id) }}"
                                                                method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="text-red-600 hover:underline"><x-svgs.delete /></button>
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

        @if ($notices->total() > $notices->count())
            <div class="mt-2">
                <div class="d-flex justify-content-center">
                    {{ $notices->links() }}
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
