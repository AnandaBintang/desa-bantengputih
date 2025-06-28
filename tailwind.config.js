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
        },
        fontFamily: {
            poppins: ["Poppins", "sans-serif"],
        },
        },
    },
    plugins: [],
};
