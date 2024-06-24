<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use App\Mail\NotifyClientAboutRepair;
use App\Models\Invoice;
use App\Models\Notification;
use App\Models\Repair;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RepairController extends Controller
{


    public function index()
    {
        $search = request()->input('search');
        $status = request()->query('repair_status');
        $repairs = auth()->user()->repairs;

        if ($search) {
            $repairs = $repairs->filter(function ($repair) use ($search) {
                return stristr($repair->description, $search) || stristr($repair->title, $search);
            });
        }

        if ($status) {
            $repairs = $repairs->filter(function ($repair) use ($status) {
                return $repair->status === $status;
            });
        }

        return view("mechanic.repairs.index", compact("repairs"));
    }
    public function show(Repair $repair)
    {
        return view("mechanic.repairs.show", compact("repair"));
    }

    public function create()
    {
        $vehicles = Vehicle::all();
        $invoices = Invoice::all();
        return view("mechanic.repairs.create", compact("vehicles", "invoices"));
    }
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'status' => 'in:pending,completed,in progress',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'mechanicNotes' => 'nullable|string',
            'clientNotes' => 'nullable|string',
            'workPrice' => 'required|numeric|min:0',
            'hours' => 'required|numeric|min:0',
            'hourPrice' => 'required|numeric|min:0',
            'mechanic_id' => 'required|exists:users,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'invoice_id' => 'nullable|exists:invoices,id',
            'title' => 'required|string|max:255',
        ]);
        $repair = Repair::create($request->all());

        return redirect()->back()->with("status", "Repair created successfully");
    }

    public function edit(Repair $repair)
    {
        return view("mechanic.repairs.edit", compact("repair"));
    }

    public function update(Request $request, Repair $repair)
    {
        $request->validate([
            'description' => 'sometimes|string|max:255',
            'status' => 'sometimes|in:pending,completed,in progress',
            'startDate' => 'sometimes|date',
            'endDate' => 'sometimes|date|after_or_equal:startDate',
            'mechanicNotes' => 'nullable|string',
            'clientNotes' => 'nullable|string',
            'workPrice' => 'sometimes|numeric|min:0',
            'hours' => 'sometimes|numeric|min:0',
            'hourPrice' => 'sometimes|numeric|min:0',
            'title' => 'sometimes|string|max:255',
        ]);
        $repair->update($request->all());

        if ($repair->status == 'completed') {
            if (!$repair->invoice_id) {
                $invoice = Invoice::create([
                    "user_id" => $repair->user_id,
                    "totalAmount" => $repair->workPrice,
                    "description" => "Repair for vehicle " . $repair->vehicle->registration
                ]);

                $repair->invoice_id = $invoice->id;
                $repair->save();
            }

            $vehicle = $repair->vehicle;
            $owner = $vehicle->user;
            $mailData = [
                "title" => "Repair Completed",
                "repair_id" => $repair->id,
                "registration" => $vehicle->registration
            ];
            Notification::create([
                "user_id" => $vehicle->user_id,
                "title" => $mailData['title'],
                "content" => "Your vehicle " . $vehicle->registration . " repair is done, you can come to our warehouse to cheock it out",
            ]);
            Mail::to($owner->email)->send(new NotifyClientAboutRepair($mailData));
        }
        return redirect()->back()->with("status", "Repair updated successfully");
    }

    public function updateStatus($repairId, $status)
    {
        if (!$status) {
            return response()->json(["error" => "status required"]);
        }
        $repair = Repair::find($repairId);

        if ($status == 'completed') {
            $invoice = Invoice::create([
                "user_id" => $repair->user_id,
                "totalAmount" => $repair->workPrice,
                "description" => "Repair for vehicle " . $repair->vehicle->registration
            ]);

            $repair->invoice_id = $invoice->id;

            $vehicle = $repair->vehicle;
            $owner = $vehicle->user;

            $mailData = [
                "title" => "Repair Completed",
                "repair_id" => $repair->id,
                "registration" => $vehicle->registration
            ];

            Notification::create([
                "user_id" => $vehicle->user_id,
                "title" => $mailData['title'],
                "content" => "Your vehicle " . $vehicle->registration . " repair is done, you can come to our warehouse to cheock it out",
            ]);
            Mail::to($owner->email)->send(new NotifyClientAboutRepair($mailData));
        }
        $repair->status = $status;
        $repair->save();
        return response()->json(["status" => $repair->status, 'msg' => 'Status updated successfully']);
    }
    public function destroy(Repair $repair)
    {
        $repair->delete();
        return redirect()->back()->with("status", "Repair deleted successfully");
    }

    public function addNotes(Request $request, $repairId)
    {
        $request->validate([
            "mechanicNotes" => "required|string|max:255",
        ]);
        $repair = Repair::find($repairId);
        $repair->update([
            'mechanicNotes' => $repair->mechanicNotes . "-" . $request->mechanicNotes,
        ]);
        return response()->json($repair);
    }


    public function editNotes(Request $request, $repairId)
    {
        $request->validate([
            "mechanicNotes" => "required|string|max:255",
        ]);
        $repair = Repair::find($repairId);
        $repair->update([
            'mechanicNotes' => $request->mechanicNotes,
        ]);
        return response()->json($repair);
    }
}
