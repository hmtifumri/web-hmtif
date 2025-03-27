<x-main-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    <section class="pb-10 lg:pb-24 lg:pt-14">
        <div class="container mx-auto px-5">
            @include('components.alert')
            <h1 class="title uppercase text-center mx-auto max-w-3xl" data-aos="fade-up">struktur kepengurusan
                {{ $periode->periode }}</h1>
            <div class="mt-8 lg:mt-20">
                @if ($pembina)
                    <div class="mx-auto w-full md:w-1/2 lg:w-1/3 group lg:px-10 mb-8">
                        <div class="relative overflow-hidden rounded-3xl" data-aos="fade-up">
                            <img src="{{ asset($pembina->image) }}"
                                class="w-full group-hover:scale-110 duration-500 ease-in-out" alt="">
                            <div
                                class="absolute inset-0 group-hover:bg-zinc-900/60 dark:group-hover:bg-zinc-950/70 group-hover:backdrop-blur-sm duration-500 ease-in-out">
                                <div
                                    class="absolute top-full -translate-y-16 2xl:-translate-y-20 left-1/2 -translate-x-1/2 group-hover:top-1/2 w-full group-hover:-translate-y-1/2 duration-500 ease-in-out">
                                    <div class="text-center">
                                        <h3
                                            class="text-base lg:text-xl text-white px-3 font-semibold font-plusjakartasans capitalize">
                                            {{ $pembina->nama }}
                                        </h3>
                                        <p class="text-white capitalize group-hover:mt-2 duration-500 ease-in-out">
                                            ~ Pembina HM-TIF ~
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="lg:flex lg:flex-wrap lg:items-center lg:justify-between -mx-5 lg:-mx-10">
                    @if ($users == null)
                        <div class="text-center text-sm text-gray-500 mx-auto" data-aos="fade-up">
                            Belum ada data
                        </div>
                    @else
                        @foreach (['bupati', 'wakil_bupati'] as $index => $role)
                            @if (isset($users[$role]))
                                @if ($index == 0)
                                    <div
                                        class="w-full sm:w-1/2 mx-auto lg:mx-0 lg:w-1/3 px-5 lg:px-10 group order-2 md:order-1 p-4">
                                        <div class="relative overflow-hidden rounded-3xl" data-aos="fade-up">
                                            <img src="{{ asset($users[$role]->gambar) }}"
                                                class="w-full group-hover:scale-110 duration-500 ease-in-out"
                                                alt="">
                                            <div
                                                class="absolute inset-0 group-hover:bg-zinc-900/60 dark:group-hover:bg-zinc-950/70 group-hover:backdrop-blur-sm duration-500 ease-in-out">
                                                <div
                                                    class="absolute top-full -translate-y-16 2xl:-translate-y-20 left-1/2 -translate-x-1/2 group-hover:top-1/2 w-full group-hover:-translate-y-1/2 duration-500 ease-in-out">
                                                    <div class="text-center">
                                                        <h3
                                                            class="text-xl text-white px-3 font-semibold font-plusjakartasans capitalize">
                                                            {{ $users[$role]->name }}
                                                            <span
                                                                class="text-sm block font-medium mt-1 opacity-0 group-hover:opacity-100 duration-500 ease-in-out">
                                                                {{ $users[$role]->nim }}
                                                            </span>
                                                        </h3>
                                                        <p
                                                            class="text-white capitalize -mt-6 group-hover:mt-2 duration-500 ease-in-out">
                                                            ~
                                                            {{ ucfirst(str_replace('_', ' ', $users[$role]->jabatan)) }}
                                                            ~
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif ($index == 1)
                                    <!-- Insert logo before Wakil Bupati -->
                                    <div
                                        class="w-full sm:w-1/2 mx-auto lg:mx-0 lg:w-1/3 px-5 lg:px-10 order-1 lg:order-2 p-4 mb-6 lg:mb-0">
                                        <img src="{{ asset('assets/img/logo.png') }}"
                                            class="max-w-[300px] w-full lg:max-w-[350px] mx-auto" alt="Logo HMTIF"
                                            data-aos="fade-up">
                                    </div>
                                    <div
                                        class="w-full sm:w-1/2 mx-auto lg:mx-0 lg:w-1/3 px-5 lg:px-10 group order-3 p-4">
                                        <div class="relative overflow-hidden rounded-3xl" data-aos="fade-up">
                                            <img src="{{ asset($users[$role]->gambar) }}"
                                                class="w-full group-hover:scale-110 duration-500 ease-in-out"
                                                alt="">
                                            <div
                                                class="absolute inset-0 group-hover:bg-zinc-900/60 dark:group-hover:bg-zinc-950/70 group-hover:backdrop-blur-sm duration-500 ease-in-out">
                                                <div
                                                    class="absolute top-full -translate-y-16 2xl:-translate-y-20 left-1/2 -translate-x-1/2 group-hover:top-1/2 w-full group-hover:-translate-y-1/2 duration-500 ease-in-out">
                                                    <div class="text-center">
                                                        <h3
                                                            class="text-xl text-white px-3 font-semibold font-plusjakartasans capitalize">
                                                            {{ $users[$role]->name }}
                                                            <span
                                                                class="text-sm block font-medium mt-1 opacity-0 group-hover:opacity-100 duration-500 ease-in-out">
                                                                {{ $users[$role]->nim }}
                                                            </span>
                                                        </h3>
                                                        <p
                                                            class="text-white capitalize -mt-6 group-hover:mt-2 duration-500 ease-in-out">
                                                            ~
                                                            {{ ucfirst(str_replace('_', ' ', $users[$role]->jabatan)) }}
                                                            ~
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    @endif
                </div>

                <div
                    class="flex flex-wrap items-center justify-center lg:justify-between -mx-4 lg:-mx-8 sm:px-8 lg:px-10 mt-0 lg:mt-16">
                    @foreach (['sekum', 'sekretaris', 'bendum'] as $i => $role)
                        @if (isset($users[$role]))
                            <div class="w-full sm:w-1/2 md:w-1/3 p-4 lg:px-8 group">
                                <div class="relative overflow-hidden rounded-3xl" data-aos="fade-up"
                                    data-aos-delay="{{ $i * 100 }}">
                                    <img src="{{ asset($users[$role]->gambar) }}"
                                        class="w-full group-hover:scale-110 duration-500 ease-in-out" alt="">
                                    <div
                                        class="absolute inset-0 group-hover:bg-zinc-900/60 dark:group-hover:bg-zinc-950/70 group-hover:backdrop-blur-sm duration-500 ease-in-out">
                                        <div
                                            class="absolute top-full -translate-y-16 2xl:-translate-y-20 left-1/2 -translate-x-1/2 group-hover:top-1/2 w-full group-hover:-translate-y-1/2 duration-500 ease-in-out">
                                            <div class="text-center">
                                                <h3
                                                    class="text-xl text-white font-semibold font-plusjakartasans capitalize">
                                                    {{ $users[$role]->name }}
                                                    <span
                                                        class="text-sm block font-medium mt-1 opacity-0 group-hover:opacity-100 duration-500 ease-in-out">
                                                        {{ $users[$role]->nim }}
                                                    </span>
                                                </h3>
                                                <p
                                                    class="text-white capitalize -mt-6 group-hover:mt-2 duration-500 ease-in-out">
                                                    @if ($users[$role]->jabatan == 'sekum')
                                                        ~ Sekretaris Umum ~
                                                    @elseif($users[$role]->jabatan == 'bendum')
                                                        ~ Bendahara Umum ~
                                                    @else
                                                        ~ {{ ucfirst($users[$role]->jabatan) }} ~
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

        </div>
    </section>

    <section class="pb-10 lg:pb-24 lg:pt-14">
        <div class="mb-10 lg:mb-20">
            <h1
                class="title uppercase text-center relative before:absolute before:w-full before:h-px before:content-[''] before:bg-zinc-300 before:left-0 before:top-1/2 before:-translate-y-1/2 before:z-0 dark:before:bg-zinc-700">
                <span class="bg-[#EBF0F9] dark:bg-zinc-950 dark:text-navy3 relative z-10 px-5">divisi</span>
            </h1>
        </div>
        <div class="container mx-auto px-5">
            <div class="grid md:grid-cols-2 gap-4 md:gap-6">
                @php
                    $divisi = App\Models\Divisi::where('divisi', '!=', 'admin')->where('singkatan', '!=', 'ksb')->get();
                @endphp
                @foreach ($divisi as $i => $div)
                    @php
                        $divisiImage = App\Models\DivisiImage::where('divisi_id', $div->id)
                            ->where('periode_id', $periode->id)
                            ->pluck('image')
                            ->first();
                    @endphp
                    @if ($divisiImage != null)
                        <div class="w-full rounded-3xl overflow-hidden relative group" data-aos="fade-up"
                            data-aos-delay="{{ $i * 100 }}">
                            <a href="{{ route('divisi.show', [str_replace('/', '-', $periode->periode), $div->singkatan]) }}"
                                wire:navigate>
                                <img class="group-hover:scale-110 object-cover duration-500 ease-in-out rounded-3xl h-full"
                                    src="{{ asset($divisiImage) }}" alt="{{ $div->divisi }}">
                                <div
                                    class="absolute inset-0 group-hover:bg-zinc-900/60 dark:group-hover:bg-zinc-950/70 group-hover:backdrop-blur-sm duration-500 ease-in-out z-0">
                                    <div
                                        class="absolute top-full opacity-0 group-hover:opacity-100 -translate-y-16 2xl:-translate-y-20 left-1/2 -translate-x-1/2 group-hover:top-1/2 w-full group-hover:-translate-y-1/2 duration-500 ease-in-out">
                                        <div class="text-center px-4">
                                            <h2
                                                class="text-4xl sm:text-5xl lg:text-7xl text-white font-bold font-plusjakartasans uppercase">
                                                {{ $div->singkatan == 'kaderisasi-advokasi' ? 'Kaderisasi & Advokasi' : $div->singkatan }}
                                            </h2>
                                            <p class="text-white sm:text-lg md:text-xl sm:mt-2 capitalize">
                                                {{ $div->divisi }}
                                            </p>
                                        </div>
                                    </div>
                                    <div
                                        class="absolute top-8 right-8 w-14 h-14 bg-navy rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 duration-500 ease-in-out z-10">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="size-6 text-white">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                                        </svg>
                                    </div>
                                </div>
                            </a>

                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
</x-main-layout>
