<?php

namespace App\Imports;

use App\Models\Invoice;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class InvoiceImport implements ToModel
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
        return new Invoice([
            'additionalCharges' => $row["additionalCharges"],
            'totalAmount' => $row["totalAmount"],
            'dueDate' => $row["dueDate"],
            'user_id' => $user->id,
            'description' => $row["description"],
        ]);
    }
}
