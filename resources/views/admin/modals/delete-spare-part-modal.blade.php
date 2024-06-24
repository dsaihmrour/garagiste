@props(['item', 'title'])
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Are you sure you want to delete this {{ $item }}?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form id="deleteForm" method="POST" action="" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function setDeleteFormAction(action) {
        document.getElementById('deleteForm').action = action;
    }

    document.getElementById('deleteForm').addEventListener("submit", async (event) => {
        event.preventDefault();
        const form = document.getElementById('deleteForm')
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const res = await fetch(form.action, {
            method: "DELETE",
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        const data = await res.json();

        if (res.ok) {
            const modal = document.getElementById('exampleModal');
            const modalInstance = bootstrap.Modal.getInstance(modal);
            modalInstance.hide();

            
            const trElement = document.getElementById("row" + data.part.id).remove()
        } else {
            console.log(data.error);
        }
    })
</script>
