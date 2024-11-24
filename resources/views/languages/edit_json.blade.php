@section('title', __('Create Language'))

<x-app-layout>

    <div class="flex flex-col">
        <div class="w-full">
            <div class="bg-white shadow-md rounded-lg">
                <div class="px-6 py-4 border-b">
                    <h3 class="text-lg font-semibold">
                        {{ $language->name }} - {{ __('translate_language') }}
                    </h3>
                    <a href="{{ route('languages.index') }}"
                        class="btn bg-primary-500 text-white float-right flex items-center justify-center px-4 py-2 rounded">
                        <i class="fas fa-arrow-left"></i>
                        {{ __('back') }}
                    </a>
                </div>
                <div class="p-6">
                    <!-- filter -->
                    <form id="formSubmit" action="" method="GET" onchange="this.submit();">
                        <div class="flex flex-wrap mb-4">
                            <div class="w-full md:w-1/3 mb-4 md:mb-0">
                                <label class="block text-sm font-medium text-gray-700">{{ __('search') }}</label>
                                <input name="keyword" type="text" placeholder="{{ __('title') }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-200"
                                    value="{{ request('keyword') }}">
                            </div>
                            <div class="w-full md:w-1/4">
                                <label class="block">&nbsp;</label>
                                <button type="submit"
                                    class="mt-2 w-full bg-primary-500 text-white rounded-md px-4 py-2">
                                    {{ __('search') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="p-6">
                    <form action="{{ route('languages.transUpdate') }}" method="POST">
                        @csrf
                        <input type="hidden" name="lang_id" value="{{ $language->id }}">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            #</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                            width="48%">{{ __('english_text') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                            width="48%">{{ __('translation_text') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @php
                                        $lastPageTotalData =
                                            request()->input('page') == null || request()->input('page') == 1
                                                ? 0
                                                : request()->input('page') * 100;
                                    @endphp
                                    @foreach ($translations as $key => $value)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $lastPageTotalData + $loop->iteration }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ ucwords(str_replace('_', ' ', $key)) }}</td> <!-- Updated line -->
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">

                                                    <input type="text"
                                                        class="form-control w-full border-gray-300 rounded-md shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-200"
                                                        name="{{ $key }}" value="{{ $value }}">

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="flex justify-end mt-4">
                            {{ $translations->appends(['keyword' => request()->input('keyword')])->links() }}
                        </div>
                        <div class="flex justify-center mt-4">
                            <button type="submit"
                                class="bg-green-500 text-white rounded-md px-4 py-2 flex items-center">
                                <i class="fas fa-sync"></i>
                                {{ __('update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
