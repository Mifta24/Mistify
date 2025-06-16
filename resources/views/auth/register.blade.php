<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center">
        <div class="backdrop-blur-xl bg-white/30 border border-white/40 rounded-2xl shadow-2xl px-10 py-12 w-full max-w-md">
            <h2 class="text-white text-2xl font-bold text-center mb-6">
                Create Your Account
            </h2>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" class="text-white" />
                    <x-text-input
                        id="name"
                        type="text"
                        name="name"
                        :value="old('name')"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="Your full name"
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                    />
                    <x-input-error :messages="$errors->get('name')" class="mt-1 text-sm text-red-200" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-white" />
                    <x-text-input
                        id="email"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autocomplete="username"
                        placeholder="you@example.com"
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-200" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-white" />
                    <x-text-input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        placeholder="********"
                        class="w-full rounded-md border-none bg-white/80 px-4 py-3 placeholder-gray-500 focus:ring-2 focus:ring-white focus:outline-none"
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-200" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-white" />
                    <x-text-input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="Re-enter password"
                        class="w-full rounded-md border-none bg-white/80 px-4 py-3 placeholder-gray-500 focus:ring-2 focus:ring-white focus:outline-none"
                    />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-sm text-red-200" />
                </div>

                <!-- Submit Button -->
                <div>
                    <x-primary-button class="w-full py-3 bg-white text-indigo-600 font-semibold rounded-md shadow-md hover:bg-gray-100 transition flex justify-center">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('login') }}" class="text-sm text-white hover:underline">
                    {{ __('Already registered? Log in') }}
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
