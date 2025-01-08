<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Masukkan password baru Anda.') }}
    </div>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div>
            <x-label for="email" :value="__('Email')" />
            <x-input id="email" class="block mt-1 w-full" type="email" name="email" required autofocus />
        </div>

        <div class="mt-4">
            <x-label for="password" :value="__('Password Baru')" />
            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
        </div>

        <div class="mt-4">
            <x-label for="password_confirmation" :value="__('Konfirmasi Password')" />
            <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button>
                {{ __('Reset Password') }}
            </x-button>
        </div>
    </form>
</x-guest-layout>
