import { Obj } from "@kizmann/pico-js";
import KyoUserEdit from "./KyoUserEdit";

export default Obj.assign({}, KyoUserEdit, {

    name: 'KyoUserCreate',

    /**
     * Refresh on locale change (true|false)
     */
    localized: false,

    /**
     * Used routes in view
     */
    urls: {
        show: '/{locale}/kyoto/user/http/controllers/user/show',
        store: '/{locale}/kyoto/user/http/controllers/user/store',
    },

});
