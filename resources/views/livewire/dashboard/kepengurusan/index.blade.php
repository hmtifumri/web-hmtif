<div class="mt-8">
    <div class="flex items-center justify-between flex-wrap gap-3">
        <div class="inline-flex items-center gap-3">
            <h1 class="dashboard-title">Kepengurusan Tahun {{ $periode->periode }}</h1>
            <div class="animate-spin inline-block size-6 border-[3px] border-current border-t-transparent text-blue-600 rounded-full"
                role="status" aria-label="loading" wire:loading>
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div>
            <input type="text" class="form-input max-w-xs" wire:model.live='search' placeholder="Cari disini">
        </div>
    </div>

    <div class="flex flex-col mt-10 bg-white p-6 rounded-2xl shadow-lg shadow-gray-200/20"
        wire:loading.class="opacity-50">
        @if (count($pengurus) > 0)
            @foreach ($pengurus->groupBy('divisi_id') as $divisionId => $members)
                @php
                    $division = \App\Models\Divisi::find($divisionId);
                @endphp
                <div class="mb-6 last-of-type:mb-0 overflow-x-auto"
                    wire:key='{{ $divisionId }}'>
                    <div>
                        <div class="mb-2">
                            <h2 class="text-xl font-semibold capitalize">{{ $division->singkatan }}</h2>
                        </div>
                        <div class="p-1.5 min-w-full inline-block align-middle">
                            <div class="border rounded-lg border-gray-300 overflow-hidden">
                                @foreach ($members->groupBy('divisi_id') as $jabatan => $users)
                                    <div>
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead>
                                                <tr>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                        Nama</th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                        Jabatan</th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                        Nomor HP</th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                        Jenis Kelamin</th>
                                                    @if (Auth::user()->jabatan == 'admin')
                                                        <th scope="col"
                                                            class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">
                                                            Action</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200">
                                                @foreach ($users as $user)
                                                    <tr class="hover:bg-blue-100">
                                                        <td
                                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                                            {{ $user->name }}
                                                        </td>
                                                        <td
                                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 capitalize">
                                                            {{ str_replace('_', ' ', $user->jabatan) }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                            {{ $user->phone ?? '-' }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                            {{ $user->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                                        </td>
                                                        @if (Auth::user()->jabatan == 'admin')
                                                            <td
                                                                class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                                                <div class="inline-flex items-center gap-3">
                                                                    <div>
                                                                        <a href="{{ route('user.edit', encrypt($user->id)) }}"
                                                                            class="hover:underline text-teal-600">Edit</a>
                                                                    </div>
                                                                    <div>
                                                                        <button type="button"
                                                                            wire:click='hapus({{ $user->id }})'
                                                                            wire:confirm="Yakin ingin menghapus {{ $user->name }}?"
                                                                            class="hover:underline text-rose-600">Delete</button>
                                                                    </div>
                                                                </div>
                                                        @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div>
                <p class="text-center text-gray-500">Tidak ada data</p>
            </div>
        @endif
    </div>

</div>
