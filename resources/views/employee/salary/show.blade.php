{{-- resources/views/employee/salary/show.blade.php --}}
@section('title')
    {{ 'Salary Report' }}
@endsection

<x-app-layout>
    <div class="relative m-6">
        <!-- Hero Section -->
        <div class="mb-12 bg-gradient-to-r from-primary-500 to-primary-600 dark:from-primary-600 dark:to-primary-700 rounded-2xl shadow-xl p-8 text-white">
            <h1 class="text-3xl font-bold mb-4">Employee Salary Invoice</h1>
            <p class="text-lg opacity-90">Detailed salary information and payment breakdown</p>
        </div>

        <!-- Main Content -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl overflow-hidden">
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Employee Info -->
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-slate-700 dark:to-slate-800 rounded-2xl p-6 transform hover:-translate-y-1 transition duration-200">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="p-4 from-primary-100 to-primary-200 dark:from-primary-900 dark:to-primary-800 rounded-2xl">
                                <i class="fas fa-user-circle text-3xl text-primary-500"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Employee Information</h3>
                                <p class="text-gray-600 dark:text-gray-300">{{ $employee->employee_name }}</p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-envelope text-xl text-primary-500"></i>
                                <p class="text-gray-700 dark:text-gray-300">{{ $employee->user->email }}</p>
                            </div>
                            <div class="flex items-center gap-3">
                                <i class="fas fa-clock text-xl text-primary-500"></i>
                                <p class="text-gray-700 dark:text-gray-300">Total Hours: {{ $employee_total_hours }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Info -->
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-slate-700 dark:to-slate-800 rounded-2xl p-6 transform hover:-translate-y-1 transition duration-200">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="p-4  from-primary-100 to-primary-200 dark:from-primary-900 dark:to-primary-800 rounded-2xl">
                                <i class="fas fa-money-bill-wave text-3xl text-primary-500"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Payment Details</h3>
                                <p class="text-gray-600 dark:text-gray-300">{{ ucfirst($employee->payment_type) }} Payment</p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            @if ($employee->payment_type == 'hourly')
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-dollar-sign text-xl text-primary-500"></i>
                                    <p class="text-gray-700 dark:text-gray-300">Total Salary: {{ $employee_total_salary }}</p>
                                </div>
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-money-bill-wave text-xl text-primary-500"></i>
                                    <p class="text-gray-700 dark:text-gray-300">Billing Rate: {{ $employee->billing_rate }}</p>
                                </div>
                            @else
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-calendar-alt text-xl text-primary-500"></i>
                                    <p class="text-gray-700 dark:text-gray-300">Monthly Salary: {{ $employee->monthly_salary }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Download Button -->
                <div class="mt-8 text-center">
                    <a href="{{ route('salary.download', $employee->id) }}" 
                       class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white rounded-xl shadow-lg hover:shadow-xl transition duration-200 transform hover:-translate-y-0.5">
                        <i class="fas fa-download mr-2"></i>
                        Download PDF Report
                    </a>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</x-app-layout>