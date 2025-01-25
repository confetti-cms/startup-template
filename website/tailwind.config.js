module.exports = {
    content: [
        './**/*.blade.php',
        './**/*.mjs',
        './**/*.html',
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
        fontFamily: {
            'headings': ['pluto'],
            'body': ['sans-serif'],
          },
        extend: {
            colors: {
                primary: {
                    DEFAULT: '#d69051',
                    light: "#d69051",
                    dark: "#d69051",
                },
                secondary: {
                    DEFAULT: '#3dc2ff',
                    dark: "#36abe0",
                    light: "#50c8ff",
                },
            },
            maxHeight: {
                xl: '36rem',
            },
            boxShadow: {
                xs: '0 0 0 1px rgba(0, 0, 0, 0.05)',
                outline: '0 0 0 3px rgba(66, 153, 225, 0.5)',
            }
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms')({
            strategy: 'class',
        }),
    ],
}
