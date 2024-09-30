<div>
    @if (count($images) == 0)
        <div class="text-center text-sm px-5 text-neutral-500">Belum ada foto</div>
    @else
        <div class="mb-10 lg:mb-20">
            <div class="container mx-auto px-5">
                <div>
                    <select wire:model.live="selectedYear" class="ml-auto form-input !w-full max-w-32">
                        @foreach ($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <h1
                class="title uppercase text-center relative before:absolute before:w-full before:h-px before:content-[''] before:bg-zinc-300 before:left-0 before:top-1/2 before:-translate-y-1/2 before:z-0 dark:before:bg-zinc-700">
                <span
                    class="bg-background dark:bg-zinc-950 dark:text-navy3 relative z-10 px-5">{{ $selectedYear }}</span>
            </h1>
        </div>

        <div class="container mx-auto px-5">
            <div class="sm:columns-2 lg:columns-3 gap-4 lg:gap-6">
                @foreach ($images as $image)
                    <img class="mb-4 lg:mb-6 rounded-3xl max-h-[800px] aspect-auto w-full object-cover object-center"
                        src="{{ asset($image->image) }}" alt="Dokumentasi Proker {{ $image->proker->nama }}">
                @endforeach
            </div>
        </div>

        @if ($hasMorePages)
            <div wire:loading.class="opacity-75" class="flex justify-center mt-8">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        @endif
    @endif

    @push('scripts')
        <script>
            document.addEventListener('scroll', function() {
                let scrollHeight = document.documentElement.scrollHeight;
                let scrollTop = document.documentElement.scrollTop;
                let clientHeight = document.documentElement.clientHeight;

                if (scrollTop + clientHeight >= scrollHeight - 300) {
                    if (@this.hasMorePages) {
                        @this.call('loadMore');
                    }
                }
            });
        </script>
    @endpush
</div>
