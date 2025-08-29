<div class="mb-8 p-6 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm {{ $class }}">
    <!-- Section Header -->
    <div class="mb-6 border-b border-gray-200 dark:border-gray-700 pb-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            {{ $title }}
        </h3>
        @if($description)
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ $description }}
            </p>
        @endif
    </div>

    <!-- Section Content -->
    <div class="space-y-6">
        {{ $slot }}
    </div>
</div>