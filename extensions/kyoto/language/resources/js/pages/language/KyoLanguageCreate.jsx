import { Obj } from "@kizmann/pico-js";
import KyoLanguageEdit from "./KyoLanguageEdit";

export default Obj.assign({}, KyoLanguageEdit, {

    name: 'KyoLanguageCreate',

    /**
     * Refresh on locale change (true|false)
     */
    localized: false,

    /**
     * Used routes in view
     */
    urls: {
        show: '/{locale}/kyoto/language/http/controllers/language/show',
        store: '/{locale}/kyoto/language/http/controllers/language/store',
    },

});
