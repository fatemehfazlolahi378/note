import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./node_modules/flowbite/**/*.js"
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            screens: {
                '1440': "1440px",
                '1370': "1370px",
                '1345': "1345px",
                '1150': "1150px",
                '1000': "1000px",
                '400': "400px",
                '444': "444px",
                '375': "375px",
                '980': "980px",
                '900': "900px",
                '820': "820px",
            },
            boxShadow: {
                '3xl': '0px -1px 4px rgba(0, 0, 0, 0.25), 0px 2px 4px rgba(0, 0, 0, 0.25)',
            }
        },
    },


    plugins: [
        require('flowbite/plugin')
    ]
};
