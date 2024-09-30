<div>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/flatpickr.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/cropper.css') }}" />
    @endpush

    <div>
        <a href="{{ route('periode.dashboard') }}"
            class="inline-flex items-center gap-3 text-gray-500 hover:text-blue-600 font-semibold group" wire:navigate>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
            </svg>
            <span class="group-hover:ml-3 duration-300">Kembali</span>
        </a>
    </div>
    <div class="flex flex-wrap -mx-4">
        <div class="w-full xl:w-1/2 p-4 order-2 xl:order-1">
            <div class="bg-white border p-8 rounded-xl">
                <form wire:submit.prevent="update" class="space-y-6">
                    <div class="inline-flex items-center gap-3">
                        @if ($croppedImage)
                            <div>
                                <img src="{{ $croppedImage->temporaryUrl() }}" alt=""
                                    class="w-24 h-24 rounded-full">
                            </div>
                        @else
                            <div>
                                <img src="{{ asset($pembina->image) }}" alt=""
                                    class="w-24 h-24 rounded-full">
                            </div>
                        @endif
                        <div>
                            <x-input-label class="hover:underline cursor-pointer hover:text-blue-600" for="gambar"
                                :value="__('Ubah Gambar')" />
                            <input type="file" class="hidden" id="gambar" wire:model="gambar" autocomplete="off"
                                accept="image/*" onchange="openCropper(event)">
                            <div class="animate-spin mt-1 inline-block size-4 border-[2px] border-current border-t-transparent text-blue-600 rounded-full"
                                wire:loading wire:target="gambar" role="status" aria-label="loading">
                                <span class="sr-only">Loading...</span>
                            </div>
                            @error('gambar')
                                <span class="error-msg">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <x-input-label for="nama" :value="__('Nama')" />
                        <input type="text" class="form-input" id="nama" wire:model.live='nama'
                            autocomplete="off" required>
                        @error('nama')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="grid min-[460px]:grid-cols-2 gap-4">
                        <div wire:ignore>
                            <x-input-label for="mulai" :value="__('Tanggal Mulai')" />
                            <input type="date" class="form-input" id="tanggal-mulai" wire:model.live='mulai'
                                autocomplete="off" required>
                            @error('mulai')
                                <span class="error-msg">{{ $message }}</span>
                            @enderror
                        </div>
                        <div wire:ignore>
                            <x-input-label for="selesai" :value="__('Tanggal Selesai')" />
                            <input type="date" class="form-input" id="tanggal-selesai" wire:model.live='selesai'
                                autocomplete="off" required>
                            <small class="text-gray-500">Kosongkan jika masih aktif</small>
                            @error('selesai')
                                <span class="error-msg">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <button class="btn-primary w-full flex items-center gap-2 justify-center" type="submit">
                            <div wire:loading wire:target="store"
                                class="animate-spin inline-block size-4 border-[3px] border-current border-t-transparent text-white rounded-full"
                                role="status" aria-label="loading">
                                <span class="sr-only">Loading...</span>
                            </div>
                            {{ __('Update') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="w-full xl:w-1/2 p-4 order-1 xl:order-2">
            <!-- Modal for cropping image -->
            <div id="cropModal" class=" flex items-center justify-center z-50 hidden" wire:ignore>
                <div class="bg-white border p-8 rounded-xl">
                    <h1 class="dashboard-title mb-4">{{ __('Crop Image') }}</h1>
                    <div class="mb-4">
                        <img id="cropImage" src="" alt="Gambar untuk dipotong">
                    </div>
                    <div class="flex justify-end gap-3">
                        <button class="ml-2 bg-rose-200 text-rose-800 px-4 py-2 rounded-lg" onclick="closeCropModal()">
                            {{ __('Cancel') }}
                        </button>
                        <button class="bg-blue-600 shadow-lg shadow-blue-600/30 text-white px-4 py-2 rounded-lg"
                            onclick="cropImage()">
                            {{ __('Crop & Save') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/flatpickr.js') }}"></script>
        <script src="{{ asset('js/cropper.min.js') }}"></script>
        <script>
            // Move applyCustomStyling function here before it's called
            const applyCustomStyling = (flatpickrInstance) => {
                if (flatpickrInstance && flatpickrInstance.calendarContainer) {
                    const calendarContainer = flatpickrInstance.calendarContainer;
                    const calendarMonthNav = flatpickrInstance.monthNav;
                    const calendarNextMonthNav = flatpickrInstance.nextMonthNav;
                    const calendarPrevMonthNav = flatpickrInstance.prevMonthNav;
                    const calendarDaysContainer = flatpickrInstance.daysContainer;

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
                }
            };

            document.addEventListener('livewire:navigated', function() {
                const tanggalMulai = flatpickr("#tanggal-mulai", {
                    dateFormat: "Y-m-d", // Format tanggal
                    onChange: function(selectedDates, dateStr, instance) {
                        tanggalSelesai.set('minDate', dateStr);
                    },
                    onReady: function(selectedDates, dateStr, instance) {
                        applyCustomStyling(instance);
                    }
                });

                const tanggalSelesai = flatpickr("#tanggal-selesai", {
                    onChange: function(selectedDates, dateStr, instance) {
                        tanggalMulai.set('maxDate', dateStr);
                    },
                    onReady: function(selectedDates, dateStr, instance) {
                        applyCustomStyling(instance);
                    }
                });
            });

            let cropper;
            const openCropper = (event) => {
                const file = event.target.files[0];
                const reader = new FileReader();

                reader.onload = (e) => {
                    const image = document.getElementById('cropImage');
                    image.src = e.target.result;

                    if (cropper) {
                        cropper.destroy();
                    }

                    cropper = new Cropper(image, {
                        aspectRatio: 1,
                        viewMode: 1,
                    });

                    document.getElementById('cropModal').classList.remove('hidden');
                };

                reader.readAsDataURL(file);
            };

            const cropImage = () => {
                const canvas = cropper.getCroppedCanvas();
                canvas.toBlob((blob) => {
                    const file = new File([blob], 'cropped.jpg', {
                        type: 'image/jpeg'
                    });
                    @this.upload('croppedImage', file, (uploadedFilename) => {
                        // Success callback
                        document.getElementById('cropModal').classList.add('hidden');
                    }, () => {
                        // Error callback
                    }, (event) => {
                        // Progress callback
                    });
                }, 'image/jpeg');
            };

            const closeCropModal = () => {
                document.getElementById('cropModal').classList.add('hidden');
            };
        </script>
    @endpush

</div>
