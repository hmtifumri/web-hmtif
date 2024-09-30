<x-app-layout>
   <x-slot name="title">{{ $title }}</x-slot>

   <section>
      <livewire:dashboard.pembina.edit :pembina='$pembina' :periode='$periode'>
   </section>
</x-app-layout>