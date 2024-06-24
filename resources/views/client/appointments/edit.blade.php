<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="" id="editModalForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="etitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="etitle" name="title" required
                            value="">
                    </div>
                    <div class="mb-3">
                        <label for="edescription" class="form-label">Description</label>
                        <textarea class="form-control" id="edescription" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="estart_datetime" class="form-label">Start date and time</label>
                        <input type="datetime-local" class="form-control" id="estart_datetime" name="start_datetime"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="eend_datetime" class="form-label">End date</label>
                        <input type="datetime-local" class="form-control" id="eend_datetime" name="end_datetime"
                            required value="">
                    </div>
                    <div class="mb-3">
                        <label for="evehicle_id" class="form-label">Vehicle</label>
                        <select id="evehicle_id" name="vehicle_id" class="form-select" required>
                            @foreach ($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}">{{ $vehicle->make }} {{ $vehicle->model }}
                                    ({{ $vehicle->registration }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="updateBtn" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const title = document.getElementById('etitle')
            const desc = document.getElementById('edescription')
            const startData = document.getElementById('estart_datetime')
            const endDate = document.getElementById('eend_datetime')
            const vehicle = document.getElementById('evehicle_id')
            const updateBtn = document.getElementById("updateBtn")
            const form = document.getElementById('editModalForm');

            const editButtons = document.querySelectorAll('.edit-btn');
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const appId = button.getAttribute('data-appointment-id');

                    form.action = '/client/appointments/' + appId;
                    fetch('/client/appointments/' + appId + '/getData')
                        .then(response => response.json())
                        .then(data => {
                            title.value = data.title;
                            desc.value = data.description;
                            startData.value = data.start_datetime;
                            endDate.value = data.end_datetime;
                            vehicle.value = data.vehicle_id;
                        }).catch(error => console.log(error))
                });
            });
        });
    </script>
</div>
