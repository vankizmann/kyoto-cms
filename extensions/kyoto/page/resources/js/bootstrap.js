import KyoWidget from "./prototypes/KyoWidget";
global.KyoWidget = KyoWidget;

import KyoPages from "./pages/KyoPages";
kyoto.component(KyoPages.name, KyoPages);

import KyoPageCreate from "./pages/KyoPageCreate";
kyoto.component(KyoPageCreate.name, KyoPageCreate);

import KyoPageEdit from "./pages/KyoPageEdit";
kyoto.component(KyoPageEdit.name, KyoPageEdit);

import KyoWidgetOptions from "./helpers/KyoWidgetOptions";
kyoto.component(KyoWidgetOptions.name, KyoWidgetOptions);

import KyoPageBuilder from "./builder/KyoPageBuilder";
kyoto.component(KyoPageBuilder.name, KyoPageBuilder);

import KyoWidgetHeadline from "./widgets/KyoWidgetHeadline";
kyoto.component(KyoWidgetHeadline.name, KyoWidgetHeadline);

import KyoWidgetWysiwyg from "./widgets/KyoWidgetWysiwyg";
kyoto.component(KyoWidgetWysiwyg.name, KyoWidgetWysiwyg);

if ( console && console.log ) {
    console.log('kyoto/page ready.');
}
