@extends('layouts.index')
@section('content')
    @component('admin.components.break-crump', [
        'title' => 'User Management',
        'page' => 'Users',
        'subpage' => '',
        'exportRoute' => route('users.export'),
    ])
    @endcomponent
    @component('admin.modals.import-modal', ['importRoute' => route('users.import'), 'title' => 'Users'])
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
                @component('admin.components.search-bar', ['route' => route('users'), 'searchItem' => 'user'])
                @endcomponent
                <div class="ms-auto">
                    <button data-bs-toggle="modal" data-bs-target="#exampleScrollableModal1"
                        class="btn btn-primary radius-30 mt-2 mt-lg-0"><i
                            class="bx bxs-plus-square"></i>{{ __('Add New User') }}</button>
                </div>
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
                                <th>View Details</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="userTableBody">
                            @foreach ($users as $user)
                                <tr id="row{{ $user->id }}">
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
                                    <td>

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
                                        <a href="{{ route('user.details', ['user' => $user]) }}"
                                            class="btn btn-primary btn-sm radius-30 px-4">{{ __('View Details') }}</a>
                                    </td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            <button data-bs-toggle="modal" data-bs-target="#exampleScrollableModal"
                                                data-user-id="{{ $user->id }}" class="btn btn-warning edit-btn">
                                                <i class='bx bxs-edit'></i>
                                            </button>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                onclick="setDeleteFormAction('/admin/users/{{ $user->id }}')"
                                                class="btn p-0 ms-3 d-inline">
                                                <i class="bx bxs-trash text-danger"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @component('admin.modals.delete-modal', ['item' => 'user', 'title' => 'Delete User'])
                    @endcomponent
                    @include('admin.modals.edit-user-modal')
                    @include('admin.modals.create-user-modal')
                </div>
            @else
                <div class="alert alert-primary border-0 bg-primary alert-dismissible fade show">
                    <div class="text-white">{{ __('There are no users') }}!</div>
                </div>
            @endif
            <script>
                document.getElementById('searchForm').addEventListener('submit', async (e) => {
                    e.preventDefault();
                    const searchInput = document.getElementById('searchInput').value;

                    try {
                        const response = await fetch(`/admin/users?search=${searchInput}`);
                        const users = await response.json();
                        renderUsers(users);
                        document.getElementById('searchInput').value = ""
                    } catch (error) {
                        console.error('Error fetching users:', error);
                    }
                });

                function renderUsers(users) {
                    const tableBody = document.getElementById('userTableBody');
                    tableBody.innerHTML = '';

                    users.forEach(user => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = '<td>' +
                            '<div class="d-flex align-items-center">' +
                            '<div>' +
                            '<input class="form-check-input me-3" type="checkbox" value="" aria-label="...">' +
                            '</div>' +
                            '<div class="ms-2">' +
                            '<h6 class="mb-0 font-14">' + user.id + '</h6>' +
                            '</div>' +
                            '</div>' +
                            '</td>' +
                            '<td>' + user.username + '</td>' +
                            '<td>' + user.email + '</td>' +
                            '<td>' + user.address + '</td>' +
                            '<td>';

                        if (user.roles && user.roles.length > 0) {
                            tr.innerHTML += user.roles.map(role => {
                                const color = {
                                    1: '#3b5998',
                                    2: '#3c8dbc',
                                    3: '#f56954',
                                } [role.id] || '#0073b7';
                                return '<span style="color: ' + color + '">' + role.name + ', </span>';
                            }).join('');
                        }

                        tr.innerHTML += '</td>' +
                            '<td>' +
                            '<a href="' + user.detailsRoute +
                            '" class="btn btn-primary btn-sm radius-30 px-4">View Details</a>' +
                            '</td>' +
                            '<td>' +
                            '<div class="d-flex order-actions">' +
                            '<button data-bs-toggle="modal" data-bs-target="#exampleScrollableModal" data-user-id="' + user
                            .id + '" class="btn btn-primary edit-btn">' +
                            '<i class="bx bxs-edit"></i>' +
                            '</button>' +
                            '<button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="setDeleteFormAction(\'' +
                            user.destroyRoute + '\')" class="btn p-0 ms-3 d-inline">' +
                            '<i class="bx bxs-trash text-danger"></i>' +
                            '</button>' +
                            '</div>' +
                            '</td>';
                        tableBody.appendChild(tr);
                    });
                }
            </script>

        </div>
    </div>

@endsection
