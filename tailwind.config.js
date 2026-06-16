import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                heading: ['Outfit', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: '#f4f6f9',
                    100: '#e3ebf3',
                    200: '#c1d4e4',
                    300: '#8eb3ce',
                    400: '#558ab3',
                    500: '#346b97',
                    600: '#235580',
                    700: '#1d4468',
                    800: '#1a3a57',
                    900: '#0F2032', /* Premium Deep Navy */
                },
                accent: {
                    50: '#fffbf0',
                    100: '#fef1c7',
                    200: '#fde08b',
                    300: '#fbc644',
                    400: '#faa611',
                    500: '#f58a0b', /* Premium Gold/Orange */
                    600: '#d96406',
                    700: '#b44309',
                }
            },
        },
    },

    plugins: [forms],
};
