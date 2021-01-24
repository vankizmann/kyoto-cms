import KyoLanguages from "./pages/language/KyoLanguages";
Kyoto.component(KyoLanguages.name, KyoLanguages);

import KyoLanguageCreate from "./pages/language/KyoLanguageCreate";
Kyoto.component(KyoLanguageCreate.name, KyoLanguageCreate);

import KyoLanguageEdit from "./pages/language/KyoLanguageEdit";
Kyoto.component(KyoLanguageEdit.name, KyoLanguageEdit);

import KyoTranslations from "./pages/translation/KyoTranslations";
Kyoto.component(KyoTranslations.name, KyoTranslations);

import KyoTranslationCreate from "./pages/translation/KyoTranslationCreate";
Kyoto.component(KyoTranslationCreate.name, KyoTranslationCreate);

import KyoTranslationEdit from "./pages/translation/KyoTranslationEdit";
Kyoto.component(KyoTranslationEdit.name, KyoTranslationEdit);

if ( console && console.log ) {
    console.log('kyoto/language ready.');
}
