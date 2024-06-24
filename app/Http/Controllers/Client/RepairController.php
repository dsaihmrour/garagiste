<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Repair;
use Illuminate\Http\Request;

class RepairController extends Controller
{
    public function index()
    {
        $search = request()->input('search');
        $status = request()->query('repair_status');
        $repairs = auth()->user()->vehicles->flatMap(function ($vehicle) {
            return $vehicle->repairs;
        })->sortByDesc('created_at');

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

        return view("client.repairs.index", compact("repairs"));
    }

    public function show(Repair $repair)
    {
        return view("client.repairs.show", compact("repair"));
    }

    public function edit(Repair $repair)
    {
        return view("client.repairs.edit", compact("repair"));
    }

    public function update(Request $request, Repair $repair)
    {
        $request->validate([
            'description' => 'sometimes|string|max:255',
            'clientNotes' => 'nullable|string',
            'title' => 'sometimes|string|max:255',
        ]);
        $repair->update($request->all());

        return redirect()->route("client.repairs")->with("status", "Repair updated successfully");
    }

    public function addNotes(Request $request, $repairId)
    {
        $request->validate([
            "clientNotes" => "required|string|max:255",
        ]);
        $repair = Repair::find($repairId);
        $repair->update([
            'clientNotes' => $repair->clientNotes . "-" . $request->clientNotes,
        ]);
        return response()->json($repair);
    }

    public function editNotes(Request $request, $repairId)
    {
        $request->validate([
            "clientNotes" => "required|string|max:255",
        ]);
        $repair = Repair::find($repairId);
        $repair->update([
            'clientNotes' => $request->clientNotes,
        ]);
        return response()->json($repair);
    }
}
