
@section('title')
    {{ __('Price Plans') }}
@endsection

<x-app-layout>
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ __('Price Plans') }}</h1>
        
        @canany('Plan create')
            <a href="{{ route('plans.create') }}" 
                class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 rounded-lg transition-colors duration-150">
                {{ __('Create New Plan') }}
            </a>
        @endcanany
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($plans as $plan)
            @if(auth()->user()->role === 'admin')
                <x-payment::components.admin-plan-card :plan="$plan" />
            @else
                <x-payment::components.employer-plan-card :plan="$plan" />
            @endif
        @endforeach
    </div>
</div>

@push('scripts')
<script>
    function showConfirmation(planId) {
        if (confirm('{{ __("Are you sure you want to delete this plan?") }}')) {
            document.getElementById('delete-form-' + planId).submit();
        }
    }
</script>
@endpush
</x-app-layout>