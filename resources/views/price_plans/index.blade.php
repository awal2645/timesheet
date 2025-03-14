@section('title')
    {{ 'Price Plan List' }}
@endsection

<x-app-layout>
    <!-- index.blade.php -->

    <div class="m-6">
        <!-- Set Recommended and Default Package -->
        @canany('Plan create')
            <div class="my-8 card flex flex-col md:flex-row gap-4 justify-between items-start md:items-center md:space-y-0 ">
                <form action="{{ route('plans.recommended') }}" method="POST">
                    @csrf
                    <div>
                        <label for="recommended_package"
                            class="block mb-2 text-sm font-medium text-text-light dark:text-text-dark">{{ __('Set Recommended Package') }}</label>
                        <div class="flex flex-wrap">
                            <select name="plan_id" id="recommended_package"
                                class="bg-gray-50 dark:bg-card-dark dark:text-text-dark text-text-light text-sm rounded-lg p-2.5 me-2">
                                <option value=""> Select Recommended package</option>
                                @foreach ($pricePlans as $plan)
                                    <option {{ $plan->recommended ? 'selected' : '' }} value="{{ $plan->id }}">
                                        {{ $plan->label }}
                                    </option>
                                @endforeach
                            </select>
                            <button
                                class="bg-primary-50 text-text-light dark:text-text-dark px-4 py-2 rounded-md ms-2">{{ __('Update') }}</button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('plans.create') }}"
                    class="bg-primary-50 text-text-light dark:text-text-dark px-4 py-2 rounded-md"><i
                        class="fa-solid fa-plus"></i> {{ __('Create Plan') }}</a>
            </div>
        @endcanany

        <!-- Price Plan Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-5">
            @if ($pricePlans->isEmpty())
                <div class="text-center">
                    <!-- Centering the image -->
                    <x-svgs.no-data-found class="mx-auto md:size-[360px] size-[220px]" />
                </div>
            @else
                @foreach ($pricePlans as $plan)
                    @if (auth('web')->user()->role == 'employer')
                        @if ($user_plan && $user_plan->free_plan == true)
                            @if ($plan->label != 'Free Plan')
                                <x-employer-plan-card :plan="$plan" />
                            @endif
                        @else
                            <x-employer-plan-card :plan="$plan" />
                        @endif
                    @else
                        <x-admin-plan-card :plan="$plan" />
                    @endif
                @endforeach
            @endif
        </div>
    </div>

    <script>
        function showConfirmation(id) {
            Swal.fire({
                title: 'Want to delete this Plan!',
                text: "{{ __('If you are ready?') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "{{ __('Yes') }}",
                cancelButtonText: "{{ __('Cancel') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>

</x-app-layout>
