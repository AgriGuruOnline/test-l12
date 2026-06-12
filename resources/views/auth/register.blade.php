<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="{{ $errors->has('name') ? 'has-error' : '' }}">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4 {{ $errors->has('email') ? 'has-error' : '' }}">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 {{ $errors->has('password') ? 'has-error' : '' }}">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4 {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-primary-button>
                {{ __('Register') }}
            </x-primary-button>
        </div>

        <div class="mt-6 text-center border-t auth-divider pt-4">
            <span class="text-sm auth-text-muted">
                {{ __('Already registered?') }}
            </span>
            <a class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:underline ms-1" href="{{ route('login') }}">
                {{ __('Log in here') }}
            </a>
        </div>
    </form>
</x-guest-layout>
