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
                    <h5 class="mb-4">Update Repair</h5>
                    <form class="row g-3" method="post" action="{{ route('repairs.update', ['repair' => $repair]) }}">
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
                            <label for="input26" class="form-label">Status</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-info-circle"></i></span>
                                <input name="status" type="text" class="form-control" id="input26"
                                    placeholder="Status" value="{{ $repair->status ?? old('status') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input26" class="form-label">Work Price</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-cash"></i></span>
                                <input name="workPrice" type="text" class="form-control" id="input26"
                                    placeholder="Work Price" value="{{ $repair->workPrice ?? old('workPrice') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input26" class="form-label">Hours</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-clock"></i></span>
                                <input name="hours" type="text" class="form-control" id="input26" placeholder="Hours"
                                    value="{{ $repair->hours ?? old('hours') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input26" class="form-label">Hour Price</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-cash"></i></span>
                                <input name="hourPrice" type="text" class="form-control" id="input26"
                                    placeholder="Hour Price" value="{{ $repair->hourPrice ?? old('hourPrice') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input26" class="form-label">Start Date</label>
                            <div class="input-group">
                                <input name="startDate" type="date" class="form-control" id="input26"
                                    value="{{ isset($repair) ? date('Y-m-d', strtotime($repair->startDate)) : old('startDate') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input27" class="form-label">End Date</label>
                            <div class="input-group">
                                <input name="endDate" type="date" class="form-control" id="input27"
                                    value="{{ isset($repair) ? date('Y-m-d', strtotime($repair->endDate)) : old('endDate') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input27" class="form-label">Description</label>
                            <div class="input-group">
                                <textarea name="description" type="text" class="form-control" id="input27">{{ $repair->description ?? old('description') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input27" class="form-label">Mechanic Notes</label>
                            <div class="input-group">
                                <textarea name="mechanicNotes" type="text" class="form-control" id="input27">{{ $repair->mechanicNotes ?? old('mechanicNotes') }}</textarea>
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
