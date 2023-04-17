import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    define: {
        'publicPath': '/public/'
    },
    plugins: [
        laravel({
            input: ['resources/js/app.js', 'resources/views/layouts/js/app.js', 'resources/css/app.blade.css'],

            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});
