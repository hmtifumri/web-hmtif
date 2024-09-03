import "./bootstrap";
import "preline";

document.addEventListener("livewire:navigated", function () {
    HSStaticMethods.autoInit();

    const navbar = document.getElementById('navbar');
            const navbarContentContainer = navbar.querySelector('.navbar-content-container');

            window.addEventListener('scroll', function() {
                let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

                if (currentScroll > 300) {
                    navbarContentContainer.classList.add('navbar-scrolled');
                }

                if (currentScroll <= 350) {
                    // When at the top, ensure the scrolled class is removed
                    navbarContentContainer.classList.remove('navbar-scrolled');
                }

                lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // Reset the last scroll position
            });

    // AOS.init({
    //     once: true,
    //     duration: 800
    // });
});




const HSThemeAppearance = {
    init() {
        const defaultTheme = "default";
        let theme = localStorage.getItem("hs_theme") || defaultTheme;

        if (document.querySelector("html").classList.contains("dark")) return;
        this.setAppearance(theme);
    },
    _resetStylesOnLoad() {
        const $resetStyles = document.createElement("style");
        $resetStyles.innerText = `*{transition: unset !important;}`;
        $resetStyles.setAttribute("data-hs-appearance-onload-styles", "");
        document.head.appendChild($resetStyles);
        return $resetStyles;
    },
    setAppearance(theme, saveInStore = true, dispatchEvent = true) {
        const $resetStylesEl = this._resetStylesOnLoad();

        if (saveInStore) {
            localStorage.setItem("hs_theme", theme);
        }

        if (theme === "auto") {
            theme = window.matchMedia("(prefers-color-scheme: dark)").matches
                ? "dark"
                : "default";
        }

        document.querySelector("html").classList.remove("dark");
        document.querySelector("html").classList.remove("default");
        document.querySelector("html").classList.remove("auto");

        document
            .querySelector("html")
            .classList.add(this.getOriginalAppearance());

        setTimeout(() => {
            $resetStylesEl.remove();
        });

        if (dispatchEvent) {
            window.dispatchEvent(
                new CustomEvent("on-hs-appearance-change", {
                    detail: theme,
                })
            );
        }
    },
    getAppearance() {
        let theme = this.getOriginalAppearance();
        if (theme === "auto") {
            theme = window.matchMedia("(prefers-color-scheme: dark)").matches
                ? "dark"
                : "default";
        }
        return theme;
    },
    getOriginalAppearance() {
        const defaultTheme = "default";
        return localStorage.getItem("hs_theme") || defaultTheme;
    },
};
HSThemeAppearance.init();

window
    .matchMedia("(prefers-color-scheme: dark)")
    .addEventListener("change", (e) => {
        if (HSThemeAppearance.getOriginalAppearance() === "auto") {
            HSThemeAppearance.setAppearance("auto", false);
        }
    });

window.addEventListener("load", () => {
    const $clickableThemes = document.querySelectorAll(
        "[data-hs-theme-click-value]"
    );
    const $switchableThemes = document.querySelectorAll(
        "[data-hs-theme-switch]"
    );

    $clickableThemes.forEach(($item) => {
        $item.addEventListener("click", () =>
            HSThemeAppearance.setAppearance(
                $item.getAttribute("data-hs-theme-click-value"),
                true,
                $item
            )
        );
    });

    $switchableThemes.forEach(($item) => {
        $item.addEventListener("change", (e) => {
            HSThemeAppearance.setAppearance(
                e.target.checked ? "dark" : "default"
            );
        });

        $item.checked = HSThemeAppearance.getAppearance() === "dark";
    });

    window.addEventListener("on-hs-appearance-change", (e) => {
        $switchableThemes.forEach(($item) => {
            $item.checked = e.detail === "dark";
        });
    });
});
