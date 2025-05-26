import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';
import reactRefresh from '@vitejs/plugin-react-refresh';

import rollupConfig from './rollup.config.js';

export default defineConfig({
    define: {
        'import.meta.env': process.env,
    },
    server: {
        proxy: "https://seventech.local",
        hmr: {
            protocol: 'ws',
            host: 'seventech.local',
        },
        watch: {
            include: ['src/**/*.jsx', 'src/**/*.js', '/Users/jamellyons/Documents/J_C_LYONS_ENTERPRISES_LLC/Packages/javascript/github-portfolio/**/*'],
        },
    },
    publicDir: false,
    build: {
        watch: {
            include: ['src/**/*.jsx', 'src/**/*.js'],
        },
        manifest: true,
        sourcemap: true,
        emptyOutDir: true,
        modulePreload: false,
        outDir: 'dist/',
        assetsDir: 'js',
        input: './src/index.jsx',
        rollupOptions: rollupConfig
    },
    plugins: [
        react(),
        reactRefresh(),
    ],
    resolve: {
        preserveSymlinks: true,
        alias: {
            '/@/': new URL('src/', import.meta.url).pathname + '/',
        },
    },
});
