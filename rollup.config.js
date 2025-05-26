import babel from '@rollup/plugin-babel';

import pkg from './package.json';

const rollupConfig = {
    input: './src/index.jsx',
    output: {
        dir: 'dist/js/',
        format: 'esm',
        entryFileNames: '[name].js',
        chunkFileNames: '[name].js',
        assetFileNames: '[name].[ext]',
    },
    plugins: [babel({ babelHelpers: 'bundled', exclude: 'node_modules/**' })],
};

export default rollupConfig;
