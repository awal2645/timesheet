<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function preview()
    {
        $invoice = $this->getDummyData(1);
        return view('invoice', ['invoice' => $invoice, 'isPdf' => false]);
    }

    public function download($id)
    {
        $invoice = $this->getDummyData($id);
        
        // Set PDF options before loading view
        $options = [
            'defaultFont' => 'DejaVu Sans',
            'isRemoteEnabled' => true,
            'isHtml5ParserEnabled' => true,
            'isPhpEnabled' => true,
            'defaultMediaType' => 'screen',
            'isFontSubsettingEnabled' => true,
            'dpi' => 150,
            'defaultPaperSize' => 'a4',
            'orientation' => 'portrait',
            'enable_css_float' => true,
            'enable_remote' => true,
        ];
        
        // Create PDF instance with options
        $pdf = PDF::setOptions($options)
            ->loadView('invoice', [
                'invoice' => $invoice,
                'isPdf' => true
            ]);

        // Set paper size
        $pdf->setPaper('a4', 'portrait');

        // Force binary content type
        return response($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="invoice-'.$invoice->number.'.pdf"',
            'Cache-Control' => 'private, no-transform, no-store, must-revalidate'
        ]);
    }

    private function getDummyData($id)
    {
        return (object)[
            'id' => $id,
            'number' => 'INV-2024001',
            'date' => '2024-01-15',
            'due_date' => '2024-01-30',
            'company' => 'Your Company Name',
            'address' => '123 Business Street',
            'city' => 'City Name',
            'country' => 'Country Name',
            'phone' => '+1 234 567 890',
            'email' => 'john@example.com',
            'website' => 'www.example.com',
            'client' => (object)[
                'name' => 'John Doe',
                'address' => '123 Client Street',
                'city' => 'City',
                'email' => 'john@example.com'
            ],
            'subtotal' => 1000,
            'tax_rate' => 10,
            'tax_amount' => 100,
            'total' => 1100,
            'items' => [
                (object)[
                    'description' => 'Web Development Service',
                    'quantity' => 1,
                    'unit_price' => 500,
                ],
                (object)[
                    'description' => 'UI/UX Design',
                    'quantity' => 2,
                    'unit_price' => 250,
                ],
            ]
        ];
    }
} 