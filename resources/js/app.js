import {Inertia} from "@inertiajs/inertia";
import Toastify from 'toastify-js';
import {createApp, h} from 'vue';
import {createInertiaApp} from '@inertiajs/inertia-vue3';
import {InertiaProgress} from '@inertiajs/progress';

require('./bootstrap');

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({el, app, props, plugin}) {
        return createApp({render: () => h(app, props)})
            .use(plugin)
            .mixin({methods: {route}})
            .mount(el);
    },
});

InertiaProgress.init({color: '#4B5563'});

Inertia.on('error', ({detail: {errors}}) => {
    if (typeof errors[0] === 'string')
        Toastify({
            text: errors[0],
            duration: 3000,
        }).showToast();
});
