<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Seelect the roles</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="updateForm" method="POST">
                    @csrf
                    <label for="roles">Select Roles:</label>
                    <div class="form-group d-flex align-items-center gap-3">
                        @foreach ($roles as $role)
                            <div class="form-check form-check-info">
                                <input class="form-check-input" type="checkbox" value="{{ $role->id }}"
                                    id="role-{{ $role->id }}" name="role[]">
                                <label class="form-check-label" for="role-{{ $role->id }}">
                                    {{ $role->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button onclick="updateRoles()" id="#updateRole" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
<script>
    async function updateRoles() {
        const form = document.getElementById("updateForm")
        var formData = new FormData(document.getElementById("updateForm"));
        try {
            const res = await fetch(form.action, {
                method: "POST",
                body: formData
            });
            const data = await res.json()
            if (res.ok) {
                const modal = document.getElementById('exampleModal');
                const modalInstance = bootstrap.Modal.getInstance(modal);
                modalInstance.hide();

                const rolesContainer = document.getElementById("rolesContainer");
                rolesContainer.innerHTML = ""
                if (rolesContainer) {
                    const colors = {
                        1: '#3b5998',
                        2: '#3c8dbc',
                        3: '#f56954',
                        default: '#0073b7'
                    };

                    // Function to get color based on role ID
                    function getColor(roleId) {
                        return colors[roleId] || colors.default;
                    }
                    // Use map to generate an array of HTML strings
                    const roleHtml = data.userRoles.map(role => {
                        const color = getColor(role.id);
                        return `<span style="color: ${color}">${role.name}</span>`;
                    });

                    // Join the HTML strings and assign to innerHTML
                    rolesContainer.innerHTML = roleHtml.join(', ');
                }
            }
        } catch (error) {
            console.log(error);
        }
    }
</script>
