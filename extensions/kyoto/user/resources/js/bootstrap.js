import Vue from 'vue';

import KyoTest from "./pages/test";
Vue.component(KyoTest.name, KyoTest);

window.Routes.push({
    path: '/test', name: 'test', component: Vue.component(KyoTest.name)
});

if ( console && console.log ) {
    console.log('kyoto/menu ready.');
}
