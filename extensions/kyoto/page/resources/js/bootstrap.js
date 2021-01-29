

import KyoPages from "./pages/KyoPages";
kyoto.component(KyoPages.name, KyoPages);

import KyoPageCreate from "./pages/KyoPageCreate";
kyoto.component(KyoPageCreate.name, KyoPageCreate);

import KyoPageEdit from "./pages/KyoPageEdit";
kyoto.component(KyoPageEdit.name, KyoPageEdit);

import KyoPageBuilder from "./builder/KyoPageBuilder";
kyoto.component(KyoPageBuilder.name, KyoPageBuilder);

import KyoWidgetHeadline from "./widgets/KyoWidgetHeadline";
kyoto.component(KyoWidgetHeadline.name, KyoWidgetHeadline);

if ( console && console.log ) {
    console.log('kyoto/page ready.');
}
