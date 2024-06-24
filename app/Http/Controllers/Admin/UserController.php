<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchTerm = $request->query('search');
        if ($searchTerm) {
            $users = User::with('roles')
                ->where('username', 'LIKE', "%{$searchTerm}%")
                ->orWhere('email', 'LIKE', "%{$searchTerm}%")
                ->get();
            // $request->merge(['search' => null]);
            return response()->json($users);
        }

        // If there's no search term or it's not an AJAX request, retrieve all users
        $usersQuery = User::query();
        $users = $usersQuery->get();

        return view('admin.users.index', compact('users', 'searchTerm'));
    }


    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }
    public function ManageRoles(Request $request, $userId)
    {
        $request->validate([
            'role' => 'required|array',
            'role.*' => 'exists:roles,id',
        ]);
        $user = User::find($userId);
        $selectedRoles = $request->input('role');
        $user->roles()->sync($selectedRoles);

        return response()->json(["userRoles" => $user->roles]);
    }

    public function showManageRoles()
    {
        $users = User::all();
        $roles = Role::all();
        return view("admin.users.manage-users-roles", ['roles' => $roles, "users" => $users]);
    }
    public function import()
    {
        if (request()->hasFile('file')) {
            Excel::import(new UsersImport, request()->file('file'));
            return back()->with('status', 'Users imported successfully!');
        } else {
            return back()->with('status', 'Please select a file to import.');
        }
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required'],
            'address' => ['nullable', 'string', 'max:255'],
            'phoneNumber' => ['nullable', 'string', 'max:20'],
            'role' => ['required', 'array', 'exists:roles,id'],
        ]);
        if ($validator->fails()) {
            $firstError = $validator->errors()->first();
            return response()->json(['error' => $firstError], 422);
        }

        try {
            $user = User::create([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'address' => $request->input('address'),
                'phoneNumber' => $request->input('phoneNumber'),
            ]);

            // Attach roles to the user
            $user->roles()->sync($request->input('role'));

            return response()->json(["user" => $user, "userRoles" => $user->roles, "status" => "User created successfully"]);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $vehicles = $user->vehicles;
        return view('admin.users.show', compact('user', 'vehicles'));
    }
    public function getUser($userId)
    {
        // Retrieve the user data based on the user ID
        $user = User::findOrFail($userId);
        $roles = Role::all();
        $userRoles = $user->roles;

        // Return the user data in JSON format
        return response()->json(["user" => $user, "roles" => $roles, "userRoles" => $userRoles]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateById(Request $request, $userId)
    {
        $user = User::find($userId);

        $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $user->id],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'address' => ['nullable', 'string', 'max:255'],
            'phoneNumber' => ['nullable', 'string', 'max:20'],
            'role' => ['required', 'array', 'exists:roles,id'], // new validation rule
        ]);


        $user->update([
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'address' => $request->input('address'),
            'phoneNumber' => $request->input('phoneNumber'),
        ]);

        $user->roles()->sync($request->input('role', ["client"]));
        return redirect()->route('users')->with('status', 'User ' . $user->username . ' updated!');
    }
    public function update(Request $request, User $user)
    {
        $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $user->id],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'address' => ['nullable', 'string', 'max:255'],
            'phoneNumber' => ['nullable', 'string', 'max:20'],
            'role' => ['required', 'array', 'exists:roles,id'], // new validation rule
        ]);


        $user->update([
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'address' => $request->input('address'),
            'phoneNumber' => $request->input('phoneNumber'),
        ]);

        $user->roles()->sync($request->input('role', ["client"]));
        return redirect()->route('users')->with('status', 'User ' . $user->username . ' updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($userId)
    {
        $user = User::find($userId); // Retrieve the user by ID
        if ($user) {
            $user->delete(); // Delete the user
            return response()->json(["user" => $user, "status" => "User" . $user->username . "was deleted successfully"]);
        } else {
            // Handle case where user with given ID is not found
            return response()->json(['error' => 'User not found.'], 404);
        }
        // $user->delete();
        // return redirect()->route('users')->with('status', 'User ' . $user->username . ' deleted!');
    }
}
