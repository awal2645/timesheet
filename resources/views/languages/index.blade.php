@section('title', __('language_list'))

<x-app-layout>
    <div class="m-6">
        <div class="card flex justify-between items-center mb-4">
            <form action="{{ route('languages.index') }}" method="GET" class="w-full">
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
            <a href="{{ route('languages.create') }}"
                class="bg-primary-50 text-text-light dark:text-text-dark px-5 py-2 rounded-lg hover:bg-primary-50 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                <i class="fa-solid fa-plus"></i> {{ __('Create Language') }}
            </a>
        </div>

        <div class="flex flex-wrap">
            <div class="w-full">
                <div class="dashboard-right ps-0">
                    <div class="invoices-table">
                        <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark ms-1">
                            {{ __('Language List') }}</h2>
                        <div class="card overflow-x-auto !p-0 !rounded-md">
                            <table class="w-full table-auto">
                                <thead class="table-header">
                                    <tr class="rounded-none text-left">
                                        <th class="min-w-[220px] px-4 py-4 font-medium">
                                            {{ __('Language Name') }}</th>
                                        <th class="min-w-[150px] px-4 py-4 font-medium">
                                            {{ __('Language Code') }}</th>
                                        <th class="min-w-[150px] px-4 py-4 font-medium">
                                            {{ __('Direction') }}</th>
                                        <th class="px-4 py-4 font-medium">
                                            {{ __('Actions') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($languagesList->count() > 0)
                                        @foreach ($languagesList as $language)
                                            <tr class="hover:bg-gray-100 hover:dark:bg-gray-800">
                                                <td class="border-b border-[#eee] dark:border-slate-700 px-4 py-2.5">
                                                    {{ $language->name }}</td>
                                                <td class="border-b border-[#eee] dark:border-slate-700 px-4 py-2.5">
                                                    {{ $language->code }}</td>
                                                <td class="border-b border-[#eee] dark:border-slate-700 px-4 py-2.5">
                                                    {{ __($language->direction) }}</td>
                                                <td class="border-b border-[#eee] dark:border-slate-700 px-4 py-2.5">
                                                    <div class="flex gap-5">
                                                        <a href="{{ route('languages.json.edit', $language->code) }}"
                                                            class="text-primary-50 hover:text-primary-50"> <x-svgs.globe
                                                                class="size-4" /></a>
                                                        <a href="{{ route('languages.edit', $language->id) }}"
                                                            class="text-primary-50 hover:text-primary-30"> <x-svgs.edit
                                                                class="size-4" /></a>
                                                        <form action="{{ route('languages.destroy', $language->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Are you sure you want to delete this language?');"
                                                            class="">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="text-red-500 hover:text-red-700"> <x-svgs.delete
                                                                    class="size-4" /></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center py-8  ">
                                                <x-svgs.no-data-found class="mx-auto md:size-[360px] size-[220px]" />
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
        @if ($languagesList->total() > $languagesList->count())
            <div class="mt-2">
                <div class="d-flex justify-content-center">
                    {{ $languagesList->links() }}
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
