import Vue from 'vue';

import KyoUsers from "./pages/user/KyoUsers";
Vue.component(KyoUsers.name, KyoUsers);

import KyoUserEdit from "./pages/user/KyoUserEdit";
Vue.component(KyoUserEdit.name, KyoUserEdit);

import KyoUserCreate from "./pages/user/KyoUserCreate";
Vue.component(KyoUserCreate.name, KyoUserCreate);

import KyoRoles from "./pages/KyoRoles";
Vue.component(KyoRoles.name, KyoRoles);

import KyoGates from "./pages/KyoGates";
Vue.component(KyoGates.name, KyoGates);

import KyoPolicies from "./pages/KyoPolicies";
Vue.component(KyoPolicies.name, KyoPolicies);


if ( console && console.log ) {
    console.log('kyoto/user ready.');
}
