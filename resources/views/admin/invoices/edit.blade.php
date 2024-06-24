@extends('layouts.index')
@section('content')
    <div class="row">
        @if (count($errors) > 0)
            @component('admin.components.danger-alert', ['errors' => $errors])
            @endcomponent
        @endif
        <div class="col-xl-6 mx-auto">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">Add New Invoice</h5>
                    <form class="row g-3" method="post" action="{{ route('invoices.update', ['invoice' => $invoice]) }}">
                        @csrf
                        @method('PUT')
                        <div class="col-md-12">
                            <label for="input25" class="form-label">Total Amount</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-cash-coin"></i></span>
                                <input name="totalAmount" type="text" class="form-control" id="input25"
                                    placeholder="Total Amount" value="{{ $invoice->totalAmount ?? old('totalAmount') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input26" class="form-label">Additional Charges</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-cash-coin"></i></span>
                                <input name="additionalCharges" type="text" class="form-control" id="input26"
                                    placeholder="Additional Charge"
                                    value="{{ $invoice->additionalCharges ?? old('additionalCharges') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input26" class="form-label">Due Date</label>
                            <div class="input-group">
                                <input name="dueDate" type="date" class="form-control" id="input26"
                                    placeholder="fuelType" value="{{ $invoice->dueDate ?? old('dueDate') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input27" class="form-label">Description</label>
                            <div class="input-group">
                                <textarea name="description" type="text" class="form-control" id="input27">{{ $invoice->description ?? old('description') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                        </div>
                        <div class="col-md-12">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="submit" class="btn btn-primary px-4">Submit</button>
                                <button type="reset" class="btn btn-light px-4">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
