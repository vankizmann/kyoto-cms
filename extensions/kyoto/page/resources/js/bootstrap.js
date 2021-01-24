

import KyoPages from "./pages/KyoPages";
Kyoto.component(KyoPages.name, KyoPages);

import KyoPageCreate from "./pages/KyoPageCreate";
Kyoto.component(KyoPageCreate.name, KyoPageCreate);

import KyoPageEdit from "./pages/KyoPageEdit";
Kyoto.component(KyoPageEdit.name, KyoPageEdit);

import KyoPageBuilder from "./builder/KyoPageBuilder";
Kyoto.component(KyoPageBuilder.name, KyoPageBuilder);

import KyoWidgetHeadline from "./widgets/KyoWidgetHeadline";
Kyoto.component(KyoWidgetHeadline.name, KyoWidgetHeadline);

if ( console && console.log ) {
    console.log('kyoto/page ready.');
}
