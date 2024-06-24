@extends('layouts.index')
@section('content')
    <div class="row row-cols-1 row-cols-lg-4">
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-start gap-3">
                        <div class="widgets-icons-3 bg-gradient-deepblue text-white">
                            <i class='bx bx-wallet'></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between mb-2 w-100">
                                <p class="mb-0">{{ __('Total Invoices') }}</p>
                                <div class="">
                                    <span
                                        class="badge bg-light-success d-flex justify-content-between text-success rounded-5 border-success border">+
                                        2.4%</span>
                                </div>
                            </div>
                            <h2 class="mb-0">{{ $invoicesCount }}</h2>
                            <p class="mb-0">{{ $latestInvoices }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-start gap-3">
                        <div class="widgets-icons-3 bg-gradient-purple text-white">
                            <i class='bx bx-group'></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between mb-2 w-100">
                                <p class="mb-0">{{ __('New Customers') }}</p>
                                <div class="">
                                    <span
                                        class="badge bg-light-danger d-flex justify-content-between text-danger rounded-5 border-danger border border-opacity-25">+
                                        2.4%</span>
                                </div>
                            </div>
                            <h2 class="mb-0">{{ $usersCount }}</h2>
                            <p class="mb-0">{{ $latestUsers }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-start gap-3">
                        <div class="widgets-icons-3 bg-gradient-ibiza text-white">
                            <i class='bx bx-shopping-bag'></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between mb-2 w-100">
                                <p class="mb-0">{{ __('Total Repairs') }}</p>
                                <div class="">
                                    <span
                                        class="badge bg-light-success d-flex justify-content-between text-success rounded-5 border-success border">+
                                        2.4%</span>
                                </div>
                            </div>
                            <h2 class="mb-0">{{ $repairsCount }}</h2>
                            <p class="mb-0">{{ $latestRepairs }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-start gap-3">
                        <div class="widgets-icons-3 bg-gradient-success text-white">
                            <i class='bx bx-wallet'></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between mb-2 w-100">
                                <p class="mb-0">{{ __('Total Vehicles') }}</p>
                                <div class="">
                                    <span
                                        class="badge bg-light-danger d-flex justify-content-between text-danger rounded-5 border-danger border border-opacity-25">+
                                        2.4%</span>
                                </div>
                            </div>
                            <h2 class="mb-0">{{ $vehiclesCount }}</h2>
                            <p class="mb-0">{{ $latestVehicles }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->
    <div class="row row-cols-1 row-cols-lg-2">
        <div class="col mb-4">
            <div class="card radius-10" style="height: auto">
                <div class="card-body">
                    <canvas id="areaChartRepairs"></canvas>
                    <select id="chartTypeRepairs" class="form-select mt-3">
                        <option value="line">{{ __('Line') }}</option>
                        <option value="bar">{{ __('Bar') }}</option>
                        <!-- Add more chart types as needed -->
                    </select>
                </div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card radius-10">
                <div class="card-body" style="height: auto">
                    <canvas id="areaChartVehicles"></canvas>
                    <select id="chartTypeVehicles" class="form-select mt-3">
                        <option value="bar">{{ __('Bar') }}</option>
                        <option value="pie">{{ __('Pie') }}</option>
                        <!-- Add more chart types as needed -->
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card radius-10" style="height: auto">
                    <div class="card-body">
                        <canvas id="areaChartUsers"></canvas>
                        <select id="chartTypeUsers" class="form-select mt-3">
                            <option value="pie">{{ __('Pie') }}</option>
                            <option value="line">{{ __('Line') }}</option>
                            <!-- Add more chart types as needed -->
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        var ctx1 = document.getElementById('areaChartRepairs').getContext('2d');
        var myChart1 = createChart(ctx1, 'line', @json($repairdata['labels']), @json($repairdata['data']));

        var ctx2 = document.getElementById('areaChartUsers').getContext('2d');
        var myChart2 = createChart(ctx2, 'pie', @json($userdata['labels']), @json($userdata['data']));

        var ctx3 = document.getElementById('areaChartVehicles').getContext('2d');
        var myChart3 = createChart(ctx3, 'bar', @json($vehicledata['labels']), @json($vehicledata['data']));

        function createChart(ctx, chartType, labels, data) {
            return new Chart(ctx, {
                type: chartType,
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Chart Data',
                        data: data,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1,
                        fill: true
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Event listeners for chart type selection
        document.getElementById('chartTypeRepairs').addEventListener('change', function() {
            myChart1.destroy();
            myChart1 = createChart(ctx1, this.value, @json($repairdata['labels']), @json($repairdata['data']));
        });

        document.getElementById('chartTypeUsers').addEventListener('change', function() {
            myChart2.destroy();
            myChart2 = createChart(ctx2, this.value, @json($userdata['labels']), @json($userdata['data']));
        });

        document.getElementById('chartTypeVehicles').addEventListener('change', function() {
            myChart3.destroy();
            myChart3 = createChart(ctx3, this.value, @json($vehicledata['labels']), @json($vehicledata['data']));
        });
    </script>
@endsection
