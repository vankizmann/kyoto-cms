import Vue from 'vue';

import KyoGateSelect from "./inputs/KyoGateSelect";
Kyoto.component(KyoGateSelect.name, KyoGateSelect);

import KyoRoleSelect from "./inputs/KyoRoleSelect";
Kyoto.component(KyoRoleSelect.name, KyoRoleSelect);

import KyoPolicyTransfer from "./inputs/KyoPolicyTransfer";
Kyoto.component(KyoPolicyTransfer.name, KyoPolicyTransfer);

import KyoUsers from "./pages/user/KyoUsers";
Kyoto.component(KyoUsers.name, KyoUsers);

import KyoUserEdit from "./pages/user/KyoUserEdit";
Kyoto.component(KyoUserEdit.name, KyoUserEdit);

import KyoUserCreate from "./pages/user/KyoUserCreate";
Kyoto.component(KyoUserCreate.name, KyoUserCreate);

import KyoRoles from "./pages/role/KyoRoles";
Kyoto.component(KyoRoles.name, KyoRoles);

import KyoRoleEdit from "./pages/role/KyoRoleEdit";
Kyoto.component(KyoRoleEdit.name, KyoRoleEdit);

import KyoRoleCreate from "./pages/role/KyoRoleCreate";
Kyoto.component(KyoRoleCreate.name, KyoRoleCreate);

import KyoGates from "./pages/gate/KyoGates";
Kyoto.component(KyoGates.name, KyoGates);

import KyoGateEdit from "./pages/gate/KyoGateEdit";
Kyoto.component(KyoGateEdit.name, KyoGateEdit);

import KyoGateCreate from "./pages/gate/KyoGateCreate";
Kyoto.component(KyoGateCreate.name, KyoGateCreate);

import KyoPolicies from "./pages/policy/KyoPolicies";
Kyoto.component(KyoPolicies.name, KyoPolicies);

import KyoPolicyEdit from "./pages/policy/KyoPolicyEdit";
Kyoto.component(KyoPolicyEdit.name, KyoPolicyEdit);

import KyoPolicyCreate from "./pages/policy/KyoPolicyCreate";
Kyoto.component(KyoPolicyCreate.name, KyoPolicyCreate);


if ( console && console.log ) {
    console.log('kyoto/user ready.');
}
