import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // All common resources
                'resources/js/app.js',
                'resources/css/app.css',
                // Charts
                'resources/js/chart-home.js',
                'resources/js/chart-maturity.js',
                'resources/js/chart-relation.js',
                // Mapping TypeScript and styles
                'resources/js/map.show.ts',
                'resources/js/map.edit.ts',
                'resources/css/mapping.css',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '@': '/resources/js',
        },
    },
    build: {
        chunkSizeWarningLimit: 5000, // Augmente la limite à 5000 KB (5 MB)
    }
});
