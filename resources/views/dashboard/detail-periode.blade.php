<x-app-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    <a href="{{ Auth::user()->jabatan == 'admin' ? route('periode.dashboard') : '' }}"
        class="inline-flex items-center gap-3 text-gray-500 hover:text-blue-600 font-semibold group" wire:navigate>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
        </svg>
        <span class="group-hover:ml-3 duration-300">Kembali</span>
    </a>

    <div class="mt-6">
        <h3 class="dashboard-title">Detail Periode {{ $periode->periode }}</h3>
        <div data-aos="fade-up">
            @livewire('dashboard.periode.detail', ['periode' => $periode, 'divisi' => $divisi])
        </div>
    </div>
</x-app-layout>
