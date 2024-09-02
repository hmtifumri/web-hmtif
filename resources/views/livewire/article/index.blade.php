<div>
        @if($articles->count() > 0)
        <div class="mb-10 flex items-center justify-end">
            <select wire:model.live="sortBy" class="ml-3 form-input !w-auto">
                <option value="latest">Terbaru</option>
                <option value="oldest">Terlama</option>
            </select>
            <select wire:model.live="sortByYear" class="ml-3 form-input !w-auto">
                <option value="all">Semua</option>
                @foreach ($years as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
        </div>
        @endif
    <div>
        @empty($articles->count())
            <div class="text-center text-sm text-neutral-500">Belum ada artikel</div>
        @endempty
        @foreach ($articles as $article)
            <div
                class="flex mb-14 flex-wrap items-center -mx-5 group hover:bg-[#BED9FF] dark:hover:bg-navy/90 rounded-3xl hover:p-6 duration-500 ease-in-out">
                <div class="w-full lg:w-[60%] px-5">
                    <div
                        class="text-sm text-zinc-400 dark:text-zinc-500 dark:group-hover:text-navylight duration-500 group-hover:text-[#395682]">
                        <p>{{ $article->created_at->format('d F Y') }} / <a
                                href="{{ route('artikelByKategori', $article->category->slug) }}" wire:navigate
                                class="hover:underline">{{ $article->category->category }}</a></p>
                        <div class="mt-5 mb-9">
                            <h2
                                class="text-[#030303] dark:text-zinc-300 font-plusjakartasans  text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold line-clamp-2 capitalize">
                                {{ $article->title }}
                            </h2>
                            <p class="mt-4 lg:hidden line-clamp-2">
                                @php
                                    $text = strip_tags($article->body);
                                    $words = explode(' ', $text);
                                    $limitedWords = array_slice($words, 0, 100);
                                    $limitedText = implode(' ', $limitedWords);
                                @endphp

                                {{ $limitedText }}{{ strlen($text) > strlen($limitedText) ? '...' : '' }}
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('showArticle', $article->slug) }}" wire:navigate
                                class="inline-flex items-center gap-3 text-navy2 dark:text-navylight group relative">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5 text-white dark:text-zinc-200 group-hover:text-white duration-300 z-10 ml-[10px]"
                                    viewBox="0 0 16 16">
                                    <path fill="currentColor" fill-rule="evenodd"
                                        d="M5.47 13.03a.75.75 0 0 1 0-1.06L9.44 8L5.47 4.03a.75.75 0 0 1 1.06-1.06l4.5 4.5a.75.75 0 0 1 0 1.06l-4.5 4.5a.75.75 0 0 1-1.06 0"
                                        clip-rule="evenodd" />
                                </svg>
                                <span
                                    class="ml-3 relative z-10 pr-[12px] group-hover:text-white duration-500 ease-in-out delay-75 group-hover:ml-0 font-semibold">Read
                                    More</span>
                                <div
                                    class="w-10 h-10 flex items-center duration-500 ease-in-out justify-center bg-gradient-to-br from-[#496fa8] dark:from-[#24395e] dark:to-[#1c2c47] to-[#395682]  rounded-full group-hover:w-full absolute left-0 z-0">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-[40%] px-5 text-zinc-500 dark:text-zinc-400  hidden lg:block">
                    <p class="line-clamp-2">
                        {{ $limitedText }}{{ strlen($text) > strlen($limitedText) ? '...' : '' }}
                    </p>

                </div>
            </div>
        @endforeach

        {{ $articles->links('vendor.livewire.tailwind') }}
    </div>
</div>
