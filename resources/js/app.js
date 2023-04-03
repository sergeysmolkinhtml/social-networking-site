import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';

import Index from './Pages/Welcome/Index.vue'
window.Alpine = Alpine;
Alpine.plugin(focus);
Alpine.start();

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mixin({ methods: { route }})
            .mount(el)
    },
})
