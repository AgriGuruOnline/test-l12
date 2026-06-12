<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="{{ $errors->has('email') ? 'has-error' : '' }}">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 {{ $errors->has('password') ? 'has-error' : '' }}">
            <div class="flex items-center justify-between">
                <x-input-label for="password" :value="__('Password')" />
            </div>
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" name="remember">
                <span class="ms-2 text-sm auth-text-muted hover:text-gray-900 dark:hover:text-gray-100 transition duration-150">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="mt-6">
            <x-primary-button>
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <div class="flex items-center justify-between mt-4">
            @if (Route::has('password.request'))
                <a class="text-sm auth-text-muted hover:underline" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <div class="mt-6 text-center border-t auth-divider pt-4">
            <span class="text-sm auth-text-muted">
                {{ __("Don't have an account?") }}
            </span>
            @if (Route::has('register'))
                <a class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:underline ms-1" href="{{ route('register') }}">
                    {{ __('Register here') }}
                </a>
            @endif
        </div>
    </form>
</x-guest-layout>
