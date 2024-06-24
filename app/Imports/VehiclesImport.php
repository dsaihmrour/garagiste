<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Vehicle;
use Maatwebsite\Excel\Concerns\ToModel;

class VehiclesImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $user = User::where("email", $row["email"])->first();
        // Check if user exists
        if (!$user) {
            return null; // Skip this row if user does not exist
        }
        return new Vehicle([
            'make' => $row["make"],
            'model' => $row["model"],
            'fuelType' => $row["fuelType"],
            'registration' => $row["registration"],
            'photos' => $row["photos"],
            'user_id' => $user->id,
        ]);
    }
}
