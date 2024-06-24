@extends('layouts.index')
@section('content')
    @component('client.components.location', [
        'page' => 'Client Appointments',
        'subpage' => '',
        'title' => 'Appointments',
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
        @if (count($errors) > 0)
            @component('admin.components.danger-alert', ['errors' => $errors])
            @endcomponent
        @endif
        <div class="card-body">
            <div class="d-lg-flex align-itexportems-center mb-4 gap-3">
                @component('client.components.search-bar', [
                    'route' => route('client.appointments'),
                    'searchItem' => 'appointment',
                ])
                @endcomponent
                <div class="ms-auto">
                    <form action="{{ route('client.appointments') }}">
                        <select name="repair_status" id="repair_status" class="form-select" onchange="this.form.submit()">
                            <option value="">All Statuses</option>
                            <option value="pending" {{ request()->repair_status == 'pending' ? 'selected' : '' }}>Pending
                            </option>
                            <option value="confirmed" {{ request()->repair_status == 'confirmed' ? 'selected' : '' }}>
                                Confirmed</option>
                            <option value="in_progress" {{ request()->repair_status == 'in_progress' ? 'selected' : '' }}>In
                                Progress</option>
                            <option value="completed" {{ request()->repair_status == 'completed' ? 'selected' : '' }}>
                                Completed</option>
                            <option value="canceled" {{ request()->repair_status == 'canceled' ? 'selected' : '' }}>Canceled
                            </option>
                            <option value="rescheduled" {{ request()->repair_status == 'rescheduled' ? 'selected' : '' }}>
                                Rescheduled</option>
                        </select>
                    </form>
                </div>

                <div class="ms-auto">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#appointmentModal">
                        Make an Appointment
                    </button>
                </div>
                @include('client.appointments.create')
            </div>
            @if (count($appointments) > 0)
                <div class="table-responsive">
                    <table class="table mb-0" id="example">
                        <thead class="table-light">
                            <tr>
                                <th>Apointment#</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointments as $a)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <input class="form-check-input me-3" type="checkbox" value=""
                                                    aria-label="...">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-0 font-14">{{ $a->id }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $a->title }} </td>
                                    <td>{{ $a->status }}</td>
                                    <td>
                                        {{ $a->start_datetime }}
                                    </td>
                                    <td>{{ $a->end_datetime }}</td>

                                    <td>
                                        <div class="d-flex order-actions">
                                            @if ($a->status == 'pending')
                                                <button title="Edit" class="btn btn-secondary btn-sm radius-30 edit-btn"
                                                    data-bs-toggle="modal" data-bs-target="#editModal"
                                                    data-appointment-id="{{ $a->id }}"><i
                                                        class='bx bxs-edit'></i></button>
                                                <form
                                                    action="{{ route('client.appointments.cancel', ['appointmentId' => $a->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button title="Cancel" type="submit"
                                                        class="btn btn-danger btn-sm radius-30"><i
                                                            class='bx bx-x-circle'></i>
                                                    </button>
                                                </form>
                                            @endif
                                            @if ($a->status == 'pending' || $a->status == 'canceled')
                                                <button title="Delete" class="btn btn-danger btn-sm radius-30"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                    onclick="setDeleteFormAction('{{ route('client.appointments.destroy', ['appointment' => $a]) }}')">
                                                    <i class='bx bx-trash'></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @include('client.appointments.edit')
                            @include('client.modals.delete-appointment')
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-primary border-0 bg-primary alert-dismissible fade show">
                    <div class="text-white">There are no appointments!</div>
                </div>
            @endif
        </div>
        <script>
            function setDeleteFormAction(action) {
                const deleteForm = document.getElementById('deleteForm');
                deleteForm.action = action;
            }
        </script>
    @endsection
