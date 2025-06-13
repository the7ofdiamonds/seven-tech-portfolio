import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';
import reactRefresh from '@vitejs/plugin-react-refresh';
import cssInjectedByJsPlugin from 'vite-plugin-css-injected-by-js';
import { fileURLToPath, URL } from 'url';

/** @type {import('vite').UserConfig} */
export default defineConfig({
  define: {
    'import.meta.env': process.env,
  },
  server: {
    proxy: {
      '^/.*': {
        target: 'https://seventech.local',
        changeOrigin: true,
        secure: false,
      },
    },
    hmr: {
      protocol: 'ws',
      host: 'seventech.local',
    },
    watch: {},
  },
  publicDir: false,
  build: {
    watch: {
      include: [
        'src/**/*.tsx',
        'src/**/*.ts',
        'src/**/*.jsx',
        'src/**/*.js',
        'src/**/*.scss',
      ],
    },
    manifest: true,
    sourcemap: true,
    emptyOutDir: true,
    modulePreload: false,
    rollupOptions: {
      input: './src/index.tsx',
      output: {
        dir: 'dist/js/',
        format: 'esm',
        entryFileNames: '[name].js',
        chunkFileNames: '[name].js',
        // assetFileNames: ({ name }) => {
        //   if (name && name.endsWith('.css')) {
        //     return 'css/[name]';
        //   }
        //   return 'assets/[name].[ext]';
        // },
      },
      plugins: [],
    },
  },
  plugins: [react(), reactRefresh(), cssInjectedByJsPlugin()],
  resolve: {
    preserveSymlinks: true,
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url)),
    },
    extensions: ['.ts', '.tsx', '.js', '.jsx'],
  },
});
