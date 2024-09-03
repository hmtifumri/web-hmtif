<x-main-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    <article class="pb-10 lg:pb-24 lg:pt-14">
        <div class="container mx-auto px-5 max-w-4xl">
            <h1
                class="capitalize text-center mb-10 text-2xl sm:text-3xl lg:text-5xl font-bold font-plusjakartasans text-zinc-800 lg:!leading-tight dark:text-zinc-200" data-aos="fade-up">
                {{ $title }}
            </h1>
            <div class="mb-8">
                <img src="{{ asset($article->image) }}" class="w-full rounded-xl md:rounded-2xl lg:rounded-3xl"
                    alt="{{ $title }}" data-aos="fade-up">
            </div>
            <div
                class="flex items-center justify-center text-sm sm:text-lg text-navy dark:text-navy2 gap-1 sm:gap-2 font-semibold font-plusjakartasans" data-aos="fade-up">
                <div>By Admin</div> · 
                <div>{{ $article->created_at->format('d F Y') }}</div> · 
                <a href="{{ route('artikelByKategori', $article->category->slug) }}" wire:navigate
                    class="hover:underline">{{ $article->category->category }}</a>
            </div>

            <div class="mt-10 artikel-body font-medium" data-aos="fade-up">
                {!! $article->body !!}
            </div>

            <div class="mt-10" data-aos="fade-up">
                <div class="sm:flex sm:items-center sm:justify-between sm:-mx-4 gap-4 md:gap-8 space-y-5 sm:space-y-0">
                    @if ($previousArticle)
                        <div class="inline-flex items-center gap-3 p-5 bg-cover relative text-white before:absolute before:inset-0 before:bg-black/70 rounded-2xl overflow-hidden before:-z-10 z-10 sm:!bg-none sm:before:bg-transparent sm:text-zinc-800 max-w-xl" style="background-image: url({{ asset($previousArticle->image) }})">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" class="size-5 shrink-0 text-zinc-800 dark:text-zinc-200">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                            </svg>
                            <a href="{{ route('showArticle', $previousArticle->slug) }}"
                                class="capitalize text-xl font-semibold font-plusjakartasans line-clamp-2 hover:text-navy dark:hover:text-navylight dark:text-zinc-200" wire:navigate>
                                {{ $previousArticle->title }}
                            </a>
                        </div>
                    @else
                       
                    @endif
                    <div class="px-4 hidden md:block">
                     <a href="{{ route('artikel') }}" wire:navigate>
                        <svg width="66" height="66" viewBox="0 0 66 66" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.4">
                                <path
                                    d="M54.195 63.8679H11.425C8.93979 63.8571 6.55975 62.8637 4.8043 61.1045C3.04885 59.3453 2.06051 56.9631 2.05499 54.4779V22.7379C2.06501 21.0553 2.52693 19.4064 3.39245 17.9635C4.25797 16.5206 5.49528 15.3368 6.97499 14.5359L28.32 2.86988C29.6946 2.12155 31.2349 1.72949 32.8 1.72949C34.3651 1.72949 35.9053 2.12155 37.28 2.86988L58.685 14.4749C60.1647 15.2756 61.4022 16.4592 62.2679 17.9019C63.1335 19.3446 63.5957 20.9934 63.606 22.6759V54.4769C63.6007 56.9691 62.607 59.3574 60.8428 61.1178C59.0787 62.8782 56.6882 63.8669 54.196 63.8669L54.195 63.8679ZM32.81 5.82188C31.9295 5.82069 31.0626 6.0393 30.288 6.45788L8.88199 18.0839C8.05177 18.5437 7.36053 19.2184 6.88074 20.0372C6.40095 20.856 6.15027 21.7889 6.15499 22.7379V54.4779C6.15499 55.8809 6.71233 57.2264 7.7044 58.2185C8.69647 59.2105 10.042 59.7679 11.445 59.7679H54.195C55.5945 59.7626 56.9349 59.2029 57.9227 58.2114C58.9104 57.2199 59.465 55.8774 59.465 54.4779V22.7379C59.4657 21.7847 59.2089 20.8491 58.7216 20.0299C58.2344 19.2107 57.5349 18.5383 56.697 18.0839L35.332 6.47888C34.5593 6.05299 33.6923 5.82713 32.81 5.82188Z"
                                    fill="#565763" />
                                <path
                                    d="M32.807 54.8669C29.953 54.8676 27.1875 53.876 24.9842 52.0619C22.781 50.2478 21.277 47.724 20.73 44.9229C20.6857 44.6291 20.7057 44.3292 20.7886 44.0439C20.8716 43.7586 21.0155 43.4947 21.2104 43.2705C21.4054 43.0463 21.6467 42.8671 21.9177 42.7452C22.1887 42.6234 22.4829 42.5619 22.78 42.5649C23.2686 42.5576 23.7438 42.7251 24.1198 43.0371C24.4959 43.3492 24.7481 43.7853 24.831 44.2669C25.2178 46.1094 26.2267 47.7628 27.6884 48.9494C29.15 50.136 30.9753 50.7837 32.858 50.7837C34.7407 50.7837 36.566 50.136 38.0276 48.9494C39.4893 47.7628 40.4982 46.1094 40.885 44.2669C40.9679 43.7855 41.2199 43.3495 41.5958 43.0375C41.9716 42.7254 42.4465 42.5578 42.935 42.5649C43.2322 42.5616 43.5266 42.6228 43.7977 42.7446C44.0689 42.8663 44.3104 43.0455 44.5054 43.2698C44.7004 43.4941 44.8443 43.7581 44.9271 44.0436C45.0099 44.329 45.0297 44.6291 44.985 44.9229C44.4347 47.7411 42.9159 50.2781 40.6918 52.0942C38.4677 53.9103 35.6783 54.8912 32.807 54.8669Z"
                                    fill="#565763" />
                            </g>
                        </svg>
                     </a>
                    </div>
                    @if ($nextArticle)
                        <div class="inline-flex items-center gap-3 p-5 bg-cover relative text-white before:absolute before:inset-0 before:bg-black/70 rounded-2xl overflow-hidden before:-z-10 z-10 sm:!bg-none sm:before:bg-transparent sm:text-zinc-800 max-w-xl" style="background-image: url({{ asset($nextArticle->image) }})">
                           <a href="{{ route('showArticle', $nextArticle->slug) }}" class="capitalize text-xl font-semibold font-plusjakartasans line-clamp-2 hover:text-navy dark:hover:text-navylight dark:text-zinc-200 text-right" wire:navigate>
                               {{ $nextArticle->title }}
                           </a>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" class="size-5 shrink-0 text-zinc-800 dark:text-zinc-200">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                        </div>
                    @else
                        
                    @endif
                </div>
            </div>
        </div>
    </article>
</x-main-layout>
