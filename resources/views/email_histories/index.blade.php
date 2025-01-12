@section('title', 'Email Histories')

<x-app-layout>
    <div class="m-6">
        <div class="card flex md:flex-row flex-col justify-between items-start md:items-center">
            <form action="{{ route('emails.index') }}" method="GET" class="w-full">
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
            <a href="{{ route('emails.send.form') }}"
                class="bg-primary-50 text-text-light dark:text-text-dark px-5 py-2 rounded-lg hover:bg-primary-50 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                <i class="fa-solid fa-plus"></i> {{ __('Send Email') }}
            </a>
        </div>

        <div class="card overflow-x-auto mt-12">
            <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark ms-1">{{ __('Email Histories') }}
            </h2>
            <div>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="table-header">
                        <tr>
                            <th class="min-w-[150px] px-4 py-4 font-medium">
                                {{ __('Recipient Email') }}
                            </th>
                            <th class="min-w-[150px] px-4 py-4 font-medium">
                                {{ __('Subject') }}
                            </th>
                            <th class="min-w-[150px] px-4 py-4 font-medium">
                                {{ __('Body') }}
                            </th>
                            <th class="min-w-[150px] px-4 py-4 font-medium">
                                {{ __('Sent At') }}
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @if ($emailHistories->count() > 0)
                            @foreach ($emailHistories as $history)
                                <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4  ">
                                        {{ $history->recipient_email }}
                                    </td>
                                    <td class="px-6 py-4  ">
                                        {{ $history->subject }}
                                    </td>
                                    <td class="px-6 py-4  ">
                                        {!! empty($history->body) ? 'N/A' : $history->body !!} <!-- Limit body text for display -->
                                    </td>
                                    <td class="px-6 py-4  ">
                                        {{ $history->created_at->format('Y-m-d H:i') }}
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

            @if ($emailHistories->total() > $emailHistories->count())
                <div class="mt-2">
                    <div class="d-flex justify-content-center">
                        {{ $emailHistories->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
