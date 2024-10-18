<div
    class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
    <div class="px-5 py-5 pt-5">
        <header class="flex justify-between items-start mb-2">
            <!-- Icon -->
            <img src="{{ asset('images/icon-02.svg') }}" width="32" height="32" alt="Icon 02" />
        </header>
        @if (auth('web')->user()->role == 'employee')
            <h2 class="text-lg font-semibold text-slate-800 dark:text-slate-100 mb-2">Pending Report(s)</h2>
            <div class="flex items-start">
                <div class="text-3xl font-bold text-slate-800 dark:text-slate-100 mr-2">{{ reportCount('pending') }}</div>
            </div>
        @else
            <h2 class="text-lg font-semibold text-slate-800 dark:text-slate-100 mb-2">Employee(s)</h2>
            <div class="flex items-start">
                <div class="text-3xl font-bold text-slate-800 dark:text-slate-100 mr-2">{{ employeeCount() }}</div>
            </div>
        @endif
    </div>
</div>
