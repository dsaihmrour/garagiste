<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;

class InvoicesExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Invoice::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'additionalCharges',
            'totalAmount',
            'dueDate',
            'user_id',
            'description'
        ];
    }
}
