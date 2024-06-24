<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(Request $request)
    {

        $vehicles = Vehicle::query();

        $searchTerm = $request->input('search');

        if ($searchTerm) {
            $vehicles->where(function ($query) use ($searchTerm) {
                $query->where('model', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('make', 'LIKE', "%{$searchTerm}%")
                    ->orWhereHas('user', function ($query) use ($searchTerm) {
                        $query->where('username', 'LIKE', "%{$searchTerm}%");
                    });
            });
        }

        $vehicles = $vehicles->get();

        return view('mechanic.vehicles.index', compact('vehicles'));
    }
    public function show(Vehicle $vehicle)
    {
        $repairs = $vehicle->repairs;
        return view('mechanic.vehicles.show', compact('vehicle', "repairs"));
    }
}
