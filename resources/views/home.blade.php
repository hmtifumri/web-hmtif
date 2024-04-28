<x-main-layout>
    @push('scripts')
        <script>
            new Splide("#banner", {
                heightRatio: 0.7,
                cover: true,
                width: "100vw",
                type: "loop",
                interval: 4000,
                speed: 1000,
                autoplay: "play",
                arrows: false,
                pagination: false,
                gap: 30,
            }).mount();

            new Splide("#divisions", {
                type: "loop",
                drag: false,
                focus: "center",
                perPage: 6,
                arrows: false,
                pagination: false,
                autoScroll: {
                    speed: 1,
                },
                breakpoints: {
                    1300: {
                        perPage: 5
                    },
                    768: {
                        perPage: 4,
                    },
                    630: {
                        perPage: 3,
                    },
                    480: {
                        perPage: 2,
                    },
                },
            }).mount(window.splide.Extensions);
        </script>
    @endpush

    <x-slot name="title">{{ $title }}</x-slot>

    <section class="pb-10 lg:pb-20">
        <div class="container px-5 mx-auto">
            <div class="text-center">
                <h1
                    class="text-navy2 dark:text-navy3 font-black text-[12vw] sm:text-[80px] md:text-[100px] lg:text-[140px] xl:text-[160px] flex justify-center leFadeIn font-plusjakartasans">
                    <span>H</span><span>M</span><span>-</span><span>T</span><span>I</span><span>F</span><span
                        class="ml-4 lg:ml-8"></span><span>U</span><span>M</span><span>R</span><span>I</span>
                </h1>
                <p
                    class="font-zodiak uppercase text-navy2 dark:text-navylight -mt-3 text-sm sm:text-base cssanimation fadeIn sequence">
                    #SATUUNTUKSEMUAUNTUKSATU</p>
            </div>
        </div>
    </section>

    {{-- banner --}}
    <section class="relative pb-10 lg:pb-16">
        <div class="container px-5 mx-auto ">
            <div id="banner" class="splide" aria-label="Banner">
                <div class="splide__track">
                    <ul class="splide__list">
                        <li class="splide__slide rounded-3xl">
                            <img src="{{ asset('assets/img/banner/1.png') }}"
                                class="w-full h-auto object-cover object-center" alt="">
                        </li>
                        <li class="splide__slide rounded-3xl">
                            <img src="{{ asset('assets/img/banner/2.png') }}"
                                class="w-full h-auto object-cover object-center" alt="">
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="absolute bottom-6 left-1/2 -translate-x-1/2">
            <a href="#profile"
                class="w-12 h-12 md:w-20 md:h-20 flex items-center justify-center rounded-full bg-gradient-to-br from-[#496fa8] dark:from-[#2f4875] dark:to-[#2a3e62] to-[#395682] text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-6 h-6 md:w-[41px] md:h-[41px] cssanimation hu__hu__">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
                </svg>
            </a>
        </div>
    </section>
    {{-- end banner --}}

    <section class="relative border-b border-[#cbd3df] dark:border-zinc-800 pb-10 lg:pb-16 mb-10 lg:mb-24">
        <div class="container px-5 mx-auto">
            <div class="relative">
                <div id="divisions" class="splide" aria-label="Banner">
                    <div class="splide__track">
                        <ul class="splide__list items-center">
                            @php
                                $divisions = ['kominfo', 'psdm', 'kaderisasi', 'kwu', 'humas', 'kerohanian'];
                            @endphp
                            @foreach ($divisions as $division)
                                <li class="splide__slide text-center mx-6">
                                    <h1
                                        class="text-center text-[#b7bcc5] dark:text-zinc-700 uppercase leading-none text-2xl xl:text-[30px] font-extrabold font-plusjakartasans select-none">
                                        DIVISI <br> {{ $division }}</h1>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div
                    class="absolute top-0 left-0 bottom-0 w-14 sm:w-[120px] bg-gradient-to-r from-[#EBF0F9] dark:from-zinc-950 to-transparent">
                </div>
                <div
                    class="absolute top-0 right-0 bottom-0 w-14 sm:w-[120px] bg-gradient-to-l from-[#EBF0F9] dark:from-zinc-950 to-transparent">
                </div>
            </div>
        </div>
    </section>

    {{-- profile --}}
    <section class="pb-10 lg:pb-24" id="profile">
        <div class="container px-5 mx-auto">
            <div class="text-center mb-14">
                <h1 class="title uppercase max-w-3xl mx-auto">himpunan mahasiswa teknik informatika</h1>
                <p class="mt-5 text-zinc-400 dark:text-zinc-500 text-sm md:text-base max-w-4xl mx-auto">HM-TIF UMRI
                    adalah sebuah
                    organisasi mahasiswa
                    Teknik Informatika di Universitas Muhammadiyah Riau. Beralamat di Jalan Tuanku Tambusai, Delima,
                    Kec. Tampan, Kota Pekanbaru, Riau 28290</p>
            </div>

            <div class="flex flex-wrap -mx-5 items-center">
                <div class="w-full lg:w-[40%] px-5 mb-5 lg:mb-0">
                    <img src="{{ asset('assets/img/visimisi.jpg') }}" class="w-full rounded-3xl" alt="">
                </div>
                <div class="w-full lg:w-[60%] px-5">
                    <div class="mb-6">
                        <h1 class="title xl:!text-4xl uppercase">visi</h1>
                        <p class="text-zinc-400 dark:text-zinc-500 mt-3">Menjadikan HMTIF sebagai wadah aspirasi dan
                            kreatifitas yang
                            optimal dalam mewujudkan organisasi yang lebih profesional dengan asas kekeluargaan</p>
                    </div>
                    <div class="mb-14">
                        <h1 class="title xl:!text-4xl uppercase">misi</h1>
                        <ol class="text-zinc-400 dark:text-zinc-500 mt-3 list-inside list-decimal">
                            <li>Menciptakan iklim organisasi yang dinamis dan progresif</li>
                            <li>Mengoptimalkan kepengurusan hmtif sebagai wadah terjalinnya komunikasi yang produktif
                                dalam
                                ruang lingkup internal HMTIF maupun dengan pihak eksternal</li>
                            <li>Membangkitkan kualitas pengurus HMTIF yang adaptif dan inovatif</li>
                        </ol>
                    </div>
                    <div>
                        <a href="{{ route('profil') }}" wire:navigate
                            class="inline-flex items-center gap-3 text-navy2 dark:text-navy3 group relative">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 text-white dark:text-zinc-200 group-hover:text-white duration-300 z-10 ml-[10px]"
                                viewBox="0 0 16 16">
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="M5.47 13.03a.75.75 0 0 1 0-1.06L9.44 8L5.47 4.03a.75.75 0 0 1 1.06-1.06l4.5 4.5a.75.75 0 0 1 0 1.06l-4.5 4.5a.75.75 0 0 1-1.06 0"
                                    clip-rule="evenodd" />
                            </svg>
                            <span
                                class="ml-3 relative z-10 pr-[12px] group-hover:text-white duration-500 ease-in-out delay-75 group-hover:ml-0 font-semibold">More
                                About Us</span>
                            <div
                                class="w-10 h-10 flex items-center duration-500 ease-in-out justify-center bg-gradient-to-br from-[#496fa8] dark:from-[#2a426c] dark:to-[#253a5e] to-[#395682]  rounded-full group-hover:w-full absolute left-0 z-0">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- end profile --}}

    {{-- kepengurusan --}}
    <section class="pb-10 lg:pb-24">
        <div class="container px-5 mx-auto">
            <div class="sm:flex items-center justify-between gap-4 mb-10 md:mb-14">
                <h1 class="title uppercase max-w-lg">kepengurusan hm-tif</h1>
                <div class="mt-3 sm:mt-0 text-sm sm:text-base">
                    <a href=""
                        class="inline-flex items-center gap-2 border-b text-navy2 font-semibold border-b-navy2 group">
                        See More
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                            stroke="currentColor" class="w-4 h-4 group-hover:mb-2 duration-500 ease-in-out">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                        </svg>
                    </a>
                </div>
            </div>
            @php
                $divisions = ['kaderisasi & advokasi', 'psdm', 'kerohanian', 'humas', 'kominfo', 'kwu'];
            @endphp
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach ($divisions as $division)
                    <a href=""
                        class="text-center px-8 uppercase text-lg sm:text-2xl lg:text-4xl text-navy2 bg-[#486DA3]/15 rounded-3xl flex items-center justify-center h-[160px] font-extrabold font-plusjakartasans hover:bg-navy2 hover:text-white duration-300 dark:bg-transparent dark:bg-gradient-to-br dark:from-zinc-800/80 dark:to-zinc-900 dark:text-zinc-600 dark:hover:text-zinc-400 dark:hover:to-zinc-800 dark:transition-all">{{ $division }}</a>
                @endforeach
            </div>
        </div>
    </section>
    {{-- end kepengurusan --}}

    {{-- galeri --}}
    <section class="pb-10 lg:pb-24 pl-5">
        <div class="bg-white dark:bg-zinc-900 px-6 py-8 md:p-10 rounded-l-3xl">
            <div class="container mx-auto px-5">
                <div class="md:flex items-center justify-between gap-4 mb-10 md:mb-14">
                    <div class="sm:flex md:block justify-between items-center">
                        <h1 class="title uppercase max-w-3xl">galeri terbaru</h1>
                        <div class="mt-3 sm:mt-0 md:mt-3 text-sm sm:text-base">
                            <a href=""
                                class="inline-flex items-center gap-2 border-b text-navy2 font-semibold border-b-navy2 group">
                                See More
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.8" stroke="currentColor"
                                    class="w-4 h-4 group-hover:mb-2 duration-500 ease-in-out">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <p
                        class="mt-5 text-zinc-400 dark:text-zinc-600 text-sm md:text-base max-w-2xl text-left md:text-right">
                        Foto
                        dokumentasi acara-acara yang dilaksanakan oleh himpunan mahasiswa Teknik Informatika Universitas
                        Muhammadiyah Riau</p>
                </div>
                <div class="grid lg:grid-cols-2 gap-4">
                    <div class="col-span-2 lg:col-span-1">
                        <img src="{{ asset('assets/img/banner/1.png') }}" class="rounded-3xl" alt="">
                    </div>
                    <div class="col-span-2 lg:col-span-1">
                        <img src="{{ asset('assets/img/banner/1.png') }}" class="rounded-3xl" alt="">
                    </div>
                    <div class="col-span-2">
                        <div class="grid lg:grid-cols-3 gap-4">
                            <div class="col-span-1">
                                <img src="{{ asset('assets/img/banner/1.png') }}" class="rounded-3xl" alt="">
                            </div>
                            <div class="col-span-1">
                                <img src="{{ asset('assets/img/banner/1.png') }}" class="rounded-3xl"
                                    alt="">
                            </div>
                            <div class="col-span-1">
                                <img src="{{ asset('assets/img/banner/1.png') }}" class="rounded-3xl"
                                    alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- end galeri --}}


    {{-- artikel --}}
    <section class="pb-10 lg:pb-24">
        <div class="container mx-auto px-5">
            <div class="text-center mb-10 md:mb-14">
                <h1 class="title uppercase max-w-3xl mx-auto">artikel terbaru</h1>
                <p class="mt-5 text-zinc-400 dark:text-zinc-500 text-sm md:text-base max-w-2xl mx-auto">Lorem ipsum
                    dolor sit amet consectetur, adipisicing elit. Aut consequatur pariatur veritatis cum nostrum id ipsa
                    quisquam quasi est cumque.</p>
            </div>
            <div class="px-5">
                @for ($i = 0; $i < 5; $i++)
                    <div
                        class="flex mb-14 flex-wrap items-center -mx-5 group hover:bg-[#BED9FF] dark:hover:bg-navy/90 rounded-3xl hover:p-6 duration-500 ease-in-out">
                        <div class="w-full lg:w-[60%] px-5">
                            <div
                                class="text-sm text-zinc-400 dark:text-zinc-500 dark:group-hover:text-navylight duration-500 group-hover:text-[#395682]">
                                <p>12 Maret 2024 / Design / 5 min read</p>
                                <div class="mt-5 mb-9">
                                    <h2
                                        class="text-[#030303] dark:text-zinc-300 font-plusjakartasans  text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold line-clamp-2">
                                        Cara Membuat Website Dengan Mudah Tanpa Koding</h2>
                                    <p class="mt-4 lg:hidden line-clamp-2">Lorem ipsum dolor sit amet consectetur
                                        adipisicing elit. Tempora doloremque
                                        incidunt
                                        voluptates eligendi. Enim suscipit dolores minima, consequatur eveniet non!
                                        Minima
                                        nostrum cum natus molestiae, mollitia nulla? Esse, quae optio?</p>
                                </div>
                                <div>
                                    <a href="{{ route('profil') }}" wire:navigate
                                        class="inline-flex items-center gap-3 text-navy2 dark:text-navylight group relative">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-5 h-5 text-white dark:text-zinc-200 group-hover:text-white duration-300 z-10 ml-[10px]"
                                            viewBox="0 0 16 16">
                                            <path fill="currentColor" fill-rule="evenodd"
                                                d="M5.47 13.03a.75.75 0 0 1 0-1.06L9.44 8L5.47 4.03a.75.75 0 0 1 1.06-1.06l4.5 4.5a.75.75 0 0 1 0 1.06l-4.5 4.5a.75.75 0 0 1-1.06 0"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span
                                            class="ml-3 relative z-10 pr-[12px] group-hover:text-white duration-500 ease-in-out delay-75 group-hover:ml-0 font-semibold">Read
                                            More</span>
                                        <div
                                            class="w-10 h-10 flex items-center duration-500 ease-in-out justify-center bg-gradient-to-br from-[#496fa8] dark:from-[#24395e] dark:to-[#1c2c47] to-[#395682]  rounded-full group-hover:w-full absolute left-0 z-0">
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div
                            class="w-full lg:w-[40%] px-5 text-zinc-500 dark:text-zinc-400 line-clamp-2 hidden lg:block">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora doloremque incidunt
                                voluptates eligendi. Enim suscipit dolores minima, consequatur eveniet non! Minima
                                nostrum cum natus molestiae, mollitia nulla? Esse, quae optio?</p>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>
    {{-- end artikel --}}


    {{-- call to action --}}

    <section class="pb-10 lg:pb-24">
        <div class="container mx-auto px-5">
            <div class="bg-navy2 dark:bg-navy py-14 px-8 rounded-3xl">
                <h1
                    class="text-2xl md:text-4xl max-w-5xl mx-auto lg:text-5xl font-bold font-plusjakartasans text-center text-[#a3c4f5] dark:text-[#84a4d3]">
                    Daftarkan dirimu sekarang di Himpunan Mahasiswa Teknik Informatika
                </h1>
                <div class="text-center mt-14">
                    <a href=""
                        class="inline-flex items-center font-semibold text-lg md:text-xl bg-[#98C2FF] dark:bg-[#294268] dark:text-[#618ed1] px-6 py-2 rounded-2xl text-[#26436F] active:scale-90 duration-300 ease-in-out transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 md:w-10 md:h-10 mr-3"
                            viewBox="0 0 20 20">
                            <g fill="currentColor">
                                <path
                                    d="M5.5 6a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1zm1 6a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3m0-1a.5.5 0 1 1 0-1a.5.5 0 0 1 0 1m3-1a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1z" />
                                <path
                                    d="M3 6a3 3 0 0 1 3-3h6a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3zm3-2a2 2 0 0 0-2 2v6a1.99 1.99 0 0 0 .984 1.723C5.282 13.9 5.629 14 6 14h6a1.99 1.99 0 0 0 1.723-.984C13.9 12.718 14 12.371 14 12V6a2 2 0 0 0-2-2z" />
                                <path
                                    d="M8 17a3 3 0 0 1-2.236-1H12.5a3.5 3.5 0 0 0 3.5-3.5V5.764c.614.55 1 1.348 1 2.236v4.5a4.5 4.5 0 0 1-4.5 4.5z" />
                            </g>
                        </svg>
                        Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- end call to action --}}



</x-main-layout>
