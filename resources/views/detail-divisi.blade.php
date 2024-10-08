<x-main-layout>
    @push('scripts')
        <script>
            new Splide("#proker", {
                width: "100vw",
                interval: 4500,
                speed: 1000,
                autoplay: "play",
                arrows: true,
                pagination: false,
                gap: 30,
                perPage: 4,
                autoScroll: {
                    pauseOnHover: false,
                    speed: 1,
                },
                breakpoints: {
                    460: {
                        perPage: 1,
                    },
                    960: {
                        perPage: 2,
                    },
                    1200: {
                        perPage: 3,
                    },
                    1800: {
                        perPage: 4,
                    },
                }
            }).mount();
        </script>
    @endpush
    <x-slot name="title">{{ $title }}</x-slot>

    <section class="pb-10 lg:pb-20 lg:pt-14">
        <div class="container px-5 mx-auto">
            <h1 class="title uppercase text-center mx-auto max-w-3xl">{{ $title }}</h1>
            <div class="mt-8 mb-14">
                @php
                    $image = App\Models\DivisiImage::where('divisi_id', $divisi->id)
                        ->where('periode_id', $periode->id)
                        ->pluck('image')
                        ->first();
                @endphp
                <img class="w-full rounded-3xl" src="{{ asset($image) }}" alt="">
            </div>
            <div>
                @if ($divisi->images->where('periode_id', $periode->id)->first()->deskripsi == null)
                    <div>-</div>
                @else
                    <div
                        class="mb-5 deskripsi-content border bg-zinc-200 dark:bg-zinc-900 dark:border-zinc-800 rounded-3xl p-6">
                        <h1 class="text-2xl md:text-4xl font-bold font-plusjakartasans mb-6">Deskripsi</h1>
                        {!! $divisi->images->where('periode_id', $periode->id)->first()->deskripsi !!}
                    </div>
                @endif

                <div class="flex flex-wrap items-center justify-center -mx-5 lg:-mx-10 mb-10">
                    @foreach (['kadiv', 'stafsus'] as $role)
                        @if ($users->where('jabatan', $role)->isNotEmpty())
                            @foreach ($users->where('jabatan', $role) as $user)
                                <div class="w-full md:w-1/2 lg:w-1/3 px-5 lg:px-10 group p-4">
                                    <div class="relative overflow-hidden rounded-3xl">
                                        <img src="{{ asset($user->gambar) }}"
                                            class="w-full group-hover:scale-110 duration-500 ease-in-out"
                                            alt="">
                                        <div
                                            class="absolute inset-0 group-hover:bg-zinc-900/60 dark:group-hover:bg-zinc-950/70 group-hover:backdrop-blur-sm duration-500 ease-in-out">
                                            <div
                                                class="absolute top-full -translate-y-16 2xl:-translate-y-20 left-1/2 -translate-x-1/2 group-hover:top-1/2 w-full group-hover:-translate-y-1/2 duration-500 ease-in-out">
                                                <div class="text-center">
                                                    <h3
                                                        class="text-2xl 2xl:text-3xl text-white font-semibold font-plusjakartasans">
                                                        {{ $user->name }}
                                                        <span
                                                            class="text-sm block font-medium mt-1 opacity-0 group-hover:opacity-100 duration-500 ease-in-out">
                                                            {{ $user->nim }}
                                                        </span>
                                                    </h3>
                                                    <p
                                                        class="text-white capitalize -mt-6 group-hover:mt-2 duration-500 ease-in-out">
                                                        @switch(strtolower($user->jabatan))
                                                            @case('kadiv')
                                                                ~ Kepala Divisi ~
                                                            @break

                                                            @case('stafsus')
                                                                ~ Staf Khusus ~
                                                            @break

                                                            @default
                                                                ~ {{ ucwords(str_replace('_', ' ', $user->jabatan)) }} ~
                                                        @endswitch
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endforeach
                </div>

                <div class="flex flex-wrap items-center justify-center -mx-5 lg:-mx-10 mb-10">
                    @foreach (['anggota'] as $role)
                        @if ($users->where('jabatan', $role)->isNotEmpty())
                            @foreach ($users->where('jabatan', $role) as $user)
                                <div class="w-full md:w-1/2 lg:w-1/3 px-5 lg:px-10 group p-4">
                                    <div class="relative overflow-hidden rounded-3xl">
                                        <img src="{{ asset($user->gambar) }}"
                                            class="w-full group-hover:scale-110 duration-500 ease-in-out"
                                            alt="">
                                        <div
                                            class="absolute inset-0 group-hover:bg-zinc-900/60 dark:group-hover:bg-zinc-950/70 group-hover:backdrop-blur-sm duration-500 ease-in-out">
                                            <div
                                                class="absolute top-full -translate-y-16 2xl:-translate-y-20 left-1/2 -translate-x-1/2 group-hover:top-1/2 w-full group-hover:-translate-y-1/2 duration-500 ease-in-out">
                                                <div class="text-center">
                                                    <h3
                                                        class="text-2xl 2xl:text-3xl text-white font-semibold font-plusjakartasans">
                                                        {{ $user->name }}
                                                        <span
                                                            class="text-sm block font-medium mt-1 opacity-0 group-hover:opacity-100 duration-500 ease-in-out">
                                                            {{ $user->nim }}
                                                        </span>
                                                    </h3>
                                                    <p
                                                        class="text-white capitalize -mt-6 group-hover:mt-2 duration-500 ease-in-out">
                                                        @switch(strtolower($user->jabatan))
                                                            @case('kadiv')
                                                                ~ Kepala Divisi ~
                                                            @break

                                                            @case('stafsus')
                                                                ~ Staf Khusus ~
                                                            @break

                                                            @default
                                                                ~ {{ ucwords(str_replace('_', ' ', $user->jabatan)) }} ~
                                                        @endswitch
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endforeach
                </div>

                <div class="flex flex-wrap items-center justify-center -mx-5 lg:-mx-10 mb-10">
                    @foreach (['magang'] as $role)
                        @if ($users->where('jabatan', $role)->isNotEmpty())
                            @foreach ($users->where('jabatan', $role) as $user)
                                <div class="w-full md:w-1/2 lg:w-1/3 px-5 lg:px-10 group p-4">
                                    <div class="relative overflow-hidden rounded-3xl">
                                        <img src="{{ asset($user->gambar) }}"
                                            class="w-full group-hover:scale-110 duration-500 ease-in-out"
                                            alt="">
                                        <div
                                            class="absolute inset-0 group-hover:bg-zinc-900/60 dark:group-hover:bg-zinc-950/70 group-hover:backdrop-blur-sm duration-500 ease-in-out">
                                            <div
                                                class="absolute top-full -translate-y-16 2xl:-translate-y-20 left-1/2 -translate-x-1/2 group-hover:top-1/2 w-full group-hover:-translate-y-1/2 duration-500 ease-in-out">
                                                <div class="text-center">
                                                    <h3
                                                        class="text-2xl 2xl:text-3xl text-white font-semibold font-plusjakartasans">
                                                        {{ $user->name }}
                                                        <span
                                                            class="text-sm block font-medium mt-1 opacity-0 group-hover:opacity-100 duration-500 ease-in-out">
                                                            {{ $user->nim }}
                                                        </span>
                                                    </h3>
                                                    <p
                                                        class="text-white capitalize -mt-6 group-hover:mt-2 duration-500 ease-in-out">
                                                        @switch(strtolower($user->jabatan))
                                                            @case('kadiv')
                                                                ~ Kepala Divisi ~
                                                            @break

                                                            @case('stafsus')
                                                                ~ Staf Khusus ~
                                                            @break

                                                            @default
                                                                ~ {{ ucwords(str_replace('_', ' ', $user->jabatan)) }} ~
                                                        @endswitch
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endforeach
                </div>
            </div>

            @empty(!$proker->count())
                <div class="mt-10 mb-5">
                    <h1 class="text-2xl md:text-4xl font-bold font-plusjakartasans">Proker yang telah dilaksanakan</h1>
                    <div class="mt-8">
                        <div id="proker" class="splide" aria-label="Proker">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    @foreach ($proker as $i => $item)
                                        <li class="splide__slide rounded-3xl">
                                            <div>
                                                <div>
                                                    <img src="{{ asset($item->gambar) }}" alt="{{ $item->nama }}"
                                                        class="rounded-3xl">
                                                </div>
                                                <div class="p-4 pl-0">
                                                    <p class="text-gray-500 font-medium text-sm">
                                                        {{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d M Y') }}
                                                    </p>
                                                    <a class="hover:text-navy dark:text-navy2 duration-300"
                                                        href="{{ route('detail.proker', [str_replace('/', '-', $periode->periode), $item->divisi->singkatan, $item->slug]) }}"
                                                        wire:navigate>
                                                        <h3
                                                            class="font-bold font-plusjakartasans text-lg line-clamp-2 capitalize">
                                                            {{ $item->nama }}
                                                        </h3>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endempty
        </div>
    </section>
</x-main-layout>
