import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import eslintPlugin from "vite-plugin-eslint";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        laravel({
            input: "resources/js/app.js",
            refresh: true,
        }),
        // eslintPlugin({
        //     cache: false,
        //     fix: true,
        //     include: [
        //         "resources/**/*.js",
        //         "resources/**/*.vue",
        //         "resources/**/*.ts",
        //     ],
        //     exclude: ["node_modules", "dist"],
        // }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});
