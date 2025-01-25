module.exports = {
    content: [
        './**/*.blade.php',
        './**/*.mjs',
        './**/*.html',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            maxHeight: {
                xl: '36rem',
            },
            fontFamily: {
                sans: ['Inter', 'sans-serif'],
            },
            boxShadow: {
                xs: '0 0 0 1px rgba(0, 0, 0, 0.05)',
            },
        },
    },
}
