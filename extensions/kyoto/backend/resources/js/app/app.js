import Vue from 'vue';
window.Vue = Vue;

import Nano from "nano-js";
Nano.install(Vue.prototype);

import VueNano from "nano-ui";
Vue.use(VueNano, {
    checked:        'far fa-check',
    intermediate:   'far fa-minus',
    clock:          'far fa-clock',
    calendar:       'far fa-calendar',
    times:          'far fa-times',
    success:        'far fa-check-circle',
    warning:        'far fa-exclamation-circle',
    danger:         'far fa-times-circle',
    info:           'far fa-info-circle',
    angleUp:        'far fa-angle-up',
    angleRight:     'far fa-angle-right',
    angleDown:      'far fa-angle-down',
    angleLeft:      'far fa-angle-left',
    arrowUp:        'far fa-arrow-up',
    arrowRight:     'far fa-arrow-right',
    arrowDown:      'far fa-arrow-down',
    arrowLeft:      'far fa-arrow-left',
    create:         'far fa-plus',
    save:           'far fa-check',
    delete:         'far fa-trash',
    archive:        'far fa-archive',
    action:         'far fa-cog',
    preview:        'far fa-link',
    activate:       'far fa-check',
    deactivate:     'far fa-times'
});

import VueRouter from "vue-router";
Vue.use(VueRouter);

import Axios from "axios";
Vue.$http = Vue.prototype.$http = Axios;

require('./config/axios');

import KyoBackend from "./backend";
Vue.component(KyoBackend.name, KyoBackend);

import KyoDashboard from "./pages/dashboard/dashboard";
Vue.component(KyoDashboard.name, KyoDashboard);

Nano.Dom.ready(() => {

    let routes =[];

    Nano.Arr.each(window.backendRoutes, (menu) => {

        if ( ! menu.option.component ) {
            return;
        }

        let data = {
            name: menu.option.component, path: menu.route
        };

        if ( menu.option.component ) {
            data.component = Vue.component(menu.option.component);
        }

        routes.push(data);
    });

    let router = new VueRouter({
        base: window.basePath, mode: 'history', routes
    });

    window.App = new Vue({ router }).$mount('#app');
});
