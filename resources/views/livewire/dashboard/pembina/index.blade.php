<tbody class="divide-y divide-gray-200">
    @foreach ($pembina as $i => $item)
        <tr class="hover:bg-gray-200">
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                <img src="{{ asset($item->image) }}" alt="{{ $item->nama }}" class="w-10 h-10 object-cover rounded-full"
                    loading="lazy">
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                {{ $item->nama }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                {{ \Carbon\Carbon::parse($item->mulai)->format('d/m/Y') . ' - ' . ($item->selesai ? \Carbon\Carbon::parse($item->selesai)->format('d/m/Y') : 'sekarang') }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                <div
                    class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium {{ $item->status == 1 ? 'bg-teal-100 text-teal-800' : 'bg-red-100 text-red-800' }}">
                    {{ $item->status == 1 ? 'Aktif' : 'Tidak Aktif' }}
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                <div class="hs-dropdown [--placement:bottom-right] relative inline-flex">
                    <button id="action-dropdown" type="button"
                        class="hs-dropdown-toggle p-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                        </svg>
                    </button>

                    <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 bg-white shadow-md rounded-lg p-2 mt-2 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full z-20"
                        aria-labelledby="action-dropdown">
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                            href="{{ route('pembina.edit', [str_replace('/', '-', $item->periode->periode), Crypt::encrypt($item->id)]) }}">
                            Edit
                        </a>

                        <button
                            class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm hover:bg-gray-100 focus:outline-none text-red-800 w-full"
                            wire:click="delete({{ $item->id }})"
                            wire:confirm.prompt='Kamu yakin?\n\nKetik "HAPUS" untuk mengapus artikel ini. Artikel yang di hapus tidak dapat dikembalikan|HAPUS'>
                            Delete
                        </button>

                    </div>
                </div>
            </td>
        </tr>
    @endforeach

</tbody>
