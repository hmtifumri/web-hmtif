<x-main-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    <section class="pb-10 lg:pb-20 lg:pt-14">
        <div class="container px-5 mx-auto">
            <h1 class="title uppercase text-center mx-auto max-w-3xl">{{ $title }}</h1>
            <div class="mt-8 mb-14">
                @php
                    $image = App\Models\DivisiImage::where('divisi_id', $divisi->id)
                        ->where('periode_id', $periode->id)
                        ->pluck('image')
                        ->first();
                @endphp
                <img class="w-full rounded-3xl" src="{{ asset($image) }}" alt="">
            </div>
            <div class="flex flex-wrap items-center justify-center -mx-5 lg:-mx-10 mb-10">
                @foreach (['kadiv', 'stafsus'] as $role)
                    @if ($users->where('jabatan', $role)->isNotEmpty())              
                            @foreach ($users->where('jabatan', $role) as $user)
                                <div class="w-full md:w-1/2 lg:w-1/3 px-5 lg:px-10 group p-4">
                                    <div class="relative overflow-hidden rounded-3xl">
                                        <img src="{{ asset($user->gambar) }}" class="w-full group-hover:scale-110 duration-500 ease-in-out" alt="">
                                        <div
                                            class="absolute inset-0 group-hover:bg-zinc-900/60 dark:group-hover:bg-zinc-950/70 group-hover:backdrop-blur-sm duration-500 ease-in-out">
                                            <div
                                                class="absolute top-full -translate-y-16 2xl:-translate-y-20 left-1/2 -translate-x-1/2 group-hover:top-1/2 w-full group-hover:-translate-y-1/2 duration-500 ease-in-out">
                                                <div class="text-center">
                                                    <h3
                                                        class="text-2xl 2xl:text-3xl text-white font-semibold font-plusjakartasans">
                                                        {{ $user->name }}
                                                        <span class="text-sm block font-medium mt-1 opacity-0 group-hover:opacity-100 duration-500 ease-in-out">
                                                            {{ $user->nim }}
                                                        </span>
                                                    </h3>
                                                    <p class="text-white capitalize -mt-6 group-hover:mt-2 duration-500 ease-in-out">
                                                        @switch(strtolower($user->jabatan))
                                                            @case('kadiv')
                                                                ~ Kepala Divisi ~
                                                                @break
                                                            @case('stafsus')
                                                                ~ Staf Khusus ~
                                                                @break
                                                            @default
                                                               ~ {{ ucwords(str_replace('_', ' ', $user->jabatan)) }} ~
                                                        @endswitch
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        
                    @endif
                @endforeach
            </div>

            <div class="flex flex-wrap items-center justify-center -mx-5 lg:-mx-10 mb-10">
                @foreach (['anggota'] as $role)
                    @if ($users->where('jabatan', $role)->isNotEmpty())              
                            @foreach ($users->where('jabatan', $role) as $user)
                                <div class="w-full md:w-1/2 lg:w-1/3 px-5 lg:px-10 group p-4">
                                    <div class="relative overflow-hidden rounded-3xl">
                                        <img src="{{ asset($user->gambar) }}" class="w-full group-hover:scale-110 duration-500 ease-in-out" alt="">
                                        <div
                                            class="absolute inset-0 group-hover:bg-zinc-900/60 dark:group-hover:bg-zinc-950/70 group-hover:backdrop-blur-sm duration-500 ease-in-out">
                                            <div
                                                class="absolute top-full -translate-y-16 2xl:-translate-y-20 left-1/2 -translate-x-1/2 group-hover:top-1/2 w-full group-hover:-translate-y-1/2 duration-500 ease-in-out">
                                                <div class="text-center">
                                                    <h3
                                                        class="text-2xl 2xl:text-3xl text-white font-semibold font-plusjakartasans">
                                                        {{ $user->name }}
                                                        <span class="text-sm block font-medium mt-1 opacity-0 group-hover:opacity-100 duration-500 ease-in-out">
                                                            {{ $user->nim }}
                                                        </span>
                                                    </h3>
                                                    <p class="text-white capitalize -mt-6 group-hover:mt-2 duration-500 ease-in-out">
                                                        @switch(strtolower($user->jabatan))
                                                            @case('kadiv')
                                                                ~ Kepala Divisi ~
                                                                @break
                                                            @case('stafsus')
                                                                ~ Staf Khusus ~
                                                                @break
                                                            @default
                                                               ~ {{ ucwords(str_replace('_', ' ', $user->jabatan)) }} ~
                                                        @endswitch
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        
                    @endif
                @endforeach
            </div>

            <div class="flex flex-wrap items-center justify-center -mx-5 lg:-mx-10 mb-10">
                @foreach (['magang'] as $role)
                    @if ($users->where('jabatan', $role)->isNotEmpty())              
                            @foreach ($users->where('jabatan', $role) as $user)
                                <div class="w-full md:w-1/2 lg:w-1/3 px-5 lg:px-10 group p-4">
                                    <div class="relative overflow-hidden rounded-3xl">
                                        <img src="{{ asset($user->gambar) }}" class="w-full group-hover:scale-110 duration-500 ease-in-out" alt="">
                                        <div
                                            class="absolute inset-0 group-hover:bg-zinc-900/60 dark:group-hover:bg-zinc-950/70 group-hover:backdrop-blur-sm duration-500 ease-in-out">
                                            <div
                                                class="absolute top-full -translate-y-16 2xl:-translate-y-20 left-1/2 -translate-x-1/2 group-hover:top-1/2 w-full group-hover:-translate-y-1/2 duration-500 ease-in-out">
                                                <div class="text-center">
                                                    <h3
                                                        class="text-2xl 2xl:text-3xl text-white font-semibold font-plusjakartasans">
                                                        {{ $user->name }}
                                                        <span class="text-sm block font-medium mt-1 opacity-0 group-hover:opacity-100 duration-500 ease-in-out">
                                                            {{ $user->nim }}
                                                        </span>
                                                    </h3>
                                                    <p class="text-white capitalize -mt-6 group-hover:mt-2 duration-500 ease-in-out">
                                                        @switch(strtolower($user->jabatan))
                                                            @case('kadiv')
                                                                ~ Kepala Divisi ~
                                                                @break
                                                            @case('stafsus')
                                                                ~ Staf Khusus ~
                                                                @break
                                                            @default
                                                               ~ {{ ucwords(str_replace('_', ' ', $user->jabatan)) }} ~
                                                        @endswitch
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        
                    @endif
                @endforeach
            </div>
        </div>
    </section>
</x-main-layout>