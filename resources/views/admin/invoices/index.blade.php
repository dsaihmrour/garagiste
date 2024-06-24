@extends('layouts.index')
@section('content')

    @component('admin.components.break-crump', [
        'title' => 'Invoice Management',
        'page' => 'Invoices',
        'subpage' => '',
        'exportRoute' => route('invoices.export'),
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
        @component('admin.modals.import-modal', ['importRoute' => route('invoices.import'), 'title' => 'Invoices'])
        @endcomponent
        <div class="card-body">
            <div class="d-lg-flex align-items-center mb-4 gap-3">
                @component('admin.components.search-bar', ['route' => route('invoices'), 'searchItem' => 'Invoice'])
                @endcomponent
                <div class="ms-auto">
                    <button data-bs-toggle="modal" data-bs-target="#exampleLargeModal"
                        class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i>Add New
                        Invoice</button>
                </div>
            </div>
            @if (count($invoices) > 0)
                <div class="table-responsive">
                    <table class="table mb-0" id="example">
                        <thead class="table-light">
                            <tr>
                                <th>Invoice#</th>
                                <th>Client</th>
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
                                    <td>{{ $invoice->user_id }} </td>
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
                                        <a href="{{ route('invoice.details', ['invoice' => $invoice->id]) }}"
                                            class="btn btn-primary btn-sm radius-30 px-4">View Details</a>
                                    </td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            <a href="{{ route('invoices.edit', ['invoice' => $invoice]) }}"
                                                class=""><i class='bx bxs-edit'></i></a>
                                            <form method="POST"
                                                action="{{ route('invoices.destroy', ['invoice' => $invoice]) }}"
                                                class="ms-3 d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $invoice->id }}" class="btn p-0">
                                                    <i class="bx bxs-trash text-danger"></i>
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal{{ $invoice->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel{{ $invoice->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="exampleModalLabel{{ $invoice->id }}">Modal title
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">Are you sure you want to delete this
                                                                invoice?</div>
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
                            @include('admin.invoices.create')
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
