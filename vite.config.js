import { defineConfig } from 'vite';

import { fileURLToPath, URL } from 'node:url';

import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
  
    plugins: [
        vue(),
        laravel({
            input: ['resources/css/app.css',
             'resources/js/app.js'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            //vue: 'node_modules/vue/dist/vue.esm-bundler.js',
            '@': fileURLToPath(new URL('./resources', import.meta.url))
        },
    },
});
