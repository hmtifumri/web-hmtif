<div>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/flatpickr.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/trix.css') }}">
        <script type="text/javascript" src="{{ asset('js/trix.umd.min.js') }}"></script>
    @endpush

    @include('components.alert')

    <form wire:submit.prevent="save">
        <div class="flex flex-wrap -mx-4">
            <div class="w-full lg:w-[55%] p-4">
                <div class="bg-white p-6 rounded-2xl shadow-lg shadow-gray-200/20 space-y-6">
                    <div class="flex items-start gap-3">
                        @if ($image)
                            <div>
                                <small>Gambar baru</small>
                                <img src="{{ $image->temporaryUrl() }}" alt="Preview Gambar"
                                    class="max-w-52 shadow-md shadow-gray-200 rounded-lg mb-3 shrink-0">
                            </div>
                        @else
                            @if ($proker->gambar)
                                <img src="{{ asset($proker->gambar) }}" alt="Preview Gambar"
                                    class="max-w-52 shadow-md shadow-gray-200 rounded-lg mb-3 shrink-0">
                            @endif
                        @endif

                    </div>
                    <div class="grid min-[460px]:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="image" :value="__('Gambar Utama')" />
                            <input type="file" class="form-input-file" id="image" wire:model="image"
                                accept="image/*">
                            @error('image')
                                <span class="error-msg">{{ $message }}</span>
                            @enderror
                        </div>
                        <div wire:ignore>
                            <x-input-label for="tanggal" :value="__('Tanggal dilaksanakan')" />
                            <input type="date" class="form-input" id="tanggal" wire:model.live='tanggal'
                                autocomplete="off" required>
                            @error('tanggal')
                                <span class="error-msg">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <x-input-label for="nama" :value="__('Nama Proker')" />
                        <input type="text" class="form-input" id="nama" wire:model.live='nama'
                            autocomplete="off" required>
                        @error('nama')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <x-input-label for="divisi" :value="__('Divisi')" />
                        <select class="form-input capitalize" id="divisi" wire:model.blur="divisi" required>
                            <option value="">Pilih Divisi</option>
                            <option value="{{ base64_encode(0) }}">Seluruh Divisi</option>
                            @foreach ($divisiOptions as $divisi)
                                <option class="capitalize" value="{{ base64_encode($divisi->id) }}">
                                    {{ str_replace('-', ' ', $divisi->singkatan) }}</option>
                            @endforeach
                        </select>
                        @error('divisi')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>
                    <div wire:ignore>
                        <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                        <input id="{{ $trixId }}" type="hidden" name="deskripsi" value="{{ $value }}"
                            required>
                        <trix-editor input="{{ $trixId }}"></trix-editor>
                        @error('value')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <x-input-label for="foto-kegiatan" :value="__('Foto Kegiatan')" />
                        <small class="text-gray-500 text-sm">*Upload multiple image, max size 4MB</small>
                        <input type="file" class="form-input-file" id="foto-kegiatan" wire:model="fotoKegiatan"
                            multiple accept="image/*">
                        @error('fotoKegiatan.*')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-6">
                        <button class="btn-primary w-full flex items-center gap-2 justify-center " type="submit"
                            wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed">
                            <div wire:loading wire:target="save"
                                class="animate-spin inline-block size-4 border-[3px] border-current border-t-transparent text-white rounded-full"
                                role="status" aria-label="loading">
                                <span class="sr-only">Loading...</span>
                            </div>
                            Update
                        </button>
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-[45%] p-4">
                <div class="sticky top-10">
                    <div class="bg-white p-6 rounded-2xl shadow-lg shadow-gray-200/20 mb-5">
                        <h2 class="text-xl font-semibold">Foto Kegiatan ({{ count($existingFotoKegiatan) }})</h2>
                        <div class="mt-4 columns-1 sm:columns-2 md:columns-3 space-y-4 gap-4">
                            @foreach ($existingFotoKegiatan as $i => $item)
                                <div class="relative">
                                    <img class="w-full rounded-lg" src="{{ asset($item['image']) }}"
                                        alt="Foto Kegiatan {{ $i + 1 }}" loading="lazy">
                                    <div class="absolute -top-2 -right-2 w-6 h-6 flex items-center justify-center rounded-full bg-gray-300 hover:bg-blue-500 group shadow-lg cursor-pointer duration-300"
                                        wire:click="deleteExistingImage({{ $item['id'] }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="w-4 h-4 text-gray-800 group-hover:text-white duration-300">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-lg shadow-gray-200/20">
                        <div class="inline-flex gap-3 items-center">
                            <h2 class="text-xl font-semibold">Preview Foto Kegiatan Baru</h2>
                            <div wire:loading wire:target='fotoKegiatan'
                                class="animate-spin inline-block size-4 border-[3px] border-current border-t-transparent text-blue-500 rounded-full"
                                role="status" aria-label="loading">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <div class="mt-4 columns-1 sm:columns-2 md:columns-3 space-y-4 gap-4">
                            @if ($fotoKegiatan)
                                @foreach ($fotoKegiatan as $i => $item)
                                    <div class="relative">
                                        <img class="w-full rounded-lg" src="{{ $item->temporaryUrl() }}"
                                            alt="Preview Gambar">
                                        <div class="absolute -top-2 -right-2 w-6 h-6 flex items-center justify-center rounded-full bg-gray-300 hover:bg-blue-500 group shadow-lg cursor-pointer duration-300"
                                            wire:click="deleteImage({{ $i }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-4 h-4 text-gray-800 group-hover:text-white duration-300">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</form>


@push('scripts')
    <script src="{{ asset('js/flatpickr.js') }}"></script>
    <script>
        var trixEditor = document.getElementById("{{ $trixId }}")

        addEventListener("trix-blur", function(event) {
            @this.set('value', trixEditor.getAttribute('value'))
        })


        document.addEventListener('livewire:navigated', function() {
            const tanggal = flatpickr("#tanggal", {});


            // styling the date picker
            const calendarContainer = tanggal.calendarContainer;
            const calendarMonthNav = tanggal.monthNav;
            const calendarNextMonthNav = tanggal.nextMonthNav;
            const calendarPrevMonthNav = tanggal.prevMonthNav;
            const calendarDaysContainer = tanggal.daysContainer;

            calendarContainer.className =
                `${calendarContainer.className} bg-white p-4 border border-blue-gray-50 rounded-xl shadow-lg shadow-blue-gray-500/10 font-sans text-sm font-normal text-blue-gray-500 focus:outline-none break-words whitespace-normal`;

            calendarMonthNav.className =
                `${calendarMonthNav.className} flex items-center justify-between mb-4`;

            calendarNextMonthNav.className =
                `${calendarNextMonthNav.className} absolute !top-2.5 !right-1.5 h-6 w-6 bg-transparent hover:bg-blue-gray-50 !p-1 rounded-md transition-colors duration-300`;

            calendarPrevMonthNav.className =
                `${calendarPrevMonthNav.className} absolute !top-2.5 !left-1.5 h-6 w-6 bg-transparent hover:bg-blue-gray-50 !p-1 rounded-md transition-colors duration-300`;

            calendarDaysContainer.className =
                `${calendarDaysContainer.className} [&_span.flatpickr-day]:!rounded-md [&_span.flatpickr-day.selected]:!bg-gray-900 [&_span.flatpickr-day.selected]:!border-gray-900`;
        });
    </script>
@endpush
</div>
