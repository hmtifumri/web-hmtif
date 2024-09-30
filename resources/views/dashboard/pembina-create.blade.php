<x-app-layout>
   <x-slot name="title">{{ $title }}</x-slot>

   <section>
      <livewire:dashboard.pembina.create :periode='$periode'>
   </section>
</x-app-layout>