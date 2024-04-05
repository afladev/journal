import { defineConfig, loadEnv } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

export default defineConfig(({ mode }) =>
{
    const env = {...loadEnv(mode, process.cwd(), ''), ...process.env};

    return {
        server: {
            port: env.VITE_PORT,
            host: '0.0.0.0',
            origin: env.APP_URL,
            hmr: {
                host: env.APP_HOST,
            },
            watch: {
                usePolling: true,
            }
        },
        plugins: [
            laravel({
                input: [
                    'resources/css/app.css',
                    'resources/js/app.js',
                ]
            }),
            vue({
                template: {
                    transformAssetUrls: {
                        base: null,
                        includeAbsolute: false,
                    },
                },
            }),
        ],
        resolve: {
            alias: {
                vue: 'vue/dist/vue.esm-bundler.js',
            },
        },
    }
});
