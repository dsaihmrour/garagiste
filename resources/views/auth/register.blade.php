@extends('layouts.guest')
@section('content')
    @if (!empty(session('status')))
        @component('admin.components.seccuss-alert', [
            'title' => __('Success Alerts'),
            'subTitle' => session('status'),
        ])
        @endcomponent
    @endif
    <div class="wrapper">
        <div class="section-authentication-cover">
            <div class="row g-0">
                <div
                    class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">
                    <div class="card bg-transparent shadow-none rounded-0 mb-0">
                        <div class="card-body">
                            <img src="{{ asset('assets/images/login-images/register-cover.svg') }}"
                                class="img-fluid auth-img-cover-login" width="550" alt="" />
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
                    <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
                        <div class="card-body p-sm-5">
                            <div class="">
                                <div class="mb-3 text-center">
                                    <img src="{{ asset('assets/images/logo-icon.png') }}" width="60" alt="">
                                </div>
                                <div class="text-center mb-4">
                                    <h5 class="">Dashrock Admin</h5>
                                    <p class="mb-0">Please fill the below details to create your account</p>
                                </div>
                                <div class="form-body">
                                    <form method="POST" action="{{ route('register') }}" class="row g-3">
                                        @csrf
                                        <div class="col-6">
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <label for="firstName" class="form-label">First Name</label>
                                                    <input type="text" class="form-control" id="firstName"
                                                        name="firstName" value="{{ old('firstName') }}" required autofocus
                                                        placeholder="Your first name" autocomplete="firstName">
                                                    @error('firstName')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <label for="lastName" class="form-label">Last Name</label>
                                                    <input type="text" class="form-control" id="lastName"
                                                        name="lastName" value="{{ old('lastName') }}" required autofocus
                                                        autocomplete="lastName" placeholder="Your last name">
                                                    @error('lastName')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="username" name="username"
                                                value="{{ old('username') }}" required autofocus autocomplete="username"
                                                placeholder="Jhon">
                                            @error('username')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                value="{{ old('address') }}" required autofocus autocomplete="address"
                                                placeholder="Enter your address">
                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="phoneNumber" class="form-label">Phone Number</label>
                                            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber"
                                                value="{{ old('phoneNumber') }}" required autofocus
                                                placeholder="Enter your phone number" autocomplete="phoneNumber">
                                            @error('phoneNumber')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="email" class="form-label">Email Address</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ old('email') }}" required autofocus autocomplete="email"
                                                placeholder="example@user.com">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="password" class="form-label">Password</label>
                                            <div class="input-group" id="show_hide_password">

                                                <input type="password" class="form-control" id="password"
                                                    name="password" required autocomplete="new-password"
                                                    placeholder="Enter Password">
                                                <a href="javascript:;" class="input-group-text bg-transparent"><i
                                                        class='bx bx-hide'></i></a>
                                            </div>
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control" id="password_confirmation"
                                                name="password_confirmation" required autocomplete="new-password"
                                                placeholder="Retype your Password">
                                            @error('password_confirmation')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12"></div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary">Sign up</button>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="text-center">
                                                <p class="mb-0">{{ __('Already have an account?') }} <a
                                                        href="{{ route('login') }}">{{ __('Sign in here') }}</a></p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="login-separater text-center mb-5">
                                    <span>OR SIGN UP WITH EMAIL</span>
                                    <hr />
                                </div>
                                <div class="list-inline contacts-social text-center">
                                    <a href="javascript:;"
                                        class="list-inline-item bg-facebook text-white border-0 rounded-3"><i
                                            class="bx bxl-facebook"></i></a>
                                    <a href="javascript:;"
                                        class="list-inline-item bg-twitter text-white border-0 rounded-3"><i
                                            class="bx bxl-twitter"></i></a>
                                    <a href="javascript:;"
                                        class="list-inline-item bg-google text-white border-0 rounded-3"><i
                                            class="bx bxl-google"></i></a>
                                    <a href="javascript:;"
                                        class="list-inline-item bg-linkedin text-white border-0 rounded-3"><i
                                            class="bx bxl-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
@endsection
