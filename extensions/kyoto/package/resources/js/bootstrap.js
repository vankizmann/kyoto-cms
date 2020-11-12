import Vue from 'vue';

import KyoPackages from "./packages/KyoPackages";
Vue.component(KyoPackages.name, KyoPackages);

import KyoPackageCreate from "./packages/KyoPackageCreate";
Vue.component(KyoPackageCreate.name, KyoPackageCreate);

import KyoPackageEdit from "./packages/KyoPackageEdit";
Vue.component(KyoPackageEdit.name, KyoPackageEdit);

if ( console && console.log ) {
    console.log('kyoto/package ready.');
}
