<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Dosen') }}
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
                    <h3 class="font-semibold text-lg mb-4">Tambah Dosen</h3>
                    <form method="POST" action="{{ route('dosen.store') }}" class="space-y-4">
            @csrf
            <input type="text" name="NID" placeholder="NID"
                class="border-gray-300 rounded-md w-full text-black">
                @error('NID')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

            <input type="text" name="namaD" placeholder="Nama"
                class="border-gray-300 rounded-md w-full text-black">
            
            <select name="matkul_id" class="border-gray-300 rounded-md w-full text-gray-500" >
                <option value="" class="text-black" required>-- Pilih Matkul --</option>
                @foreach ($matkul as $m)
                <option value="{{$m->id}}" class="text-black">{{$m->matkul}}</option>                 
                @endforeach
            </select>

            <input type="text" name="alamat" placeholder="Alamat"
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
                    <h3 class="font-semibold text-lg mb-4">List Dosen</h3>
                    <table class="table-auto w-full border">
                        <thead class="bg-gray-200 text-gray-700">
                            <tr>
                                <th class="px-4 py-2 w-16 text-center">No</th>
                                <th class="px-4 py-2">NID</th>
                                <th class="px-4 py-2">Nama</th>
                                <th class="px-4 py-2">Matakuliah</th>
                                <th class="px-4 py-2">Alamat</th>
                                <th class="px-4 py-2 w-40 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $dosen)
                        <tr>
                            <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2">{{ $dosen->NID }}</td>
                            <td class="border px-4 py-2 text-center">{{ $dosen->namaD }}</td>
                            <td class="border px-4 py-2 text-center">{{ $dosen->matkul->matkul ?? '-' }}</td>
                            <td class="border px-4 py-2 text-center">{{ $dosen->alamat}}</td>
                            <td class="border px-4 py-2 text-center">
                                <a href="{{ route('dosen.edit', $dosen->id) }}"
                                    class="inline-block px-3 py-1 bg-yellow-500 text-white rounded">Edit</a>
                                <form action="{{ route('dosen.destroy', $dosen->id) }}" method="POST"
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
    </div>
</x-app-layout>


