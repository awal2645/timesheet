<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Salary Invoice</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --secondary: #64748b;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --border: #e2e8f0;
            --background: #ffffff;
            --background-alt: #f8fafc;
            --shadow: rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.4;
            color: var(--text-dark);
            background: var(--background);
            -webkit-font-smoothing: antialiased;
        }

        .invoice {
            max-width: 800px;
            margin: 0 auto;
            padding: 1.5rem;
            background: var(--background);
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--primary);
        }

        .invoice-title-section { flex: 1; }

        .invoice-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.25rem;
        }

        .invoice-number {
            color: var(--text-light);
            font-size: 0.875rem;
        }

        .company-details {
            text-align: right;
        }

        .company-name {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 0.25rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .info-block {
            background: var(--background-alt);
            padding: 1rem;
            border-radius: 0.5rem;
            border: 1px solid var(--border);
            box-shadow: 0 1px 2px var(--shadow);
        }

        .info-block-title {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-light);
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .info-block-content {
            font-size: 0.95rem;
        }

        .details-table {
            width: 100%;
            margin: 0.75rem 0;
            border-collapse: collapse;
            background: var(--background);
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 1px 2px var(--shadow);
        }

        .details-table th {
            background: var(--primary);
            color: var(--background);
            padding: 0.75rem;
            text-align: left;
            font-weight: 500;
            font-size: 0.875rem;
        }

        .details-table th:last-child {
            text-align: right;
        }

        .details-table td {
            padding: 0.75rem;
            border-bottom: 1px solid var(--border);
            font-size: 0.875rem;
        }

        .details-table tr:last-child td {
            border-bottom: none;
        }

        .details-table td:last-child {
            text-align: right;
        }

        .total-section {
            margin-top: 1rem;
            padding: 1rem;
            background: var(--background-alt);
            border-radius: 0.5rem;
            border: 1px solid var(--border);
        }

        .total-row {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 0.75rem;
        }

        .total-label {
            font-size: 0.95rem;
            color: var(--text-light);
            font-weight: 500;
        }

        .total-amount {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary);
        }

        .invoice-footer {
            margin-top: 1rem;
            padding-top: 0.75rem;
            border-top: 1px solid var(--border);
            text-align: center;
            color: var(--text-light);
            font-size: 0.75rem;
        }

        .text-right { text-align: right; }
        .font-semibold { font-weight: 600; }
        .text-sm { font-size: 0.875rem; }
        .text-primary { color: var(--primary); }
        .text-light { color: var(--text-light); }
        .capitalize { text-transform: capitalize; }
    </style>
</head>
<body>
    <div class="invoice">
        <div class="invoice-header">
            <div class="invoice-title-section">
                <div class="invoice-title">Salary Invoice</div>
                <div class="invoice-number">INV-{{ str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT) }}</div>
            </div>
            <div class="company-details">
                <div class="company-name">{{ $employee->employer->employer_name }}</div>
                <div class="text-sm text-light">Date: {{ date('F d, Y') }}</div>
            </div>
        </div>

        <div class="info-grid">
            <div class="info-block">
                <div class="info-block-title">Employee Information</div>
                <div class="info-block-content">
                    <div class="font-semibold">{{ $employee->employee_name }}</div>
                    <div class="text-sm text-light">{{ $employee->user->email }}</div>
                </div>
            </div>
            <div class="info-block">
                <div class="info-block-title">Payment Details</div>
                <div class="info-block-content">
                    <div class="font-semibold capitalize">{{ $employee->payment_type }} Rate</div>
                    <div class="text-sm text-light">
                        @if ($employee->payment_type == 'hourly')
                            {{ $employee->billing_rate }} per hour
                        @else
                            {{ $employee->monthly_salary }} per month
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <table class="details-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @if ($employee->payment_type == 'hourly')
                    <tr>
                        <td>Hours Worked</td>
                        <td>{{ $employee_total_hours }} hours</td>
                    </tr>
                    <tr>
                        <td>Hourly Rate</td>
                        <td>{{ $employee->billing_rate }}</td>
                    </tr>
                @else
                    <tr>
                        <td>Monthly Salary</td>
                        <td>{{ $employee->monthly_salary }}</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <div class="total-section">
            <div class="total-row">
                <div class="total-label">Total Amount</div>
                <div class="total-amount">{{ $employee_total_salary }}</div>
            </div>
        </div>
    </div>
</body>
</html>