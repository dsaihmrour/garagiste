@extends('layouts.index')
@section('content')

    @component('client.components.location', [
        'title' => 'Invoice Management',
        'page' => 'Invoices',
        'subpage' => '',
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
            <div class="d-lg-flex align-items-center mb-4 gap-3">
                @component('admin.components.search-bar', ['route' => route('invoices'), 'searchItem' => 'Invoice'])
                @endcomponent
            </div>
            @if (count($invoices) > 0)
                <div class="table-responsive">
                    <table class="table mb-0" id="example">
                        <thead class="table-light">
                            <tr>
                                <th>Invoice#</th>
                                <th>Number of repairs</th>
                                <th>Total amount</th>
                                <th>Additionnal Charges</th>
                                <th>Due Date</th>
                                <th>View Details</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoices as $invoice)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <input class="form-check-input me-3" type="checkbox" value=""
                                                    aria-label="...">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-0 font-14">{{ $invoice->id }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ count($invoice->repairs) }}</td>
                                    <td>{{ $invoice->totalAmount }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="ms-2">
                                                <h6 class="mb-0 font-14">{{ $invoice->additionalCharges }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $invoice->dueDate }}</td>
                                    <td>
                                        <a href="{{ route('client.invoice.show', ['invoiceId' => $invoice->id]) }}"
                                            class="btn btn-primary btn-sm radius-30 px-4">View Details</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('client.invoice.pay', ['invoiceId' => $invoice->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-info btn-sm radius-30 px-4">Pay</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-primary border-0 bg-primary alert-dismissible fade show">
                    <div class="text-white">There are no Invoices!</div>
                </div>
            @endif
        </div>
    @endsection
