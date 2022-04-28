import { Obj } from "@kizmann/pico-js";
import KyoTranslationEdit from "./KyoTranslationEdit";

export default Obj.assign({}, KyoTranslationEdit, {

    name: 'KyoTranslationCreate',

    /**
     * Refresh on locale change (true|false)
     */
    localized: false,

    /**
     * Used routes in view
     */
    urls: {
        show: '/{locale}/kyoto/language/http/controllers/translation/show',
        store: '/{locale}/kyoto/language/http/controllers/translation/store',
    },

});
