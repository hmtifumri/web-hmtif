import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        // "public/preline/dist/*.js",
        'node_modules/preline/dist/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Inter", ...defaultTheme.fontFamily.sans],
                zodiak: ['"Zodiak", sans-serif'],
                plusjakartasans: ['"Plus Jakarta Sans", sans-serif'],
            },
            colors: {
                navy: "#395682",
                navy2: "#486DA3",
                navy3: "#5D84CA",
                navylight: "#6e90c2",
            },
        },
    },

    plugins: [
        forms,
        require('preline/plugin'),
    ],
    darkMode: "class",
};
