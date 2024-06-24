@extends('layouts.index')
@section('content')
    @component('client.components.location', ['page' => 'Update Repair', 'subpage' => '', 'title' => 'Repairs'])
    @endcomponent
    <div class="row">
        @if (count($errors) > 0)
            @component('admin.components.danger-alert', ['errors' => $errors])
            @endcomponent
        @endif
        <div class="col-xl-6 mx-auto">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">Update Repair</h5>
                    <form class="row g-3" method="post" action="{{ route('client.repairs.update', ['repair' => $repair]) }}">
                        @csrf
                        @method('PUT')
                        <div class="col-md-12">
                            <label for="input25" class="form-label">Title</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-type"></i></span>
                                <input name="title" type="text" class="form-control" id="input25" placeholder="Title"
                                    value="{{ $repair->title ?? old('title') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input27" class="form-label">Description</label>
                            <div class="input-group">
                                <textarea name="description" type="text" class="form-control" id="input27">{{ $repair->description ?? old('description') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input27" class="form-label">Client Notes</label>
                            <div class="input-group">
                                <textarea name="clientNotes" type="text" class="form-control" id="input27">{{ $repair->clientNotes ?? old('clientNotes') }}</textarea>
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
