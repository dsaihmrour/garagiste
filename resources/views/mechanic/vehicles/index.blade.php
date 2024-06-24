@extends('layouts.index')
@section('content')
    @component('client.components.location', [
        'title' => 'Vehicle to repair',
        'page' => 'Vehicles',
        'subpage' => '',
    ])
    @endcomponent
    <div class="card">
        <div class="card-body">
            <div class="d-lg-flex align-items-center mb-4 gap-3">
                @component('admin.components.search-bar', ['route' => route('mechanic.for.vehicles'), 'searchItem' => 'vehicle'])
                @endcomponent
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
                                        {{ $vehicle->user->username }}
                                    </td>
                                    <td>
                                        <a href="{{ route('mechanic.vehicle.details', ['vehicle' => $vehicle]) }}"
                                            class="btn btn-primary btn-sm radius-30 px-4">View Details</a>
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
            window.location.href =
                "{{ route('mechanic.for.vehicles') }}"; // Redirect to the same route to clear the search query
        }
    </script>
@endsection
