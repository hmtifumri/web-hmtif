<div>
    @push('styles')
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
        <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    @endpush

    <div class="max-w-3xl bg-white p-6 rounded-2xl shadow-lg shadow-gray-200/20">
        <form wire:submit.prevent="update" class="space-y-6">
            <div>
                <x-input-label for="category" :value="__('Kategori')" />
                <select class="form-input" id="category" wire:model.blur="kategori" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ base64_encode($category->id) }}"
                            {{ $kategori == base64_encode($category->id) ? 'selected' : '' }}>{{ $category->category }}
                        </option>
                    @endforeach
                </select>
                @error('kategori')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>
            <div>
                @if ($image)
                    <img src="{{ $image->temporaryUrl() }}" alt="Preview Gambar"
                        class="max-w-52 shadow-lg shadow-gray-200 rounded-lg mb-3">
                @elseif($existingImage)
                    <img src="{{ asset($existingImage) }}" alt="Existing Gambar"
                        class="max-w-52 shadow-lg shadow-gray-200 rounded-lg mb-3">
                @endif
                <x-input-label for="image" :value="__('Gambar')" />
                <input type="file" class="form-input-file" id="image" wire:model="image">
                @error('image')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <x-input-label for="title" :value="__('Judul')" />
                <input type="text" class="form-input" id="title" wire:model.live='title' autocomplete="off"
                    required>
                @error('title')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <x-input-label for="slug" :value="__('Slug')" />
                <input type="text" class="form-input" id="slug" wire:model.live='slug' autocomplete="off"
                    required>
                @error('slug')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>
            <div wire:ignore>
                <x-input-label for="content" :value="__('Content')" />
                <input id="{{ $trixId }}" type="hidden" name="content" value="{{ $value }}" required>
                <trix-editor input="{{ $trixId }}"></trix-editor>
            </div>
            @error('value')
                <span class="error-msg">{{ $message }}</span>
            @enderror
            <div class="mt-6 flex justify-end items-center gap-4">
                <button class="py-3 px-4 rounded-lg font-semibold border w-full hover:bg-gray-100 duration-200"
                    type="button" wire:click="draft">
                    Draft
                </button>
                <button class="btn-primary w-full" type="submit">
                    Update
                </button>
            </div>
        </form>
    </div>
    @push('scripts')
        <script>
            var trixEditor = document.getElementById("{{ $trixId }}")

            addEventListener("trix-blur", function(event) {
                @this.set('value', trixEditor.getAttribute('value'))
            })
        </script>
    @endpush
</div>
