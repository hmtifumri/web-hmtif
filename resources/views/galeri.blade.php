<x-main-layout>
    <x-slot name="title">Profil</x-slot>

    <section class="pb-10 lg:pb-24 lg:pt-14">
        <div class="mb-10 lg:mb-20">
            <h1
                class="title uppercase text-center relative before:absolute before:w-full before:h-px before:content-[''] before:bg-zinc-300 before:left-0 before:top-1/2 before:-translate-y-1/2 before:z-0 dark:before:bg-zinc-700">
                <span class="bg-[#EBF0F9] dark:bg-zinc-950 dark:text-navy3 relative z-10 px-5">2024</span>
            </h1>
        </div>

        <div class="container mx-auto px-5">

            <div class="sm:columns-2 lg:columns-3 gap-4 lg:gap-6">
                @for ($i = 0; $i < 20; $i++)
                    <img class="mb-4 lg:mb-6 rounded-3xl max-h-[800px] aspect-auto w-full object-cover object-center" src="{{ asset('assets/img/galeri/1.png') }}" alt="">
                    <img class="mb-4 lg:mb-6 rounded-3xl max-h-[800px] aspect-auto w-full object-cover object-center" src="{{ asset('assets/img/galeri/2.png') }}" alt="">
                    <img class="mb-4 lg:mb-6 rounded-3xl max-h-[800px] aspect-auto w-full object-cover object-center" src="{{ asset('assets/img/galeri/3.png') }}" alt="">
                @endfor
            </div>

        </div>
    </section>
</x-main-layout>
