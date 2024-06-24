@extends('layouts.index')
@section('content')
    @component('client.components.location', ['page' => 'Repairs to do', 'subpage' => '', 'title' => 'Repairs'])
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
                @component('client.components.search-bar', ['route' => route('mechanic.for.repairs'), 'searchItem' => 'repair'])
                @endcomponent
                <div class="ms-auto">
                    <form action="{{ route('mechanic.for.repairs') }}">
                        <select name="repair_status" id="repair_status" class="form-select" onchange="this.form.submit()">
                            <option value="">All Statuses</option>
                            <option value="pending" {{ request()->repair_status == 'pending' ? 'selected' : '' }}>Pending
                            </option>
                            <option value="completed" {{ request()->repair_status == 'completed' ? 'selected' : '' }}>
                                Completed
                            </option>
                        </select>
                    </form>
                </div>
                <div class="ms-auto">
                    <a href="{{ route('mechanic.repairs.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i
                            class="bx bxs-plus-square"></i>Add New
                        Repair</a>
                </div>
            </div>
            @if (count($repairs) > 0)
                <div class="table-responsive">
                    <table class="table mb-0" id="example">
                        <thead class="table-light">
                            <tr>
                                <th>Repair#</th>
                                <th>Vehicle to repair</th>
                                <th>Owner</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>View Details</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($repairs as $repair)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <input class="form-check-input me-3" type="checkbox" value=""
                                                    aria-label="...">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-0 font-14">{{ $repair->id }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $repair->vehicle->registration }}</td>
                                    <td>{{ $repair->vehicle->user->username }}</td>
                                    <td>{{ $repair->title }} </td>
                                    <td>{{ $repair->status }}</td>
                                    <td>
                                        {{ $repair->startDate }}
                                    </td>
                                    <td>{{ $repair->endDate }}</td>
                                    <td>
                                        <a href="{{ route('mechanic.repair.details', ['repair' => $repair]) }}"
                                            class="btn btn-primary btn-sm radius-30 px-4">View Details</a>
                                    </td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            <a href="{{ route('mechanic.repairs.edit', ['repair' => $repair]) }}"
                                                class=""><i class='bx bxs-edit'></i></a>
                                            <form method="POST"
                                                action="{{ route('mechanic.repairs.destroy', ['repair' => $repair]) }}"
                                                class="ms-3 d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $repair->id }}" class="btn p-0">
                                                    <i class="bx bxs-trash text-danger"></i>
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal{{ $repair->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel{{ $repair->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="exampleModalLabel{{ $repair->id }}">Delete Repair
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">Are you sure you want to delete this
                                                                repair?</div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">delete</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-primary border-0 bg-primary alert-dismissible fade show">
                    <div class="text-white">There are no repairs!</div>
                </div>
            @endif
        </div>
    @endsection
