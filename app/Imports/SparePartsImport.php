<?php

namespace App\Imports;

use App\Models\SparePart;
use Maatwebsite\Excel\Concerns\ToModel;

class SparePartsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new SparePart([
            'partName' => $row["partName"],
            'partReference' => $row["partReference"],
            'supplier' => $row["supplier"],
            'price' => $row["price"],
            "stock" => $row["stock"],
            "description" => $row["description"],
        ]);
    }
}
