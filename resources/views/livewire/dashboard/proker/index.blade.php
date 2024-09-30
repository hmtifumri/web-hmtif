<div>
    @include('components.alert')
    
    <div class="w-full overflow-x-auto ">
        <div class=" min-w-max mb-4">
            <table class="divide-y divide-gray-300 table">
                <thead>
                    <tr>
                        <th scope="col">
                            Gambar
                        </th>
                        <th scope="col">
                            Nama Proker
                        </th>
                        <th scope="col">
                            Divisi
                        </th>
                        <th scope="col">
                            Dilaksanakan pada
                        </th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proker as $i => $p)
                        <tr>
                            <td>
                                <img src="{{ asset($p->gambar) }}" class="max-w-32 border rounded-lg"
                                    alt="{{ $p->nama }}" loading="lazy">
                            </td>
                            <td>
                                <p class="max-w-xs w-full line-clamp-2">
                                    {{ $p->nama }}
                                </p>
                            </td>
                            <td>
                                <p
                                    class="capitalize bg-teal-100 text-teal-800 text-xs py-1 px-3 rounded-full inline-block">
                                    {{ $p->divisi_id == null ? 'Semua Divisi' : str_replace('-', ' ', $p->divisi->singkatan) }}
                                </p>
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($p->tanggal_mulai)->format('d/m/Y') }}
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
                                        <a target="_blank"
                                            class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                                            href="{{ route('detail.proker', [$periode, ($p->divisi_id == null) ? 'semua-divisi' : $p->divisi->singkatan , $p->slug]) }}">
                                            Detail
                                        </a>
                                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                                            href="{{ route('edit.proker', [$periode, $p->slug]) }}" wire:navigate>
                                            Edit
                                        </a>
                                        <button
                                            class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm hover:bg-gray-100 focus:outline-none text-red-800 w-full"
                                            wire:click="delete({{ $p->id }})"
                                            wire:confirm.prompt='Kamu yakin?\n\nKetik "HAPUS" untuk mengapus artikel ini. Artikel yang di hapus tidak dapat dikembalikan|HAPUS'>
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
