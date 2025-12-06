<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Footer Links') }}
        </h2>
    </x-slot>

    <div x-data="footerPage()" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Flash Message -->
            @if(session('success'))
                <div class="p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Header + Tombol Tambah -->
            <div class="flex justify-between items-center">
                <h3 class="text-2xl font-bold text-gray-900 dark:text-black">
                    Daftar Footer Links
                </h3>
                <button @click="openCreateModal()"
                        class="inline-flex items-center gap-2 px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Link
                </button>
            </div>

            <!-- Tabel -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Pos</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Label</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">URL</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($links as $item)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <td class="px-6 py-4 text-center text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $item->position ?? $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $item->label }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400 font-mono text-xs">
                                        {{ $item->url }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex px-3 py-1.5 text-xs font-semibold rounded-full text-white
                                            {{ $item->status ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-600' }}">
                                            {{ $item->status ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center space-x-3">
                                        <button @click="openEditModal({{ $item }})"
                                                class="text-indigo-500 hover:text-indigo-800 font-medium mr-4 inline-flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                            </svg>
                                            Edit
                                        </button>

                                        <form action="{{ route('admin.landing.footer.destroy', $item->id) }}"
                                              method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('Yakin hapus link ini?')"
                                                    class="text-red-600 hover:text-red-800 font-medium inline-flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                        d="M19 7l-.867 12.142A2.175 2.175 0 0116.138 21H7.862a2.175 2.175 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                            @if($links->isEmpty())
                                <div class="text-center py-12 text-gray-500 text-lg">
                                    Belum ada data footer link.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Modal Create -->
                <template x-teleport="body">
                    <div x-show="showCreate" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50" x-transition>
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-md p-6">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-2xl font-bold">Tambah Footer Link</h3>
                                <button @click="showCreate = false" class="text-gray-500 hover:text-gray-700">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>

                            <form action="{{ route('admin.landing.footer.store') }}" method="POST" class="space-y-5">
                                @csrf
                                <div>
                                    <label class="block text-sm font-medium mb-2">Label</label>
                                    <input type="text" name="label" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-2">URL</label>
                                    <input type="text" name="url" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-2">Status</label>
                                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                                        <option value="1">Aktif</option>
                                        <option value="0">Nonaktif</option>
                                    </select>
                                </div>
                                <div class="flex justify-end gap-3 pt-4">
                                    <button type="button" @click="showCreate = false" class="px-6 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg">
                                        Batal
                                    </button>
                                    <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </template>

                <!-- Modal Edit -->
                <template x-teleport="body">
                    <div x-show="showEdit" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50" x-transition>
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-md p-6">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-2xl font-bold text-white">Edit Footer Link</h3>
                                <button @click="showEdit = false" class="text-gray-500 hover:text-gray-700">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>

                            <form :action="`/admin/landing/footer/${editData.id}`" method="POST" class="space-y-5">
                                @csrf @method('PUT')

                                <div>
                                    <label class="block text-sm font-medium mb-2">Label</label>
                                    <input type="text" name="label" :value="editData.label" required
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-2">URL</label>
                                    <input type="text" name="url" :value="editData.url" required
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-2">Status</label>
                                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                                        <option value="1" :selected="editData.status == 1">Aktif</option>
                                        <option value="0" :selected="editData.status == 0">Nonaktif</option>
                                    </select>
                                </div>

                                <div class="flex justify-end gap-3 pt-4">
                                    <button type="button" @click="showEdit = false" class="px-6 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg">
                                        Batal
                                    </button>
                                    <button type="submit" class="px-6 py-2 bg-yellow-600 hover:bg-yellow-700 text-white font-medium rounded-lg">
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </template>
            </div>

            <script>
                function footerPage() {
                    return {
                        showCreate: false,
                        showEdit: false,
                        editData: {},

                        openCreateModal() {
                            this.showCreate = true;
                        },

                        openEditModal(item) {
                            this.editData = {
                                id: item.id,
                                label: item.label,
                                url: item.url,
                                status: Number(item.status)
                            };
                            this.showEdit = true;
                        }
                    }
                }
            </script>
        </x-app-layout>