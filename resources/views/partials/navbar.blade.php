{{-- <nav class="container max-w-7xl mx-auto px-5 pt-12">
    <div>
        <img src="{{ asset('assets/img/logo.png') }}" class="mx-auto w-28 " alt="Logo HM-TIF">
    </div>

    
    <div class="mt-8">
        <ul class="flex items-center justify-center bg-[#4B6EA1]/15 max-w-max py-2 px-4 mx-auto rounded-xl">
            <li class="py-2 px-1">
                <a class="{{ request()->routeIs('home') ? 'bg-navy text-white' : 'text-navy hover:bg-navy hover:text-white' }}  duration-200 px-4 rounded-[8px] py-2"
                    href="">Beranda</a>
            </li>
            <li class="py-2 px-1">
                <a class="hover:bg-navy duration-200 px-4 rounded-[8px] text-navy hover:text-white py-2"
                    href="">Profil</a>
            </li>
            <div class="hs-dropdown relative inline-flex [--trigger:hover] group">
                <button id="hs-dropdown-transform-style" type="button"
                    class="hs-dropdown-toggle inline-flex items-center gap-x-2 group-hover:bg-navy group-hover:text-white duration-200 px-4 rounded-[8px] text-navy hover:text-white py-2">
                    Kepengurusan
                    <svg class="hs-dropdown-open:rotate-180 size-4 transition-transform" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="m6 9 6 6 6-6" />
                    </svg>
                </button>

                <div
                    class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden z-10">
                    <div class="hs-dropdown-open:ease-in hs-dropdown-open:opacity-100 hs-dropdown-open:scale-100 transition ease-out opacity-0 -mt-2 scale-95 duration-200 origin-top-left min-w-60 bg-navy shadow-md rounded-lg p-2"
                        aria-labelledby="hs-dropdown-transform-style" data-hs-transition>
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-white hover:bg-[#476da5] duration-300 focus:outline-none "
                            href="#">
                            2023 - 2024
                        </a>
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-white hover:bg-[#476da5] duration-300 focus:outline-none "
                            href="#">
                            2022 - 2023
                        </a>
                    </div>
                </div>
            </div>
            <li class="py-2 px-1">
                <a class="hover:bg-navy duration-200 px-4 rounded-[8px] text-navy hover:text-white py-2"
                    href="">Galeri</a>
            </li>
            <li class="py-2 px-1">
                <a class="hover:bg-navy duration-200 px-4 rounded-[8px] text-navy hover:text-white py-2"
                    href="">Artikel</a>
            </li>
        </ul>
    </div>
</nav> --}}

<div class="pt-8 lg:pt-12 mb-6 hidden sm:block">
    <img src="{{ asset('assets/img/logo.png') }}" class="mx-auto w-28 " alt="Logo HM-TIF">
</div>

<header
    class="flex flex-wrap sm:justify-start sm:flex-nowrap bg-white rounded-b-3xl sm:bg-transparent sm:rounded-b-none z-50 w-full py-4 mb-6 sm:mb-0 dark:bg-zinc-800 sm:dark:bg-transparent">
    <nav class="max-w-7xl w-full mx-auto px-4 sm:flex sm:items-center sm:justify-between" aria-label="Global">
        <div class="flex items-center justify-between">
            <div>
                <button type="button"
                    class="hs-dark-mode-active:hidden hs-dark-mode group flex items-center text-zinc-500 hover:text-zinc-700 font-medium dark:text-zinc-400 dark:hover:text-zinc-500 sm:hidden"
                    data-hs-theme-click-value="dark">
                    <div class="w-10 h-10 flex items-center justify-center rounded-full bg-zinc-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 16 16">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M8 13.5a5.5 5.5 0 0 0 2.263-10.514a5.5 5.5 0 0 1-7.278 7.278A5.501 5.501 0 0 0 8 13.5M1.045 8.795a7.001 7.001 0 1 0 7.75-7.75l-.028-.003A7.078 7.078 0 0 0 8 1c-.527 0-.59.842-.185 1.18a4.02 4.02 0 0 1 .342.322A4 4 0 1 1 2.18 7.814C1.842 7.41 1 7.474 1 8a7.078 7.078 0 0 0 .045.794Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
                <button type="button"
                    class="hs-dark-mode-active:block sm:hs-dark-mode-active:hidden hs-dark-mode group  items-center text-zinc-600 font-medium dark:text-zinc-400 dark:hover:text-zinc-200	hidden"
                    data-hs-theme-click-value="light">
                    <div class="w-10 h-10 flex items-center justify-center rounded-full bg-zinc-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 16 16">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M8 3a.75.75 0 0 1-.75-.75V.75a.75.75 0 1 1 1.5 0v1.5A.75.75 0 0 1 8 3m0 7.5a2.5 2.5 0 1 0 0-5a2.5 2.5 0 0 0 0 5M8 12a4 4 0 1 0 0-8a4 4 0 0 0 0 8m-.75 3.25a.75.75 0 0 0 1.5 0v-1.5a.75.75 0 0 0-1.5 0zM13 8a.75.75 0 0 1 .75-.75h1.5a.75.75 0 0 1 0 1.5h-1.5A.75.75 0 0 1 13 8M.75 7.25a.75.75 0 1 0 0 1.5h1.5a.75.75 0 0 0 0-1.5zm10.786-2.786a.75.75 0 0 1 0-1.06l1.06-1.06a.75.75 0 0 1 1.06 1.06l-1.06 1.06a.75.75 0 0 1-1.06 0m-9.193 8.132a.75.75 0 0 0 1.06 1.06l1.062-1.06a.75.75 0 0 0-1.061-1.06zm9.193-1.06a.75.75 0 0 1 1.06 0l1.06 1.06a.75.75 0 0 1-1.06 1.06l-1.06-1.06a.75.75 0 0 1 0-1.06M3.404 2.343a.75.75 0 0 0-1.06 1.06l1.06 1.061a.75.75 0 1 0 1.06-1.06l-1.06-1.06Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </div>
            <a class="flex-none text-xl font-semibold dark:text-white sm:hidden" href="#">
                <img src="{{ asset('assets/img/logo.png') }}" class="mx-auto w-14 " alt="Logo {{ config('app.name') }}">
            </a>
            <div class="sm:hidden">
                <button type="button"
                    class="hs-collapse-toggle !w-8 !h-8 !inline-flex justify-center items-center gap-x-2 rounded-lg border border-zinc-200 bg-white text-zinc-800 shadow-sm dark:bg-zinc-800 dark:text-zinc-200 dark:border-zinc-700 hover:bg-zinc-50 disabled:opacity-50 disabled:pointer-events-none"
                    data-hs-collapse="#navbar" aria-controls="navbar" aria-label="Toggle navigation">
                    <svg class="hs-collapse-open:hidden flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" x2="21" y1="6" y2="6" />
                        <line x1="3" x2="21" y1="12" y2="12" />
                        <line x1="3" x2="21" y1="18" y2="18" />
                    </svg>
                    <svg class="hs-collapse-open:block hidden flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                </button>
            </div>
        </div>
        <div id="navbar"
            class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow sm:block">
            <div
                class="flex flex-col gap-6 mt-5 sm:flex-row sm:items-center justify-end sm:justify-center sm:mt-0 sm:ps-5 pl-3 pb-4">
                <a class="{{ request()->routeIs('home') ? 'text-navy2 dark:text-navy3 sm:border-b-2 sm:border-navy2 font-semibold' : 'font-medium text-zinc-600 dark:text-zinc-400 hover:text-navy2 dark:hover:text-navy2 ' }}"
                    href="{{ route('home') }}" wire:navigate.hover aria-current="page">Beranda</a>
                <a class="{{ request()->routeIs('profil') ? 'text-navy2 dark:text-navy3 sm:border-b-2 sm:border-navy2 font-semibold' : 'font-medium text-zinc-600 dark:text-zinc-400 hover:text-navy2 dark:hover:text-navy2 ' }}"
                    href="{{ route('profil') }}" wire:navigate.hover>Profil</a>
                <a class="{{ request()->routeIs('kepengurusan') ? 'text-navy2 dark:text-navy3 sm:border-b-2 sm:border-navy2 font-semibold' : 'font-medium text-zinc-600 dark:text-zinc-400 hover:text-navy2 dark:hover:text-navy2 ' }}"
                    href="{{ route('kepengurusan') }}" wire:navigate.hover>Kepengurusan</a>
                <a class="{{ request()->routeIs('galeri') ? 'text-navy2 dark:text-navy3 sm:border-b-2 sm:border-navy2 font-semibold' : 'font-medium text-zinc-600 dark:text-zinc-400 hover:text-navy2 dark:hover:text-navy2 ' }}"
                    href="{{ route('galeri') }}" wire:navigate.hover>Galeri</a>
                <a class="{{ request()->routeIs('artikel') ? 'text-navy2 dark:text-navy3 sm:border-b-2 sm:border-navy2 font-semibold' : 'font-medium text-zinc-600 dark:text-zinc-400 hover:text-navy2 dark:hover:text-navy2 ' }}"
                    href="{{ route('artikel') }}" wire:navigate.hover>Artikel</a>
            </div>
        </div>
    </nav>
</header>
