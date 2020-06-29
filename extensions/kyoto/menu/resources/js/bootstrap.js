import Vue from 'vue';

import KyoTest from "./pages/test";
Vue.component(KyoTest.name, KyoTest);

import KyoMenus from "./pages/KyoMenus";
Vue.component(KyoMenus.name, KyoMenus);

import KyoMenuEdit from "./pages/KyoMenuEdit";
Vue.component(KyoMenuEdit.name, KyoMenuEdit);

if ( console && console.log ) {
    console.log('kyoto/menu ready.');
}
