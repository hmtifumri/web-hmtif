<!-- Navigation Toggle -->
<div class="flex items-center justify-between mx-auto px-4 sm:px-6 lg:hidden py-4 mb-6 border-b">
    <img src="{{ asset('assets/img/logo.png') }}" class="w-16" alt="{{ config('app.name') }}">
    <button type="button" class="text-gray-500 hover:text-gray-600" data-hs-overlay="#docs-sidebar"
        aria-controls="docs-sidebar" aria-label="Toggle navigation">
        <span class="sr-only">Toggle Navigation</span>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-7">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M12 17.25h8.25" />
        </svg>
    </button>
</div>
<!-- End Navigation Toggle -->

<!-- Sidebar -->
<div id="docs-sidebar"
    class="hs-overlay [--auto-close:lg] hs-overlay-open:translate-x-0 -translate-x-full transition-all duration-300 transform hidden fixed top-0 start-0 bottom-0 z-[60] w-3/4 md:w-64 bg-white rounded-r-3xl border-e border-gray-200 pt-7 pb-10 overflow-y-auto lg:block lg:translate-x-0 lg:end-auto lg:bottom-0 [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-800 dark:border-neutral-700">
    <div class="px-6">
        <a class="flex-none" href="{{ route('home') }}" aria-label="Brand">
            <img src="{{ asset('assets/img/logo.png') }}" class="mx-auto w-16" alt="{{ config('app.name') }}">
        </a>
    </div>
    <nav class="hs-accordion-group p-6 w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
        <ul class="space-y-1.5">
            <li>
                <a class="{{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'hover:bg-gray-100' }} flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-700 rounded-lg  dark:bg-neutral-700 dark:text-white"
                    href="{{ route('dashboard') }}" wire:navigate>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    Dashboard
                </a>
            </li>

            @if (Auth::user()->jabatan == 'admin' || Auth::user()->divisi_id == 7)
                <li>
                    <a class="{{ request()->routeIs('dashboard.banner') ? 'bg-blue-600 text-white' : 'hover:bg-gray-100' }} flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-700 rounded-lg  dark:bg-neutral-700 dark:text-white"
                        href="{{ route('dashboard.banner') }}" wire:navigate>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>

                        Banner
                    </a>
                </li>
            @endif

            @if (Auth::user()->jabatan == 'admin')
                <li>
                    <a class="{{ request()->is('dashboard/periode*') ? 'bg-blue-600 text-white' : 'hover:bg-gray-100' }} flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-700 rounded-lg  dark:bg-neutral-700 dark:text-white"
                        href="{{ route('periode.dashboard') }}" wire:navigate>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                        </svg>
                        Periode
                    </a>
                </li>
            @endif
            @if (Auth::user()->jabatan == 'admin' || Auth::user()->divisi_id == 2 || Auth::user()->jabatan == "kadiv")
                <li>
                    <a class="{{ request()->routeIs('kepengurusan.dashboard') ? 'bg-blue-600 text-white' : 'hover:bg-gray-100' }} flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-700 rounded-lg  dark:bg-neutral-700 dark:text-white"
                        href="{{ route('kepengurusan.dashboard') }}" wire:navigate>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                        Kepengurusan
                    </a>
                </li>
            @endif
            @if (Auth::user()->jabatan == 'admin')
                <li>
                    <a class="{{ request()->routeIs('pengaturan.pendaftaran') ? 'bg-blue-600 text-white' : 'hover:bg-gray-100' }} flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-700 rounded-lg  dark:bg-neutral-700 dark:text-white"
                        href="{{ route('pengaturan.pendaftaran') }}" wire:navigate>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
                        </svg>
                        Pedaftaran
                    </a>
                </li>
            @else
                <li>
                    <a class="{{ request()->routeIs('user.edit') ? 'bg-blue-600 text-white' : 'hover:bg-gray-100' }} flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-700 rounded-lg  dark:bg-neutral-700 dark:text-white"
                        href="{{ route('user.edit', encrypt(Auth::user()->id)) }}" wire:navigate>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        Profile
                    </a>
                </li>
            @endif

            @if (Auth::user()->jabatan == 'admin' || Auth::user()->divisi_id == 7)
                <li class="hs-accordion {{ request()->is('dashboard/artikel*') || request()->is('dashboard/kategori*') ? 'active' : '' }}"
                    id="articles-accordion">
                    <button type="button"
                        class="hs-accordion-toggle hs-accordion-active:bg-blue-600 hs-accordion-active:text-white hs-accordion-active:hover:bg-blue-600 w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-300 dark:hs-accordion-active:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                        </svg>
                        Artikel

                        <svg class="hs-accordion-active:block ms-auto hidden size-4"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m18 15-6-6-6 6" />
                        </svg>

                        <svg class="hs-accordion-active:hidden ms-auto block size-4"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </button>

                    <div id="articles-accordion"
                        class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300  {{ request()->is('dashboard/artikel*') || request()->is('dashboard/kategori*') ? 'block' : 'hidden' }}">
                        <ul class="hs-accordion-group ps-3 pt-2" data-hs-accordion-always-open>
                            <li class="hs-accordion" id="articles-accordion-sub-1">
                                <a href="{{ route('dashboard.kategori') }}" wire:navigate
                                    class="hs-accordion-toggle {{ request()->is('dashboard/kategori*') ? 'bg-blue-600 text-white' : 'hover:bg-gray-100' }} flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-700 rounded-lg  dark:bg-neutral-700 dark:text-white">
                                    Kategori
                                </a>
                            </li>
                            <li class="hs-accordion" id="articles-accordion-sub-2">
                                <a href="{{ route('dashboard.artikel') }}" wire:navigate
                                    class="hs-accordion-toggle {{ request()->is('dashboard/artikel*') ? 'bg-blue-600 text-white' : 'hover:bg-gray-100' }} flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-700 rounded-lg  dark:bg-neutral-700 dark:text-white">
                                    Artikel
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif

        </ul>
    </nav>
</div>
<!-- End Sidebar -->
