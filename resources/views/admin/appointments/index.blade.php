@extends('layouts.index')
@section('content')
    @component('client.components.location', [
        'page' => 'Appointments',
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
                    'route' => route('appointments'),
                    'searchItem' => 'appointment',
                ])
                @endcomponent
                <div class="ms-auto">
                    <form action="{{ route('appointments') }}">
                        <select name="repair_status" id="repair_status" class="form-select" onchange="this.form.submit()">
                            <option value="">{{ __('All Statuses') }}</option>
                            <option value="pending" {{ request()->repair_status == 'pending' ? 'selected' : '' }}>
                                {{ __('Pending') }}</option>
                            <option value="confirmed" {{ request()->repair_status == 'confirmed' ? 'selected' : '' }}>
                                {{ __('Confirmed') }}</option>
                            <option value="in_progress" {{ request()->repair_status == 'in_progress' ? 'selected' : '' }}>
                                {{ __('In Progress') }}</option>
                            <option value="completed" {{ request()->repair_status == 'completed' ? 'selected' : '' }}>
                                {{ __('Completed') }}</option>
                            <option value="canceled" {{ request()->repair_status == 'canceled' ? 'selected' : '' }}>
                                {{ __('Canceled') }}</option>
                            <option value="rescheduled" {{ request()->repair_status == 'rescheduled' ? 'selected' : '' }}>
                                {{ __('Rescheduled') }}</option>
                        </select>
                    </form>
                </div>

            </div>
            @if (count($appointments) > 0)
                <div class="table-responsive">
                    <table class="table mb-0" id="example">
                        <thead class="table-light">
                            <tr>
                                <th>{{ __('Appointment#') }}</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Start Date') }}</th>
                                <th>{{ __('End Date') }}</th>
                                <th>{{ __('Actions') }}</th>
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
                                    <td><a href="{{ route('appointment.details', ['appointment' => $a]) }}">{{ $a->title }}
                                        </a></td>
                                    <td>{{ $a->status }}</td>
                                    <td>
                                        {{ $a->start_datetime }}
                                    </td>
                                    <td>{{ $a->end_datetime }}</td>

                                    <td>
                                        <div class="d-flex order-actions">
                                            <button title="Edit" class="btn btn-secondary btn-sm radius-30 edit-btn"
                                                data-bs-toggle="modal" data-bs-target="#editModal"
                                                data-appointment-id="{{ $a->id }}"><i
                                                    class='bx bxs-edit'></i></button>
                                            <form action="{{ route('appointment.cancel', ['appointmentId' => $a->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('PUT')
                                                <button title="Cancel" type="submit"
                                                    class="btn btn-danger btn-sm radius-30"><i class='bx bx-x-circle'></i>
                                                </button>
                                            </form>
                                            <button title="Delete" class="btn btn-danger btn-sm radius-30"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                onclick="setDeleteFormAction('{{ route('appointments.destroy', ['appointment' => $a]) }}')">
                                                <i class='bx bx-trash'></i>
                                            </button>
                                            <button onclick="selectMechanic({{ $a->id }})" title="Confirm"
                                                data-bs-toggle="modal" data-bs-target="#selectMechanicModal"
                                                class="btn btn-info btn-sm radius-30"><i class='bx bx-check'></i>
                                            </button>
                                            <form action="{{ route('notify.client', ['appointment' => $a]) }}"
                                                method="post">
                                                @csrf
                                                <button title="Notiify the client" type="submit" class="btn btn-primary"><i
                                                        class="bx bx-bell"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @include('admin.modals.select-mechanic')
                            @include('admin.appointments.edit')
                            @include('client.modals.delete-appointment')
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-primary border-0 bg-primary alert-dismissible fade show">
                    <div class="text-white">{{ __('There are no appointments!') }}</div>
                </div>
            @endif
        </div>
        <script>
            function selectMechanic(id) {
                const confirmForm = document.getElementById('confirmForm');
                confirmForm.action = `/admin/appointments/${id}/confirm`;
            }

            function setDeleteFormAction(action) {
                const deleteForm = document.getElementById('deleteForm');
                deleteForm.action = action;
            }
        </script>
    @endsection
