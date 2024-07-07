<x-app-layout>
   <x-slot name="title">{{ $title }}</x-slot>

   @livewire('dashboard.user.edit', ['user' => $user])
</x-app-layout>