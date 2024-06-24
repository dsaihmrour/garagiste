<div class="col">
    <div class="modal fade" id="exampleScrollableModal1" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" id="createForm" action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="col-md-12">
                            <label for="firstName" class="form-label">First Name</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bx-user'></i></span>
                                <input name="firstName" type="text" class="form-control" id="firstName"
                                    placeholder="First Name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="lastName" class="form-label">Last Name</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bx-user'></i></span>
                                <input name="lastName" type="text" class="form-control" id="lastName"
                                    placeholder="Last Name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="username" class="form-label">Username</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bx-user'></i></span>
                                <input name="username" type="text" class="form-control" id="username"
                                    placeholder="Username">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bx-envelope'></i></span>
                                <input name="email" type="text" class="form-control" id="email"
                                    placeholder="Email">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input28" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bx-lock-alt'></i></span>
                                <input name="password" type="password" class="form-control" id="input28"
                                    placeholder="Password">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="phoneNumber" class="form-label">Phone</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bx-microphone'></i></span>
                                <input name="phoneNumber" type="text" class="form-control" id="phoneNumber"
                                    placeholder="Phone">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input30" class="form-label">Role</label>
                            <div class="d-flex align-items-center gap-3">
                                @foreach (App\Models\Role::all() as $role)
                                    <div class="form-check form-check-info">
                                        <input class="form-check-input" type="checkbox" value="{{ $role->id }}"
                                            id="role-{{ $role->id }}" name="role[]"
                                            {{ in_array($role->id, old('role', [])) ? 'checked' : '' }}>

                                        <label class="form-check-label" for="role-{{ $role->id }}">
                                            {{ $role->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="address" class="form-label">Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bx-buildings'></i></span>
                                <input type="text" name="address" id="address" class="form-control"
                                    placeholder="Address" />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="create-user-btn">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-btn');
            const createUserBtn = document.getElementById('create-user-btn');
            const createForm = document.getElementById('createForm')
            const roleContainer = document.getElementById("rolesContainer")
            const tBody = document.getElementById("userTableBody")


            // Update user details when Save Changes button is clicked
            createUserBtn.addEventListener('click', async function(event) {
                event.preventDefault();

                try {
                    const formData = new FormData(document.getElementById('createForm'));
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content');

                    const response = await fetch(createForm.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    });
                    const data = await response.json();

                    if (!response.ok) {
                        console.log(data.error);
                        throw new Error('Failed to create user');
                    }

                    // Close modal
                    const modal = document.getElementById('exampleScrollableModal1');
                    const modalInstance = bootstrap.Modal.getInstance(modal);
                    modalInstance.hide();

                    const html =
                        '<tr id="row' + data.user.id + '">' +
                        '<td>' +
                        '<div class="d-flex align-items-center">' +
                        '<div>' +
                        '<input class="form-check-input me-3" type="checkbox" value="" aria-label="...">' +
                        '</div>' +
                        '<div class="ms-2">' +
                        '<h6 class="mb-0 font-14">' + data.user.id + '</h6>' +
                        '</div>' +
                        '</div>' +
                        '</td>' +
                        '<td>' + data.user.username + '</td>' +
                        '<td>' + data.user.email + '</td>' +
                        '<td>' + data.user.address + '</td>' +
                        '<td>' +
                        data.userRoles.map(function(role) {
                            var color;
                            switch (role.id) {
                                case 1:
                                    color = '#3b5998';
                                    break;
                                case 2:
                                    color = '#3c8dbc';
                                    break;
                                case 3:
                                    color = '#f56954';
                                    break;
                                default:
                                    color = '#0073b7';
                            }
                            return '<span style="color: ' + color + '">' + role.name +
                                '</span>';
                        }).join(', ') +
                        '</td>' +
                        '<td>' +
                        '<a href="/user/details/' + data.user.id +
                        '" class="btn btn-primary btn-sm radius-30 px-4">View Details</a>' +
                        '</td>' +
                        '<td>' +
                        '<div class="d-flex order-actions">' +
                        '<button data-bs-toggle="modal" data-bs-target="#exampleScrollableModal" data-user-id="' +
                        data.user.id + '" class="btn btn-primary edit-btn">' +
                        '<i class="bx bxs-edit"></i>' +
                        '</button>' +
                        '<button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="setDeleteFormAction(\'/admin/users/' +
                        data.user.id + '\')" class="btn p-0 ms-3 d-inline">' +
                        '<i class="bx bxs-trash text-danger"></i>' +
                        '</button>' +
                        '</div>' +
                        '</td>' +
                        '</tr>';

                    tBody.innerHTML += html;
                } catch (error) {
                    console.error('Error creating user details:', error);
                }
            });
        });
    </script>

</div>
