{{-- resources/views/contact/index.blade.php --}}
@section('title')
{{ 'List Contacts' }}
@endsection

<x-app-layout>
    <div class="relative m-6">
        <div class="my-8 card flex flex-col md:flex-row gap-4 md:justify-between items-start md:items-center">
            <form action="{{ route('contact.index') }}" method="GET" class="w-full">
                <div class="mb-3">
                    <label for="search" class="block mb-2 text-sm font-medium text-text-light dark:text-text-dark">
                        {{ __('Search') }}
                    </label>
                    <div class="flex flex-wrap">
                        <input type="text" id="search" name="search" value="{{ request('search') }}"
                            class="border border-gray-300 text-text-light dark:text-text-dark text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-card-dark bg-card-light dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="{{ __('Search') }}" />
                        <button
                            class="bg-primary-50 text-text-light dark:text-text-dark px-4 py-2 rounded-md ms-2 hover:bg-primary-50 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                            {{ __('Search') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="flex flex-wrap">
            <div class="w-full">
                <div class="dashboard-right ps-0">
                    <div class="card overflow-x-auto !p-0 !rounded-md">
                        <h2 class="text-2xl font-bold p-4 text-text-light dark:text-text-dark">
                            {{ __('Latest Contacts') }}</h2>

                        <table class="w-full table-auto">
                            <thead class="table-header">
                                <tr class="rounded-none text-left">
                                    <th class="min-w-[150px] px-4 py-4 font-medium">
                                        {{ __('Email') }}
                                    </th>

                                    <th class="min-w-[120px] px-4 py-4 !pe-12 font-medium text-end">
                                        {{ __('Action') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($newsLatters->count() > 0)
                                @foreach ($newsLatters as $newsLatter)
                                <tr class="hover:bg-gray-100 hover:dark:bg-gray-800 transition duration-200">
                                    <td class="border-b border-[#eee] dark:border-slate-700 px-4 py-3">
                                        <div class="text-sm font-semibold">
                                            {{ $newsLatter->email }}
                                        </div>
                                    </td>
                                    <td class="border-b border-[#eee] dark:border-slate-700 px-4 py-3">
                                        <div class="flex space-x-4 justify-end">
                                            <button onclick="showConfirmation({{ $newsLatter->id }})"
                                                class="text-red-500 hover:underline">
                                                <x-svgs.delete class="size-[20px]" />
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="5" class="text-center py-8">
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
    </div>
    @if ($newsLatters->total() > $newsLatters->count())
    <div class="mt-2">
        <div class="d-flex justify-content-center">
            {{ $newsLatters->links() }}
        </div>
    </div>
    @endif
    </div>
    <script>
        function showConfirmation(id) {
            Swal.fire({
                title: 'Want to delete this Newsletter!',
                text: "{{ __('If you are ready?') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "{{ __('Yes') }}",
                cancelButtonText: "{{ __('Cancel') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/newsletter/destroy/" + id;
                }
            });
        }
    </script>
</x-app-layout>