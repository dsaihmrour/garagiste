@extends('layouts.index')
@section('content')
    @component('admin.components.break-crump', [
        'title' => 'User Management',
        'page' => 'Users',
        'subpage' => 'Mechanics',
        'exportRoute' => route('users.export'),
    ])
    @endcomponent
    @component('admin.modals.import-modal', ['importRoute' => route('users.import'), 'title' => 'Mechanics'])
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
                @component('admin.components.search-bar', ['route' => route('mechanics'), 'searchItem' => 'mechanic'])
                @endcomponent
                <div class="ms-auto">
                    <a href="{{ route('users.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i
                            class="bx bxs-plus-square"></i>Add New
                        Mechnic</a>
                </div>
            </div>
            @if (count($mechanics) > 0)
                <div class="table-responsive">
                    <table class="table mb-0" id="example">
                        <thead class="table-light">
                            <tr>
                                <th>Mechanic#</th>
                                <th>Username</th>
                                <th>Number of repairs</th>
                                <th>Email</th>
                                <th>View Repairs</th>
                                <th>View Details</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mechanics as $mechanic)
                                <tr id="row{{ $mechanic->id }}">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <input class="form-check-input me-3" type="checkbox" value=""
                                                    aria-label="...">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-0 font-14">{{ $mechanic->id }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $mechanic->username }}</td>
                                    <td>{{ count($mechanic->repairs) }}</td>
                                    <td>{{ $mechanic->email }}</td>
                                    <td>
                                        <a href="{{ route('mechanic.repairs', ['mechanic' => $mechanic]) }}"
                                            class="btn btn-info btn-sm radius-30 px-4">View</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('user.details', ['user' => $mechanic]) }}"
                                            class="btn btn-primary btn-sm radius-30 px-4">View</a>
                                    </td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            <button data-bs-toggle="modal" data-bs-target="#exampleScrollableModal"
                                                data-user-id="{{ $mechanic->id }}" class="btn btn-warning edit-btn">
                                                <i class='bx bxs-edit'></i>
                                            </button>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                onclick="setDeleteFormAction('/admin/users/{{ $mechanic->id }}')"
                                                class="btn p-0 ms-3 d-inline">
                                                <i class="bx bxs-trash text-danger"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @component('admin.modals.delete-modal', ['item' => 'mechanic', 'title' => 'Deelete mechanic'])
                            @endcomponent
                            @include('admin.modals.edit-user-modal')
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-primary border-0 bg-primary alert-dismissible fade show">
                    <div class="text-white">There are no mechanics!</div>
                </div>
            @endif
        </div>
    </div>
@endsection
