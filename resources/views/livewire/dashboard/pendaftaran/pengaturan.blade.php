<div>


    <div class="max-w-3xl mx-auto bg-white p-6 rounded-2xl shadow-lg shadow-gray-200/20">

        <div class="mb-8">
            <div class="text-center mb-4">
                <span
                    class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium {{ $pengaturan->status == 'dibuka' ? 'bg-teal-100 text-teal-800' : 'bg-red-100 text-red-800' }}">{{ $pengaturan->status == 'dibuka' ? 'Dibuka' : 'Ditutup' }}</span>
            </div>

            <h1 class="text-2xl font-plusjakartasans text-center font-semibold">Pendaftaran Anggota HM-TIF Periode
                {{ $periode_aktif }}</h1>
        </div>
        @if ($pengaturan->status == 'ditutup')
            <form wire:submit.prevent="bukaPendaftaran">
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="tanggal_mulai" :value="__('Tanggal buka')" />
                        <input type="date" class="form-input" wire:model.change="tanggal_mulai">
                    </div>
                    <div>
                        <x-input-label for="tanggal_selesai" :value="__('Tanggal selesai')" />
                        <input type="date" class="form-input" wire:model.change="tanggal_selesai">
                    </div>
                </div>
                <div class="mt-4">
                    <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                    <textarea class="form-input" rows="5" wire:model.live="deskripsi"></textarea>
                </div>
                <div class="mt-6">
                    <button type="submit" class="btn-primary w-full">Buka Pendaftaran</button>
                </div>
            </form>
        @else
            <div class="text-center">
                @if ($tutup_pendaftaran == false)
                    <button class="bg-red-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-600"
                        wire:click='setTutup'>Tutup Pendaftaran</button>
                @else
                    <p class="mb-3">Apakah anda yakin ingin menutup pendaftaran?</p>
                    <div>
                        <button class="bg-gray-200/80 hover:bg-gray-200/100 px-6 py-3 rounded-lg font-semibold" wire:click='unsetTutup'>Batal</button>
                        <button class="bg-red-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-600"
                            wire:click='tutupPendaftaran'>Yakin</button>
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>
