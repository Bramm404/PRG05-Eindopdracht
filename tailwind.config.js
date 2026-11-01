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
            colors: {
                black: {
                    50: '#eae8fd', 100: '#d5d1fa', 200: '#aca2f6', 300: '#8274f1', 400: '#5945ed',
                    500: '#2f17e8', 600: '#2612ba', 700: '#1c0e8b', 800: '#13095d', 900: '#09052e', 950: '#070320',
                },
                'prussian-blue': {
                    50: '#e8e8fd', 100: '#d0d1fb', 200: '#a1a3f7', 300: '#7274f3', 400: '#4346ef',
                    500: '#1418eb', 600: '#1013bc', 700: '#0c0e8d', 800: '#080a5e', 900: '#04052f', 950: '#030321',
                },
                'deep-twilight': {
                    50: '#ece6ff', 100: '#d8cdfe', 200: '#b19afe', 300: '#8b68fd', 400: '#6435fd',
                    500: '#3d03fc', 600: '#3102ca', 700: '#250297', 800: '#180165', 900: '#0c0132', 950: '#090023',
                },
                navy: {
                    50: '#ece5ff', 100: '#daccff', 200: '#b499ff', 300: '#8f66ff', 400: '#6933ff',
                    500: '#4400ff', 600: '#3600cc', 700: '#290099', 800: '#1b0066', 900: '#0e0033', 950: '#0a0024',
                },
                'navy-electric': {
                    50: '#e8e5ff', 100: '#d0ccff', 200: '#a299ff', 300: '#7366ff', 400: '#4433ff',
                    500: '#1500ff', 600: '#1100cc', 700: '#0d0099', 800: '#080066', 900: '#040033', 950: '#030024',
                },
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
