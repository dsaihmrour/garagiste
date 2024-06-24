@extends('layouts.index')
@section('content')
    @component('client.components.location', ['page' => 'Client Vehicles', 'subpage' => '', 'title' => 'Vechicles'])
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
                @include('client.vehicles.create')
                <div class="d-lg-flex align-items-center mb-4 gap-3">
                    @component('client.components.search-bar', ['route' => route('client.vehicles'), 'searchItem' => 'vehicle'])
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
                                        <td>
                                            <a href="{{ route('client.vehicle.details', ['vehicle' => $vehicle]) }}"
                                                class="btn btn-primary btn-sm radius-30 px-4">View Details</a>
                                        </td>
                                        <td>
                                            <div class="d-flex order-actions">
                                                <a href="{{ route('client.vehicles.edit', ['vehicle' => $vehicle]) }}"
                                                    class=""><i class='bx bxs-edit'></i></a>
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
                window.location.href = "{{ route('client.vehicles') }}"; // Redirect to the same route to clear the search query
            }
        </script>
    @endsection
