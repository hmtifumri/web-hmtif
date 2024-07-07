<x-app-layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <div>
        @livewire('dashboard.kepengurusan.filter')
        @livewire('dashboard.kepengurusan.index')
    </div>
</x-app-layout>
