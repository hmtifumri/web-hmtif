<script src="{{ asset('js/splide.min.js') }}"></script>
<script
    src="https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.5.3/dist/js/splide-extension-auto-scroll.min.js">
</script>
<script src="{{ asset('js/aos.js') }}"></script>

@stack('scripts')
<script>
    document.addEventListener("livewire:navigated", function() {
        AOS.init({
            once: false,
            duration: 800,
        });

        const navbar = document.getElementById("navbar");
        const navbarContentContainer = navbar.querySelector(
            ".navbar-content-container"
        );

        window.addEventListener("scroll", function() {
            let currentScroll =
                window.pageYOffset || document.documentElement.scrollTop;

            if (currentScroll > 300) {
                navbarContentContainer.classList.add("navbar-scrolled");
            }

            if (currentScroll <= 350) {
                // When at the top, ensure the scrolled class is removed
                navbarContentContainer.classList.remove("navbar-scrolled");
            }
        });
    });
</script>

@livewireScripts
</body>

</html>
