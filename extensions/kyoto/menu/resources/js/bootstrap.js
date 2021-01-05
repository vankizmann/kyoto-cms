import Vue from 'vue';

import KyoMenus from "./pages/menu/KyoMenus";
Vue.component(KyoMenus.name, KyoMenus);

import KyoMenuEdit from "./pages/menu/KyoMenuEdit";
Vue.component(KyoMenuEdit.name, KyoMenuEdit);

import KyoMenuCreate from "./pages/menu/KyoMenuCreate";
Vue.component(KyoMenuCreate.name, KyoMenuCreate);

require('./configs/vue');
require('./configs/redirect');

if ( console && console.log ) {
    console.log('kyoto/menu ready.');
}
