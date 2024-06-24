<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NotifyClientAboutAppointment;
use App\Models\Appointment;
use App\Models\Notification;
use App\Models\Repair;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    public function index()
    {
        $search = request()->input('search');
        $status = request()->query('repair_status');
        $appointments = Appointment::all();

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
        $mechanics = User::whereHas('roles', function ($query) {
            $query->where('name', 'mechanic');
        })->get();

        return view("admin.appointments.index", compact("appointments", "mechanics"));
    }

    public function show(Appointment $appointment)
    {
        $mechanics = User::whereHas('roles', function ($query) {
            $query->where('name', 'mechanic');
        })->get();
        return view("admin.appointments.show", compact("appointment", "mechanics"));
    }

    public function edit(Appointment $appointment)
    {
        return view("admin.appointments.edit", compact("appointment"));
    }

    public function assign(Request $request, $appointmentId)
    {
        $request->validate([
            "mechanic_id" => "required",
        ]);
        $appointment = Appointment::find($appointmentId);

        if ($appointment->mechanic_id) {
            return redirect()->back()->with("status", "Appointment already assigned");
        }

        $repair = Repair::create([
            'description' => $appointment->description,
            'startDate' => $appointment->start_datetime,
            'endDate' => $appointment->end_datetime,
            'mechanic_id' => $request->mechanic_id,
            'vehicle_id' => $appointment->vehicle->id,
            "title" => $appointment->title
        ]);

        $appointment->update([
            "mechanic_id" => $request->mechanic_id,
        ]);

        return redirect()->back()->with("status", "Appointment assigned successfully");
    }
    public function confirm(Request $request, $appointmentId)
    {
        $appointment = Appointment::find($appointmentId);
        $request->validate([
            "mechanic_id" => "required",
        ]);
        $appointment->update([
            "status" => "Confirmed",
        ]);

        $repair = Repair::create([
            'description' => $appointment->description,
            'startDate' => $appointment->start_datetime,
            'endDate' => $appointment->end_datetime,
            'mechanic_id' => $request->mechanic_id,
            'vehicle_id' => $appointment->vehicle->id,
            "title" => $appointment->title
        ]);

        $mailData = [
            'userEmail' => $appointment->user->email,
            'appointment_id' => $appointment->id,
            'appointmentTitle' => $appointment->title,
        ];
        $mailData['title'] = "Your appointment is accepted";

        Notification::create([
            "user_id" => $appointment->user->id,
            "title" => $mailData['title'],
            "content" => "Your invoice for repair is ready to be payed ,plaese pay it before it is too late",
        ]);

        Mail::to($appointment->user->email)->send(new NotifyClientAboutAppointment($mailData));

        return redirect()->route("appointments")->with("status", "Appointment confirmed successfully");
    }

    public function attachRepair(Request $request, Appointment $appointment)
    {
        $request->validate([
            "mechanic_id" => "required|exists:users,id",
        ]);
        $appointment->update([
            "mechanic_id" => $request->mechanic_id
        ]);
        return redirect()->route("appointments")->with("status", "Appointment attached to the mechanic successfully");
    }

    public function sendEmail(Appointment $appointment)
    {
        $mailData = [
            'userEmail' => $appointment->user->email,
            'appointment_id' => $appointment->id,
            'appointmentTitle' => $appointment->title,
        ];
        $mailData['title'] = "Your appointment is accepted";

        Notification::create([
            "user_id" => $appointment->user->id,
            "title" => $mailData['title'],
            "content" => "Your Appointment " . $appointment->title . " for repair is " . $appointment->status,
        ]);

        Mail::to($appointment->user->email)->send(new NotifyClientAboutAppointment($mailData));

        return redirect()->back()->with("status", "Appointment sent successfully and notified client");
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'description' => 'sometimes|string|max:255',
            'title' => 'sometimes|string|max:255',
            "start_datetime" => "sometimes|date",
            "end_datetime" => "sometimes|date",
        ]);
        $appointment->update($request->all());
        return redirect()->route("appointments")->with("status", "Appointment updated successfully");
    }

    public function cancel($appointmentId)
    {
        $appointment = Appointment::find($appointmentId);
        $appointment->status = "canceled";
        $appointment->save();
        return redirect()->back()->with("status", "Appointment cancelled successfully");
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route("appointments")->with("status", "Appointment deleted successfully");
    }
}
