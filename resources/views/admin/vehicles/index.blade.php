@extends('layouts.index')
@section('content')

    @component('admin.components.break-crump', [
        'title' => 'Vehicle Management',
        'page' => 'Vehicles',
        'subpage' => '',
        'exportRoute' => route('vehicles.export'),
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
        @component('admin.modals.import-modal', ['importRoute' => route('vehicles.import'), 'title' => 'Vehicles'])
        @endcomponent
        <div class="card-body">
            @include('admin.vehicles.create')
            <div class="d-lg-flex align-items-center mb-4 gap-3">
                @component('admin.components.search-bar', ['route' => route('vehicles'), 'searchItem' => 'vehicle'])
                @endcomponent
                <div class="ms-auto">
                    <button type="button" class="btn btn-primary  radius-30 mt-2 mt-lg-0" data-bs-toggle="modal"
                        data-bs-target="#exampleLargeModal"><i class="bx bxs-plus-square"></i>Add New Vehicle
                    </button>
                </div>
            </div>
            @if (count($vehicles) > 0)
                <div class="table-responsive">
                    <table class="table mb-0" id="example">
                        <thead class="table-light">
                            <tr>
                                <th>Vehicle#</th>
                                <th>Make</th>
                                <th>Model</th>
                                <th>Fuel Type</th>
                                <th>Registration</th>
                                <th>Vehicle Owner</th>
                                <th>View Details</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehicles as $vehicle)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <input class="form-check-input me-3" type="checkbox" value=""
                                                    aria-label="...">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-0 font-14">{{ $vehicle->id }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $vehicle->make }}</td>
                                    <td>{{ $vehicle->model }}</td>
                                    <td>{{ $vehicle->fuelType }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="ms-2">
                                                <h6 class="mb-0 font-14">{{ $vehicle->registration }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td><a class="underline hover:text-blue-600"
                                            href="{{ route('user.details', ['user' => $vehicle->user]) }}">{{ $vehicle->user->username }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('vehicle.details', ['vehicle' => $vehicle]) }}"
                                            class="btn btn-primary btn-sm radius-30 px-4">View Details</a>
                                    </td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            <a href="{{ route('vehicles.edit', ['vehicle' => $vehicle]) }}"
                                                class=""><i class='bx bxs-edit'></i></a>
                                            <form method="POST"
                                                action="{{ route('vehicles.destroy', ['vehicle' => $vehicle]) }}"
                                                class="ms-3 d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $vehicle->id }}" class="btn p-0">
                                                    <i class="bx bxs-trash text-danger"></i>
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal{{ $vehicle->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel{{ $vehicle->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="exampleModalLabel{{ $vehicle->id }}">Modal title
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">Are you sure you want to delete this
                                                                vehicle?</div>
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
                    <div class="text-white">There are no vehicles!</div>
                </div>
            @endif
        </div>
    </div>
    <script>
        function clearSearch() {
            window.location.href = "{{ route('vehicles') }}"; // Redirect to the same route to clear the search query
        }
    </script>
@endsection
