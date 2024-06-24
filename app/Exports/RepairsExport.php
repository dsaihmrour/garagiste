<?php

namespace App\Exports;

use App\Models\Repair;
use Maatwebsite\Excel\Concerns\FromCollection;

class RepairsExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Repair::all();
    }
    public function headings(): array
    {
        return [
            'id',
            'description',
            'status',
            'startDate',
            'endDate',
            'mechanicNotes',
            'clientNotes',
            "workPrice",
            "hours",
            "hourPrice",
            'mechanic_id',
            'vehicle_id',
            "invoice_id",
            "title"
        ];
    }
}
