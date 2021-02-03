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

import KyoPagebuilder from "./builder/KyoPagebuilder";
kyoto.component(KyoPagebuilder.name, KyoPagebuilder);

import KyoPagebuilderWidgets from "./builder/KyoPagebuilderWidgets";
kyoto.component(KyoPagebuilderWidgets.name, KyoPagebuilderWidgets);

import KyoPagebuilderBuilders from "./builder/KyoPagebuilderBuilders";
kyoto.component(KyoPagebuilderBuilders.name, KyoPagebuilderBuilders);

import KyoWidgetHeadline from "./widgets/KyoWidgetHeadline";
kyoto.component(KyoWidgetHeadline.name, KyoWidgetHeadline);

import KyoWidgetWysiwyg from "./widgets/KyoWidgetWysiwyg";
kyoto.component(KyoWidgetWysiwyg.name, KyoWidgetWysiwyg);

if ( console && console.log ) {
    console.log('kyoto/page ready.');
}
