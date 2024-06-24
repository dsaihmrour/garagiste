<?php

namespace App\Imports;

use App\Models\Invoice;
use App\Models\Repair;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class RepairsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $mechanic = User::where("email", $row["email"])->first();
        $vehicles = User::where("registrasion", $row["registrasion"])->first();
        $invoice = Invoice::where("id", $row["invoice_id"])->first();

        // Check if user exists
        if (!$mechanic || !$vehicles || !$invoice) {
            return null; // Skip this row if user does not exist
        }
        return new Repair([
            'description' => $row["description"],
            'status' => $row["status"],
            'startDate' => $row["startDate"],
            "endDate" => $row["endDate"],
            "mechanicNotes" => $row["mechanicNotes"],
            "clientNotes" => $row["clientNotes"],
            "workPrice" => $row["workPrice"],
            "hours" => $row["hours"],
            "hourPrice" => $row["hourPrice"],
            'mechanic_id' => $row["mechanic_id"],
            'vehicle_id' => $row["vehicle_id"],
            "invoice_id" => $row["invoice_id"],
            "title" => $row["title"]
        ]);
    }
}
