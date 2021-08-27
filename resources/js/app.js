import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import VueClickAway from "vue3-click-away";

const globalOptions = {
    mode: 'international',
};

InertiaProgress.init({
    delay: 250,
    color: '#1a8f36',
    includeCSS: true,
    showSpinner: true,
})

createInertiaApp({
    resolve: name => require(`./Pages/${name}`),
    setup({ el, app, props, plugin }) {
        createApp({ render: () => h(app, props) })
            .use(plugin)
            .mixin({
                methods: {
                    route: window.route,
                    isRoute(...routes) {
                        return routes.some( route => this.route().current(route));
                    }
                }
            })
            .use( VueClickAway )
            .mount(el)
    },
})
