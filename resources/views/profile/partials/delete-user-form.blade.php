<section class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-5">
            <header class="mb-4">
                <h2 class="h4 fw-bold text-danger">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ __('Delete Account') }}
                </h2>
                <p class="text-muted mb-0">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                </p>
            </header>

            <!-- Button untuk membuka modal -->
            <button type="button" class="btn btn-outline-danger fw-semibold mt-3 px-4" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                <i class="bi bi-trash-fill me-1"></i> {{ __('Delete Account') }}
            </button>
        </div>
    </div>

    <!-- Modal Konfirmasi -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header bg-danger text-white rounded-top-4">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">
                        <i class="bi bi-x-circle-fill me-2"></i> {{ __('Confirm Account Deletion') }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p class="text-muted">
                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}
                    </p>
                    <p class="fw-semibold text-danger">
                        {{ __('Please enter your password to confirm account deletion.') }}
                    </p>

                    <form method="post" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')

                        <!-- Input Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">
                                <i class="bi bi-lock-fill me-1"></i> {{ __('Password') }}
                            </label>
                            <input type="password" class="form-control rounded-3" id="password" name="password" placeholder="{{ __('Enter your password') }}" required>
                            @error('password', 'userDeletion')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                                {{ __('Cancel') }}
                            </button>
                            <button type="submit" class="btn btn-danger px-4">
                                <i class="bi bi-trash me-1"></i> {{ __('Delete Account') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
