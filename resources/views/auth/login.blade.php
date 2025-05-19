<x-guest-layout>
    <div class="w-full max-w-md px-8 py-10 bg-white rounded-2xl shadow-xl">
        <!-- Session Status -->
        <x-auth-session-status class="text-center text-sm font-semibold text-green-600 mb-6" :status="session('status')" />

        <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center tracking-tight">
            Welcome Back
        </h2>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium text-gray-700 mb-1" />
                <x-text-input
                    id="email"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                    autocomplete="username"
                    class="w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 placeholder-gray-500 text-gray-900
                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                    placeholder="you@example.com"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" class="block text-sm font-medium text-gray-700 mb-1" />
                <x-text-input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    class="w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 placeholder-gray-500 text-gray-900
                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                    placeholder="********"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center space-x-3">
                <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                <label for="remember_me" class="text-sm text-gray-700 select-none"> {{ __('Remember me') }} </label>
            </div>

            <!-- Submit Button -->
            <div>
                <x-primary-button class="w-full bg-indigo-600 hover:bg-indigo-700 flex justify-center items-center text-white text-base font-semibold py-3 rounded-lg transition shadow-md">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>

        <!-- Footer Links -->
        <div class="mt-6 text-center space-y-2 text-sm text-gray-600">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="block text-indigo-600 hover:underline hover:text-indigo-800 transition">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <a href="{{ route('register') }}" class="block text-indigo-600 hover:underline hover:text-indigo-800 transition">
                Don't have an account? Register
            </a>
        </div>
    </div>
</x-guest-layout>
