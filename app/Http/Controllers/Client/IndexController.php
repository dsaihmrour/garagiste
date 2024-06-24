<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $vehiclesCount = $user->vehicles()->count();
        $repairsCount = 0;
        foreach ($user->vehicles as $vehicle) {
            $repairsCount += $vehicle->repairs->count();
        }
        $invoicesCount = $user->invoices()->count();

        $weekAgo = now()->subWeek();
        $lastWeekVehiclesCount = 0; // prevent division by zero
        if ($user->vehicles()->where('created_at', '>=', $weekAgo)->count() > 0) {
            $lastWeekVehiclesCount = $user->vehicles()->where('created_at', '>=', $weekAgo)->count();
        }
        $lastWeekRepairsCount = 0;
        foreach ($user->vehicles as $vehicle) {
            $lastWeekRepairsCount += $vehicle->repairs()->where('created_at', '>=', $weekAgo)->count();
        }
        $lastWeekInvoicesCount = $user->invoices()->where('created_at', '>=', $weekAgo)->count();

        if ($lastWeekVehiclesCount !== 0) {
            $vehiclesPercentage = (($vehiclesCount - $lastWeekVehiclesCount) / $lastWeekVehiclesCount) * 100;
        } else {
            $vehiclesPercentage = 0;
        }
        if ($lastWeekRepairsCount !== 0) {
            $repairsPercentage = (($repairsCount - $lastWeekRepairsCount) / $lastWeekRepairsCount) * 100;
        } else {
            $repairsPercentage = 0;
        }
        if ($lastWeekInvoicesCount !== 0) {
            $invoicesPercentage = (($invoicesCount - $lastWeekInvoicesCount) / $lastWeekInvoicesCount) * 100;
        } else {
            $invoicesPercentage = 0;
        }


        $data = compact('vehiclesCount', 'repairsCount', 'invoicesCount', 'vehiclesPercentage', 'repairsPercentage', 'invoicesPercentage');
        // send the data to the view
        return view("client.stats", $data);
    }
}
