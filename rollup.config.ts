import { RollupOptions } from 'rollup';
import typescript from '@rollup/plugin-typescript';
import resolve from '@rollup/plugin-node-resolve';
import babel from '@rollup/plugin-babel';

const rollupConfig: RollupOptions = {
    input: './src/index.tsx',
    output: {
        dir: 'dist/js/',
        format: 'esm',
        entryFileNames: '[name].js',
        chunkFileNames: '[name].js',
        assetFileNames: '[name].[ext]',
    },
    plugins: [
        babel({ babelHelpers: 'bundled', exclude: 'node_modules/**' }),
        resolve(),
        typescript({ tsconfig: './tsconfig.json' })
    ],
};

export default rollupConfig;
