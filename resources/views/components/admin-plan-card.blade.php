@props(['plan'])

<div class="bg-white/10 dark:bg-black/10 backdrop-blur border border-black/10 dark:border-white/10 rounded-lg shadow-md p-6 text-center flex flex-col justify-between h-full">
    <h2 class="text-lg font-bold text-gray-800 dark:text-gray-100">{{ $plan->label }}</h2>

    @if ($plan->recommended)
        <div class="mt-2">
            <span
                class="bg-green-200 text-green-700 dark:bg-green-700 dark:text-green-200 p-3 rounded-full text-xs">{{ __('Recommended') }}</span>
        </div>
    @endif

    <div class="text-3xl font-bold my-4 text-gray-800 dark:text-gray-100">
        ${{ number_format($plan->price, 2) }} <!-- Formats price to two decimal places -->
    </div>

    <p class="text-sm text-gray-500 dark:text-gray-400">
        {{ $plan->description }}
    </p>

    <hr class="my-4">

    <ul class="my-4 space-y-2 text-center">
        <li class="flex items-center space-x-2">
            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m2 0a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <span
                class="text-gray-800 dark:text-gray-100">{{ __('Employee Limit: :limit', ['limit' => $plan->employee_limit]) }}</span>
        </li>
        <li class="flex items-center space-x-2">
            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m2 0a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <span
                class="text-gray-800 dark:text-gray-100">{{ __('Client Limit: :limit', ['limit' => $plan->client_limit]) }}</span>
        </li>
        <li class="flex items-center space-x-2">
            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m2 0a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <span
                class="text-gray-800 dark:text-gray-100">{{ __('Project Limit: :limit', ['limit' => $plan->project_limit]) }}</span>
        </li>
        @if ($plan->frontend_show)
            <li class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14"></path>
                </svg>
                <span class="text-gray-800 dark:text-gray-100">{{ __('This package is shown on the frontend') }}</span>
            </li>
        @endif
    </ul>

    <div class="flex justify-between items-center">
        <a href="{{ route('plans.edit', $plan->id) }}"
            class="text-white bg-purple-500 hover:bg-purple-600 rounded-lg px-4 py-2">
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
