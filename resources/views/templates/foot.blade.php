{{-- <script src="{{ asset('preline/dist/preline.js') }}"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
<script
    src="https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.5.3/dist/js/splide-extension-auto-scroll.min.js">
</script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/gh/yesiamrocks/cssanimation.io@1.0.3/letteranimation.min.js"></script> --}}

<script>
    AOS.init({
        once: false,
        duration: 800,
        offset: 80,
    });
</script>
@stack('scripts')
@livewireScripts
</body>

</html>
