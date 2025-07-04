<!-- Enhanced Theme Toggle Component -->
<div class="relative" x-data="{ isDark: document.documentElement.classList.contains('dark') }" x-init="
    $watch('isDark', value => {
        if (value) {
            document.documentElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        }
    })
">
    <input type="checkbox" 
           name="light-switch" 
           id="light-switch" 
           class="light-switch sr-only" 
           x-model="isDark" />
    
    <!-- Enhanced Toggle Button -->
    <label class="group relative flex items-center justify-center cursor-pointer w-10 h-10 bg-white/10 dark:bg-gray-800/50 backdrop-blur-sm border border-white/20 dark:border-gray-700/50 rounded-xl text-gray-700 dark:text-gray-300 hover:bg-white/20 dark:hover:bg-gray-700/50 transition-all duration-300 focus-within:ring-2 focus-within:ring-indigo-500/30 focus-within:bg-white/20 dark:focus-within:bg-gray-700/50" 
           for="light-switch"
           :class="{ 'bg-white/20 dark:bg-gray-700/50': isDark }">
        
        <!-- Sun Icon (Light Mode) -->
        <div class="absolute inset-0 flex items-center justify-center transition-all duration-300 transform"
             :class="isDark ? 'opacity-0 scale-75 rotate-180' : 'opacity-100 scale-100 rotate-0'">
            <svg class="w-5 h-5 text-amber-500 drop-shadow-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <circle cx="12" cy="12" r="5" stroke-width="2"/>
                <path d="M12 1v2m0 18v2M4.22 4.22l1.42 1.42m12.72 12.72l1.42 1.42M1 12h2m18 0h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42" stroke-width="2"/>
            </svg>
        </div>
        
        <!-- Moon Icon (Dark Mode) -->
        <div class="absolute inset-0 flex items-center justify-center transition-all duration-300 transform"
             :class="isDark ? 'opacity-100 scale-100 rotate-0' : 'opacity-0 scale-75 -rotate-180'">
            <svg class="w-5 h-5 text-indigo-400 drop-shadow-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" stroke-width="2"/>
                <!-- Stars -->
                <circle cx="16" cy="6" r="1" fill="currentColor"/>
                <circle cx="18" cy="4" r="0.5" fill="currentColor"/>
            </svg>
        </div>
        
        <!-- Hover Effect Ring -->
        <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-amber-400/20 to-orange-400/20 dark:from-indigo-400/20 dark:to-purple-400/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        
        <!-- Screen Reader Text -->
        <span class="sr-only" x-text="isDark ? '{{ __('Switch to light mode') }}' : '{{ __('Switch to dark mode') }}'"></span>
    </label>
    
    <!-- Optional Tooltip -->
    <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-3 py-1.5 bg-gray-900 dark:bg-gray-100 text-white dark:text-gray-900 text-xs font-medium rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none whitespace-nowrap z-50"
         x-text="isDark ? '{{ __('Switch to light mode') }}' : '{{ __('Switch to dark mode') }}'">
    </div>
</div>

<!-- Enhanced JavaScript for Theme Management -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize theme from localStorage or system preference
    const initTheme = () => {
        const savedTheme = localStorage.getItem('theme');
        const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        
        if (savedTheme === 'dark' || (!savedTheme && systemPrefersDark)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    };
    
    // Listen for system theme changes
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
        if (!localStorage.getItem('theme')) {
            if (e.matches) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }
    });
    
    initTheme();
});
</script>