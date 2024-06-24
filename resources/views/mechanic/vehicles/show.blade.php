@extends('layouts.index')
@section('content')
    @component('client.components.location', [
        'title' => 'Vehicle Management',
        'page' => 'Vehicle Detail',
        'subpage' => '',
    ])
    @endcomponent
    <div class="card">
        <div class="row g-0">
            <div class="col-md-4 border-end">
                @if (!empty($vehicle->photos))
                    <img src="{{ asset('storage/' . $vehicle->photos[0]) }}" class="img-fluid" alt="...">
                    <div class="row mb-3 row-cols-auto g-2 justify-content-center mt-3">
                        @for ($i = 0; $i < 5; $i++)
                            @if ($i == 0)
                                @continue
                            @else
                                @if (isset($vehicle->photos[$i]))
                                    <div class="col"><img src="{{ asset('storage/' . $vehicle->photos[$i]) }}"
                                            width="70" class="border rounded cursor-pointer" alt=""></div>
                                @else
                                    <div class="col"><img src="{{ asset('assets/images/products/13.png') }}"
                                            width="70" class="border rounded cursor-pointer" alt=""></div>
                                @endif
                            @endif
                        @endfor
                    </div>
                @else
                    <img src="{{ asset('assets/images/products/13.png') }}" class="img-fluid" alt="...">
                    <div class="row mb-3 row-cols-auto g-2 justify-content-center mt-3">
                        <div class="col"><img src="{{ asset('assets/images/products/12.png') }}" width="70"
                                class="border rounded cursor-pointer" alt=""></div>
                        <div class="col"><img src="{{ asset('assets/images/products/11.png') }}" width="70"
                                class="border rounded cursor-pointer" alt=""></div>
                        <div class="col"><img src="{{ asset('assets/images/products/14.png') }}" width="70"
                                class="border rounded cursor-pointer" alt=""></div>
                        <div class="col"><img src="{{ asset('assets/images/products/15.png') }}" width="70"
                                class="border rounded cursor-pointer" alt=""></div>
                    </div>
                @endif
            </div>
            <div class="col-md-8 ">
                <div class="card-body">
                    <h4 class="card-title">{{ $vehicle->model }}</h4>
                    <div class="d-flex gap-3 py-3">
                        <div>{{ count($vehicle->repairs) }} repairs</div>
                        <div class="text-success"><i class='bx bxs-cart-alt align-middle'></i>
                            {{ $vehicle->repairs->filter(function ($repair) {
                                    return $repair->status === 'completed';
                                })->count() }}
                            repairs completed
                        </div>
                    </div>
                    <div class="mb-3">
                        <span class="price h4">{{ $vehicle->registration }}</span>
                    </div>

                    <dl class="row">
                        <dt class="col-sm-3">Registration#</dt>
                        <dd class="col-sm-9">{{ $vehicle->registration }}</dd>

                        <dt class="col-sm-3">Make</dt>
                        <dd class="col-sm-9">{{ $vehicle->make }}</dd>

                        <dt class="col-sm-3">Model</dt>
                        <dd class="col-sm-9">{{ $vehicle->model }}</dd>
                        <dt class="col-sm-3">Fuel Type</dt>
                        <dd class="col-sm-9">{{ $vehicle->fuelType }}</dd>
                    </dl>
                    <hr>
                    <div class="row row-cols-auto row-cols-1 row-cols-md-3 align-items-center">
                        <div class="col">
                            <div class="col">
                                <strong>Owner: </strong> {{ $vehicle->user->firstName }} {{ $vehicle->user->lastName }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-body ">
                    <h1>Vehicle Repairs</h1>
                    <div class="table-responsive mt-3">
                        @if ($vehicle->repairs->count() > 0)
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Reapair#</th>
                                        <th>Description</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Mechanic</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($repairs as $r)
                                        <tr>
                                            <td>{{ $r->id }}</td>
                                            <td
                                                style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                <span class="description"
                                                    onclick="toggleDescription(this)">{{ $r->description }}</span>
                                            </td>
                                            <td>{{ $r->startDate }}</td>
                                            <td>{{ $r->endDate }}</td>
                                            <td>{{ $r->mechanic->username ?? 'Not Assigned' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-primary border-0 bg-primary alert-dismissible fade show">
                                <div class="text-white">Vehicle has no repairs</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <script>
                function toggleDescription(element) {
                    if (element.classList.contains('expanded')) {
                        element.classList.remove('expanded');
                    } else {
                        element.classList.add('expanded');
                    }
                }
            </script>
        </div>
    @endsection
