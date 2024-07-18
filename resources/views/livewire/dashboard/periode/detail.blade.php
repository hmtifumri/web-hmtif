<div>
    @include('components.alert')
    @error('newImage')
        <span class="error-msg">*{{ $message }}</span>
    @enderror
    <div class="mt-4 grid sm:grid-cols-2 md:grid-cols-3 gap-4">
        @foreach ($divisi as $i => $item)
            @if ($item->divisi != 'admin' && $item->singkatan != 'ksb')
                <div class="bg-white p-6 rounded-xl shadow-lg shadow-gray-200" wire:key="{{ $i }}">
                    <h6 class="capitalize font-semibold">Divisi {{ str_replace('-', ' ', $item->singkatan) }}</h6>
                    @php
                        $kadiv = $item->user()->where('jabatan', 'kadiv')->first();
                    @endphp
                    <p class="text-gray-500">Ketua : <span
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
