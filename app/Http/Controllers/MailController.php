<?php

namespace App\Http\Controllers;

use App\Mail\NotifyClientAboutRepair;
use App\Mail\NotifyClientInvoice;
use App\Models\Invoice;
use App\Models\Notification;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function notifyClientAboutRepair(Request $request)
    {
        $mailData = $request->validate([
            'userEmail' => 'required|email',
            'vehicle_id' => 'required',
            'repair_id' => 'required',
        ]);
        $vehicle = Vehicle::findOrFail($mailData['vehicle_id']);
        $mailData['registration'] = $vehicle->registration;
        $mailData['title'] = "Your vehicle repair is done";


        Notification::create([
            "user_id" => $vehicle->user_id,
            "title" => $mailData['title'],
            "content" => "Your vehicle " . $vehicle->registration . " repair is done, you can come to our warehouse to cheock it out",
        ]);


        Mail::to($mailData['userEmail'])->send(new NotifyClientAboutRepair($mailData));
    }

    public function notifyClientAboutInvoice(Request $request)
    {
        $mailData = $request->validate([
            'userEmail' => 'required|email',
            'invoice_id' => 'required',
        ]);
        $mailData['title'] = "Your invoice is ready to be payed";

        $invoice = Invoice::findOrFail($mailData['invoice_id']);
        Notification::create([
            "user_id" => $invoice->user_id,
            "title" => $mailData['title'],
            "content" => "Your invoice for repair is ready to be payed ,plaese pay it before it is too late",
        ]);

        Mail::to($mailData['userEmail'])->send(new NotifyClientInvoice($mailData));
    }
}
