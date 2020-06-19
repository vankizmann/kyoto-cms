import Vue from 'vue';

import KyoTest from "./pages/test";
Vue.component(KyoTest.name, KyoTest);

if ( console && console.log ) {
    console.log('kyoto/menu ready.');
}
