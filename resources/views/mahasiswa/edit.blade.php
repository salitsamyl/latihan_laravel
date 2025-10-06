<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <form action="{{ route('mahasiswa.update', $mhs->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">Nama</label>
                        <input type="text" name="nama" value="{{ old('nama', $mhs->nama) }}"
                            class="border rounded w-full px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">NIM</label>
                        <input type="text" name="nim" value="{{ old('nim', $mhs->nim) }}"
                            class="border rounded w-full px-3 py-2">
                    </div>
                    
                    <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300">Kelas</label>
                    <select name="kelas_id" class="border-gray-300 rounded-md w-full text-black">
                        <option value="" class="text-black" disabled>-- Pilih Kelas --</option>
                        @foreach ($kelas as $kls)
                        <option value="{{$kls->id}}" {{$mhs->kelas_id == $kls->id ? 'selected' : ''}} class="text-black">{{$kls->nm_kelas}}</option>                 
                        @endforeach
                    </select>
                    </div>

                    <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300">Jurusan</label>
                    <select name="jurusan_id" class="border-gray-300 rounded-md w-full text-black">
                        <option value="" class="text-black" disabled>-- Pilih Jurusan --</option>
                        @foreach ($jurusan as $j)
                        <option value="{{$j->id}}" {{$mhs->jurusan_id == $j->id ? 'selected' : ''}} class="text-black">{{$j->jurusan}}</option>                 
                        @endforeach
                    </select>
                    </div>

                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>