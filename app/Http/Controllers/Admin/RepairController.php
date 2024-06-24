<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\RepairsExport;
use App\Imports\RepairsImport;
use App\Mail\NotifyClientAboutRepair;
use App\Models\Invoice;
use App\Models\Notification;
use App\Models\Repair;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class RepairController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request()->input('search');
        $status = request()->query('repair_status');
        $repairs = Repair::all();

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
        $mechanics = User::whereHas('roles', function ($query) {
            $query->where('name', 'mechanic');
        })->get();

        return view("admin.repairs.index", compact("repairs", "mechanics"));
    }

    public function export()
    {
        return Excel::download(new RepairsExport, 'repairs.xlsx');
    }
    public function import()
    {
        if (request()->hasFile('file')) {
            Excel::import(new RepairsImport, request()->file('file'));
            return back()->with('status', 'Users imported successfully!');
        } else {
            return back()->with('status', 'Please select a file to import.');
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mechanics = User::with("roles")->whereHas("roles", function ($q) {
            $q->where("name", "mechanic");
        })->get();
        $vehicles = Vehicle::all();
        $invoices = Invoice::all();
        return view("admin.repairs.create", compact("mechanics", "vehicles", "invoices"));
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(Repair $repair)
    {
        return view("admin.repairs.show", compact("repair"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Repair $repair)
    {
        return view("admin.repairs.edit", compact("repair"));
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
    /**
     * Update the specified resource in storage.
     */
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

    public function assign(Request $request, $repairId)
    {
        $request->validate([
            "mechanic_id" => "required",
        ]);
        $repair = Repair::find($repairId);

        if ($repair->mechanic_id) {
            return redirect()->back()->with("status", "Repair$repair already assigned");
        }
        $repair->update([
            "mechanic_id" => $request->mechanic_id,
        ]);

        return redirect()->back()->with("status", "Repair assigned successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Repair $repair)
    {
        $repair->delete();
        return redirect()->back()->with("status", "Repair deleted successfully");
    }
}
