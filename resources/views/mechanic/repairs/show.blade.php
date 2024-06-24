@extends('layouts.index')
@section('content')
    <div class="row">
        <div class="mx-auto">
            <div class="card border-primary mb-3">
                <div class="card-header bg-transparent border-primary">Repair Details</div>
                <div class="card-body text-primary">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <tbody>
                                <tr>
                                    <th scope="row" class="border-0">Title</th>
                                    <td class="border-0">{{ $repair->title }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="border-0">Status</th>
                                    <td class="border-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span id="statusContainer">{{ $repair->status }}</span>
                                            <button class="btn btn-sm btn-primary ml-2" data-bs-toggle="modal"
                                                data-bs-target="#updateStatusModal"
                                                onclick="showUpdateModal({{ $repair->id }})">Edit</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="border-0">Work Price</th>
                                    <td class="border-0">{{ $repair->workPrice ?: 'n/a' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="border-0">Hours</th>
                                    <td class="border-0">{{ $repair->hours ?: 'n/a' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="border-0">Hour Price</th>
                                    <td class="border-0">{{ $repair->hourPrice ?: 'n/a' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="border-0">Start Date</th>
                                    <td class="border-0">{{ $repair->startDate ?: 'n/a' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="border-0">End Date</th>
                                    <td class="border-0">{{ $repair->endDate ?: 'n/a' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-primary mb-0" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab"
                                aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-comment-detail font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title"> Repair Description </div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab"
                                aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-bookmark-alt font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">Mecanics Notes</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#primarycontact" role="tab"
                                aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-star font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">Clients Notes</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content pt-3">
                        <div class="tab-pane fade show active" id="primaryhome" role="tabpanel">
                            <p>{{ $repair->description }}</p>
                        </div>
                        <div class="tab-pane fade" id="primaryprofile" role="tabpanel">
                            <div class="d-flex align-items-center">
                                <p id="mnotes" class="flex-grow-1">
                                    @foreach (explode('-', $repair->mechanicNotes) as $note)
                                        <span class="d-block">{{ $note }}</span>
                                    @endforeach
                                </p>
                                <button type="button" class="btn btn-primary btn-sm ms-auto" data-bs-toggle="modal"
                                    data-bs-target="#notesModal">
                                    Add Note
                                </button>
                                <button type="button" class="btn btn-primary btn-sm ms-2" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Edit All
                                </button>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="primarycontact" role="tabpanel">
                            <div class="d-flex align-items-center">
                                <p id="notes" class="flex-grow-1">
                                    @foreach (explode('-', $repair->clientNotes) as $note)
                                        <span class="d-block">{{ $note }}</span>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('mechanic.modals.add-notes-modal')
        @include('mechanic.modals.edit-notes-modal')
        @include('mechanic.modals.update-repair-status')
        <script>
            function showUpdateModal(id) {
                document.getElementById('updateForm').action = "/mechanic/repairs/updateStatus/" + id
            }

            function saveNotes() {
                const notes = document.getElementById('mechanicNotes').value;
                const repairId = '{{ $repair->id }}';
                fetch(`/mechanic/repairs/${repairId}/addNotes`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            mechanicNotes: notes
                        })
                    })
                    .then((response) => {
                        if (response.ok) {
                            document.getElementById('mechanicNotes').value = '';
                            document.getElementById('mnotes').innerHTML += notes;
                            const modal = document.getElementById('notesModal');
                            const modalInstance = bootstrap.Modal.getInstance(modal);
                            modalInstance.hide();
                        } else {
                            console.log('Error while saving notes');
                        }
                    });
            }

            function saveModalNotes() {
                const notes = document.getElementById('modalNotes').value;
                const repairId = '{{ $repair->id }}';
                fetch(`/mechanic/repairs/${repairId}/editNotes`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            mechanicNotes: notes
                        })
                    })
                    .then((response) => {
                        if (response.ok) {
                            document.getElementById('modalNotes').value = '';
                            document.getElementById('mnotes').innerHTML = notes;
                            const modal = document.getElementById('exampleModal');
                            const modalInstance = bootstrap.Modal.getInstance(modal);
                            modalInstance.hide();
                        } else {
                            console.log('Error while saving notes');
                        }
                    });
            }
        </script>
    </div>
@endsection
