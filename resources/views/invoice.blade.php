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
            width: 50%;
        }

        .company-logo span {
            font-size: 24px;
            font-weight: bold;
        }

        .invoice-title {
            float: right;
            width: 40%;
            background-color: var(--primary-color) !important;
            color: white;
            padding: 10px 30px;
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
            margin-top: 40px;
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

        /* PDF-specific icon replacements */
        .pdf-icon {
            font-family: DejaVu Sans;
            font-weight: normal;
        }

        /* Replace flex layouts with table-based layouts */
        .header-section {
            width: 100%;
            margin-bottom: 30px;
        }

        .company-logo {
            float: left;
            width: 50%;
        }

        .invoice-title {
            float: right;
            width: 40%;
            background-color: var(--primary-color) !important;
            color: white;
            padding: 10px 30px;
        }

        /* Replace flex with table for invoice info */
        .invoice-info {
            width: 100%;
            margin-bottom: 30px;
            border-collapse: collapse;
        }

        .invoice-info td {
            padding: 8px;
            vertical-align: top;
        }

        /* Replace flex with table for footer */
        .footer-bottom {
            width: 100%;
            margin-top: 20px;
        }

        .footer-bottom-table {
            width: 100%;
            border-collapse: collapse;
        }

        .footer-bottom-table td {
            padding: 8px;
            vertical-align: top;
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
                    <span>BUSINESS<br>Your Slogan Here</span>
                </div>
                <div class="invoice-title">
                    <h1 style="margin:0">INVOICE</h1>
                </div>
            </div>
            <!-- Invoice Info -->
            <table class="invoice-info">
                <tr>
                    <td style="width: 50%">
                        <strong>INVOICE TO:</strong><br>
                        {{ $invoice->client->name }}<br>
                        {{ $invoice->client->address }}<br>
                        {{ $invoice->client->email }}
                    </td>
                    <td style="width: 50%; text-align: right;">
                        <strong>INVOICE NO:</strong> {{ $invoice->number }}<br>
                        <strong>DATE:</strong> {{ $invoice->date }}<br>
                        <strong>DUE DATE:</strong> {{ $invoice->due_date }}
                    </td>
                </tr>
            </table>
            <!-- Items Table -->
            <table class="items-table">
                <thead>
                    <tr>
                        <th style="width: 5%">NO</th>
                        <th style="width: 45%">ITEM DESCRIPTION</th>
                        <th class="price" style="width: 15%">PRICE</th>
                        <th class="qty" style="width: 15%">QTY</th>
                        <th class="total" style="width: 20%">TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoice->items as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                {{ $item->description }}<br>
                                <small style="color: #666">Lorem ipsum dolor sit amet, consectetur</small>
                            </td>
                            <td>${{ number_format($item->unit_price, 2) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->unit_price * $item->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Totals -->
            <div class="totals-section">
                <table class="totals-table">
                    <tr class="sub-total">
                        <td>Sub Total:</td>
                        <td align="right">${{ number_format($invoice->subtotal, 2) }}</td>
                    </tr>
                    <tr class="tax">
                        <td>Tax ({{ $invoice->tax_rate }}%):</td>
                        <td align="right">${{ number_format($invoice->tax_amount, 2) }}</td>
                    </tr>
                    <tr class="grand-total">
                        <td>GRAND TOTAL:</td>
                        <td align="right">${{ number_format($invoice->total, 2) }}</td>
                    </tr>
                </table>
            </div>
            <!-- Payment Info -->
            <div class="payment-info">
                <h3>Payment Info:</h3>
                <p>
                    <strong>Account No:</strong> 0000 000 000<br>
                    <strong>A/C Name:</strong> Example name<br>
                    <strong>Bank Details:</strong> Add your bank details
                </p>
            </div>
            <div class="footer">
                <!-- Terms and Footer -->

                <div class="terms-section">
                    <h3>TERMS & CONDITIONS:</h3>
                    <ol style="padding-left: 20px; color: #666;">
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing</li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing</li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing</li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing</li>
                    </ol>
                </div>
                <table class="footer-bottom-table">
                    <tr>
                        <td class="footer-left">
                            @if ($isPdf)
                                <div style="margin-bottom: 6px;"><span class="pdf-icon">📞</span> +00 123-456-789</div>
                                <div style="margin-bottom: 6px;"><span class="pdf-icon">📍</span> 123, Your address here
                                </div>
                                <div style="margin-bottom: 0px;"><span class="pdf-icon">🌐</span> www.example.com</div>
                            @else
                                <div style="margin-bottom: 6px;"><i class="fas fa-phone"></i> +00 123-456-789</div>
                                <div style="margin-bottom: 6px;"><i class="fas fa-map-marker-alt"></i> 123, Your address
                                    here</div>
                                <div style="margin-bottom: 0px;"><i class="fas fa-globe"></i> www.example.com</div>
                            @endif
                        </td>
                        <td class="footer-right">
                            <strong>Thank you for your business</strong>
                        </td>
                    </tr>
                </table>
            </div>
        </div>





    </div>
</body>

</html>
