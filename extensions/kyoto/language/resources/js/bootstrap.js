import Vue from 'vue';

import KyoLanguages from "./pages/language/KyoLanguages";
Vue.component(KyoLanguages.name, KyoLanguages);

import KyoLanguageCreate from "./pages/language/KyoLanguageCreate";
Vue.component(KyoLanguageCreate.name, KyoLanguageCreate);

import KyoLanguageEdit from "./pages/language/KyoLanguageEdit";
Vue.component(KyoLanguageEdit.name, KyoLanguageEdit);

import KyoTranslations from "./pages/translation/KyoTranslations";
Vue.component(KyoTranslations.name, KyoTranslations);

import KyoTranslationCreate from "./pages/translation/KyoTranslationCreate";
Vue.component(KyoTranslationCreate.name, KyoTranslationCreate);

import KyoTranslationEdit from "./pages/translation/KyoTranslationEdit";
Vue.component(KyoTranslationEdit.name, KyoTranslationEdit);

if ( console && console.log ) {
    console.log('kyoto/language ready.');
}
