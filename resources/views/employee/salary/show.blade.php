@section('title')
    {{ 'TimeSheet Report' }}
@endsection
<x-app-layout>
    <div class="relative m-6">
        <div class="my-8 card shadow-lg rounded-lg overflow-hidden">
            <h1 class="text-center font-bold text-4xl text-gray-800 bg-gray-200 p-6">Employee Salary Invoice</h1>
            <div class="border-t border-gray-300 p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex items-center">
                        <i class="fas fa-user-circle text-primary-50 mr-2"></i>
                        <div>
                            <p class="font-semibold">Employee Name:</p>
                            <p class="text-gray-700">{{ $employee->name }}</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-envelope text-primary-50 mr-2"></i>
                        <div>
                            <p class="font-semibold">Employee Email:</p>
                            <p class="text-gray-700">{{ $employee->email }}</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-clock text-primary-50 mr-2"></i>
                        <div>
                            <p class="font-semibold">Total Hours Worked:</p>
                            <p class="text-gray-700">{{ $employee_total_hours }}</p>
                        </div>
                    </div>
                    @if ($employee->payment_type == 'hourly')   
                    <div class="flex items-center">
                        <i class="fas fa-dollar-sign text-primary-50 mr-2"></i>
                        <div>
                            <p class="font-semibold">Total Salary:</p>
                            <p class="text-gray-700">{{ $employee_total_salary }}</p>
                        </div>
                    </div>
                    @endif
                    <div class="flex items-center">
                        <i class="fas fa-credit-card text-primary-50 mr-2"></i>
                        <div>
                            <p class="font-semibold">Payment Type:</p>
                            <p class="text-gray-700">{{ $employee->payment_type }}</p>
                        </div>
                    </div>
                    @if ($employee->payment_type == 'hourly')
                    <div class="flex items-center">
                        <i class="fas fa-money-bill-wave text-primary-50 mr-2"></i>
                        <div>
                            <p class="font-semibold">Billing Rate:</p>
                            <p class="text-gray-700">{{ $employee->billing_rate }}</p>
                        </div>
                    </div>
                    @endif
                    @if ($employee->payment_type == 'monthly')
                    <div class="flex items-center">
                        <i class="fas fa-calendar-alt text-primary-50 mr-2"></i>
                        <div>
                            <p class="font-semibold">Monthly Salary:</p>
                                <p class="text-gray-700">{{ $employee->monthly_salary }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="text-center p-6">
                <button id="download-pdf" class="bg-primary-50 text-text-light dark:text-text-dark py-3 px-8 rounded-lg shadow-lg hover:bg-primary-600 transition duration-300">Download PDF</button>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script>
        document.getElementById('download-pdf').addEventListener('click', function() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            doc.text("Employee Salary Invoice", 20, 20);
            doc.text("Employee Name: {{ $employee->name }}", 20, 30);
            doc.text("Employee Email: {{ $employee->email }}", 20, 40);
            doc.text("Total Hours Worked: {{ $employee_total_hours }}", 20, 50);
            doc.text("Total Salary: {{ $employee_total_salary }}", 20, 60);
            doc.text("Payment Type: {{ $employee->payment_type }}", 20, 70);
            doc.text("Billing Rate: {{ $employee->billing_rate }}", 20, 80);
            doc.text("Monthly Salary: {{ $employee->monthly_salary }}", 20, 90);
            doc.save("employee_salary_invoice.pdf");
        });
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</x-app-layout>