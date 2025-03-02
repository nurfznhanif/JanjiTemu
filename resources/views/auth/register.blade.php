<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="{{ asset('assets/img/Logo_UIR-cdr.png') }}" alt="Logo" class="w-20 h-20">
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" id="register-form">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" placeholder="Masukkan Nama" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" placeholder="Masukkan Email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Jurusan -->
            <div class="mt-4">
                <x-label for="jurusan" :value="__('Jurusan')" />
                <x-input id="jurusan" class="block mt-1 w-full" type="text" name="jurusan" :value="old('jurusan')" required />
            </div>

            <!-- No HP -->
            <div class="mt-4">
                <x-label for="no_hp" :value="__('Nomor HP')" />
                <x-input
                    id="no_hp"
                    class="block mt-1 w-full"
                    type="tel"
                    name="no_hp"
                    :value="old('no_hp')"
                    pattern="[0-9]{10,13}"
                    title="Nomor HP harus terdiri dari 10 hingga 13 angka"
                    placeholder="Masukkan Nomor HP Anda"
                    required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" placeholder="Masukkan Password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" placeholder="Masukkan Password Kembali" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required />
            </div>

            <!-- Selecting Role -->
            <div class="mt-4">
                <x-label for="role_id" :value="__('Register Sebagai')" />
                <select name="role_id" onchange="onChangeRole(this)"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full">
                    <option value="{{ route('register') }}">Mahasiswa</option>
                    <option value="{{ route('dosen.register') }}" @if (old('role_id')==route('dosen.register')) selected @endif>Dosen</option>
                </select>
            </div>

            <!-- Selecting Gender -->
            <div class="mt-4">
                <x-label for="gender" :value="__('Jenis Kelamin')" />
                <select name="gender" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full">
                    <option value="L">Laki-laki</option>
                    <option value="P" @if (old('gender')=='P' ) selected @endif>Perempuan</option>
                </select>
            </div>

            <div class="flex items-center justify-start mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
            </div>

            <x-button class="block w-full mt-4">
                {{ __('Buat Akun') }}
            </x-button>

            <script>
                function onChangeRole(selectObject) {
                    var value = selectObject.value;
                    document.getElementById('register-form').action = value;
                }
            </script>
        </form>
    </x-auth-card>
</x-guest-layout>
