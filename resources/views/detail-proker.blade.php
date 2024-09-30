<x-main-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    <section class="pb-10 lg:pb-20 lg:pt-10 max-w-5xl mx-auto">
        <div class="container px-5 mx-auto">
            <div class="relative overflow-hidden rounded-3xl">
                <img src="{{ asset($proker->gambar) }}" alt="{{ $proker->nama }}"
                    class="w-full rounded-2xl md:rounded-3xl object-cover">
                <div class="absolute inset-0 flex items-center justify-center mx-auto bg-black/80 px-5">
                    <div class="max-w-5xl text-white text-center">
                        <h1 class="text-2xl md:text-3xl lg:text-5xl 2xl:text-6xl font-bold capitalize">
                            {{ $proker->nama }}</h1>
                    </div>
                </div>
            </div>
            <div class="mt-6">
                <div class="flex items-center justify-center gap-2 font-semibold text-navy dark:text-navy2 capitalize">
                    <p>
                        {{ $proker->divisi_id == 0 ? 'Semua Divisi' : 'Divisi ' . $proker->divisi->singkatan }} •
                    </p>
                    <p class="">
                        {{ \Carbon\Carbon::parse($proker->tanggal_mulai)->translatedFormat('d M Y') }}
                    </p>
                    <p>
                        • Periode {{ $proker->periode->periode }}
                    </p>
                </div>
            </div>
            <div class="mt-8">
                <p>{!! $proker->deskripsi !!}</p>
            </div>
            <div class="mt-6">
                <h3 class="text-xl lg:text-2xl font-plusjakartasans font-bold">Foto-foto Kegiatan</h3>
                <livewire:home.proker.detail :prokerId="$proker->id">
            </div>
        </div>
    </section>
</x-main-layout>