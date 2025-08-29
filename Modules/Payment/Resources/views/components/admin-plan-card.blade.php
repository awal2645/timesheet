@props(['plan'])

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
    <div class="p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">{{ $plan->name }}</h3>
            <span class="px-3 py-1 text-sm font-medium text-indigo-600 bg-indigo-100 dark:bg-indigo-900/50 dark:text-indigo-400 rounded-full">
                {{ $plan->duration }} {{ __('Days') }}
            </span>
        </div>
        
        <div class="mb-6">
            <div class="flex items-baseline">
                <span class="text-3xl font-bold text-gray-900 dark:text-gray-100">${{ number_format($plan->price, 2) }}</span>
                <span class="ml-1 text-gray-500 dark:text-gray-400">/{{ __('month') }}</span>
            </div>
        </div>

        <ul class="space-y-3 mb-6">
            @foreach(json_decode($plan->features) as $feature)
                <li class="flex items-center text-gray-600 dark:text-gray-300">
                    <i class="fa-solid fa-check text-green-500 mr-2"></i>
                    {{ $feature }}
                </li>
            @endforeach
        </ul>

        <div class="space-y-3">
            @canany('Plan edit')
                <a href="{{ route('plans.edit', $plan->id) }}" 
                    class="block w-full px-4 py-2 text-sm font-medium text-center text-white bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 rounded-lg transition-colors duration-150">
                    {{ __('Edit') }}
                </a>
            @endcanany

            @canany('Plan delete')
                <form action="{{ route('plans.destroy', $plan->id) }}" method="POST" class="w-full" id="delete-form-{{ $plan->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="button" 
                        onclick="showConfirmation({{ $plan->id }})"
                        class="w-full px-4 py-2 text-sm font-medium text-center text-white bg-red-600 hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 rounded-lg transition-colors duration-150">
                        {{ __('Delete') }}
                    </button>
                </form>
            @endcanany
        </div>
    </div>
</div> 