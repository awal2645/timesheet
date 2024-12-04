<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $invoice->number }}</title>
    @if (!$isPdf)
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @endif
    <style>
        @page {
            margin: 0;
            padding: 0;
        }

        :root {
            --primary-color: #6b21a8;
            --secondary-color: #7c3aed;
        }

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: white;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Web preview only styles */
        @media screen {
            body {
                background: #f0f0f0;
                padding: 0;
            }

            .preview-only {
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 1000;
                display: flex;
                gap: 10px;
                background: white;
                padding: 10px;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }

            .btn {
                display: flex;
                align-items: center;
                gap: 8px;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-weight: 500;
                text-decoration: none;
                color: white;
                background: var(--primary-color);
            }

            .invoice-page {
                margin: 20px auto;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
        }

        /* Common styles */
        .invoice-page {
            background: white;
            position: relative;
            box-sizing: border-box;
            padding: 0;
            width: 100%;
            max-width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
        }

        /* Header styles */
        .header-section {
            width: 100%;
            margin-bottom: 30px;
        }

        .company-logo {
            float: left;
            width: 60%;
        }

        .company-logo span {
            font-size: 24px;
            font-weight: bold;
        }

        .invoice-title {
            float: right;
            width: 30%;
            background-color: var(--primary-color) !important;
            color: white;
            padding: 4px 30px;
        }

        /* Table styles */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .items-table th,
        .items-table td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .items-table th {
            background-color: var(--primary-color) !important;
            color: white;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        .items-table th:first-child {
            background: #000 !important;
        }

        .items-table th.price,
        .items-table th.qty,
        .items-table th.total {
            background: var(--secondary-color) !important;
        }

        .items-table td {
            padding: 8px;
            border: 1px solid #ddd;
            word-wrap: break-word;
        }

        /* Totals section */
        .totals-section {
            float: right;
            width: 300px;
            margin-top: 20px;
            clear: both;
        }

        .totals-table {
            width: 100%;
        }

        .totals-table td {
            padding: 8px;
        }

        .sub-total td,
        .tax td {
            background: var(--secondary-color) !important;
            color: white;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        .grand-total td {
            background: var(--primary-color) !important;
            color: white;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        /* Payment info */
        .payment-info {
            clear: both;
            margin-top: 40px;
            color: var(--primary-color);
        }

        .payment-info strong {
            color: #000;
        }

        /* Terms and footer */
        .terms-section {
            margin-top: 20px;
            border-top: 2px solid var(--primary-color);
            padding-top: 20px;
        }

        .footer {
            position: absolute;
            bottom: 30px;
            left: 30px;
            right: 30px;
            width: calc(100% - 60px);
        }

        .footer .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--primary-color);
        }

        /* Print/PDF specific styles */
        @media print {
            body {
                width: 210mm;
                height: 297mm;
            }

            .preview-only {
                display: none !important;
            }

            .invoice-page {
                width: 210mm;
                min-height: 297mm;
                padding: 0;
                margin: 0;
                border: none;
                box-shadow: none;
            }

            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }



        /* Replace flex layouts with table-based layouts */
        .header-section {
            width: 100%;
            margin-bottom: 30px;
        }

        .company-logo {
            float: left;
            width: 60%;
        }

        .invoice-title {
            float: right;
            width: 30%;
            background-color: var(--primary-color) !important;
            color: white;
            text-align: right;
            padding: 4px 30px;
            position: relative;
        }

        .invoice-info {
            width: 100%;
            margin-bottom: 30px;
            border-collapse: collapse;
        }

        .invoice-info td {
            padding: 8px;
            vertical-align: top;
        }

        .footer-bottom {
            width: 100%;
        }

        .footer-bottom-table {
            width: 100%;
            border-collapse: collapse;
        }

        .footer-bottom-table td {
            padding: 8px;
            vertical-align: bottom;
        }

        .footer-left {
            width: 50%;
        }

        .footer-right {
            width: 50%;
            text-align: right;
        }

        /* Clear floats */
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>

<body>
    <!-- Preview only buttons -->
    @if (!$isPdf)
    <div class="preview-only">
        <button onclick="window.print()" class="btn btn-print">
            <i class="fas fa-print"></i>
            Print
        </button>
        <a href="{{ route('invoice.download', $invoice->id) }}" class="btn btn-download">
            <i class="fas fa-download"></i>
            Download PDF
        </a>
    </div>
    @endif

    <div class="invoice-page">
        <div style="padding: 36px 32px;">
            <!-- Header -->
            <div class="header-section clearfix">
                <div class="company-logo">
                    @php

                    $dark_logo = $invoice->project->employer->logo ??  public_path('images/dark_logo.png');
                    if ($dark_logo && file_exists($dark_logo)) {

                        $base64_image = base64_encode(file_get_contents($dark_logo));
                        
                        echo '<img src="data:image/jpeg;base64,' . $base64_image . '" alt="logo" style="height: 80px">';
                    }
                    @endphp
                </div>
                <div class="invoice-title">
                    <h1 style="margin:0">INVOICE</h1>
                </div>
            </div>
            <!-- Invoice Info -->
            <table class="invoice-info">
                <tr>
                    <td style="width: 50%; padding: 0px;">
                        <p style="margin-bottom: 0px; margin-top: 6px;"><strong>INVOICE TO:</strong></p>
                        <p style="margin-bottom: 0px; margin-top: 6px;">Name: {{ $invoice->client->client_name }}</p>
                        <p style="margin-bottom: 0px; margin-top: 6px;">Email: {{ $invoice->client->client_email }}</p>
                    </td>
                    <td style="width: 50%; padding: 0px; text-align: right;">
                        <p style="margin-bottom: 0px; margin-top: 6px;"><strong>INVOICE NO:</strong> {{
                            $invoice->invoice_number }}</p>
                        <p style="margin-bottom: 0px; margin-top: 6px;"><strong>DATE:</strong> {{ $invoice->invoice_date
                            }}</p>
                    </td>
                </tr>
            </table>
            <table class="items-table">
                <thead>
                    <tr>
                        <th style="width: 5%">NO</th>
                        <th style="width: 45%">TASK DESCRIPTION</th>
                        <th class="price" style="width: 15%">PRICE</th>
                        <th class="qty" style="width: 15%">HOURS</th>
                        <th class="total" style="width: 20%">TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $totalMinutes = 0;

                    // Loop through each task to sum the time in minutes
                    foreach ($invoice->project->tasks as $task) {
                    if (!empty($task->time) && strpos($task->time, ':') !== false) {
                    $timeParts = explode(':', $task->time);

                    // Convert hours and minutes to integers for calculation
                    $hours = isset($timeParts[0]) ? (int)$timeParts[0] : 0;
                    $minutes = isset($timeParts[1]) ? (int)$timeParts[1] : 0;

                    // Convert hours to minutes and add minutes
                    $taskMinutes = ($hours * 60) + $minutes;
                    $totalMinutes += $taskMinutes;
                    }
                    }

                    // Convert total minutes to hours
                    $totalHours = $totalMinutes / 60;

                    // Ensure hr_budget is numeric before calculation
                    $hrBudget = is_numeric($invoice->project->hr_budget) ? $invoice->project->hr_budget : 0;

                    // Calculate total cost based on hours
                    $totalCost = $totalHours * $hrBudget;
                    @endphp
                    @foreach ($invoice->project->tasks as $index => $item)
                    @if ($item->status === 'completed')
                    <!-- Only show completed tasks -->
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td style="text-align:left;">
                            {{ $item->task_name }}<br>
                        </td>
                        <td>
                            ${{ $item->project->payment_type == 'fixed' ? 
                                $item->project->total_paid : 
                                (number_format($invoice->project->hr_budget ?? 0, 2) . '/hr')
                            }}
                        </td>
                        <td>{{ $item->time ?? 0 }}</td>
                        @php
                        $timeParts = explode(':', $task->time);

                        // Convert hours and minutes to integers for calculation
                        $hours = isset($timeParts[0]) ? (int)$timeParts[0] : 0;
                        $minutes = isset($timeParts[1]) ? (int)$timeParts[1] : 0;

                        // Convert hours to minutes and add minutes
                        $taskMinutes = ($hours * 60) + $minutes;

                        // Convert total minutes to hours
                        $totalHours = $taskMinutes / 60;

                        // Ensure hr_budget is numeric before calculation
                        $hrBudget = is_numeric($invoice->project->hr_budget) ? $invoice->project->hr_budget : 0;

                        // Calculate total cost based on hours
                        $taskCost = $totalHours * $hrBudget;
                        @endphp
                        <td>${{ $item->project->payment_type == 'fixed' ? $item->project->total_paid : number_format($taskCost, 2) }}</td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            <!-- Totals -->
            <div class="totals-section">
                <table class="totals-table" >
                    <tr class="sub-total" style="background: #6b21a8;">
                        <td>Sub Total:</td>
                        <td align="right">${{ $invoice->project->payment_type == 'fixed' ? $invoice->project->total_paid : number_format($totalCost, 2) }}</td>
                    </tr>
                    {{-- <tr class="tax" style="background: #6b21a8;">
                        <td>Tax ({{ $invoice->tax_rate }}%):</td>
                        <td align="right">${{ $invoice->project->payment_type == 'fixed' ? $invoice->project->total_paid : number_format($totalCost * $invoice->tax_rate / 100, 2) }}</td>
                        <!-- Updated line to calculate tax correctly -->
                    </tr> --}}
                    <tr class="grand-total" style="background: #6b21a8;">
                        <td>GRAND TOTAL:</td>
                        <td align="right">${{ $invoice->project->payment_type == 'fixed' ? $invoice->project->total_paid : number_format($totalCost + $invoice->tax_amount, 2) }}</td>
                        <!-- Ensure tax amount is added to total cost -->
                    </tr>
                </table>
            </div>
            <!-- Payment Info -->
            <div class="payment-info">
                <h3>Payment Info:</h3>
                <div>

                    @php
                    $lines = explode("\n", $invoice->project->employer->account_details);
                @endphp
                
                @foreach ($lines as $line)
                    @php
                        [$key, $value] = array_pad(explode(':', $line, 2), 2, null);
                    @endphp
                    @if ($key && $value)
                        <strong>{{ trim($key) }}:</strong> {{ trim($value) }}<br>
                    @else
                        {{ $line }}<br>
                    @endif
                    @endforeach
                </div>
            </div>

            <div class="footer">
                <!-- Terms and Footer -->
                <table class="footer-bottom-table">
                    <tr>
                        <td class="footer-left" style="padding: 0px;">
                            <div style="margin-bottom: 6px;">Phone: {{ $invoice->project->employer->phone }}</div>
                            <div style="margin-bottom: 6px;">Address: {{ $invoice->project->employer->address }}</div>
                            <div style="margin-bottom: 0px;">Website: {{ $invoice->project->employer->website }}</div>
                        </td>
                        <td class="footer-right" style="padding: 0px;">
                            <h2>{{ config('app.name') }}</h2>
                            <strong>Thank you for your business</strong>
                        </td>
                    </tr>
                </table>
                <div class="terms-section" style="text-align: center;">
                    <a href="">Terms & Conditions</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>