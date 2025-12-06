<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Landing Page Settings') }}
        </h2>
    </x-slot>

    <div x-data="{ open:false, setting:null }" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Flash Message -->
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-lg border border-green-400  ">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg border border-red-400 dark:bg-red-900 dark:text-red-200 dark:border-red-700">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Header + Tombol Tambah -->
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-2xl font-bold text-gray-900 dark:text-black">
                    Landing Settings
                </h3>
                <button
                    @click="setting={key:'',value:'',type:'text',status:1}; open=true"
                    class="inline-flex items-center gap-2 px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-md transition"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Setting
                </button>
            </div>

            <!-- Tabel -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Key</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Value</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($settings as $setting)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $setting->key }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                                        @if($setting->type === 'image' && is_string($setting->value) && $setting->value)
                                            <img src="{{ asset('storage/' . $setting->value) }}" class="h-16 rounded-lg shadow-md">
                                        @elseif($setting->type === 'image')
                                            <span class="text-red-500 text-xs">No image uploaded</span>
                                        @elseif($setting->type === 'json')
                                            <pre class="bg-gray-100 dark:bg-gray-600 p-2 rounded text-xs font-mono">
{{ json_encode(json_decode($setting->value, true), JSON_PRETTY_PRINT) }}
                                            </pre>
                                        @else
                                            {{ Str::limit($setting->value, 60) }}
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 capitalize">
                                        {{ $setting->type }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full 
                                            {{ $setting->status 
                                                ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' 
                                                : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                            {{ $setting->status ? 'Aktif' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center text-sm">
                                        <button
                                            class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium inline-flex items-center gap-1"
                                            @click="open=true; setting={{ Js::from($setting) }}"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                            </svg>
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if($settings->isEmpty())
                        <div class="text-center py-12 text-gray-500 dark:text-gray-400">
                            Belum ada data settings.
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Modal -->
        <template x-teleport="body">
            <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50" x-transition>
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-2xl">
                    <div class="flex justify-between items-center p-6 border-b dark:border-gray-700">
                        <h3 class="text-xl font-bold dark:text-white" x-text="setting && setting.id ? 'Edit Setting' : 'Tambah Setting'"></h3>
                        <button @click="open = false" class="text-gray-500 hover:text-gray-700 dark:text-gray-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <form method="POST"
                          :action="setting && setting.id ? '{{ url('admin/landing/settings') }}/' + setting.id : '{{ route('admin.landing.settings.store') }}'"
                          enctype="multipart/form-data"
                          class="p-6 space-y-5">
                        @csrf

                        <template x-if="setting && setting.id">
                            @method('PUT')
                        </template>

                        <div>
                            <label class="block text-sm font-medium mb-2 dark:text-white">Key</label>
                            <input type="text" name="key" required
                                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                   x-model="setting.key">
                            <small x-show="setting && setting.id" class="text-gray-500 dark:text-gray-400 text-xs mt-1">Key cannot be changed</small>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2 dark:text-white">Type</label>
                            <select name="type" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white" x-model="setting.type">
                                <option value="text">Text</option>
                                <option value="textarea">Textarea</option>
                                <option value="image">Image</option>
                                <option value="json">JSON</option>
                            </select>
                        </div>

                        <!-- FIELD UNTUK IMAGE -->
                        <template x-if="setting && setting.type === 'image'">
                            <div>
                                <label class="block text-sm font-medium mb-2 dark:text-white">Upload Image</label>
                                <input type="file" name="image" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white" accept="image/*">
                                
                                <!-- Tampilkan gambar current -->
                                <template x-if="setting && setting.value">
                                    <div class="mt-3">
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Current Image:</p>
                                        <img :src="'{{ asset('storage') }}/' + setting.value" class="h-24 rounded-lg shadow-md mt-2">
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1" x-text="setting.value"></p>
                                    </div>
                                </template>
                            </div>
                        </template>

                        <!-- FIELD UNTUK NON-IMAGE -->
                        <template x-if="setting && setting.type !== 'image'">
                            <div>
                                <label class="block text-sm font-medium mb-2 dark:text-white">Value</label>
                                
                                <!-- Textarea untuk type textarea dan json -->
                                <template x-if="setting.type === 'textarea' || setting.type === 'json'">
                                    <textarea name="value" rows="5"
                                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg font-mono dark:bg-gray-700 dark:text-white"
                                            x-model="setting.value"></textarea>
                                </template>
                                
                                <!-- Input text untuk type text -->
                                <template x-if="setting.type === 'text'">
                                    <input type="text" name="value"
                                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white"
                                        x-model="setting.value">
                                </template>
                            </div>
                        </template>

                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" name="status" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700" 
                                    :checked="setting ? setting.status : true">
                                <span class="ml-2 text-sm font-medium dark:text-white">Active</span>
                            </label>
                        </div>

                        <div class="flex justify-end gap-3 pt-4">
                            <button type="button" @click="open = false"
                                    class="px-5 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition">
                                Batal
                            </button>
                            <button type="submit"
                                    class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
                                <span x-text="setting && setting.id ? 'Update' : 'Save'"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </template>
    </div>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</x-app-layout>