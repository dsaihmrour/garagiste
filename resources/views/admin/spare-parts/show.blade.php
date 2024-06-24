@extends('layouts.index')
@section('content')
    <div class="card">
        <div class="row g-0">
            <div class="col-md-4 border-end">
                <img src="{{ asset('storage/' . $sparePart->photo) }}" class="img-fluid" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title">{{ $sparePart->partName }}</h4>
                    <div class="d-flex gap-3 py-3">
                        <div class="text-success"><i class='bx bxs-cart-alt align-middle'></i>
                            {{ count($sparePart->repairs) }} used in repairs
                        </div>
                    </div>
                    <div class="mb-3">
                        <span class="price h4">${{ $sparePart->price }}</span>
                    </div>
                    <p class="card-text fs-6">{{ $sparePart->description }}</p>
                    <dl class="row">
                        <dt class="col-sm-3">Id#</dt>
                        <dd class="col-sm-9">{{ $sparePart->id }}</dd>

                        <dt class="col-sm-3">Reference</dt>
                        <dd class="col-sm-9">{{ $sparePart->partReference }}</dd>

                        <dt class="col-sm-3">Added at</dt>
                        <dd class="col-sm-9">{{ $sparePart->created_at }}</dd>

                        <dt class="col-sm-3">Updated at</dt>
                        <dd class="col-sm-9">{{ $sparePart->updated_at }}</dd>

                    </dl>
                    <hr>
                    <div class="row row-cols-auto justify-content-between">
                        <div class="col">
                            <label class="form-label">Stock</label>
                            <div class="input-group input-spinner">
                                <input type="text" class="form-control" value="{{ $sparePart->stock }}" disabled>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div> <button class="btn btn-primary me-2"
                                    onclick="window.location.href='{{ route('spare-parts.edit', $sparePart->id) }}'">Edit</button>
                            </div>
                            <form action="{{ route('spare-parts.destroy', $sparePart->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this spare part?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
