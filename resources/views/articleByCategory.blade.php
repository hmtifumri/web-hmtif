<x-main-layout>
    <x-slot name="title">Kategori {{ $title }}</x-slot>

    <section class="pb-10 lg:pb-24 lg:pt-14">
        <div class="container mx-auto px-5">
            <h1 class="title uppercase text-center mb-8">Kategori: {{ $title }}</h1>
            <div class="px-5">
                @livewire('article.article-by-category', ['kategori' => $kategori])
            </div>
        </div>
    </section>
</x-main-layout>
