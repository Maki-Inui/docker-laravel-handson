const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                'regal-orange': '#E85A25',
            },
            backgroundColor: theme => ({
                'foot': '#FDD02D'
            }),
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                body: [
                    'ヒラギノ角ゴシック',
                    'メイリオ',
                    'Meiryo',
                    'YuGothic',
                    'Yu Gothic',
                    'ＭＳ Ｐゴシック',
                    'MS PGothic'
                ]
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
