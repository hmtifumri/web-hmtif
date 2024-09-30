<x-app-layout>
   <x-slot name="title">{{ $title }}</x-slot>
   
   @include('components.alert')
   <div class="sm:flex items-center justify-between">
       <div>
           <ul class="flex items-center gap-x-6 mt-6">
               <li class="text-sm text-gray-500 font-semibold">
                   Semua {{ $articles->count() }}
               </li>
               <li class="text-sm text-gray-500 font-semibold">
                   <span class="text-blue-500">Publish </span> {{ $articles->where('is_published', 1)->count() }}
               </li>
               <li class="text-sm text-gray-500 font-semibold">
                   <span class="text-blue-500">Draft</span> {{ $articles->where('is_published', 0)->count() }}
               </li>
           </ul>
       </div>
       <div class="mt-6 sm:mt-0 text-right">
           <a href="{{ route('dashboard.artikel.tambah') }}" wire:navigate
               class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-lg shadow-blue-500/30 inline-block">
               Tambah Artikel</a>
       </div>
   </div>

   <div class="mt-14">
      @livewire('dashboard.article.index')
   </div>
</x-app-layout>