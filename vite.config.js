import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/assets/scss/style.scss', // The main InApp style
                'resources/assets/js/main.js' ,      // The main InApp JS
                'resources/assets/js/sidebar.js',
            ],
            refresh: true,
        }),
    ],
});