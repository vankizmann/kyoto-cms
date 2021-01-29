import KyoMenus from "./pages/menu/KyoMenus";
kyoto.component(KyoMenus.name, KyoMenus);

import KyoMenuEdit from "./pages/menu/KyoMenuEdit";
kyoto.component(KyoMenuEdit.name, KyoMenuEdit);

import KyoMenuCreate from "./pages/menu/KyoMenuCreate";
kyoto.component(KyoMenuCreate.name, KyoMenuCreate);

import KyoConnectorSelect from "./inputs/KyoConnectorSelect";
kyoto.component(KyoConnectorSelect.name, KyoConnectorSelect);

// require('./configs/vue');
// require('./configs/redirect');

if ( console && console.log ) {
    console.log('kyoto/menu ready.');
}
