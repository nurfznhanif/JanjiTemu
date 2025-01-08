<x-mahasiswa.mahasiswa-app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form Reservasi Dosen ' . $dosen->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mt-10 sm:mt-0">
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="md:col-span-1">
                                <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">Data Mahasiswa</h3>
                                    <p class="mt-1 text-sm text-gray-600">Silahkan pilih jadwal dosen dan masukkan data mahasiswa yang akan bertemu dengan dosen.</p>
                                </div>
                            </div>
                            <div class="mt-5 md:mt-0 md:col-span-2">
                                <form action="{{ route('reservasi.dosen', $dosen->id) }}" method="POST">
                                    @csrf
                                    <div class="shadow overflow-hidden sm:rounded-md">
                                        <div class="px-4 py-5 bg-white sm:p-6">
                                            <div class="grid grid-cols-6 gap-6">
                                                <!-- Nama Dosen -->
                                                <div class="col-span-6">
                                                    <p class="mt-1 text-lg text-gray-600">Nama Dosen:
                                                        {{ $dosen->name }}
                                                    </p>
                                                </div>

                                                <!-- Pilih Jadwal -->
                                                <div class="col-span-6 sm:col-span-3">
                                                    <label for="jadwal_dosen" class="block text-sm font-medium text-gray-700">Pilih Jadwal Dosen</label>
                                                    <select id="jadwal_dosen" name="jadwal_dosen" required
                                                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#00D9A5] focus:border-[#00D9A5] sm:text-sm">
                                                        <option value="" disabled selected>Pilih jadwal</option>
                                                        @foreach ($jadwals as $jadwal)
                                                        <option value="{{ $jadwal->id }}">
                                                            {{ $jadwal->date }} - {{ $jadwal->time }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!-- Nama Mahasiswa -->
                                                <div class="col-span-6 sm:col-span-2">
                                                    <label for="first-name" class="block text-sm font-medium text-gray-700">Nama Awal</label>
                                                    <input type="text" name="first_name" id="first-name" autocomplete="given-name"
                                                        class="mt-1 focus:ring-[#00D9A5] focus:border-[#00D9A5] block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                </div>

                                                <div class="col-span-6 sm:col-span-2">
                                                    <label for="middle-name" class="block text-sm font-medium text-gray-700">Nama Tengah <span class="text-xs text-red-600">Kosongkan jika tidak ada</span></label>
                                                    <input type="text" name="middle_name" id="middle-name" autocomplete="additional-name"
                                                        class="mt-1 focus:ring-[#00D9A5] focus:border-[#00D9A5] block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                </div>

                                                <div class="col-span-6 sm:col-span-2">
                                                    <label for="last-name" class="block text-sm font-medium text-gray-700">Nama Akhir</label>
                                                    <input type="text" name="last_name" id="last-name" autocomplete="family-name"
                                                        class="mt-1 focus:ring-[#00D9A5] focus:border-[#00D9A5] block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                </div>

                                                <!-- Keperluan -->
                                                <div class="col-span-6">
                                                    <label for="keperluan" class="block text-sm font-medium text-gray-700">Keperluan</label>
                                                    <select id="keperluan" name="keperluan" required
                                                        class="block p-2.5 w-full rounded-md text-sm sm:text-sm text-gray-900 border border-gray-300 focus:ring-[#00D9A5] focus:border-[#00D9A5]">
                                                        <option value="" disabled selected>Pilih keperluan...</option>
                                                        <option value="Bimbingan PA">Bimbingan PA</option>
                                                        <option value="Bimbingan KP">Bimbingan KP</option>
                                                        <option value="Bimbingan Skripsi">Bimbingan Skripsi</option>
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="px-4 py-3 bg-gray-50 text-left sm:px-6">
                                            <x-button type="submit">Kirim</x-button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-mahasiswa.mahasiswa-app>
