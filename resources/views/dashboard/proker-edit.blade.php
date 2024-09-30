<x-app-layout>
   <x-slot name="title">Edit Proker "{{ $proker->nama }}"</x-slot>

   <div>
      <livewire:dashboard.proker.edit :periode="$periode" :proker="$proker">
   </div>
</x-app-layout>