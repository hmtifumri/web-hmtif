<div>
    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.css"
            integrity="sha512-087vysR/jM0N5cp13Vlp+ZF9wx6tKbvJLwPO8Iit6J7R+n7uIMMjg37dEgexOshDmDITHYY5useeSmfD1MYiQA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endpush

    @include('components.alert')
    <div class="flex flex-wrap -mx4">
        <div class="w-full xl:w-1/2 p-4 order-2 xl:order-1">
            <div class="bg-white border p-8 rounded-xl">
                @if ($user->phone == null && $user->gambar == null)
                    <div class="mb-5 bg-rose-200 text-rose-800 py-2 px-6 rounded-md text-sm">
                        Datanya belum lengkap. Lengkapi lah dulu datanya
                    </div>
                @endif

                <div class="mb-4">
                    <h1 class="dashboard-title">Edit <span class="text-blue-600">{{ $user->name }}</span></h1>
                </div>

                <form wire:submit.prevent="save">
                    <div class="mb-4 inline-flex gap-3">
                        @if ($croppedImage)
                            <div>
                                <img src="{{ $croppedImage->temporaryUrl() }}" alt="{{ $user->name }}"
                                    class="w-24 h-24 rounded-full">
                            </div>
                        @else
                            @if ($user->gambar == null)
                                <div>
                                    <img src="{{ asset('assets/img/no-photo.png') }}" alt="{{ $user->name }}"
                                        class="w-24 h-24 rounded-full">
                                </div>
                            @else
                                <div>
                                    <img src="{{ asset($user->gambar) }}" alt="{{ $user->name }}"
                                        class="w-24 h-24 rounded-full">
                                </div>
                            @endif
                        @endif
                        <div>
                            <x-input-label class="hover:underline cursor-pointer hover:text-blue-600" for="gambar"
                                :value="__('Pilih Gambar')" />
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
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <input type="text" class="form-input" id="name" wire:model.blur='name'
                                autocomplete="off">
                            @error('name')
                                <span class="error-msg">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <input type="text" class="form-input" id="email" wire:model.blur='email'
                                autocomplete="off">
                            @error('email')
                                <span class="error-msg">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-input-label for="phone" :value="__('No HP/WA')" />
                            <input type="number" class="form-input" id="phone" wire:model.blur='phone'
                                autocomplete="off">
                            @error('phone')
                                <span class="error-msg">{{ $message }}</span>
                            @enderror
                        </div>
                        @if (!empty($divisiOptions))
                            <div>
                                <x-input-label for="divisi" :value="__('Divisi')" />
                                <select wire:model="divisi" id="divisi" class="form-input">
                                    <option value="">{{ __('Pilih Divisi') }}</option>
                                    @foreach ($divisiOptions as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                @error('divisi')
                                    <span class="error-msg">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                        @if (!empty($ksbJabatanOptions) || !empty($defaultJabatanOptions))
                            <div>
                                <x-input-label for="jabatan" :value="__('Jabatan')" />
                                <select wire:model="jabatan" id="jabatan" class="form-input">
                                    <option value="">{{ __('Pilih Jabatan') }}</option>
                                    @if ($divisi == array_search('ksb', $divisiOptions))
                                        @foreach ($ksbJabatanOptions as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    @else
                                        @foreach ($defaultJabatanOptions as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('jabatan')
                                    <span class="error-msg">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                        <div>
                            <x-input-label for="periode" :value="__('Periode')" />
                            <select wire:model="periode" id="periode" class="form-input">
                                <option value="">{{ __('Periode') }}</option>
                                @foreach ($periodeOptions as $item)
                                    <option value="{{ $item->id }}">{{ $item->periode }}</option>
                                @endforeach
                            </select>
                            @error('periode')
                                <span class="error-msg">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="my-4">
                            <x-input-label for="gender" :value="__('Jenis Kelamin')" />
                            <div class="flex items-center">
                                <label class="inline-flex items-center mr-4">
                                    <input wire:model="gender" type="radio" value="L"
                                        class="form-radio text-blue-600" wire:model.blur='gender'>
                                    <span class="ml-2">{{ __('Laki-laki') }}</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input wire:model="gender" type="radio" value="P"
                                        class="form-radio text-blue-600" wire:model.blur='gender'>
                                    <span class="ml-2">{{ __('Perempuan') }}</span>
                                </label>
                            </div>
                            @error('gender')
                                <span class="error-msg">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <button class="btn-primary w-full">{{ __('Update') }}</button>
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
                        <button class="ml-2 bg-rose-200 text-rose-800 px-4 py-2 rounded-lg"
                            onclick="closeCropModal()">
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
    <div class="flex flex-wrap -mx4">
        <div class="w-full xl:w-1/2 p-4 order-2 xl:order-1">
            <div class="bg-white border p-8 rounded-xl">
                <div class="mb-4">
                    <h1 class="dashboard-title">Keamanan</h1>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"
        integrity="sha512-JyCZjCOZoyeQZSd5+YEAcFgz2fowJ1F1hyJOXgtKu4llIa0KneLcidn5bwfutiehUTiOuK87A986BZJMko0eWQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
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
