<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use PDF;

class PDFController extends Controller
{
    public function generatePDF()
    {
        $data = ['title' => 'domPDF in Laravel 10'];
        $pdf = PDF::loadView('admin.pdfs.document', $data);
        return $pdf->download('document.pdf');
    }

    public function generateInvoicePDF($invoiceId)
    {
        $invoice = Invoice::with("repairs")->find($invoiceId);
        $data = [
            'invoice' => $invoice,
            'repairs' => $invoice->repairs
        ];
        $pdf = PDF::loadView('admin.pdfs.invoice', $data)->setOptions([
            'defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true, 'isJavascriptEnabled' => true
        ]);
        return $pdf->download('invoice.pdf');
    }
}
