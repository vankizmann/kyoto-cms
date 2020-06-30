import Vue from 'vue';

import KyoUsers from "./pages/KyoUsers";
Vue.component(KyoUsers.name, KyoUsers);

import KyoRoles from "./pages/KyoRoles";
Vue.component(KyoRoles.name, KyoRoles);

import KyoGates from "./pages/KyoGates";
Vue.component(KyoGates.name, KyoGates);

import KyoPolicies from "./pages/KyoPolicies";
Vue.component(KyoPolicies.name, KyoPolicies);


if ( console && console.log ) {
    console.log('kyoto/user ready.');
}
