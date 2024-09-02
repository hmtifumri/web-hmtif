<div>
    @include('components.alert')
    <div class="flex flex-wrap -mx-5">
        <div class="w-full px-5 md:w-1/2">
            <div class="bg-white p-6 rounded-2xl shadow-lg shadow-gray-200/20">
                <h3 class="text-xl font-bold mb-4">Tambah Kategori</h3>
                <div>
                    <form wire:submit.prevent="{{ $editStatus ? 'updateCategory' : 'createCategory' }}">
                        <div>
                            <x-input-label for="category" :value="__('Kategori')" />
                            <input type="text" class="form-input" id="category" wire:model.live='category'
                                autocomplete="off">
                            <small class="text-gray-500">Tulis kategori untuk artikel</small>
                            @error('category')
                                <span class="error-msg">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-4 flex items-center justify-center gap-3">
                            @if ($editStatus)
                            <button class="btn-danger w-full inline-flex items-center justify-center gap-3" wire:click="cancelEdit">
                                {{ __('Batal') }}
                            </button>
                            @endif
                            <button class="btn-primary w-full inline-flex items-center justify-center gap-3">
                                <div class="animate-spin inline-block size-5 border-[3px] border-current border-t-transparent text-white rounded-full"
                                    role="status" aria-label="loading" wire:loading wire:target="save">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                {{ __($editStatus ? 'Update' : 'Simpan') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="w-full px-5 md:w-1/2">
            <div class="bg-white p-6 rounded-2xl shadow-lg shadow-gray-200/20">
                <h3 class="text-xl font-bold mb-4">List Kategori</h3>
                <div class="mb-6 last-of-type:mb-0 overflow-x-auto">
                    <div>
                        <div class="p-1.5 min-w-full inline-block align-middle">
                            <div class="border rounded-lg border-gray-300 overflow-hidden">
                                <div>
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead>
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                    Kategori
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                            @forelse ($categories as $category)
                                                <tr>
                                                    <td
                                                        class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                                                        {{ $category->category }}
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                                        <div class="inline-flex items-center gap-3">
                                                            <div>
                                                                <button type="button" wire:click='setEditCategory({{ $category->id }})'
                                                                    class="hover:underline text-teal-600">Edit</button>
                                                            </div>
                                                            <div>
                                                                <button type="button" data-hs-overlay="#hapus-kategori"
                                                                    wire:click='hapusKategori({{ $category->id }})'
                                                                    wire:confirm="Yakin ingin menghapus kategori ini? Data artikel juga ikut terhapus"
                                                                    class="hover:underline text-rose-600">Delete</button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="2"
                                                        class="px-6 py-4 text-sm text-center font-medium text-gray-400 whitespace-nowrap">
                                                        Tidak ada kategori
                                                    </td>
                                                </tr>
                                            @endforelse
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
