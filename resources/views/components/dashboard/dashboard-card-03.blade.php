<div class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 backdrop-blur bg-card-light dark:bg-card-dark   text-text-light  
 dark:text-text-dark  /10 shadow-lg rounded-lg border border-black/10 dark:border-white/10">
    <div class="px-5 py-5 pt-5">
        <header class="flex justify-between items-start mb-2">
            <!-- Icon -->
            <img src="{{ asset('images/icon-03.svg') }}" width="32" height="32" alt="Icon 02" />        
        </header>
        @if (auth('web')->user()->role == 'employee')
            <h2 class="text-lg font-semibold text-slate-800 dark:text-slate-300 mb-2">{{ __('Report Decline(s)') }}</h2>
            <div class="flex items-start">
                <div class="text-3xl font-bold text-slate-800 dark:text-slate-300 mr-2">{{ reportCount('decline') }}</div>
            </div>
      
        @endif


        @if (auth('web')->user()->role == 'employer')
        <h2 class="text-lg font-semibold text-slate-800 dark:text-slate-300 mb-2">{{ __('Client(s)') }}</h2>
        <div class="flex items-start">
            <div class="text-3xl font-bold text-slate-800 dark:text-slate-300 mr-2">{{clientCount()}}</div>
        </div>
        @endif

        @if (auth('web')->user()->role != 'employee' &  auth('web')->user()->role != 'employer')

        <h2 class="text-lg font-semibold text-slate-800 dark:text-slate-300 mb-2">{{ __('Earnig(s)') }}</h2>
        <div class="flex items-start">
            <div class="text-3xl font-bold text-slate-800 dark:text-slate-300 mr-2">${{earningCount()}}</div>
        </div>
        @endif
        
    </div>
</div>