import Vue from 'vue';

import KyoPages from "./pages/KyoPages";
Vue.component(KyoPages.name, KyoPages);

import KyoPageCreate from "./pages/KyoPageCreate";
Vue.component(KyoPageCreate.name, KyoPageCreate);

import KyoPageEdit from "./pages/KyoPageEdit";
Vue.component(KyoPageEdit.name, KyoPageEdit);

import KyoPageBuilder from "./builder/KyoPageBuilder";
Vue.component(KyoPageBuilder.name, KyoPageBuilder);

import KyoBlockHeadline from "./blocks/KyoBlockHeadline";
Vue.component(KyoBlockHeadline.name, KyoBlockHeadline);

require('./configs/page');

if ( console && console.log ) {
    console.log('kyoto/page ready.');
}
