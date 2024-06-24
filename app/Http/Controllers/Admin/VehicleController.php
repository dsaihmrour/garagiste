<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\VehiclesExport;
use App\Imports\VehiclesImport;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        $users = User::all();

        return view('admin.vehicles.index', compact('vehicles', 'users'));
    }

    public function export()
    {
        return Excel::download(new VehiclesExport, 'vehicles.xlsx');
    }
    public function import()
    {
        if (request()->hasFile('file')) {
            Excel::import(new VehiclesImport, request()->file('file'));
            return back()->with('status', 'Vehicles imported successfully!');
        } else {
            return back()->with('status', 'Please select a file to import.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('admin.vehicles.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'make' => 'required|string',
            'model' => 'required|string',
            'fuelType' => 'required|string',
            'registration' => 'required|string|unique:vehicles',
            'user_id' => 'required|exists:users,id', // Make sure user_id exists in users table
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validation rule for each photo in the array
        ]);

        $vehicleData = $request->except('photos');
        $vehicle = Vehicle::create($vehicleData);

        if ($request->hasFile('photos')) {
            $photos = [];
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('vehicle_photos', "public");
                // Store photo in storage/app/public/vehicle_photos directory

                $photos[] = $path;
            }
            $vehicle->photos = $photos; // Append new photos to existing photos
            $vehicle->save();
        }

        return redirect()->route('vehicles')->with('status', 'Vehicle ' . $vehicle->registration . ' created and attached to user!');
    }



    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        $repairs = $vehicle->repairs;
        return view('admin.vehicles.show', compact('vehicle', "repairs"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'make' => 'required|string',
            'model' => 'required|string',
            'fuelType' => 'required|string',
            'registration' => 'required|string|unique:vehicles,registration,' . $vehicle->id,
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation rule for each photo in the array
        ]);

        $vehicle->update($request->except('photos')); // Update vehicle attributes

        // Handle photos
        if ($request->hasFile('photos')) {
            $existingPhotos = $vehicle->photos ?? []; // Get existing photos

            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('vehicle_photos', 'public');
                $existingPhotos[] = $path; // Add new photo to the array
            }

            $vehicle->photos = $existingPhotos; // Update photos attribute
        }

        $vehicle->save(); // Persist the changes in the database
        return redirect()->route('vehicles')->with('status', 'Vehicle ' . $vehicle->registration . ' updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('vehicles')->with('status', 'Vehicle ' . $vehicle->plate . ' deleted!');
    }
}
