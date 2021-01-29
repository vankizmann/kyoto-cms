import Vue from 'vue';

import KyoGateSelect from "./inputs/KyoGateSelect";
kyoto.component(KyoGateSelect.name, KyoGateSelect);

import KyoRoleSelect from "./inputs/KyoRoleSelect";
kyoto.component(KyoRoleSelect.name, KyoRoleSelect);

import KyoPolicyTransfer from "./inputs/KyoPolicyTransfer";
kyoto.component(KyoPolicyTransfer.name, KyoPolicyTransfer);

import KyoUsers from "./pages/user/KyoUsers";
kyoto.component(KyoUsers.name, KyoUsers);

import KyoUserEdit from "./pages/user/KyoUserEdit";
kyoto.component(KyoUserEdit.name, KyoUserEdit);

import KyoUserCreate from "./pages/user/KyoUserCreate";
kyoto.component(KyoUserCreate.name, KyoUserCreate);

import KyoRoles from "./pages/role/KyoRoles";
kyoto.component(KyoRoles.name, KyoRoles);

import KyoRoleEdit from "./pages/role/KyoRoleEdit";
kyoto.component(KyoRoleEdit.name, KyoRoleEdit);

import KyoRoleCreate from "./pages/role/KyoRoleCreate";
kyoto.component(KyoRoleCreate.name, KyoRoleCreate);

import KyoGates from "./pages/gate/KyoGates";
kyoto.component(KyoGates.name, KyoGates);

import KyoGateEdit from "./pages/gate/KyoGateEdit";
kyoto.component(KyoGateEdit.name, KyoGateEdit);

import KyoGateCreate from "./pages/gate/KyoGateCreate";
kyoto.component(KyoGateCreate.name, KyoGateCreate);

import KyoPolicies from "./pages/policy/KyoPolicies";
kyoto.component(KyoPolicies.name, KyoPolicies);

import KyoPolicyEdit from "./pages/policy/KyoPolicyEdit";
kyoto.component(KyoPolicyEdit.name, KyoPolicyEdit);

import KyoPolicyCreate from "./pages/policy/KyoPolicyCreate";
kyoto.component(KyoPolicyCreate.name, KyoPolicyCreate);


if ( console && console.log ) {
    console.log('kyoto/user ready.');
}
