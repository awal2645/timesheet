@props(['plan'])

<div class="card flex flex-col justify-between">
    <div class="grow">
        <h2 class="text-lg font-bold text-gray-800 dark:text-gray-100">{{ $plan->label }}  @if ($plan->recommended)
        
                <span
                    class="bg-primary-50 text-text-light dark:bg-primary-50 dark:text-text-dark p-3 rounded text-xs">{{ __('Recommended') }}</span>
        @endif</h2>

       

        <div class="text-3xl font-bold my-4 text-gray-800 dark:text-gray-100">
            ${{ number_format($plan->price, 2) }} <!-- Formats price to two decimal places -->
        </div>

        <p class="text-sm text-gray-500 dark:text-gray-400">
            {{ $plan->description }}
        </p>

        <hr class="my-4">

        <ul class="my-4 space-y-2 text-center">
            <li class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m2 0a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <span
                    class="text-gray-800 dark:text-gray-100">{{ __('Employee Limit: :limit', ['limit' => $plan->employee_limit]) }}</span>
            </li>
            <li class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m2 0a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <span
                    class="text-gray-800 dark:text-gray-100">{{ __('Client Limit: :limit', ['limit' => $plan->client_limit]) }}</span>
            </li>
            <li class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m2 0a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <span
                    class="text-gray-800 dark:text-gray-100">{{ __('Project Limit: :limit', ['limit' => $plan->project_limit]) }}</span>
            </li>
            @if ($plan->frontend_show)
                <li class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14"></path>
                    </svg>
                    <span
                        class="text-gray-800 dark:text-gray-100">{{ __('This package is shown on the frontend') }}</span>
                </li>
            @endif
        </ul>
    </div>

    <div class="flex justify-between items-center">
        <a href="{{ route('plans.edit', $plan->id) }}"
            class="text-white bg-primary-50 hover:bg-primary-50 rounded-lg px-4 py-2">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
        <form id="delete-form-{{ $plan->id }}" action="{{ route('plans.destroy', $plan->id) }}" method="POST"
            style="display: none;">
            @csrf
            @method('DELETE')
        </form>

        <a href="javascript:void(0);" onclick="showConfirmation({{ $plan->id }})"
            class="text-white bg-red-500 hover:bg-red-600 rounded-lg px-4 py-2">
            <i class="fa-solid fa-trash"></i>
        </a>
    </div>
</div>
