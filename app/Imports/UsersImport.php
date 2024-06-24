<?php

namespace App\Imports;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $user = User::create([
            'username' => $row["username"],
            'password' => Hash::make($row["password"]),
            'email' => $row["email"],
            'firstName' => $row["firstname"],
            'lastName' => $row["lastname"],
            'address' => $row["address"],
            'phoneNumber' => $row["phonenumber"],
        ]);

        $user->roles()->attach(Role::where('name', 'client')->first(), ['user_id' => $user->id]);
        return $user;
    }
}
