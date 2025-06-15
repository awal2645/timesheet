@section('title', 'Language Management')

<x-app-layout>
    <div class="relative m-6">
        <!-- Search and Create Section -->
        <div class="my-8 card flex flex-col md:flex-row gap-4 md:justify-between items-start md:items-center">
            <form action="{{ route('languages.index') }}" method="GET" class="w-full">
                <div class="mb-3">
                    <label for="search" class="block mb-2 text-sm font-medium text-text-light dark:text-text-dark">
                        {{ __('Search') }}
                    </label>
                    <div class="flex flex-wrap">
                        <input type="text" id="search" name="search" value="{{ request('search') }}"
                            class="border border-gray-300 text-text-light dark:text-text-dark text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-card-dark bg-card-light dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="{{ __('Search languages...') }}" />
                        <button class="bg-primary-50 text-text-light dark:text-text-dark px-4 py-2 rounded-md ms-2 hover:bg-primary-50 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                            {{ __('Search') }}
                        </button>
                    </div>
                </div>
            </form>
            <a href="{{ route('languages.create') }}" 
               class="bg-primary-50 text-text-light dark:text-text-dark px-5 py-2 rounded-md hover:bg-primary-50 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                <i class="fa-solid fa-plus"></i> {{ __('Add Language') }}
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Main Content -->
        <div class="flex flex-wrap">
            <div class="w-full">
                <div class="dashboard-right ps-0">
                    <div class="card overflow-x-auto !p-0 !rounded-md">
                        <h2 class="text-2xl font-bold p-4 text-text-light dark:text-text-dark">
                            {{ __('Language Management') }}
                        </h2>
                        <div class="max-w-full">
                            <table class="w-full table-auto">
                                <thead class="table-header">
                                    <tr class="rounded-lg text-left">
                                        <th class="min-w-[220px] px-4 py-4 font-medium">{{ __('Language') }}</th>
                                        <th class="min-w-[120px] px-4 py-4 font-medium">{{ __('Code') }}</th>
                                        <th class="min-w-[120px] px-4 py-4 font-medium">{{ __('Direction') }}</th>
                                        <th class="px-4 py-4 font-medium">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($languagesList->count() > 0)
                                        @foreach($languagesList as $language)
                                            <tr class="hover:bg-gray-100 hover:dark:bg-gray-800 transition duration-200">
                                                <td class="border-b border-[#eee] dark:border-slate-700 px-4 py-3">
                                                    <div class="flex items-center">
                                                        <span class="flag-icon {{ $language->icon }} mr-3 text-lg"></span>
                                                        <span class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                            {{ $language->name }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="border-b border-[#eee] dark:border-slate-700 px-4 py-3">
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                        {{ $language->code }}
                                                    </span>
                                                </td>
                                                <td class="border-b border-[#eee] dark:border-slate-700 px-4 py-3">
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $language->direction == 'rtl' ? 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200' : 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' }}">
                                                        {{ ucfirst($language->direction) }}
                                                    </span>
                                                </td>
                                                <td class="border-b border-[#eee] dark:border-slate-700 px-4 py-3">
                                                    <div class="flex items-center gap-3">
                                                        <a href="{{ route('languages.edit', $language) }}" 
                                                           class="text-blue-500 hover:underline" title="{{ __('Edit') }}">
                                                            <x-svgs.edit class="size-[20px]" />
                                                        </a>
                                                        <a href="{{ route('languages.json.edit', $language->code) }}" 
                                                           class="text-green-500 hover:underline" title="{{ __('Translations') }}">
                                                            <svg class="size-[20px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                                                            </svg>
                                                        </a>
                                                        <form action="{{ route('languages.destroy', $language) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" 
                                                                    class="text-red-500 hover:underline" 
                                                                    title="{{ __('Delete') }}"
                                                                    onclick="return confirm('{{ __('Are you sure you want to delete this language?') }}')">
                                                                <x-svgs.delete class="size-[20px]" />
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center py-8">
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

        <!-- Pagination -->
        @if($languagesList->total() > $languagesList->count())
            <div class="mt-2">
                <div class="d-flex justify-content-center">
                    {{ $languagesList->links() }}
                </div>
            </div>
        @endif
    </div>
</x-app-layout> 