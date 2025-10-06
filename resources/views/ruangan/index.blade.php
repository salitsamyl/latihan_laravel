<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Ruangan') }}
        </h2>
    </x-slot>

    @if (session('alert'))
    <div x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 3000)"
        x-transition
        class="p-2 rounded mb-2
        @if(session('type') == 'success') bg-green-100 text-green-700
        @elseif(session('type') == 'danger') bg-red-100 text-red-700
        @endif">
        {{ session('alert') }}
    </div>
    
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Form Tambah Mahasiswa -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg mb-4">Tambah Ruangan</h3>
                    <form method="POST" action="{{ route('ruangan.store') }}" class="space-y-4">
            @csrf
            <input type="text" name="nm_ruangan" placeholder="Nama Ruangan"
                class="border-gray-300 rounded-md w-full text-black">

            <input type="text" name="kapasitas" placeholder="Kapasitas"
                class="border-gray-300 rounded-md w-full text-black">

            <button type="submit"
                class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700 text-align-right">
                Simpan
            </button>
        </form>

                </div>
            </div>

            <!-- List Mahasiswa -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg mb-4">List Ruangan</h3>
                    <table class="table-auto w-full border">
                        <thead class="bg-gray-200 text-gray-700">
                            <tr>
                                <th class="px-4 py-2 w-16 text-center">No</th>
                                <th class="px-4 py-2">Ruangan</th>
                                <th class="px-4 py-2">Kapasitas</th>
                                <th class="px-4 py-2 w-40 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $ruang)
                        <tr>
                            <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2">{{ $ruang->nm_ruangan }}</td>
                            <td class="border px-4 py-2 text-center">{{ $ruang->kapasitas }}</td>
                            <td class="border px-4 py-2 text-center">
                                <a href="{{ route('ruangan.edit', $ruang->id) }}"
                                    class="inline-block px-3 py-1 bg-yellow-500 text-white rounded">Edit</a>
                                <form action="{{ route('ruangan.destroy', $ruang->id) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Hapus data ini?')"
                                            class="px-3 py-1 bg-red-600 text-white rounded">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
</x-app-layout>


