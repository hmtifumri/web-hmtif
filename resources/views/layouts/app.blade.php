<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    @stack('styles')
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-[#F5F7F8]">
        @include('dashboard.partials.sidebar')

        <main class="lg:ml-64">
            <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
                <div class="flex items-center justify-between flex-wrap mb-8">
                    <div class="text-sm text-gray-400 font-medium">
                        Dashboard / <span class="text-black">{{ $title ?? '' }}</span>
                        <span class="block text-black mt-1 font-semibold text-base">{{ $title ?? '' }}</span>
                    </div>
                    <div>
                        <div class="hs-dropdown relative inline-flex">
                            <button id="hs-dropdown-transform-style" type="button"
                                class="hs-dropdown-toggle inline-flex items-center gap-2 font-semibold text-sm">
                                Halo, {{ Auth::user()->name }}
                                <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </button>

                            <div
                                class="hs-dropdown-menu w-56 transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden z-10">
                                <div class="hs-dropdown-open:ease-in hs-dropdown-open:opacity-100 hs-dropdown-open:scale-100 transition ease-out opacity-0 scale-95 duration-200 mt-2 origin-top-right min-w-40 bg-white shadow-md rounded-lg p-2"
                                    aria-labelledby="hs-dropdown-transform-style" data-hs-transition>
                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                                        href="{{ route('logout') }}">
                                        Logout
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{ $slot }}
            </div>
        </main>
    </div>


    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init({
        once: true,
        duration: 800
      });
    </script>
    @stack('scripts')
    @livewireScripts
</body>

</html>
