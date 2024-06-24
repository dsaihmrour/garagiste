@extends('layouts.index')

@section('content')

    @component('client.components.location', [
        'page' => 'Appointments',
        'subpage' => '',
        'title' => 'Appointment Details',
    ])
    @endcomponent
    @if (!empty(session('status')))
        @component('admin.components.seccuss-alert', [
            'title' => __('Success Alerts'),
            'subTitle' => session('status'),
        ])
        @endcomponent
    @endif
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>{{ __('Appointment Details') }}</h4>
            </div>
            <div class="card-body">
                <p><strong>{{ __('Id#') }}:</strong> {{ $appointment->id }}</p>
                <p><strong>{{ __('Title') }}:</strong> {{ $appointment->title }}</p>
                <p><strong>{{ __('Description') }}:</strong> {{ $appointment->description }}</p>
                <p><strong>{{ __('Start Date') }}:</strong> {{ $appointment->start_datetime }}</p>
                <p><strong>{{ __('End Date') }}:</strong> {{ $appointment->end_datetime }}</p>
                <p><strong>{{ __('Client username') }}:</strong> {{ $appointment->user->email }}</p>
                <p><strong>{{ __('Client email') }}:</strong> {{ $appointment->user->email }}</p>
                <p><strong>{{ __('Client phone') }}:</strong> {{ $appointment->user->phoneNumber }}</p>
                @if ($appointment->mechanic)
                    <p><strong>{{ __('Mechanic') }}:</strong> {{ $appointment->mechanic->username }}</p>
                @else
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <p><strong>{{ __('Mechanic') }}:</strong> {{ __('N/A') }}</p>
                        <button title="{{ __('Assign') }}" data-bs-toggle="modal" data-bs-target="#selectMechanicModal"
                            onclick="selectMechanic({{ $appointment->id }})"
                            class="btn btn-sm btn-primary">{{ __('Assign') }}</button>
                    </div>
                @endif
                <p><strong>{{ __('Vehicle') }}:</strong> {{ $appointment->vehicle->registration }}</p>
                <p><strong>{{ __('Status') }}:</strong> {{ $appointment->status }}</p>
            </div>
        </div>

    </div>
    @include('admin.modals.select-mechanic')
    <script>
        function selectMechanic(id) {
            const confirmForm = document.getElementById('confirmForm');
            confirmForm.action = '/admin/appointments/' + id + '/assign';
        }
    </script>
@endsection
