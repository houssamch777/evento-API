import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { viteStaticCopy } from 'vite-plugin-static-copy';

export default defineConfig({
    build: {
        manifest: true,
        rtl: true,
        outDir: 'public/build/',
        cssCodeSplit: true,
        sourcemap: process.env.NODE_ENV !== 'production', // Only enable in non-production
        rollupOptions: {
            output: {
                assetFileNames: (css) => {
                    if (css.name.split('.').pop() === 'css') {
                        return 'css/[name].min.css';
                    } else {
                        return 'icons/' + css.name;
                    }
                },
                entryFileNames: 'js/[name].js',
            },
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                // 'resources/scss/bootstrap.scss', // Consider removing if it's in app.scss
                // 'resources/scss/icons.scss' // Consider removing if it's in app.scss
            ],
            refresh: true,
        }),
        viteStaticCopy({
            targets: [
                {
                    src: 'resources/fonts',
                    dest: ''
                },
                {
                    src: 'resources/images',
                    dest: ''
                },
                {
                    src: 'resources/js',
                    dest: ''
                },
                {
                    src: 'resources/libs',
                    dest: ''
                },
                {
                    src: 'resources/lang',
                    dest: ''
                },
            ]
        }),
    ],
});
