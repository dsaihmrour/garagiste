@extends('layouts.index')
@section('content')
    @component('client.components.location', [
        'title' => 'User Management',
        'page' => 'Users',
        'subpage' => 'Manage Roles',
    ])
    @endcomponent
    <div class="card">
        @if (!empty(session('status')))
            @component('admin.components.seccuss-alert', [
                'title' => __('Success Alerts'),
                'subTitle' => session('status'),
            ])
            @endcomponent
        @endif
        <div class="card-body">
            <div class="d-lg-flex align-items-center mb-4 gap-3">

            </div>
            @if (count($users) > 0)
                <div class="table-responsive">
                    <table class="table mb-0" id="example">
                        <thead class="table-light">
                            <tr>
                                <th>User#</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="userTableBody">
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <input class="form-check-input me-3" type="checkbox" value=""
                                                    aria-label="...">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-0 font-14">{{ $user->id }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td id="rolesContainer">
                                        @foreach ($user->roles as $role)
                                            @php
                                                $color = match ($role->id) {
                                                    1 => '#3b5998',
                                                    2 => '#3c8dbc',
                                                    3 => '#f56954',
                                                    default => '#0073b7',
                                            }; @endphp
                                            <span style="color: {{ $color }}">{{ $role->name }}, </span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                onclick="showManageRoles({{ $user->id }})"
                                                class="btn btn-primary btn-sm radius-30 px-4">
                                                Manage user roles
                                            </button>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @include('admin.modals.manage-roles-modal')
                </div>
            @else
                <div class="alert alert-primary border-0 bg-primary alert-dismissible fade show">
                    <div class="text-white">{{ __('There are no users') }}!</div>
                </div>
            @endif
        </div>
    </div>
    <script>
        const showManageRoles = (id) => {
            // $("#wantedUser").val(id)
            document.getElementById("updateForm").action = `/admin/users/manageRoles/${id}`
        }
    </script>
@endsection
