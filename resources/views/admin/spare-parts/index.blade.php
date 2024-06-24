@extends('layouts.index')
@section('content')
    @component('admin.components.break-crump', [
        'title' => 'Spare parts',
        'page' => 'Spare parts',
        'subpage' => '',
        'exportRoute' => route('spareParts.export'),
    ])
    @endcomponent
    <div class="card">
        @if (!empty(session('status')))
            @component('admin.components.seccuss-alert', [
                'title' => __('Success Alerts'),
                'subTitle' => session('status'),
            ])
            @endcomponent
        @endif
        @component('admin.modals.import-modal', ['importRoute' => route('spareParts.import'), 'title' => 'Spare Parts'])
        @endcomponent
        <div class="card-body">
            <div class="d-lg-flex align-items-center mb-4 gap-3">
                @component('admin.components.search-bar', ['route' => route('spare-parts'), 'searchItem' => 'Part'])
                @endcomponent
                <div class="ms-auto">
                    <a href="{{ route('spare-parts.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i
                            class="bx bxs-plus-square"></i>Add New
                        Part</a>
                </div>
            </div>
            @if (count($spareParts) > 0)
                <div class="table-responsive">
                    <table class="table mb-0" id="example">
                        <thead class="table-light">
                            <tr>
                                <th>Spare Part#</th>
                                <th>Name</th>
                                <th>Reference</th>
                                <th>Supplier</th>
                                <th>Price</th>
                                <th>View Details</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($spareParts as $s)
                                <tr id="row{{ $s->id }}">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <input class="form-check-input me-3" type="checkbox" aria-label="..."
                                                    name="items[]" value="{{ $s->id }}">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-0 font-14">{{ $s->id }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $s->partName }}</td>
                                    <td>{{ $s->partReference }}</td>
                                    <td>{{ $s->supplier }}</td>
                                    <td>{{ $s->price }}</td>
                                    <td>
                                        <a href="{{ route('spare-part.details', ['spare_part' => $s]) }}"
                                            class="btn btn-primary btn-sm radius-30 px-4">View Details</a>
                                    </td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            <a href="{{ route('spare-parts.edit', ['spare_part' => $s]) }}"
                                                class=""><i class='bx bxs-edit'></i></a>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                class="btn p-0 ms-3 d-inline"
                                                onclick="setDeleteFormAction('/admin/spare-parts/{{ $s->id }}')">
                                                <i class="bx bxs-trash text-danger"></i>
                                            </button>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @component('admin.modals.delete-spare-part-modal', ['item' => 'spare part', 'title' => 'Delete Part'])
                            @endcomponent
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-primary border-0 bg-primary alert-dismissible fade show">
                    <div class="text-white">There are no spare-parts!</div>
                </div>
            @endif
        </div>
    </div>
    <script>
        function clearSearch() {
            window.location.href = "{{ route('spare-parts') }}"; // Redirect to the same route to clear the search query
        }
    </script>


@endsection
