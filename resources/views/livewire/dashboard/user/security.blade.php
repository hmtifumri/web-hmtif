<div class="flex flex-wrap -mx4">
    <div class="w-full xl:w-1/2 p-4 order-2 xl:order-1">
        <div class="bg-white border p-8 rounded-xl">
            @include('components.alert')
            <div class="mb-4">
                <h1 class="dashboard-title">Keamanan</h1>
            </div>
            <form wire:submit.prevent='changePassword'>
                <div>
                    <x-input-label for="oldPassword" :value="__('Password lama')" />
                    <input type="password" class="form-input" id="oldPassword" wire:model.live='oldPassword'
                        autocomplete="off" placeholder="******">
                    @error('oldPassword')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-4">
                    <x-input-label for="newPassword" :value="__('Password baru')" />
                    <input type="password" class="form-input" id="newPassword" wire:model.live='newPassword'
                        autocomplete="off" placeholder="******">
                    @error('newPassword')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-4">
                    <button class="btn-primary w-full inline-flex items-center justify-center gap-3">
                        <div class="animate-spin inline-block size-5 border-[3px] border-current border-t-transparent text-white rounded-full"
                            role="status" aria-label="loading" wire:loading wire:target="save">
                            <span class="sr-only">Loading...</span>
                        </div>
                        {{ __('Ganti password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
