/*import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';

import Index from './Pages/Welcome/Index.vue'
window.Alpine = Alpine;
Alpine.plugin(focus);
Alpine.start();*/

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import {InertiaProgress} from '@inertiajs/progress'

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    title: title => `${title} - Inertia`,
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mixin({ methods: { route }})
            .mount(el)
    },
})

InertiaProgress.init({
        delay: 200,
        color: "#29d",
        includeCSS: true,
        showSpinner: true
    }
)
