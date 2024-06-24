<div class="modal fade" id="exampleLargeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form class="row g-3" method="post" action="{{ route('client.vehicles.store') }}" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Vehicle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 mx-auto">
                            <div class="card" style="display: flex;flex-direction:column;gap:10px">
                                <div class="card-body p-4">
                                    <div class="col-md-12">
                                        @csrf
                                        <label for="input25" class="form-label">Make</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="lni lni-car"></i></span>
                                            <input name="make" type="text" class="form-control" id="input25"
                                                placeholder="First Name" value="{{ old('make') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="input26" class="form-label">Model</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-display"></i></span>
                                            <input name="model" type="text" class="form-control" id="input26"
                                                placeholder="Last Name" value="{{ old('model') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="input26" class="form-label">Fuel TYpe</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-droplet"></i></span>
                                            <input name="fuelType" type="text" class="form-control" id="input26"
                                                placeholder="fuelType" value="{{ old('fuelType') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="input27" class="form-label">Registration</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                                            <input name="registration" type="text" class="form-control"
                                                id="input27" placeholder="registration"
                                                value="{{ old('registration') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="input27" class="form-label">Photos</label>
                                        <div class="input-group">
                                            <div class="form-file">
                                                <input class="form-control" type="file" id="formFileMultiple"
                                                    multiple name="photos[]">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="errorContainer"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
