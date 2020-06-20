import Vue from 'vue';
window.Vue = Vue;

import Nano from "nano-js";
Nano.install(Vue.prototype);

import VueNano from "nano-ui";
Vue.use(VueNano, {
    checked:        'fa fa-check',
    intermediate:   'fa fa-minus',
    clock:          'fa fa-clock',
    calendar:       'fa fa-calendar',
    times:          'fa fa-times',
    success:        'fa fa-check-circle',
    warning:        'fa fa-exclamation-circle',
    danger:         'fa fa-times-circle',
    info:           'fa fa-info-circle',
    angleUp:        'fa fa-angle-up',
    angleRight:     'fa fa-angle-right',
    angleDown:      'fa fa-angle-down',
    angleLeft:      'fa fa-angle-left',
    arrowUp:        'fa fa-arrow-up',
    arrowRight:     'fa fa-arrow-right',
    arrowDown:      'fa fa-arrow-down',
    arrowLeft:      'fa fa-arrow-left',
    create:         'fa fa-plus',
    save:           'fa fa-check',
    delete:         'fa fa-trash',
    archive:        'fa fa-archive',
    action:         'fa fa-cog',
    preview:        'fa fa-link',
    activate:       'fa fa-check',
    deactivate:     'fa fa-times'
}, {
    iconPosition: 'after'
});

import VueRouter from "vue-router";
Vue.use(VueRouter);

import Axios from "axios";
Vue.$http = Vue.prototype.$http = Axios;

require('./config/axios');

import KyoBackend from "./layout/KyoBackend";
Vue.component(KyoBackend.name, KyoBackend);

import KyoLayoutMainmenu from "./layout/KyoLayoutMainmenu";
Vue.component(KyoLayoutMainmenu.name, KyoLayoutMainmenu);

import KyoLayoutSubmenu from "./layout/KyoLayoutSubmenu";
Vue.component(KyoLayoutSubmenu.name, KyoLayoutSubmenu);

import KyoLayoutLanguage from "./layout/KyoLayoutLanguage";
Vue.component(KyoLayoutLanguage.name, KyoLayoutLanguage);

import KyoDashboard from "./pages/dashboard/KyoDashboard";
Vue.component(KyoDashboard.name, KyoDashboard);

import KyoBackendUser from "./user/KyoBackendUser";
Vue.component(KyoBackendUser.name, KyoBackendUser);

Nano.Dom.ready(() => {

    let routes =[];

    Nano.Arr.recursive(window.backendRoutes, 'children', (menu, cascade) => {

        let root = Nano.Arr.first(cascade) || menu;

        let data = {
            name: menu.id, path: menu.route, meta: { root, menu }
        };

        if ( menu.option.component ) {
            data.component = Vue.component(menu.option.component);
        }

        if ( menu.option.redirect ) {
            data.redirect = { name: menu.option.redirect };
        }

        routes.push(data);
    });

    let router = new VueRouter({
        base: window.basePath, mode: 'history', routes
    });

    window.App = new Vue({ router }).$mount('#app');
});
