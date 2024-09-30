<x-app-layout>
   <x-slot name="title">{{ $title }}</x-slot>

   <div>
      <livewire:dashboard.proker.create :periode="$periode">
   </div>
</x-app-layout>