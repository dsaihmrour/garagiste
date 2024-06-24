@extends('layouts.index')
@section('content')
    <section class="my-6">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('User Details') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Basic information about the user.') }}
        </p>

        <table class="table mt-6 space-y-6">
            <tr>
                <th>ID:</th>
                <td>{{ $user->id }}</td>
            </tr>
            <tr>
                <th>First Name:</th>
                <td>{{ $user->firstName }}</td>
            </tr>
            <tr>
                <th>Last Name:</th>
                <td>{{ $user->lastName }}</td>
            </tr>
            <tr>
                <th>Username:</th>
                <td>{{ $user->username }}</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Address:</th>
                <td>{{ $user->address }}</td>
            </tr>
            <tr>
                <th>Phone Number:</th>
                <td>{{ $user->phoneNumber }}</td>
            </tr>
            <tr>
                <th>Roles:</th>
                <td>{{ implode(', ', $user->roles()->pluck('name')->toArray()) }}</td>
            </tr>
        </table>
    </section>
    @component('admin.components.vehicles', ['vehicles' => $vehicles])
    @endcomponent
@endsection
