import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { viteStaticCopy } from 'vite-plugin-static-copy';

export default defineConfig({
    build: {
        manifest: true,
        cssCodeSplit: true, // Split CSS for performance
        outDir: 'public/build/', // Output directory
        rollupOptions: {
            output: {
                assetFileNames: (asset) => {
                    return asset.name.endsWith('.css')
                        ? 'css/[name].min.css'
                        : 'icons/[name]';
                },
                entryFileNames: 'js/[name].js', // JS file names
            },
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/scss/app.scss',
                'resources/scss/bootstrap.scss',
                'resources/scss/icons.scss',
            ],
            refresh: true, // Hot reload in development
        }),
        viteStaticCopy({
            targets: [
                { src: 'resources/fonts', dest: 'fonts' },
                { src: 'resources/images', dest: 'images' },
                { src: 'resources/js', dest: 'js' },
                { src: 'resources/libs', dest: 'libs' },
                { src: 'resources/lang', dest: 'lang' },
            ],
        }),
    ],
});
