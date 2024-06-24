<section>
    @if (session('status') === 'password-updated')
        @component('admin.components.seccuss-alert', [
            'title' => __('Success Alerts'),
            'subTitle' => __('Your password has been updated!'),
        ])
        @endcomponent
    @endif

    <header>
        <h2 class="text-lg font-medium">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm ">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">{{ __('Current Password') }}</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <input id="current_password" name="current_password" type="password" class="form-control"
                    autocomplete="current-password" />
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">{{ __('New Password') }}</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <input id="password" name="password" type="password" class="form-control"
                    autocomplete="new-password" />
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">{{ __('Confirm Password') }}</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control"
                    autocomplete="new-password" />
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
