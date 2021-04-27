require('./bootstrap');

// Import modules...
import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

import {Http} from './Modules/Http.js';
import {Notification} from './Modules/Notification.js';
import {WaitElement} from './Modules/WaitElement.js';
import {Service} from './Service';
window.Http = Http;
window.Notification = Notification;
window.WaitElement = WaitElement;
window.Service = Service;

const el = document.getElementById('app');

createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
})
    .mixin({ methods: { route } })
    .use(InertiaPlugin)
    .mount(el);

InertiaProgress.init({ color: '#4B5563' });
