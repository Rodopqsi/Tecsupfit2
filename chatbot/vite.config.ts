import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';

// https://vitejs.dev/config/
export default defineConfig({
  base: '/chatbot/', // <-- AÑADIDO para rutas correctas en producción
  plugins: [react()],
  optimizeDeps: {
    exclude: ['lucide-react'],
  },
});
