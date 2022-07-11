const defaultTheme = require('tailwindcss/defaultTheme');

const isAdmin = process.argv.includes('--admin')

let content = [
    './resources/views/**/*.blade.php',
]
if (isAdmin) {
    content = [
        './resources/views/admin/**/*.blade.php',
    ]
}

module.exports = {
    content: [...content,
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        "./node_modules/flowbite/**/*.js",
    ]
    ,
    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
        container: {
            center: true,
            // padding: {
            //   DEFAULT: '0',
            //   md: '0',
            // },
        },
    },

    plugins: [
        require('flowbite/plugin')
    ],
    darkMode: false
};
