{{-- resources/views/employee/salary/show.blade.php --}}
@section('title')
    {{ 'TimeSheet Report' }}
@endsection
<x-app-layout>
    <div class="relative m-6">
        <div class="my-8 card shadow-lg rounded-lg overflow-hidden">
            <h1 class="text-center font-bold text-4xl text-text-light dark:text-text-dark bg-card-light dark:bg-card-dark rounded-xl p-6">Employee Salary Invoice</h1>
            <div class="border-t border-gray-300 dark:border-gray-700 p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-text-light dark:text-text-dark  bg-card-light dark:bg-card-dark [&_.flex]:p-6 ">
                    <div class="card bg-card-light dark:bg-card-dark flex items-center gap-3">
                        <i class="fas fa-user-circle text-2xl text-primary-50 p-4 rounded bg-card-light dark:bg-card-dark"></i>
                        <div>
                            <p class="font-semibold">Employee Name: {{ $employee->employee_name }}</p>
                        </div>
                    </div>
                    <div class="card flex items-center gap-3">
                        <i class="fas fa-envelope text-2xl text-primary-50 p-4 rounded  "></i>
                        <div>
                            <p class="font-semibold">Employee Email: {{ $employee->user->email }}</p>
                        </div>
                    </div>
                    <div class="card flex items-center gap-3">
                        <i class="fas fa-clock text-2xl text-primary-50 p-4 rounded"></i>
                        <div>
                            <p class="font-semibold">Total Hours Worked: {{ $employee_total_hours }}</p>
                        </div>
                    </div>
                    @if ($employee->payment_type == 'hourly')   
                    <div class="card flex items-center gap-3">
                        <i class="fas fa-dollar-sign text-2xl text-primary-50 p-4 rounded "></i>
                        <div>
                            <p class="font-semibold">Total Salary: {{ $employee_total_salary }}</p>
                        </div>
                    </div>
                    @endif
                    <div class="card flex items-center gap-3">
                        <i class="fas fa-credit-card text-2xl text-primary-50 p-4 rounded"></i>
                        <div>
                            <p class="font-semibold">Payment Type: {{ $employee->payment_type }}</p>
                        </div>
                    </div>
                    @if ($employee->payment_type == 'hourly')
                    <div class="card flex items-center gap-3">
                        <i class="fas fa-money-bill-wave text-2xl text-primary-50 p-4 rounded  "></i>
                        <div>
                            <p class="font-semibold">Billing Rate: {{ $employee->billing_rate }}</p>
                        </div>
                    </div>
                    @endif
                    @if ($employee->payment_type == 'monthly')
                    <div class="card flex items-center gap-3">
                        <i class="fas fa-calendar-alt text-2xl text-primary-50 p-4 rounded"></i>
                        <div>
                            <p class="font-semibold">Monthly Salary: {{ $employee->monthly_salary }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="text-center p-6">
                <a href="{{ route('salary.download', $employee->id) }}" class="bg-primary-50 text-text-light dark:text-text-dark py-3 px-8 rounded-lg shadow-lg hover:bg-primary-600 transition duration-300">Download PDF</a>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</x-app-layout>