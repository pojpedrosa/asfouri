import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            fonts: [
                // Organic editorial serif for display — soft, warm, alive.
                bunny('Fraunces', {
                    weights: [300, 400, 500, 600, 700, 900],
                    styles: ['normal', 'italic'],
                }),
                // Clean, humanist grotesque for body copy.
                bunny('Hanken Grotesk', {
                    weights: [400, 500, 600, 700],
                }),
            ],
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
