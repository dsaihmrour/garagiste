<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Status Update</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="updateForm" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row row-cols-auto g-2">
                        <label for="roles" class="form-label">Select status:</label>
                        @php
                            $statusList = ['pending', 'in progress', 'completed'];
                        @endphp
                        <select name="status" class="form-select" required>
                            @foreach ($statusList as $status)
                                <option class="form-control" value="{{ $status }}"
                                    {{ $repair->status === $status ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
                <div class="errors text-danger">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button onclick="updateStatus()" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
<script>
    async function updateStatus() {
        const form = document.getElementById("updateForm")
        var formData = new FormData(document.getElementById("updateForm"));

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        try {
            const res = await fetch(form.action + "/" + formData.get("status"), {
                method: "PUT",
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            const data = await res.json()
            if (res.ok) {
                const modal = document.getElementById('exampleModal');
                const errorsContainer = document.querySelector(".errors");
                const statusContainer = document.getElementById("statusContainer");
                const modalInstance = bootstrap.Modal.getInstance(modal);
                modalInstance.hide();

                if (statusContainer) {
                    statusContainer.innerHTML = ""
                    statusContainer.innerHTML = data.status
                }
            } else {
                if (errorsContainer) {
                    errorsContainer.innerHTML = ""
                    errorsContainer.innerHTML = data.error
                }
            }
        } catch (error) {
            console.log(error);
        }
    }
</script>
