<div>
    <div class="relative">
        <div class="columns-2 lg:columns-3 gap-4 mt-4 space-y-4">
            @foreach ($fotos as $i => $foto)
                <div>
                    <img src="{{ asset($foto->image) }}" alt="Foto {{ $i + 1 }}" class="w-full rounded-2xl" />
                </div>
            @endforeach
        </div>
        @if ($hasMorePages && !$infiniteScrollEnabled)
            <div class="absolute bottom-0 left-0 right-0 h-[300px] bg-gradient-to-t from-[#EBF0F9] dark:from-zinc-950">
            </div>
        @endif
    </div>


    @push('scripts')
        <script>
            document.addEventListener('scroll', function() {
                let scrollHeight = document.documentElement.scrollHeight;
                let scrollTop = document.documentElement.scrollTop;
                let clientHeight = document.documentElement.clientHeight;

                if (scrollTop + clientHeight >= scrollHeight - 100) {
                    if (@this.hasMorePages) {
                        @this.call('loadMore');
                    }
                }

            });
        </script>
    @endpush
</div>
