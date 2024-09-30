<div>

    @error('newImage')
        <span class="error-msg">*{{ $message }}</span>
    @enderror
    <div class="mt-4 mb-8">
        <div class="mb-4 inline-flex items-center gap-3">
            <h4 class="text-xl font-bold">Pembina HM-TIF</h4>
            <div>
                <a href="{{ route('pembina.create', str_replace('/', '-', $periode->periode)) }}"
                    class="inline-flex items-center justify-center w-7 h-7 bg-blue-500 text-white rounded-md shadow-lg shadow-blue-500/20 hover:bg-blue-600 duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path
                            d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
                    </svg>
                </a>
            </div>
        </div>
        <div>
            @empty($pembina->count())
                <span class="text-sm text-gray-500">Tidak ada data pembina</span>
            @else
                <table class="min-w-full divide-y divide-gray-200 bg-white rounded-lg shadow-lg shadow-gray-200">
                    <thead>
                        <tr>
                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">#
                            </th>
                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                Masa Jabatan
                            </th>
                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                Status</th>
                            <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">
                                Action</th>
                        </tr>
                    </thead>
                    <livewire:dashboard.pembina.index :pembina="$pembina" :periode="$periode" />
                </table>
            @endempty
        </div>
    </div>
    <div class="mt-4 grid sm:grid-cols-2 md:grid-cols-3 gap-4">
        @foreach ($divisi as $i => $item)
            @if ($item->divisi != 'admin' && $item->singkatan != 'ksb')
                <div class="bg-white p-6 rounded-xl shadow-lg shadow-gray-200" wire:key="{{ $i }}">
                    <div class="flex items-center justify-between">
                        <h6 class="capitalize font-semibold">Divisi {{ str_replace('-', ' ', $item->singkatan) }}</h6>
                        <a href="{{ route('edit.divisi', [str_replace('/', '-', $periode->periode), $item->singkatan]) }}" wire:navigate
                            class="inline-flex items-center justify-center w-8 h-8 hover:bg-gray-200/80 duration-300 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="size-5 text-blue-500">
                                <path
                                    d="m5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 0 1-.65-.65Z" />
                                <path
                                    d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0 0 10 3H4.75A2.75 2.75 0 0 0 2 5.75v9.5A2.75 2.75 0 0 0 4.75 18h9.5A2.75 2.75 0 0 0 17 15.25V10a.75.75 0 0 0-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5Z" />
                            </svg>
                        </a>
                    </div>
                    @php
                        $kadiv = $item->user()->where('jabatan', 'kadiv')->first();
                    @endphp
                    <p class="text-gray-500">Kadiv : <span
                            class="text-blue-600 font-semibold">{{ $kadiv ? $kadiv->name : '-' }}</span></p>
                    <p class="text-gray-500">Jumlah seluruhnya : {{ $item->user->count() }}</p>
                    <div class="mt-3 border-t pt-3">
                        <h6 class="font-semibold">Foto Divisi</h6>
                        @if ($item->images->count() > 0)
                            @php
                                $periodeImages = $item->images->where('periode_id', $periode->id);
                            @endphp

                            @if ($periodeImages->count() > 0)
                                <img src="{{ asset($periodeImages->first()->image) }}"
                                    class="w-full object-cover rounded-lg mb-3" alt="Divisi Image">
                            @endif
                        @endif


                        <div>
                            <label for="image-{{ $i }}" wire:click='setDivisiId({{ $item->id }})'
                                class="w-full cursor-pointer hover:bg-gray-100 h-40 border-2 border-dotted rounded-lg flex items-center justify-center text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-5 mr-3">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                                Upload Gambar
                            </label>
                        </div>
                        <input type="file" id="image-{{ $i }}" wire:model.live="image" class="hidden"
                            accept="image/*">
                        <span class="block text-sm text-gray-400 mt-1">*Resolusi 1920x1080</span>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
