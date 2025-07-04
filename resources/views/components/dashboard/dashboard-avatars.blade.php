<!-- Enhanced Dashboard Avatars Component -->
<div class="flex flex-wrap justify-center sm:justify-start gap-3 mb-8 sm:mb-0">
    <!-- Team Member Avatars -->
    <div class="flex -space-x-3">
        <div class="group relative">
            <a href="#0" class="block relative">
                <img class="w-10 h-10 rounded-full border-2 border-white dark:border-gray-800 shadow-lg transition-all duration-300 group-hover:scale-110 group-hover:z-10 group-hover:shadow-xl" 
                     src="{{ asset('images/user-36-01.jpg') }}" 
                     width="40" 
                     height="40"
                     alt="Sarah Johnson - Team Lead" />
                <!-- Online Status -->
                <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-green-500 border-2 border-white dark:border-gray-800 rounded-full"></div>
            </a>
            <!-- Tooltip -->
            <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-3 py-1.5 bg-gray-900 dark:bg-gray-100 text-white dark:text-gray-900 text-xs font-medium rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none whitespace-nowrap z-20">
                Sarah Johnson
                <div class="absolute top-full left-1/2 transform -translate-x-1/2 w-0 h-0 border-l-4 border-r-4 border-t-4 border-transparent border-t-gray-900 dark:border-t-gray-100"></div>
            </div>
        </div>

        <div class="group relative">
            <a href="#0" class="block relative">
                <img class="w-10 h-10 rounded-full border-2 border-white dark:border-gray-800 shadow-lg transition-all duration-300 group-hover:scale-110 group-hover:z-10 group-hover:shadow-xl" 
                     src="{{ asset('images/user-36-02.jpg') }}" 
                     width="40" 
                     height="40"
                     alt="Michael Chen - Developer" />
                <!-- Online Status -->
                <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-green-500 border-2 border-white dark:border-gray-800 rounded-full"></div>
            </a>
            <!-- Tooltip -->
            <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-3 py-1.5 bg-gray-900 dark:bg-gray-100 text-white dark:text-gray-900 text-xs font-medium rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none whitespace-nowrap z-20">
                Michael Chen
                <div class="absolute top-full left-1/2 transform -translate-x-1/2 w-0 h-0 border-l-4 border-r-4 border-t-4 border-transparent border-t-gray-900 dark:border-t-gray-100"></div>
            </div>
        </div>

        <div class="group relative">
            <a href="#0" class="block relative">
                <img class="w-10 h-10 rounded-full border-2 border-white dark:border-gray-800 shadow-lg transition-all duration-300 group-hover:scale-110 group-hover:z-10 group-hover:shadow-xl" 
                     src="{{ asset('images/user-36-03.jpg') }}" 
                     width="40" 
                     height="40"
                     alt="Emma Rodriguez - Designer" />
                <!-- Away Status -->
                <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-yellow-500 border-2 border-white dark:border-gray-800 rounded-full"></div>
            </a>
            <!-- Tooltip -->
            <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-3 py-1.5 bg-gray-900 dark:bg-gray-100 text-white dark:text-gray-900 text-xs font-medium rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none whitespace-nowrap z-20">
                Emma Rodriguez
                <div class="absolute top-full left-1/2 transform -translate-x-1/2 w-0 h-0 border-l-4 border-r-4 border-t-4 border-transparent border-t-gray-900 dark:border-t-gray-100"></div>
            </div>
        </div>

        <div class="group relative">
            <a href="#0" class="block relative">
                <img class="w-10 h-10 rounded-full border-2 border-white dark:border-gray-800 shadow-lg transition-all duration-300 group-hover:scale-110 group-hover:z-10 group-hover:shadow-xl" 
                     src="{{ asset('images/user-36-04.jpg') }}" 
                     width="40" 
                     height="40"
                     alt="David Park - Project Manager" />
                <!-- Offline Status -->
                <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-gray-400 border-2 border-white dark:border-gray-800 rounded-full"></div>
            </a>
            <!-- Tooltip -->
            <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-3 py-1.5 bg-gray-900 dark:bg-gray-100 text-white dark:text-gray-900 text-xs font-medium rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none whitespace-nowrap z-20">
                David Park
                <div class="absolute top-full left-1/2 transform -translate-x-1/2 w-0 h-0 border-l-4 border-r-4 border-t-4 border-transparent border-t-gray-900 dark:border-t-gray-100"></div>
            </div>
        </div>
    </div>

    <!-- Add Team Member Button -->
    <div class="group relative ml-2">
        <button class="flex justify-center items-center w-10 h-10 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 border-2 border-white dark:border-gray-800 text-white shadow-lg transition-all duration-300 hover:scale-110 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/50">
            <span class="sr-only">{{ __('Add new team member') }}</span>
            <svg class="w-5 h-5 transition-transform duration-200 group-hover:rotate-90" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
            </svg>
        </button>
        
        <!-- Tooltip -->
        <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-3 py-1.5 bg-gray-900 dark:bg-gray-100 text-white dark:text-gray-900 text-xs font-medium rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none whitespace-nowrap z-20">
            {{ __('Add team member') }}
            <div class="absolute top-full left-1/2 transform -translate-x-1/2 w-0 h-0 border-l-4 border-r-4 border-t-4 border-transparent border-t-gray-900 dark:border-t-gray-100"></div>
        </div>
    </div>

    <!-- Team Info -->
    <div class="flex items-center ml-4 text-sm text-gray-600 dark:text-gray-400">
        <div class="flex items-center gap-1">
            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
            <span class="font-medium">3 {{ __('online') }}</span>
        </div>
        <div class="mx-2 w-px h-4 bg-gray-300 dark:bg-gray-600"></div>
        <div class="flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <span>4 {{ __('total members') }}</span>
        </div>
    </div>
</div>
