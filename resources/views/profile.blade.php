<x-main-layout>
    <x-slot name="title">Profil</x-slot>

    <section class="pb-10 lg:pb-24 lg:pt-14">
        <div class="container mx-auto px-5">
            <div>
                <img src="{{ asset('assets/img/banner/profile.png') }}" class="rounded-3xl min-h-[400px] object-cover"
                    alt="About" data-aos="fade-up">
            </div>
            <div class="mt-8 bg-navy dark:bg-navy/80 py-14 px-6 rounded-3xl" data-aos="fade-up">
                <div class="flex flex-wrap items-center -mx-5">
                    <div class="w-full lg:w-[30%] px-5">
                        <h1
                            class="text-4xl md:text-5xl mb-3 lg:mb-0 lg:text-7xl 2xl:text-8xl font-plusjakartasans font-extrabold text-[#ABCDFF] dark:text-navylight">
                            PROFIL</h1>
                    </div>
                    <div
                        class="w-full lg:w-[70%] px-5 text-zinc-100 border-l-4 -ml-1 lg:ml-0 lg:border-l-2 lg:pl-14 border-[#659EF4] dark:border-navy2 dark:text-zinc-200">
                        <p>Himpunan Mahasiswa Teknik Informatika atau yang dikenal dengan HM-TIF adalah sebuah
                            organisasi mahasiswa dalam lingkup program studi teknik Informatika, Fakultas Ilmu Komputer,
                            Universitas Muhammadiyah Riau. Saat ini HM-TIF memiliki 6 divisi yaitu Kaderisasi &
                            Advokasi, PSDM, Humas, Kerohanian, Kominfo dan Kewirausahaan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-10 lg:pb-24">
        <div class="container mx-auto px-5">
            <div class="text-center pb-14">
                <h1 class="title uppercase max-w-3xl mx-auto" data-aos="fade-up">VISI</h1>
                <p class="md:text-lg lg:text-xl font-plusjakartasans text-zinc-700 dark:text-zinc-300 font-medium mt-10 max-w-4xl mx-auto"
                    data-aos="fade-up">
                    Menjadikan HMTIF sebagai wadah aspirasi dan kreatifitas yang optimal dalam mewujudkan organisasi
                    yang
                    lebih profesional dengan asas kekeluargaan
                </p>
            </div>
            <div class="text-center pt-12">
                <h1 class="title uppercase max-w-3xl mx-auto" data-aos="fade-up">misi</h1>
                <?php
                $misi = [
                    [
                        'number' => 1,
                        'text' => 'Menciptakan iklim organisasi yang dinamis dan progresif',
                    ],
                    [
                        'number' => 2,
                        'text' => 'Mengoptimalkan kepengurusan hmtif sebagai wadah terjalinnya komunikasi yang produktif dalam ruang lingkup internal HMTIF maupun dengan pihak eksternal',
                    ],
                    [
                        'number' => 3,
                        'text' => 'Membangkitkan kualitas pengurus HMTIF yang adaptif dan inovatif',
                    ],
                ];
                ?>

                <div class="flex flex-wrap -mx-4 mt-14">
                    @foreach ($misi as $i => $item)
                    <div class="w-full lg:w-1/3 px-4 mb-4 lg:mb-0" data-aos="zoom-in-up" data-aos-delay="<?= $i * 100 ?>">
                        <div class="bg-[#486DA3]/15 h-full rounded-3xl hover:bg-navy2 duration-500 dark:bg-transparent dark:bg-gradient-to-br dark:from-zinc-800/80 dark:to-zinc-900 py-10 px-8 group">
                            <div class="flex items-center justify-between gap-4">
                                <div class="w-14 h-14 flex items-center justify-center group-hover:bg-navylight dark:group-hover:bg-navy duration-300 rounded-full bg-[#395682] text-3xl font-plusjakartasans font-extrabold text-white">
                                    <?= $item['number'] ?>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-navy dark:text-zinc-500 group-hover:text-white duration-300">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9h16.5m-16.5 6.75h16.5" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-left text-xl md:text-2xl mt-8 text-navy font-medium dark:text-zinc-300 group-hover:text-white duration-300">
                                <?= $item['text'] ?>
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <div class="py-14">
        <img src="{{ asset('assets/icons/pattern.svg') }}" class="w-full" alt="">
    </div>

    <section class="pb-10 lg:pb-24 pt-14">
        <div class="container mx-auto px-5">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <h1 data-aos="fade-right"
                    class="uppercase text-[46px] md:text-6xl text-center mx-auto lg:mx-0 lg:text-left lg:text-7xl font-plusjakartasans font-bold text-[#395682] max-w-lg !leading-none dark:text-transparent dark:bg-gradient-to-br dark:from-navy2 dark:to-navy3 dark:bg-clip-text">
                    filosofi
                    logo
                    hm-tif</h1>
                <div class=" mx-auto mt-3 lg:mt-0 lg:mx-0">
                    <img src="{{ asset('assets/img/logo.png') }}" class="w-40 lg:w-60 " alt="Logo HM-TIF" data-aos="fade-left">
                </div>
            </div>
            <p class="mt-14 text-lg lg:text-2xl text-zinc-600 dark:text-zinc-300" data-aos="fade-up">
                Lambang HM-TIF UMRI berupa lingkaran biru putus-putus yang di sisi nya terdapat tulisan “UNIVERSITAS
                MUHAMMADIYAH RIAU”, dengan gambar membentuk lingkaran di spesifikasikan dengan ke identikkannya dengan
                logo muhammadiyah di dalam lingkaran biru yang saling bergandengan dengan tulisan “HM-TIF FASILKOM” yang
                tertuliskan di tengah logo
            </p>
        </div>
    </section>
</x-main-layout>
