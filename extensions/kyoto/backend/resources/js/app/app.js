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

import KyoIndex from "./prototypes/KyoIndex";
window.KyoIndex = KyoIndex;

import KyoForm from "./prototypes/KyoForm";
window.KyoForm = KyoForm;

import KyoBackend from "./layout/KyoBackend";

import KyoLayoutMainmenu from "./layout/KyoLayoutMainmenu";
Vue.component(KyoLayoutMainmenu.name, KyoLayoutMainmenu);

import KyoLayoutSubmenu from "./layout/KyoLayoutSubmenu";
Vue.component(KyoLayoutSubmenu.name, KyoLayoutSubmenu);

import KyoLayoutLanguage from "./layout/KyoLayoutLanguage";
Vue.component(KyoLayoutLanguage.name, KyoLayoutLanguage);

import KyoLayoutUserpanel from "./layout/KyoLayoutUserpanel";
Vue.component(KyoLayoutUserpanel.name, KyoLayoutUserpanel);

import KyoTitlebar from "./helpers/KyoTitlebar";
Vue.component(KyoTitlebar.name, KyoTitlebar);

import KyoTitlebarSearch from "./helpers/KyoTitlebarSearch";
Vue.component(KyoTitlebarSearch.name, KyoTitlebarSearch);

import KyoDatatable from "./helpers/KyoDatatable";
Vue.component(KyoDatatable.name, KyoDatatable);

import KyoDashboard from "./pages/dashboard/KyoDashboard";
Vue.component(KyoDashboard.name, KyoDashboard);


Nano.Dom.ready(() => {

    window.baseTitle = document.title;

    let routes =[];

    Nano.Arr.recursive(window.backendRoutes, 'children', (menu, cascade) => {

        let root = Nano.Arr.first(cascade) || menu;

        let data = {
            id: menu.id, name: menu.id, path: menu.route, meta: { root, menu }
        };

        if ( menu.option.component ) {
            data.component = Vue.component(data.name = menu.option.component);
        }

        if ( menu.option.redirect ) {
            data.redirect = () => Nano.Arr.find(routes, { id: menu.option.redirect });
        }

        routes.push(data);
    });

    KyoBackend.router = new VueRouter({
        base: window.basePath, mode: 'history', routes
    });

    KyoBackend.router.afterEach((to) => {
        Nano.Dom.title(Nano.Obj.get(to, 'meta.menu.title', 'Undefined'));
    });

    window.App = new Vue(KyoBackend).$mount('#app');
});
