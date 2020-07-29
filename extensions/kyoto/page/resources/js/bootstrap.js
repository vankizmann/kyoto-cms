import Vue from 'vue';

import KyoPages from "./pages/KyoPages";
Vue.component(KyoPages.name, KyoPages);

import KyoPageEdit from "./pages/KyoPageEdit";
Vue.component(KyoPageEdit.name, KyoPageEdit);

if ( console && console.log ) {
    console.log('kyoto/page ready.');
}
