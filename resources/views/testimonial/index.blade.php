@section('title')
    {{ __('List Testimonials') }}
@endsection
<x-app-layout>
    <div class="relative m-6">
        <div>
            <div class="my-8 card flex flex-col md:flex-row gap-4 md:justify-between items-start md:items-center">
                <form action="{{ route('testimonial.index') }}" method="GET" class="w-full">
                    <div class="mb-3">
                        <label for="search" class="block mb-2 text-sm font-medium text-text-light dark:text-text-dark">
                            {{ __('Search') }}
                        </label>
                        <div class="flex flex-wrap">
                            <input type="text" id="search" name="search" value="{{ request('search') }}"
                                class="border border-gray-300 text-text-light dark:text-text-dark text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-card-dark bg-card-light dark:border-gray-600 dark:placeholder-gray-400 dark:text-text-dark dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="{{ __('Search') }}" />
                            <button
                                class="bg-primary-50 text-text-light dark:text-text-dark px-4 py-2 rounded-lg ms-2 hover:bg-primary-50 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                                {{ __('Search') }}
                            </button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('testimonial.create') }}"
                    class="bg-primary-50 text-text-light dark:text-text-dark px-5 py-2 rounded-lg hover:bg-primary-50 transition duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                    <i class="fa-solid fa-plus"></i> {{ __('Create Testimonial') }}
                </a>
            </div>

            <div class="flex flex-wrap">
                <div class="w-full ">
                    <div class="dashboard-right ps-0 ">
                        <div class="invoices-table ">
                            <h2 class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark ms-1">
                                {{ __('Testimonials List') }}
                            </h2>
                            <div>
                                <div class="card overflow-x-auto !p-0">
                                    <div class="max-w-full">
                                        <table class="w-full table-auto">
                                            <thead class="table-header">
                                                <tr class="rounded-2xl text-left ">
                                                    <th class="min-w-[220px] px-4 py-4 font-medium">
                                                        <div class="flex gap-2 items-center text-base">
                                                            <span>{{ __('Name') }}</span>
                                                        </div>
                                                    </th>
                                                    <th class="min-w-[150px] px-4 py-4 font-medium">
                                                        <div class="flex gap-2 items-center text-base">
                                                            <span>{{ __('Designation') }}</span>
                                                        </div>
                                                    </th>
                                                    <th class="min-w-[120px] px-4 py-4 font-medium">
                                                        <div class="flex gap-2 items-center text-base">
                                                            <span>{{ __('Company') }}</span>
                                                        </div>
                                                    </th>
                                                    <th class="px-4 py-4 font-medium">{{ __('Actions') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($testimonials->count() > 0)
                                                    @foreach ($testimonials as $testimonial)
                                                        <tr
                                                            class="hover:bg-gray-100 hover:dark:bg-gray-800 transition duration-200">
                                                            <td
                                                                class="border-b border-[#eee] dark:border-slate-700 px-4 py-3 dark:border-stroke">
                                                                {{ $testimonial->name }}
                                                            </td>
                                                            <td
                                                                class="border-b border-[#eee] dark:border-slate-700 px-4 py-3 dark:border-stroke">
                                                                {{ $testimonial->designation }}
                                                            </td>
                                                            <td
                                                                class="border-b border-[#eee] dark:border-slate-700 px-4 py-3 dark:border-stroke">
                                                                {{ $testimonial->company }}
                                                            </td>
                                                            <td
                                                                class="border-b border-[#eee] dark:border-slate-700 px-4 py-3 dark:border-stroke">
                                                                <div class="flex items-center gap-3">

                                                                    <a href="{{ route('testimonial.edit', $testimonial->id) }}"
                                                                        class="text-blue-500 hover:underline"><x-svgs.edit
                                                                            class="size-[20px]" /></a>
                                                                    <button
                                                                        onclick="showConfirmation({{ $testimonial->id }})"
                                                                        class="text-red-500 hover:underline"><x-svgs.delete
                                                                            class="size-[20px]" /></button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="4" class="text-center py-8">
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
            </div>
            @if ($testimonials->total() > $testimonials->count())
                <div class="mt-2">
                    <div class="d-flex justify-content-center">
                        {{ $testimonials->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
    <script>
        function showConfirmation(id) {
            Swal.fire({
                title: 'Want to delete this Testimonial!',
                text: "{{ __('If you are ready?') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "{{ __('Yes') }}",
                cancelButtonText: "{{ __('Cancel') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/testimonial/destroy/" + id;
                }
            });
        }
    </script>
</x-app-layout>
