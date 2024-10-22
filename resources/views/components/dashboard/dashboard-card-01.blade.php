<div
    class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 backdrop-blur bg-white/10 dark:bg-slate-800/10 shadow-lg rounded-lg border border-black/10 dark:border-white/10">
    <div class="px-5 py-5 pt-5">
        <header class="flex justify-between items-start mb-2">
            <!-- Icon -->
            <img src="{{ asset('images/icon-01.svg') }}" width="32" height="32" alt="Icon 01" />
        </header>
        @if (auth('web')->user()->role != 'employer' && auth('web')->user()->role != 'employee' )

            <h2 class="text-lg font-semibold text-slate-800 dark:text-slate-100 mb-2"> {{ __('Employer(s)') }}</h2>
            <div class="flex items-start">
                <div class="text-3xl font-bold text-slate-800 dark:text-slate-300 mr-2">{{ employerCount() }}</div>
            </div>
        @else
            <h2 class="text-lg font-semibold text-slate-900 dark:text-slate-300 mb-2">
                Report(s)</h2>
            <div class="flex items-start">
                <div class="text-3xl font-bold text-slate-900 dark:text-slate-300 mr-2">{{ reportCount() }}</div>
            </div>
        @endif

    </div>
</div>
