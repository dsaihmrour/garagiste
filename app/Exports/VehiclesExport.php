<?php

namespace App\Exports;

use App\Models\Vehicle;
use Maatwebsite\Excel\Concerns\FromCollection;

class VehiclesExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Vehicle::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'make',
            'model',
            'fuelType',
            'registration',
            'photos',
            'user_id',
        ];
    }
}
