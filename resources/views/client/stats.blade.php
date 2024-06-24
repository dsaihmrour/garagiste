@extends('layouts.index')
@section('content')
    <div class="row row-cols-1 row-cols-md-2 row-cols-xxl-4">
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Your vehicles</p>
                            <h4 class="my-1">{{ $vehiclesCount }}</h4>
                            @if ($vehiclesPercentage < 0)
                                <p class="mb-0 font-13 text-danger"><i
                                        class="bx bxs-arrow-down align-middle"></i>{{ $vehiclesPercentage }}% from last week
                                </p>
                            @else
                                <p class="mb-0 font-13 text-success"><i
                                        class="bx bxs-arrow-up align-middle"></i>{{ $vehiclesPercentage }}% from last week
                                </p>
                            @endif
                        </div>
                        <div
                            class="widgets-icons bg-light-{{ $vehiclesPercentage < 0 ? 'danger' : 'success' }} text-{{ $vehiclesPercentage < 0 ? 'danger' : 'success' }} ms-auto">
                            <i class='bx bx-car'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Repairs</p>
                            <h4 class="my-1">{{ $repairsCount }}</h4>
                            <p class="mb-0 font-13 text-{{ $repairsPercentage < 0 ? 'danger' : 'success' }}"><i
                                    class="bx bxs-{{ $repairsPercentage < 0 ? 'down-arrow' : 'arrow-up' }} align-middle"></i>{{ $repairsPercentage }}%
                                from last
                                week</p>
                        </div>
                        <div
                            class="widgets-icons bg-light-{{ $repairsPercentage < 0 ? 'info' : 'success' }} text-{{ $repairsPercentage < 0 ? 'info' : 'success' }} ms-auto">
                            <i class="bx bxs-group"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total invoices</p>
                            <h4 class="my-1">{{ $invoicesCount }}</h4>
                            <p class="mb-0 font-13 text-{{ $invoicesPercentage < 0 ? 'danger' : 'success' }}"><i
                                    class="bx bxs-{{ $invoicesPercentage < 0 ? 'down-arrow' : 'arrow-up' }} align-middle"></i>{{ $invoicesPercentage }}%
                                from last
                                week</p>
                        </div>
                        <div
                            class="widgets-icons bg-light-{{ $invoicesPercentage < 0 ? 'danger' : 'success' }} text-{{ $invoicesPercentage < 0 ? 'danger' : 'success' }} ms-auto">
                            <i class="bx bxs-binoculars"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Appointements</p>
                            <h4 class="my-1">24.6%</h4>
                            <p class="mb-0 font-13 text-danger"><i class="bx bxs-down-arrow align-middle"></i>12.2% from
                                last week</p>
                        </div>
                        <div class="widgets-icons bg-light-warning text-warning ms-auto"><i
                                class="bx bx-line-chart-down"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end row-->
@endsection
