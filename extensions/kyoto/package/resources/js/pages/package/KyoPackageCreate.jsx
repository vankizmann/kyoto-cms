import { Obj } from "@kizmann/pico-js";
import KyoPackageEdit from "./KyoPackageEdit";

export default Obj.assign({}, KyoPackageEdit, {

    name: 'KyoPackageCreate',

    /**
     * Refresh on locale change (true|false)
     */
    localized: false,

    /**
     * Used routes in view
     */
    urls: {
        show: '/{locale}/kyoto/package/http/controllers/package/show',
        store: '/{locale}/kyoto/package/http/controllers/package/store',
    },

});
