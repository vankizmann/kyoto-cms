import { NanoInstall } from "nano-ui";

import KyoIndex from "./prototypes/KyoIndex";
window.KyoIndex = KyoIndex;

import KyoForm from "./prototypes/KyoForm";
window.KyoForm = KyoForm;

window.baseTitle = document.title;


// router = router.afterEach((to) => {
//     Nano.Dom.title(Nano.Locale.trans(Nano.Obj.get(to, 'meta.menu.title')));
// });

class Kyoto {

    static components = {};
    static functions = [];

    static component(name, data = null)
    {
        if ( data === null ) {
            return Nano.Obj.get(this.components, name)
        }

        Nano.Obj.set(this.components, name, data);
    }

    static register(App)
    {
        Nano.Arr.each(this.functions, (callback) => {
            callback(App);
        });

        Nano.Obj.each(this.components, (data, name) => {
            App.component(name, data);
        });
    }

    static ready(callback)
    {
        Nano.Arr.push(this.functions, callback);
    }

}

window.Kyoto = Kyoto;

require('./config/axios');

Nano.Dom.ready(function () {

    let rootComponent = {};

    if ( Nano.Dom.find('[data-root="true"]').get(0) ) {
        rootComponent = require("./layout/KyoBackend").default;
    }

    let App = Vue.createApp(rootComponent);

    let KyoLayoutMainmenu = require("./layout/KyoLayoutMainmenu").default;
    let KyoLayoutSubmenu = require("./layout/KyoLayoutSubmenu").default;
    let KyoLayoutLanguage = require("./layout/KyoLayoutLanguage").default;
    let KyoLayoutUserpanel = require("./layout/KyoLayoutUserpanel").default;
    let KyoLayoutWebsite = require("./layout/KyoLayoutWebsite").default;
    let KyoWebsiteNode = require("./website/KyoWebsiteNode").default;
    let KyoTitlebar = require("./helpers/KyoTitlebar").default;
    let KyoTitlebarSearch = require("./helpers/KyoTitlebarSearch").default;
    let KyoFilterbar = require("./helpers/KyoFilterbar").default;
    let KyoDatatable = require("./helpers/KyoDatatable").default;

    let KyoDashboard = require("./pages/dashboard/KyoDashboard").default;
    App.component(KyoDashboard.name, KyoDashboard);

    App.component(KyoLayoutMainmenu.name, KyoLayoutMainmenu);
    App.component(KyoLayoutSubmenu.name, KyoLayoutSubmenu);
    App.component(KyoLayoutLanguage.name, KyoLayoutLanguage);
    App.component(KyoLayoutUserpanel.name, KyoLayoutUserpanel);
    App.component(KyoLayoutWebsite.name, KyoLayoutWebsite);
    App.component(KyoWebsiteNode.name, KyoWebsiteNode);
    App.component(KyoTitlebar.name, KyoTitlebar);
    App.component(KyoTitlebarSearch.name, KyoTitlebarSearch);
    App.component(KyoFilterbar.name, KyoFilterbar);
    App.component(KyoDatatable.name, KyoDatatable);

    App.config.devtools = true;

    App.use(function (App) {
        App.config.globalProperties.$http = axios;
    });

    App.use(function (App) {
        Kyoto.register(App);
    });

    let routes =[];

    Nano.Arr.recursive(window.backendRoutes || [], 'children', (menu, cascade) => {

        let root = Nano.Arr.first(cascade) || menu;

        let data = {
            id: menu.id, name: menu.id, path: menu.route, meta: { root, menu }
        };

        if ( menu.option.component ) {
            data.component = App.component(data.name = menu.option.component);
        }

        if ( menu.option.redirect ) {
            data.redirect = () => Nano.Arr.find(routes, { id: menu.option.redirect });
        }

        routes.push(data);
    });

    let router = VueRouter.createRouter({
        history: VueRouter.createWebHistory(Nano.Obj.get(window, 'backendPaths.base', '/')),
        mode: 'history',
        routes: routes,
    });

    App.use(router);

    App.use(function (App) {
        NanoInstall(App);
    });

    App.mount('#app');
});

