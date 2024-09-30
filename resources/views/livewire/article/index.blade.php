<div>
    @if ($articles->count() > 0)
        <div class="mb-10 flex items-center justify-end">
            <select wire:model.live="sortBy" class="ml-3 form-input !w-auto">
                <option value="latest">Terbaru</option>
                <option value="oldest">Terlama</option>
                <option value="popular">Populer</option>
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
        <div class="flex flex-wrap -mx-4">
            @foreach ($articles as $article)
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

        {{ $articles->links('vendor.livewire.tailwind') }}
    </div>
</div>
