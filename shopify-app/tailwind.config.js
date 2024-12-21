const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                mint: {
                    50: '#f0fdf9',
                    100: '#ccfbef',
                    200: '#99f6e0',
                    300: '#5eead4',
                    400: '#2dd4bf',
                    500: '#19ccaa',
                    600: '#0d9488',
                    700: '#0f766e',
                    800: '#115e59',
                    900: '#134e4a',
                    950: '#042f2e',
                }
            }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
