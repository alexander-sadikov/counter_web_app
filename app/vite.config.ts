import {defineConfig} from "vite";

export default defineConfig({
    build: {
        outDir: 'public/dist',
        emptyOutDir: true,
        sourcemap: true,
        minify: true,
        manifest: true,
        rollupOptions: {
            input: [
                'assets/js/test.ts',
            ]
        },
    },
    server: {
        host: true,
        port: 5173
    },
    resolve: {
        alias: {
            '@ts': '/assets/js',
            '@sass': '/assets/css'
        }
    }
})