<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center">
        <div class="backdrop-blur-xl bg-white/30 border border-white/40 rounded-2xl shadow-2xl px-10 py-12 w-full max-w-md">
            <div class="flex justify-center mb-8">
                <a href="/">
                    <x-application-logo class="w-16 h-16 text-white" />
                </a>
            </div>

            <h2 class="text-white text-2xl font-bold text-center mb-6">Welcome Back</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-center text-sm font-medium text-green-200" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-white" />
                    <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 placeholder-gray-500 text-gray-900focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" placeholder="you@example.com"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-200" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-white" />
                    <x-text-input id="password" class="w-full rounded-md border-none bg-white/80 px-4 py-3 placeholder-gray-500 focus:ring-2 focus:ring-white focus:outline-none"
                                  type="password" name="password" required autocomplete="current-password" placeholder="********" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-200" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="flex items-center space-x-2 text-sm text-white">
                        <input id="remember_me" type="checkbox" name="remember" class="rounded border-white text-indigo-600 focus:ring-white" />
                        <span>{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-white hover:underline" href="{{ route('password.request') }}">
                            {{ __('Forgot password?') }}
                        </a>
                    @endif
                </div>

                <!-- Submit -->
                <div>
                    <x-primary-button class="w-full py-3 bg-white text-indigo-600 font-semibold rounded-md shadow-md hover:bg-gray-100 transition flex justify-center">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('register') }}" class="text-sm text-white hover:underline">
                    {{ __("Don't have an account? Register") }}
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
