@if ($paginator->hasPages())
<!-- Enhanced Pagination Component -->
<div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 bg-white/50 dark:bg-gray-900/50 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 rounded-xl p-6 shadow-sm">
    <!-- Navigation Controls -->
    <nav class="flex justify-center lg:order-1" role="navigation" aria-label="{!! __('Pagination Navigation') !!}">
        <div class="flex items-center gap-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-400 dark:text-gray-500 cursor-not-allowed">
                    <span class="sr-only">{!! __('pagination.previous') !!}</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" 
                   class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 dark:hover:from-indigo-900/30 dark:hover:to-purple-900/30 hover:border-indigo-300 dark:hover:border-indigo-600 hover:text-indigo-600 dark:hover:text-indigo-400 transition-all duration-200 shadow-sm hover:shadow-md group">
                    <span class="sr-only">{!! __('pagination.previous') !!}</span>
                    <svg class="w-5 h-5 transition-transform duration-200 group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
            @endif

            {{-- Pagination Elements --}}
            <div class="flex items-center gap-1 mx-2">
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span class="inline-flex items-center justify-center w-10 h-10 text-gray-500 dark:text-gray-400 font-medium">
                            {{ $element }}
                        </span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-r from-indigo-500 to-purple-500 border border-indigo-500 text-white font-semibold shadow-lg shadow-indigo-500/25 transform scale-105" aria-current="page">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" 
                                   class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 dark:hover:from-indigo-900/30 dark:hover:to-purple-900/30 hover:border-indigo-300 dark:hover:border-indigo-600 hover:text-indigo-600 dark:hover:text-indigo-400 transition-all duration-200 shadow-sm hover:shadow-md hover:scale-105 font-medium">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" 
                   class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 dark:hover:from-indigo-900/30 dark:hover:to-purple-900/30 hover:border-indigo-300 dark:hover:border-indigo-600 hover:text-indigo-600 dark:hover:text-indigo-400 transition-all duration-200 shadow-sm hover:shadow-md group">
                    <span class="sr-only">{!! __('pagination.next') !!}</span>
                    <svg class="w-5 h-5 transition-transform duration-200 group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            @else
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-400 dark:text-gray-500 cursor-not-allowed">
                    <span class="sr-only">{!! __('pagination.next') !!}</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </span>
            @endif
        </div>
    </nav>

    <!-- Enhanced Results Info -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-center lg:justify-start gap-4">
        <!-- Results Summary -->
        <div class="text-center lg:text-left">
            <div class="text-sm text-gray-600 dark:text-gray-400">
                {!! __('Showing') !!}
                @if ($paginator->firstItem())
                    <span class="font-semibold text-gray-900 dark:text-gray-100">{{ number_format($paginator->firstItem()) }}</span>
                    {!! __('to') !!}
                    <span class="font-semibold text-gray-900 dark:text-gray-100">{{ number_format($paginator->lastItem()) }}</span>
                @else
                    {{ number_format($paginator->count()) }}
                @endif
                {!! __('of') !!}
                <span class="font-semibold text-gray-900 dark:text-gray-100">{{ number_format($paginator->total()) }}</span>
                {!! __('results') !!}
            </div>
        </div>

        <!-- Progress Indicator -->
        <div class="flex items-center gap-3">
            <div class="flex-1 bg-gray-200 dark:bg-gray-700 rounded-full h-2 min-w-24">
                <div class="bg-gradient-to-r from-indigo-500 to-purple-500 h-2 rounded-full transition-all duration-300 shadow-sm" 
                     style="width: {{ ($paginator->currentPage() / $paginator->lastPage()) * 100 }}%">
                </div>
            </div>
            <span class="text-xs font-medium text-gray-500 dark:text-gray-400 whitespace-nowrap">
                {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}
            </span>
        </div>
    </div>

    <!-- Quick Navigation (for pages with many results) -->
    @if ($paginator->lastPage() > 10)
        <div class="flex items-center justify-center lg:justify-end gap-2">
            <span class="text-xs text-gray-500 dark:text-gray-400 font-medium">{{ __('Go to:') }}</span>
            <form method="GET" class="flex items-center gap-2" onsubmit="
                const page = this.page.value;
                if (page && page >= 1 && page <= {{ $paginator->lastPage() }}) {
                    const url = new URL(window.location);
                    url.searchParams.set('page', page);
                    window.location.href = url.toString();
                }
                return false;
            ">
                <input type="number" 
                       name="page" 
                       min="1" 
                       max="{{ $paginator->lastPage() }}" 
                       placeholder="{{ $paginator->currentPage() }}"
                       class="w-16 px-2 py-1 text-sm text-center border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                <button type="submit" 
                        class="px-3 py-1 text-xs font-medium text-white bg-gradient-to-r from-indigo-500 to-purple-500 rounded-lg hover:from-indigo-600 hover:to-purple-600 transition-all duration-200 shadow-sm hover:shadow-md">
                    {{ __('Go') }}
                </button>
            </form>
        </div>
    @endif
</div>

<!-- Enhanced CSS for additional styling -->
<style>
@media (max-width: 640px) {
    .pagination-mobile {
        flex-direction: column;
        gap: 1rem;
    }
}

/* Custom scrollbar for pagination container */
.pagination-container::-webkit-scrollbar {
    height: 4px;
}

.pagination-container::-webkit-scrollbar-track {
    background: transparent;
}

.pagination-container::-webkit-scrollbar-thumb {
    background: rgba(99, 102, 241, 0.3);
    border-radius: 2px;
}

.pagination-container::-webkit-scrollbar-thumb:hover {
    background: rgba(99, 102, 241, 0.5);
}
</style>
@endif