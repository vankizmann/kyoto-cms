import { Obj } from "@kizmann/pico-js";
import KyoRoleEdit from "./KyoRoleEdit";

export default Obj.assign({}, KyoRoleEdit, {

    name: 'KyoRoleCreate',

    /**
     * Refresh on locale change (true|false)
     */
    localized: false,

    /**
     * Used routes in view
     */
    urls: {
        show: '/{locale}/kyoto/user/http/controllers/role/show',
        store: '/{locale}/kyoto/user/http/controllers/role/store',
    },

});
