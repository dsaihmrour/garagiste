@props(['user'])
<section>
    @if (session('status') === 'profile-updated')
        @component('admin.components.seccuss-alert', [
            'title' => __('Success Alerts'),
            'subTitle' => __('Your profile has been updated!'),
        ])
        @endcomponent
    @endif
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">{{ __('First Name') }}</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <input id="firstName" class="form-control @error('firstName') is-invalid @enderror" type="text"
                    name="firstName" value="{{ old('firstName', $user->firstName) }}" required autofocus />
                @error('firstName')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">{{ __('Last Name') }}</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <input id="lastName" class="form-control @error('lastName') is-invalid @enderror" type="text"
                    name="lastName" value="{{ old('lastName', $user->lastName) }}" required autofocus />
                @error('lastName')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">{{ __('Address') }}</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <input id="address" class="form-control @error('address') is-invalid @enderror" type="text"
                    name="address" value="{{ old('address', $user->address) }}" required autofocus
                    autocomplete="address" />
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">{{ __('Phone Number') }}</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <input id="phoneNumber" class="form-control @error('phoneNumber') is-invalid @enderror" type="text"
                    name="phoneNumber" value="{{ old('phoneNumber', $user->phoneNumber) }}" required autofocus
                    autocomplete="phoneNumber" />
                @error('phoneNumber')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">{{ __('Email') }}</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <input id="email" class="form-control @error('email') is-invalid @enderror" type="email"
                    name="email" value="{{ old('email', $user->email) }}" required autofocus autocomplete="email" />
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div>
                        <div class="text-sm mt-2 d-flex align-items-center">
                            <span>{{ __('Your email address is unverified.') }}</span>
                            <span class="ms-2">
                                <button form="send-verification"
                                    class="btn btn-link btn-sm text-primary text-decoration-none" type="submit">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </span>
                        </div>
                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>


        <div class="flex items-center gap-4">
            <button type="submit" class="btn btn-primary btn-sm mt-2"
                style="box-shadow: 0 2px 4px rgba(50, 50, 93, 0.11); margin-right: 0.5rem;">
                {{ __('Save') }}
            </button>
        </div>
    </form>
</section>
