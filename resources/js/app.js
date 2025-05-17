import './bootstrap';
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from 'ziggy-js';
import { Ziggy } from './ziggy'; // this is automatically injected by Laravel

// ? Import shared axios instance
import axios from '@/axios';

// ? Fetch CSRF token from Sanctum before app loads (needed for API auth with cookies)
axios.get('/sanctum/csrf-cookie').then(() => {
    createInertiaApp({
        resolve: (name) =>
            resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
        setup({ el, App, props, plugin }) {
            const app = createApp({ render: () => h(App, props) });
            app.use(plugin);
            app.use(ZiggyVue, Ziggy); // ? REGISTER Ziggy HERE
            app.mount(el);
        },
    });
});
