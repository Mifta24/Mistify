<section class="container mt-5">

        <div class="card-body p-4 p-md-5">
            <header class="mb-4">
                <h2 class="h4 fw-bold text-primary">
                    <i class="bi bi-shield-lock-fill me-2"></i> {{ __('Update Password') }}
                </h2>
                <p class="text-muted">
                    {{ __('Ensure your account is using a long, random password to stay secure.') }}
                </p>
            </header>

            <form method="post" action="{{ route('password.update') }}" class="needs-validation" novalidate>
                @csrf
                @method('put')

                <div class="mb-4">
                    <label for="update_password_current_password" class="form-label">
                        {{ __('Current Password') }}
                    </label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" required>
                    </div>
                    @error('current_password', 'updatePassword')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="update_password_password" class="form-label">
                        {{ __('New Password') }}
                    </label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-key"></i></span>
                        <input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password" required>
                    </div>
                    @error('password', 'updatePassword')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="update_password_password_confirmation" class="form-label">
                        {{ __('Confirm Password') }}
                    </label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                        <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" required>
                    </div>
                    @error('password_confirmation', 'updatePassword')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex align-items-center gap-3">
                    <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm">
                        <i class="bi bi-save me-1"></i> {{ __('Save') }}
                    </button>

                    @if (session('status') === 'password-updated')
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 3000)"
                            class="text-success fw-semibold m-0"
                        >
                            <i class="bi bi-check-circle-fill me-1"></i> {{ __('Saved.') }}
                        </p>
                    @endif
                </div>
            </form>
        </div>

</section>
