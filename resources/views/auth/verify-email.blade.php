<x-guest-layout>
    <div class="mb-5 text-sm auth-text-muted leading-relaxed">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-5 font-semibold text-sm text-emerald-600 dark:text-emerald-400 leading-normal">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-6 flex flex-col gap-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button class="w-full">
                {{ __('Resend Verification Email') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="text-center">
            @csrf
            <button type="submit" class="text-sm font-semibold text-rose-500 dark:text-rose-400 hover:underline bg-transparent border-none cursor-pointer">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
