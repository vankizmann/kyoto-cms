import { Obj } from "@kizmann/pico-js";
import KyoPolicyEdit from "./KyoPolicyEdit";

export default Obj.assign({}, KyoPolicyEdit, {

    name: 'KyoPolicyCreate',

    /**
     * Refresh on locale change (true|false)
     */
    localized: false,

    /**
     * Used routes in view
     */
    urls: {
        show: '/{locale}/kyoto/user/http/controllers/policy/show',
        store: '/{locale}/kyoto/user/http/controllers/policy/store',
    },

});
