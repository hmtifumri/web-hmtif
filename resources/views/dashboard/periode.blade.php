<x-app-layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <div>
        <div class="flex items-center justify-between flex-wrap">
            <h1 class="dashboard-title">Periode</h1>
            <button type="button" data-hs-overlay="#tambah-periode"
                class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-lg shadow-blue-500/30">
                Tambah Periode
            </button>
        </div>
    </div>

    {{-- modal --}}
    <div id="tambah-periode"
        class="hs-overlay hs-overlay-open:opacity-100 hs-overlay-open:duration-500 hidden size-full fixed top-0 start-0 z-[80] opacity-0 overflow-x-hidden transition-all overflow-y-auto pointer-events-none">
        <div class="sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
            <div
                class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
                    <h3 class="font-bold text-gray-800 dark:text-white">
                        Tambah periode
                    </h3>
                    <button type="button"
                        class="flex justify-center items-center size-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700"
                        data-hs-overlay="#tambah-periode">
                        <span class="sr-only">Close</span>
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                @livewire('dashboard.periode.tambah-periode')
            </div>
        </div>
    </div>

    <div class="mt-8">
        <div class="flex flex-col bg-white p-6 rounded-2xl shadow-lg shadow-gray-200/20">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    @livewire('dashboard.periode.index', ['periode' => $periode])
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
