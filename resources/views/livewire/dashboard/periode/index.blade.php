<div class="overflow-hidden">
    @include('components.alert')
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">#
                </th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                    Periode
                </th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                    Status</th>
                <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">
                    Action</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach ($periode as $i => $periode)
                <tr class="hover:bg-blue-100">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                        {{ $i + 1 }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                        <a class="hover:underline hover:text-blue-600" href="{{ route('detail.periode', str_replace('/', '-', $periode->periode)) }}">
                            {{ $periode->periode }}
                        </a>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                        <span wire:click='ubahStatus({{ $periode->id }})'
                            class="inline-flex cursor-pointer items-center gap-x-1.5 py-1 px-3 rounded-full text-xs font-medium {{ $periode->status == 'aktif' ? 'bg-teal-100 text-teal-800 dark:bg-teal-800/30 dark:text-teal-500' : 'bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-500' }}">
                            {{ $periode->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                        <button type="button" data-hs-overlay="#hapus-periode"
                            wire:click='setHapusPeriode({{ $periode->id }})'
                            class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-red-600 hover:text-red-800 hover:underline disabled:opacity-50 disabled:pointer-events-none">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div id="hapus-periode" wire:ignore
        class="hs-overlay hs-overlay-open:opacity-100 hs-overlay-open:duration-500 hidden size-full fixed top-0 start-0 z-[80] opacity-0 overflow-x-hidden transition-all overflow-y-auto pointer-events-none">
        <div class="sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
            <div
                class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
                    <h3 class="font-bold text-gray-800 dark:text-white">
                        Hapus periode
                    </h3>
                    <button type="button"
                        class="flex justify-center items-center size-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700"
                        data-hs-overlay="#hapus-periode">
                        <span class="sr-only">Close</span>
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-4 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-20 mx-auto text-red-500 mb-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="font-bold text-2xl text-gray-800">
                        Apakah kamu yakin?
                    </h3>
                    <p class="text-gray-500 mt-1">Apakah kamu yakin ingin menghapus periode ini? data
                        kepengurusan
                        yang ada di periode ini akan dihapus seluruhnya</p>
                </div>
                <div class="flex justify-center items-center gap-x-2 py-3 px-4 pb-4">
                    <button type="button"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                        data-hs-overlay="#hapus-periode">
                        Close
                    </button>
                    <button type="submit" wire:click="hapusPeriode"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                        <div wire:loading wire:target="hapusPeriode"
                            class="animate-spin inline-block size-3 border-[2px] border-current border-t-transparent text-white rounded-full"
                            role="status" aria-label="loading">
                            <span class="sr-only">Loading...</span>
                        </div>
                        Hapus periode
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
