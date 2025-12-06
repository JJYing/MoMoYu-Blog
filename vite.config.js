import jigsaw from '@tighten/jigsaw-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        jigsaw({
            input: ['source/_assets/js/main.js', 'source/_assets/css/blog.css'],
            refresh: true,
        }),
    ],
});
