<x-mahasiswa.mahasiswa-app>
    <x-slot name="header">
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-2 lg:px-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <section class="bg-white dark:bg-gray-900">
                        <div class="container px-6 py-10 mx-auto">
                            <h1
                                class="text-3xl font-semibold text-start text-gray-800 capitalize lg:text-4xl dark:text-white">
                                Daftar Reservasi</h1>

                            <div class="grid grid-cols-1 gap-x-10 gap-y-6 mt-8 xl:mt-16 md:grid-cols-2 xl:grid-cols-2">
                                @foreach ($list_reservasi as $reservasi)
                                    <div
                                    @if (!$reservasi -> selesai)
                                        onclick="location.href='{{ route('reservasi.detail', $reservasi->id) }}'"
                                    @endif
                                        class="
                                        @if ($reservasi -> selesai)
                                            hover:bg-[#00D9A5]
                                        @else
                                            hover:bg-red-500
                                        @endif
                                        px-12 py-8 transition-colors duration-200 transform border cursor-pointer rounded-xl hover:border-transparent group dark:border-gray-700 dark:hover:border-transparent">
                                        <div class="flex flex-col sm:-mx-4 sm:flex-row">
                                            <img class="flex-shrink-0 object-cover w-24 h-24 rounded-full sm:mx-4 ring-4 ring-gray-300"
                                                src="https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_1280.png"
                                                alt="Foto Mahasiswa">

                                            <div class="mt-4 sm:mx-4 sm:mt-0">
                                                <h1
                                                    class="text-xl font-semibold text-gray-700 capitalize md:text-2xl dark:text-white group-hover:text-white">
                                                    {{ $reservasi->nama_awal . ' ' . $reservasi->nama_tengah . ' ' . $reservasi->nama_akhir }}
                                                </h1>

                                                <p
                                                    class="mt-2 text-gray-500 capitalize dark:text-gray-300 group-hover:text-white">
                                                    {{ $reservasi->tanggal }} </p>
                                                <p
                                                    class="mt-2 text-gray-500 capitalize dark:text-gray-300 group-hover:text-white">
                                                    Dosen: {{ $reservasi->dosen_name }} </p>
                                                <p
                                                    class="mt-2
                                                        @if ($reservasi->selesai) text-green-500
                                                        @else text-red-500 @endif capitalize dark:text-gray-300 group-hover:text-white">
                                                    @if ($reservasi->selesai)
                                                        Reservasi Selesai
                                                    @else
                                                        Reservasi dalam proses
                                                    @endif
                                                </p>


                                            </div>
                                        </div>

                                        <p
                                            class="mt-4 text-gray-500 capitalize dark:text-gray-300 group-hover:text-white">
                                            {{ $reservasi->pesan }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-mahasiswa.mahasiswa-app>
