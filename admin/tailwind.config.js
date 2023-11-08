const defaultTheme = require('tailwindcss/defaultTheme')
const colors = require('tailwindcss/colors')

module.exports = {
    content: [
        './**/*.blade.php',
        './assets/js/**'
    ],
    darkMode: 'class',
    theme: {
        customForms: (theme) => ({
            default: {
                'input, textarea': {
                    '&::placeholder': {
                        color: theme('colors.gray.400'),
                    },
                },
            },
        }),
        extend: {
            colors: {
                primary: {
                    DEFAULT: '#3880ff',
                    light: "#4c8dff",
                    dark: "#3171e0",
                },
                secondary: {
                    DEFAULT: '#3dc2ff',
                    dark: "#36abe0",
                    light: "#50c8ff",
                },
                tertiary: {
                    DEFAULT: '#06b6d4',
                    dark: "#ff5e3a",
                    light: "#ff5e3a",
                },
                success: {
                    DEFAULT: '#2dd36f',
                    dark: "#28ba62",
                    light: "#42d77d",
                },
                warning: {
                    DEFAULT: '#ffc409',
                    dark: "#e0ac08",
                    light: "#ffca22",
                },
                error: {
                    DEFAULT: '#eb445a',
                    dark: "#cf3c4f",
                    light: "#ed576b",
                },
                light: {
                    DEFAULT: '#f4f5f8',
                    dark: "#d7d8da",
                    light: "#f5f6f9",
                },
                medium: {
                    DEFAULT: '#92949c',
                    dark: "#808289",
                    light: "#9d9fa6",
                },
                dark: {
                    DEFAULT: '#222428',
                    dark: "#1e2023",
                    light: "#383a3e",
                },
            },
            maxHeight: {
                xl: '36rem',
            },
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                xs: '0 0 0 1px rgba(0, 0, 0, 0.05)',
                outline: '0 0 0 3px rgba(66, 153, 225, 0.5)',
            }
        },
    },
    plugins: [
        // require('@tailwindcss/forms'), // double import ?
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms')({
            strategy: 'class',
        }),
    ],
}
