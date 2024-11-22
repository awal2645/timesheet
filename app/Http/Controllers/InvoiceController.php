<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\Project;
use App\Models\Employer;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{


     // Display a listing of the invoices
     public function index(Request $request)
     {
         $search = $request->input('search');
         $invoices = Invoice::with('employer')
             ->when($search, function ($query) use ($search) {
                 return $query->where('invoice_number', 'like', "%{$search}%");
             })
             ->paginate(10);
 
         return view('invoice.index', compact('invoices'));
     }
 
     // Show the form for creating a new invoice
     public function create()
     {
         $employers = Employer::all();
         $clients = Client::all(); // Fetch all clients
         $projects = Project::all(); // Fetch all projects
         return view('invoice.create', compact('employers', 'clients', 'projects'));
     }
     // Store a newly created invoice in storage
     public function store(Request $request)
     {
         $request->validate([
             'employer_id' => 'required|exists:employers,id',
             'client_id' => 'required|exists:clients,id',
             'project_id' => 'required|exists:projects,id',
             'invoice_number' => 'required|string|max:255',
             'total_cost' => 'required|numeric',
         ]);
 
         Invoice::create($request->all());
 
         return redirect()->route('invoice.index')->with('success', __('Invoice created successfully.'));
     }
 
     // Show the form for editing the specified invoice
     public function edit(Invoice $invoice)
     {
         $employers = Employer::all();
         $clients = Client::all(); // Fetch all clients
         $projects = Project::all(); // Fetch all projects
         return view('invoice.edit', compact('invoice', 'employers', 'clients', 'projects'));
     }
 
     // Update the specified invoice in storage
     public function update(Request $request, Invoice $invoice)
     {
         $request->validate([
             'employer_id' => 'required|exists:employers,id',
             'invoice_number' => 'required|string|max:255',
             'invoice_date' => 'required|date',
             'total_cost' => 'required|numeric',
         ]);
 
         $invoice->update($request->all());
 
         return redirect()->route('invoice.index')->with('success', __('Invoice updated successfully.'));
     }
 
     // Remove the specified invoice from storage
     public function destroy(Invoice $invoice)
     {
         $invoice->delete();
 
         return redirect()->route('invoice.index')->with('success', __('Invoice deleted successfully.'));
     }

    public function preview()
    {
        $invoice = $this->getDummyData(1);
        return view('invoice', ['invoice' => $invoice, 'isPdf' => false]);
    }

    // public function download($id)
    // {
    //     $invoice = $this->getDummyData($id);
        
    //     // Set PDF options before loading view
    //     $options = [
    //         'defaultFont' => 'DejaVu Sans',
    //         'isRemoteEnabled' => true,
    //         'isHtml5ParserEnabled' => true,
    //         'isPhpEnabled' => true,
    //         'defaultMediaType' => 'screen',
    //         'isFontSubsettingEnabled' => true,
    //         'dpi' => 150,
    //         'defaultPaperSize' => 'a4',
    //         'orientation' => 'portrait',
    //         'enable_css_float' => true,
    //         'enable_remote' => true,
    //     ];
        
    //     // Create PDF instance with options
    //     $pdf = PDF::setOptions($options)
    //         ->loadView('invoice', [
    //             'invoice' => $invoice,
    //             'isPdf' => true
    //         ]);

    //     // Set paper size
    //     $pdf->setPaper('a4', 'portrait');

            //     // Force binary content type
            //     return response($pdf->output(), 200, [
            //         'Content-Type' => 'application/pdf',
            //         'Content-Disposition' => 'attachment; filename="invoice-'.$invoice->number.'.pdf"',
            //         'Cache-Control' => 'private, no-transform, no-store, must-revalidate'
            //     ]);
            // }

            public function download($id)
            {
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
                
                $invoice = Invoice::with(['client', 'project.tasks' => function ($query) {
                    $query->where('status', 'completed'); // Filter tasks by status
                }])->findOrFail($id);
                $pdf = PDF::setOptions($options)
                    ->loadView('invoice', [
                        'invoice' => $invoice,
                        'isPdf' => true
                        ]);
        return $pdf->download('invoice_' . $invoice->invoice_number . '.pdf');
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