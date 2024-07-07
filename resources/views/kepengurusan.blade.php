<x-main-layout>
    <x-slot name="title">Profil</x-slot>

    <section class="pb-10 lg:pb-24 lg:pt-14">
        <div class="container mx-auto px-5">
            @php
                $periode_aktif = App\Models\Periode::where('status', 'aktif')->first();
            @endphp
            <h1 class="title uppercase text-center mx-auto max-w-3xl">struktur kepengurusan {{ $periode_aktif->periode }}</h1>
            <div class="mt-4 lg:mt-20">
                <div class="flex flex-wrap items-center justify-between -mx-5 lg:-mx-10">
                    <div class="w-full md:w-1/2 lg:w-1/3 px-5 lg:px-10 group order-3 lg:order-1 p-4">
                        <div class="relative overflow-hidden rounded-3xl">
                            <img src="{{ asset('assets/img/kepengurusan/bupati.png') }}" class=" w-full" alt="">
                            <div
                                class="absolute inset-0 group-hover:bg-zinc-900/60 dark:group-hover:bg-zinc-950/70 group-hover:backdrop-blur-sm duration-500 ease-in-out">
                                <div
                                    class="absolute top-full -translate-y-16 2xl:-translate-y-20 left-1/2 -translate-x-1/2 group-hover:top-1/2 w-full group-hover:-translate-y-1/2 duration-500 ease-in-out">
                                    <div class="text-center">
                                        <h3 class="text-2xl 2xl:text-3xl text-white font-semibold font-plusjakartasans">
                                            Ihkram Mulya
                                        </h3>
                                        <p class="text-white">Bupati HM-TIF</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/3 px-5 lg:px-10 order-1 lg:order-2 p-4 mb-6 lg:mb-0">
                        <img src="{{ asset('assets/img/logo.png') }}"
                            class="max-w-[250px] w-full lg:max-w-[350px] mx-auto" alt="Logo HMTIF">
                    </div>
                    <div class="w-full md:w-1/2 lg:w-1/3 px-5 lg:px-10 group order-2 lg:order-3 p-4">
                        <div class="relative overflow-hidden rounded-3xl">
                            <img src="{{ asset('assets/img/kepengurusan/bupati.png') }}" class=" w-full" alt="">
                            <div
                                class="absolute inset-0 group-hover:bg-zinc-900/60 dark:group-hover:bg-zinc-950/70 group-hover:backdrop-blur-sm duration-500 ease-in-out">
                                <div
                                    class="absolute top-full -translate-y-16 2xl:-translate-y-20 left-1/2 -translate-x-1/2 group-hover:top-1/2 w-full group-hover:-translate-y-1/2 duration-500 ease-in-out">
                                    <div class="text-center">
                                        <h3 class="text-2xl 2xl:text-3xl text-white font-semibold font-plusjakartasans">
                                            Ihkram Mulyaa
                                        </h3>
                                        <p class="text-white">Bupati HM-TIF</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="flex flex-wrap items-center justify-center lg:justify-between -mx-4 lg:-mx-8 sm:px-8 lg:px-10 mt-0 lg:mt-16">
                    <div class="w-full sm:w-1/2 md:w-1/3 p-4 lg:px-8 group">
                        <div class="relative overflow-hidden rounded-3xl">
                            <img src="{{ asset('assets/img/kepengurusan/bupati.png') }}" class=" w-full" alt="">
                            <div
                                class="absolute inset-0 group-hover:bg-zinc-900/60 dark:group-hover:bg-zinc-950/70 group-hover:backdrop-blur-sm duration-500 ease-in-out">
                                <div
                                    class="absolute top-full -translate-y-16 2xl:-translate-y-20 left-1/2 -translate-x-1/2 group-hover:top-1/2 w-full group-hover:-translate-y-1/2 duration-500 ease-in-out">
                                    <div class="text-center">
                                        <h3 class="text-2xl 2xl:text-3xl text-white font-semibold font-plusjakartasans">
                                            Ihkram Mulya
                                        </h3>
                                        <p class="text-white">Bupati HM-TIF</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full sm:w-1/2 md:w-1/3 p-4 lg:px-8 group">
                        <div class="relative overflow-hidden rounded-3xl">
                            <img src="{{ asset('assets/img/kepengurusan/bupati.png') }}" class=" w-full" alt="">
                            <div
                                class="absolute inset-0 group-hover:bg-zinc-900/60 dark:group-hover:bg-zinc-950/70 group-hover:backdrop-blur-sm duration-500 ease-in-out">
                                <div
                                    class="absolute top-full -translate-y-16 2xl:-translate-y-20 left-1/2 -translate-x-1/2 group-hover:top-1/2 w-full group-hover:-translate-y-1/2 duration-500 ease-in-out">
                                    <div class="text-center">
                                        <h3 class="text-2xl 2xl:text-3xl text-white font-semibold font-plusjakartasans">
                                            Ihkram Mulya
                                        </h3>
                                        <p class="text-white">Bupati HM-TIF</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full sm:w-1/2 md:w-1/3 p-4 lg:px-8 group">
                        <div class="relative overflow-hidden rounded-3xl">
                            <img src="{{ asset('assets/img/kepengurusan/bupati.png') }}" class=" w-full" alt="">
                            <div
                                class="absolute inset-0 group-hover:bg-zinc-900/60 dark:group-hover:bg-zinc-950/70 group-hover:backdrop-blur-sm duration-500 ease-in-out">
                                <div
                                    class="absolute top-full -translate-y-16 2xl:-translate-y-20 left-1/2 -translate-x-1/2 group-hover:top-1/2 w-full group-hover:-translate-y-1/2 duration-500 ease-in-out">
                                    <div class="text-center">
                                        <h3 class="text-2xl 2xl:text-3xl text-white font-semibold font-plusjakartasans">
                                            Ihkram Mulya
                                        </h3>
                                        <p class="text-white">Bupati HM-TIF</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                    $divisi = [
                        [
                            'name' => 'PSDM',
                            'fullname' => 'Pemberdayaan Sumber Daya Mahasiswa',
                        ],
                        [
                            'name' => 'humas',
                            'fullname' => 'Kehumasan',
                        ],
                        [
                            'name' => 'kaderisasi',
                            'fullname' => 'Kaderisasi & Advokasi',
                        ],
                        [
                            'name' => 'kominfo',
                            'fullname' => 'Komunikasi & Informasi',
                        ],
                        [
                            'name' => 'kwu',
                            'fullname' => 'Kewirausahaan',
                        ],
                        [
                            'name' => 'kerohanian',
                            'fullname' => 'Kerohanian',
                        ],
                    ];
                @endphp
                @foreach ($divisi as $div)
                    <div class="w-full rounded-3xl overflow-hidden relative group">
                        <a href="">
                            <img class="group-hover:scale-110 duration-500 ease-in-out"
                                src="{{ asset('assets/img/kepengurusan/divisi/' . $div['name'] . '.png') }}"
                                alt="PSDM">
                            <div
                                class="absolute inset-0 group-hover:bg-zinc-900/60 dark:group-hover:bg-zinc-950/70 group-hover:backdrop-blur-sm duration-500 ease-in-out z-0">
                                <div
                                    class="absolute top-full opacity-0 group-hover:opacity-100 -translate-y-16 2xl:-translate-y-20 left-1/2 -translate-x-1/2 group-hover:top-1/2 w-full group-hover:-translate-y-1/2 duration-500 ease-in-out">
                                    <div class="text-center px-4">
                                        <h2
                                            class="text-4xl sm:text-5xl lg:text-7xl text-white font-bold font-plusjakartasans uppercase">
                                            {{ $div['name'] }}
                                        </h2>
                                        <p class="text-white sm:text-lg md:text-xl sm:mt-2 capitalize">
                                            {{ $div['fullname'] }}
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
                @endforeach
            </div>
        </div>
    </section>
</x-main-layout>
