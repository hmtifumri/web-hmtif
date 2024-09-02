<div>
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
        <div class="max-w-xs mb-8 mx-auto">
            <input type="text" class="form-input" wire:model.live='search' placeholder="ketik sesuatu disini...">
        </div>

        <div class=" bg-white p-6 rounded-2xl shadow-lg shadow-gray-200/20">
            @empty($articles->count())
                <div class="text-center text-sm text-neutral-500">Belum ada artikel saat ini.</div>
            @else
                <div class="w-full overflow-x-auto ">
                    <div class=" min-w-max mb-4">
                        <table class="divide-y divide-gray-300 table">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        Image
                                    </th>
                                    <th scope="col">
                                        Judul
                                    </th>
                                    <th scope="col">
                                        Status
                                    </th>
                                    <th scope="col">
                                        Created At
                                    </th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($articles as $i => $article)
                                    <tr>
                                        <td>
                                            <img src="{{ asset($article->image) }}" alt="{{ $article->title }}"
                                                class="max-w-32 border rounded-lg">
                                        </td>
                                        <td>
                                            <a href=""
                                                class="hover:underline inline-block text-wrap line-clamp-2 max-w-sm capitalize">
                                                {{ $article->title }}
                                            </a>
                                        </td>
                                        <td>
                                            <button type="button" wire:click='setPublish({{ $article->id }})'
                                                class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium {{ $article->is_published ? 'bg-teal-100 text-teal-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $article->is_published ? 'Publish' : 'Draft' }}
                                            </button>
                                        </td>
                                        <td>
                                            <p>
                                                {{ $article->created_at->diffForHumans() }}
                                            </p>
                                        </td>
                                        <td>
                                            <div class="hs-dropdown [--placement:bottom-right] relative inline-flex">
                                                <button id="action-dropdown" type="button"
                                                    class="hs-dropdown-toggle p-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                                    </svg>
                                                </button>

                                                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 bg-white shadow-md rounded-lg p-2 mt-2 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full z-20"
                                                    aria-labelledby="action-dropdown">
                                                    <a target="_blank" class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                                                        href="{{ route('showArticle', $article->slug) }}">
                                                        Detail
                                                    </a>
                                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                                                        href="{{ route('dashboard.artikel.edit', $article->slug) }}"
                                                        wire:navigate>
                                                        Edit
                                                    </a>
                                                    @if (Auth::user()->jabatan == 'admin' || Auth::user()->divisi_id == 7)
                                                        <button
                                                            class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm hover:bg-gray-100 focus:outline-none text-red-800 w-full"
                                                            wire:click="delete({{ $article->id }})"
                                                            wire:confirm.prompt='Kamu yakin?\n\nKetik "HAPUS" untuk mengapus artikel ini. Artikel yang di hapus tidak dapat dikembalikan|HAPUS'>
                                                            Delete
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endempty

                {{ $articles->links() }}
            </div>
        </div>
    </div>

</div>
