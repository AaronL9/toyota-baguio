import { defineConfig, loadEnv } from "vite";
import tailwindcss from "@tailwindcss/vite";

const env = loadEnv("development", process.cwd(), "VITE_");

export default defineConfig({
  plugins: [tailwindcss()],
  root: "resources",

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
        admin_global: '/js/admin/global.js',
        vehicles: '/js/admin/vehicles.js',
        admin: "/admin.ts",
        main: "/main.ts",
      },
    },
  },
});
