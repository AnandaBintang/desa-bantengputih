import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
        colors: {
            primary: "#4CAF50",
            secondary: "#2c5530",
            accent: "#45a049",
            yellow: {
                100: "#FEF9C3",
                500: "#F59E42",
                600: "#D97706"
            },
            purple: {
                100: "#E9D5FF",
                500: "#8B5CF6",
                600: "#7C3AED"
            }
        },
        fontFamily: {
            poppins: ["Poppins", "sans-serif"],
        },
        },
    },
    plugins: [],
};
