<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::select("username", "lastName", "firstName", "email", "address", "phoneNumber", "password")->get();
    }
    public function headings(): array
    {
        return ["Username", "Last Name", "First Name", "Name", "Email", "Address", "Phone Number", "Password"];
    }
}
