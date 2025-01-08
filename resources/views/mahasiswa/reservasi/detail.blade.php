<x-mahasiswa.mahasiswa-app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reservasi ') . $reservasi->Keperluan }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" id="reservasi-detail-form">
                        @csrf
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <!-- Nama Dosen -->
                                    <div class="col-span-6">
                                        <p class="mt-1 text-lg text-gray-600">Nama Dosen: {{ $reservasi->dosen_name }}</p>
                                    </div>

                                    <!-- Nama Awal -->
                                    <div class="col-span-6 sm:col-span-2">
                                        <label for="first-name" class="block text-sm font-medium text-gray-700">
                                            Nama Awal
                                        </label>
                                        <input type="text" name="first_name" id="first-name" autocomplete="given-name"
                                            class="mt-1 focus:ring-[#00D9A5] focus:border-[#00D9A5] block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                            value="{{ old('first_name', $reservasi->nama_awal) }}">
                                    </div>

                                    <!-- Nama Tengah -->
                                    <div class="col-span-6 sm:col-span-2">
                                        <label for="middle-name" class="block text-sm font-medium text-gray-700">
                                            Nama Tengah <span class="text-xs text-red-600">(Kosongkan jika tidak ada)</span>
                                        </label>
                                        <input type="text" name="middle_name" id="middle-name" autocomplete="additional-name"
                                            class="mt-1 focus:ring-[#00D9A5] focus:border-[#00D9A5] block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                            value="{{ old('middle_name', $reservasi->nama_tengah) }}">
                                    </div>

                                    <!-- Nama Akhir -->
                                    <div class="col-span-6 sm:col-span-2">
                                        <label for="last-name" class="block text-sm font-medium text-gray-700">Nama Akhir</label>
                                        <input type="text" name="last_name" id="last-name" autocomplete="family-name"
                                            class="mt-1 focus:ring-[#00D9A5] focus:border-[#00D9A5] block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                            value="{{ old('last_name', $reservasi->nama_akhir) }}">
                                    </div>

                                    <!-- Pilih Jadwal -->
                                    <div class="col-span-6">
                                        <label for="jadwal_dosen" class="block text-sm font-medium text-gray-700">Pilih Jadwal</label>
                                        <select id="jadwal_dosen" name="jadwal_dosen" required
                                            class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#00D9A5] focus:border-[#00D9A5] sm:text-sm">
                                            <option value="" disabled {{ old('jadwal_dosen', $reservasi->id_jadwal ?? '') === '' ? 'selected' : '' }}>
                                                Pilih jadwal
                                            </option>
                                            @foreach ($jadwals as $jadwal)
                                                <option value="{{ $jadwal->id }}" {{ old('jadwal_dosen', $reservasi->id_jadwal ?? '') == $jadwal->id ? 'selected' : '' }}>
                                                    {{ $jadwal->date }} - {{ $jadwal->time }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Keperluan -->
                                    <div class="col-span-6">
                                        <label for="keperluan" class="block text-sm font-medium text-gray-700">Keperluan</label>
                                        <select id="keperluan" name="keperluan" required
                                            class="block p-2.5 w-full rounded-md text-sm sm:text-sm text-gray-900 border border-gray-300 focus:ring-[#00D9A5] focus:border-[#00D9A5]">
                                            <option value="" disabled {{ old('keperluan') ? '' : 'selected' }}>Pilih keperluan...</option>
                                            <option value="Bimbingan PA" {{ old('keperluan', $reservasi->keperluan) == 'Bimbingan PA' ? 'selected' : '' }}>Bimbingan PA</option>
                                            <option value="Bimbingan KP" {{ old('keperluan', $reservasi->keperluan) == 'Bimbingan KP' ? 'selected' : '' }}>Bimbingan KP</option>
                                            <option value="Bimbingan Skripsi" {{ old('keperluan', $reservasi->keperluan) == 'Bimbingan Skripsi' ? 'selected' : '' }}>Bimbingan Skripsi</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="px-4 py-3 bg-gray-50 text-left sm:px-6">
                                <x-button type="submit" formaction="{{ url('reservasi/list/'. $reservasi->id . '/update') }}">
                                    Perbarui
                                </x-button>
                                <x-button type="submit" formaction="{{ url('reservasi/list/'. $reservasi->id . '/delete') }}" class="bg-red-500 hover:bg-red-700">
                                    Batalkan Reservasi
                                </x-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-mahasiswa.mahasiswa-app>
