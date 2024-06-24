<div class="modal fade" id="exampleLargeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form class="row g-3" method="post" action="{{ route('invoices.store') }}" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Invoice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 mx-auto">
                            <div class="p-4 row" style="display: flex;flex-direction:column;gap:10px">
                                <div class="col-md-12">
                                    @csrf
                                    <label for="input25" class="form-label">Total Amount</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-cash-coin"></i></span>
                                        <input name="totalAmount" type="text" class="form-control" id="input25"
                                            placeholder="Total Amount" value="{{ old('totalAmount') }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="input26" class="form-label">Additional Charge</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-cash-coin"></i></span>
                                        <input name="additionalCharges" type="text" class="form-control"
                                            id="input26" placeholder="Additional Charge"
                                            value="{{ old('additionalCharge') }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="input26" class="form-label">Due Date</label>
                                    <div class="input-group">

                                        <input name="dueDate" type="date" class="form-control" id="input26"
                                            placeholder="fuelType" value="{{ old('dueDate') }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="input27" class="form-label">Description</label>
                                    <div class="input-group">
                                        <textarea name="description" type="text" class="form-control" id="input27" value="{{ old('description') }}">Description</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="input28" class="form-label">Select User</label>
                                    <input name="user_id" class="form-control" list="users" id="input28"
                                        placeholder="Start typing to filter users..." oninput="updateUserId()">
                                    <datalist id="users">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" data-user-id="{{ $user->id }}">
                                                {{ $user->username }}</option>
                                        @endforeach
                                    </datalist>
                                </div>
                                <div id="errorContainer"></div>
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
<script>
    function updateUserId() {
        var input = document.getElementById('input28');
        var selectedOption = input.querySelector('option[value="' + input.value + '"]');
        if (selectedOption) {
            var userId = selectedOption.getAttribute('data-user-id');
            input.setAttribute('data-user-id', userId);
        } else {
            input.removeAttribute('data-user-id');
        }
    }
    document.getElementById('input28').addEventListener('input', function() {
        var input, filter, datalist, options, i;
        input = this;
        filter = input.value.toUpperCase();
        datalist = document.getElementById('users');
        options = datalist.getElementsByTagName('option');
        for (i = 0; i < options.length; i++) {
            if (options[i].value.toUpperCase().indexOf(filter) > -1) {
                options[i].style.display = "";
            } else {
                options[i].style.display = "none";
            }
        }
    });
</script>
