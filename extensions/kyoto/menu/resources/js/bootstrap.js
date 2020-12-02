import Vue from 'vue';

import KyoMenus from "./pages/menu/KyoMenus";
Vue.component(KyoMenus.name, KyoMenus);

import KyoMenuEdit from "./pages/menu/KyoMenuEdit";
Vue.component(KyoMenuEdit.name, KyoMenuEdit);

import KyoMenuCreate from "./pages/menu/KyoMenuCreate";
Vue.component(KyoMenuCreate.name, KyoMenuCreate);

Nano.Store.add('menus', (setter) => {

    let route = Nano.Route.get('/{locale}/kyoto/menu/http/controllers/menu/index',
        { locale: window.App.locale });

    Vue.$http.get(route).then((res) => setter(res.data.data), () => false);
});

Nano.Event.bind('locale:changed', () => {
    Nano.Store.refresh('menus');
});

require('./configs/vue');
require('./configs/redirect');

if ( console && console.log ) {
    console.log('kyoto/menu ready.');
}
