<x-app-layout>
   <x-slot name="title">{{ $title }}</x-slot>

   @livewire('dashboard.article.edit', ['artikel' => $artikel])
</x-app-layout>