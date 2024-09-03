<div>
    @include('components.alert')
    <div class="flex flex-wrap -mx-5">
        <div class="w-full px-5 md:w-1/3">
            <div class="bg-white p-6 rounded-2xl shadow-lg shadow-gray-200/20">
                <h3 class="text-xl font-bold mb-4">Tambah Gambar Banner</h3>
                <div>
                    <form wire:submit.prevent="{{ 'createBanner' }}">
                        <div>
                            <x-input-label for="banner" :value="__('Gambar Banner')" />
                            <input type="file" accept="image/*" multiple
                                class="form-input file:border-none file:text-sm file:font-semibold file:mr-3 file:bg-blue-100 file:text-blue-800 file:rounded"
                                id="banner" wire:model.live='banner' autocomplete="off">
                            <small class="text-gray-500">*Resolusi 1920 x 1080, maks 3mb</small>
                            @error('banner')
                                <span class="error-msg">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-4 flex items-center justify-center gap-3">
                            <button class="btn-primary w-full inline-flex items-center justify-center gap-3">
                                <div class="animate-spin inline-block size-5 border-[3px] border-current border-t-transparent text-white rounded-full"
                                    role="status" aria-label="loading" wire:loading wire:target="save">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                {{ __('Simpan') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="w-full px-5 md:w-2/3">
            <div class="bg-white p-6 rounded-2xl shadow-lg shadow-gray-200/20">
                <h3 class="text-xl font-bold mb-4">Preview Gambar</h3>
                <div>
                    @if ($banner)
                        <div class="grid sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
                            @foreach ($banner as $i => $item)
                                <img class="w-full rounded-lg" src="{{ $item->temporaryUrl() }}" alt="banner">
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white p-6 rounded-2xl shadow-lg shadow-gray-200/20 mt-10">
        <h3 class="text-xl font-bold mb-4">Gambar Banner</h3>
        <div>
            <div class="flex flex-wrap -mx-4">
                @foreach ($banners as $i => $banner)
                    <div class="w-full min-[460px]:w-1/2 md:w-1/3 lg:w-1/4 px-4 group">
                        <div class="relative overflow-hidden rounded-xl">
                            <img class="w-full rounded-xl" src="{{ asset($banner->image) }}" alt="banner">
                            <div
                                class="absolute inset-0 group-hover:bg-black/60 group-hover:backdrop-blur-sm duration-300 ease-in-out flex items-center justify-center opacity-0 group-hover:opacity-100">
                                <button type="button" class="flex items-center justify-center w-9 h-9 bg-red-500 rounded-full text-white cursor-pointer hover:bg-red-800 duration-300" wire:click="delete({{ $banner->id }})" wire:confirm.prompt='Kamu yakin?\n\nKetik "HAPUS" untuk mengapus banner ini. Banner yang di hapus tidak dapat dikembalikan|HAPUS'>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                      </svg>                                      
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
