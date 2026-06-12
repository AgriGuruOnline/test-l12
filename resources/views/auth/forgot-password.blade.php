<x-guest-layout>
    <div class="mb-5 text-sm auth-text-muted leading-relaxed">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="{{ $errors->has('email') ? 'has-error' : '' }}">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>

        <div class="mt-6 text-center border-t auth-divider pt-4">
            <a class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:underline" href="{{ route('login') }}">
                {{ __('Back to login') }}
            </a>
        </div>
    </form>
</x-guest-layout>
