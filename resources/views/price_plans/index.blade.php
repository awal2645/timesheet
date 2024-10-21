@section('title')
    {{ 'Price Plan List' }}
@endsection

<x-app-layout>
    <!-- index.blade.php -->

    <div class="container mx-auto px-5 p-4 md:p-8">
        <!-- Set Recommended and Default Package -->
        @canany('Plan create')
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <form action="{{ route('plans.recommended') }}" method="POST">
                    @csrf
                    <div>
                        <label for="recommended_package" class="block mb-2 text-sm font-medium">Set Recommended
                            Package</label>
                        <div class="flex">
                            <select name="plan_id" id="recommended_package"
                                class="bg-gray-50 px-10 dark:bg-gray-700 dark:text-gray-300 text-gray-900 text-sm rounded-lg p-2.5 mr-2">
                                <option value=""> Select Recommended package</option>
                                @foreach ($pricePlans as $plan)
                                    <option {{ $plan->recommended ? 'selected' : '' }} value="{{ $plan->id }}">
                                        {{ $plan->label }}
                                    </option>
                                @endforeach
                            </select>
                            <button class="bg-teal-500 text-white px-4 py-2 rounded-lg ml-2">Update</button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('plans.create') }}" class="bg-teal-500 text-white px-4 py-2 rounded-lg"><i
                        class="fa-solid fa-plus"></i> Create Plan</a>
            </div>
        @endcanany

        <!-- Price Plan Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-5">
            @if ($pricePlans->isEmpty())
                <div class="text-center">
                    <!-- Centering the image -->
                    <img src="{{ asset('images/no-data-found.svg') }}" alt="No data found" class="mx-auto max-w-xs">
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
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>

</x-app-layout>
