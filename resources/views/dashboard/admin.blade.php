<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard Administrator
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white  overflow-hidden shadow-xl sm:rounded-xl">
                <div class="p-10">

                    <!-- Welcome -->
                    <div class="text-center mb-12">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 mb-6 shadow-2xl">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h1 class="text-4xl font-extrabold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                            Halo, {{ auth()->user()->name }}!
                        </h1>
                        <p class="text-lg text-gray-600 dark:text-gray-400 mt-2">Sistem Informasi Akademik PNJ</p>
                        <p class="text-sm text-gray-500">{{ now()->translatedFormat('l, d F Y • H:i') }} WIB</p>
                    </div>

                    <!-- Grid + Semua card tinggi sama -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                        <!-- 1. Mahasiswa -->
                        <a href="{{ route('mahasiswa.index') }}"
                           class="group block transform hover:scale-105 transition duration-300 {{ request()->routeIs('mahasiswa.*') ? 'ring-4 ring-indigo-300 dark:ring-indigo-700' : '' }}">
                            <div class="bg-gradient-to-br from-indigo-500 via-indigo-600 to-purple-700 p-8 rounded-2xl shadow-lg hover:shadow-2xl flex flex-col justify-between min-h-48">
                                <div>
                                    <h3 class="text-2xl font-bold text-white">Mahasiswa</h3>
                                    <p class="text-indigo-100 mt-2">Data, KRS, transkrip, status</p>
                                </div>
                                <svg class="w-12 h-12 text-white opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                        </a>

                        <!-- 2. Ruangan -->
                        <a href="{{ route('ruangan.index') }}"
                           class="group block transform hover:scale-105 transition duration-300 {{ request()->routeIs('ruangan.*') ? 'ring-4 ring-green-300 dark:ring-green-700' : '' }}">
                            <div class="bg-gradient-to-br from-emerald-500 via-green-600 to-teal-700 p-8 rounded-2xl shadow-lg hover:shadow-2xl flex flex-col justify-between min-h-48">
                                <div>
                                    <h3 class="text-2xl font-bold text-white">Ruangan</h3>
                                    <p class="text-green-100 mt-2">Jadwal ruang & kapasitas</p>
                                </div>
                                <svg class="w-12 h-12 text-white opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        </a>

                        <!-- 3. Matakuliah -->
                        <a href="{{ route('matkul.index') }}"
                           class="group block transform hover:scale-105 transition duration-300 {{ request()->routeIs('matkul.*') ? 'ring-4 ring-purple-300 dark:ring-purple-700' : '' }}">
                            <div class="bg-gradient-to-br from-purple-500 via-purple-600 to-pink-600 p-8 rounded-2xl shadow-lg hover:shadow-2xl flex flex-col justify-between min-h-48">
                                <div>
                                    <h3 class="text-2xl font-bold text-white">Matakuliah</h3>
                                    <p class="text-purple-100 mt-2">Kurikulum, SKS, silabus</p>
                                </div>
                                <svg class="w-12 h-12 text-white opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                        </a>

                        <!-- 4. Dosen -->
                        <a href="{{ route('dosen.index') }}"
                           class="group block transform hover:scale-105 transition duration-300 {{ request()->routeIs('dosen.*') ? 'ring-4 ring-yellow-300 dark:ring-yellow-700' : '' }}">
                            <div class="bg-gradient-to-br from-amber-500 via-orange-500 to-orange-600 p-8 rounded-2xl shadow-lg hover:shadow-2xl flex flex-col justify-between min-h-48">
                                <div>
                                    <h3 class="text-2xl font-bold text-white">Dosen</h3>
                                    <p class="text-yellow-100 mt-2">Data pengajar & jadwal</p>
                                </div>
                                <svg class="w-12 h-12 text-white opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                        </a>

                        <!-- 5. EKYC -->
                        <a href="{{ route('admin.ekyc.index') }}"
                           class="group block transform hover:scale-105 transition duration-300 {{ request()->routeIs('admin.ekyc.*') || request()->routeIs('admin.*') ? 'ring-4 ring-blue-300 dark:ring-blue-700' : '' }}">
                            <div class="bg-gradient-to-br from-blue-500 via-cyan-500 to-cyan-600 p-8 rounded-2xl shadow-lg hover:shadow-2xl flex flex-col justify-between min-h-48">
                                <div>
                                    <h3 class="text-2xl font-bold text-white">EKYC Registration</h3>
                                    <p class="text-blue-100 mt-2">Verifikasi calon mahasiswa</p>
                                </div>
                                <svg class="w-12 h-12 text-white opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm6 0a2 2 0 100-4 2 2 0 000 4z"></path>
                                </svg>
                            </div>
                        </a>

                        <!-- 6. Landing Page -->
                        <a href="{{ route('admin.landing.settings.index') }}"
                           class="group block transform hover:scale-105 transition duration-300 {{ request()->is('admin/landing*') ? 'ring-4 ring-rose-300 dark:ring-rose-700' : '' }}">
                            <div class="bg-gradient-to-br from-rose-500 via-pink-500 to-pink-600 p-8 rounded-2xl shadow-lg hover:shadow-2xl flex flex-col justify-between min-h-48">
                                <div>
                                    <h3 class="text-2xl font-bold text-white">Landing Page</h3>
                                    <p class="text-rose-100 mt-2">Kelola konten website publik</p>
                                </div>
                                <svg class="w-12 h-12 text-white opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6h8m-8 6h8m-8 6h8M3 6h.01M7 6h.01M11 6h.01M3 12h.01M7 12h.01M11 12h.01M3 18h.01M7 18h.01M11 18h.01"></path>
                                </svg>
                            </div>
                        </a>

                    </div>

                    <div class="mt-16 text-center text-gray-600 dark:text-gray-400">
                        <p>Klik menu di sidebar atau kartu di atas untuk mulai mengelola data</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>