@extends('layouts.index')
@section('content')
    <div class="row">
        @if (count($errors) > 0)
            @component('admin.components.danger-alert', ['errors' => $errors])
            @endcomponent
        @endif
        <div class="col-xl-6 mx-auto">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">Update User</h5>
                    <form class="row g-3" editForm method="post" action="{{ route('users.update', ['user' => $user]) }}">
                        <div class="col-md-12">
                            @method('PUT')
                            @csrf
                            <label for="input25" class="form-label">First Name</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bx-user'></i></span>
                                <input name="firstName" type="text" class="form-control" id="input25"
                                    placeholder="First Name" value="{{ $user->firstName ?? old('firstName') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input26" class="form-label">Last Name</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bx-user'></i></span>
                                <input name="lastName" type="text" class="form-control" id="input26"
                                    placeholder="Last Name" value="{{ $user->lastName ?? old('lastName') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input26" class="form-label">Username</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bx-user'></i></span>
                                <input name="username" type="text" class="form-control" id="input26"
                                    placeholder="Username" value="{{ $user->username ?? old('username') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input27" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bx-envelope'></i></span>
                                <input name="email" type="text" class="form-control" id="input27" placeholder="Email"
                                    value="{{ $user->email ?? old('email') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input29" class="form-label">Phone</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bx-microphone'></i></span>
                                <input name="phoneNumber" type="text" class="form-control" id="input29"
                                    placeholder="Phone" value="{{ $user->phoneNumber ?? old('phoneNumber') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input30" class="form-label">Role</label>
                            <div class="d-flex align-items-center gap-3">
                                @foreach (App\Models\Role::all() as $role)
                                    @php($checked = false)
                                    @foreach ($user->roles as $userRole)
                                        @if ($userRole->id == $role->id)
                                            @php($checked = true)
                                        @break
                                    @endif
                                @endforeach
                                <div class="form-check form-check-info">
                                    <input class="form-check-input" type="checkbox" value="{{ $role->id }}"
                                        id="role-{{ $role->id }}" name="role[]" {{ $checked ? 'checked' : '' }}>
                                    <label class="form-check-label" for="role-{{ $role->id }}">
                                        {{ $role->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="input32" class="form-label">Address</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class='bx bx-buildings'></i></span>
                            <input type="text" name="address" id="input32" class="form-control"
                                placeholder="Address" value="{{ $user->address ?? old('address') }}" />
                        </div>
                    </div>

                    <div class="col-md-12">
                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Submit</button>
                            <button type="reset" class="btn btn-light px-4">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
