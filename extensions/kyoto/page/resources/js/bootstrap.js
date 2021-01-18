

// import KyoPageCreate from "./pages/KyoPageCreate";
// App.component(KyoPageCreate.name, KyoPageCreate);

// import KyoPageEdit from "./pages/KyoPageEdit";
// App.component(KyoPageEdit.name, KyoPageEdit);

// import KyoPageBuilder from "./builder/KyoPageBuilder";
// App.component(KyoPageBuilder.name, KyoPageBuilder);

// import KyoWidgetHeadline from "./widgets/KyoWidgetHeadline";
// App.component(KyoWidgetHeadline.name, KyoWidgetHeadline);

// require('./configs/page');

import KyoPages from "./pages/KyoPages2";

Kyoto.ready(function (App) {
    App.component(KyoPages.name, KyoPages);
});


if ( console && console.log ) {
    console.log('kyoto/page ready.');
}
