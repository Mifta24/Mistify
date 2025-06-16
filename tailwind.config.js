import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [],

    extend: {
        animation: {
            "gradient-x": "gradient-x 10s ease infinite",
        },
        keyframes: {
            "gradient-x": {
                "0%, 100%": { "background-position": "0% 50%" },
                "50%": { "background-position": "100% 50%" },
            },
        },
    },
};
