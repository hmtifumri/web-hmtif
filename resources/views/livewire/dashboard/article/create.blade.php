<div>
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('css/trix.css') }}">
        <script type="text/javascript" src="{{ asset('js/trix.umd.min.js') }}"></script>
    @endpush

    <div class="max-w-3xl bg-white p-6 rounded-2xl shadow-lg shadow-gray-200/20">
        <form wire:submit.prevent="store" class="space-y-6">
            <div>
                <x-input-label for="category" :value="__('Kategori')" />
                <select class="form-input" id="category" wire:model.blur="kategori" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ base64_encode($category->id) }}">{{ $category->category }}</option>
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
                @endif
                <x-input-label for="image" :value="__('Gambar')" />
                <input type="file" class="form-input-file" id="image" wire:model="image" required
                    accept="image/*">
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
                <button class="btn-primary w-full flex items-center gap-2 justify-center" type="submit">
                    <div wire:loading wire:target="store"
                        class="animate-spin inline-block size-4 border-[3px] border-current border-t-transparent text-white rounded-full"
                        role="status" aria-label="loading">
                        <span class="sr-only">Loading...</span>
                    </div>
                    Publish
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
