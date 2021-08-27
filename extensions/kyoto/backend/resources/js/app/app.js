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

import KyoHeader from "./datatable/KyoHeader";
kyoto.component(KyoHeader.name, KyoHeader);

import KyoSearch from "./datatable/KyoSearch";
kyoto.component(KyoSearch.name, KyoSearch);

import KyoDatatable from "./datatable/KyoDatatable";
kyoto.component(KyoDatatable.name, KyoDatatable);

import KyoTitlebarSearch from "./helpers/KyoTitlebarSearch";
kyoto.component(KyoTitlebarSearch.name, KyoTitlebarSearch);

import KyoFilterbar from "./helpers/KyoFilterbar";
kyoto.component(KyoFilterbar.name, KyoFilterbar);

import KyoWebsite from "./website/KyoWebsite";
kyoto.component(KyoWebsite.name, KyoWebsite);

import KyoWebsiteNode from "./website/KyoWebsiteNode";
kyoto.component(KyoWebsiteNode.name, KyoWebsiteNode);

import KyoWysiwyg from "./wysiwyg/KyoWysiwyg";
kyoto.component(KyoWysiwyg.name, KyoWysiwyg);

import KyoWysiwygNative from "./wysiwyg/tags/KyoWysiwygNative";
kyoto.component(KyoWysiwygNative.name, KyoWysiwygNative);

import KyoDashboard from "./pages/dashboard/KyoDashboard";
kyoto.component(KyoDashboard.name, KyoDashboard);

import KyoBackend from "./backend/KyoBackend";


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

        if ( data.component && ! data.path.match(/(:[a-z][^?]|create)/) ) {
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
        language: 'fa fa-language',
        search: 'fa fa-search',
        bold: 'fa fa-bold',
        italic: 'fa fa-italic',
        underline: 'fa fa-underline'
    });

    App.use(AppRouter);
    App.use(VueNano);

    App.mount('#app');
});

