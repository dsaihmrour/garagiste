<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $search = request()->input('search');
        $status = request()->query('repair_status');
        $appointments = auth()->user()->appointments->sortByDesc('start_datetime');

        if ($search) {
            $appointments = $appointments->filter(function ($appointment) use ($search) {
                return stristr($appointment->description, $search) || stristr($appointment->title, $search);
            });
        }

        if ($status) {
            $appointments = $appointments->filter(function ($appointment) use ($status) {
                return $appointment->status === $status;
            });
        }

        $vehicles = auth()->user()->vehicles;
        return view("client.appointments.index", compact("appointments", "vehicles"));
    }

    public function show(Appointment $appointment)
    {
        return view("client.appointments.show", compact("appointment"));
    }

    public function getData($appointmentId)
    {
        $appointment = Appointment::find($appointmentId);
        return response()->json($appointment);
    }
    public function edit(Appointment $appointment)
    {
        return view("client.appointments.edit", compact("appointment"));
    }

    public function update(Request $request, $appointment)
    {
        $request->validate([
            'description' => 'sometimes|string|max:255',
            'title' => 'sometimes|string|max:255',
            "start_datetime" => "sometimes|date",
            "end_datetime" => "sometimes|date",
            'vehicle_id' => 'required|exists:vehicles,id',
        ]);
        $appointmentObj = Appointment::find($appointment);
        $appointmentObj->update($request->all());

        return redirect()->route("client.appointments")->with("status", "Appointment updated successfully");
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'description' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            "start_datetime" => "required|date",
            "end_datetime" => "required|date",
            'vehicle_id' => 'required|exists:vehicles,id',
        ]);

        $data["user_id"] = auth()->user()->id;
        $appointment = Appointment::create($data);

        return redirect()->route("client.appointments")->with("status", "Appointment created successfully");
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route("client.appointments")->with("status", "Appointment deleted successfully");
    }

    public function cancel($appointmentId)
    {
        $appointment = Appointment::find($appointmentId);
        $appointment->status = "canceled";
        $appointment->save();
        return redirect()->back()->with("status", "Appointment cancelled successfully");
    }
}
