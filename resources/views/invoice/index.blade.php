@section('title')
    {{ __('Invoice List') }}
@endsection
<x-app-layout>
    <div class="relative overflow-x-auto">
        <div class="m-6">
            <div class="mb-12 card flex flex-col md:flex-row justify-between items-center md:space-y-0 ">
                <form action="{{ route('invoice.index') }}" method="GET">
                    <div class="mb-5">
                        <label for="search" class="block mb-2 text-sm font-medium text-text-light dark:text-text-dark">
                            {{ __('Search') }}</label>
                        <div class="flex">
                            <input type="text" id="search" name="search" value="{{ request('search') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="{{ __('Search') }}" />
                            <button
                                class="bg-primary-50 text-text-light dark:text-text-dark px-4 py-2 rounded-lg ml-2">{{ __('Search') }}</button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('invoice.create') }}" class="bg-primary-50 text-text-light dark:text-text-dark px-4 py-2 rounded-lg"><i
                        class="fa-solid fa-plus"></i> {{ __('Create Invoice') }}</a>
            </div>

            <div class="flex flex-wrap">
                <div class="w-full">
                    <div class="dashboard-right pl-0">
                        <div class="invoices-table">
                            <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark ml-1">
                                {{ __('Invoice List') }}</h2>
                            <div class="card">
                                <table class="w-full table-auto">
                                    <thead class="table-header">
                                        <tr class="rounded-2xl text-left">
                                            <th class="min-w-[220px] px-4 py-4 font-medium text-black dark:text-white">
                                                {{ __('Invoice Number') }}</th>
                                            <th class="min-w-[150px] px-4 py-4 font-medium text-black dark:text-white">
                                                {{ __('Client Name') }}</th>
                                            <th class="min-w-[150px] px-4 py-4 font-medium text-black dark:text-white">
                                                {{ __('Project Name') }}</th>
                                            {{-- <th class="min-w-[120px] px-4 py-4 font-medium text-black dark:text-white">{{ __('Total Cost') }}</th> --}}
                                            <th class="px-4 py-4 font-medium text-black dark:text-white">
                                                {{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($invoices->count() > 0)
                                            @foreach ($invoices as $invoice)
                                                <tr class="hover:bg-gray-100 hover:dark:bg-gray-800">
                                                    <td
                                                        class="border-b border-[#eee] dark:border-slate-700 px-4 py-2.5">
                                                        {{ $invoice->invoice_number }}</td>
                                                    <td
                                                        class="border-b border-[#eee] dark:border-slate-700 px-4 py-2.5">
                                                        {{ $invoice->client->client_name }}</td>
                                                    <td
                                                        class="border-b border-[#eee] dark:border-slate-700 px-4 py-2.5">
                                                        {{ $invoice->project->project_name }}</td>
                                                    {{-- <td class="border-b border-[#eee] dark:border-slate-700 px-4 py-2.5">{{ $invoice->total_cost }}</td> --}}
                                                    <td
                                                        class="border-b border-[#eee] dark:border-slate-700 px-4 py-2.5">
                                                        <a href="{{ route('invoice.edit', $invoice->id) }}"
                                                            class="text-primary-500 hover:text-primary-300">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                        <form action="{{ route('invoice.destroy', $invoice->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    class="text-red-500 hover:text-red-300">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                        </form>
                                                        <a href="{{ route('invoice.download', $invoice->id) }}"
                                                            class="text-green-500 hover:text-green-300">
                                                            <i class="fa-solid fa-file-pdf"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" class="text-center py-8  ">
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
                @if ($invoices->total() > $invoices->count())
                    <div class="mt-2">
                        <div class="d-flex justify-content-center">
                            {{ $invoices->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
</x-app-layout>
