const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'navy': {
                    50: '#E8EAF6',
                    100: '#C5CAE9',
                    200: '#9FA8DA',
                    300: '#7986CB',
                    400: '#5C6BC0',
                    500: '#3F51B5',
                    600: '#3949AB',
                    700: '#303F9F',
                    800: '#283593',
                    900: '#1A237E',
                },
            },
            transitionProperty: {
                'width': 'width',
                'spacing': 'margin, padding',
            },
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
