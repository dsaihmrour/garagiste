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
                    <h5 class="mb-4">Create Part</h5>
                    <form class="row g-3" method="post" action="{{ route('spare-parts.store') }}"
                        enctype="multipart/form-data">
                        <div class="col-md-12">
                            @csrf
                            <label for="input25" class="form-label">Name</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-tools"></i></span>
                                <input name="partName" type="text" class="form-control" id="input25"
                                    placeholder="Part Name" value="{{ old('partName') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input26" class="form-label">Reference</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-hash"></i></span>
                                <input name="partReference" type="text" class="form-control" id="input26"
                                    placeholder="Part Reference" value="{{ old('partReference') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input26" class="form-label">Supplier</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-building"></i></span>
                                <input name="supplier" type="text" class="form-control" id="input26"
                                    placeholder="Supplier" value="{{ old('supplier') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input27" class="form-label">Price</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-currency-dollar"></i></span>
                                <input name="price" type="text" class="form-control" id="input27" placeholder="Price"
                                    value="{{ old('price') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input28" class="form-label">Stock</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-box-seam"></i></span>
                                <input name="stock" type="number" min="0" class="form-control" id="input28"
                                    placeholder="Stock" value="{{ old('stock') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input29" class="form-label">Description</label>
                            <div class="input-group">
                                <textarea name="description" class="form-control" id="input29" rows="3" placeholder="Description">{{ old('description') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="photo" class="form-label">Photo</label>
                            <div class="input-group">
                                <input name="photo" type="file" class="form-control" id="photo">
                            </div>
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
