<div>
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('css/trix.css') }}">
        <script type="text/javascript" src="{{ asset('js/trix.umd.min.js') }}"></script>
    @endpush
    <div class="max-w-3xl bg-white p-6 rounded-2xl shadow-lg shadow-gray-200/20">
        @if (Auth::user()->jabatan == 'kadiv')
            @include('components.alert')
        @endif

        <form wire:submit.prevent="update" class="space-y-6">
            <div>
                @if ($newImage)
                    <p class="text-sm text-gray-500">Gambar baru</p>
                    <img src="{{ $newImage->temporaryUrl() }}" alt="Preview Gambar"
                        class="w-full rounded-xl shadow-lg shadow-gray-200">
                @else
                    @if ($divisiImage)
                        <img src="{{ asset($divisiImage->image) }}" alt="{{ $divisi->divisi }}"
                            class="w-full rounded-xl shadow-lg shadow-gray-200">
                    @endif
                @endif
                <div class="mt-4">
                    <x-input-label for="image" :value="__('Gambar')" />
                    <input type="file" class="form-input-file" id="image" wire:model="newImage" accept="image/*"
                        {{ $divisiImage ? '' : 'required' }}>
                    <small class="text-gray-500">*Resolusi 1920 x 1080</small>
                    @error('newImage')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div wire:ignore>
                <x-input-label for="content" :value="__('Content')" />
                <input id="{{ $trixId }}" type="hidden" name="content" value="{{ $value }}" required>
                <trix-editor input="{{ $trixId }}"></trix-editor>
            </div>
            <div>
                <button class="btn-primary w-full flex items-center gap-2 justify-center" type="submit">
                    <div wire:loading wire:target="update"
                        class="animate-spin inline-block size-4 border-[3px] border-current border-t-transparent text-white rounded-full"
                        role="status" aria-label="loading">
                        <span class="sr-only">Loading...</span>
                    </div>
                    {{ __('Update') }}
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
