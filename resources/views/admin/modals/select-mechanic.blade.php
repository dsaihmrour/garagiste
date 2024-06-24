<div class="modal fade" id="selectMechanicModal" tabindex="-1" aria-labelledby="selectMechanicModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="selectMechanicModalLabel">Select Mechanic</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="confirmForm">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="mechanic" class="form-label">Select Mechanic:</label>
                        <select name="mechanic_id" class="form-select" required>
                            @foreach ($mechanics as $mechanic)
                                <option value="{{ $mechanic->id }}">{{ $mechanic->username }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" onclick="document.getElementById('confirmForm').submit()"
                    class="btn btn-primary">Attach Mechanic</button>
            </div>
        </div>
    </div>
</div>
