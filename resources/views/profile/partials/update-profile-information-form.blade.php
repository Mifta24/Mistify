<section class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-5">
            <header class="mb-4">
                <h2 class="h4 fw-bold text-primary">
                    <i class="bi bi-person-circle me-2"></i> {{ __('Profile Information') }}
                </h2>
                <p class="text-muted mb-0">
                    {{ __("Update your account's profile information and email address.") }}
                </p>
            </header>

            <!-- Email Verification Form -->
            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>

            <!-- Update Profile Form -->
            <form method="post" action="{{ route('profile.update') }}" class="mt-4">
                @csrf
                @method('patch')

                <!-- Name Input -->
                <div class="mb-4">
                    <label for="name" class="form-label fw-semibold">
                        <i class="bi bi-person-fill me-1"></i> {{ __('Name') }}
                    </label>
                    <input id="name" name="name" type="text" class="form-control rounded-3"
                           value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                    @error('name')
                        <div class="text-danger mt-1 small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Input -->
                <div class="mb-4">
                    <label for="email" class="form-label fw-semibold">
                        <i class="bi bi-envelope-fill me-1"></i> {{ __('Email') }}
                    </label>
