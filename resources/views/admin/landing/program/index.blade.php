<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Programs') }}
        </h2>
    </x-slot>

    <div x-data="programPage()" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Flash Messages -->
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg border border-green-400">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('deleted'))
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg border border-red-400">
                    {{ session('deleted') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg border border-red-400">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Header + Tombol Tambah -->
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-2xl font-bold text-gray-900 dark:text-black">
                    Daftar Program
                </h3>
                <button @click="openCreateModal()"
                        class="inline-flex items-center gap-2 px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-md transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Program
                </button>
            </div>

            <!-- Tabel -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Gambar</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Title</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Icon</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Pos</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($programs as $program)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <td class="px-6 py-4 text-center">
                                        @if($program->image)
                                            <img src="{{ asset('storage/'.$program->image) }}" class="h-12 mx-auto rounded-lg object-cover">
                                        @else
                                            <div class="h-12 w-20 mx-auto bg-gray-200 dark:bg-gray-600 rounded-lg flex items-center justify-center">
                                                <span class="text-xs text-gray-500">–</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $program->title }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                                        {{ $program->icon ?? '–' }}
                                    </td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-900 dark:text-gray-100">
                                        {{ $program->position }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full 
                                            {{ $program->status 
                                                ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' 
                                                : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                            {{ $program->status ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center text-sm space-x-3">
                                        <button @click="openEditModal(@json($program))"
                                                class="text-indigo-600 hover:text-indigo-800 font-medium inline-flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                            </svg>
                                            Edit
                                        </button>

                                        <form action="{{ route('admin.landing.programs.destroy', $program->id) }}"
                                              method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('Hapus program ini?')"
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

                    @if($programs->isEmpty())
                        <div class="text-center py-12 text-gray-500 dark:text-gray-400">
                            Belum ada data program.
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Modal Create -->
        <template x-teleport="body">
            <div x-show="showCreate" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50" x-transition>
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-lg">
                    <div class="flex justify-between items-center p-6 border-b dark:border-gray-700">
                        <h3 class="text-xl font-bold dark:text-white">Tambah Program Baru</h3>
                        <button @click="showCreate = false" class="text-gray-500 hover:text-gray-700 dark:text-gray-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <form method="POST" action="{{ route('admin.landing.programs.store') }}" enctype="multipart/form-data" class="p-6 space-y-5">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium mb-2 dark:text-white">Title</label>
                            <input type="text" name="title" required
                                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2 dark:text-white">Description</label>
                            <textarea name="description" rows="4"
                                      class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2 dark:text-white">Icon (FontAwesome / Emoji)</label>
                            <input type="text" name="icon"
                                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2 dark:text-white">Position</label>
                            <input type="number" name="position" value="0" required
                                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2 dark:text-white">Image</label>
                            <input type="file" name="image" accept="image/*"
                                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2 dark:text-white">Status</label>
                            <select name="status"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white">
                                <option value="1">Aktif</option>
                                <option value="0">Nonaktif</option>
                            </select>
                        </div>

                        <div class="flex justify-end gap-3 pt-4">
                            <button type="button" @click="showCreate = false"
                                    class="px-5 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition">
                                Batal
                            </button>
                            <button type="submit"
                                    class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </template>

        <!-- Modal Edit -->
        <template x-teleport="body">
            <div x-show="showEdit" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50" x-transition>
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-lg">
                    <div class="flex justify-between items-center p-6 border-b dark:border-gray-700">
                        <h3 class="text-xl font-bold dark:text-white">Edit Program</h3>
                        <button @click="showEdit = false" class="text-gray-500 hover:text-gray-700 dark:text-gray-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <form method="POST"
                          :action="`/admin/landing/programs/${editData.id}`"
                          enctype="multipart/form-data"
                          class="p-6 space-y-5">
                        @csrf @method('PUT')

                        <div>
                            <label class="block text-sm font-medium mb-2 dark:text-white">Title</label>
                            <input type="text" name="title" x-model="editData.title" required
                                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-yellow-500 dark:bg-gray-700 dark:text-white">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2 dark:text-white">Description</label>
                            <textarea name="description" x-model="editData.description" rows="4"
                                      class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2 dark:text-white">Icon</label>
                            <input type="text" name="icon" x-model="editData.icon"
                                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2 dark:text-white">Position</label>
                            <input type="number" name="position" x-model="editData.position" required
                                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2 dark:text-white">Image (biarkan kosong jika tidak diganti)</label>
                            <input type="file" name="image" accept="image/*"
                                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white">
                            <template x-if="editData.image">
                                <img :src="'/storage/' + editData.image" class="mt-3 h-32 w-full object-cover rounded-lg">
                            </template>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2 dark:text-white">Status</label>
                            <select name="status" x-model="editData.status"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white">
                                <option value="1">Aktif</option>
                                <option value="0">Nonaktif</option>
                            </select>
                        </div>

                        <div class="flex justify-end gap-3 pt-4">
                            <button type="button" @click="showEdit = false"
                                    class="px-5 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition">
                                Batal
                            </button>
                            <button type="submit"
                                    class="px-6 py-2 bg-yellow-600 hover:bg-yellow-700 text-white font-medium rounded-lg transition">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </template>
    </div>

    <script>
        function programPage() {
            return {
                showCreate: false,
                showEdit: false,
                editData: {},

                openCreateModal() {
                    this.showCreate = true;
                    this.showEdit = false;
                },

                openEditModal(item) {
                    this.editData = {
                        id: item.id,
                        title: item.title || '',
                        description: item.description || '',
                        icon: item.icon || '',
                        position: item.position || 0,
                        status: item.status ? 1 : 0,
                        image: item.image || ''
                    };
                    this.showEdit = true;
                    this.showCreate = false;
                }
            }
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</x-app-layout>