@props(['image', 'created_at', 'categorySlug', 'categoryName', 'slug', 'title', 'excerpt', 'bodyText'])

<div class="w-full sm:w-1/2 lg:w-1/3 p-4">
   <div class="border rounded-2xl border-zinc-300 dark:border-zinc-800">
       <div class="p-2">
           <img src="{{ asset($image) }}" class="rounded-2xl" alt="">
       </div>
       <div class="p-4 pt-2">
           <p class="mb-3 font-semibold text-zinc-700 dark:text-zinc-500">
               {{ $created_at }} ~ 
               <a href="{{ route('artikelByKategori', $categorySlug) }}"
                   wire:navigate
                   class="hover:underline hover:text-navy2">{{ $categoryName }}</a>
           </p>
           <a href="{{ route('showArticle', $slug) }}" wire:navigate
               class="hover:text-navy2 duration-300 block">
               <h3 class="text-lg font-semibold font-plusjakartasans line-clamp-2">
                   {{ $title }}</h3>
           </a>
           <p class="line-clamp-2 mt-2 text-sm text-zinc-500 dark:text-zinc-400">
               {{ $excerpt }}{{ strlen($bodyText) > strlen($excerpt) ? '...' : '' }}
           </p>
       </div>
   </div>
</div>
