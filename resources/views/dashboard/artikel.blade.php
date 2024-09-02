<x-app-layout>
   <x-slot name="title">{{ $title }}</x-slot>

   <div>
      @livewire('dashboard.article.index')
   </div>
</x-app-layout>