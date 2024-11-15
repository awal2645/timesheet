<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function preview()
    {
        $invoice = $this->getDummyData(1);
        return view('invoice', compact('invoice'));
    }

    public function download($id)
    {
        $invoice = $this->getDummyData($id);
        
        $pdf = PDF::loadView('invoice', compact('invoice'))
            ->setPaper('a4')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'sans-serif',
                'isFontSubsettingEnabled' => true,
                'isJavascriptEnabled' => true,
                'dpi' => 150,
                'defaultPaperSize' => 'a4',
                'margin_left' => 15,
                'margin_right' => 15,
                'margin_top' => 15,
                'margin_bottom' => 15,
                'enable_css_float' => true,
                'enable_html5_parser' => true,
            ]);
        
        return $pdf->download('invoice-'.$invoice->number.'.pdf');
    }

    private function getDummyData($id)
    {
        return (object)[
            'id' => $id,
            'number' => 'INV-2024001',
            'date' => now()->format('Y-m-d'),
            'due_date' => now()->addDays(30)->format('Y-m-d'),
            'client_name' => 'John Doe',
            'client_address' => '123 Client Street, City',
            'client_email' => 'john@example.com',
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