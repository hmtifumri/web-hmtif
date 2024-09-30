<x-main-layout>
    @section('meta')
        @php
            $text = strip_tags($article->body);
            $words = explode(' ', $text);
            $limitedWords = array_slice($words, 0, 100);
            $limitedText = implode(' ', $limitedWords);
        @endphp
        <meta name="title" content="{{ $title }}">
        <meta name="description" content="{{ $limitedText }}">
        <meta name="image" content="{{ asset($article->image) }}">
        <meta name="keywords" content="Artikel, {{ $article->category->category }}, HM-TIF, Universitas Muhammadiyah Riau">
        <meta name="author" content="{{ $article->author }}">
        <meta name="robots" content="index, follow">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="article">
        <meta property="og:title" content="{{ $title }}">
        <meta property="og:description" content="{{ Str::limit(strip_tags($article->body), 150) }}">
        <meta property="og:image" content="{{ asset($article->image) }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:site_name" content="HM-TIF UMRI">

        <!-- Twitter -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $title }}">
        <meta name="twitter:description" content="{{ $limitedText }}">
        <meta name="twitter:image" content="{{ asset($article->image) }}">
        <meta name="twitter:site" content="@HMTIF_UMRI">
    @endsection

    <x-slot name="title">{{ $title }}</x-slot>

    <article class="pb-10 lg:pb-24 lg:pt-14">
        <div class="container mx-auto px-5">
            <div class="flex justify-center mt-10">
                <a class=" text-zinc-500 dark:text-zinc-400 group mb-8 lg:mb-12 inline-flex items-center gap-2 flex-wrap"
                    href="{{ route('artikel') }}" wire:navigate>
                    <div class="group-hover:text-navy dark:group-hover:text-navy2 transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewbox="0 0 20 20"
                            fill="none">
                            <path d="M15.4167 10H5M5 10L10 5M5 10L10 15" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </div>
                    <span
                        class="group-hover:text-navy dark:group-hover:text-navy2 transition duration-200 font-bold">Back
                        to Blog</span>
                </a>
            </div>
            <div class="flex items-center justify-center gap-3 flex-wrap mb-4" data-aos="fade-up">
                <div class="rounded-md border border-zinc-300 dark:border-zinc-700 py-0.5 px-2">
                    <span
                        class="text-zinc-700 dark:text-zinc-400 text-xs font-medium">{{ $article->category->category }}</span>
                </div>
            </div>
            <h1 class="text-center text-3xl lg:text-5xl font-bold mb-8 lg:mb-12 max-w-xl lg:max-w-3xl mx-auto capitalize"
                data-aos="fade-up">
                {{ $title }}</h1>
            <img class="w-full rounded-2xl mb-8 lg:mb-12" src="{{ asset($article->image) }}" alt="{{ $title }}"
                data-aos="fade-up">
            <div class="flex items-center justify-between flex-wrap gap-4 mb-12 border-b pb-10 border-zinc-400/60 dark:border-zinc-700"
                data-aos="fade-up">
                <div class="flex items-center gap-4 flex-wrap">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-14 ">
                        <path fill-rule="evenodd"
                            d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                            clip-rule="evenodd" />
                    </svg>
                    <div>
                        <p class="text-lg font-semibold capitalize">
                            {{ $article->author ? $article->author : 'Admin' }}</p>
                        <span class="text-zinc-500 font-medium text-sm">Admin Kominfo</span>
                    </div>
                </div>
                <div class="flex items-center gap-4 flex-wrap">
                    <button
                        class="py-2 px-4 h-10 flex items-center justify-center gap-2 rounded-full border border-zinc-200 dark:border-zinc-700 shadow hover:bg-navy dark:hover:bg-navy2 hover:text-white focus:ring focus:ring-navy transition duration-200 text-zinc-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                            <path
                                d="M5.25 12a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H6a.75.75 0 0 1-.75-.75V12ZM6 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H6ZM7.25 12a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H8a.75.75 0 0 1-.75-.75V12ZM8 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H8ZM9.25 10a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H10a.75.75 0 0 1-.75-.75V10ZM10 11.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V12a.75.75 0 0 0-.75-.75H10ZM9.25 14a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H10a.75.75 0 0 1-.75-.75V14ZM12 9.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V10a.75.75 0 0 0-.75-.75H12ZM11.25 12a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H12a.75.75 0 0 1-.75-.75V12ZM12 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H12ZM13.25 10a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H14a.75.75 0 0 1-.75-.75V10ZM14 11.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V12a.75.75 0 0 0-.75-.75H14Z" />
                            <path fill-rule="evenodd"
                                d="M5.75 2a.75.75 0 0 1 .75.75V4h7V2.75a.75.75 0 0 1 1.5 0V4h.25A2.75 2.75 0 0 1 18 6.75v8.5A2.75 2.75 0 0 1 15.25 18H4.75A2.75 2.75 0 0 1 2 15.25v-8.5A2.75 2.75 0 0 1 4.75 4H5V2.75A.75.75 0 0 1 5.75 2Zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm font-semibold"> {{ $article->created_at->format('d F Y') }}</span>
                    </button>
                    <button
                        class="py-2 px-4 h-10 flex items-center justify-center gap-2 rounded-full border border-zinc-200 dark:border-zinc-700 shadow hover:bg-navy dark:hover:bg-navy2 hover:text-white focus:ring focus:ring-navy transition duration-200 text-zinc-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                            <path d="M10 12.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                            <path fill-rule="evenodd"
                                d="M.664 10.59a1.651 1.651 0 0 1 0-1.186A10.004 10.004 0 0 1 10 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0 1 10 17c-4.257 0-7.893-2.66-9.336-6.41ZM14 10a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm font-semibold">{{ $article->views }}</span>
                    </button>
                    <button id="copyLinkButton"
                        class="py-2 px-4 h-10 flex items-center justify-center gap-2 rounded-full border border-zinc-200 dark:border-zinc-700 shadow hover:bg-navy dark:hover:bg-navy2 hover:text-white focus:ring focus:ring-navy transition duration-200 text-zinc-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                            <path
                                d="M7 3.5A1.5 1.5 0 0 1 8.5 2h3.879a1.5 1.5 0 0 1 1.06.44l3.122 3.12A1.5 1.5 0 0 1 17 6.622V12.5a1.5 1.5 0 0 1-1.5 1.5h-1v-3.379a3 3 0 0 0-.879-2.121L10.5 5.379A3 3 0 0 0 8.379 4.5H7v-1Z" />
                            <path
                                d="M4.5 6A1.5 1.5 0 0 0 3 7.5v9A1.5 1.5 0 0 0 4.5 18h7a1.5 1.5 0 0 0 1.5-1.5v-5.879a1.5 1.5 0 0 0-.44-1.06L9.44 6.439A1.5 1.5 0 0 0 8.378 6H4.5Z" />
                        </svg>
                        <span id="copyLinkText" class="text-sm font-semibold">Copy link</span>
                    </button>
                </div>
            </div>

            <div class="mt-10 artikel-body font-medium max-w-7xl mx-auto" data-aos="fade-up">
                {!! $article->body !!}
            </div>

            <div class="mt-14 lg:mt-20" data-aos="fade-up">
                <div class="sm:flex sm:items-center sm:justify-between sm:-mx-4 gap-4 md:gap-8 space-y-5 sm:space-y-0">
                    @if ($previousArticle)
                        <div class="inline-flex w-full items-center gap-3 p-5 h-28 sm:h-auto bg-cover relative text-white before:absolute before:inset-0 before:bg-black/70 rounded-2xl overflow-hidden before:-z-10 z-10 sm:!bg-none sm:before:bg-transparent sm:text-zinc-800 max-w-xl"
                            style="background-image: url({{ asset($previousArticle->image) }})">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor"
                                class="size-5 shrink-0 sm:text-zinc-800 dark:sm:text-zinc-200">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 19.5 8.25 12l7.5-7.5" />
                            </svg>
                            <a href="{{ route('showArticle', $previousArticle->slug) }}"
                                class="capitalize text-xl font-semibold font-plusjakartasans line-clamp-2 hover:text-navy dark:hover:text-navylight dark:text-zinc-200"
                                wire:navigate>
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
                        <div class="inline-flex w-full  justify-end items-center gap-3 p-5 h-28 sm:h-auto bg-cover relative text-white before:absolute before:inset-0 before:bg-black/70 rounded-2xl overflow-hidden before:-z-10 z-10 sm:!bg-none sm:before:bg-transparent sm:text-zinc-800 max-w-xl"
                            style="background-image: url({{ asset($nextArticle->image) }})">
                            <a href="{{ route('showArticle', $nextArticle->slug) }}"
                                class="capitalize text-xl font-semibold font-plusjakartasans line-clamp-2 hover:text-navy dark:hover:text-navylight dark:text-zinc-200 text-right"
                                wire:navigate>
                                {{ $nextArticle->title }}
                            </a>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor"
                                class="size-5 shrink-0 sm:text-zinc-800 dark:sm:text-zinc-200">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                        </div>
                    @else
                    @endif
                </div>
            </div>


            <div class="mt-14 lg:mt-20" data-aos="fade-up">
                <h1 class="text-2xl md:text-3xl font-bold font-plusjakartasans mb-4">Kategori
                    {{ $article->category->category }} Lainnya</h1>
                <div class="flex flex-wrap -mx-4">
                    @foreach ($articleByCategory as $article)
                        @php
                            $text = strip_tags($article->body);
                            $words = explode(' ', $text);
                            $limitedWords = array_slice($words, 0, 30);
                            $limitedText = implode(' ', $limitedWords);
                        @endphp

                        <x-article-card :image="$article->image" :created_at="$article->created_at->format('d M Y')" :categorySlug="$article->category->slug" :categoryName="$article->category->category"
                            :slug="$article->slug" :title="$article->title" :excerpt="$limitedText" :bodyText="$article->body" :views="$article->views" />
                    @endforeach
                </div>
            </div>
        </div>
    </article>

    @push('scripts')
        <script>
            document.getElementById('copyLinkButton').addEventListener('click', function() {
                // Mendapatkan URL artikel saat ini
                var currentUrl = window.location.href;

                // Menyalin URL ke clipboard
                navigator.clipboard.writeText(currentUrl).then(function() {
                    // Mengubah teks menjadi 'Link Copied'
                    var copyLinkText = document.getElementById('copyLinkText');
                    copyLinkText.textContent = 'Link Copied';

                    // Mengembalikan teks ke 'Copy link' setelah 3 detik
                    setTimeout(function() {
                        copyLinkText.textContent = 'Copy link';
                    }, 3000);
                }).catch(function(error) {
                    console.error('Error copying text: ', error);
                });
            });
        </script>
    @endpush
</x-main-layout>
