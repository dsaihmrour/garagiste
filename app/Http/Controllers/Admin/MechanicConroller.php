<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MechanicConroller extends Controller
{
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');

        $usersQuery = User::query();

        if ($searchTerm) {
            $usersQuery
                ->where('username', 'LIKE', "%{$searchTerm}%")
                ->orWhere('email', 'LIKE', "%{$searchTerm}%");
        }
        // Filter users with the role 'client'
        $usersQuery->whereHas('roles', function ($query) {
            $query->where('name', 'mechanic');
        });

        $mechanics = $usersQuery->get();
        return view('admin.users.mechanics.index', compact('mechanics', 'searchTerm'));
    }

    public function mehcanicRepairs(User $mechanic)
    {
        $repairs = $mechanic->repairs;
        return view("admin.users.mechanics.repairs", compact("repairs", "mechanic"));
    }
    public function import()
    {
        Excel::import(new UsersImport, request()->file('file'));
        return back();
    }
    public function export()
    {
        return Excel::download(new UsersExport, 'clients.xlsx');
    }
}
