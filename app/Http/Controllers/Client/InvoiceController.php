<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = auth()->user()->invoices;
        return view("client.invoices.index", compact("invoices"));
    }

    public function show($invoiceId)
    {
        $invoice = Invoice::find($invoiceId);
        return view("client.invoices.show", compact("invoice"));
    }

    public function pay($invoiceId)
    {
        $invoice = Invoice::find($invoiceId);
        $invoice->update([
            "dueDate" => now(),
        ]);

        return redirect("/client/invoices")->with("status", "Invoice paid successfully");
    }
}
