<div>
    <form wire:submit.prevent="tambahPeriode">
        <div class="p-4">
            <div>
                <label for="periode-awal" class="block text-sm font-medium mb-2">Periode Awal</label>
                <select id="periode-awal" wire:model.change="periode_awal" class="form-input" required>
                    @php
                        $currentYear = date('Y');
                    @endphp
                    @for ($i = $currentYear - 2; $i <= $currentYear + 2; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="mt-3">
                <label for="periode-akhir" class="block text-sm font-medium mb-2">Periode Akhir</label>
                <input type="number" wire:model="periode_akhir" id="periode-akhir"
                    class="form-input disabled:bg-gray-100 !cursor-not-allowed" disabled="">
            </div>

        </div>
        <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t">
            <button type="button"
                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                data-hs-overlay="#tambah-periode">
                Close
            </button>
            <button type="submit"
                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                <div wire:loading wire:target="tambahPeriode" class="animate-spin inline-block size-3 border-[2px] border-current border-t-transparent text-white rounded-full" role="status" aria-label="loading">
                    <span class="sr-only">Loading...</span>
                  </div>
                Tambah periode
            </button>
        </div>
    </form>
</div>
