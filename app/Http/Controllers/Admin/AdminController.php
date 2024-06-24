<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Repair;
use App\Models\User;
use App\Models\Vehicle;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke()
    {
        $months = ['January', 'February', 'March', 'April', 'May'];

        // Initialize an empty array to store repair counts for each month
        $repairCounts = [];

        // Loop through each month and fetch the number of repairs completed by users (mechanics)
        foreach ($months as $month) {
            // Query to count the number of repairs completed by users (mechanics) for each month
            $repairCount = Repair::whereYear('created_at', now()->year)
                ->whereMonth('created_at', date('m', strtotime($month)))
                ->count();

            // Store the repair count for the current month
            $repairCounts[] = $repairCount;
        }

        $repairdata = [
            'labels' => $months,
            'data' => $repairCounts,
        ];

        $users = User::withCount('vehicles')->get();

        // Extract user names and vehicle counts
        $userNames = $users->pluck('username')->toArray();
        $vehicleCounts = $users->pluck('vehicles_count')->toArray();

        $userdata = [
            'labels' => $userNames,
            'data' => $vehicleCounts,
        ];

        $vehicles = Vehicle::withCount('repairs')->get();

        // Extract vehicle names and repair counts
        $vehicleNames = $vehicles->pluck('registration')->toArray();
        $repairCounts = $vehicles->pluck('repairs_count')->toArray();

        $vehicledata = [
            'labels' => $vehicleNames,
            'data' => $repairCounts,
        ];

        $usersCount = User::whereHas('roles', function ($query) {
            $query->where('name', 'client');
        })->count();
        $invoicesCount = Invoice::count();
        $repairsCount = Repair::count();
        $vehiclesCount = Vehicle::count();

        $latestUsers = User::whereHas('roles', function ($query) {
            $query->where('name', 'client');
        })->where('created_at', '>', now()->subYear())->latest()->count();
        $latestInvoices = Invoice::where('created_at', '>', now()->subYear())->latest()->count();
        $latestRepairs = Repair::where('created_at', '>', now()->subYear())->latest()->count();
        $latestVehicles = Vehicle::where('created_at', '>', now()->subYear())->latest()->count();

        return view('admin.stats', compact(
            'usersCount',
            'invoicesCount',
            'repairsCount',
            'vehiclesCount',
            'latestUsers',
            'latestInvoices',
            'latestRepairs',
            'latestVehicles',
            "repairdata",
            "userdata",
            "vehicledata"
        ));
    }
}
