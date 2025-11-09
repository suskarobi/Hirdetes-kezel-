import preset from './vendor/filament/support/tailwind.config.preset'

export default {
    darkMode: ['class'],
    presets: [preset],
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './app/Filament/Fabricator/**/*.php',
        './vendor/z3d0x/filament-fabricator/resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {},
    },
    plugins: [],
}
