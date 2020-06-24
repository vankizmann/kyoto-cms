import Vue from 'vue';

import KyoUsers from "./pages/KyoUsers";
Vue.component(KyoUsers.name, KyoUsers);

import KyoRoles from "./pages/KyoRoles";
Vue.component(KyoRoles.name, KyoRoles);


if ( console && console.log ) {
    console.log('kyoto/user ready.');
}
