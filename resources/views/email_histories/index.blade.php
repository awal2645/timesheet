@section('title', 'Email Histories')

<x-app-layout>
    <div class="relative overflow-x-auto">
        <div class="m-6">
            <div
                class="p-6 flex flex-col md:flex-row justify-between items-center md:space-y-0 bg-white/10 dark:bg-black/10 rounded-lg border border-black/10 dark:border-white/10">
                <form action="{{ route('emails.index') }}" method="GET">
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
                <a href="{{ route('emails.send.form') }}" class="bg-purple-500 text-white px-4 py-2 rounded-lg"><i
                        class="fa-solid fa-plus"></i> {{ __('Send Email') }}</a>
            </div>

            <div class="bg-white/10 dark:bg-black/10 p-6 rounded-lg border border-black/10 dark:border-white/10 mt-12">
                <h2 class="text-xl font-semibold mb-4">{{ __('Email Histories') }}</h2>
                <div class="overflow-x-auto pb-1">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 border border-gray-300 dark:border-gray-700">
                                    {{ __('Recipient Email') }}
                                </th>
                                <th scope="col" class="px-6 py-3 border border-gray-300 dark:border-gray-700">
                                    {{ __('Subject') }}
                                </th>
                                <th scope="col" class="px-6 py-3 border border-gray-300 dark:border-gray-700">
                                    {{ __('Body') }}
                                </th>
                                <th scope="col" class="px-6 py-3 border border-gray-300 dark:border-gray-700">
                                    {{ __('Sent At') }}
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($emailHistories->count() > 0)
                                @foreach ($emailHistories as $history)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4 border border-gray-300 dark:border-gray-700">
                                            {{ $history->recipient_email }}
                                        </td>
                                        <td class="px-6 py-4 border border-gray-300 dark:border-gray-700">
                                            {{ $history->subject }}
                                        </td>
                                        <td class="px-6 py-4 border border-gray-300 dark:border-gray-700">
                                            {!! empty($history->body) ? $history->body : 'N/A' !!} <!-- Limit body text for display -->
                                        </td>
                                        <td class="px-6 py-4 border border-gray-300 dark:border-gray-700">
                                            {{ $history->created_at->format('Y-m-d H:i') }}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4"
                                        class="text-center py-8 border border-gray-300 dark:border-gray-700">
                                        <img src="{{ asset('images/no-data-found.svg') }}" alt="No data found"
                                            class="mx-auto max-w-xs">
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
    </div>
</x-app-layout> 