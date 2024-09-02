<x-main-layout>
    <x-slot name="title">Profil</x-slot>

    <section class="pb-10 lg:pb-24 lg:pt-14">
        <div class="container mx-auto px5">
            <h1 class="title uppercase text-center mb-10">Artikel</h1>

            @livewire('article.index')
        </div>
    </section>
</x-main-layout>
