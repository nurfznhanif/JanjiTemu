<x-dosen.dosen-app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Jadwal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-2 lg:px-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="bg-white dark:bg-gray-900">
                        <div class="container px-6 py-10 mx-auto">
                            <form method="POST" action="{{ route('jadwal.dosen.update', $jadwal->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="date" class="block text-sm font-medium text-gray-700">Tanggal:</label>
                                        <input type="date" id="date" name="date" value="{{ $jadwal->date }}" required
                                               class="mt-1 block w-full px-3 py-2 bg-white border shadow-sm border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label for="time" class="block text-sm font-medium text-gray-700">Jam:</label>
                                        <input type="time" id="time" name="time" value="{{ $jadwal->time }}" required
                                               class="mt-1 block w-full px-3 py-2 bg-white border shadow-sm border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <button type="submit"
                                            style="background-color: #28a745; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; font-size: 14px; cursor: pointer;"
                                            onmouseover="this.style.backgroundColor='#218838';"
                                            onmouseout="this.style.backgroundColor='#28a745';"
                                            onfocus="this.style.outline='2px solid #1e7e34'; this.style.outlineOffset='2px';"
                                            onblur="this.style.outline='none';">
                                        Tambah Jadwal
                                    </button>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-dosen.dosen-app>
