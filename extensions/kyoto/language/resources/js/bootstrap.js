import KyoLanguages from "./pages/language/KyoLanguages";
kyoto.component(KyoLanguages.name, KyoLanguages);

import KyoLanguageCreate from "./pages/language/KyoLanguageCreate";
kyoto.component(KyoLanguageCreate.name, KyoLanguageCreate);

import KyoLanguageEdit from "./pages/language/KyoLanguageEdit";
kyoto.component(KyoLanguageEdit.name, KyoLanguageEdit);

import KyoTranslations from "./pages/translation/KyoTranslations";
kyoto.component(KyoTranslations.name, KyoTranslations);

import KyoTranslationCreate from "./pages/translation/KyoTranslationCreate";
kyoto.component(KyoTranslationCreate.name, KyoTranslationCreate);

import KyoTranslationEdit from "./pages/translation/KyoTranslationEdit";
kyoto.component(KyoTranslationEdit.name, KyoTranslationEdit);

if ( console && console.log ) {
    console.log('kyoto/language ready.');
}
