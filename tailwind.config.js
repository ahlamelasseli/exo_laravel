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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primaryPurple: {
                    DEFAULT: '#7c3aed', // main purple
                    dark: '#5b21b6',   // dark purple
                    light: '#a78bfa',  // light purple
                },
                primaryBlue: {
                    DEFAULT: '#1e293b', // dark blue
                    dark: '#0f172a',   // even darker blue
                    light: '#334155',  // lighter blue
                },
                primaryBlack: {
                    DEFAULT: '#18181b', // black
                    light: '#27272a',  // lighter black
                },
            },
        },
    },

    plugins: [forms],
};
