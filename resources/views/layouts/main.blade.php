@include('templates.head')

@include('partials.navbar')

@persist('darkmode')
    <button type="button"
        class="hs-dark-mode-active:hidden hs-dark-mode group sm:flex items-center text-zinc-500 hover:text-zinc-700 font-medium dark:text-zinc-400 dark:hover:text-zinc-500 fixed z-50 top-8 right-8	hidden"
        data-hs-theme-click-value="dark">
        <div class="w-12 h-12 flex items-center justify-center rounded-full bg-zinc-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 16 16">
                <path fill="currentColor" fill-rule="evenodd"
                    d="M8 13.5a5.5 5.5 0 0 0 2.263-10.514a5.5 5.5 0 0 1-7.278 7.278A5.501 5.501 0 0 0 8 13.5M1.045 8.795a7.001 7.001 0 1 0 7.75-7.75l-.028-.003A7.078 7.078 0 0 0 8 1c-.527 0-.59.842-.185 1.18a4.02 4.02 0 0 1 .342.322A4 4 0 1 1 2.18 7.814C1.842 7.41 1 7.474 1 8a7.078 7.078 0 0 0 .045.794Z"
                    clip-rule="evenodd" />
            </svg>
        </div>
    </button>
    <button type="button"
        class="sm:hs-dark-mode-active:block hs-dark-mode group  items-center text-zinc-600 font-medium dark:text-zinc-400 dark:hover:text-zinc-200 fixed z-50 top-8 right-8	hidden"
        data-hs-theme-click-value="light">
        <div class="w-12 h-12 flex items-center justify-center rounded-full bg-zinc-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 16 16">
                <path fill="currentColor" fill-rule="evenodd"
                    d="M8 3a.75.75 0 0 1-.75-.75V.75a.75.75 0 1 1 1.5 0v1.5A.75.75 0 0 1 8 3m0 7.5a2.5 2.5 0 1 0 0-5a2.5 2.5 0 0 0 0 5M8 12a4 4 0 1 0 0-8a4 4 0 0 0 0 8m-.75 3.25a.75.75 0 0 0 1.5 0v-1.5a.75.75 0 0 0-1.5 0zM13 8a.75.75 0 0 1 .75-.75h1.5a.75.75 0 0 1 0 1.5h-1.5A.75.75 0 0 1 13 8M.75 7.25a.75.75 0 1 0 0 1.5h1.5a.75.75 0 0 0 0-1.5zm10.786-2.786a.75.75 0 0 1 0-1.06l1.06-1.06a.75.75 0 0 1 1.06 1.06l-1.06 1.06a.75.75 0 0 1-1.06 0m-9.193 8.132a.75.75 0 0 0 1.06 1.06l1.062-1.06a.75.75 0 0 0-1.061-1.06zm9.193-1.06a.75.75 0 0 1 1.06 0l1.06 1.06a.75.75 0 0 1-1.06 1.06l-1.06-1.06a.75.75 0 0 1 0-1.06M3.404 2.343a.75.75 0 0 0-1.06 1.06l1.06 1.061a.75.75 0 1 0 1.06-1.06l-1.06-1.06Z"
                    clip-rule="evenodd" />
            </svg>
        </div>
    </button>
@endpersist

<main>
    {{ $slot }}
</main>

@include('partials.footer')

@include('templates.foot')
