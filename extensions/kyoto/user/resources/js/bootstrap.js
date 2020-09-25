import Vue from 'vue';

import KyoGateSelect from "./inputs/KyoGateSelect";
Vue.component(KyoGateSelect.name, KyoGateSelect);

import KyoRoleSelect from "./inputs/KyoRoleSelect";
Vue.component(KyoRoleSelect.name, KyoRoleSelect);

import KyoPolicyTransfer from "./inputs/KyoPolicyTransfer";
Vue.component(KyoPolicyTransfer.name, KyoPolicyTransfer);

import KyoUsers from "./pages/user/KyoUsers";
Vue.component(KyoUsers.name, KyoUsers);

import KyoUserEdit from "./pages/user/KyoUserEdit";
Vue.component(KyoUserEdit.name, KyoUserEdit);

import KyoUserCreate from "./pages/user/KyoUserCreate";
Vue.component(KyoUserCreate.name, KyoUserCreate);

import KyoRoles from "./pages/role/KyoRoles";
Vue.component(KyoRoles.name, KyoRoles);

import KyoRoleEdit from "./pages/role/KyoRoleEdit";
Vue.component(KyoRoleEdit.name, KyoRoleEdit);

import KyoRoleCreate from "./pages/role/KyoRoleCreate";
Vue.component(KyoRoleCreate.name, KyoRoleCreate);

import KyoGates from "./pages/gate/KyoGates";
Vue.component(KyoGates.name, KyoGates);

import KyoGateEdit from "./pages/gate/KyoGateEdit";
Vue.component(KyoGateEdit.name, KyoGateEdit);

import KyoGateCreate from "./pages/gate/KyoGateCreate";
Vue.component(KyoGateCreate.name, KyoGateCreate);

import KyoPolicies from "./pages/policy/KyoPolicies";
Vue.component(KyoPolicies.name, KyoPolicies);

import KyoPolicyEdit from "./pages/policy/KyoPolicyEdit";
Vue.component(KyoPolicyEdit.name, KyoPolicyEdit);

import KyoPolicyCreate from "./pages/policy/KyoPolicyCreate";
Vue.component(KyoPolicyCreate.name, KyoPolicyCreate);


if ( console && console.log ) {
    console.log('kyoto/user ready.');
}
