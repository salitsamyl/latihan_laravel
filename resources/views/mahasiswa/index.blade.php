<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Mahasiswa') }}
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
                    <h3 class="font-semibold text-lg mb-4">Tambah Mahasiswa</h3>
                    <form method="POST" action="{{ route('mahasiswa.store') }}" class="space-y-4">
            @csrf
            <input type="text" name="nama" placeholder="Nama"
                class="border-gray-300 rounded-md w-full text-black">

            <input type="text" name="nim" placeholder="NIM"
                class="border-gray-300 rounded-md w-full text-black">
                @error('nim')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            
            <select name="kelas_id" class="border-gray-300 rounded-md w-full text-gray-500">
                <option value="" class="text-black">-- Pilih Kelas --</option>
                @foreach ($kelas as $kls)
                <option value="{{$kls->id}}" class="text-black">{{$kls->nm_kelas}}</option>                 
                @endforeach
            </select>

            <select name="jurusan_id" class="border-gray-300 rounded-md w-full text-gray-500">
                <option value="" class="text-black">-- Pilih Jurusan --</option>
                @foreach ($jurusan as $j)
                <option value="{{$j->id}}" class="text-black">{{$j->jurusan}}</option>                 
                @endforeach
            </select>

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
                    <h3 class="font-semibold text-lg mb-4">List Mahasiswa</h3>
                    <table class="table-auto w-full border">
                        <thead class="bg-gray-200 text-gray-700">
                            <tr>
                                <th class="px-4 py-2 w-16 text-center">No</th>
                                <th class="px-4 py-2">Nama</th>
                                <th class="px-4 py-2">NIM</th>
                                <th class="px-4 py-2">Kelas</th>
                                <th class="px-4 py-2">Jurusan</th>
                                <th class="px-4 py-2 w-40 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $mhs)
                        <tr>
                            <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2">{{ $mhs->nama }}</td>
                            <td class="border px-4 py-2 text-center">{{ $mhs->nim }}</td>
                            <td class="border px-4 py-2 text-center">{{ $mhs->kelas->nm_kelas ?? '-' }}</td>
                            <td class="border px-4 py-2 text-center">{{ $mhs->jurusan->jurusan ?? '-' }}</td>
                            <td class="border px-4 py-2 text-center">
                                <a href="{{ route('mahasiswa.edit', $mhs->id) }}"
                                    class="inline-block px-3 py-1 bg-yellow-500 text-white rounded">Edit</a>
                                <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST"
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


