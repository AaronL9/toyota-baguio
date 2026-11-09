import { defineConfig, loadEnv } from "vite";
import { globSync } from 'tinyglobby';
import path from 'node:path';
import tailwindcss from "@tailwindcss/vite";

const env = loadEnv("development", process.cwd(), "VITE_");

export default defineConfig(({ command }) => ({
  plugins: [tailwindcss()],
  root: "resources",
  base: command === 'build' ? '/dist/' : '/',

  server: {
    cors: {
      origin: env.VITE_PHP_SERVER_ORIGIN ?? "http://localhost:8080",
    },

    port: env.VITE_NODE_SERVER_PORT ?? 5173,
    origin: env.VITE_NODE_SERVER_ORIGIN ?? "http://localhost:5173",
  },

  build: {
    outDir: "../public/dist",
    emptyOutDir: true,

    // generate .vite/manifest.json in outDir
    manifest: true,

    rollupOptions: {
      // overwrite default .html entry
      input: {
        admin: "/admin.ts",
        main: "/main.ts",

        ...Object.fromEntries(
          globSync('resources/js/admin/**/*.js').map((file) => [
            path
              .relative('resources/js/admin', file.slice(0, -path.extname(file).length))
              .split(path.sep)
              .join('/'),

            path.resolve(file),
          ]),
        ),

      },

    },
  },
}));
