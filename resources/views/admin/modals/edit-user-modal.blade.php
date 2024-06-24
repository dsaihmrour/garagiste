<div class="col">
    <div class="modal fade" id="exampleScrollableModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" id="updateForm" action="" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="" id="id">
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
                            <label for="phoneNumber" class="form-label">Phone</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bx-microphone'></i></span>
                                <input name="phoneNumber" type="text" class="form-control" id="phoneNumber"
                                    placeholder="Phone">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input30" class="form-label">Role</label>
                            <div class="d-flex align-items-center gap-3" id="rolesContainer">
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="updateUserBtn">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-btn');
            const firstNameaInput = document.getElementById('firstName');
            const id = document.getElementById('id');
            const lastNameInput = document.getElementById('lastName');
            const usernameInput = document.getElementById('username');
            const emailInput = document.getElementById('email');
            const addressInput = document.getElementById('address');
            const phoneNumberInput = document.getElementById('phoneNumber');
            const updateUserBtn = document.getElementById('updateUserBtn');
            const updateForm = document.getElementById('updateForm')
            const roleContainer = document.getElementById("rolesContainer")

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const userId = button.getAttribute('data-user-id');
                    // Fetch user details using AJAX
                    fetch(`/admin/users/getUser/${userId}`)
                        .then(response => response.json())
                        .then(data => {
                            // updateForm.action = `/admin/users/updateById/${data.user.id}`
                            // id = data.user.id
                            // Populate user details in the form
                            firstNameaInput.value = data.user.firstName;
                            id.value = data.user.id
                            lastNameInput.value = data.user.lastName;
                            usernameInput.value = data.user.username;
                            addressInput.value = data.user.address;
                            emailInput.value = data.user.email;
                            phoneNumberInput.value = data.user.phoneNumber;
                            // Clear previous role checkboxes
                            roleContainer.innerHTML = '';
                            // Iterate over roles and create checkboxes
                            data.roles.forEach(role => {
                                const checkbox = document.createElement('input');
                                checkbox.type = 'checkbox';
                                checkbox.name = 'role[]';
                                checkbox.value = role.id;
                                checkbox.classList.add("form-check-input")
                                checkbox.id = `role-${role.id}`;

                                const label = document.createElement('label');
                                label.htmlFor = `role-${role.id}`;
                                label.textContent = role.name;
                                label.classList.add("form-check-label")


                                const div = document.createElement('div');
                                div.classList.add('form-check', 'form-check-info');
                                div.appendChild(checkbox);
                                div.appendChild(label);

                                // Check if the role exists in the user's roles
                                if (data.user.roles.find(userRole => userRole.id ===
                                        role
                                        .id)) {
                                    checkbox.checked = true;
                                }
                                roleContainer.appendChild(div);
                            });
                        })
                        .catch(error => console.error('Error fetching user details:', error));
                });
            });

            // Update user details when Save Changes button is clicked
            updateForm.addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(updateForm);
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                const url = `/admin/users/updateById/${formData.get('id')}`
                fetch(url, {
                        method: 'PUT',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(response => response.json())
                    .then(response => {
                        console.log(response);
                        if (response.ok) {
                            // Optionally, you can close the modal or display a success message
                            console.log('User details updated successfully');
                            // Close modal
                            const modal = document.getElementById('exampleScrollableModal');
                            const modalInstance = bootstrap.Modal.getInstance(modal);
                            modalInstance.hide();

                        } else {
                            console.error('Failed to update user details');
                        }
                    })
                    .catch(error => console.error('Error updating user details:', error));
            });
        });
    </script>

</div>
