@section('title', ' Notices List ')

<x-app-layout>
    <div class="relative overflow-x-auto">
        <div class="m-6">
            <div
                class="p-6 flex flex-col md:flex-row justify-between items-center md:space-y-0 bg-white/10 dark:bg-black/10 rounded-lg border border-black/10 dark:border-white/10">
                <form action="{{ route('notices.index') }}" method="GET">
                    <div class="mb-5">
                        <label for="search" class="block mb-2 text-sm font-medium">{{ __('Search') }}</label>
                        <div class="flex">
                            <input type="text" id="search" name="search" value="{{ request('search') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="{{ __('Search') }}" />
                            <button
                                class="bg-primary-500 text-white px-4 py-2 rounded-lg ml-2">{{ __('Search') }}</button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('notices.create') }}" class="bg-primary-500 text-white px-4 py-2 rounded-lg"><i
                        class="fa-solid fa-plus"></i> {{ __('Create Notice') }}</a>
            </div>

            <div class="bg-white/10 dark:bg-black/10 p-6 rounded-lg border border-black/10 dark:border-white/10 mt-12">
                <h2 class="text-xl font-semibold mb-4">{{ __('Notices') }}</h2>
                <div class="overflow-x-auto pb-1">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 border border-gray-300 dark:border-gray-700">
                                    {{ __('Title') }}
                                </th>
                                <th scope="col" class="px-6 py-3 border border-gray-300 dark:border-gray-700">
                                    {{ __('Roll Name') }}
                                </th>
                                <th scope="col" class="px-6 py-3 border border-gray-300 dark:border-gray-700">
                                    {{ __('Actions') }}
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($notices->count() > 0)
                                @foreach ($notices as $notice)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4 border border-gray-300 dark:border-gray-700">
                                            {{ $notice->title }}
                                        </td>
                                        <td class="px-6 py-4 border border-gray-300 dark:border-gray-700">
                                            @php
                                                // Split the role string into an array
                                                $noticeRoles = explode(',', $notice->role); // Convert "3,4" into an array [3, 4]
                                            @endphp

                                            @foreach ($roles as $role)
                                                @if (in_array($role->id, $noticeRoles))
                                                    {{ ucfirst($role->name) }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="px-6 py-4 border border-gray-300 dark:border-gray-700">
                                            <a href="{{ route('notices.edit', $notice->id) }}"
                                                class="text-primary-600 hover:underline">{{ __('Edit') }}</a>
                                            <form action="{{ route('notices.destroy', $notice->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:underline">{{ __('Delete') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3"
                                        class="text-center py-8 border border-gray-300 dark:border-gray-700">
                                        <img src="{{ asset('images/no-data-found.svg') }}" alt="No data found"
                                            class="mx-auto max-w-xs">
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
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
    </div>
</x-app-layout>
