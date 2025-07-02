@props(['items' => []])

<nav class="flex mb-6" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <!-- Home Icon -->
        <li class="inline-flex items-center">
            <a href="{{ route('dashboard') ?? '/' }}" 
               class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-9 9a1 1 0 101.414 1.414L9 5.414V17a1 1 0 102 0V5.414l7.293 7.293a1 1 0 001.414-1.414l-9-9z"></path>
                </svg>
                {{ __('Dashboard') }}
            </a>
        </li>

        @foreach($items as $index => $item)
            <li>
                <div class="flex items-center">
                    <!-- Separator -->
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    
                    @if($loop->last)
                        <!-- Current/Last Item -->
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400 flex items-center">
                            @if(isset($item['icon']) && $item['icon'])
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            @endif
                            {{ $item['label'] }}
                        </span>
                    @else
                        <!-- Clickable Item -->
                        <a href="{{ $item['url'] ?? '#' }}" 
                           class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white transition-colors duration-200 flex items-center">
                            @if(isset($item['icon']) && $item['icon'])
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            @endif
                            {{ $item['label'] }}
                        </a>
                    @endif
                </div>
            </li>
        @endforeach
    </ol>
</nav> 