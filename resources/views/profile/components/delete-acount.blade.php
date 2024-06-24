<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium ">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirm-user-deletion">
        {{ __('Delete Account') }}
    </button>

    <div class="modal fade" id="confirm-user-deletion" tabindex="-1" aria-labelledby="confirm-user-deletion-label"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                            @csrf
                            @method('delete')

                            <h2 class="text-lg font-medium" id="confirm-user-deletion-label">
                                {{ __('Are you sure you want to delete your account?') }}
                            </h2>

                            <p class="mt-1 text-sm">
                                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                            </p>

                            <div class="mt-6">
                                <label for="password" class="form-label sr-only">{{ __('Password') }}</label>

                                <input id="password" name="password" type="password" class="form-control"
                                    placeholder="{{ __('Password') }}" required>

                                @error('password', 'userDeletion')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-6 d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary me-3" data-bs-dismiss="modal">
                                    {{ __('Cancel') }}
                                </button>

                                <button type="submit" class="btn btn-danger">
                                    {{ __('Delete Account') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
