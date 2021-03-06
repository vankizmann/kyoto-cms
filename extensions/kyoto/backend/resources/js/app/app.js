import { Obj, Arr, Dom, Locale } from "@kizmann/pico-js";
import { Install as VueNano } from "@kizmann/nano-ui";

import KyoIndex from "./prototypes/KyoIndex";
global.KyoIndex = KyoIndex;

import KyoForm from "./prototypes/KyoForm";
global.KyoForm = KyoForm;

import NTableCellState from "./table/table-cell/NTableCellState";
kyoto.component(NTableCellState.name, NTableCellState);

import NTableFilterState from "./table/table-filter/NTableFilterState";
kyoto.component(NTableFilterState.name, NTableFilterState);

import NTableCellHide from "./table/table-cell/NTableCellHide";
kyoto.component(NTableCellHide.name, NTableCellHide);

import NTableFilterHide from "./table/table-filter/NTableFilterHide";
kyoto.component(NTableFilterHide.name, NTableFilterHide);

import NTableCellLink from "./table/table-cell/NTableCellLink";
kyoto.component(NTableCellLink.name, NTableCellLink);

import NTableFilterLink from "./table/table-filter/NTableFilterLink";
kyoto.component(NTableFilterLink.name, NTableFilterLink);

import NInfoFieldState from "./table/info-field/NInfoFieldState";
kyoto.component(NInfoFieldState.name, NInfoFieldState);

import NInfoFieldHide from "./table/info-field/NInfoFieldHide";
kyoto.component(NInfoFieldHide.name, NInfoFieldHide);

import NInfoFieldLink from "./table/info-field/NInfoFieldLink";
kyoto.component(NInfoFieldLink.name, NInfoFieldLink);

import KyoLayoutMainmenu from "./layout/KyoLayoutMainmenu";
kyoto.component(KyoLayoutMainmenu.name, KyoLayoutMainmenu);

import KyoLayoutSubmenu from "./layout/KyoLayoutSubmenu";
kyoto.component(KyoLayoutSubmenu.name, KyoLayoutSubmenu);

import KyoLayoutDash from "./layout/KyoLayoutDash";
kyoto.component(KyoLayoutDash.name, KyoLayoutDash);

import KyoLayoutLanguage from "./layout/KyoLayoutLanguage";
kyoto.component(KyoLayoutLanguage.name, KyoLayoutLanguage);

import KyoLayoutUser from "./layout/KyoLayoutUser";
kyoto.component(KyoLayoutUser.name, KyoLayoutUser);

import KyoTitlebar from "./helpers/KyoTitlebar";
kyoto.component(KyoTitlebar.name, KyoTitlebar);

import KyoTitlebarSearch from "./helpers/KyoTitlebarSearch";
kyoto.component(KyoTitlebarSearch.name, KyoTitlebarSearch);

import KyoFilterbar from "./helpers/KyoFilterbar";
kyoto.component(KyoFilterbar.name, KyoFilterbar);

import KyoDatatable from "./helpers/KyoDatatable";
kyoto.component(KyoDatatable.name, KyoDatatable);

import KyoWebsite from "./website/KyoWebsite";
kyoto.component(KyoWebsite.name, KyoWebsite);

import KyoWebsiteNode from "./website/KyoWebsiteNode";
kyoto.component(KyoWebsiteNode.name, KyoWebsiteNode);

import KyoWysiwyg from "./wysiwyg/KyoWysiwyg";
kyoto.component(KyoWysiwyg.name, KyoWysiwyg);

import KyoDashboard from "./pages/dashboard/KyoDashboard";
kyoto.component(KyoDashboard.name, KyoDashboard);

import KyoBackend from "./layout/KyoBackend";


// router = router.afterEach((to) => {
//     pi.Dom.title(pi.Locale.trans(pi.Obj.get(to, 'meta.menu.title')));
// });

require('./config/axios');

Dom.ready(function () {

    let rootComponent = {};

    if ( Dom.find('[data-root="true"]').get(0) ) {
        rootComponent = KyoBackend;
    }

    const App = Vue.createApp(rootComponent);

    App.config.devtools = true;

    App.use(function (App) {
        App.config.globalProperties.$http = axios;
    });

    Obj.each(kyoto.components, (value, key) => {
        App.component(key, value)
    });

    Arr.each(kyoto.waiters, (callback) => {
        callback(App);
    });

    let routes = [];

    Arr.recursive(kyoto.routes, 'children', (menu, cascade) => {

        let root = Arr.first(cascade) || menu;

        let data = {
            id: menu.id, name: menu.id, path: menu.route, meta: { root, menu }
        };

        if ( menu.option.component ) {
            data.component = App.component(data.name = menu.option.component);
        }

        if ( menu.option.redirect ) {
            data.redirect = () => Arr.find(routes, { id: menu.option.redirect });
        }

        let gotoFunction = () => {
            AppRouter.push({ name: data.name });
        };

        if ( data.component && ! data.path.match(/:[a-z][^?]/) ) {
            kyoto.addDash({
                type: 'goto',
                title: Locale.trans(menu.title),
                description: menu.route,
                tags: [menu.slug],
                callback: gotoFunction
            });
        }

        routes.push(data);
    });

    let history = VueRouter.createWebHistory(
        kyoto.paths.base);

    const AppRouter = VueRouter.createRouter({
        history, mode: 'history', routes: routes,
    });

    nano.Icons = Obj.assign(nano.Icons, {
        copy: 'fa fa-copy',
        search: 'fa fa-search'
    });

    App.use(AppRouter);
    App.use(VueNano);

    App.mount('#app');
});

