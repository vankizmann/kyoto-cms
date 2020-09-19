import Vue from 'vue';

import KyoLanguages from "./languages/KyoLanguages";
Vue.component(KyoLanguages.name, KyoLanguages);

import KyoLanguageCreate from "./languages/KyoLanguageCreate";
Vue.component(KyoLanguageCreate.name, KyoLanguageCreate);

import KyoLanguageEdit from "./languages/KyoLanguageEdit";
Vue.component(KyoLanguageEdit.name, KyoLanguageEdit);

if ( console && console.log ) {
    console.log('kyoto/language ready.');
}
