<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(Request $request)
    {

        $vehicles = auth()->user()->vehicles()->where(function ($query) use ($request) {
            $searchTerm = $request->input('search');

            if ($searchTerm) {
                $query->where('model', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('make', 'LIKE', "%{$searchTerm}%");
            }
        })->get();

        return view('client.vehicles.index', compact('vehicles'));
    }

    public function show(Vehicle $vehicle)
    {
        $repairs = $vehicle->repairs;
        return view('client.vehicles.show', compact('vehicle', "repairs"));
    }

    public function store(Request $request)
    {
        $request->validate([
            'make' => 'required|string',
            'model' => 'required|string',
            'fuelType' => 'required|string',
            'registration' => 'required|string|unique:vehicles',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validation rule for each photo in the array
        ]);

        $vehicleData = $request->except('photos');
        $vehicleData['user_id'] = auth()->user()->id; // add user id to the form data

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

        return redirect()->route('client.vehicles')->with('status', 'Vehicle ' . $vehicle->registration . ' created!');
    }

    public function edit(Vehicle $vehicle)
    {
        return view('client.vehicles.edit', compact('vehicle'));
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
        return redirect()->route('client.vehicles')->with('status', 'Vehicle ' . $vehicle->registration . ' updated!');
    }
}
