<?php

namespace App\Exports;

use App\Models\SparePart;
use Maatwebsite\Excel\Concerns\FromCollection;

class SparePartsExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return SparePart::all();
    }
    public function headings(): array
    {
        return [
            'id',
            'partName',
            'partReference',
            'supplier',
            'price',
            "stock",
            "description",
            "photo",
        ];
    }
}
