@extends('layouts.guest')
@section('content')
    <div class="wrapper">
        @if (!empty(session('status')))
            @component('admin.components.seccuss-alert', [
                'title' => __('Success Alerts'),
                'subTitle' => session('status'),
            ])
            @endcomponent
        @endif
        <div class="section-authentication-cover">
            <div class="">
                <div class="row g-0">
                    <div
                        class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">
                        <div class="card shadow-none bg-transparent rounded-0 mb-0">
                            <div class="card-body">
                                <img src="{{ asset('assets/images/login-images/reset-password-cover.svg') }}"
                                    class="img-fluid" width="600" alt="" />
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
                        <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
                            <div class="card-body p-sm-5">
                                <div class="">
                                    <div class="mb-4 text-center">
                                        <img src="{{ asset('assets/images/logo-icon.png') }}" width="60"
                                            alt="" />
                                    </div>
                                    <div class="text-start mb-4">
                                        <h5 class="">{{ __('Generate New Password') }}</h5>
                                        <p class="mb-0">
                                            {{ __('We received your reset password request. Please enter your new password!') }}
                                        </p>
                                    </div>
                                    <form method="POST" action="{{ route('password.store') }}">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                        <div class="mb-3 mt-4">
                                            <label class="form-label">{{ __('Email') }}</label>
                                            <input type="email" class="form-control" name="email"
                                                placeholder="{{ __('Email') }}" required
                                                value="{{ old('email', $request->email) }}" autofocus
                                                autocomplete="username" />
                                            @error('email')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 mt-4">
                                            <label class="form-label">{{ __('New Password') }}</label>
                                            <input type="password" class="form-control" name="password"
                                                placeholder="{{ __('Enter new password') }}" required />
                                            @error('password')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">{{ __('Confirm Password') }}</label>
                                            <input type="password" class="form-control" name="password_confirmation"
                                                placeholder="{{ __('Confirm password') }}" required />
                                            @error('password_confirmation')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="d-grid gap-2">
                                            <button type="submit"
                                                class="btn btn-primary">{{ __('Change Password') }}</button>
                                            <a href="{{ route('login') }}" class="btn btn-light"><i
                                                    class='bx bx-arrow-back mr-1'></i>{{ __('Back to Login') }}</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
@endsection('content')
