<x-app-layout>
    <x-slot name="title">
        {{ $title }}
    </x-slot>

    <div>
        <div class="mt-6 sm:mt-0 text-right">
            <a href="{{ route('tambah.proker', $periode) }}" wire:navigate
                class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-lg shadow-blue-500/30 inline-block">
                Tambah Proker </a>
        </div>

        <div class="mt-14">
            <div class=" bg-white p-6 rounded-2xl shadow-lg shadow-gray-200/20">
                @empty($proker->count())
                    <div class="text-center text-sm text-neutral-500">Belum ada proker saat ini.</div>
                @else
                    @livewire('dashboard.proker.index', ['periode' => $periode, 'proker' => $proker])
                @endempty
            </div>
        </div>
    </div>
</x-app-layout>
