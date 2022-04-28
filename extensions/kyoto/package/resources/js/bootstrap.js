import KyoPackages from "./pages/package/KyoPackages";
kyoto.component(KyoPackages.name, KyoPackages);

import KyoPackageCreate from "./pages/package/KyoPackageCreate";
kyoto.component(KyoPackageCreate.name, KyoPackageCreate);

import KyoPackageEdit from "./pages/package/KyoPackageEdit";
kyoto.component(KyoPackageEdit.name, KyoPackageEdit);

if ( console && console.log ) {
    console.log('kyoto/package ready.');
}
